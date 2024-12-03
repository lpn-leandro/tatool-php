<?php

use App\Controllers\HomeController;
use Core\Router\Route;
use App\Controllers\AuthenticationController;

// Authentication
Route::get('/login', [AuthenticationController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('users.authenticate');

Route::middleware('auth')->group(function () {

Route::get('/logout', [AuthenticationController::class, 'destroy'])->name('users.logout');

Route::get('/', [HomeController::class, 'index'])->name('root');

});