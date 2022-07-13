<?php

use App\Http\Controllers\ClassProjectController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/class-project/my-class', [ClassProjectController::class, 'myClass'])
        ->name('class-project.my-class');
});
