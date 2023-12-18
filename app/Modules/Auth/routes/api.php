<?php

use App\Modules\Auth\Controllers\AuthController;

Route::prefix('auth')->group(function () {
    
    // Grouped routes related to authentication handled by AuthController

    Route::middleware('guest')->group(function () {
        /**
         * Login
         *
         * @method POST
         * @uri /auth/login
         * @action AuthController@login
         */
        Route::post('login', [AuthController::class, 'login']);

        // Add more routes for guest users as needed
    });

    Route::middleware('auth:sanctum')->group(function () {
        /**
         * Logout
         *
         * @method POST
         * @uri /auth/logout
         * @action AuthController@logout
         */
        Route::post('logout', [AuthController::class, 'logout']);

        // Add more routes for guest users as needed
    });

});
