<?php

namespace App\Modules\Article\Repositories;

use App\Modules\Article\Models\Article;
use App\Modules\UserPreference\Models\UserPreference;

/**
 * Class ArticleRepository
 *
 * @package App\Modules\Article\Repositories
 */
class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * Search and filter articles based on the provided data.
     *
     * @return array
     */
    public function articles($data, $user): mixed
    {
        // Assuming you have an Eloquent model named Article
        $query = Article::query();

        // Apply filters
        if ($data['search']) {
            $query->where(function ($query) use ($data) {
                $query->where('title', 'like', '%' . $data['search'] . '%')
                      ->orWhere('content', 'like', '%' . $data['search'] . '%');
            });
        }

        if (isset($data['sources']) && count($data['sources'])) {
            $query->whereIn('source_id', $data['sources']);
        }

        if (isset($data['categories']) && count($data['categories'])) {
            $query->whereIn('category_id', $data['categories']);
        }

        if (isset($data['authors']) && count($data['authors'])) {
            $query->whereIn('author_id', $data['authors']);
        }

        if ($data['date']) {
            $query->whereDate('date', '=', $data['date']);
        }

        $preferredData = UserPreference::where('user_id', $user->id)->get();

        if ($preferredData->isNotEmpty()) {
            
            $query->where(function ($query) use ($preferredData) {
                $preferredData->each(function ($preference) use ($query) {
                    $type = $preference['type'];
                    $column = "{$type}_id";

                    $query->orWhereIn($column, [$preference['typeable_id']]);
                });
            });
        }

        // Retrieve paginated data
        $articles = $query->paginate();

        return $articles;
    }
    

}
