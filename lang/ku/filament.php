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
        'settings' => 'ڕێکخستنەکان',
    ],
    'resources' => [
        'general' => [
            'tabs' => [
                'ar' => 'عەرەبی',
                'en' => 'ئینگلیزی',
                'ku' => 'کوردی',
            ],
            'attrs' => [
                'name_en' => 'ناو (ئینگلیزی)',
                'name_ar' => 'ناو (عەرەبی)',
                'name_ku' => 'ناو (کوردی)',
                'slug_en' => 'بەستەر (ئینگلیزی)',
                'slug_ar' => 'بەستەر (عەرەبی)',
                'slug_ku' => 'بەستەر (کوردی)',
                'description_en' => 'وەسف (ئینگلیزی)',
                'description_ar' => 'وەسف (عەرەبی)',
                'description_ku' => 'وەسف (کوردی)',
                'video' => 'ڤیدیۆ',
                'media' => 'وێنە',
                'alt' => 'دەقی جێگرەوە',
                'created_at' => 'بەرواری دروستکردن',
                'updated_at' => 'بەرواری نوێکردنەوە',
            ],
            'actions' => [
                'activities' => 'تۆماری کاتی'
            ]
        ],
        'agency' => [
            'label' => 'دامەزراوەی حکومی',
            'plural_label' => 'دامەزراوە حکومییەکان',
        ],
        'complaint_category' => [
            'label' => 'جۆری سکاڵا',
            'plural_label' => 'جۆرەکانی سکاڵا',
        ],
        'location' => [
            'label' => 'پارێزگا',
            'plural_label' => 'پارێزگاکان',
        ],
        'complainant' => [
            'label' => 'هاوڵاتی',
            'plural_label' => 'هاوڵاتیان',
            'attrs' => [
                'identifier' => 'ناسنامەی تایبەت',
                'password' => 'وشەی نهێنی',
                'birthdate' => 'بەرواری لەدایکبوون',
                'is_verified' => 'پشتڕاستکراو',
                'full_name' => 'ناوی تەواو',
            ],
            'actions' => [
                'verify' => 'پشتڕاستکردن',
            ]
        ],
        'complaint' => [
            'label' => 'سکاڵا',
            'plural_label' => 'سکاڵاکان',
            'attrs' => [
                'complainant' => 'ناوی هاوڵاتی',
                'complaint_category' => 'جۆری سکاڵا',
                'agency' => 'دامەزراوە',
                'location' => 'پارێزگا',
                'title' => 'ناونیشان',
                'description' => 'وەسف',
                'status' => 'دۆخ',
                'reference_number' => 'ژمارەی سکاڵا',
            ],
            'actions' => [
                'processing' => 'لە پرۆسەدایە',
                'resolved' => 'چارەسەر کرا',
                'reject' => 'ڕەتکردنەوە',
            ]
        ],
        'user' => [
            'label' => 'بەکارهێنەر',
            'plural_label' => 'بەکارهێنەران',
            'attrs' => [
                'name' => 'ناو',
                'email' => 'ئیمەیڵ',
                'password' => 'وشەی نهێنی',
                'roles' => 'ڕۆڵ',
            ]
        ],
    ]
];
