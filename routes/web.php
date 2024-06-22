<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CekUserLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk profile, bisa diakses oleh kedua jenis pengguna
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TransactionController::class, 'create'])->name('dashboard');

    Route::prefix('cart')->group(function () {
        Route::post('{item}/add', [TransactionController::class, 'addCart'])->name('cart.add');
        Route::post('{item}/reduce', [TransactionController::class, 'reduceCart'])->name('cart.reduce');
    });

    Route::get('cart', [TransactionController::class, 'cart'])->name('transaction.cart');
    Route::resource('transaction', TransactionController::class);
    Route::get('/transaction/{transaction}/pdf', [TransactionController::class, 'generatePDF'])->name('transaction.pdf');
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transaction.destroy');

    // Route::middleware(UserMiddleware::class)->group(function () {
    //     Route::get('/dashboard', [TransactionController::class, 'create'])->name('dashboard');
        
    //     Route::prefix('cart')->group(function () {
    //         Route::post('{item}/add', [TransactionController::class, 'addCart'])->name('cart.add');
    //         Route::post('{item}/reduce', [TransactionController::class, 'reduceCart'])->name('cart.reduce');
    //     });
        
    //     Route::get('cart', [TransactionController::class, 'cart'])->name('transaction.cart');
    //     Route::resource('transaction', TransactionController::class);
    //     Route::get('/transaction/{transaction}/pdf', [TransactionController::class, 'generatePDF'])->name('transaction.pdf');
        
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });

    Route::middleware(AdminMiddleware::class)->group(function () {
        // Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
        Route::get('/items/{item}/editJson', [ItemController::class, 'editJson'])->name('items.editJson');
    
        // Route::prefix('cart')->group(function () {
        //     Route::post('{item}/add', [TransactionController::class, 'addCart'])->name('cart.add');
        //     Route::post('{item}/reduce', [TransactionController::class, 'reduceCart'])->name('cart.reduce');
        // });
    
        // Route::get('cart', [TransactionController::class, 'cart'])->name('transaction.cart');
        // Route::resource('transaction', TransactionController::class);
        // Route::get('/transaction/{transaction}/pdf', [TransactionController::class, 'generatePDF'])->name('transaction.pdf');
    
        Route::resource('user', UserController::class);
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
