<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingsController;

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// Settings Related Routes
Route::middleware('auth')->prefix('settings')->name('settings.')->group(function () {

  // Role Related Routes
  Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
  Route::get('/roles/add-role', [RoleController::class, 'create'])->name('roles.create-role');
  Route::post('/roles/add-role', [RoleController::class, 'store']);
  Route::get('/roles/single-role/{role:id}', [RoleController::class, 'show'])->name('roles.show-role');
  Route::get('/roles/single-role/{role:id}/edit', [RoleController::class, 'edit'])->name('roles.edit-role');
  Route::put('/roles/single-role/{role:id}', [RoleController::class, 'update']);
  Route::delete('/roles/single-role/{role:id}/delete', [RoleController::class, 'destroy']);

  // User Related Routes
  Route::get('/users', [UserController::class, 'index'])->name('users.index');
  Route::get('/users/create-user', [UserController::class, 'create'])->name('users.create-user');
  Route::post('/users/create-user', [UserController::class, 'store']);
  Route::get('/users/{user:user_slug}', [UserController::class, 'show'])->name('users.show-user');
  Route::get('/users/{user:user_slug}/edit', [UserController::class, 'edit'])->name('users.edit-user');
  Route::put('/users/{user:user_slug}', [UserController::class, 'update']);
  Route::put('/users/{user:user_slug}/assign-role', [UserController::class, 'assignRole']);
  Route::delete('/users/{user:user_slug}/delete', [UserController::class, 'destroy']);
});

Route::get('/sdg/no-poverty', function() {
  return view('sdg.1-NoPoverty.index');
});