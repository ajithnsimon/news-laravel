<?php

use App\Modules\Category\Controllers\CategoryController;

/**
 * User Preference Routes
 */
Route::prefix('category')->group(function () {
    /**
     * Update User Preferences
     *
     * @param CategoryController $controller
     * @return \Illuminate\Http\JsonResponse
     */
    Route::middleware('auth:sanctum')->group(function () {
        
        Route::post('/categories', [CategoryController::class, 'categories']);
        // Add more user preference routes as needed
        
    });
});
