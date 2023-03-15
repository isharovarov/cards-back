<?php

use App\Http\Api\V1\Controllers\AuthController;
use App\Http\Api\V1\Controllers\RegistrationController;
use App\Http\Api\V1\Controllers\ResetPasswordController;
use App\Http\Api\V1\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('', [AuthController::class, 'login']);
    Route::delete('', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::prefix('registration')->group(function () {
        Route::post('', [RegistrationController::class, 'registration']);
    });

    Route::prefix('password-recovery')->group(function () {
        Route::post('', [ResetPasswordController::class, 'sendResetLink']);
        Route::post('confirm', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
    });
});


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('', [UserController::class, 'show']);
        Route::post('', [UserController::class, 'update']);
    });
});
