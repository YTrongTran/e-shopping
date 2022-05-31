<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/login')->group(function () {
    Route::get('/create', 'Frontend\LoginController@create')->name('frontend.login.create');
    Route::post('/create', 'Frontend\LoginController@store')->name('frontend.login.register');
    Route::post('/', 'Frontend\LoginController@login')->name('frontend.login');
    Route::get('/logout', 'Frontend\LoginController@logout')->name('frontend.logout');
});