<?php

namespace Suomato\Utils;

abstract class Shortcode
{
    /**
     * @var string Shortcode name
     */
    protected $shortcode;

    /**
     * @var array|string An associative array of attributes, or an empty string if no attributes are given
     */
    protected $attributes = '';

    /**
     * Return template of shortcode
     *
     * @param $attr An associative array of attributes
     * @param $content Enclosed content
     *
     * @return mixed
     */
    protected abstract function template($attr, $content);

    /**
     * Shortcode constructor.
     */
    public function __construct()
    {
        if ($this->shortcode !== '') {
            add_shortcode($this->shortcode, function ($attr, $content = null) {
                if ( ! empty($this->attributes)) {
                    $attr = shortcode_atts($this->attributes, $attr, $this->shortcode);
                }

                return $this->template($attr, $content);
            });
        }
    }
}

