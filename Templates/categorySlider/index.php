<?php

function categorySlider() {
  $content = '';
  $content .= '<section id="ax_hero_image">';

  $categoryOrganizerActivation = get_field('frontpage_category_section');
  if($categoryOrganizerActivation) {
    $categoryOrganizer = getCategoriesJson();
    $content .= axgImgen(
      $categoryOrganizer[0]->image,
      get_field('main_intro')['main_title']?get_field('main_intro')['main_title']:"hero image",
      "ax_hero_img",
      "", "auto", "", "",
      ["small", "medium", "large"]
    );
  } else {
    $content .= axgImgen(
      get_the_post_thumbnail_url(),
      get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE),
      "ax_hero_img",
      "", "auto", "", "",
      ["small", "medium", "large"]
    );
  }

  if ($categoryOrganizerActivation) {
    $content .= '<div class="ax_tabs" home="'.is_front_page().'">
      <div id="ax_tabs_inside_cover">'.getHeadTabItemsHtml().'</div>
    </div>';
  }

  $content .= '</section>';
  return $content;
}