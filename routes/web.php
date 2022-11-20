<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('access-denied', [PageController::class, 'accessDenied']);
Route::get('admin-login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('admin-register', [AuthController::class, 'registerPage'])->name('registerPage');
Route::post('do-login', [AuthController::class, 'login'])->name('doLogin');
Route::post('do-register', [AuthController::class, 'register'])->name('doRegister');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');
});


