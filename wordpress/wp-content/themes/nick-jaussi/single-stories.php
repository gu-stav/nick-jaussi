<?php get_header(); ?>

<main class="main">
  <?php
    while ( have_posts() ) : the_post();
  ?>

    <?php
      echo the_post_thumbnail('story-image');
    ?>

    <h1>
      <?php the_title(); ?>

      <?php
        $subtitle = rwmb_meta('story_subtitle');
      ?>

      <?php if ($subtitle) : ?>
        <small>
          <?php echo $subtitle ?>
        </small>
      <?php endif; ?>
    </h1>

    <div>
      <?php the_content(); ?>
    </div>

  <?php
    endwhile;
    wp_reset_query();
  ?>
</main>

<?php get_footer(); ?>
