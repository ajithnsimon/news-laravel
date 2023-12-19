<?php

namespace App\Modules\UserPreference\Repositories;

/**
 * Interface UserPreferenceRepositoryInterface
 *
 * @package App\Modules\UserPreference\Repositories
 */
interface UserPreferenceRepositoryInterface
{
    /**
     * Update user preferences based on the provided data.
     *
     * @param array $data
     * @return void
     */
    public function updateUserPreference($data, $user): void;

    /**
     * Update user preferences based on the provided data.
     *
     * @param array $data
     * @return void
     */
    public function getUserPreferences($user);
}
