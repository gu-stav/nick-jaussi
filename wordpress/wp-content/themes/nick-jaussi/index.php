<?php get_header(); ?>

<?php
  $stories = new WP_Query(
    array(
      'post_type' => 'stories',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    )
  );

  if ( $stories->have_posts() ) :
    while ( $stories->have_posts() ) : $stories->the_post();
?>

  <div class="story-tile">
    <h2 class="story-tile__title">
      <?php echo get_the_title(); ?>
    </h2>
  </div>

<?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>
