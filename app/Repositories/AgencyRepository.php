<?php

namespace App\Repositories;

use App\Models\Agency;

class AgencyRepository
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
        return Agency::query()
            ->filterName($filters['keyword'] ?? null)
            ->get();
    }

}
