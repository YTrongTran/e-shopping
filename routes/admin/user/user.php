<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/user')->group(function () {
        Route::get('/index', 'Admin\UserController@index')->name('user.index')->middleware('can:user-list');
        Route::get('/create', 'Admin\UserController@create')->name('user.create')->middleware('can:user-add');
        Route::post('/create', 'Admin\UserController@store')->name('user.store');
        Route::get('/edit/{id}', 'Admin\UserController@editUser')->name('user.editUser')->middleware('can:user-edit');
        Route::post('/edit/{id}', 'Admin\UserController@updateUser')->name('user.updateUser');
        Route::post('/deleted/{id}', 'Admin\UserController@destroy')->name('user.delete')->middleware('can:user-delete');

        Route::get('/profile/{id}', 'Admin\UserController@edit')->name('user.edit');
        Route::post('/profile/{id}', 'Admin\UserController@update')->name('user.update');
    });
});