<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function show(Attachment $attachment)
    {
        $model = $attachment->attachable;
        if ($model->user_id !== auth()->id()) {
            abort(403);
        }
        $disk = $attachment->disk;
        $path = $attachment->file_path;
        if (!Storage::disk($disk)->exists($path)) {
            abort(404);
        }
        return response()->file(Storage::disk($disk)->path($path));
    }



}
