<?php

namespace App\Repositories;

use App\Models\ComplaintCategory;



class ComplaintCategoryRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAll($filters)
    {
        return ComplaintCategory::query()
            ->filterName($filters['keyword'] ?? null)
            ->get();
    }
}
