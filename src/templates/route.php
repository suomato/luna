<?php

Suomato\Utils\Router::register([

        // HTTP verbs that are allowed at this endpoint
        'methods' => ['GET'],

        /*
        |--------------------------------------------------------------------------
        | Route url
        |--------------------------------------------------------------------------
        |
        | Here you can define your route url. Route url form is <namespace/base>.
        | E.g. If namespace = 'my-namespace' and base = 'posts', then full route will be:
        | http://example.com/wp-json/my-namespace/posts.
        |
        | You can define route parameters like this:
        | 'base' => 'posts/{id}'
        |
        */
        'namespace' => 'my-namespace',
        'base'      => 'posts/{id}',

        /*
        |--------------------------------------------------------------------------
        | Route Callback
        |--------------------------------------------------------------------------
        |
        | This function will be executed when user hit your route.
        | If permission callback or validate_callback return false,
        | this function won't be executed.
        |
        */
        'callback' => function (WP_REST_Request $request) {
            // Return some data
        },

        /*
        |--------------------------------------------------------------------------
        | Permission callback
        |--------------------------------------------------------------------------
        |
        | This is a function that checks if the user can perform the action
        | (reading, updating, etc) before the real callback is called.
        | This callback should return a boolean or a WP_Error instance.
        | If this function returns true, the response will be processed.
        |
        */
        'permission_callback' => function (WP_REST_Request $request) {
            // Check users permission
        },

        /*
        |--------------------------------------------------------------------------
        | Route Parameters
        |--------------------------------------------------------------------------
        |
        | Here you can validate or sanitize your route parameters.
        |
        */
        'params' => [
            'id' => [
                'validate_callback' => function ($param) {
                    // Should return true if the value is valid.
                },
                'sanitize_callback' => function ($param) {
                    // Sanitize the value of the argument before
                    // passing it to the main callback.
                },
            ]
        ],
    ]);