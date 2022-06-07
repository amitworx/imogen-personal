<?php
/**
 * Displays the site social navigation.
 *
 * @package WordPress
 * @subpackage Creatio_Imogen_Clark
 * @since Creatio Imogen-clark 1.0
 */

?>

<?php if ( has_nav_menu( 'social' ) ) : ?>
	<nav id="site__social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social menu', 'creatio' ); ?>">
		
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'social',
				'menu_class'      => 'menu-wrapper',
				'container_class' => 'social-menu-container',
				'items_wrap'      => '<ul id="social-menu-list" class="social-menu-list %2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
		?>
	</nav><!-- #site-navigation -->
<?php endif; ?>
