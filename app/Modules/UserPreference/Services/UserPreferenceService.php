<?php

namespace App\Modules\UserPreference\Services;

use App\Modules\UserPreference\Repositories\UserPreferenceRepositoryInterface;

class UserPreferenceService
{
    protected UserPreferenceRepositoryInterface $userPreferenceRepository;

    /**
     * UserPreferenceService constructor.
     *
     * @param UserPreferenceRepositoryInterface $userPreferenceRepository
     */
    public function __construct(UserPreferenceRepositoryInterface $userPreferenceRepository)
    {
        $this->userPreferenceRepository = $userPreferenceRepository;
    }

    /**
     * Update user preferences.
     *
     * @param object $data
     * @return void
     */
    public function updateUserPreference($data, $user): void
    {
        $this->userPreferenceRepository->updateUserPreference($data, $user);
    }
}
