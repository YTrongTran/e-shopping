<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/ajax')->group(function () {

    Route::post('/comment/{blog_id}', 'Frontend\AjaxController@comment')->name('ajax.comment');
});