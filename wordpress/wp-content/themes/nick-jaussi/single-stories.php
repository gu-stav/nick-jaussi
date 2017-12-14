<?php get_header(); ?>

<main class="main">
  <div class="story-detail js-slider">
    <div class="story-detail__canvas js-slider-canvas">
      <?php
        while ( have_posts() ) : the_post();
          $subtitle = rwmb_meta('story_subtitle');
          $title = get_the_title();
          $intro = get_the_content();
          $type = $STORY_TYPES[rwmb_meta('story_type')];
          $images = rwmb_meta('story_images');
          $videos = rwmb_meta('story_videos');

          if ($intro) :
      ?>

        <div class="story-detail-slide story-detail-slide--intro js-slider-slide">
          <div class="story-detail-slide__content">
            <h1 class="story-detail-slide__title">
              <?php if ($type) : ?>
                <small class="story-detail-slide__type">
                  <?php echo $type ?>
                  <span class="visually-hidden">:</span>
                </small>
              <?php endif; ?>

              <?php echo $title; ?>

              <?php if ($subtitle) : ?>
                <small class="story-detail-slide__sub-title">
                  <?php echo $subtitle ?>
                </small>
              <?php endif; ?>
            </h1>

            <div class="story-detail-slide__text-content">
              <?php echo $intro; ?>
            </div>
          </div>
        </div>

      <?php endif; ?>

        <?php
          foreach ($videos as $list) :
            foreach($list as $video) :
        ?>

          <figure class="story-detail-slide js-slider-slide">
            <div class="story-detail-slide__image-wrap">
              <video controls
                     src="<?php echo $video['src']; ?>"
                     poster="<?php echo $video['image']['src']; ?>" />
            </div>

            <figcaption class="story-detail-slide__caption"><?php echo $video['description']; ?></figcaption>
          </figure>
        <?php
            endforeach;
          endforeach;
        ?>

        <?php
          foreach ($images as $list) :
            foreach($list as $image) :
        ?>
              <figure class="story-detail-slide js-slider-slide">
                <div class="story-detail-slide__image-wrap">
                  <?php echo wp_get_attachment_image($image['ID'], 'story-image'); ?>
                </div>

                <figcaption class="story-detail-slide__caption"><?php echo $image['description']; ?></figcaption>
              </figure>
        <?php
            endforeach;
          endforeach;
        ?>

      <?php
        endwhile;
        wp_reset_query();
      ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>
