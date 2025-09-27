<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SdgController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TaskProductivityController;

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// SDG Related Routes
Route::middleware('auth')->group(function() {
  Route::get('/sdgs', [SdgController::class, 'index'])->name('sdgs.index');
  Route::get('/sdgs/create', [SdgController::class, 'create'])->name('sdgs.create');
  Route::post('/sdgs/store', [SdgController::class, 'store'])->name('sdgs.store');
  Route::get('/sdgs/{sdg:slug}/edit', [SdgController::class, 'edit'])->name('sdgs.edit');
  Route::put('/sdgs/{sdg:slug}/update', [SdgController::class, 'update'])->name('sdgs.update');
  Route::delete('/sdgs/{sdg:slug}/delete', [SdgController::class, 'destroy'])->name('sdgs.delete');
});

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
  Route::get('/show/{goal:slug}', [GoalController::class, 'show'])->name('show');
  Route::get('/edit/{goal:slug}', [GoalController::class, 'edit'])->name('edit');
  Route::put('/update/{goal:slug}', [GoalController::class, 'update']);
  Route::delete('/delete/{goal:slug}', [GoalController::class, 'destroy']);

  Route::get('/longterm', [GoalController::class, 'viewLongTermGoals'])->name('longterm');
  Route::get('/shortterm', [GoalController::class, 'viewShortTermGoals'])->name('shortterm');
});

// Task Related Routes
Route::middleware('auth')->prefix('goals/{goal:slug}/tasks')->name('tasks.')->group(function () {
  Route::post('/create', [TaskController::class, 'store'])->name('store');
  // Route::get('/show/{task:slug}', [GoalController::class, 'showTask'])->name('show');
  Route::get('/{task:slug}/edit', [TaskController::class, 'edit'])->name('edit');
  Route::put('/{task:slug}/update', [TaskController::class, 'update'])->name('update');
  // Route::delete('/delete/{task:slug}', [GoalController::class, 'destroyTask']);
});

// Task Submission Related Routes
Route::middleware('auth')->group(function() {
  Route::get('/tasks/{task:slug}/submit', [TaskProductivityController::class, 'create'])->name('tasks.create');
  Route::post('/tasks/{task:slug}/submit', [TaskProductivityController::class, 'submit'])->name('tasks.submit');
  Route::get('/tasks/all', [TaskController::class, 'allTask'])->name('tasks.all');
});

// Validate Task Submitted
Route::middleware('auth')->group(function() {
  Route::post('/submissions/{submission:id}/approve', [TaskProductivityController::class, 'approve'])->name('submissions.approve');
  Route::post('/submissions/{submission:id}/reject', [TaskProductivityController::class, 'reject'])->name('submissions.reject');
  Route::get('/submissions/{submission:id}/resubmit', [TaskProductivityController::class, 'resubmitForm'])->name('submissions.resubmit');
  Route::put('/submissions/{productivity:id}/resubmit', [TaskProductivityController::class, 'resubmit'])->name('submissions.resubmit');
  Route::post('/request-resubmission/{task:slug}', [TaskProductivityController::class, 'requestResubmission'])->name('submissions.request-resubmission');
  Route::post('/tasks/{task:slug}/approve-resubmission', [TaskProductivityController::class, 'approveResubmissionRequest'])->name('tasks.approve-resubmission');
  Route::post('tasks/{task:slug}/reject-resubmission', [TaskProductivityController::class, 'rejectResubmissionRequest']);
  Route::get('/tasks/{task:slug}/resubmit', [TaskProductivityController::class, 'lateSubmissionForm'])->name('submissions.late-form');
  Route::put('/tasks/{task:slug}/resubmit-file', [TaskProductivityController::class, 'lateResubmission'])->name('submissions.late-submission');
});

// Report Routes
Route::middleware('auth')->group(function() {
  Route::get('/reports/compliance', [GoalController::class, 'complianceReport'])->name('reports.compliance');
  Route::get('/reports/non-compliance', [GoalController::class, 'nonComplianceReport'])->name('reports.non-compliance');
});

// Notification Routes
Route::middleware('auth')->group(function() {
  Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount']);
  Route::get('/notifications/unread', [NotificationController::class, 'unreadNotif']);
  Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead']);
});

// Profile Routes
// Route::middleware('auth')->group(function() {
//   Route::get();
// });

