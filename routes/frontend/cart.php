<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/cart')->group(function () {
    Route::get('/showcart', 'Frontend\CartController@index')->name('cart.index');
    Route::get('/add_quantity_cart', 'Frontend\CartController@addquantitycart')->name('cart.addquantity');
    Route::get('/up_quantity_cart', 'Frontend\CartController@upquantitycart')->name('cart.upquantity');
    Route::get('/delete_quantity_cart', 'Frontend\CartController@deletedcart')->name('cart.deleted');
});