<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/products')->group(function () {
    Route::get('/index', 'Frontend\ProductController@index')->name('frontend.product.index');
    Route::get('/search', 'Frontend\ProductController@search')->name('frontend.product.search');
    Route::get('/{slug}/{id}', 'Frontend\ProductController@show')->name('frontend.product.details');
});