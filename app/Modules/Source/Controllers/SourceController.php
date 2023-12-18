<?php

namespace App\Modules\Source\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Modules\Source\Requests\SourceRequest;
use App\Modules\Source\Services\SourceService;

/**
 * @group Source
 *
 * APIs for managing Source.
 */
class SourceController extends Controller
{
    protected SourceService $sourceService;

    /**
     * SourceController constructor.
     *
     * @param SourceService $sourceService
     */
    public function __construct(SourceService $sourceService)
    {
        $this->sourceService = $sourceService;
    }

    /**
     * Search and filter sources.
     *
     * @param SourceRequest $request
     * @return JsonResponse
     *
     * @queryParam search string required The keyword to search for sources.
     * @queryParam sources array required The list of source IDs to filter sources.
     * @queryParam categories array required The list of source IDs to filter sources.
     * @queryParam sources array required The list of source IDs to filter sources.
     *
     * @response 200 {
     *     "message": "Sources retrieved successfully"
     * }
     *
     * @throws \Exception
     *
     * @OA\Post(
     *     path="/source/sources",
     *     summary="Search and filter sources",
     *     tags={"Source"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Source search and filter criteria",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="search",
     *                     type="string",
     *                     nullable=true,
     *                     description="The keyword to search for sources"
     *                 ),
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Sources retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Sources retrieved successfully")
     *         ),
     *     ),
     *     @OA\Response(response="500", description="Internal server error"),
     * )
     */
    public function sources(SourceRequest $request): JsonResponse
    {
        $sources = $this->sourceService->sources($request);

        return response()->json(['message' => 'Sources retrieved successfully', 'sources' => $sources]);
    }
}
