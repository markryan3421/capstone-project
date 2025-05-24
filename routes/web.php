<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SdgController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaskProductivityController;

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

// Change / Switch Tenant
Route::middleware('auth')->group(function() {
  Route::get('/sdgs/change/{tenantID}', [SdgController::class, 'changeSdg'])->name('sdgs.change');
});

// Goal Related Routes
Route::middleware('auth')->prefix('goals')->name('goals.')->group(function () {
  Route::get('/create', [GoalController::class, 'create'])->name('create');
  Route::post('/create', [GoalController::class, 'store'])->name('store');
  Route::get('/show/{goal:slug}', [GoalController::class, 'show'])->name('goals.show');
  Route::get('/edit/{goal:slug}', [GoalController::class, 'edit'])->name('edit');
  Route::put('/update/{goal:slug}', [GoalController::class, 'update']);
  Route::delete('/delete/{goal:slug}', [GoalController::class, 'destroy']);
});

// Task Related Routes
Route::middleware('auth')->prefix('goals/{goal:slug}/tasks')->name('tasks.')->group(function () {
  Route::post('/create', [TaskController::class, 'store'])->name('store');
  // Route::get('/show/{task:slug}', [GoalController::class, 'showTask'])->name('show');
  Route::get('/{task:slug}/edit', [TaskController::class, 'edit'])->name('edit');
  Route::put('/{task:slug}/update', [TaskController::class, 'update'])->name('update');
  // Route::delete('/delete/{task:slug}', [GoalController::class, 'destroyTask']);
});

// Task Productivity Related Routes
Route::middleware('auth')->group(function() {
  Route::get('/tasks/{task:slug}/submit', [TaskProductivityController::class, 'create'])->name('tasks.create');
  Route::post('/tasks/{task:slug}/submit', [TaskProductivityController::class, 'store'])->name('tasks.submit');
});