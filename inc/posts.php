<?php

function articles($wpb_all_query) {
	$posts = array();
	if ( $wpb_all_query->have_posts() ) :
		while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();
			$object = new stdClass();
			$object->link = urlencode(getTheLink($post));
			$object->title = urlencode(get_the_title());
			
			$categories = [];
			foreach((get_the_category()) as $category) $categories[] = $category->name;
			$object->categories = $categories;

			$object->excerpt = urlencode(get_the_excerpt());
			$object->thumbnail = new stdClass();
			$object->thumbnail->src = urlencode(get_the_post_thumbnail_url());
			$object->thumbnail->sizes = ["small"];
			$object->thumbnail->loading = "lazy";
			$object->thumbnail->alt = urlencode(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE));
			$object->thumbnail->width = "300";
			$object->thumbnail->height = "86";
			$posts[] = $object;
		endwhile;
		wp_reset_postdata();
	endif;

	$jsonencodedPosts = json_encode($posts);
	echo "<axg-element
		mode='postsView_v1'
		title='Articles'
		hashlink='#ax_homeblog'
		btntitle='Enter the Weblog'
		link='/blog'
		itemsbtntitle='Read This'
		bg='var(--bg1)'
		posts='".$jsonencodedPosts."'
	></axg-element>";
}