<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TypeOfVehicleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('role:administrador')->group(function () {
        
    });
    Route::middleware('role:empleado')->group(function () {

    });
    Route::middleware('role:cliente')->group(function () {

    });
    
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/vehicles', [VehicleController::class, 'getAll']);

Route::get('/users', [UserController::class, 'getAll']);
Route::post('/users', [UserController::class, 'Store']);
Route::delete('/users/{id}', [UserController::class, 'Destroy']);

Route::get('/vehicles/{id}', [VehicleController::class, 'getById']);
Route::post('/vehicles', [VehicleController::class, 'Store']);

Route::get('/appointments', [AppointmentController::class, 'getAll']);
Route::post('/appointments', [AppointmentController::class, 'Store']);

Route::get('/services', [ServiceController::class, 'getAll']);
Route::get('/typeOfVehicles', [TypeOfVehicleController::class, 'getAll']);