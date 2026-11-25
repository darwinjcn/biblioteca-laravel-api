<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('books', BookController::class);

Route::get('categories', [CategoryController::class, 'index']);
Route::post('categories', [CategoryController::class, 'store']);
Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
