<?php

namespace App\Repositories;

use App\Models\Complaint;
use DB;

class ComplaintRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AttachmentRepository $attachmentRepo
    )
    {
        //
    }
    public function createComplaint(array $data, $files)
    {
        return DB::transaction(function () use ($data, $files) {
            $complaint = Complaint::create($data);
            foreach ($files as $file) {
                $this->attachmentRepo->createForModel($complaint, $file, 'complaints', 'public', true);
            }
            return $complaint;
        });
    }

}
