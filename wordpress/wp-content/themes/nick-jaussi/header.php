<!doctype html>
<html>
  <head>
    <title>
      <?php wp_title(' - ', true, 'right'); ?>
      <?php bloginfo('name'); ?>
    </title>

    <link rel="stylesheet"
          href="<?php bloginfo('stylesheet_url'); ?>" />

    <link rel="shortcut icon"
          href="<?php bloginfo('template_directory'); ?>/favicon.ico" />

    <?php wp_head(); ?>
  </head>

  <body>
    <div class="page">
      <header class="header">
        <a href="<?php echo home_url(); ?>">
          Startseite
        </a>

        <?php
          wp_nav_menu(
            array(
              'theme_location' => 'header-menu',
              'container_class' => 'navigation',
            )
          );
        ?>
      </header>
