<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'Api',
    'as'        => 'api'
], function () {
    Route::get('/products', [
        'as'   => '.products',
        'uses' => 'ProductController@fetch'
    ]);
    Route::get('/products/{product}', [
        'as'   => '.products-show',
        'uses' => 'ProductController@show'
    ]);
    Route::get('/categories', [
        'as'   => '.categories',
        'uses' => 'CategoryController@fetch'
    ]);
    Route::get('/brands', [
        'as'   => '.brands',
        'uses' => 'BrandController@fetch'
    ]);
    Route::get('/phone-models', [
        'as'   => '.phone-models',
        'uses' => 'PhoneModelController@fetch'
    ]);
    Route::get('/colors', [
        'as'   => '.colors',
        'uses' => 'ColorController@fetch'
    ]);
    Route::get('/tags', [
        'as'   => '.tags',
        'uses' => 'TagController@fetch'
    ]);
    Route::post('/checkout', [
        'as'   => '.checkout',
        'uses' => 'OrderController@store'
    ]);
});


