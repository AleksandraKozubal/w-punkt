<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TipsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get("/dashboard", DashboardController::class)->name("dashboard");
Route::get("/series", [SeriesController::class, 'index'])->name("series.index");
Route::get("/series/create", [SeriesController::class, 'create'])->name("series.create");
Route::get("/series/{serie}", [SeriesController::class, 'show'])->name("series.show");
Route::post("/series", [SeriesController::class, 'store'])->name("series.store");
Route::get("/series/{serie}/edit", [SeriesController::class, 'edit'])->name("series.edit");
Route::patch("/series/{serie}", [SeriesController::class, 'update'])->name("series.update");
Route::delete("/series/{serie}", [SeriesController::class, 'destroy'])->name("series.destroy");
Route::get("/stats", StatsController::class)->name("stats");
Route::get("/tips", TipsController::class)->name("tips");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
