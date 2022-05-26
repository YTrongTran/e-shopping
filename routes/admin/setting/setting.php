<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/setting')->group(function () {
        Route::get('/index', 'Admin\SettingController@index')->name('setting.index')->middleware('can:setting-list');
        Route::get('/create', 'Admin\SettingController@create')->name('setting.create')->middleware('can:setting-add');
        Route::post('/create', 'Admin\SettingController@store')->name('setting.store');
        Route::get('/edit/{id}', 'Admin\SettingController@edit')->name('setting.edit')->middleware('can:setting-edit');
        Route::post('/edit/{id}', 'Admin\SettingController@update')->name('setting.update');
        Route::post('/delete/{id}', 'Admin\SettingController@destroy')->name('setting.delete')->middleware('can:setting-delete');
    });
});