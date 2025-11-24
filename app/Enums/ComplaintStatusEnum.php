<?php

namespace App\Enums;

enum ComplaintStatusEnum: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case RESOLVED = 'resolved';
    case REJECTED = 'rejected';
}
