<?php

namespace App\Repositories;

use Illuminate\Support\Str;

class AttachmentRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function createForModel($model, $file, string $folder = 'complaints', string $disk = 'public', bool $isPublic = true)
    {
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($folder, $fileName, $disk);
        return $model->attachments()->create([
            'file_path' => $path,
            'disk' => $disk,
            'mime_type' => $file->getMimeType(),
            'size_kb' => (int) round($file->getSize() / 1024, 2),
            'is_public' => $isPublic,
        ]);
    }
}
