<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// -- Rutas para categorías --
Route::apiResource('categories', CategoryController::class);

// -- Rutas para posts --
Route::apiResource('posts', PostController::class);

// -- Ruta mostrar post y su categoría --
Route::apiResource('posts-category', PostCategoryController::class)->only(['show']);