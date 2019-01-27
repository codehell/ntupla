<?php

/**
 * Rutas accesibles por ususarios identificados
 */

Route::get('/{slug?}', 'TupleController@index')->name('tuple.index');

Route::post('/', 'TupleController@store');
