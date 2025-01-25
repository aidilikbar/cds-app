<?php

use App\Http\Controllers\DecisionSupportController;
use Illuminate\Support\Facades\Route;

Route::get('/decision-support', [DecisionSupportController::class, 'apiIndex']);
Route::post('/decision-support', [DecisionSupportController::class, 'apiStore']);
Route::get('/decision-support/{id}', [DecisionSupportController::class, 'apiShow']);
Route::put('/decision-support/{id}', [DecisionSupportController::class, 'apiUpdate']);
Route::delete('/decision-support/{id}', [DecisionSupportController::class, 'apiDestroy']);