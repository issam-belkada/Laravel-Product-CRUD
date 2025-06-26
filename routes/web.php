<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

Route::get('/create-product', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');

Route::post('/store-product', [App\Http\Controllers\ProductController::class,'store'])->name('store-product');

Route::get('/show-product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('show-product');

Route::get('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit-product');

Route::put('/update-product/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update-product');

Route::delete('/delete-product/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('delete-product');