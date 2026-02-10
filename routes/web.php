<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubmissionController;
use App\Models\InvitationCode;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/rsvp', [SubmissionController::class, 'storeRsvp'])->name('rsvp.store');
Route::post('/love', [SubmissionController::class, 'storeLove'])->name('love.store');

// Check invitation code
Route::get('/check-code/{code}', function (string $code) {
    $invitationCode = InvitationCode::where('code', strtoupper($code))->first();
    
    if (!$invitationCode) {
        return response()->json([
            'valid' => false,
            'message' => 'Invalid code'
        ]);
    }
    
    if ($invitationCode->is_used) {
        return response()->json([
            'valid' => false,
            'used' => true,
            'message' => 'This code has already been used'
        ]);
    }
    
    return response()->json([
        'valid' => true,
        'max_guests' => $invitationCode->max_guests,
        'message' => "This code can accommodate up to {$invitationCode->max_guests} guest(s)"
    ]);
});

// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

// Protected dashboard route
Route::get('/dashboard', [SubmissionController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
