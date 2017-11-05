<?php

namespace Shortcodes;

use Suomato\Utils\Shortcode;

class {PLACEHOLDER} extends Shortcode
{
    /**
     * @var string Shortcode name
     */
    protected $shortcode = '';

    /**
     * @var array|string An associative array of attributes
     */
    protected $attributes = [];

    /**
     * Return template of shortcode
     *
     * @param $attr An associative array of attributes
     * @param $content Enclosed content
     *
     * @return mixed
     */
    protected function template($attr, $content)
    {
        return '';
    }

}

// Initialize the shortcode
new {PLACEHOLDER};
