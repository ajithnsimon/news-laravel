<?php

namespace App\Modules\Source\Repositories;

use App\Modules\Source\Models\Source;
use App\Modules\UserPreference\Models\UserPreference;

/**
 * Class SourceRepository
 *
 * @package App\Modules\Source\Repositories
 */
class SourceRepository implements SourceRepositoryInterface
{
    /**
     * Search and filter sources based on the provided data.
     *
     * @return array
     */
    public function sources($data): mixed
    {
        // Assuming you have an Eloquent model named Source
        $query = Source::query();

        // Apply filters
        if ($data['search']) {
            $query->where(function ($query) use ($data) {
                $query->where('name', 'like', '%' . $data['search'] . '%')
                    ->where('description', 'like', '%' . $data['search'] . '%');
            });
        }

        // Retrieve paginated data
        $sources = $query->get();

        return $sources;
    }
    

}
