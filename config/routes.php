<?php

use App\Controllers\Tattooists\AppointmentsController as TattooistsAppointmentsController;
use App\Controllers\Users\AppointmentsController as UsersAppointmentsController;
use App\Controllers\HomeController;
use Core\Router\Route;
use App\Controllers\AuthenticationsController;

// Authentication
Route::get('/login', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');
Route::get('/logout', [AuthenticationsController::class, 'destroy'])->name('users.logout');

Route::get('/', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');
Route::get('/', [AuthenticationsController::class, 'destroy'])->name('users.logout');


Route::middleware('user')->group(callback: function () {
    Route::get('/user', [HomeController::class, 'index'])->name('home.userIndex');
    Route::get('/user/appointments', [UsersAppointmentsController::class, 'index'])->name('home.appointments');
});

Route::middleware('tattooist')->group(function () {
    Route::get('/tattooist', [HomeController::class, 'index'])->name('tattooist.home');

    Route::get('/tattooist/appointments', [TattooistsAppointmentsController::class, 'index'])->name('tattooist.appointments.index');
});

// Create
Route::get('/appointments/new', [UsersAppointmentsController::class, 'new'])->name('appointments.new');
Route::post('/appointments', [UsersAppointmentsController::class, 'create'])->name('appointments.create');

// Retrieve
Route::get('/appointments', [UsersAppointmentsController::class, 'index'])->name('appointments.index');
Route::get('/appointments/page/{page}', [UsersAppointmentsController::class, 'index'])->name('appointments.paginate');
Route::get('/appointments/{id}', [UsersAppointmentsController::class, 'show'])->name('appointments.show');

// Update
Route::get('/appointments/{id}/edit', [UsersAppointmentsController::class, 'edit'])->name('appointments.edit');
Route::put('/appointments/{id}', [UsersAppointmentsController::class, 'update'])->name('appointments.update');

// Delete
Route::delete('/appointments/{id}', [UsersAppointmentsController::class, 'destroy'])->name('appointments.destroy');
