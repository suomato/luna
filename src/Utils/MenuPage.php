<?php

namespace Suomato\Utils;

abstract class MenuPage
{
    /**
     * @var string The text to be displayed in the title tags of the page when the menu is selected.
     */
    protected $page_title;

    /**
     * @var string The text to be used for the menu.
     */
    protected $menu_title;

    /**
     * @var string The capability required for this menu to be displayed to the user.
     */
    protected $capability;

    /**
     * @var string The slug name to refer to this menu by.
     * Should be unique for this menu page and only include
     * lowercase alphanumeric, dashes, and underscores characters to be compatible with sanitize_key().
     */
    protected $menu_slug;

    /**
     * @var string The URL to the icon to be used for this menu.
     * Pass a base64-encoded SVG using a data URI, which will be colored to match the color scheme. This should begin with 'data:image/svg+xml;base64,'.
     * Pass the name of a Dashicons helper class to use a font icon, e.g. 'dashicons-chart-pie'.
     * Pass 'none' to leave div.wp-menu-image empty so an icon can be added via CSS.
     */
    protected $icon_url;

    /**
     * @var int he position in the menu order this one should appear.
     */
    protected $position;

    /**
     * @var string A settings group name.
     */
    protected $option_group;

    /**
     * @var string An array of options with args.
     */
    protected $options;

    /**
     * Return template of Menu Page
     *
     * @return mixed
     */
    abstract public function template();

    /**
     * Menu Page constructor.
     */
    public function __construct()
    {
        // Add new Menu Page
        add_action('admin_menu', function () {
            add_menu_page($this->page_title, $this->menu_title, $this->capability, $this->menu_slug, [$this, 'template'], $this->icon_url, $this->position);
        });

        // Register settings
        add_action('admin_init', function () {
            foreach ($this->options as $option) {
                $option_name = $option[0];
                $args = isset($option[1]) ? $option[1] : [];

                register_setting($this->option_group, $option_name, $args);
            }
        });
    }
}
