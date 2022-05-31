<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/account')->group(function () {
    Route::get('/member/{id}', 'Frontend\MemberController@edit')->name('frontend.member.edit');
    Route::post('/member/{id}', 'Frontend\MemberController@update')->name('frontend.member.update');
});