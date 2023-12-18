<?php

namespace App\Modules\Source\Services;

use App\Modules\Source\Repositories\SourceRepositoryInterface;

class SourceService
{
    protected SourceRepositoryInterface $sourceRepository;

    /**
     * SourceService constructor.
     *
     * @param SourceRepositoryInterface $sourceRepository
     */
    public function __construct(SourceRepositoryInterface $sourceRepository)
    {
        $this->sourceRepository = $sourceRepository;
    }

    /**
     * Search and filter sources.
     *
     * @param object $data
     * @return void
     */
    public function sources($data): mixed
    {
        return $this->sourceRepository->sources($data);
    }
}
