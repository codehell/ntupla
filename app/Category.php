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
        return static::where('predetermined', 1)->first();
    }

    public static function categoryBySlug($slug)
    {
        return static::where('slug', $slug)->first();
    }
}
