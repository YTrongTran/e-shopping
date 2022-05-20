<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/blog')->group(function () {
        Route::get('/index', 'Admin\BlogController@index')->name('blog.index');
        Route::get('/create', 'Admin\BlogController@create')->name('blog.create');
        Route::post('/create', 'Admin\BlogController@store')->name('blog.store');
        Route::get('/edit/{id}', 'Admin\BlogController@edit')->name('blog.edit');
        Route::post('/edit/{id}', 'Admin\BlogController@update')->name('blog.update');
        Route::post('/delete/{id}', 'Admin\BlogController@destroy')->name('blog.delete');
    });
});