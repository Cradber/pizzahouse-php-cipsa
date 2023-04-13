<?php

use App\Http\Controllers\IngredientsController;
use Illuminate\Support\Facades\Route;

Route::get('/ingredients', [IngredientsController::class, 'index']);
Route::get('/ingredient/{id}', [IngredientsController::class, 'show']);
Route::post('/ingredient', [IngredientsController::class, 'store']);
Route::put('/ingredient/{id}', [IngredientsController::class, 'update']);
Route::delete('/ingredient/{id}', [IngredientsController::class, 'destroy']);
