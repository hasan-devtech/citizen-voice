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
        'settings' => 'إعدادات',
    ],
    'resources' => [
        'general' => [
            'tabs' => [
                'ar' => "العربية",
                'en' => 'الإنكليزية',
                'ku' => 'الكردية'
            ],
            'attrs' => [
                'name_en' => 'الاسم بالإنكليزي',
                'name_ar' => 'الاسم بالعربي',
                'name_ku' => 'الاسم بالكردي',
                'slug_en' => 'الرابط بالإنكليزي',
                'slug_ar' => 'الرابط بالعربي',
                'slug_ku' => 'الرابط بالكردي',
                'description_en' => 'الوصف بالإنكليزي',
                'description_ar' => 'الوصف بالعربي',
                'description_ku' => 'الوصف بالكردي',
                'video' => 'فيديو',
                'media' => 'صورة',
                'alt' => 'نص بديل',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
            ],
            'actions' => [
                'activities' => 'السجل الزمني'
            ]
        ],
        'agency' => [
            'label' => 'جهة حكومية',
            'plural_label' => 'جهات حكومية',
        ],
        'complaint_category' => [
            'label' => 'نوع الشكوى',
            'plural_label' => 'أنواع الشكوى',
        ],
        'location' => [
            'label' => 'محافظة',
            'plural_label' => 'محافظات',
        ],
        'complainant' => [
            'label' => 'مواطن',
            'plural_label' => 'مواطنين',
            'attrs' => [
                'identifier' => 'معرف خاص',
                'password' => 'كلمة السر',
                'birthdate' => 'تاريخ الميلاد',
                'is_verified' => 'موثّق',
                'full_name' => 'الاسم الكامل',
            ],
            'actions' => [
                'verify' => 'توثيق'
            ]
        ],
        'complaint' => [
            'label' => 'شكوى',
            'plural_label' => 'شكاوي',
            'attrs' => [
                'complainant' => 'اسم المواطن',
                'complaint_category' => 'نوع الشكوى',
                'agency' => 'الجهة',
                'location' => 'المحافظة',
                'title' => 'العنوان',
                'description' => 'الوصف',
                'status' => 'الحالة',
                'reference_number' => 'رقم الشكوى'
            ],
            'actions' => [
                'processing' => 'معالجة',
                'resolved' => 'إتمام',
                'reject' => 'رفض'
            ]
        ],
        'user' => [
            'label' => 'مستخدم',
            'plural_label' => 'مستخدمين',
            'attrs' => [
                'name' => 'اسم',
                'email' => 'بريد الالكتروني',
                'password' => 'كلمة السر',
                'roles' => 'الدور',
            ]
        ],
    ]
];
