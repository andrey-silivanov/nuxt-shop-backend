<?php

Route::group([
    'prefix'    => 'auth',
    'namespace' => 'Auth'
], function () {

    Route::post('/login', [
        'uses' => 'LoginController@login'
    ]);


    Route::get('user', [
        'as'   => 'getUser',
        'uses' => 'LoginController@me'
    ]);

    Route::get('refresh', [
        'as'   => 'refresh',
        'uses' => 'LoginController@refresh'
    ]);

    /*  });*/
});


