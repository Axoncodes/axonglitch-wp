<div id="lf_footer_latestposts">
  <?php 
    $lf_latest_posts_footer = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>2));
    if ( $lf_latest_posts_footer->have_posts() ) :
  ?>
  <p class="ax_footer_title">Latest Posts</p>
  <div class="lf_items">
    <?php while ( $lf_latest_posts_footer->have_posts() ) : $lf_latest_posts_footer->the_post(); ?>
    <div class="lf_item">
      <a href="<?php the_permalink(); ?>">
        <div class="lf_poster">
          <?php echo wordpressAXCustomImage(
            get_the_post_thumbnail_url(), 
            get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE), 
            "", "", "lazy", "", "", 
            ["thumbnail"]
          ); ?>
        </div>
        <div class="lf_context">
          <p class="lf_title"><?php echo get_the_title(); ?></p>
          <div class="lf_meta">
            <p class="lf_meta_item"><img alt="comment" width="17" height="17" src="/wp-content/themes/lightfusion/assets/icons/comment-dark.svg"><span><?php echo get_comments_number(); ?></span></p>
            <p class="lf_meta_item"><img alt="calendar" width="17" height="17" src="/wp-content/themes/lightfusion/assets/icons/calendar-dark.svg"><span><?php echo get_the_date(); ?></span></p>
          </div>
        </div>
      </a>
    </div>
    <?php
      endwhile;
      wp_reset_postdata();
    ?>
  </div>
  <?php endif; ?>
</div>