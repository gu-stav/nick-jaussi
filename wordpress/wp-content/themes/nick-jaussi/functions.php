<?php

$STORY_TYPES = array(
  'reportage' => 'Reportage',
  'series' => 'Series',
  'multimedia' => 'Multimedia',
);

function cleanup_admin() {
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
}

function register_post_types() {
    $stories = array(
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => array(
        'slug' => 'portfolio'
      ),
      'capability_type' => 'post',
      'has_archive' => true,
      'hierarchical' => false,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
      ),
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
  global $STORY_TYPES;

  $meta_boxes[] = array(
    'id' => 'story_properties',
    'title' => 'Story properties',
    'post_types' => array(
      'stories',
    ),
    'context' => 'advanced',
    'priority' => 'high',
    'autosave' => false,
    'fields' => array(
      array(
        'id' => 'story_subtitle',
        'type' => 'text',
        'name' => 'Subtitle',
      ),

      array(
        'id' => 'story_type',
        'name' => 'Story Type',
        'type' => 'select',
        'placeholder' => 'Select a type',
        'options' => $STORY_TYPES,
      ),

      array(
        'id' => 'story_color',
        'name' => 'Story Color',
        'type' => 'color',
      ),

      array(
        'id' => 'story_on-frontpage',
        'name' => 'Show on frontpage',
        'type' => 'checkbox',
        'std' => 1,
      ),

      array(
        'id' => 'story_images',
        'type' => 'image_advanced',
        'name' => 'Story Images',
        'clone' => true,
        'sort_clone' => true,
        'add_button' => 'Add Image(s)',
      ),

      array(
        'id' => 'story_video_vimeo',
        'type' => 'text',
        'name' => 'Video (Vimeo/ Youtube URL)',
      ),
    ),
  );

  return $meta_boxes;
}

function create_navigation() {
  register_nav_menus(
    array(
      'main-navigation' => 'Navigation',
    )
  );
}

function get_all_stories() {
  return new WP_Query(
    array(
      'post_type' => 'stories',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'meta_query' => array(
        array(
          'key' => 'story_on-frontpage',
          'value' => '1',
        )
      ),
    )
  );
}

function remove_wp_version() {
  return '';
}

function enqueue_style() {
  wp_enqueue_style('style', get_stylesheet_uri());
}

function theme_scripts() {
  wp_register_script('main', get_template_directory_uri() . '/main.js', false, false, true);
  wp_enqueue_script('main');
}

add_image_size('story-preview', 720, 9999);
add_image_size('story-image', 1800, 9999);
add_image_size('portrait', 400, 400);

/* register custom post types */
add_action('init', 'register_post_types' );
add_action('init', 'create_navigation');
add_filter('rwmb_meta_boxes', 'register_story_fields');

add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');

add_action('wp_enqueue_scripts', 'enqueue_style');
add_action('admin_menu','cleanup_admin');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

add_filter('the_generator', 'remove_wp_version');
add_action( 'wp_enqueue_scripts', 'theme_scripts');

?>
