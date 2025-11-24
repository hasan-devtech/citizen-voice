<?php

namespace App\Repositories;

use App\Models\Complainant;

class ComplainantRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $data)
    {
        return Complainant::create($data);
    }

    public function findByIdentifier(string $identifier)
    {
        return Complainant::where('identifier', $identifier)->first();
    }
    public function firstOrCreate(array $attributes, array $data = [])
    {
        return Complainant::firstOrCreate($attributes, $data);
    }
}
