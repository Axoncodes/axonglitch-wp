<?php

// gallery modification
add_filter( 'the_content', 'wpdocs_show_gallery_image_urls', 10, 99 );
function wpdocs_show_gallery_image_urls( $content ) {
    global $post;
    if(strpos($content, '[gallery') !== false) {
    	$lf_gallery_count=0;
    	$image_list = 
    	'<h2 class="lf_track_title lf_gallery_h2">Gallery</h2>
    	<section id="lf_landing_gallery">
    		<div class="lf_left">
    			<button aria-label="test" class="lf_gallery_ctrl" id="lf_gallery_next">
    				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/></svg>
    			</button>
    			<svg id="lf_landing_main_pic_fullscreen_go" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 14c-.55 0-1 .45-1 1v3c0 .55.45 1 1 1h3c.55 0 1-.45 1-1s-.45-1-1-1H7v-2c0-.55-.45-1-1-1zm0-4c.55 0 1-.45 1-1V7h2c.55 0 1-.45 1-1s-.45-1-1-1H6c-.55 0-1 .45-1 1v3c0 .55.45 1 1 1zm11 7h-2c-.55 0-1 .45-1 1s.45 1 1 1h3c.55 0 1-.45 1-1v-3c0-.55-.45-1-1-1s-1 .45-1 1v2zM14 6c0 .55.45 1 1 1h2v2c0 .55.45 1 1 1s1-.45 1-1V6c0-.55-.45-1-1-1h-3c-.55 0-1 .45-1 1z"/></svg>
    			<button aria-label="test" class="lf_gallery_ctrl" id="lf_gallery_prev">
    				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/></svg>
    			</button>
    		</div>
    		<div class="lf_right">';
         foreach( get_post_gallery_images( $post ) as $image_url ) {
            $image_list .= '<img alt="test" loading="lazy" id="lf_gallery_active" class="lf_gallery_item item_'.$lf_gallery_count.'" src="'.$image_url . '" alt="test"/>';
            $lf_gallery_count++;
        }
        $image_list .= '</section>';
        
        $content_before_gallery = substr($content, 0, strpos($content, '[gallery'));
		$content_tmp_gallery = substr($content, strpos($content, '[gallery'));
		$content_after_gallery = substr($content_tmp_gallery, strpos($content_tmp_gallery, '"]')+2);
		$content = $content_before_gallery.$image_list.$content_after_gallery;
    }
    return $content;
}

function wpse_load_plugin_css() {
  $plugin_url = plugin_dir_url( __FILE__ );

  wp_enqueue_style( 'axg_gallery_style', $plugin_url . 'style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpse_load_plugin_css' );

?>