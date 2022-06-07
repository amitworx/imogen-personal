<?php
/**
 *  WordPress_Theme
 */


class WordPress_Theme {
    public $text_domain;
    // public static $number_of_theme_footer_widgets;
     public $theme_name;
	/**
   	* Constructor
    */

	function __construct($textDomain = "",$thmemeName = "") {
        
        //setting up theme name 
      $this->theme_name=$thmemeName;

        // setting up text domain
      $this->text_domain = $textDomain;

      $this->ver = ELJANNAH_DEV_MODE ? time(): false;

      // setting up footer widgets 
      add_action( 'widgets_init', array($this, 'theme_widgets_init' ));

      // init theme support
      add_action('after_setup_theme', array($this, 'init'));
        
      // setup styles and scripts
      add_action('wp_enqueue_scripts', array($this,'theme_style_setup'));

      add_action('wp_enqueue_scripts', array($this,'theme_script_setup'));
      
      // side-bar
      add_action( 'widgets_init', array($this,'theme_sidebars'));

   
     
       
    }
    public function theme_style_setup(){ 
          wp_enqueue_style('magnific-style', get_theme_file_uri('/assets/css/magnific-popup.css'), array());  
          wp_enqueue_style('main-style', get_stylesheet_uri() ,array());          
	}
    
   

    public function theme_script_setup(){
        // scripts
        wp_enqueue_script('magnific-js', get_theme_file_uri('/assets/js/jquery.magnific-popup.min.js'), array('jquery'), microtime(), true);  
        wp_enqueue_script('main-js', get_theme_file_uri('/assets/js/scripts-bundled.js'), array('jquery'), microtime(), true);  
        wp_localize_script( 'main-js', 'imogenAjaxData', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'noposts' => __('No older posts found'),
            'maxlivearchivepages' => get_max_live_archive_page(),
            'livearchiveppp' => LIVE_ARCHIVE_PPP
        ));
    
	}




	/**
   	* Theme setup
  	*/
      public function init() {
        /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        */
        load_theme_textdomain( $this->text_domain, get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
        add_theme_support( 'title-tag' );

        /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        add_theme_support( 'post-thumbnails' );
        // add_image_size('blog-thumbnail', 750, 300, true);
        // set_post_thumbnail_size( 1080, 320, true );
		// add_image_size( 'gallery-img', 800, 600, true );
       
        // Add theme support for Custom Logo
        add_theme_support( 'custom-logo', array(
            // 'width' => 100,
            // 'height' => 0,
            // 'flex-width' => true,
        ));


		// Register navigation menus
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', $this->text_domain ),
            'social' => esc_html__( 'Social Menu', $this->text_domain ),
        ) );    



        // removes editor custom font sizes
        add_theme_support('disable-custom-font-sizes');    

        // add custom font sizes
        add_theme_support( 'editor-font-sizes', array(
            array(
                'name' => __( 'Itc Avant Garde Gothic STD Medium 10', 'creatio'),
                'size' =>10,
                'slug' => 'itc-avant-garde-gothic-std-medium-10'
            ),

            array(
                'name' => __( 'Itc Avant Garde Gothic STD Medium 17', 'creatio'),
                'size' =>11,
                'slug' => 'itc-avant-garde-gothic-std-medium-17'
            ),


            array(
                'name' => __( 'Itc Avant Garde Gothic STD Bold 22', 'creatio'),
                'size' =>12,
                'slug' => 'itc-avant-garde-gothic-std-bold-22'
            ),


            array(
                'name' => __( 'Itc Avant Garde Gothic STD Bold 24', 'creatio'),
                'size' =>13,
                'slug' => 'itc-avant-garde-gothic-std-bold-24'
            ),

            array(
                'name' => __( 'Itc Avant Garde Gothic STD Bold 28', 'creatio'),
                'size' =>14,
                'slug' => 'itc-avant-garde-gothic-std-bold-28'
            ),


            array(
                'name' => __( 'Itc Avant Garde Gothic STD Bold 52', 'creatio'),
                'size' =>15,
                'slug' => 'itc-avant-garde-gothic-std-bold-52'
            ),

        ) );
            
        // Editor Color Palette
        add_theme_support( 'editor-color-palette', array(

            array(
                'name'  => __( 'Creatio White', 'creatio'),
                'slug'  => 'creatio-white',
                'color'	=> '#FFF',
            ),

            array(
                'name'  => __( 'Creatio Black', 'creatio'),
                'slug'  => 'creatio-black',
                'color'	=> '#000',
            ),

            
        ) );




    }
 

    public function theme_widgets_init(){
         // First footer widget area, located in the footer. Empty by default.
        register_sidebar( array(
            'name' => __( 'First Footer Widget Area', $this->text_domain ),
            'id' => 'first-footer-widget-area',
            'description' => __( 'The first footer widget area', $this->text_domain ),
            'before_widget' => '<div id="%1$s" class="widget-container footer-collumn footer-collumn__logo %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<a class="widget-title footer-collumn__title">',
            'after_title' => '</a>',
        ) );
    
        // Second Footer Widget Area, located in the footer. Empty by default.
        register_sidebar( array(
            'name' => __( 'Second Footer Widget Area', $this->text_domain ),
            'id' => 'second-footer-widget-area',
            'description' => __( 'The second footer widget area', $this->text_domain ),
            'before_widget' => '<div id="%1$s" class="widget-container footer-collumn  %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<a class="widget-title footer-collumn__title">',
            'after_title' => '</a>',
        ) );
 
        // Third Footer Widget Area, located in the footer. Empty by default.
        register_sidebar( array(
            'name' => __( 'Third Footer Widget Area', $this->text_domain ),
            'id' => 'third-footer-widget-area',
            'description' => __( 'The third footer widget area', $this->text_domain ),
            'before_widget' => '<div id="%1$s" class="widget-container footer-collumn  %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<a class="widget-title footer-collumn__title">',
            'after_title' => '</a>',
        ) );

        // Fourth Footer Widget Area, located in the footer. Empty by default.
        register_sidebar( array(
            'name' => __( 'Fourth Footer Widget Area', $this->text_domain ),
            'id' => 'fourth-footer-widget-area',
            'description' => __( 'The fourth footer widget area', $this->text_domain ),
            'before_widget' => '<div id="%1$s" class="widget-container  footer-collumn  %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<a class="widget-title footer-collumn__title">',
            'after_title' => '</a>',
        ) );

        // Fifth Footer Widget Area, located in the footer. Empty by default.
        register_sidebar( array(
            'name' => __( 'Fifth Footer Widget Area', $this->text_domain ),
            'id' => 'fifth-footer-widget-area',
            'description' => __( 'The fifth footer widget area', $this->text_domain ),
            'before_widget' => '<div id="%1$s" class="widget-container footer-collumn footer-collumn__socials  %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<a class="widget-title footer-collumn__title">',
            'after_title' => '</a>',
        ) );

        // Sixth Footer Widget Area, located in the footer. Empty by default.
        register_sidebar( array(
            'name' => __( 'Sixth Footer Widget Area', $this->text_domain ),
            'id' => 'sixth-footer-widget-area',
            'description' => __( 'The Sixth footer widget area', $this->text_domain ),
            'before_widget' => '<div id="%1$s" class="widget-container footer-collumn  %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<a class="widget-title footer-collumn__title">',
            'after_title' => '</a>',
        ) );
    }





    // side bar and widgets

    function theme_sidebars(){

       
        register_sidebar(
            array (
                'name' => __( 'Sidebar', $this->text_domain  ),
                'id' => 'sidebar',
                'description' => __( 'Sidebar',  $this->text_domain ),
                'before_widget' => '<div class="sidebar__card">',
                'after_widget' => "</div>",
                'before_title' => '<h2 class="sidebar__card-headline">',
                'after_title' => '</h2>',
            )
        );    

    }

}