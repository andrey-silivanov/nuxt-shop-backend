<?php

Route::get('/test', function(\Illuminate\Http\Request $request) {
   return 'test';
})->middleware('verified');
