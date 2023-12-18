<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Models\User; // Assuming User model exists

/**
 * Class UserRepository
 * @package App\Modules\User\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * Create a new user.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data): mixed
    {
        return User::create($data);
    }
}
