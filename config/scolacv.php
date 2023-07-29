<?php

return [
    'auth_model' => \Transave\ScolaCvManagement\Http\Models\User::class,

    'app_env' => env('APP_ENV', 'development'),

    'user_type' => [
        1 => 'admin',
        2 => 'user'
    ],

    'route' => [
        'prefix' => 'cv',
        'middleware' => 'api'
    ],

    'storage' => [
        'prefix' => env('STORAGE_PREFIX','cv-management'),
        'driver' => env('STORAGE_DRIVER', 'local'),
    ],

    'azure' => [
        'storage_url' => 'https://'.env('AZURE_STORAGE_NAME').'.blob.core.windows.net/'.env('AZURE_STORAGE_CONTAINER'),
        'id' => '.windows.net',
    ],

    's3' => [
        'storage_url' => 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com',
        'id' => 'amazonaws.com',
    ],

    'local' => [
        'storage_url' => '',
        'id' => '',
    ]
];
