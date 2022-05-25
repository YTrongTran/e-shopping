<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('/category')->group(function () {
        Route::get('/index', 'Admin\CategoryController@index')->name('category.index')->middleware('can:category-list');
        Route::get('/create', 'Admin\CategoryController@create')->name('category.create')->middleware('can:category-add');
        Route::post('/create', 'Admin\CategoryController@store')->name('category.store');
        Route::get('/edit/{id}', 'Admin\CategoryController@edit')->name('category.edit')->middleware('can:category-edit');
        Route::post('/edit/{id}', 'Admin\CategoryController@update')->name('category.update');
        Route::post('/delete/{id}', 'Admin\CategoryController@destroy')->name('category.delete')->middleware('can:category-delete');
    });
});