<?php

namespace App\Modules\Category\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Modules\Category\Requests\CategoryRequest;
use App\Modules\Category\Services\CategoryService;

/**
 * @group Category
 *
 * APIs for managing Category.
 */
class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    /**
     * CategoryController constructor.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Search and filter categories.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     *
     * @queryParam search string required The keyword to search for categories.
     * @queryParam sources array required The list of source IDs to filter categories.
     * @queryParam categories array required The list of category IDs to filter categories.
     * @queryParam categories array required The list of category IDs to filter categories.
     *
     * @response 200 {
     *     "message": "Categorys retrieved successfully"
     * }
     *
     * @throws \Exception
     *
     * @OA\Post(
     *     path="/category/categories",
     *     summary="Search and filter categories",
     *     tags={"Category"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Category search and filter criteria",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="search",
     *                     type="string",
     *                     nullable=true,
     *                     description="The keyword to search for categories"
     *                 ),
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Categorys retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Categorys retrieved successfully")
     *         ),
     *     ),
     *     @OA\Response(response="500", description="Internal server error"),
     * )
     */
    public function categories(CategoryRequest $request): JsonResponse
    {
        $categories = $this->categoryService->categories($request);

        return response()->json(['message' => 'Categorys retrieved successfully', 'categories' => $categories]);
    }
}
