<?php

namespace App\Modules\Source\Repositories;

/**
 * Interface SourceRepositoryInterface
 *
 * @package App\Modules\Source\Repositories
 */
interface SourceRepositoryInterface
{
    /**
     * Search and filter sources based on the provided data.
     *
     * @param array $data
     * @return void
     */
    public function sources($data): mixed;
}
