<?php

namespace App\Services;

use App\Repositories\ComplaintRepository;

class ComplaintService
{

    public function __construct(protected ComplaintRepository $repo)
    {
    }

    public function store(array $data, array $files)
    {
        return $this->repo->createComplaint($data, $files);
    }
    public function getComplaints(array $filters)
    {
        return $this->repo->filter( $filters);
    }

}
