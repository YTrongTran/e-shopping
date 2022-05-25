<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/product')->group(function () {

        Route::get('/index', 'Admin\ProductsController@index')->name('product.index')->middleware('can:product-list');

        Route::get('/create', 'Admin\ProductsController@create')->name('product.create')->middleware('can:product-add');

        Route::post('/create', 'Admin\ProductsController@store')->name('product.store');

        Route::get('/edit/{id}', 'Admin\ProductsController@edit')->name('product.edit')->middleware('can:product-edit,id');

        Route::post('/edit/{id}', 'Admin\ProductsController@update')->name('product.update');

        Route::post('/delete/{id}', 'Admin\ProductsController@destroy')->name('product.delete')->middleware('can:product-delete,id');
    });
});