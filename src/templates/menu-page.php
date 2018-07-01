<?php

namespace MenuPages;

use Suomato\Utils\MenuPage;

class {PLACEHOLDER} extends MenuPage
{
    /**
     * @var string Title in the browser toolbar
     */
    protected $page_title = '';

    /**
     * @var string Title in menu item
     */
    protected $menu_title = '';

    /**
     * @var string Menu Page slug (/wp-admin/admin.php?page={$menu_slug})
     */
    protected $menu_slug = '';

    /**
     * @var string define which user are able to see menu page
     */
    protected $capability = 'manage_options'; // only admin is able to see menu page

    /**
     * @var string Menu Page icon
     */
    protected $icon_url = '';

    /**
     * @var int Menu Page position
     */
    protected $position;

    /**
     * @var string A settings group name.
     */
    protected $option_group = '';

    /**
     * @var array An array of options with args.
     * See $args here https://developer.wordpress.org/reference/functions/register_setting/
     */
    protected $options = [
        // ['option_name', []],
    ];

    /**
     * Print template of Menu Page.
     * It is also possible to use Timber.
     *
     * \Timber::render();
     *
     * @return void
     */
    public function template()
    {
        echo '';
    }
}

// Initialize the Menu page
new {PLACEHOLDER};
