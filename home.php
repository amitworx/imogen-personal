<?php
/**
 * The template for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Creatio_Imogen_Clark
 * @since Creatio Imogen-clark 1.0
 */

get_header(); ?>
<div class = "section__home">
<div class="wide__container ">	
		<?php echo do_shortcode('[page-title title="IMAIL"]') ;?>
		<?php
		if ( have_posts() ) :?>

		<?php $num_posts = $wp_query->post_count; 
			if ( $num_posts > 1 ) {
				$class = 'grid grid-50-50';
			} else {
				$class = '';
			}
		?>
		<div class="article__list  <?php echo $class ; ?>">
		<?php
			// Load posts loop.
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content/content','post');
			}
		?>
		</div>
		<?php
		endif;
		?>
	
</div>
	</div>
<?php
get_footer();
