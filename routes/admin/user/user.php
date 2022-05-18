<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/user')->group(function () {
        Route::get('/profile/{id}', 'Admin\UserController@edit')->name('user.edit');
        Route::post('/profile/{id}', 'Admin\UserController@update')->name('user.update');
    });
});