<?php

namespace Ntupla\Http\Controllers;

use Ntupla\Tuple;
use Illuminate\Http\Request;

class TupleController extends Controller
{
    public function index()
    {
        $tuples = Tuple::all();

        return view('tuple.index', compact('tuples'));
    }
}
