<?php

/**
 * Rutas accesibles por ususarios identificados
 */

Route::post('/', [
    'uses' => 'TupleController@store',
]);