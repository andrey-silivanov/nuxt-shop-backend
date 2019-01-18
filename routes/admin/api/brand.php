<?php

Route::group([
    'prefix' => 'brands',
    'as'     => '.brands'
], function () {
    Route::get('/', [
        'uses' => 'BrandController@fetch'
    ]);
});