<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\AuthController;

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/dashboard', [WebController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [WebController::class, 'logout'])->name('logout');
});
// Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/login', [WebController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::get('/dashboard', [WebController::class, 'dashboard'])->middleware('auth:api')->name('dashboard');
// Route::post('/logout', [WebController::class, 'logout'])->middleware('auth:api')->name('logout');
