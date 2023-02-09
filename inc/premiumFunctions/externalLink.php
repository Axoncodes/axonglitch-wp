<?php

function getTheLink($post) {
  return get_post_meta( $post->ID, '_externalLink', true ) ? get_post_meta( $post->ID, '_externalLink', true ) : get_the_permalink() ;
}

function externalLink_html( $post ) { 
  $value = get_post_meta( $post->ID, '_externalLink', true );
?>
  <input name="externalLink_n" type="text" value="<?php echo $value ?>"/>

<?php }

function externalLink_metabox() {
  $screens = [ 'post' ];
  foreach ( $screens as $screen ) {
    // Register meta box timetoread
    add_meta_box(
        'externalLink',
        'External Link',
        'externalLink_html',
        $screen
    );
  }
}

function externalLink_postdata( $post_id ) {
  // timetoread
  if ( array_key_exists( 'externalLink_n', $_POST ) ) {
      update_post_meta(
          $post_id,
          '_externalLink',
          $_POST['externalLink_n']
      );
  }
}

add_action( 'save_post', 'externalLink_postdata' );
add_action( 'add_meta_boxes', 'externalLink_metabox' );