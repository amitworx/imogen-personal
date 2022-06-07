<?php

    $id = get_the_ID();
    $event_description = get_field('event_description',  $id );
    $event_date = get_field('event_date',  $id );
    $location = get_field('location',  $id );
    $tickets_url = get_field('tickets_url',  $id );
    $text_on_tickets_button = get_field('text_on_tickets_button',  $id );
    $open_tickets_link_in_new_tab = get_field('open_tickets_link_in_new_tab',  $id ) ? "target = '__blank'" : "target = '__self'" ;
    $rsvp_url = get_field('rsvp_url',  $id );
    $text_on_rsvp_button = get_field('text_on_rsvp_button',  $id );
    $open_rsvp_link_in_new_tab = get_field('open_rsvp_link_in_new_tab',  $id ) ? "target = '__blank'" : "target = '__self'" ;
    $tour_link = get_field('tour_link',  $id ) ? get_field('tour_link',  $id ) : "#" ;
?>

<div class="tours__row">
    <div class="tours__tour-info">
        <div class="tours__tour-date">
            <?php
                $newDateTime = DateTime::createFromFormat('d/m/Y g:i a', $event_date);
                echo $newDateTime->format('M d D');
            ?>
        </div>
        <a href="<?php echo $tour_link ;?>" rel="noopener" target="_blank">
            <div class="tours__tour-title">
                <?php the_title() ; ?>
            </div>
            <?php if( $event_description) :?>
                <div class="tours__tour-desc">
                    <?php echo  $event_description ;?>
                </div>
            <?php endif ;?>
        </a>
    </div>
    <div class="tours__location">
        <a href="<?php echo $tour_link ;?>" rel="noopener" target="_blank">
            <?php echo $location  ;?>
        </a>
    </div>
    <div class="tours__buttons">
        <div class="tours__buttons-ticket">
            <a href="<?php echo $tickets_url ;?>"  <?php echo $open_tickets_link_in_new_tab ;?>> 
                <?php echo $text_on_tickets_button ;?> 
            </a>
        </div>
        <div class="tours__buttons-rsvp">
            <a href="<?php echo $rsvp_url ;?>"  <?php echo $open_rsvp_link_in_new_tab ;?>> 
                <?php echo $text_on_rsvp_button ;?> 
            </a>
        </div>
    </div>
</div>