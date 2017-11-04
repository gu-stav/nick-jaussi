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
            </div>
          </div>

          <?php
            foreach ($images as $list) :
              foreach($list as $image) :
                $description = $image['description'];
          ?>
                <figure class="js-slide story-detail-slide"
                     data-slide-title="<?php echo sanitize_title($image['title']); ?>"
                     data-slide-image="<?php echo esc_html(wp_get_attachment_image($image['ID'], 'story-image')); ?>">

                  <noscript>
                    <?php echo wp_get_attachment_image($image['ID'], 'story-image'); ?>
                  </noscript>

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

    <div class="story-detail__slider-controls">
      <button class="js-slider-control story-detail__slider-control"
              data-direction="previous">
              <svg viewBox="0 0 1792 1792"
                   xmlns="http://www.w3.org/2000/svg">
                <path d="M1664 896v128q0 53-32.5 90.5t-84.5 37.5h-704l293 294q38 36 38 90t-38 90l-75 76q-37 37-90 37-52 0-91-37l-651-652q-37-37-37-90 0-52 37-91l651-650q38-38 91-38 52 0 90 38l75 74q38 38 38 91t-38 91l-293 293h704q52 0 84.5 37.5t32.5 90.5z" />
              </svg>
        <span class="visually-hidden">Previous Image</span>
      </button>

      <button class="js-slider-control story-detail__slider-control"
              data-direction="next">
        <svg viewBox="0 0 1792 1792"
             xmlns="http://www.w3.org/2000/svg">
          <path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293h-704q-52 0-84.5-37.5t-32.5-90.5v-128q0-53 32.5-90.5t84.5-37.5h704l-293-294q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z" />
        </svg>
        <span class="visually-hidden">Next Image</span>
      </button>
    </div>
  </div>
</main>

<?php get_footer(); ?>
