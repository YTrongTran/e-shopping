<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/user')->group(function () {
        Route::get('/index', 'Admin\UserController@index')->name('user.index');
        Route::get('/create', 'Admin\UserController@create')->name('user.create');
        Route::post('/create', 'Admin\UserController@store')->name('user.store');
        Route::get('/edit/{id}', 'Admin\UserController@editUser')->name('user.editUser');
        Route::post('/edit/{id}', 'Admin\UserController@updateUser')->name('user.updateUser');
        Route::get('/profile/{id}', 'Admin\UserController@edit')->name('user.edit');
        Route::post('/profile/{id}', 'Admin\UserController@update')->name('user.update');
        Route::post('/deleted/{id}', 'Admin\UserController@destroy')->name('user.delete');
    });
});