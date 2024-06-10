<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'getAll']);
Route::get('/appointment', [AppointmentController::class, 'getAll']);
Route::post('/appointment', [AppointmentController::class, 'Store']);


