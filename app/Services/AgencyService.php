<?php

namespace App\Services;

use App\Repositories\AgencyRepository;

class AgencyService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AgencyRepository $repo
    ) {
        //
    }
    public function getAgencies($filters)
    {
        return $this->repo->getAll($filters);
    }
}
