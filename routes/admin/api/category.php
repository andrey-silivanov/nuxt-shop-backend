<?php

Route::group([
    'prefix' => 'categories',
    'as'     => '.categories'
], function () {
    Route::get('/', [
        'uses' => 'CategoryController@fetch'
    ]);
    Route::get('/parent', [
        'as'   => '.parent',
        'uses' => 'CategoryController@getParent'
    ]);
    Route::get('/children/{category}', [
        'as'   => '.children',
        'uses' => 'CategoryController@getChildren'
    ]);
});