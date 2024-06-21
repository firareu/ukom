<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransacationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TransactionController::class, 'create'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('cart')->group(function(){
        Route::post('{item}/add', [TransactionController::class, 'addCart'])->name('cart.add');
        Route::post('{item}/reduce', [TransactionController::class, 'reduceCart'])->name('cart.reduce');
    });

    Route::get('cart', [TransactionController::class, 'cart'])->name('transaction.cart');
    Route::resource('transaction', TransactionController::class);

    Route::middleware(AdminMiddleware::class)->group(function(){
        Route::resource('user', UserController::class);
    });
});


require __DIR__.'/auth.php';
