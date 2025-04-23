<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\CategoryController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Registration Routes
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Main dashboard route - redirects based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->isAdmin() || $user->isManager()) {
            return redirect()->route('manager.dashboard');
        } else {
            return redirect()->route('staff.dashboard');
        }
    })->name('dashboard');
    
    // Manager Dashboard - restrict to managers and admins
    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])
        ->middleware(CheckUserRole::class . ':manager')
        ->name('manager.dashboard');
    
    // Staff Dashboard
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])
        ->name('staff.dashboard');

    // User Management Routes - restrict to managers and admins
    Route::middleware(CheckUserRole::class . ':manager')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::put('/users/{user}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
        Route::put('/users/{user}/unsuspend', [UserController::class, 'unsuspend'])->name('users.unsuspend');
    });

    Route::get('/inventory', [App\Http\Controllers\InventoryController::class, 'index'])->name('inventory.index');

    // Category routes
    Route::resource('categories', CategoryController::class);
});
