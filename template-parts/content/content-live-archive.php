<?php
    $id = get_the_ID();
    $event_date = get_field('event_date',  $id );
    $location = get_field('location',  $id );
    $event_date_formatted = DateTime::createFromFormat('d/m/Y', $event_date);
   


    // single event variables
    // venue
    $venue_name = get_field('venue_name',  $id );
    $venue_full_address = get_field('venue_full_address',  $id );

?>


<?php 
if ( is_singular( 'live_archive' ) ):
    //your code here...
?>
 <div class="live__archive-article">
    <!--- header --->
    <div class="live__archive-header">
            <div class="live__archive-header-left">
                <div class  = "la__title">
                    <h1 class="has-creatio-cyan-color"><?php the_title(); ?></h1>
                </div>
                <div class="la__date">
                    <?php echo $event_date_formatted->format('l, F d Y'); ?>
                </div>
            </div>
            <div class="live__archive-header-right">
                <div class  = "la__index-title">
                    <h2>LIVE ARCHIVE</h2>
                </div>
                <div class="la__nav">
                        <?php 
                         // get prev gig - live_archive
                            $prev_archive_id = get_prev_live_archive_id(get_the_ID());
                            $prev_archive_link = get_permalink($prev_archive_id);
                        ?>
                        
                        <a class="la__nav-link-prev" href="<?php echo $prev_archive_link ; ?>">
                            <span><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" class="svg-inline--fa fa-chevron-left fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg></span>
                            <span class="la__nav-link-prev-text">PREV GIG</span>
                        </a>

                        <?php 
                         // get next gig - live_archive
                            $next_archive_id = get_next_live_archive_id(get_the_ID());
                            $next_archive_link = get_permalink($next_archive_id);
                        ?>
                        <a class="la__nav-link-next" href="<?php echo  $next_archive_link ;?>">
                            <span class="la__nav-link-next-text">NEXT GIG</span>
                            <span><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg></span>
                            
                        </a>
                </div>
            </div>
    </div>

    <!-- content-left -->
    <div class="live__archive-content">
    <div class="live__archive-content-left">
         <?php
            // venue
            if($venue_name):
         ?>
            <div class="live__archive-content-left--section live__archive-content-left--venue">
                <h3 class="title__line letter-spacing-8">
                   VENUE
                </h3>
                <h4 class="has-creatio-cyan-color"><?php echo $venue_name ; ?></h4>
                <p><?php echo $venue_full_address ; ?></p>
            </div>
        <?php
            endif;
         ?>
    



    <?php
            // musician
        if( have_rows('lead_musician') || have_rows('musicians')):
        ?>
        <div class="live__archive-content-left--section live__archive-content-left--musician">
                <h3 class="title__line letter-spacing-8">
                    MUSICIANS
                </h3>
            <?php if(get_field('lead_musician')):?>
                <ul class="lead__musician-list creatio__list">
                  
            
            <?php
                while( have_rows('lead_musician') ) : the_row();
                $name = get_sub_field('name');
            ?>
                    <li class="lead__musician-list-item has-creatio-cyan-color">
                   
                        <?php echo $name ; ?>
                    </li>           
            <?php
            endwhile;
            ?>
             </ul>
            <?php
            endif; 
            ?>


            <?php if(get_field('musicians')):?>
                <ul class="musician-list creatio__list">
            <?php
                while( have_rows('musicians') ) : the_row();
                $name = get_sub_field('name');
            ?>
                
                    <li class="lead__musician-list-item">
                        <?php echo $name ; ?>
                    </li>
                
            <?php
            endwhile;?>
            </ul>
            <?php
            endif;
            ?>

        </div>
    <?php
        endif;
    ?>




       <?php
            // Setlist
        if( have_rows('setlist')):
        ?>
        <div class="live__archive-content-left--section live__archive-content-left--setlist">
            <h3 class="title__line letter-spacing-8">
                SETLIST
            </h3>
            <ol class="lead__musician-list creatio__list creatio__ordered-list">
        <?php
            while( have_rows('setlist') ) : the_row();
            $title = get_sub_field('title');
            $listen_now_link = get_sub_field('listen_now_link');
        ?>
           
                <li class="lead__musician-list-item has-creatio-cyan-color">
                   <span> <?php echo $title ; ?></span>
                        <?php if($listen_now_link):?>
                        <a href="<?php echo $listen_now_link ; ?>" class="listen-now-link">
                            <span class="listen-now-link-text">LISTEN NOW</span>
                        </a>
                    <?php endif; ?>
                </li>
            
        <?php
        endwhile;
        ?>
        </ol>
        </div>
    <?php
        endif;
    ?>


    



       <?php
            // time
        if( get_field('start_time') || get_field('end_time')):
        ?>
        <div class="live__archive-content-left--section live__archive-content-left--time">
           <?php  if( get_field('start_time')) :?>
           <p> Start time:  <time> <?php echo get_field('start_time'); ?> </time>
           <?php endif; ?>
           <?php  if( get_field('end_time')) :?>
           <p> End time  <time> <?php echo get_field('end_time'); ?> </time>
           <?php endif; ?>
        </div>
    <?php
        endif;
    ?>


        <?php
            // other_acts
        if( have_rows('other_acts')):
        ?>
        <div class="live__archive-content-left--section live__archive-content-left--other-acts">
            <h3 class="title__line letter-spacing-8">
                OTHER ACTS
            </h3>
           <div class="creatio__columns-2">
        <?php
            while( have_rows('other_acts') ) : the_row();
            $act = get_sub_field('act');
           
        ?>
           
                <p>
                    <?php echo $act ; ?>
                </p>
            
        <?php
        endwhile;
        ?>
        </div>
        </div>
    <?php
        endif;
    ?>

















    </div>
    <!--- content-right --->
    <div class="live__archive-content-right">
            



    <?php
            // videos 
        if( have_rows('videos')):
        ?>
        <div class="live__archive-content-right--section live__archive-content-right--videos">
            <h3 class="title__line letter-spacing-8">
                VIDEOS
            </h3>
           <div class="grid grid-50-50">
        <?php
            while( have_rows('videos') ) : the_row();
            $y_id = get_sub_field('youtube_video_id');
           
        ?>
           <div class="wp-block-embed__wrapper">
           <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $y_id ;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
           </div>
        <?php
        endwhile;
        ?>
        </div>
        </div>
    <?php
        endif;
    ?>







<?php
            // photos 
        if( have_rows('photos')):
            $i = 0;
            if($i==0){
                $grid_sizer = "live__archive-gallery-sizer";
            }else{
                $grid_sizer = "";
            }
        ?>
        <div class="live__archive-content-right--section live__archive-content-right--photos">
            <h3 class="title__line letter-spacing-8">
                PHOTOS
            </h3>
           <div class="live__archive-gallery">
        <?php
            while( have_rows('photos') ) : the_row();
            $photo = get_sub_field('photo');
            // var_dump($photo);
        ?>
              <a href = "<?php echo $photo['url'] ;?>" >
                <img src="<?php echo $photo['sizes']['medium'] ;?>" alt="" class="live__archive-gallery-item  <?php echo $grid_sizer ;?>">
              </a>
      
        <?php
        $i++;
        endwhile;
        ?>
        </div>
        <a href="#" class="creatio__btn m-t-5">VIEW ALL</a>
        </div>

        
    <?php
        endif;
    ?>



        <?php
            // review 
        if( have_rows('reviews')):
        ?>
        <div class="live__archive-content-right--section live__archive-content-right--reviews">
            <h3 class="title__line letter-spacing-8">
                REVIEWS
            </h3>
           <div>
        <?php
            while( have_rows('reviews') ) : the_row();
            $review = get_sub_field('review');
           
        ?>
            <p class="has-creatio-cyan-color"> <?php echo $review ;?></p>
      
        <?php
        endwhile;
        ?>
        </div>
        </div>
    <?php
        endif;
    ?>



    <?php
            // recordings 
        if( have_rows('recordings') || have_rows('audience_recordings') || have_rows('audience_videos')  ):
        ?>
        <div class="live__archive-content-right--section live__archive-content-right--recordings">
            <h3 class="title__line letter-spacing-8">
                RECORDINGS
            </h3>
          
                
           <?php
                // recordings
                if( have_rows('recordings') ):
            ?>
                <div class="live__archive-recordings">
                        <?php
                            while( have_rows('recordings') ) : the_row();
                            $title = get_sub_field('title');
                            $link_text = get_sub_field('link_text');
                            $link_url = get_sub_field('link_url');
                            $open_link_in_new_tab = get_sub_field('open_link_in_new_tab') ? 'target="_blank"' : '';
                        ?>
                            <p class="has-creatio-cyan-color live__archive-recordings--item"> 
                                <?php echo $title ;?>
                                <a class="creatio__btn" href="<?php echo $link_url ;?>" <?php echo $open_link_in_new_tab ;?>>
                                    <?php echo $link_text ;?>
                                </a>
                            </p>
                    
                        <?php
                        endwhile;
                        ?>
                </div>
                <?php endif; ?>


                <?php 
                    // audience_recordings
                    if( get_field('audience_recordings') ):
                ?>
                     <div class="live__archive-recordings">
                        <p>Audience recordings:<p>
                        <p><?php echo get_field('audience_recordings') ;?></p>
                    </div>
                <?php
                endif ;
                ?>

                <?php 
                    // audience_recordings
                    if( get_field('audience_videos') ):
                ?>
                     <div class="live__archive-recordings">
                        <p>Audience video:<p>
                        <p><?php echo get_field('audience_videos') ;?></p>
                    </div>
                <?php
                endif ;
                ?>





               
        </div>
    <?php
        endif;
    ?>











    </div> <!--  end live__archive-content-right -->
</div> <!--  end live__archive-content -->
     </div> <!-- end live__archive-article -->

<?php 
else:
    //your code here...
?>

    <div class="la__row">
        <div class="la__info">
            <div class="la__date">
                <time><?php  echo $event_date_formatted->format('M d Y');  ; ?></time>
            </div>
            <div class="la__title">
                <h4><a href="<?php the_permalink();?>"><?php the_title() ; ?></a></h4>
            </div>
        
        </div>
        <div class="la__location">
                <?php echo $location  ;?>
        </div>
        <div class="la__button">
                <a href="<?php the_permalink();?>"  > 
                VIEW GIG
                </a>
        </div>
    </div>

<?php
endif;