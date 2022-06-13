<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('/manager-order')->group(function () {
        Route::get('/index', 'Admin\ManagerOrderController@index')->name('manager-order.index');
        Route::get('/show/{order_code}', 'Admin\ManagerOrderController@show')->name('manager-order.show');
        Route::get('/print_code/{order_code}', 'Admin\ManagerOrderController@print_code')->name('manager-order.print_code');
        Route::post('/delete/{id}', 'Admin\ManagerOrderController@destroy')->name('manager-order.delete');

        Route::get('/update_quantity', 'Admin\ManagerOrderController@update_quantity')->name('manager-order.update_quantity');
    });
});