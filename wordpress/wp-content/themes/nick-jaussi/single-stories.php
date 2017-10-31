<?php get_header(); ?>

<main class="main">
  <div class="story-detail js-slider">
    <div class="story-detail__frame">
      <div class="story-detail__slides">
        <?php
          while ( have_posts() ) : the_post();
            $subtitle = rwmb_meta('story_subtitle');
            $type = $STORY_TYPES[rwmb_meta('story_type')];
            $images = rwmb_meta('story_images');
        ?>
          <div class="story-detail-slide story-detail-slide--intro">
            <?php
              echo the_post_thumbnail('story-image');
            ?>

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

              <button class="story-detail-slide__trigger">
                Anschauen
              </button>
            </div>
          </div>

          <?php
            foreach ($images as $list) :
              foreach($list as $image) :
          ?>
                <div class="story-detail-slide">
                  <?php echo wp_get_attachment_image($image['ID'], 'story-image'); ?>
                </div>
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
  </div>
</main>

<?php get_footer(); ?>
