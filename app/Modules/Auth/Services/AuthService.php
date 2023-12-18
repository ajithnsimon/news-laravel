<?php

namespace App\Modules\Auth\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Create a new authentication token for the user.
     *
     * @param  Authenticatable  $user
     * @return string
     */
    public function createAuthToken(Authenticatable $user): string
    {
        return $user->createToken('authToken')->plainTextToken;
    }

    /**
     * Delete the current authentication token for the user.
     *
     * @param  Authenticatable  $user
     * @return void
     */
    public function deleteCurrentAuthToken(Authenticatable $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
