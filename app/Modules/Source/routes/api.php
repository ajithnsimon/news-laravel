<?php

use App\Modules\Source\Controllers\SourceController;

/**
 * User Preference Routes
 */
Route::prefix('source')->group(function () {
    /**
     * Update User Preferences
     *
     * @param SourceController $controller
     * @return \Illuminate\Http\JsonResponse
     */
    Route::middleware('auth:sanctum')->group(function () {
        
        Route::post('/sources', [SourceController::class, 'sources']);
        // Add more user preference routes as needed
        
    });
});
