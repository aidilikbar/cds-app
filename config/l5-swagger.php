<?php

return [
    'default' => 'default',

    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'CDS API Documentation',
            ],

            'routes' => [
                'api' => 'api/documentation',
                'docs' => 'docs',
                'assets' => 'docs/asset',
                'oauth2_callback' => 'api/oauth2-callback',
                'middleware' => [
                    'api' => [],
                    'asset' => [],
                    'docs' => [],
                    'oauth2_callback' => [],
                ],
            ],

            'paths' => [
                'annotations' => [
                    base_path('app'),
                ],
                'docs_json' => 'api-docs.json',
                'base' => env('L5_SWAGGER_BASE_PATH', null),
                'excludes' => [],
            ],

            'proxy' => [
                // Set to null if no proxy is needed
                'host' => env('PROXY_HOST', null),
                'port' => env('PROXY_PORT', null),
                'scheme' => env('PROXY_SCHEME', null),
                'username' => env('PROXY_USERNAME', null),
                'password' => env('PROXY_PASSWORD', null),
            ],
        ],
    ],

    'defaults' => [
        'base' => [
            'title' => env('APP_NAME', 'CDS App'),
            'description' => 'API documentation for CDS App',
            'version' => env('APP_VERSION', '1.0'),
            'host' => env('APP_URL', 'https://cds-app-89thh.ondigitalocean.app'),
            'schemes' => [
                'https',
            ],
        ],
    ],
];