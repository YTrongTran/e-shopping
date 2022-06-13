<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/cart')->group(function () {
    Route::get('/checkout', 'Frontend\CheckoutController@index')->name('checkout.cart');

    Route::post('/register', 'Frontend\CheckoutController@getInformation')->name('check.register');
});