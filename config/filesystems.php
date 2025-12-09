<?php

return [

    'default' => env('FILESYSTEM_DISK', 'public'), // ← 'public' par défaut

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => public_path('adminlte/img'), // ← CHANGER ICI
            'url' => env('APP_URL') . '/adminlte/img', // ← CHANGER ICI
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
            'permissions' => [ // ← AJOUTER CES PERMISSIONS
                'file' => [
                    'public' => 0664,
                    'private' => 0600,
                ],
                'dir' => [
                    'public' => 0775,
                    'private' => 0700,
                ],
            ],
        ],

        // Gardez l'ancien 'public' sous un autre nom si besoin
        'storage_public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        'videos' => [
            'driver' => 'local',
            'root' => public_path('adminlte/img'), // Même dossier
            'url' => env('APP_URL') . '/adminlte/img',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
        // Vous pouvez aussi créer un lien pour adminlte/img si vous voulez
        public_path('adminlte') => base_path('vendor/almasaeed2010/adminlte'),
    ],

];
