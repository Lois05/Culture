<?php
// ...existing code...
return [

    // ...existing code...

    'models' => [
        'namespace'    => 'App\\Models',
        'path'         => app_path('Models'),
        'baseModel'    => 'Eloquent',
        'connection'   => env('DB_CONNECTION', 'mysql'),
        'timestamps'   => true,
        'soft_deletes' => true,
        'dates'        => true,
        'snake_attributes' => true,
    ],

    // ...existing code...
];
