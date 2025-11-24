<?php

namespace App\Repositories;

use App\Models\Complaint;
use DB;
use Illuminate\Support\Facades\Log;

class ComplaintRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AttachmentRepository $attachmentRepo
    ) {
        //
    }
    public function createComplaint(array $data, $files)
    {
        try {
            return DB::transaction(function () use ($data, $files) {
                $complaint = Complaint::create($data);
                foreach ($files as $file) {
                    $this->attachmentRepo->createForModel(
                        $complaint,
                        $file,
                        'complaints',
                        'private',
                        false
                    );
                }
                return $complaint;
            });
        } catch (\Exception $e) {
            Log::error('Failed to create complaint: ' . $e->getMessage(), [
                'data' => $data,
            ]);
            throw new \RuntimeException('Unable to create complaint at this time.');
        }
    }

    public function filter(array $filters)
    {
        return Complaint::query()
            ->with(['category', 'agency', 'location', 'attachments'])
            ->filter(filters: $filters)
            ->paginate(perPage: $filters['per_page'] ?? 15);
    }


}
