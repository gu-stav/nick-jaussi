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

  <body <?php body_class(); ?>>
    <h1 id="logotop">
      <a href="<?php bloginfo('url'); ?>">
        <?php bloginfo('name'); ?>
        :
        <?php bloginfo('description'); ?>
      </a>
    </h1>

    <ul id="topnav">
      <?php wp_nav_menu(array('theme_location' => 'header_nav')); ?>
    </ul>
