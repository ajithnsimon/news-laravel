<?php

use App\Modules\Article\Controllers\ArticleController;

/**
 * User Preference Routes
 */
Route::prefix('article')->group(function () {
    /**
     * Update User Preferences
     *
     * @param ArticleController $controller
     * @return \Illuminate\Http\JsonResponse
     */
    Route::middleware('auth:sanctum')->group(function () {
        
        Route::post('/articles', [ArticleController::class, 'articles']);
        // Add more user preference routes as needed
        
    });
});
