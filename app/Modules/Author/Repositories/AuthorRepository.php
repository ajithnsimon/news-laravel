<?php

namespace App\Modules\Author\Repositories;

use App\Modules\Author\Models\Author;
use App\Modules\UserPreference\Models\UserPreference;

/**
 * Class AuthorRepository
 *
 * @package App\Modules\Author\Repositories
 */
class AuthorRepository implements AuthorRepositoryInterface
{
    /**
     * Search and filter authors based on the provided data.
     *
     * @return array
     */
    public function authors($data): mixed
    {
        // Assuming you have an Eloquent model named Author
        $query = Author::query();

        // Apply filters
        if ($data['search']) {
            $query->where(function ($query) use ($data) {
                $query->where('name', 'like', '%' . $data['search'] . '%');
            });
        }

        // Retrieve paginated data
        $authors = $query->get();

        return $authors;
    }
    

}
