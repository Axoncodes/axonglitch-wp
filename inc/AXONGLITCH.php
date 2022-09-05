<?php 

require_once('dropdown.php');
require_once('posts.php');

function axg_headerLogo($custom_logo_id) {
  if ( function_exists( 'the_custom_logo' ) ) {
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    $src = esc_url( $logo[0] );
    $alt = get_bloginfo( 'name' );
    echo '<axg-element
      mode="logo" 
      src="'.$src.'"
      link="/"
      alt="'.$alt.'"
    ></axg-element>';
  }
}

function searchScript() {
  $search_name_arr = [];
  $search_link_arr = [];

  $wpb_all_query = new WP_Query(array('post_type'=>'page', 'post_status'=>'publish', 'posts_per_page'=>-1));
  if ( $wpb_all_query->have_posts() ) :
    while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();
      array_push($search_name_arr, get_the_title());
      array_push($search_link_arr, get_the_permalink());
    endwhile;
    wp_reset_postdata();
  endif;
  $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1));
  if ( $wpb_all_query->have_posts() ) :
    while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();
      array_push($search_name_arr, get_the_title());
      array_push($search_link_arr, get_the_permalink());
    endwhile;
    wp_reset_postdata();
  endif;

  $search_name = implode('", "', $search_name_arr);
  $search_link = implode('", "', $search_link_arr);
  echo "
    <script>
      var all_posts_names = [\"$search_name\"];
      var all_posts_links = [\"$search_link\"];
    </script>
  ";
}

?>