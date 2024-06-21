<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk visitor
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TransactionController::class, 'create'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::prefix('cart')->group(function () {
        Route::post('{item}/add', [TransactionController::class, 'addCart'])->name('cart.add');
        Route::post('{item}/reduce', [TransactionController::class, 'reduceCart'])->name('cart.reduce');
    });
    
    Route::get('cart', [TransactionController::class, 'cart'])->name('transaction.cart');
    Route::resource('transaction', TransactionController::class);
    Route::get('/transaction/{transaction}/pdf', [TransactionController::class, 'generatePDF'])->name('transaction.pdf');
});

// Rute untuk admin
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboar', [ItemController::class, 'index'])->name('items.index');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::get('/items/{item}/editJson', [ItemController::class, 'editJson'])->name('items.editJson');

    // Route untuk pengelolaan pengguna oleh admin
    Route::resource('user', UserController::class);
});


require __DIR__ . '/auth.php';
