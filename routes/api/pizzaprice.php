<?php

use App\Http\Controllers\PizzaPriceController;
use Illuminate\Support\Facades\Route;

Route::get('/pizzaprices', [PizzaPriceController::class, 'index']);
Route::get('/pizzaprice/{id}', [PizzaPriceController::class, 'show']);
Route::get('/pizzaprice', [PizzaPriceController::class, 'priceByQuery']);

Route::post('/pizzaprice', [PizzaPriceController::class, 'store']);

Route::put('/pizzaprice/{id}', [PizzaPriceController::class, 'update']);

Route::delete('/pizzaprice/{id}', [PizzaPriceController::class, 'destroy']);
