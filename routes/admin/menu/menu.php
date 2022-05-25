<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/menu')->group(function () {
        Route::get('/index', 'Admin\MenuController@index')->name('menu.index')->middleware('can:menu-list');

        Route::get('/create', 'Admin\MenuController@create')->name('menu.create')->middleware('can:menu-add');

        Route::post('/create', 'Admin\MenuController@store')->name('menu.store');
        Route::get('/edit/{id}', 'Admin\MenuController@edit')->name('menu.edit')->middleware('can:menu-edit');

        Route::post('/edit/{id}', 'Admin\MenuController@update')->name('menu.update')->middleware('can:menu-edit');

        Route::post('/delete/{id}', 'Admin\MenuController@destroy')->name('menu.delete')->middleware('can:menu-delete');
    });
});