<?php

namespace App\Services;

use App\Repositories\ComplaintCategoryRepository;

class ComplaintCategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ComplaintCategoryRepository $repo
    ) {
    }
    public function getCategories($filters)
    {
        return $this->repo->getAll($filters);
    }
}
