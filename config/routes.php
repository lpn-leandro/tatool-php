<?php

use App\Controllers\HomeController;
use Core\Router\Route;
use App\Controllers\AuthenticationsController;

// Authentication
Route::get('/login', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');
Route::get('/logout', [AuthenticationsController::class, 'destroy'])->name('users.logout');


Route::middleware('user')->group(callback: function () {
    Route::get('/user', [HomeController::class, 'index'])->name('home.userIndex');
});

Route::middleware('tattooist')->group(function () {
    Route::get('/tattooist', [HomeController::class, 'index'])->name('home.tattooistIndex');
});
