<?php

use App\Controllers\AppointmentsController;
use App\Controllers\HomeController;
use Core\Router\Route;
use App\Controllers\AuthenticationsController;

// Authentication
Route::get('/login', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');
Route::get('/logout', [AuthenticationsController::class, 'destroy'])->name('users.logout');


Route::middleware('user')->group(callback: function () {
    Route::get('/user', [HomeController::class, 'index'])->name('home.userIndex');
    Route::get('/user/appointments', [AppointmentsController::class, 'appointments'])->name('home.appointments');
});

Route::middleware('tattooist')->group(function () {
    Route::get('/tattooist', [HomeController::class, 'index'])->name('home.tattooistIndex');

    Route::get('/tattooist/appointments', [AppointmentsController::class, 'appointments'])->name('home.tattooistAppointments');
});

// Create
Route::get('/appointments/new', [AppointmentsController::class, 'new'])->name('appointments.new');
Route::post('/appointments', [AppointmentsController::class, 'create'])->name('appointments.create');

// Retrieve
Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');
Route::get('/appointments/page/{page}', [AppointmentsController::class, 'index'])->name('appointments.paginate');
Route::get('/appointments/{id}', [AppointmentsController::class, 'show'])->name('appointments.show');

// Update
Route::get('/appointments/{id}/edit', [AppointmentsController::class, 'edit'])->name('appointments.edit');
Route::put('/appointments/{id}', [AppointmentsController::class, 'update'])->name('appointments.update');

// Delete
Route::delete('/appointments/{id}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');