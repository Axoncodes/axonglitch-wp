<?php
  if( have_rows('social_medias', get_option( 'page_on_front' )) ): ?>
  <section id="lf_about_socialmedia">
      <h2 class="lf_head_title">Follow us</h2>
      <p class="lf_head_p">Our social medias where you can find useful data and news and offers about our services</p>        <div class="lf_about_items">
      <?php while( have_rows('social_medias', get_option( 'page_on_front' )) ) : the_row();
          echo '
              <div class="lf_about_item">
                  <a aria-label="test" 
                  href="'.get_sub_field('link').'" 
                  target="_blank" 
                  class="ax_footer_btn">
                      <img 
                      alt="'.get_sub_field('name').'" 
                      width="22px" 
                      height="22px" 
                      src="'.get_template_directory_uri().'/assets/icons/'.get_sub_field('name').'.svg" />
                      <p class="lf_p">'.ucfirst(get_sub_field('name')).'</p>
                  </a>
              </div>';
      endwhile; ?>
      </div>
  </section>
<?php endif; ?>