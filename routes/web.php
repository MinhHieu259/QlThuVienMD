<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Livewire\Admin\Authors\CreateAuthorForm;
use App\Http\Livewire\Admin\Authors\ListAuthorForm;
use App\Http\Livewire\Admin\Authors\UpdateAuthorForm;
use App\Http\Livewire\Admin\Books\CreateBookForm;
use App\Http\Livewire\Admin\Books\ListBookForm;
use App\Http\Livewire\Admin\Books\UpdateBookForm;
use App\Http\Livewire\Admin\Categories\CreateCategoryForm;
use App\Http\Livewire\Admin\Categories\ListCategoryForm;
use App\Http\Livewire\Admin\Categories\UpdateCategoryForm;
use App\Http\Livewire\Admin\Publishers\CreatePublisherForm;
use App\Http\Livewire\Admin\Publishers\ListPublisherForm;
use App\Http\Livewire\Admin\Publishers\UpdatePublisherForm;
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

    Route::prefix('authors')->group(function () {
        Route::get('/list', ListAuthorForm::class)->name('admin.author.list');
        Route::get('/create', CreateAuthorForm::class)->name('admin.author.create');
        Route::get('/{author}/edit', UpdateAuthorForm::class)->name('admin.author.edit');

    });

    Route::prefix('publishers')->group(function () {
        Route::get('/list', ListPublisherForm::class)->name('admin.publisher.list');
        Route::get('/create', CreatePublisherForm::class)->name('admin.publisher.create');
        Route::get('/{publisher}/edit', UpdatePublisherForm::class)->name('admin.publisher.edit');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/list', ListCategoryForm::class)->name('admin.category.list');
        Route::get('/create', CreateCategoryForm::class)->name('admin.category.create');
        Route::get('/{category}/edit', UpdateCategoryForm::class)->name('admin.category.edit');
    });

    Route::prefix('books')->group(function () {
        Route::get('/list', ListBookForm::class)->name('admin.book.list');
        Route::get('/create', CreateBookForm::class)->name('admin.book.create');
        Route::get('/{book}/edit', UpdateBookForm::class)->name('admin.book.edit');
    });
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
