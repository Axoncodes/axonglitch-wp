<?php

// theme supports
add_theme_support( 'menus' );
add_theme_support( 'title-tag' );
add_post_type_support( 'page', 'excerpt' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
add_theme_support( 'custom-logo' );

// disable Gutenberg
add_filter('use_block_editor_for_post', '__return_false', 10);

//** *Enable upload for webp image files.*/
function webp_upload_mimes($existing_mimes) {
  $existing_mimes['webp'] = 'image/webp';
  return $existing_mimes;
}

add_filter('mime_types', 'webp_upload_mimes');
//** * Enable preview / thumbnail for webp image files.*/
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }
    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);