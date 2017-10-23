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

function register_story_fields($meta_boxes) {
  $meta_boxes[] = array(
    'id' => 'story_images',
    'title' => 'Images',
    'post_types' => array('stories',),
    'context' => 'normal',
    'priority' => 'default',
    'autosave' => false,
    'fields' => array(
      array(
        'id' => 'story_image_select',
        'type' => 'image_advanced',
        'name' => 'Image Select',
        'clone' => true,
        'sort_clone' => true,
        'add_button' => 'Add Image',
      ),
    ),
  );

  return $meta_boxes;
}

/* register custom post types */
add_action('init', 'register_post_types' );
add_filter('rwmb_meta_boxes', 'register_story_fields');

add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');

add_action('admin_menu','remove_default_post_type');

?>
