<?php

namespace Suomato\Utils;

class Router
{
    public static function register($route)
    {
        add_action('rest_api_init', function () use ($route) {
            $route['base'] = str_replace('{', '(?P<', $route['base']);
            $route['base'] = str_replace('}', '>\w+)', $route['base']);
            register_rest_route($route['namespace'] . '/', $route['base'], [
                'methods'             => $route['methods'],
                'callback'            => $route['callback'],
                'permission_callback' => isset($route['permission_callback']) ? $route['permission_callback'] : null,
                'args'                => isset($route['params']) ? $route['params'] : [],
            ]);
        });
    }§
}