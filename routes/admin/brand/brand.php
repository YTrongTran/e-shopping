<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/brand')->group(function () {
        Route::get('/index', 'Admin\BrandController@index')->name('brand.index')->middleware('can:brand-list');
        Route::get('/create', 'Admin\BrandController@create')->name('brand.create')->middleware('can:brand-add');
        Route::post('/create', 'Admin\BrandController@store')->name('brand.store');
        Route::get('/edit/{id}', 'Admin\BrandController@edit')->name('brand.edit')->middleware('can:brand-edit');
        Route::post('/edit/{id}', 'Admin\BrandController@update')->name('brand.update')->middleware('can:brand-edit');
        Route::post('/delete/{id}', 'Admin\BrandController@destroy')->name('brand.delete')->middleware('can:brand-delete');
    });
});