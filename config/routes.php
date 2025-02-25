<?php

use App\Controllers\HomeController;
use App\Controllers\Tattooists\AppointmentsController as TattooistsAppointmentsController;
use App\Controllers\Tattooists\ProfileController as TattooistsProfileController;
use App\Controllers\Users\AppointmentsController as UsersAppointmentsController;
use App\Controllers\Users\ProfileController as UsersProfileController;
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
    Route::get('/user/appointments', [UsersAppointmentsController::class, 'index'])
        ->name('home.appointments');

    // Create User Appointment
    Route::get('/users/appointments/new', [UsersAppointmentsController::class, 'new'])
        ->name('user.appointments.new');
    Route::post('/users/appointments', [UsersAppointmentsController::class, 'create'])
        ->name('user.appointments.create');

    // Retrieve User Appointment
    Route::get('/users/appointments', [UsersAppointmentsController::class, 'index'])
        ->name('user.appointments.index');
    Route::get('/users/appointments/page/{page}', [UsersAppointmentsController::class, 'index'])
        ->name('user.appointments.paginate');
    Route::get('/users/appointments/{id}', [UsersAppointmentsController::class, 'show'])
        ->name('user.appointments.show');

    // Update User Appointment
    Route::get('/users/appointments/{id}/edit', [UsersAppointmentsController::class, 'edit'])
        ->name('user.appointments.edit');
    Route::put('/users/appointments/{id}', [UsersAppointmentsController::class, 'update'])
        ->name('user.appointments.update');

    // Delete User Appointment
    Route::delete('/users/appointments/{id}', [UsersAppointmentsController::class, 'destroy'])
        ->name('user.appointments.destroy');

        // User Profile
    Route::get('/users/profile', [UsersProfileController::class, 'show'])
    ->name('user.profile.show');
    Route::post('/users/profile/avatar', [UsersProfileController::class, 'updateAvatar'])
    ->name('user.profile.avatar');
});

Route::middleware('tattooist')->group(function () {
    Route::get('/tattooist', [HomeController::class, 'index'])->name('tattooists.home');
    Route::get('/tattooist/appointments', [TattooistsAppointmentsController::class, 'index'])
        ->name('tattooists.appointments.index');

    // Create Tattooist Appointment
    Route::get('/tattooist/appointments/new', [TattooistsAppointmentsController::class, 'new'])
        ->name('tattooists.appointments.new');
    Route::post('/tattooist/appointments', [TattooistsAppointmentsController::class, 'create'])
        ->name('tattooists.appointments.create');

    // Retrieve Tattooist Appointment
    Route::get('/tattooist/appointments', [TattooistsAppointmentsController::class, 'index'])
        ->name('tattooists.appointments.index');
    Route::get('/tattooist/appointments/page/{page}', [TattooistsAppointmentsController::class, 'index'])
        ->name('tattooists.appointments.paginate');
    Route::get('/tattooist/appointments/{id}', [TattooistsAppointmentsController::class, 'show'])
        ->name('tattooists.appointments.show');

    // Update Tattooist Appointment
    Route::get('/tattooist/appointments/{id}/edit', [TattooistsAppointmentsController::class, 'edit'])
        ->name('tattooists.appointments.edit');
    Route::put('/tattooist/appointments/{id}', [TattooistsAppointmentsController::class, 'update'])
        ->name('tattooists.appointments.update');

    // Delete Tattooist Appointment
    Route::delete('/tattooist/appointments/{id}', [TattooistsAppointmentsController::class, 'destroy'])
        ->name('tattooists.appointments.destroy');

        // Tattooists Profile
    Route::get('/tattooist/profile', [TattooistsProfileController::class, 'show'])
    ->name('tattooist.profile.show');
    Route::post('/tattooist/profile/avatar', [TattooistsProfileController::class, 'updateAvatar'])
    ->name('tattooist.profile.avatar');

    // Rotas para Appointments
    Route::get('/tattooists/appointments', [TattooistsAppointmentsController::class, 'index'])
        ->name('tattooists.appointments.index');
    Route::get('/tattooists/appointments/page/{page}', [TattooistsAppointmentsController::class, 'index'])
        ->name('tattooists.appointments.paginate');
});
