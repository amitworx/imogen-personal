function AlbumNav(){

    jQuery(function(){

        jQuery('.music__nav-link-next-text').click(function(){


            let currentPostID = jQuery(this).attr("data-id");

            // console.log(currentPostID);
            jQuery.ajax({
                // action: 'get next album',
                method: "POST",
                url : imogenAjaxData.ajaxurl,
                data : {
                    action: 'get_next_music',
                    id :  currentPostID ,
                   // dataType: "json"
                },
                success : function( response  ) {
                    if ( response ) {
            
                        // console.log(response);

                        let next = JSON.parse(response);
                        // console.log(next);
                        jQuery(".music__nav-link-next-text").attr("data-id", next[2]);
                        jQuery(".music__nav-link-prev-text").attr("data-id", next[2]);
                        // // recreate dom for mg_event list
                        jQuery("#music__next-prev").fadeOut(500, function(){
                            jQuery("#music__next-prev").empty();
                            jQuery("#music__next-prev").append(`
                                <a href="${next[0]}"><img src="${next[1]}" alt =""></a>
                            `);
                            jQuery("#music__next-prev").fadeIn(500);
                           
                        });
                        // // jQuery(".mg__events-grid").empty();
                        // // jQuery("#mg__events-grid").fadeOut(200, function() {
                        // // // empty the event list
                        // // jQuery("#mg__events-grid").empty().show();
            
                        // // repopulate the event list
                        // jQuery(".music__album-meta ").hide();
                        // jQuery("#music__track-detail").html(items).fadeIn("slow");
                    
            
                    }
                }
            });
        });




        jQuery('.music__nav-link-prev-text').click(function(){


            let currentPostID = jQuery(this).attr("data-id");

            console.log(currentPostID);
            jQuery.ajax({
                // action: 'get previous album',
                method: "POST",
                url : imogenAjaxData.ajaxurl,
                data : {
                    action: 'get_previous_music',
                    id :  currentPostID ,
                   // dataType: "json"
                },
                success : function( response  ) {
                    if ( response ) {
            
                        console.log(response);

                        let prev = JSON.parse(response);
                        // console.log(prev);
                        jQuery(".music__nav-link-next-text").attr("data-id", prev[2]);
                        jQuery(".music__nav-link-prev-text").attr("data-id", prev[2]);
                        // // recreate dom for mg_event list
                        jQuery("#music__next-prev").fadeOut(500, function(){
                            jQuery("#music__next-prev").empty();
                            jQuery("#music__next-prev").append(`
                                <a href="${prev[0]}"><img src="${prev[1]}" alt =""></a>
                            `);
                            jQuery("#music__next-prev").fadeIn(500);
                           
                        });
                        // // jQuery(".mg__events-grid").empty();
                        // // jQuery("#mg__events-grid").fadeOut(200, function() {
                        // // // empty the event list
                        // // jQuery("#mg__events-grid").empty().show();
            
                        // // repopulate the event list
                        // jQuery(".music__album-meta ").hide();
                        // jQuery("#music__track-detail").html(items).fadeIn("slow");
                    
            
                    }
                }
            });
        });

    });

}

export default AlbumNav;