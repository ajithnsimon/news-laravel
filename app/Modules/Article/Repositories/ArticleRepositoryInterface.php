<?php

namespace App\Modules\Article\Repositories;

/**
 * Interface ArticleRepositoryInterface
 *
 * @package App\Modules\Article\Repositories
 */
interface ArticleRepositoryInterface
{
    /**
     * Search and filter articles based on the provided data.
     *
     * @param array $data
     * @return void
     */
    public function articles($data, $user): mixed;
}
