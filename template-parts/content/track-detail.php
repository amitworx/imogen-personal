<?php
                            
                            // print_r($args['data']);

                            $id = $args['data']['post_id'];
                            $title = $args['data']['track_title'];
                            // die();
                            // tracks
                            $track_array = array();
                            // print_r(get_field('tracks',  $id ));
                            // $track_array = [];
                            $track_array = get_field('tracks',  $id );
                            // echo '<pre>';
                            // print_r($track_array);
                            // echo '</pre>';
                            
                            for($i=0; $i<count($track_array); $i++){
                                $track_title = $track_array[$i]['title'];
                                if($track_title === $title){ // trim text
                                    $listen_now_link = $track_array[$i]['listen_now_link'];
                                    $listen_now_link_open_in_new_tab = $track_array[$i]['listen_now_link_open_in_new_tab'] ? "target = '__blank'" : "target = '__self'" ;
                                    $production = $track_array[$i]['production'];
                                    $credits = $track_array[$i]['credits'];
                                    $lyrics = $track_array[$i]['lyrics'];
                                    $chords = $track_array[$i]['chords'];
                                    $chordify_link = $track_array[$i]['chordify_link'];
                                    $known_performances = $track_array[$i]['known_performances'];
                                    break;
                                }
                            }
?>
                       

                                  
<div class="music__track-detail-content">
    <div class="music__track-detail-header grid grid-50-50">
        <div class="music__track-detail-header-left">
            <?php if($track_title):?>
                <h3 class="music__track-detail-title has-creatio-cyan-color">
                    <?php echo  $track_title ;?>
                </h3>
            <?php endif; ?>
        </div><!-- music__track-detail-header-left -->
        <div class="music__track-detail-header-right">
            <?php if($listen_now_link):?>
                <a href="<?php echo $listen_now_link ; ?>" class="listen-now-link creatio__btn" <?php echo $listen_now_link_open_in_new_tab ;?>>
                    <span class="listen-now-link-text">LISTEN NOW</span>
                </a>
            <?php endif; ?>
            <a class="close__music-track-detail-icon" href="#">&times;</a>   
        </div><!-- music__track-detail-header-right -->

    </div> <!-- music__track-detail-header -->


    <div class = "grid grid-50-50">
        <div class="music__track-detail-content-left">

            <?php if($production):?>
            <div class="music__track-detail-content-left-production  music__track-meta">
                <h4 class="title__line">
                    PRODUCTION
                </h4>
                <p class="music__track-detail-content-left-production-text">
                    <?php echo $production ;?>
                </p>
            </div>
            <?php endif; ?>

            <?php if($lyrics):?>
            <div class="music__track-detail-content-left-lyrics music__track-meta">
                <h4 class="title__line">
                    LYRICS
                </h4>
                <p class="music__track-detail-content-left-lyrics-text">
                    <?php echo $lyrics ;?>
                </p>
            </div>
            <?php endif; ?>


            
        </div> <!-- music__track-detail-content-left -->
        <div class="music__track-detail-content-right">
            <?php if($credits):?>
                <div class="music__track-detail-content-left-credits music__track-meta">
                    <h4 class="title__line">
                        CREDITS
                    </h4>
                    <p class="music__track-detail-content-left-credits-text">
                        <?php echo $credits ;?>
                    </p>
                </div>
            <?php endif; ?>


            <?php if($chords):?>
                <div class="music__track-detail-content-left-chords music__track-meta">
                    <h4 class="title__line">
                        CHORDS
                    </h4>
                    <p class="music__track-detail-content-left-chords-text">
                        <img src="<?php echo $chords['url'] ;?>" alt="<?php echo $chords['alt'] ;?>">
                    </p>
                    <?php if($chordify_link):?>
                        <a class='creatio__btn m-t-2' href="<?php echo $chordify_link ;?>" target ="_blank">VIEW ON CHORDIFY</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        </div> <!-- music__track-detail-content-right -->
    </div> <!-- grid -->

    <?php if($known_performances):?>
            <div class="related__performances">
                        <h4 class="title__line">
                            KNOWN PERFORMANCES
                        <h4>   


                    <?php for($i=0; $i<count( $known_performances); $i++): 
                            $gig_id =  $known_performances[$i] ; 
                            $event_date = get_field('event_date',  $gig_id );
                            $location = get_field('location',  $gig_id );
                            $event_date_formatted = DateTime::createFromFormat('d/m/Y', $event_date);
                            ?>

                        
                                <div class="la__row">
                                        <div class="la__info">
                                            <div class="la__date">
                                                <time><?php  echo $event_date_formatted->format('M d Y');  ; ?></time>
                                            </div>
                                            <div class="la__title">
                                                <h4><?php echo get_the_title($gig_id) ; ?></h4>
                                            </div>
                                        
                                        </div>
                                        <div class="la__location">
                                                <?php echo $location  ;?>
                                        </div>
                                        <div class="la__button">
                                                <a href="<?php echo get_the_permalink($gig_id);?>"  <?php echo $open_tickets_link_in_new_tab ;?>> 
                                                VIEW GIG
                                                </a>
                                        </div>
                                </div>
                                                
                        


                    <?php endfor; ?>

                    <a class="creatio__btn m-t-3" href="#">VIEW ALL</a>

            </div>    <!-- related__performances -->   
    <?php endif; ?> 
</div> <!-- music__track-detail-content -->
<div class="close__music-track-detail m-t-3 m-b-4">                         
    <a class="close__music-track-detail-btn" href="#" id="close__music-track-detail-btn" >CLOSE</a>      
</div>                       
