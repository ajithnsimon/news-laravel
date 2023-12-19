<?php

namespace App\Modules\UserPreference\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Modules\UserPreference\Requests\UserPreferenceRequest;
use App\Modules\UserPreference\Services\UserPreferenceService;

/**
 * @group UserPreference
 *
 * APIs for managing UserPreference.
 */
class UserPreferenceController extends Controller
{
    protected UserPreferenceService $userPreferenceService;

    /**
     * UserPreferenceController constructor.
     *
     * @param UserPreferenceService $userPreferenceService
     */
    public function __construct(UserPreferenceService $userPreferenceService)
    {
        $this->userPreferenceService = $userPreferenceService;
    }

    /**
     * Insert or update user preference.
     *
     * @param UserPreferenceRequest $request
     * @return JsonResponse
     *
     * @response 200 {
     *     "message": "User preference updated successfully"
     * }
     *
     * @throws \Exception
     *
     * @OA\Post(
     *     path="/userpreference/preferences",
     *     summary="Insert or update user preference",
     *     tags={"UserPreference"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User preference data",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="sources",
     *                     type="array",
     *                     @OA\Items(type="integer"),
     *                     description="Array of source identifiers"
     *                 ),
     *                 @OA\Property(
     *                     property="authors",
     *                     type="array",
     *                     @OA\Items(type="integer"),
     *                     description="Array of author identifiers"
     *                 ),
     *                 @OA\Property(
     *                     property="categories",
     *                     type="array",
     *                     @OA\Items(type="integer"),
     *                     description="Array of category identifiers"
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="User preference updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User preference updated successfully")
     *         ),
     *     ),
     *     @OA\Response(response="500", description="Internal server error"),
     * )
     */
    public function updateUserPreference(UserPreferenceRequest $request): JsonResponse
    {
        $this->userPreferenceService->updateUserPreference($request, auth()->user());

        return response()->json(['message' => 'User preference updated successfully']);
    }

    /**
     * Get user preferences.
     *
     * @return JsonResponse
     *
     * @OA\Get(
     *     path="/userpreference/preferences",
     *     summary="Get user preferences",
     *     tags={"UserPreference"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Response(
     *         response="200",
     *         description="User preferences retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="sources", type="array", @OA\Items(type="integer")),
     *             @OA\Property(property="authors", type="array", @OA\Items(type="integer")),
     *             @OA\Property(property="categories", type="array", @OA\Items(type="integer")),
     *         ),
     *     ),
     *     @OA\Response(response="500", description="Internal server error"),
     * )
     */
    public function getUserPreferences(): JsonResponse
    {
        $userPreferences = $this->userPreferenceService->getUserPreferences(auth()->user());

        $preferences = [
            'sources' => $userPreferences->where('type', 'source')->pluck('typeable_id')->toArray(),
            'authors' => $userPreferences->where('type', 'author')->pluck('typeable_id')->toArray(),
            'categories' => $userPreferences->where('type', 'category')->pluck('typeable_id')->toArray(),
        ];

        return response()->json($preferences);
    }
}
