<?php

    $id = get_the_ID();
    $music_album_poster = get_field('music_album_poster',  $id );
    $buy_now_link = get_field('buy_now_link',  $id );
    $buy_now_link_open_in_new_tab = get_field('buy_now_link_open_in_new_tab',  $id ) ? "target = '__blank'" : "target = '__self'" ;
    $lisnten_now_link = get_field('lisnten_now_link',  $id );
    $lisnten_now_link_open_in_new_tab = get_field('lisnten_now_link_open_in_new_tab',  $id ) ? "target = '__blank'" : "target = '__self'" ;

?>



<?php 
if ( is_singular( 'music_album' ) ):
    //your code here...

    $date_it_was_released  = get_field('date_it_was_released',  $id );
    $release_date_formatted = DateTime::createFromFormat('d/m/Y', $date_it_was_released);



 
    // show next msic album on initial load 
    $next_post_id = get_next_music_id($id);

    // die($next_post_id);
?>

   
    <div class="single__music-article">
        <div class="back__to-music wide__container m-b-3">
            <a href="<?php echo site_url('/music'); ?>">	
                <svg xmlns="http://www.w3.org/2000/svg" width="24.411" height="10.381" viewBox="0 0 24.411 10.381">
                    <g id="Group_16" data-name="Group 16" transform="translate(-77.307 -130.154)">
                        <path id="Path_17" data-name="Path 17" d="M2356.976,130l-4.643,4.844,4.643,4.844" transform="translate(-2274.332 0.5)" fill="none" stroke="#919191" stroke-width="1"/>
                        <line id="Line_6" data-name="Line 6" x2="23.617" transform="translate(78.102 135.344)" fill="none" stroke="#919191" stroke-width="1"/>
                    </g>
                </svg>

                <span>Back to Music</span>
            </a>
        </div>
    
    <div class="music__article">
        <div class="music__article-header">

            <div class="music__article-header-left">
                    <?php the_title( '<h1 class="music__article-title has-creatio-cyan-color">', '</h1>' ); ?>
                    <div class="music_release-date">
                    <?php if($date_it_was_released): ?>
                    <time> <?php echo $release_date_formatted->format('l, F d Y'); ?></time>
                    <?php endif; ?>
                    </div>
            </div>
            <div class="music__article-header-right">
                    <div class  = "music_index-title">
                        <h2>MUSIC</h2>
                    </div>
                    <div class="music__nav">
                          <?php 
                            // get prev music album
                            $prev_music_id = get_prev_music_id(get_the_ID());
                            $prev_music_link = get_permalink($prev_music_id);
                         ?>

                            <a class="music__nav-link-prev" href="<?php echo $prev_music_link ; ?>">
                                <span><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" class="svg-inline--fa fa-chevron-left fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg></span>
                                <span class="music__nav-link-prev-text" data-id="<?php echo $next_post_id ;?>">PREV ALBUM</span>
                            </a>

                            <?php 
                            // get next gig - live_archive
                                $next_music_id = get_next_music_id(get_the_ID());
                                $next_music_link = get_permalink($next_music_id);
                            ?>


                            <a class="music__nav-link-next" href="<?php echo  $next_music_link ;?>">
                                <span class="music__nav-link-next-text"  data-id="<?php echo $next_post_id ;?>">NEXT ALBUM</span>
                                <span><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg></span>
                            </a>
                    </div>
            </div>

        </div> <!-- music__article-header -->

        <div class="music__article-content">
                <div class="music__article-content-col-1">
                    <div class="music__article-content-col-1-img flex flex-column flex-align-center flex-justify-center">
                        <img src="<?php echo $music_album_poster['url']; ?>" alt="<?php echo $music_album_poster['alt']; ?>">
                        <a class="music__article-content-col-1-buy-now creatio__btn m-t-3" href="<?php echo $buy_now_link; ?>" <?php echo $buy_now_link_open_in_new_tab; ?>>
                            <span>BUY NOW</span>
                        </a>
                    </div>
                </div>
                <div class="music__article-content-col-2">
                    
                    

                        <?php
                            // tracks
                            // print_r(get_field('tracks',  $id ));
                            // $track_array = [];
                            // $track_array = get_field('tracks',  $id );
                            
                            if( have_rows('tracks') ):
                        ?>
                            <div class="music__article-content-col-2 music__article-content--track">
                                <h3 class="title__line letter-spacing-8">
                                TRACKS
                                </h3>

                                <ol id="music__track-list" class="music__track-list creatio__list creatio__ordered-list">

                            <?php
                                while( have_rows('tracks') ) : the_row();
                                    $title = get_sub_field('title');
                                    $time = get_sub_field('time');
                                    $listen_now_link = get_sub_field('listen_now_link');
                                    $listen_now_link_open_in_new_tab = get_sub_field('listen_now_link_open_in_new_tab') ? "target = '__blank'" : "target = '__self'" ;
                            ?>
                                <li  data-postid = "<?php echo $id; ?>"  data-title="<?php echo $title ;?> "> 
                                    <span class="has-creatio-cyan-color"> <?php echo $title ;?></span>
                                    <time> <?php echo $time ;?></time> 
                                    <?php if($listen_now_link):?>
                                    <a href="<?php echo $listen_now_link ; ?>" class="listen-now-link" <?php echo $listen_now_link_open_in_new_tab ;?>>
                                       LISTEN NOW
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



                        

                        <div class="music__track-detail" id="music__track-detail">
                            
                        </div> <!-- music__track-detail -->


                        <div class="music__album-meta grid grid-50-50">
                                <?php
                                    // video
                                    if( have_rows('videos') ):
                                ?>
                                    <div class="music__article-content-col-2 music__article-content--video">
                                        <h3 class="title__line letter-spacing-8">
                                            VIDEO
                                        </h3>

                                        <ul class="music__video-list creatio__list creatio__list">
                                                <?php
                                                while( have_rows('videos') ) : the_row();
                                                    $title = get_sub_field('title');
                                                    $watch_now_link = get_sub_field('watch_now_link');
                                                    $watch_now_link_open_in_new_tab = get_sub_field('watch_now_link_open_in_new_tab') ? "target = '__blank'" : "target = '__self'" ;
                                                ?>
                                                <li> 
                                                    <span class="has-creatio-cyan-color"> <?php echo $title ;?></span>
                                                    <?php if($watch_now_link):?>
                                                        <a href="<?php echo $watch_now_link ; ?>" class="listen-now-link"  <?php echo $watch_now_link_open_in_new_tab ;?>>
                                                            <span class="listen-now-link-text">WATCH NOW</span>
                                                        </a>
                                                    <?php endif; ?>
                                                </li>
                                                <?php
                                                    endwhile;
                                                ?>
                                    
                                        </ul>
                                    </div>
                                <?php
                                    endif;
                                ?>



                                <?php
                                    // credits
                                    if( get_field('credits') ):
                                ?>
                                    <div class="music__article-content-col-2 music__article-content--credits">
                                        <h3 class="title__line letter-spacing-8">
                                            CREDITS
                                        </h3>

                                        <div class="music__album-credits">
                                            <?php the_field('credits'); ?>
                                        </div>
                                        
                                    </div>
                                <?php
                                    endif;
                                ?>
                


                        </div> <!-- music__album-meta -->

















                </div>
                <div class="music__article-content-col-3">
                       <div id="music__next-prev"> 
                           <?php
                            // show next msic album on initial load 
                            //$next_post_id
                            $poster =  get_field('music_album_poster', $next_post_id);
                            $permalink = get_permalink($next_post_id);

                            ?>
                           <a href="<?php echo $permalink ;?>">
                               <img src="<?php echo $poster['url']; ?>" alt="<?php echo $poster['alt']; ?>">
                            </a>
                        </div>
                </div>
        </div> <!-- music__article-content -->


    </div> <!-- music__article -->

    </div> <!-- single__music-article -->























<?php 
else:
    //your code here...
?>


    <div class="music__album-card">
        <div class="music__album-card-img">
                <img src="<?php echo $music_album_poster['url'] ;?>" alt="">
        </div>
        
        <div class="music__album-overlay">
            <div class="music__album-buttons">
                    <a class="music__album-buttons--listen-now" href="<?php echo $lisnten_now_link ;?>" <?php echo $lisnten_now_link_open_in_new_tab; ?>>Listen Now</a>
                <div class="music__album-buttons-bottom">
                    <a class ="music__album-buttons--album-info" href="<?php the_permalink() ;?>" >Album Info</a>
                    <a class ="music__album-buttons--buy-now" href="<?php echo $buy_now_link ;?>" <?php echo $buy_now_link_open_in_new_tab ;?>>Buy It Now</a>
                </div>      
            </div>
        </div>
    </div>
<?php   
endif;