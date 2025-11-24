<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
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
        return Location::query()
            ->filterName($filters['keyword'] ?? null)
            ->get();
    }
}
