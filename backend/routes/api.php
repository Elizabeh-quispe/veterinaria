<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\AuthController;


Route::apiResource('propietarios',PropietarioController ::class);
Route::apiResource('mascotas', MascotaController::class);
Route::apiResource('citas', CitaController::class);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);