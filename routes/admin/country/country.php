<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/country')->group(function () {
        Route::get('/index', 'Admin\CountryController@index')->name('country.index')->middleware('can:country-list');
        Route::get('/create', 'Admin\CountryController@create')->name('country.create')->middleware('can:country-add');
        Route::post('/create', 'Admin\CountryController@store')->name('country.store');
        Route::get('/edit/{id}', 'Admin\CountryController@edit')->name('country.edit')->middleware('can:country-edit');
        Route::post('/edit/{id}', 'Admin\CountryController@update')->name('country.update')->middleware('can:country-edit');
        Route::post('/delete/{id}', 'Admin\CountryController@destroy')->name('country.delete')->middleware('can:country-delete');
    });
});