<?php get_header(); ?>

<main class="main">
  <div class="story-detail js-slider">
    <div class="story-detail__canvas js-slider-canvas">
      <?php
        while ( have_posts() ) : the_post();
          $subtitle = rwmb_meta('story_subtitle');
          $type = $STORY_TYPES[rwmb_meta('story_type')];
          $images = rwmb_meta('story_images');
      ?>
        <div class="story-detail-slide story-detail-slide--intro story-detail-slide--active js-slider-slide">
          <div class="story-detail-slide__content">
            <h1 class="story-detail-slide__title">
              <?php if ($type) : ?>
                <small class="story-detail-slide__type">
                  <?php echo $type ?>
                  <span class="visually-hidden">:</span>
                </small>
              <?php endif; ?>

              <?php the_title(); ?>

              <?php if ($subtitle) : ?>
                <small class="story-detail-slide__sub-title">
                  <?php echo $subtitle ?>
                </small>
              <?php endif; ?>
            </h1>

            <div class="story-detail-slide__text-content">
              <?php the_content(); ?>
            </div>
          </div>
        </div>

        <?php
          foreach ($images as $list) :
            foreach($list as $image) :
              $description = $image['description'];
        ?>
              <figure class="js-slide story-detail-slide">
                <div class="story-detail-slide__image-wrap">
                  <?php echo wp_get_attachment_image($image['ID'], 'story-image'); ?>
                </div>

                <?php if($description) : ?>
                  <figcaption class="story-detail-slide__caption">
                    <?php echo $description; ?>
                  </figcaption>
                <?php endif; ?>
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
