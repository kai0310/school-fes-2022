<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginWithGoogleController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::view('/login', 'auth.login')->name('login');

    // Login with Google...
    Route::get('auth/google', [LoginWithGoogleController::class, 'redirectToGoogle'])
        ->name('auth.google');

    Route::get('auth/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback']);
});


Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
