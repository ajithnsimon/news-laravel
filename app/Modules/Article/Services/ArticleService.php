<?php

namespace App\Modules\Article\Services;

use App\Modules\Article\Repositories\ArticleRepositoryInterface;

class ArticleService
{
    protected ArticleRepositoryInterface $articleRepository;

    /**
     * ArticleService constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Search and filter articles.
     *
     * @param object $data
     * @return void
     */
    public function articles($data, $user): mixed
    {
        return $this->articleRepository->articles($data, $user);
    }
}
