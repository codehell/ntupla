<?php

namespace Ntupla;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function tuples()
    {
        return $this->hasMany(Tuple::class);
    }

    public static function predetermined()
    {
        return static::where('predetermined', 1)->firstOrFail();
    }

    public static function categoryBySlug($slug)
    {
        return static::where('slug', $slug)->firstOrFail();
    }

    public function unselectableTuples()
    {
        return $this->tuples()->where('selectable', 0)->get();
    }

    public function selectableTuples($selectors)
    {
        $arrySelectors = explode(' ', $selectors);
        $result = $this->tuples()->whereHas('selectors', function ($query) use ($arrySelectors) {
            $query->whereIn('selector', $arrySelectors);
        })->get();
        return $result;
    }
}
