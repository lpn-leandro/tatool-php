<?php

use App\Controllers\HomeController;
use Core\Router\Route;

// Authentication
Route::get('/', [HomeController::class, 'index'])->name('root');

// Authentication
Route::get('/login', [AuthenticationController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('users.authenticate');
Route::get('/logout', [AuthenticationController::class, 'destroy'])->name('users.logout');
