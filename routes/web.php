<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login.page');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.page');
    Route::post('/register', [AuthController::class, 'register'])->name('register.save');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login.page');
    Route::post('/login', [AuthController::class, 'login'])->name('login.check');
});

// Auth Required Routes
Route::middleware('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Super Admin Only
    Route::middleware('role:super-admin')->group(function () {
        Route::get('/super-admin/dashboard', function(){
            return view('dashboard.superadmin');
        })->name('super.dashboard');
    });

    // Admin Only
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function(){
            return view('dashboard.admin');
        })->name('admin.dashboard');
    });

    // Customer Only
    Route::middleware('role:customer')->group(function () {
        Route::get('/customer/profile', function(){
            return view('customer.profile');
        })->name('customer.profile');
    });

});
