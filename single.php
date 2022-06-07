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

get_header(); ?>


<?php


if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/content/content','post');
	}


} 

get_footer();
