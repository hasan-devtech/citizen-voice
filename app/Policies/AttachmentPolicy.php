<?php

namespace App\Policies;

use App\Models\Attachment;
use App\Models\Complainant;
use App\Models\Complaint;
use App\Models\User;

class AttachmentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function view(Complainant $user, Attachment $attachment): bool
    {
        if ($attachment->attachable_type !== Complaint::class) {
            return false;
        }
        $complaint = $attachment->attachable;
        return $complaint && $complaint->complainant_id === $user->id;
    }
}
