<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user', [UserController::class, 'getAll']);

Route::get('/vehicle', [VehicleController::class, 'getAll']);
Route::get('/vehicle/{id}', [VehicleController::class, 'getById']);
Route::post('/vehicle', [VehicleController::class, 'Store']);

Route::get('/appointment', [AppointmentController::class, 'getAll']);
Route::post('/appointment', [AppointmentController::class, 'Store']);
