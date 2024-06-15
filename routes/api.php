<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
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
    Route::get('/user', [UserController::class, 'getAll']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/vehicle', [VehicleController::class, 'getAll']);

Route::post('/user', [UserController::class, 'Store']);

Route::get('/vehicle/{id}', [VehicleController::class, 'getById']);
Route::post('/vehicle', [VehicleController::class, 'Store']);

Route::get('/appointment', [AppointmentController::class, 'getAll']);
Route::post('/appointment', [AppointmentController::class, 'Store']);
