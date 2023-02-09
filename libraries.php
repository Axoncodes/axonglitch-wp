<?php

add_action( 'wp_enqueue_scripts', 'axg_assets_loader' );
function axg_assets_loader() {
  $source = "http://localhost:3012";
  // $source = "https://axg.axoncodes.com";
  wp_register_script("axg_activationHandler_script-module-async", "$source/layoutactivationJs/init", '', array(), true); wp_enqueue_script('axg_activationHandler_script-module-async');
  wp_register_script("axg_registery_script-module-async", "$source/init/v4/dev", '', array(), false); wp_enqueue_script('axg_registery_script-module-async');
}

// script tag modification
add_filter('script_loader_tag', 'script_modify', 10, 3);
function script_modify($tag, $handle, $src) {
	$asyncDiffer = 'defer';
	if (strpos($handle, "-async") !== false) $asyncDiffer = 'async';
	$module = '';
	if (strpos($handle, "-module") !== false) $module = 'type="module"';
	if (strpos($handle, "axg") !== false) return "<script id='$handle-js' src='$src' $module $asyncDiffer></script>";
	else return $tag;
}

?>