<?php

use App\Http\Controllers\EdgeController;
use Illuminate\Support\Facades\Route;

Route::get('/edges', [EdgeController::class, 'index']);
Route::get('/edge', [EdgeController::class, 'show']);
Route::post('/edge', [EdgeController::class, 'store']);
Route::put('/edge/{id}', [EdgeController::class, 'update']);
Route::delete('/edge/{id}', [EdgeController::class, 'destroy']);
