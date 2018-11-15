<?php

Route::get('/{any}', function () {
    return \Illuminate\Support\Facades\File::get(public_path() . '/admin_panel/index.html');
})->where('any', '.*');
