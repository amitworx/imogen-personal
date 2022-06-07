<?php
/**
 * The template for displaying single blog
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

<div class="music-single container">

<div style="height:95px" aria-hidden="true" class="wp-block-spacer"></div>





<?php


if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/content/content','music');
	}


} 
?>

</div>

<?php
get_footer();
