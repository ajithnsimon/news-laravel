<?php

namespace App\Modules\Author\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Modules\Author\Requests\AuthorRequest;
use App\Modules\Author\Services\AuthorService;

/**
 * @group Author
 *
 * APIs for managing Author.
 */
class AuthorController extends Controller
{
    protected AuthorService $authorService;

    /**
     * AuthorController constructor.
     *
     * @param AuthorService $authorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Search and filter authors.
     *
     * @param AuthorRequest $request
     * @return JsonResponse
     *
     * @queryParam search string required The keyword to search for authors.
     * @queryParam sources array required The list of source IDs to filter authors.
     * @queryParam categories array required The list of category IDs to filter authors.
     * @queryParam authors array required The list of author IDs to filter authors.
     *
     * @response 200 {
     *     "message": "Authors retrieved successfully"
     * }
     *
     * @throws \Exception
     *
     * @OA\Post(
     *     path="/author/authors",
     *     summary="Search and filter authors",
     *     tags={"Author"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Author search and filter criteria",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="search",
     *                     type="string",
     *                     nullable=true,
     *                     description="The keyword to search for authors"
     *                 ),
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Authors retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Authors retrieved successfully")
     *         ),
     *     ),
     *     @OA\Response(response="500", description="Internal server error"),
     * )
     */
    public function authors(AuthorRequest $request): JsonResponse
    {
        $authors = $this->authorService->authors($request);

        return response()->json(['message' => 'Authors retrieved successfully', 'authors' => $authors]);
    }
}
