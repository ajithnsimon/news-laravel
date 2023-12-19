<?php

namespace App\Modules\Category\Repositories;

use App\Modules\Category\Models\Category;
use App\Modules\UserPreference\Models\UserPreference;

/**
 * Class CategoryRepository
 *
 * @package App\Modules\Category\Repositories
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Search and filter categories based on the provided data.
     *
     * @return array
     */
    public function categories($data): mixed
    {
        // Assuming you have an Eloquent model named Category
        $query = Category::query();

        // Apply filters
        if ($data['search']) {
            $query->where(function ($query) use ($data) {
                $query->where('name', 'like', '%' . $data['search'] . '%')
                    ->where('description', 'like', '%' . $data['search'] . '%');
            });
        }

        // Retrieve paginated data
        $categories = $query->get();

        return $categories;
    }
    

}
