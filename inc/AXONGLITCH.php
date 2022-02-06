<?php 

function generateMenuTemplates($menuName) {
  $content = '
  <ax-elements 
  mode="dropdown"
  headTitlecolor="#FFF4A3"
  height="70"
  color="#282A35"
  colorHover="#fff"
  activeBackground="#282A35"
  headBackground="#0000"
  headBackgroundHover="#04AA6D"
  structure="dropdownGroup"
  title="Menu"
  background="#cbcbcb"
  subOpening="sub"
  subTrigger="click">';
      
  $menus = wp_get_nav_menus();
  for ($i=0; $i < count($menus); $i++) {
    for ($j=$i; $j < count($menus); $j++) {
      $MenuOrderI = get_field("order_index", wp_get_nav_menu_object($menus[$i]->name))||0;
      $MenuOrderJ = get_field("order_index", wp_get_nav_menu_object($menus[$j]->name))||0;
      if($MenuOrderI > $MenuOrderJ) {
        $temp = $menus[$i];
        $menus[$i] = $menus[$j];
        $menus[$j] = $temp;
      }
    }
  }
  foreach ( $menus as $menu ) :
    $menuData = wp_get_nav_menu_object($menu->name);
    if(get_field("location_on_theme", $menuData) == $menuName && (get_field("show_on_empty", $menuData) || count(wp_get_nav_menu_items( $menuData )))) :
      $structureContent = "";
      foreach(get_field('structure', $menuData) as $structure) $structureContent .= "$structure ";
      $content .= "<ax-elements 
      mode='dropdown'
      exit='". get_field('exit', $menuData) ."'
      headTitle='". get_field("headtitle", $menuData) ."'
      headTitlecolor='". get_field("headtitlecolor", $menuData) ."'
      height='". get_field("height", $menuData) ."'
      color='". get_field("color", $menuData) ."'
      colorHover='". get_field("colorHover", $menuData) ."'
      activeBackground='". get_field("activeBackground", $menuData) ."'
      headBackground='". get_field("headBackground", $menuData) ."'
      headBackgroundHover='". get_field("headBackgroundHover", $menuData) ."'
      structure='". $structureContent ."'
      title='". get_field("title", $menuData) ."'
      background='". get_field("background", $menuData) ."'
      targetLocator='". strtolower(str_replace(' ', '_', get_field("headtitle", $menuData))) ."_targetLocator'
      subOpening='". get_field("subopening", $menuData) ."'
      subTrigger='". get_field("subtrigger", $menuData) ."'
      options='". json_encode(wordpressAXDropdownContent(wp_get_nav_menu_items($menuData->name))) ."'></ax-elements>";
    endif; endforeach;
  $content .= '</ax-elements>';

  echo $content;
}

// handler menu items to export a json in format of required in AXG library
function wordpressAXDropdownContent($data) {
  $level=0;
  $menuObj=array();
  $menuObj2=array();
  for($i=0; $i<count($data); $i++) {
    $object = new stdClass();
    $object->title = $data[$i]->title;
    $object->url = $data[$i]->url;
    $data[$i]->menu_item_parent==0?$object->level = "undertab":null;
    if($data[$i]->menu_item_parent == 0) {
      $object->color = "#FFF4A3";
      $menuObj[$data[$i]->ID] = $object;
    } else {
      // $object->color = "#fff";
      $menuObj[$data[$i]->menu_item_parent]->content[] = $object;
    }
  }
  foreach ($menuObj as $value) $menuObj2[] = $value;
  return $menuObj2;
}

function axg_dropdownsbody($menus) {
  $content = '<section class="ax_elements" nomain="true">';

  foreach ( $menus as $menu ) {
    $menuData = wp_get_nav_menu_object($menu->name);
    if(get_field('location_on_theme', $menuData)) {
      $structureContent = '';
      $structuredata = get_field('structure', $menuData);
      $count=0;
      foreach ($structuredata as $structure) {
        $count++;
        $structureContent .= $count == count($structuredata)
        ? "$structure"
        : "$structure ";
      }

      $id = strtolower(str_replace(' ', '_', get_field('headtitle', $menuData)));
      $id .= '_targetLocator';
      $content .= "
        <section class='dropdown $structureContent' mode='$structureContent' nomain='true'>
          <div class='dropdownTakeout' id='$id'></div>
        </section>
      ";
    }
  }
  $content .= '</section>';
  echo $content;
}


function axg_headerLogo($custom_logo_id) {
  if ( function_exists( 'the_custom_logo' ) ) {
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    $src = esc_url( $logo[0] );
    $alt = get_bloginfo( 'name' );
    echo '
      <ax-elements
      mode="logo" 
      src="'.$src.'"
      link="/"
      alt="'.$alt.'"
      ></ax-elements>
    ';
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