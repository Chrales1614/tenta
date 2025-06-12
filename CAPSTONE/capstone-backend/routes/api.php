<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\InventoryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Patient Routes
Route::apiResource('patients', PatientController::class);

// Appointment Routes
Route::apiResource('appointments', AppointmentController::class);

// Inventory Routes
Route::apiResource('inventory', InventoryController::class);
Route::get('inventory/low-stock', [InventoryController::class, 'lowStock']); 