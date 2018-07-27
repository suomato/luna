<?php

function custom_taxonomy_genre()
{
    // Set UI labels for Custom Taxonomy
    $labels = [
        'name'              => _x('Genres', 'Taxonomy general name', 'base-camp'),
        'singular_name'     => _x('Genre', 'Taxonomy singular name', 'base-camp'),
        'search_items'      => __('Search Genres', 'base-camp'),
        'all_items'         => __('All Genres', 'base-camp'),
        'parent_item'       => __('Parent Genre', 'base-camp'),
        'parent_item_colon' => __('Parent Genre:', 'base-camp'),
        'edit_item'         => __('Edit Genre', 'base-camp'),
        'update_item'       => __('Update Genre', 'base-camp'),
        'add_new_item'      => __('Add New Genre', 'base-camp'),
        'new_item_name'     => __('New Genre Name', 'base-camp'),
        'menu_name'         => __('Genre', 'base-camp'),
    ];

    // Set other options for Custom Taxonomy
    // https://codex.wordpress.org/Function_Reference/register_taxonomy
    $args = [
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
    ];

    // Registering your Custom Taxonomy
    register_taxonomy('genre', ['post'], $args);
}

add_action('init', 'custom_taxonomy_genre', 0);
