<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::post('/login', [AuthController::class, 'login'])->middleware(RedirectIfAuthenticated::class);
Route::get('/divisions', [DivisionController::class, 'index'])->middleware('auth:api');
Route::get('/employees', [EmployeeController::class, 'index'])->middleware('auth:api');
Route::post('/employees', [EmployeeController::class, 'store'])->middleware('auth:api');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->middleware('auth:api');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->middleware('auth:api');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

