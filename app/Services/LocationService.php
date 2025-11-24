<?php

namespace App\Services;

use App\Repositories\LocationRepository;

class LocationService
{
    public function __construct(
        protected LocationRepository $repo
    ) {
        //
    }
    public function getLocations($filters)
    {
        return $this->repo->getAll($filters);
    }
}
