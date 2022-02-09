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
    $content .= '
    <div class="ax_tabs" home="'.is_front_page().'">
      <div id="ax_tabs_inside_cover">'.getHeadTabItemsHtml().'</div>
    </div>';
  }

  $content .= '</section>';

  $mainIntro=get_field('main_intro');
  if ($mainIntro) {
    $content .= '
    <div id="ax_headings">
      <div class="lf_txt">
        <h1 class="ax_heading">'.strtoupper($mainIntro['main_title']).'</h1>
        <p class="ax_heading_p">'.$mainIntro['short_description'].'</p>
      </div>
    </div>';
  }

  if ($categoryOrganizerActivation) {
    $content .= '
    <section id="ax_services" home="'.is_front_page().'">
      <div id="lf_cats_sub"></div>
      <div class="ax_items"></div> 
    </section>';
  }

  return $content;
}