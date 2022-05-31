<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/category')->group(function () {
    Route::get('/show/{slug}/{id}', 'Frontend\CategoryController@show')->name('frontend.category.show');
});