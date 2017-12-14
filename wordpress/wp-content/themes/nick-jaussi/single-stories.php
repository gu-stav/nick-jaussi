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
          $videoVimeo = rwmb_meta('story_video_vimeo');
          $mediacount = 1;

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

      <?php if ($videoVimeo) : ?>

        <figure class="story-detail-slide js-slider-slide"
                data-id="<?php echo $mediacount; ?>">
          <div class="story-detail-slide__video-wrap">
            <?php echo wp_oembed_get($videoVimeo); ?>
          </div>
        </figure>

      <?php
        $mediacount++;
      endif;
      ?>

        <?php
          foreach ($images as $list) :
            foreach($list as $image) :
        ?>
              <figure class="story-detail-slide js-slider-slide"
                      data-id="<?php echo $mediacount; ?>">
                <div class="story-detail-slide__image-wrap">
                  <?php echo wp_get_attachment_image($image['ID'], 'story-image'); ?>
                </div>

                <figcaption class="story-detail-slide__caption"><?php echo $image['description']; ?></figcaption>
              </figure>
        <?php
              $mediacount++;
            endforeach;
          endforeach;
        ?>

      <?php
        endwhile;
        wp_reset_query();
      ?>

      <div class="story-detail-slide story-detail-slide--outro js-slider-slide">
        <div class="story-detail-slide__content">
          <p>This is the end, my friend!</p>
          <a href="<?php echo home_url(); ?>">Show all stories</a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>
