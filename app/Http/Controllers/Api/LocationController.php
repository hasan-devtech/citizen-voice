<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct(
        protected LocationService $service
    ) {
    }

    public function index(Request $request)
    {
        $filters = $request->only('keyword');
        $locations = $this->service->getLocations($filters);
        return ResponseHelper::success(LocationResource::collection($locations));
    }
}
