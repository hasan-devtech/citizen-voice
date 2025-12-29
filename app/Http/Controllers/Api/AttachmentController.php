<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AttachmentController extends Controller
{
    use AuthorizesRequests;
    public function show(Attachment $attachment)
    {
        $this->authorize('view', $attachment);
        return Storage::disk($attachment->disk)->download(
            $attachment->file_path
        );
    }
}
