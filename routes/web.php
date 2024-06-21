<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('books.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/', function () {
        return redirect()->route('books.index');
    });
    
    Route::resource('books', BookController::class)
        ->only(['index', 'show']);
    
    Route::resource('books.reviews', ReviewController::class)
        ->scoped(['review' => 'book'])
        ->only(['create', 'store']);

    // Admin access
    // Route::middleware('is_admin')->group(function () {
    //     // Admin routes
    // });
});

require __DIR__.'/auth.php';
