<?php get_header(); ?>

<main class="main">
  <div class="text">
    <?php
      while ( have_posts() ) : the_post();
    ?>

      <h1 class="text__title">
        <?php the_title(); ?>
      </h1>

      <figure class="text__author-image">
        <?php
          $img_id = get_post_thumbnail_id();
          $img_meta = wp_get_attachment_metadata($img_id);
          $img_caption = $img_meta['image_meta']['caption']
        ?>

        <?php the_post_thumbnail('portrait'); ?>

        <?php if ($img_caption) : ?>
          <figcaption><?php echo $img_caption; ?></figcaption>
        <?php endif; ?>
      </figure>

      <div class="text__content">
        <?php the_content(); ?>
      </div>

    <?php
      endwhile;
      wp_reset_query();
    ?>
  </div>
</main>

<?php get_footer(); ?>
