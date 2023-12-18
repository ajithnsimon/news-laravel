<?php

use App\Modules\Author\Controllers\AuthorController;

/**
 * User Preference Routes
 */
Route::prefix('author')->group(function () {
    /**
     * Update User Preferences
     *
     * @param AuthorController $controller
     * @return \Illuminate\Http\JsonResponse
     */
    Route::middleware('auth:sanctum')->group(function () {
        
        Route::post('/authors', [AuthorController::class, 'authors']);
        // Add more user preference routes as needed
        
    });
});
