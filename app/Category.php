<?php

namespace Ntupla;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function tuples()
    {
        return $this->hasMany(Tuple::class);
    }
}
