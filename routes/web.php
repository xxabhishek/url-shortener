<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Users
    Route::resource('users', UserController::class)->except(['show']);

    //URL's
    Route::get('/short-urls', [ShortUrlController::class, 'index']);
    Route::get('/short-urls/create', [ShortUrlController::class, 'create']);
    Route::post('/short-urls', [ShortUrlController::class, 'store']);

    //Invites
    Route::get('/invite', [InvitationController::class, 'create']);
    Route::post('/invite', [InvitationController::class, 'store']);
});
Route::get('/{code}', [ShortUrlController::class, 'redirect']);


require __DIR__.'/auth.php';
