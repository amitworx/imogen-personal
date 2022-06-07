<?php
/**
 * Displays the site header logo .
 *
 * @package WordPress
 * @subpackage Creatio_Imogen_Clark
 * @since Creatio Imogen-clark 1.0
 */

?>

<div class="main-logo">
                  
                  <a href="<?php echo site_url();?>" class="logo-link">
                          <?php 
                                  
                                  $custom_logo_id = get_theme_mod( 'custom_logo' );
                                  $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                  if ( has_custom_logo() ) {
                                          echo '<img class="site-logo" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                                  }else{
                                          echo "<span>IMOGEN CLARK</span>";
                                  }
                                  
                          ?>
                  </a>
</div>