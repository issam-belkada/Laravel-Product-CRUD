<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

Route::get('/create-product', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');

Route::post('/store-product', [App\Http\Controllers\ProductController::class,'store'])->name('store-product');