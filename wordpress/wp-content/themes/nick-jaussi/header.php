<!doctype html>
<html>
  <head>
    <title>
      <?php wp_title(' - ', true, 'right'); ?>
      <?php bloginfo('name'); ?>
    </title>

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

    <link rel="SHORTCUT ICON" href="<?php bloginfo('template_directory'); ?>/favicon.ico"/>
    <?php wp_head(); ?>
  </head>

  <body>

    <header class="header">
      <?php
        wp_nav_menu(
          array(
            'theme_location' => 'header-menu',
            'container_class' => 'navigation',
          )
        );
      ?>
    </header>
