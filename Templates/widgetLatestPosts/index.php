<?php

function widgetLatestPosts() {
  require_once('template.php');
}

add_action( 'wp_enqueue_scripts', 'widgetLatestPosts_loadcss' );
function widgetLatestPosts_loadcss() {
  wp_enqueue_style( 'widgetLatestPostsStyle', plugin_dir_url( __FILE__ ) . 'style.css' );
}