<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/slider')->group(function () {
        Route::get('/index', 'Admin\SliderController@index')->name('slider.index')->middleware('can:slider-list');
        Route::get('/create', 'Admin\SliderController@create')->name('slider.create')->middleware('can:slider-add');
        Route::post('/create', 'Admin\SliderController@store')->name('slider.store');
        Route::get('/edit/{id}', 'Admin\SliderController@edit')->name('slider.edit')->middleware('can:slider-edit');
        Route::post('/edit/{id}', 'Admin\SliderController@update')->name('slider.update');
        Route::post('/delete/{id}', 'Admin\SliderController@destroy')->name('slider.delete')->middleware('can:slider-delete');
    });
});