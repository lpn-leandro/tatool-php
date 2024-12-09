<?php

use App\Controllers\HomeController;
use Core\Router\Route;
use App\Controllers\AuthenticationsController;

// Authentication
Route::get('/login', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');

Route::middleware('auth')->group(function () {

Route::get('/logout', [AuthenticationsController::class, 'destroy'])->name('users.logout');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

});
