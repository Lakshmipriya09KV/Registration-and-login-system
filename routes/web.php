<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\loginController;

Route::get('/',[employeeController::class, 'register']);
Route::post('/register', [employeeController::class, 'store']);

Route::get('/login',[loginController::class, 'login']);
Route::post('/login', [loginController::class, 'validate_log']);
Route::get('/users-list', [loginController::class, 'usersList']);
Route::get('/get-users-list', [loginController::class, 'getusersList']);
Route::post('/logout', [loginController::class, 'logout']);
