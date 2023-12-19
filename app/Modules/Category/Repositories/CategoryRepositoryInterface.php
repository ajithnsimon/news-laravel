<?php

namespace App\Modules\Category\Repositories;

/**
 * Interface CategoryRepositoryInterface
 *
 * @package App\Modules\Category\Repositories
 */
interface CategoryRepositoryInterface
{
    /**
     * Search and filter categories based on the provided data.
     *
     * @param array $data
     * @return void
     */
    public function categories($data): mixed;
}
