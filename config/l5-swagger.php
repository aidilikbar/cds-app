<?php

return [
    'default' => 'default',

    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'CDS API Documentation',
            ],

            'routes' => [
                /*
                 * Route for accessing the Swagger documentation UI.
                 */
                'api' => 'api/documentation',

                /*
                 * Route for accessing the generated OpenAPI JSON file.
                 */
                'docs' => 'docs',

                /*
                 * Route for serving assets (JavaScript, CSS, images).
                 */
                'assets' => 'docs/asset',

                /*
                 * Route for OAuth2 callback redirect.
                 */
                'oauth2_callback' => 'api/oauth2-callback',

                /*
                 * Middleware for protecting the Swagger documentation routes.
                 */
                'middleware' => [
                    'api' => [],
                    'asset' => [],
                    'docs' => [],
                    'oauth2_callback' => [],
                ],

                'group_options' => [],
            ],

            'paths' => [
                /*
                 * Path to the directory containing OpenAPI annotations.
                 */
                'annotations' => [
                    base_path('app'),
                ],

                /*
                 * Absolute path to directories to exclude from scanning.
                 */
                'excludes' => [],

                /*
                 * Path where the generated OpenAPI JSON file will be stored.
                 */
                'docs_json' => 'api-docs.json',

                /*
                 * The name of the OpenAPI JSON file.
                 */
                'docs_yaml' => false,

                /*
                 * Base path for OpenAPI generation.
                 */
                'base' => env('L5_SWAGGER_BASE_PATH', null),

                /*
                 * Absolute paths to directories containing views for Swagger.
                 */
                'views' => [],
            ],
        ],
    ],

    'defaults' => [
        'base' => [
            /*
             * API title.
             */
            'title' => env('APP_NAME', 'CDS App'),

            /*
             * API description.
             */
            'description' => 'API documentation for CDS App',

            /*
             * API version.
             */
            'version' => env('APP_VERSION', '1.0'),

            /*
             * OpenAPI documentation base path.
             */
            'host' => env('APP_URL', 'https://cds-app-89thh.ondigitalocean.app'),

            /*
             * Supported schemes for the API.
             */
            'schemes' => [
                'https',
            ],

            /*
             * Additional OpenAPI tags.
             */
            'tags' => [],
        ],

        'security' => [
            'security_definitions' => [
                /*
                 * Security definitions for OAuth2 or other types.
                 */
            ],
        ],

        'docs' => [
            /*
             * Swagger UI display configuration.
             */
            'ui' => [
                'display_operation_id' => true,
                'default_models_expand_depth' => -1,
                'default_model_expand_depth' => 0,
                'doc_expansion' => 'none',
                'filter' => true,
                'validator_url' => null,
            ],
        ],
    ],
];