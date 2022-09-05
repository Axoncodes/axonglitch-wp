<?php

add_action( 'wp_enqueue_scripts', 'axg_assets_loader' );
function axg_assets_loader() {
  $source = "https://axg.axoncodes.com";

  // css
  wp_enqueue_style("axg_dropdown_style", "$source/dropdown/v3/style"); // dropdown
  wp_enqueue_style("axg_logo_style", "$source/logo/assets/css/style.css"); // logo
  wp_enqueue_style("axg_scrolldownAnimation_style", "$source/scrolldownAnimation/assets/css/style.css"); // scrolldownAnimation
  wp_enqueue_style("axg_fontVars_style", "$source/assets/css/fontVars.css"); // fontVars
  wp_enqueue_style("axg_colorVars_style", "$source/assets/css/colorVars.css"); // colorVars
  wp_enqueue_style("axg_activationHandler_style", "$source/activationHandler/style.css"); // naturalizer
  wp_enqueue_style("axg_searchbar_style", "$source/searchbar/template/style.css"); // searchbar
  wp_enqueue_style("axg_postsView_style", "$source/assets/css/postsView.css"); // postsView

  // js
  wp_register_script("axg_registery_script-module", "$source/init/v4", '', array(), true); wp_enqueue_script('axg_registery_script-module');
  wp_register_script("axg_dropdown_script", "$source/dropdown/v3/script", '', array(), true); wp_enqueue_script('axg_dropdown_script');
  wp_register_script("axxg_activationHandler_script", "$source/activationHandler/index.js", '', array(), true); wp_enqueue_script('axxg_activationHandler_script');
  wp_register_script("axg_searchbar_script", "$source/searchbar/script/script.js", '', array(), true); wp_enqueue_script('axg_searchbar_script');
  wp_register_script("axg_searchbar_template_script", "$source/searchbar/template/main.js", '', array(), true); wp_enqueue_script('axg_searchbar_template_script');
}

?>