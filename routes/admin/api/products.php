<?php

Route::group([
    'prefix' => 'products',
    'as'     => '.products'
], function () {
    Route::get('/', [
        'uses' => 'ProductController@fetch'
    ]);
    Route::get('import', [
        'as'   => '.import',
        'uses' => 'ProductController@import'
    ]);
});
