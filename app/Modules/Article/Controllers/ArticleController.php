<?php

namespace App\Modules\Article\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Modules\Article\Requests\ArticleRequest;
use App\Modules\Article\Services\ArticleService;

/**
 * @group Article
 *
 * APIs for managing Article.
 */
class ArticleController extends Controller
{
    protected ArticleService $articleService;

    /**
     * ArticleController constructor.
     *
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Search and filter articles.
     *
     * @param ArticleRequest $request
     * @return JsonResponse
     *
     * @queryParam search string required The keyword to search for articles.
     * @queryParam sources array required The list of source IDs to filter articles.
     * @queryParam categories array required The list of category IDs to filter articles.
     * @queryParam authors array required The list of author IDs to filter articles.
     *
     * @response 200 {
     *     "message": "Articles retrieved successfully"
     * }
     *
     * @throws \Exception
     *
     * @OA\Post(
     *     path="/article/articles",
     *     summary="Search and filter articles",
     *     tags={"Article"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Article search and filter criteria",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="search",
     *                     type="string",
     *                     nullable=true,
     *                     description="The keyword to search for articles"
     *                 ),
     *                 @OA\Property(
     *                     property="sources",
     *                     type="array",
     *                     @OA\Items(type="integer"),
     *                     nullable=true,
     *                     description="Array of source identifiers"
     *                 ),
     *                 @OA\Property(
     *                     property="categories",
     *                     type="array",
     *                     @OA\Items(type="integer"),
     *                     nullable=true,
     *                     description="Array of category identifiers"
     *                 ),
     *                 @OA\Property(
     *                     property="authors",
     *                     type="array",
     *                     @OA\Items(type="integer"),
     *                     nullable=true,
     *                     description="Array of author identifiers"
     *                 ),
     *                 @OA\Property(
     *                     property="date",
     *                     type="string",
     *                      format="date",
     *                     nullable=true,
     *                     description="The date to filter articles (format: Y-m-d)"
     *                 ),
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Articles retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Articles retrieved successfully")
     *         ),
     *     ),
     *     @OA\Response(response="500", description="Internal server error"),
     * )
     */
    public function articles(ArticleRequest $request): JsonResponse
    {
        $articles = $this->articleService->articles($request, auth()->user());

        return response()->json(['message' => 'Articles retrieved successfully', 'articles' => $articles]);
    }
}
