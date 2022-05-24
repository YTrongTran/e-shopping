<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/permission')->group(function () {
        Route::get('/index', 'Admin\PermissionController@index')->name('permission.index');
        Route::get('/create', 'Admin\PermissionController@create')->name('permission.create');
        Route::post('/create', 'Admin\PermissionController@store')->name('permission.store');
        Route::get('/edit/{id}', 'Admin\PermissionController@edit')->name('permission.edit');
        Route::post('/edit/{id}', 'Admin\PermissionController@update')->name('permission.update');
        Route::post('/delete/{id}', 'Admin\PermissionController@destroy')->name('permission.delete');
    });
});