<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Modules\User\Requests\RegisterUserRequest;
use App\Modules\User\Services\UserService;

/**
 * @group User
 *
 * APIs for managing user registration.
 */
class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Register a new user.
     *
     * @param RegisterUserRequest $request
     * @return JsonResponse
     *
     * @OA\Post(
     *      path="/user/register",
     *      operationId="registerUser",
     *      tags={"User"},
     *      summary="Register a new user.",
     *      description="Register a new user and return user details.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="name", type="string", description="User's name", example="Ajith Simon"),
     *                  @OA\Property(property="email", type="string", description="User's email", example="ajith.simon@outlook.com"),
     *                  @OA\Property(property="password", type="string", description="User's password", example="password"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="User registered successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="user", type="object", description="Registered user details"),
     *              @OA\Property(property="message", type="string", description="Success message"),
     *          ),
     *      ),
     *      @OA\Response(response=422, description="Validation error"),
     * )
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $user = $this->userService->registerUser($request->all());

        return response()->json(['user' => $user, 'message' => 'User registered successfully']);
    }
}
