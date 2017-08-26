<?php

/**
 * Rutas accesibles por ususarios identificados
 */

Route::get('/', [
    'uses' => 'TupleController@index',
])->name('tuple.index');

Route::post('/', [
    'uses' => 'TupleController@store',
]);