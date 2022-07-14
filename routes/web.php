<?php

use App\Http\Controllers\ClassProjectController;
use App\Http\Controllers\Markdown\PrivacyPolicyController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('privacy-policy', PrivacyPolicyController::class)
    ->name('privacy-policy');

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/class-project/my-class', [ClassProjectController::class, 'myClass'])
        ->name('class-project.my-class');
});
