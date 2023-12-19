<?php

namespace App\Modules\Category\Services;

use App\Modules\Category\Repositories\CategoryRepositoryInterface;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepository;

    /**
     * CategoryService constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Search and filter categories.
     *
     * @param object $data
     * @return void
     */
    public function categories($data): mixed
    {
        return $this->categoryRepository->categories($data);
    }
}
