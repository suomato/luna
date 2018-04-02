<?php

namespace Suomato\Utils;

abstract class SubmenuPage
{
    /**
     * @var string The slug name for the parent menu (or the file name of a standard WordPress admin page).
     */
    protected $parent_slug;

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
     * @var string A settings group name.
     */
    protected $option_group;

    /**
     * @var string An array of options with args.
     */
    protected $options;

    /**
     * Return template of Submenu Page
     *
     * @return mixed
     */
    abstract public function template();

    /**
     * Submenu Page constructor.
     */
    public function __construct()
    {
        // Add new Submenu Page
        add_action('admin_menu', function () {
            add_submenu_page($this->parent_slug, $this->page_title, $this->menu_title, $this->capability, $this->menu_slug, [$this, 'template']);
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
