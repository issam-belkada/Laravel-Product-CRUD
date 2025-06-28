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


Route::get('show-deleted-product', [App\Http\Controllers\ProductController::class, 'showDeletedProducts'])->name('show-deleted-product');


Route::get('/restore-product/{id}', [App\Http\Controllers\ProductController::class, 'restore'])->name('restore-product');


Route::delete('/destroy-product/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy-product');



Route::get('/categories', [App\Http\Controllers\CategorysController::class, 'index'])->name('categories.index');

Route::get('/show-category-products/{id}', [App\Http\Controllers\CategorysController::class, 'showCategoryProducts'])->name('show-category-products');

Route::get('/create-category', [App\Http\Controllers\CategorysController::class, 'create'])->name('categories.create');
Route::post('/store-category', [App\Http\Controllers\CategorysController::class, 'store'])->name('store-category');
Route::get('/edit-category/{id}', [App\Http\Controllers\CategorysController::class, 'edit'])->name('edit-category');
Route::put('/update-category/{id}', [App\Http\Controllers\CategorysController::class, 'update'])->name('update-category');
Route::delete('/delete-category/{id}', [App\Http\Controllers\CategorysController::class, 'delete'])->name('delete-category');
Route::get('/show-deleted-categories', [App\Http\Controllers\CategorysController::class, 'showDeletedCategories'])->name('show-deleted-categories');
Route::get('/restore-category/{id}', [App\Http\Controllers\CategorysController::class, 'restore'])->name('restore-category');
Route::delete('/destroy-category/{id}', [App\Http\Controllers\CategorysController::class, 'destroy'])->name('destroy-category');