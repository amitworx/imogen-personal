<?php


// shortcode API
add_action( 'init', 'register_shortcodes');

function register_shortcodes(){
	// adding shortcode for page title
	add_shortcode('page-title', 'fn_page_title');
}



function fn_page_title($atts){
    $id = get_the_ID();
    $title = get_the_title($id);
    $atts = shortcode_atts( 
		array(
			'title'   =>  $title,
		), 
		$atts
	);
	ob_start(); ?>
        <div style="height:95px" aria-hidden="true" class="wp-block-spacer"></div>
		<h2 class="has-itc-avant-garde-gothic-std-bold-28-font-size has-creatio-white-color page__title" ><?php echo $atts['title'];?></h2>
		<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
		<hr class="wp-block-separator has-text-color has-background is-style-wide" style="background-color:#373131;color:#373131">
		<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
 <?php 
 return ob_get_clean();
}





function display_year() {
    $year = date('Y');
    return $year;
}
add_shortcode('year', 'display_year');