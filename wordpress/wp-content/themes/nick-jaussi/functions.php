<?php

/* nav menus */
if ( function_exists( 'register_nav_menu' ) ) {
  register_nav_menu('header_nav', __('Header Navigation Menu'));
  register_nav_menu('footer_nav', __('Footer Navigation Menu'));
}

function remove_default_post_type() {
  remove_menu_page('edit.php');
}

function register_post_types() {
    $stories = array(
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'portfolio'),
      'capability_type'    => 'post',
      'has_archive' => true,
      'hierarchical' => false,
      'supports' => array('title', 'editor', 'thumbnail',),
      'menu_position' => 2,
      'labels' => array(
        'name' => 'Stories',
        'public' => true,
        'label'  => 'Stories',
        'singular_name' => 'Story',
      ),
    );

    register_post_type('stories', $stories);
}

/* register custom post types */
add_action('init', 'register_post_types' );

add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');

add_action('admin_menu','remove_default_post_type');

?>
