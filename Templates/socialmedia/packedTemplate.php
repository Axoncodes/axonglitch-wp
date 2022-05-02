<div class="axg_packedTemplate">
  <?php
    if( have_rows('social_medias', get_option( 'page_on_front' )) ):
      while( have_rows('social_medias', get_option( 'page_on_front' )) ) : the_row();
        echo '
          <a rel="noopener noreferrer"
            aria-label="'.get_sub_field('name').'"
            href="'.get_sub_field('link').'" 
            target="_blank" 
            class="ax_footer_btn">
          <img 
            alt="'.get_sub_field('name').'" 
            width="22px" 
            height="22px" 
            src="'.get_template_directory_uri().'/assets/icons/'.get_sub_field('name').'.svg" /></a>';
      endwhile;
    else :
    endif;
  ?>
</div>