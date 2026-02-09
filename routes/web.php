<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/rsvp', [SubmissionController::class, 'storeRsvp'])->name('rsvp.store');
Route::post('/love', [SubmissionController::class, 'storeLove'])->name('love.store');

// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

// Protected dashboard route
Route::get('/dashboard', [SubmissionController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
