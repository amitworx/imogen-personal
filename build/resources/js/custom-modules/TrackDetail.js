function TrackDetail(){

    jQuery(function(){

        
            // get track detailed info 

            jQuery( "#music__track-list li span" ).click (function() {

                jQuery( "#music__track-list li").removeClass('selected');
                jQuery(this).closest("li").addClass("selected");
            
                let postID = jQuery(this).closest("li").data("postid");
                let trackTitle = jQuery(this).closest("li").data("title");
              
                // console.log(postID, tractTitle);
            
                jQuery.ajax({
                    // action: 'filter_art_deco_event',
                    method: "POST",
                    url : imogenAjaxData.ajaxurl,
                    data : {
                        action: 'get_track_details',
                        id :  postID ,
                        tracktitle : trackTitle
                    },
                    success : function( response  ) {
                        if ( response ) {
                
                            console.log(response);

                        
                            let $data = jQuery(response);
                            let items = jQuery($data);
                
                            // recreate dom for mg_event list
                            
                            // jQuery(".mg__events-grid").empty();
                            // jQuery("#mg__events-grid").fadeOut(200, function() {
                            // // empty the event list
                            // jQuery("#mg__events-grid").empty().show();
                
                            // repopulate the event list
                            jQuery(".music__album-meta ").hide();
                            jQuery("#music__track-detail").html(items).fadeIn("slow");
                        
                
                        }
                    }
                });
            });

            


         
        
            jQuery(document).on("click", "a#close__music-track-detail-btn" , function(e) {
                e.preventDefault();
                jQuery("#music__track-detail").empty();
                jQuery(".music__album-meta ").show();
            });
            jQuery(document).on("click", "a.close__music-track-detail-icon" , function(e) {
                e.preventDefault();
                jQuery("#music__track-detail").empty();
                jQuery(".music__album-meta ").show();
            });


    });
}

export default TrackDetail;