<?php

use App\Http\Controllers\ApiV1\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::post('users:search', [UserController::class, 'index']);
Route::get('users/{id}/followers', [UserController::class, 'followers']);
Route::get('users/{id}/following', [UserController::class, 'following']);
Route::post('users/{id}/follow', [UserController::class, 'followUser']);
Route::post('users/{id}/unfollow', [UserController::class, 'unfollowUser']);
