<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/role')->group(function () {
        Route::get('/index', 'Admin\RoleController@index')->name('role.index');
        Route::get('/create', 'Admin\RoleController@create')->name('role.create');
        Route::post('/create', 'Admin\RoleController@store')->name('role.store');
        Route::get('/edit/{id}', 'Admin\RoleController@edit')->name('role.edit');
        Route::post('/edit/{id}', 'Admin\RoleController@update')->name('role.update');
        Route::post('/delete/{id}', 'Admin\RoleController@destroy')->name('role.delete');
    });
});