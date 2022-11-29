<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;


Route::prefix('auth')->group(
    function () {

        Route::group(
            [
                // 'middleware' => ['guest'],
            ],
            function ($router) {
                Route::post('/login', [AuthenticatedSessionController::class, 'store']);

                Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);

                Route::post(
                    '/password-forgotten',
                    [
                        PasswordResetLinkController::class,
                        'store',
                    ]
                );

                Route::post(
                    '/reset-password',
                    [
                        NewPasswordController::class,
                        'store',
                    ]
                );
            }
        );

        Route::group(
            [
                'middleware' => ['auth:sanctum'],
            ],
            function ($router) {

                Route::get(
                    '/profile',
                    [
                        UserController::class,
                        'getMe',
                    ]
                );

                Route::post(
                    '/profile/personal-info',
                    [
                        UserController::class,
                        'updatePersonalInfo',
                    ]
                );

                Route::post(
                    '/profile/security',
                    [
                        UserController::class,
                        'updateSecurity',
                    ]
                );
            }
        );
    }
);
