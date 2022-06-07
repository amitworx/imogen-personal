<?php

/**
 *  Music Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */



?>


<div  class="music__block">
       

            <?php 

                // custom loop for tours
                $postsPerPage = -1;
            
                $args = array(
                    'post_type'      => 'music_album',
                    'posts_per_page' =>$postsPerPage ,
                  
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'post_status' => array('publish'),
         
                );
                $music_album = new WP_Query($args);
                if ($music_album->have_posts()) :
                // If there are posts matching the query then start the loop
                while ( $music_album->have_posts() ) : $music_album->the_post();
                   
                    
            ?>
            <?php   get_template_part('template-parts/content/content','music'); ?>
               
            <?php 
                endwhile ;
                wp_reset_postdata();
                endif;
            ?>
</div>
