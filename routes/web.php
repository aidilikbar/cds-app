<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DecisionSupportController;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::resource('decision-support', DecisionSupportController::class);
