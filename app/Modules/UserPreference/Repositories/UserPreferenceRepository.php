<?php

namespace App\Modules\UserPreference\Repositories;

use App\Modules\UserPreference\Models\UserPreference;

/**
 * Class UserPreferenceRepository
 *
 * @package App\Modules\UserPreference\Repositories
 */
class UserPreferenceRepository implements UserPreferenceRepositoryInterface
{
    /**
     * Update user preferences based on the provided data.
     *
     * @param array $data
     * @return void
     */
    public function updateUserPreference($data, $user): void
    {
        // Delete existing preferences for the user
        UserPreference::where('user_id', $user->id)->delete();

        // Save new preferences
        $preferences = [];

        foreach ($data['sources'] ?? [] as $sourceId) {
            $preferences[] = [
                'user_id' => $user->id,
                'type' => 'source',
                'typeable_id' => $sourceId,
                'typeable_type' => 'App\\Modules\\Source\\Models\\Source', // Adjust the namespace accordingly
            ];
        }

        foreach ($data['authors'] ?? [] as $authorId) {
            $preferences[] = [
                'user_id' => $user->id,
                'type' => 'author',
                'typeable_id' => $authorId,
                'typeable_type' => 'App\\Modules\\Author\\Models\\Author', // Adjust the namespace accordingly
            ];
        }

        foreach ($data['categories'] ?? [] as $categoryId) {
            $preferences[] = [
                'user_id' => $user->id,
                'type' => 'category',
                'typeable_id' => $categoryId,
                'typeable_type' => 'App\\Modules\\Category\\Models\\Category', // Adjust the namespace accordingly
            ];
        }

        UserPreference::insert($preferences);
    }
}
