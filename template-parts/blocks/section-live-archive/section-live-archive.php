<?php

/**
 *  Live Archive Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */



?>
<div class="la__block-header">
    <div class="la__block-header--left">
        <div class="la__blocK-title">
            <h2>LIVE ARCHIVE</h2>
        </div>
    </div>

    <div class="la__block-header--right">
        <div class="select__wrapper">
            <select>
               
                <option value="newest_date">Sort Newest Date</option>
                <option value="oldest_date">Sort Oldest Date</option>
                <option value="location_a_z">Sort Location A-Z</option>
                <option value="location_z_a">Sort Location Z-A</option>
                <option value="venue_a_z">Sort Venue A-Z</option>
                <option value="venue_z_a">Sort Venue Z-A</option>
            </select>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" class="svg-inline--fa fa-angle-down fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg>
        </div>
        <div class="search__wrapper">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="svg-inline--fa fa-search fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg>
            <input type="text" placeholder = "Search for Title, city, location…">
        </div>    


    </div>
</div>

<div  class="la__block" id="la__block" data-page="1">



       

            <?php 

                // custom loop for live_archive


                $postsPerPage = LIVE_ARCHIVE_PPP;
                $args = array(
                    'post_type'      => 'live_archive',
                    'posts_per_page' =>  $postsPerPage ,
                    'meta_key'       => 'event_date',
                    'orderby'        => 'meta_value_num menu_order',
                    'order'          => 'DESC',
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
            <?php   get_template_part('template-parts/content/content','live-archive'); ?>
               
            <?php 
                endwhile ;
                wp_reset_postdata();
                endif;
            ?>
 </div>
