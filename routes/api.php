<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Protected routes
Route::middleware(['auth:api'])->group(function () {

    // Auth management routes
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Book routes accessible to both admin and user
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::post('/books/{id}/rent', [BookController::class, 'rent']);
    Route::post('/books/{id}/return', [BookController::class, 'return']);

    // Book routes accessible to admin only
    Route::middleware('role:admin')->group(function () {
        Route::post('/books', [BookController::class, 'store']);
    });
});
