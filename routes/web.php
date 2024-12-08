<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TipsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get("/dashboard", DashboardController::class)->name("dashboard");
Route::get("/records", RecordsController::class)->name("records");
Route::get("/stats", StatsController::class)->name("dashboard");
Route::get("/tips", TipsController::class)->name("dashboard");
