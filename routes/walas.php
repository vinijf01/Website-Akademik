<?php

use App\Http\Controllers\WalasController;
use App\Http\Controllers\Walas\HafalanController;
use App\Http\Controllers\Walas\RaportController;
use Illuminate\Support\Facades\Route;

// Route::get('dashboard', [WalasController::class, 'dashboardWalas'])->name('dashboard');
// Route::middleware(['auth', 'checkRole:3'])->group(function () {
//     Route::get('/dashboard', fn() => view('walas.dashboard'))->name('walas.dashboard');
// });

Route::middleware(['auth', 'checkRole:3'])->group(function () {
    Route::get('/dashboard', [WalasController::class, 'dashboardWalas'])->name('dashboard');
});

Route::get('update-password', [WalasController::class, 'UpdatePassword'])->name('update-password');
Route::put('update-password/{id}', [WalasController::class, 'update'])->name('put-update-password');

Route::resource('/', WalasController::class);
Route::resource('raport-santri', RaportController::class);
Route::get('raport-santri/detail/{id_santri}', [RaportController::class, 'detail'])->name('raport.detail');
Route::resource('hafalan-santri', HafalanController::class);
