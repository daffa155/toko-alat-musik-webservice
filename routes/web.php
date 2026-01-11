<?php

use App\Models\Product;
use App\Models\Order;

Route::get('/login-ui', function () {
    return view('auth.login');
});

Route::get('/products-ui', function () {
    return view('products.index', [
        'products' => Product::all()
    ]);
});

Route::get('/orders-ui', function () {
    return view('orders.index', [
        'orders' => Order::all()
    ]);
});
