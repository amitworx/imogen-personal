<?php 

// Allow SVG
function allow_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
add_filter( 'upload_mimes', 'allow_mime_types' );



// replacing social nav menu items with icon/svgs
add_filter('wp_nav_menu_objects', 'creatio_wp_nav_menu_objects', 10, 2);

function creatio_wp_nav_menu_objects( $items, $args ) {
	// loop
	foreach( $items as &$item ) {
		// vars
		$icon = get_field('inline_svg_markup', $item);
		// append icon
		if( $icon ) {
			// var_dump(	$item->title);
			$item->title =  $icon;
			
		}
	}
	// return
	return $items;
	
}



// get next music id
function get_next_music_id($post_id){
	$array =[];
	$args = array(
		'post_type'      => 'music_album',
		'posts_per_page' =>-1 ,
	  
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_status' => array('publish'),

	);
	$music_album = new WP_Query($args);
	if ($music_album->have_posts()) :
	// If there are posts matching the query then start the loop
	while ( $music_album->have_posts() ) : $music_album->the_post();
		  $array[] = get_the_ID();
	endwhile ;
	wp_reset_postdata();
	endif;
	$key = array_search($post_id, $array);
	// $end = end($array);
	if($key == count($array)-1){
		$next_id = $array[0];
	}else{
		$next_id = $array[$key+1];
	}

	return $next_id;
}





// get prev live_archive id

function get_prev_music_id($post_id){
	$array =[];
	$args = array(
		'post_type'      => 'music_album',
		'posts_per_page' =>-1 ,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_status' => array('publish'),
	);
	$music_album = new WP_Query($args);
	if ($music_album->have_posts()) :
	// If there are posts matching the query then start the loop
	while ( $music_album->have_posts() ) : $music_album->the_post();
		  $array[] = get_the_ID();
	endwhile ;
	wp_reset_postdata();
	endif;
	$key = array_search($post_id, $array);
	// $end = end($array);
	if($key == 0){
		$prev_id = $array[count($array)-1];
	}else{
		$prev_id = $array[$key-1];
	}

	return $prev_id;
}







// get next live_archive id
function get_next_live_archive_id($post_id){
	$array =[];
	$args = array(
		'post_type'      => 'live_archive',
		'posts_per_page' =>-1 ,
		'meta_key' => 'event_date',
		'orderby' => 'meta_value_num menu_order',
		'order' => 'DESC',
		'post_status' => array('publish'),

	);
	$live_archive = new WP_Query($args);
	if ($live_archive->have_posts()) :
	// If there are posts matching the query then start the loop
	while ( $live_archive->have_posts() ) : $live_archive->the_post();
		  $array[] = get_the_ID();
	endwhile ;
	wp_reset_postdata();
	endif;
	$key = array_search($post_id, $array);
	// $end = end($array);
	if($key == count($array)-1){
		$next_id = $array[0];
	}else{
		$next_id = $array[$key+1];
	}

	return $next_id;
}






// get prev live_archive id

function get_prev_live_archive_id($post_id){
	$array =[];
	$args = array(
		'post_type'      => 'live_archive',
		'posts_per_page' =>-1 ,
		'meta_key' => 'event_date',
		'orderby' => 'meta_value_num menu_order',
		'order' => 'DESC',
		'post_status' => array('publish'),
	);
	$live_archive = new WP_Query($args);
	if ($live_archive->have_posts()) :
	// If there are posts matching the query then start the loop
	while ( $live_archive->have_posts() ) : $live_archive->the_post();
		  $array[] = get_the_ID();
	endwhile ;
	wp_reset_postdata();
	endif;
	$key = array_search($post_id, $array);
	// $end = end($array);
	if($key == 0){
		$prev_id = $array[count($array)-1];
	}else{
		$prev_id = $array[$key-1];
	}

	return $prev_id;
}



// check if a string can be parsed as a date
function isDate($value) 
{
    if (!$value) {
        return false;
    }

    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}



// get live_archive max pages
function get_max_live_archive_page(){
	$args = array(
        'post_type'      => 'live_archive',
        'posts_per_page' =>  LIVE_ARCHIVE_PPP ,
        'meta_key'       => 'event_date',
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
        'post_status' => array('publish'),
    );

    $la = new WP_Query( $args ); 
	$max_page = $la->max_num_pages;
	return $max_page;
}