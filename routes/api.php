<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ShortenUrlController;
use App\Http\Controllers\ShortenUrlController as PublicShortenUrlController;



// User Registration
Route::post('/register', [AuthController::class, 'register']);

// User Login
Route::post('/login', [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    // Short URL Creation
    Route::post('/shorten_url', [ShortenUrlController::class, 'shortenUrl']);
});

// Short URL Redirect to Original URL
Route::get('/s/{code}', [PublicShortenUrlController::class, 'redirectToOriginal']);
