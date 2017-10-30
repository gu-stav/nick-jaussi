<?php get_header(); ?>

<div class="js-background-map background-map">
  <main class="main">
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
</div>

<?php get_footer(); ?>
