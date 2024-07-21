<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', RegisterController::class)->name('register');

Route::post('/login', LoginController::class)->name('login');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth:api');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth:api');

Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
