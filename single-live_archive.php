<?php
/**
 * The template for displaying single live archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Creatio_Imogen_Clark
 * @since Creatio Imogen-clark 1.0
 */

get_header();

$id = get_the_ID();
$background_image = get_field('background_image',  $id );
$background_overlay = get_field('background_overlay',  $id );



?>
<style>
.postid-<?php echo $id ; ?> .site-main{
	background-image: linear-gradient(<?php echo $background_overlay ; ?>, <?php echo $background_overlay ; ?>), url(<?php echo $background_image['url']; ?>);
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
	position: relative;
}

</style>

<div class="live_archive-single ">
<div style="height:95px" aria-hidden="true" class="wp-block-spacer"></div>
<div class="back__to-live-archive wide__container m-b-3">
	<a href="<?php echo site_url('/live-archive'); ?>">	
		<svg xmlns="http://www.w3.org/2000/svg" width="24.411" height="10.381" viewBox="0 0 24.411 10.381">
			<g id="Group_16" data-name="Group 16" transform="translate(-77.307 -130.154)">
				<path id="Path_17" data-name="Path 17" d="M2356.976,130l-4.643,4.844,4.643,4.844" transform="translate(-2274.332 0.5)" fill="none" stroke="#919191" stroke-width="1"/>
				<line id="Line_6" data-name="Line 6" x2="23.617" transform="translate(78.102 135.344)" fill="none" stroke="#919191" stroke-width="1"/>
			</g>
		</svg>

		<span>Back to Live Archive</span>
	</a>

</div>


<?php


if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content/content','live-archive');
	}


} 
?>
</div>
<?php

get_footer();
