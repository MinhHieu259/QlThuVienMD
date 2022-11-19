<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');
Route::get('admin-login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('admin-register', [AuthController::class, 'registerPage'])->name('registerPage');
Route::post('do-login', [AuthController::class, 'login'])->name('doLogin');
Route::post('do-register', [AuthController::class, 'register'])->name('doRegister');
