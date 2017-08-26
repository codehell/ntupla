<?php

namespace Ntupla;

use Illuminate\Database\Eloquent\Model;

class Tuple extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
