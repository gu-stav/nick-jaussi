<?php global $STORY_TYPES; ?>

<?php get_header(); ?>

<main class="main">
  <div class="stories-grid">
    <?php
      $stories = get_all_stories();

      while ( $stories->have_posts() ) : $stories->the_post();
        $color = rwmb_meta('story_color');
    ?>

      <div class="story-tile"
           <?php if($color) { echo 'style="background-color: ' . $color . '"' } ?>>
        <a href="<?php the_permalink(); ?>">
          <?php
            $img_id = get_post_thumbnail_id();
            $img_src = wp_get_attachment_image_url($img_id, 'story-preview');
            $img_srcset = wp_get_attachment_image_srcset($img_id, 'story-preview');
            $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
            $img_sizes = '(max-width: 760px) 100vw,' .
                         '(max-width: 980px) 400px,' .
                         '(max-width: 1200px): 500px,' .
                         '720px';
          ?>

          <img src="<?php echo esc_url($img_src); ?>"
               srcset="<?php echo esc_attr($img_srcset); ?>"
               sizes="<?php echo esc_attr($img_sizes) ?>"
               alt="<?php echo esc_attr($img_alt); ?>" />

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
        </a>
      </div>

    <?php
      endwhile;
      wp_reset_query();
    ?>
  </div>
</div>

<?php get_footer(); ?>
