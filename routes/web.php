<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/rsvp', [SubmissionController::class, 'storeRsvp'])->name('rsvp.store');
Route::post('/love', [SubmissionController::class, 'storeLove'])->name('love.store');
Route::get('/dashboard', [SubmissionController::class, 'dashboard'])->name('dashboard');
