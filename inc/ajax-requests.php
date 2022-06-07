<?php


// get track details

add_action("wp_ajax_get_track_details", "fn_get_imogen_track_details");
add_action("wp_ajax_nopriv_get_track_details", "fn_get_imogen_track_details");


function fn_get_imogen_track_details(){
    $post_id = $_POST["id"];
    $track_title = trim($_POST["tracktitle"]);
    $result = "";
    $result .= get_template_part('template-parts/content/track','detail', array(
        'data' => array(
            'post_id' => $post_id,
            'track_title' => $track_title
        )
    ));
  die($result);
}



// get next music

add_action("wp_ajax_get_next_music", "fn_get_get_next_music");
add_action("wp_ajax_nopriv_get_next_music", "fn_get_get_next_music");

function  fn_get_get_next_music(){
      $post_id = $_POST["id"];

      $next_id = get_next_music_id($post_id);
      // $next_post_id = $array[$key+1];
      $poster =  get_field('music_album_poster', $next_id);
      $next_post = [get_permalink($next_id), $poster['url'], $next_id];
      die( json_encode($next_post));
}










// get previous music

add_action("wp_ajax_get_previous_music", "fn_get_get_previous_music");
add_action("wp_ajax_nopriv_get_previous_music", "fn_get_get_previous_music");

function  fn_get_get_previous_music(){
    $post_id = $_POST["id"];
     $array =[];
      $args = array(
          'post_type'      => 'music_album',
          'posts_per_page' =>-1 ,
        
          'orderby' => 'menu_order',
          'order' => 'ASC',
          'post_status' => array('publish'),

      );
      $music_album = new WP_Query($args);
      if ($music_album->have_posts()) :
      // If there are posts matching the query then start the loop
      while ( $music_album->have_posts() ) : $music_album->the_post();
            $array[] = get_the_ID();
      endwhile ;
      wp_reset_postdata();
      endif;
      $key = array_search($post_id, $array);
      // $end = end($array);
      if($key == 0){
          $prev_id = $array[count($array)-1];
      }else{
          $prev_id = $array[$key-1];
      }
      // $next_post_id = $array[$key+1];
      $poster =  get_field('music_album_poster', $prev_id);
      $prev_post = [get_permalink($prev_id), $poster['url'], $prev_id];
      die( json_encode($prev_post));
}







// search live archive
add_action("wp_ajax_live_archive_search", "fn_search_live_archive");
add_action("wp_ajax_nopriv_live_archive_search", "fn_search_live_archive");

function fn_search_live_archive(){
    $keyword =  isset( $_POST["keyword"]) ? $_POST["keyword"] : ""; 
    $result = "";
    // query 

    
    $q1 = get_posts(array(
        'post_type' => 'live_archive',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num menu_order',
        'order' => 'DESC',
        's' => $keyword,
    ));

    $q2 = get_posts(array(
        'post_type'         => 'live_archive',
        'post_status'       => 'publish',
        'posts_per_page'    => '-1',
        'meta_query' => array(
            array(
               'key' => 'location',
               'value' => $keyword,
               'compare' => 'LIKE'
            )
         )
    ));
    // $meta_query="";
    // if($keyword){
    //     $meta_query = array(
    //         'relation' => 'OR',
    //         array(
    //             'key' => 'location',
    //             'value' => $keyword,
    //             'compare' => 'LIKE'
    //         )
    //     );
    // }
    // $args = array(  
    //     'post_type' => 'live_archive',
    //     'posts_per_page' => -1, 
    //     'meta_key' => 'event_date',
    //     'orderby' => 'meta_value_num menu_order',
    //     'order' => 'DESC',
    //     'post_status' => array('publish'),
    //     'meta_query' => $meta_query
    // );

    $merged = array_merge( $q1, $q2 );
    $post_ids = array();
    foreach( $merged as $item ) {
        $post_ids[] = $item->ID;
    }
    $unique = array_unique($post_ids);
    if(!$unique){
        $unique=array('0');
    }
        


    $args = array(
        'post_type' => 'live_archive',
        'posts_per_page' => '-1',
        'post__in' => $unique,
        'paged' => get_query_var('paged'),
    );


    $las = new WP_Query( $args ); 
    if ( $las->have_posts() ) :
    while ( $las->have_posts() ) : $las->the_post(); 
    ?>

    <?php

    // template

    $result .=  get_template_part('template-parts/content/content','live-archive');
    endwhile;
    wp_reset_postdata(); 
    endif;


    die($result );
}




// search live archive
add_action("wp_ajax_live_archive_search_reset", "fn_live_archive_search_reset");
add_action("wp_ajax_nopriv_live_archive_search_reset", "fn_live_archive_search_reset");

function fn_live_archive_search_reset(){
    $result = "";
    $postsPerPage = -1;
    $args = array(
        'post_type'      => 'live_archive',
        'posts_per_page' =>$postsPerPage ,
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num menu_order',
        'order' => 'DESC',
        'post_status' => array('publish'),
        // 'meta_query' => array(
        //     array(
        //     'key' => 'event_date',
        //     'compare' => '<',
        //     'value' => $today,
        //     'type' => 'DATETIME'
        //     )
        // )
    );
    $live_archive = new WP_Query($args);
    if ($live_archive->have_posts()) :
    // If there are posts matching the query then start the loop
    while ( $live_archive->have_posts() ) : $live_archive->the_post();
       
            
    ?>
    <?php   $result .= get_template_part('template-parts/content/content','live-archive'); ?>
    
    <?php 
        endwhile ;
        wp_reset_postdata();
        endif;
        die($result );

}




// sort live archive

// sort 
add_action("wp_ajax_live_archive_sort", "fn_live_archive_sort");
add_action("wp_ajax_nopriv_live_archive_sort", "fn_live_archive_sort");



function fn_live_archive_sort(){



    $result = "";
    // query 
    $sortkey = $_POST["sortKey"]  ;
    $keyword =  isset( $_POST["keyword"]) ? $_POST["keyword"] : ""; 
    $postsPerPage = $_POST["postPerPage"];
    $result = "";
    // query 

   // $postsPerPage = 5;
    switch($sortkey){
        case "newest_date":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                'meta_key'       => 'event_date',
                'orderby'        => 'meta_value_num ',
                'order'          => 'DESC',
                'post_status' => array('publish'),
            );

            break;
        case "oldest_date":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                'meta_key'       => 'event_date',
                'orderby'        => 'meta_value_num ',
                'order'          => 'ASC',
                'post_status' => array('publish'),
            );
            break;
        
        case "location_a_z":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                'meta_key'       => 'location',
                'orderby'        => 'meta_value',
                'order'          => 'ASC',
                'post_status' => array('publish'),
            );
            break;

        case "location_z_a":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                'meta_key'       => 'location',
                'orderby'        => 'meta_value',
                'order'          => 'DESC',
                'post_status' => array('publish'),
            );
            break;
        
        case "venue_a_z":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
               // 'meta_key'       => 'event_date',
                'orderby'        => 'title',
                'order'          => 'ASC',
                'post_status' => array('publish'),
            );
            break;
        
        case "venue_z_a":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                // 'meta_key'       => 'event_date',
                'orderby'        => 'title',
                'order'          => 'DESC',
                'post_status' => array('publish'),
            );
            break;
    }



    // $meta_query="";
    // if($keyword){
    //     $meta_query = array(
    //         array(
    //             'key' => 'top_five_skills_$_skills',
    //             'value' => $keyword,
    //             'compare' => 'LIKE'
    //         )
    //         );
    // }
    
    // if($sortkey == "avail"){
    //     $args = array(  
    //         'post_type' => 've_va',
    //         'post_status' => 'publish',
    //         'posts_per_page' => -1, 
    //         'meta_key' => 'availability',
    //         'orderby' => 'meta_value_num title', 
    //         'order' => 'DESC', 
    //         'meta_query' => $meta_query
    //     );
    // }
    // if($sortkey == "title"){
    //     $args = array(  
    //         'post_type' => 've_va',
    //         'post_status' => 'publish',
    //         'posts_per_page' => -1, 
    //         'orderby' => 'title', 
    //         'order' => 'ASC', 
    //         'meta_query' => $meta_query
    //     );
    // }
  
    $las = new WP_Query( $args ); 
    if ( $las->have_posts() ) :
    while ( $las->have_posts() ) : $las->the_post(); 
    ?>

    <?php

    // template

    // $las = $las->max_num_pages;
    // die($las);

    $result .= get_template_part('template-parts/content/content','live-archive'); 
    endwhile;
    wp_reset_postdata(); 
    endif;


    die($result );
}






 
add_action("wp_ajax_live_archive_load_more", "fn_live_archive_load_more");
add_action("wp_ajax_nopriv_live_archive_load_more", "fn_live_archive_load_more");



function fn_live_archive_load_more(){
    $pagenumber = $_POST["pagenumber"];
    $sortkey = $_POST["sortkey"]  ;
    $postsPerPage = $_POST["postPerPage"];
    $result = "";

   

    // $args = array(
    //     'post_type'      => 'live_archive',
    //     'posts_per_page' =>  5 ,
    //     'paged'          =>  $pagenumber,
    //     'meta_key'       => 'event_date',
    //     'orderby'        => 'meta_value_num menu_order',
    //     'order'          => 'DESC',
    //     'post_status' => array('publish'),
    // );

    switch($sortkey){
        case "newest_date":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                'paged'          =>  $pagenumber,
                'meta_key'       => 'event_date',
                'orderby'        => 'meta_value_num ',
                'order'          => 'DESC',
                'post_status' => array('publish'),
            );

            break;
        case "oldest_date":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                'paged'          =>  $pagenumber,
                'meta_key'       => 'event_date',
                'orderby'        => 'meta_value_num ',
                'order'          => 'ASC',
                'post_status' => array('publish'),
            );
            break;
        
        case "location_a_z":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                'paged'          =>  $pagenumber,
                'meta_key'       => 'location',
                'orderby'        => 'meta_value',
                'order'          => 'ASC',
                'post_status' => array('publish'),
            );
            break;

        case "location_z_a":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                'paged'          =>  $pagenumber,
                'meta_key'       => 'location',
                'orderby'        => 'meta_value',
                'order'          => 'DESC',
                'post_status' => array('publish'),
            );
            break;
        
        case "venue_a_z":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                'paged'          =>  $pagenumber,
               // 'meta_key'       => 'event_date',
                'orderby'        => 'title',
                'order'          => 'ASC',
                'post_status' => array('publish'),
            );
            break;
        
        case "venue_z_a":
            $args = array(
                'post_type'      => 'live_archive',
                'posts_per_page' =>  $postsPerPage ,
                'paged'          =>  $pagenumber,
                // 'meta_key'       => 'event_date',
                'orderby'        => 'title',
                'order'          => 'DESC',
                'post_status' => array('publish'),
            );
            break;
    }


    $la = new WP_Query( $args ); 
    if ( $la->have_posts() ) :
    while ( $la->have_posts() ) : $la->the_post(); 
    ?>

    <?php

    // template

    // $las = $las->max_num_pages;
    // die($las);

    $result .= get_template_part('template-parts/content/content','live-archive'); 
    endwhile;
    wp_reset_postdata(); 
    endif;

    die($result );
}
