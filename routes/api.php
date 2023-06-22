<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SuppliesController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::controller(ProductController::class)->group(function (){
    Route::post('/product', 'store');
    Route::get('/products', 'index');
    Route::get('/product/{product}', 'show');
    Route::put('/product/{product}', 'update');
    Route::delete('/product/{product}', 'destroy');
})->middleware('auth');

Route::controller(ProviderController::class)->group(function (){
    Route::post('/provider', 'store');
    Route::get('/providers', 'index');
    Route::get('/provider/{provider}', 'show');
    Route::put('/provider/{provider}', 'update');
    Route::delete('/provider/{provider}', 'destroy');
})->middleware('auth');

Route::controller(OrderController::class)->group(function (){
    Route::post('/order', 'store');
    Route::get('/orders', 'index');
    Route::get('/order/{order}', 'show');
    Route::put('/order/{order}', 'update');
    Route::delete('/order/{order}', 'destroy');
})->middleware('auth');

Route::controller(SuppliesController::class)->group(function (){
    Route::post('/supply', 'store');
    Route::get('/supplies', 'index');
    Route::get('/supply/{supplies}', 'show');
    Route::put('/supply/{supplies}', 'update');
    Route::delete('/supply/{supplies}', 'destroy');
})->middleware('auth');
