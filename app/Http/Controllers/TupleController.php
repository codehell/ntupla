<?php

namespace Ntupla\Http\Controllers;

use Ntupla\Tuple;
use Ntupla\Category;
use Ntupla\Selector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TupleController extends Controller
{
    public function index($slug = null)
    {
        if (is_null($slug)) {
            $category = Category::predetermined();
        } else {
            $category = Category::categoryBySlug($slug);
        }
        $tuples = $category->tuples;
        $categories = Category::all();
        return view('tuple.index', compact('tuples', 'categories', 'category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'category' => 'required|exists:categories,id'
        ]);

        $category = Category::findOrFail($request->category);
        $tuple = new Tuple(['message' => $request->message]);
        $user = Auth::user();
        $tuple->user()->associate($user);
        $category->tuples()->save($tuple);
        if (! is_null($request->selectors)) {
            Selector::manage($request->selectors, $tuple);
        }
        return redirect()->route('tuple.index')->with('Se creo un nuevo elemento en la categoria '. $category->name);
    }
}
