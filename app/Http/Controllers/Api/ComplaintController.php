<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Complainant\CreateComplaintRequest;
use App\Services\ComplaintService;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function __construct(protected ComplaintService $service)
    {
    }

    public function store(CreateComplaintRequest $request)
    {
    }
}
