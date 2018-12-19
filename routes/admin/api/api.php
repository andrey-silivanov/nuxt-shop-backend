<?php

require_once ('auth.php');

Route::get('/products', 'ProductController@fetch');
Route::get('/products/import', 'ProductController@import');