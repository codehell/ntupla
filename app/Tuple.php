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
}
