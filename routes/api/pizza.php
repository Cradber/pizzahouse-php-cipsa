<?php

use App\Http\Controllers\PizzaController;
use Illuminate\Support\Facades\Route;

Route::get('/pizzas', [PizzaController::class, 'index']);
Route::get('/pizza/{id}', [PizzaController::class, 'show']);
Route::post('/pizza', [PizzaController::class, 'store']);
Route::put('/pizza/{id}', [PizzaController::class, 'update']);
Route::delete('/pizza/{id}', [PizzaController::class, 'destroy']);
