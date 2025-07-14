<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/messages', [MessageController::class, 'index']);