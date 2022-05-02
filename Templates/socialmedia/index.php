<?php

function socialmediaLargeWidget() {
  require_once('largeTemplate.php');
}

function socialmediaPackedWidget() {
  require_once('packedTemplate.php');
}

add_action( 'wp_enqueue_scripts', 'socialmedia_loadcss' );
function socialmedia_loadcss() {
  wp_enqueue_style( 'axg_socialmediaLargeWidget_style', plugin_dir_url( __FILE__ ) . 'largeTemplate.css' );
  wp_enqueue_style( 'axg_packedTemplateWidget_style', plugin_dir_url( __FILE__ ) . 'packedTemplate.css' );
}