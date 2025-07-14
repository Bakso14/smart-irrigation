<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MqttController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DashboardController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/mqtt-receive', [MqttController::class, 'receive']);
Route::get('/messages', [MessageController::class, 'api']);
Route::get('/sensor-nodes', [DashboardController::class, 'api']);
