<?php

use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;

Route::get('/sizes', [SizeController::class, 'index']);
Route::get('/size/{id}', [SizeController::class, 'show']);
Route::post('/size', [SizeController::class, 'store']);
Route::put('/size/{id}', [SizeController::class, 'update']);
Route::delete('/size/{id}', [SizeController::class, 'destroy']);
