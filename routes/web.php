<?php

use App\Http\Controllers\ClassProjectController;
use App\Http\Controllers\Markdown\PrivacyPolicyController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::redirect('/', 'login');

Route::get('privacy-policy', PrivacyPolicyController::class)
    ->name('privacy-policy');

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');


    Route::prefix('/class-projects')
        ->name('class-project.')
        ->group(function () {

            Route::get('/', [ClassProjectController::class, 'index'])->name('index');

            Route::get('my-class', [ClassProjectController::class, 'myClass'])->name('my-class');
        });
});
