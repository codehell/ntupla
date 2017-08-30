<?php

namespace Ntupla;

use Illuminate\Database\Eloquent\Model;

class Tuple extends Model
{
    protected $fillable = ['message'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function selectors()
    {
        return $this->belongsToMany(Selector::class);
    }

    public function selectableStore($selectors)
    {
        $this->selectable = 1;
        $this->save();
        $selectors = explode(' ', $selectors);
        foreach ($selectors as $selector) {
            $actualSelector = Selector::where('selector', $selector)->first();
            if (is_null($actualSelector)) {
                $actualSelector = new Selector(['selector' => $selector]);
                $actualSelector->save();
            }
            $this->selectors()->attach($actualSelector->id);
        }
    }

    public static function getSelectables($selectors)
    {
        $arrySelectors = explode(' ', $selectors);
        $result = static::whereHas(['selectors' => function ($query) {
            $query->whereIn('selector', 'kk');
        }])->get();
        return $result;
    }
}
