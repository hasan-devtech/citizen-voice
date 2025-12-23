<?php

return [
    'stats' => [
        'overview' => [
            'heading' => '',
            'description' => '',
            'data' => [
            ]
        ]
    ],
    'groups' => [
        'settings' => 'Settings',
    ],
    'resources' => [
        'general' => [
            'tabs' => [
                'ar' => 'Arabic',
                'en' => 'English',
                'ku' => 'Kurdish',
            ],
            'attrs' => [
                'name_en' => 'Name (English)',
                'name_ar' => 'Name (Arabic)',
                'name_ku' => 'Name (Kurdish)',
                'slug_en' => 'Slug (English)',
                'slug_ar' => 'Slug (Arabic)',
                'slug_ku' => 'Slug (Kurdish)',
                'description_en' => 'Description (English)',
                'description_ar' => 'Description (Arabic)',
                'description_ku' => 'Description (Kurdish)',
                'video' => 'Video',
                'media' => 'Image',
                'alt' => 'Alt Text',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],
            'actions' => [
                'activities' => 'Activity Log'
            ]
        ],
        'agency' => [
            'label' => 'Government Entity',
            'plural_label' => 'Government Entities',
        ],
        'complaint_category' => [
            'label' => 'Complaint Type',
            'plural_label' => 'Complaint Types',
        ],
        'location' => [
            'label' => 'Governorate',
            'plural_label' => 'Governorates',
        ],
        'complainant' => [
            'label' => 'Citizen',
            'plural_label' => 'Citizens',
            'attrs' => [
                'identifier' => 'Unique Identifier',
                'password' => 'Password',
                'birthdate' => 'Date of Birth',
                'is_verified' => 'Verified',
                'full_name' => 'Full Name',
            ],
            'actions' => [
                'verify' => 'Verify',
            ]
        ],
        'complaint' => [
            'label' => 'Complaint',
            'plural_label' => 'Complaints',
            'attrs' => [
                'complainant' => 'Citizen Name',
                'complaint_category' => 'Complaint Type',
                'agency' => 'Entity',
                'location' => 'Governorate',
                'title' => 'Title',
                'description' => 'Description',
                'status' => 'Status',
                'reference_number' => 'Complaint Number',
            ],
            'actions' => [
                'processing' => 'Processing',
                'resolved' => 'Resolved',
                'reject' => 'Rejected',
            ]
        ],
        'user' => [
            'label' => 'User',
            'plural_label' => 'Users',
            'attrs' => [
                'name' => 'Name',
                'email' => 'Email',
                'password' => 'Password',
                'roles' => 'Role',
            ]
        ],
    ]
];
