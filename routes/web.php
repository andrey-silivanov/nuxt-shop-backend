<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses' => 'Api\ProductController@index'
]);
Auth::routes(['']);

Route::get('/home', function () {
    return \Illuminate\Support\Facades\File::get(public_path() . '/admin_panel/index.html');
})->name('home');
