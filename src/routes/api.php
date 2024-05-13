<?php

use App\Http\Controllers\ApiV1\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::post('users:search', [UserController::class, 'index']);
