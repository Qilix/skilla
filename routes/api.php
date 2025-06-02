<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\PersonalAccessTokenController;
use Laravel\Passport\Http\Controllers\ScopeController;
use Laravel\Passport\Http\Controllers\TransientTokenController;

Route::prefix('user')->group(function () {
   Route::post('register', [AuthController::class, 'register']);
   Route::post('login', [AuthController::class, 'login']);
   Route::middleware('auth:api')->get('logout', [AuthController::class, 'logout']);
   Route::middleware('auth:api')->get('sessions', [AuthController::class, 'sessions']);
});

Route::prefix('passport')->group(function () {
    Route::get('scopes', [ScopeController::class, 'all']);

    Route::prefix('token')->group(function () {
        Route::post('', [AccessTokenController::class, 'issueToken']);
        Route::post('refresh', [TransientTokenController::class, 'refresh']);
    });

    Route::prefix('tokens')->group(function () {
        Route::get('', [AuthorizedAccessTokenController::class, 'forUser']);
        Route::delete('{token_id}', [AuthorizedAccessTokenController::class, 'destroy']);
    });

    Route::prefix('clients')->group(function () {
        Route::get('', [ClientController::class, 'forUser']);
        Route::post('', [ClientController::class, 'store']);
        Route::put('{client_id}', [ClientController::class, 'update']);
        Route::delete('{client_id}', [ClientController::class, 'destroy']);
    });

    Route::prefix('personal-access-tokens')->group(function () {
        Route::get('', [PersonalAccessTokenController::class, 'forUser']);
        Route::post('', [PersonalAccessTokenController::class, 'store']);
        Route::delete('{token_id}', [PersonalAccessTokenController::class, 'destroy']);
    });
});

Route::prefix('order')->group(function () {
    Route::middleware('auth:api')->post('', [OrderController::class, 'store']);
});