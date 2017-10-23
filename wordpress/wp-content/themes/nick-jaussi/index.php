<?php global $STORY_TYPES; ?>

<?php get_header(); ?>

<?php
  $stories = get_all_stories();

  if ( $stories->have_posts() ) :
    while ( $stories->have_posts() ) : $stories->the_post();
?>

      <div class="story-tile">
        <?php
          echo the_post_thumbnail('story-preview');
        ?>

        <?php
          $type = $STORY_TYPES[rwmb_meta('story_type')];
        ?>

        <h2 class="story-tile__title">
          <?php if ($type) : ?>
            <small class="story-tile__type">
              <?php echo $type ?>
              <span class="visually-hidden">:</span>
            </small>
          <?php endif; ?>

          <?php echo get_the_title(); ?>
        </h2>
      </div>

    <?php endwhile; ?>
  <?php endif; ?>

<?php get_footer(); ?>
