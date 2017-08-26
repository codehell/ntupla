<?php

namespace Ntupla;

use Illuminate\Database\Eloquent\Model;

class Selector extends Model
{
    protected $fillable = ['selector'];

    public static function manage($selectors, Tuple $tuple)
    {
        $selectors = explode(' ', $selectors);
        foreach ($selectors as $selector) {
            $actualSelector = Selector::where('selector', $selector)->first();
            if (is_null($actualSelector)) {
                $actualSelector = new Selector(['selector' => $selector]);
                $actualSelector->save();
            }
            $tuple->selectors()->attach($actualSelector->id);
        }
    }
}
