<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Creatio_Imogen_Clark
 * @since Creatio Imogen-clark 1.0
 */

?>

<header id="masthead" class="header" role="banner">
	<div class="wide__container nav__wrapper">
		<?php get_template_part( 'template-parts/header/main-nav' ); ?>
		<?php get_template_part( 'template-parts/header/header-logo' ); ?>
		<?php get_template_part( 'template-parts/header/social-nav' ); ?>
		<?php get_template_part( 'template-parts/header/mobile-toggle' ); ?>
	</div>
</header><!-- #masthead -->
