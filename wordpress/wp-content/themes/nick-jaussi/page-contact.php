<?php get_header(); ?>

<main class="main js-background-map">
  <div class="text">
    <?php
      while ( have_posts() ) : the_post();
    ?>

      <h1 class="text__title">
        <?php the_title(); ?>
      </h1>

      <div class="text__author-image">
        <?php the_post_thumbnail('portrait'); ?>
      </div>

      <div class="text__content">
        <?php the_content(); ?>
      </div>

    <?php
      endwhile;
      wp_reset_query();
    ?>
  </div>
</main>

<?php get_footer(); ?>
