<?php

namespace App\Modules\Author\Repositories;

/**
 * Interface AuthorRepositoryInterface
 *
 * @package App\Modules\Author\Repositories
 */
interface AuthorRepositoryInterface
{
    /**
     * Search and filter authors based on the provided data.
     *
     * @param array $data
     * @return void
     */
    public function authors($data): mixed;
}
