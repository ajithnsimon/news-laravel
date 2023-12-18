<?php

namespace App\Modules\User\Services;

use App\Modules\User\Repositories\UserRepositoryInterface;

/**
 * Class UserService
 * @package App\Modules\User\Services
 */
class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Register a new user.
     *
     * @param array $data
     * @return mixed
     */
    public function registerUser(array $data)
    {
        // You can add validation logic or other business logic here

        // Create and return the user using the UserRepository
        return $this->userRepository->create($data);
    }
}
