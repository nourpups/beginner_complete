<?php

use App\Http\Controllers\ApiPractice\ApiAuthController;
use App\Http\Controllers\ApiPractice\ApiPracticeController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [ApiAuthController::class, 'register'])->name('api-practice.register');
Route::post('/login', [ApiAuthController::class, 'login'])->name('api-practice.register');

Route::get('/all', [ApiPracticeController::class, 'all'])->name('categories')->middleware('auth:sanctum');
Route::apiResource('api-practice', ApiPracticeController::class)->middleware('auth:sanctum');

