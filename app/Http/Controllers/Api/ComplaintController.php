<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Complainant\CreateComplaintRequest;
use App\Http\Requests\Complainant\GetComplaintsRequest;
use App\Http\Resources\ComplainantResource;
use App\Http\Resources\ComplaintResource;
use App\Services\ComplaintService;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function __construct(protected ComplaintService $service)
    {
    }

    public function store(CreateComplaintRequest $request)
    {
        $files = $request->file('attachments', []);
        $data = $request->validated();
        $data['complainant_id'] = $request->user()->id;
        $complaint = $this->service->store($data, $files);
        return ResponseHelper::success(ComplaintResource::make($complaint));
    }

    public function index(GetComplaintsRequest $request)
    {
        $complaints = $this->service->getComplaints($request->validated());
        return ResponseHelper::paginated(ComplaintResource::collection($complaints));
    }

}
