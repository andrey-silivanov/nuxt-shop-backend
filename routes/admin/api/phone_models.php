<?php

Route::group([
    'prefix' => 'phone-models',
    'as'     => '.phone-models'
], function () {
    Route::get('/', [
        'uses' => 'PhoneModelController@fetch'
    ]);
});