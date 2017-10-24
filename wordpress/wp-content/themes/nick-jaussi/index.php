<?php global $STORY_TYPES; ?>

<?php get_header(); ?>

<main class="main">
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
        <a href="<?php the_permalink(); ?>">
          <?php if ($type) : ?>
            <small class="story-tile__type">
              <?php echo $type ?>
              <span class="visually-hidden">:</span>
            </small>
          <?php endif; ?>

          <?php echo get_the_title(); ?>
        </a>
      </h2>
    </div>

  <?php
      endwhile;
      wp_reset_query();
    endif;
  ?>
</div>

<?php get_footer(); ?>
