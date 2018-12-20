<?php

require_once('auth.php');

Route::group([
    'middleware' => ['auth:api'],
    'as' => 'admin'
], function () {
    require_once ('products.php');
    require_once ('category.php');
});
