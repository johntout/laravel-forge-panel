<?php

return [
    'middleware' => [
        'web',
    ],
    'route' => 'forge-panel',
    'token' => env('LARAVEL_FORGE_TOKEN'),
    'server_id' => env('LARAVEL_FORGE_SERVER_ID'),
    'site_id' => env('LARAVEL_FORGE_SITE_ID'),
];
