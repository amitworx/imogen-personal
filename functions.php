<?php


// gloabl variables

$theme_name = "Creatio Imogen Clark";
$theme_text_domain = "creatio";


$theme_dir = get_template_directory();
$theme_uri = get_template_directory_uri();



if ( ! defined( 'THEME_DIR' ) ) {
	define( 'THEME_DIR', $theme_dir );
}
if ( ! defined( 'THEME_URI' ) ) {
	define( 'THEME_URI', $theme_uri );
}
// posts per page - live_archive 
define( 'LIVE_ARCHIVE_PPP', 10);


// env
define('ELJANNAH_DEV_MODE',true);



// custom blocks
require THEME_DIR .'/inc/custom-blocks.php';


// acf options page
require THEME_DIR .'/inc/theme-options.php';

// Instantiate theme
require THEME_DIR .'/inc/WordPress_Theme.php';
$creatio_imogen_theme = new WordPress_Theme($theme_name,$theme_text_domain);


// shortcodes
require THEME_DIR .'/inc/theme-shortcodes.php';

// custom post types
require THEME_DIR .'/inc/creatio-cpt.php';

// helper function
require THEME_DIR.'/inc/helper-functions.php';


// AJAX related functions
if ( defined( 'DOING_AJAX' ) AND DOING_AJAX ) {
    require THEME_DIR . '/inc/ajax-requests.php';
}




