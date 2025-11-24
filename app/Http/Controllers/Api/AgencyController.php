<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgencyResource;
use App\Services\AgencyService;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function __construct(
        protected AgencyService $service
    ) {
    }

    public function index(Request $request)
    {
        $filters = $request->only('keyword');
        $agencies = $this->service->getAgencies($filters);
        return ResponseHelper::success(AgencyResource::collection($agencies));
    }
}
