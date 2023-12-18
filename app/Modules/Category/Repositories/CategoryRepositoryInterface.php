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
     * Search and filter categorys based on the provided data.
     *
     * @param array $data
     * @return void
     */
    public function categorys($data): mixed;
}
