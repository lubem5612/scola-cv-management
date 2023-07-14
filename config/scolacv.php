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

    'azure' => [
        'storage_url' => 'https://'.env('AZURE_STORAGE_NAME').'.blob.core.windows.net/'.env('AZURE_STORAGE_CONTAINER').'/',
    ],
];
