<?php



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



function creatio_add_custom_post_type() {

	/*

		register_post_type(
			string       $post_type,
			array|string $args = array()
		)

		For a list of $args, check out:
		https://developer.wordpress.org/reference/functions/register_post_type/

	*/

	// tours
	$args = array(
		'labels'             => array( 'name' => 'Tours' ),
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'show_in_rest'         => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'tour' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','page-attributes' ),
    );

	register_post_type( 'tour', $args );




	// live archives
	$args = array(
		'labels'             => array( 'name' => 'Live Archives' ),
		'public'             => true,
		'publicly_queryable' => true ,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'show_in_rest'         => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'live-archive' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','page-attributes' ),
    );

	register_post_type( 'live_archive', $args );




	// music
	$args = array(
		'labels'             => array( 'name' => 'Music' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'show_in_rest'         => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'music' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','page-attributes' ),
    );

	register_post_type( 'music_album', $args );



}

add_action( 'init', 'creatio_add_custom_post_type' );







// add performance date column to live archive cpt
add_filter( 'manage_live_archive_posts_columns', 'creatio_live_archive_posts_columns' );
function creatio_live_archive_posts_columns( $columns ) {
	$columns = array(
		'cb' => $columns['cb'],
		'title' => __( 'Title' ),
		'p_date' => __( 'Performance Date', 'smashing' ),
	  );
  return $columns;
}

add_action( 'manage_live_archive_posts_custom_column', 'creatio_live_archive_column', 10, 2);
function creatio_live_archive_column( $column, $post_id ) {
  // Performance Date
  if ( 'p_date' === $column ) {
    echo get_field('event_date', $post_id);
  }
}



add_filter( 'acf/fields/relationship/result', function ( $title, WP_Post $post, $field_arr ) {

	if ( $post->post_type == 'live_archive' ) {
		$event_date = get_field( 'event_date', $post->ID );
		return '<strong>' . $title . '</strong><br>' . $event_date; ;
	}

    
  }, 10, 3 );