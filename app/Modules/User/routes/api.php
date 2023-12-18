<?php

use App\Modules\User\Controllers\UserController;

/**
 * User Routes
 */
Route::prefix('user')->group(function () {
    /**
     * Register User
     *
     * @param \Modules\User\Controllers\UserController $controller
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    Route::post('/register', [UserController::class, 'register']);
    // Add more routes as needed
});
