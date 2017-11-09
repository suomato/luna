<?php

namespace Suomato;

function build_custom_post_type($template, $name, $plural)
{
    $singular = $name;
    $plural   = isset($plural) ? $plural : "{$name}s";

    $content = str_replace('movies', $plural, $template);
    $content = str_replace('Movies', ucfirst($plural), $content);
    $content = str_replace('Movie', ucfirst($singular), $content);
    $content = str_replace('movie', $singular, $content);

    return $content;
}

function build_shortcode($template, $name)
{
    return str_replace('{PLACEHOLDER}', $name, $template);
}