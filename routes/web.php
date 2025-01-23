<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DecisionSupportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? view('homepage') : redirect()->route('login');
})->name('root');

Route::middleware('auth')->group(function () {
    // Homepage route for logged-in users
    Route::get('/homepage', function () {
        return view('homepage');
    })->name('homepage');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Decision Support routes
    Route::resource('decision-support', DecisionSupportController::class);

});

require __DIR__.'/auth.php';
