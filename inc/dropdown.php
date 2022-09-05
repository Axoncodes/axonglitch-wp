<?php
// all related function to dropdowns in AXG

function generateMenuTemplates($menuName) {
  $dropdowncount = 0;
  $content = '
    <axg-element 
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
    subTrigger="click"
    dropdownid="headerMenuGroup"
  >';
      
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
      // echo $menu->slug."-";
      $content .= "<axg-element 
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
        options='". json_encode(wordpressAXDropdownContent(wp_get_nav_menu_items($menuData->name))) ."'
        dropdownid='".$menu->slug."'
      ></axg-element>";
    endif; endforeach;
  $content .= '</axg-element>';

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
      $menuObj[$data[$i]->menu_item_parent]->content[] = $object;
    }
  }
  foreach ($menuObj as $value) $menuObj2[] = $value;
  return $menuObj2;
}

function axg_dropdownsbody($menus) {
  $content = '<section class="ax_elements" nomain="true">';
  $dropdowncount = 1;
  foreach ( $menus as $menu ) {
    
    $menuData = wp_get_nav_menu_object($menu->name);
    $structureContent = "";
    foreach(get_field('structure', $menuData) as $structure) $structureContent .= "$structure ";
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
      $content .= "<axg-element
        mode='dropdown_body'
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
        options='". json_encode(wordpressAXDropdownContent(wp_get_nav_menu_items($menuData->name))) ."'
        dropdownid='".$menu->slug."'
      ></axg-element>";
    }
  }
  $content .= '</section>';
  echo $content;
}

function fetchHeaderMenus() {
  $menus = wp_get_nav_menus();
  $validMenues = array();
  foreach ( $menus as $menu ) {
    $menuData = wp_get_nav_menu_object($menu->name);
    if (get_field('location_on_theme', $menuData) == "header") array_push($validMenues, $menu);
  }
  return $validMenues;
}