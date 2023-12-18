<?php

namespace App\Modules\Author\Services;

use App\Modules\Author\Repositories\AuthorRepositoryInterface;

class AuthorService
{
    protected AuthorRepositoryInterface $authorRepository;

    /**
     * AuthorService constructor.
     *
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Search and filter authors.
     *
     * @param object $data
     * @return void
     */
    public function authors($data): mixed
    {
        return $this->authorRepository->authors($data);
    }
}
