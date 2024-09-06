<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Show registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Handle registration submission
Route::post('/register', [RegisterController::class, 'create']);

// Show login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle login request
Route::post('/login', [LoginController::class, 'login']);

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated Users Can Access These Routes
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Task routes
Route::middleware('auth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
});


