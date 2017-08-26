<?php

namespace Ntupla\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Ntupla\Category;
use Ntupla\Selector;
use Ntupla\Tuple;
use Illuminate\Http\Request;

class TupleController extends Controller
{
    public function index()
    {
        $tuples = Tuple::all();
        $categories = Category::all();
        return view('tuple.index', compact('tuples', 'categories'));
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
            $selectors = explode(' ', $request->selectors);
            foreach ($selectors as $selector) {
                $actualSelector = Selector::where('selector', $selector)->first();
                if (is_null($actualSelector)) {
                    $actualSelector = new Selector(['selector' => $selector]);
                    $actualSelector->save();
                }
                $tuple->selectors()->attach($actualSelector->id);
            }
        }
        return redirect()->route('tuple.index')->with('Se creo un nuevo elemento en la categoria '. $category->name);
    }
}
