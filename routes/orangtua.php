<?php

use App\Http\Controllers\OrangtuaController;
use Illuminate\Support\Facades\Route;



// Route::get('dashboard', [OrangtuaController::class, 'dashboardParent'])->name('dashboard');
Route::middleware(['auth', 'checkRole:2'])->group(function () {
    Route::get('/dashboard', fn() => view('parent.dashboard'))->name('dashboard');
});

Route::middleware(['auth', 'checkRole:2'])->group(function () {
    Route::get('/dashboard', [OrangtuaController::class, 'dashboardParent'])->name('dashboard');
});
Route::get('update-password', [OrangtuaController::class, 'UpdatePassword'])->name('update-password');
Route::put('update-password/{id}', [OrangtuaController::class, 'update'])->name('put-update-password');

Route::resource('progress-santri', OrangtuaController::class);
