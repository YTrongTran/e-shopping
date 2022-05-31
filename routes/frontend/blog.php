<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/blog')->group(function () {
    Route::get('/index', 'Frontend\BlogController@index')->name('frontend.blog.index');
    Route::get('/{slug}/{id}', 'Frontend\BlogController@show')->name('frontend.blog.show');
});