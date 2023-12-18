<?php

namespace App\Modules\User\Repositories;

/**
 * Interface UserRepositoryInterface
 * @package App\Modules\User\Repositories
 */
interface UserRepositoryInterface
{
    /**
     * Create a new user.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;
}
