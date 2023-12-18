<?php

use App\Modules\UserPreference\Controllers\UserPreferenceController;

/**
 * User Preference Routes
 */
Route::prefix('userpreference')->group(function () {
    /**
     * Update User Preferences
     *
     * @param UserPreferenceController $controller
     * @return \Illuminate\Http\JsonResponse
     */
    Route::middleware('auth:sanctum')->group(function () {
        
        Route::post('/preferences', [UserPreferenceController::class, 'updateUserPreference']);
        // Add more user preference routes as needed
        
    });
});
