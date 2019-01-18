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

/*Route::get('/dashboard', function () {
    return \Illuminate\Support\Facades\File::get(public_path() . '/admin_panel/index.html');
})->name('home');*/

/*Route::get('/{any}', function () {
    return \Illuminate\Support\Facades\File::get(public_path() . '/admin_panel/index.html');
})->where('any', '.*');*/
Route::auth();
Route::get('/', function () {
    /*$s = new \App\Services\ImportProduct\EndorPhone\ImportService();
    $s->run();*/
     \App\Jobs\ImportProducts::dispatch();
   return 'import';
});