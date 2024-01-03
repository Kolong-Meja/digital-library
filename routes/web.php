<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::prefix('library')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.index');
    
    Route::get('/roles', [RoleController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('role.index');
    Route::post('/roles', [RoleController::class, 'store'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('role.store');
    Route::put('/roles', [RoleController::class, 'update'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('role.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('role.delete');

    Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('user.index');
    Route::post('/users', [UserController::class, 'store'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('user.store');
    Route::put('/users', [UserController::class, 'update'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('user.delete');

    Route::get('/categories', [CategoryController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('category.index');
    Route::post('/categories', [CategoryController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('category.store');
    Route::put('/categories', [CategoryController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('category.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('category.delete');

    Route::get('/books', [BookController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('book.index');
    Route::get('/books/view', [BookController::class, 'view'])
    ->middleware(['auth', 'verified'])
    ->name('book.view');
    Route::post('/books', [BookController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('book.store');
    Route::put('/books', [BookController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('book.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('book.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
