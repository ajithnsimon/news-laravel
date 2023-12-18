<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Modules\Auth\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use App\Modules\Auth\Services\AuthService;

/**
 * @group Authentication
 *
 * APIs for managing user authentication.
 */
class AuthController extends Controller
{
    protected AuthService $authService;

    /**
     * AuthController constructor.
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login
     *
     * Authenticate the user by providing valid credentials and return an access token.
     *
     * @authenticated
     *
     * @bodyParam email string required User's email.
     * @bodyParam password string required User's password.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     *
     * @OA\Post(
     *      path="/auth/login",
     *      operationId="login",
     *      tags={"Authentication"},
     *      summary="Authenticate the user and return an access token.",
     *      description="Authenticate the user by providing valid credentials and return an access token.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="email", type="string", description="User's email", example="ajith.simon@outlook.com"),
     *                  @OA\Property(property="password", type="string", description="User's password", example="password"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful authentication",
     *          @OA\JsonContent(
     *              @OA\Property(property="token", type="string", description="Access token"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", description="Invalid credentials"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", description="The given data was invalid."),
     *              @OA\Property(property="errors", type="object", description="Validation errors", example={"email": {"The email field is required."}}),
     *          ),
     *      ),
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $token = $this->authService->createAuthToken(auth()->user());
            return response()->json(['token' => $token]);
        } else {
            throw ValidationException::withMessages(['email' => 'Invalid credentials']);
        }
    }

    /**
     * Logout
     *
     * Revoke the user's access token and log them out.
     *
     * @authenticated
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *      path="/auth/logout",
     *      operationId="logout",
     *      tags={"Authentication"},
     *      summary="Revoke the user's access token and log them out.",
     *      description="Revoke the user's access token and log them out.",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", description="Logout message"),
     *          ),
     *      ),
     *      @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function logout(): JsonResponse
    {
        $this->authService->deleteCurrentAuthToken(auth()->user());

        return response()->json(['message' => 'Logged out']);
    }
}