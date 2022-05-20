<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/country')->group(function () {
        Route::get('/index', 'Admin\CountryController@index')->name('country.index');
        Route::get('/create', 'Admin\CountryController@create')->name('country.create');
        Route::post('/create', 'Admin\CountryController@store')->name('country.store');
        Route::get('/edit/{id}', 'Admin\CountryController@edit')->name('country.edit');
        Route::post('/edit/{id}', 'Admin\CountryController@update')->name('country.update');
        Route::post('/delete/{id}', 'Admin\CountryController@destroy')->name('country.delete');
    });
});