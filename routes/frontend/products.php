<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/products')->group(function () {
    Route::get('/index', 'Frontend\ProductController@index')->name('frontend.product.index');
});