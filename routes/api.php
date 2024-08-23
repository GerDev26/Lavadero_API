<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Models\Appointment;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    
    Route::middleware('role:administrador')->group(function () {
        
    });
    Route::middleware('role:empleado')->group(function () {
        
    });
    Route::middleware('role:cliente')->group(function () {
    });
    
    Route::prefix('vehicles')->controller(VehicleController::class)->group(function () {
        Route::get('/', 'getAll');
        Route::get('/{id}', 'getById');
        Route::post('/', 'store');
        Route::delete('/{id}', 'Destroy');
        Route::patch('/{id}', 'Update');
    });
    
    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/', 'getAll');
        Route::get('/vehicles', 'getUserVehicles');
        Route::post('/', 'Store');
        Route::delete('/{id}', 'Destroy');
    });
    Route::get('/users/appointments', [AppointmentController::class, 'userAppointments']);
    Route::delete('appointments/{id}', [AppointmentController::class, 'Destroy']);


    Route::patch('/appointments/reserve', [ClientController::class, 'reserve']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::post('/getPasswordToken', 'getPasswordToken');
    Route::post('/resetPassword', 'resetPassword');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});




Route::get('/services', [VehicleController::class, 'getAllServices']);
Route::get('/typeOfVehicles', [VehicleController::class, 'getAllTypeOfVehicles']);




Route::get('/dates', [AppointmentController::class, 'getAllDates']);
Route::get('/appointments', [AppointmentController::class, 'getAllAppointments']);
Route::post('/appointments', [AppointmentController::class, 'adminStore']);
Route::get('/appointments/{date}', [AppointmentController::class, 'getAppointmentsByDate']);


