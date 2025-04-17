<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingsController;

Route::get('/', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/settings', [SettingsController::class, 'index']); 

// Settings Related Routes
Route::middleware('auth')->prefix('settings')->name('settings.')->group(function () {
  Route::get('/users', [SettingsController::class, 'users'])->name('users');
  Route::get('/roles', [SettingsController::class, 'roles'])->name('roles');
});
