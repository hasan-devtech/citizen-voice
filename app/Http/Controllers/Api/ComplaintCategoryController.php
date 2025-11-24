<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintCategoryResource;
use App\Services\ComplaintCategoryService;
use Illuminate\Http\Request;

class ComplaintCategoryController extends Controller
{
    public function __construct(
        protected ComplaintCategoryService $service
    ) {
    }

    public function index(Request $request)
    {
        $filters = $request->only('keyword');
        $agencies = $this->service->getCategories($filters);
        return ResponseHelper::success(ComplaintCategoryResource::collection($agencies));
    }
}
