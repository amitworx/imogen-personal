function LiveArchiveSearch(){
    jQuery(function(){

        let maxPage = imogenAjaxData.maxlivearchivepages ;
        let postPerPage = imogenAjaxData.livearchiveppp;
        let currentPageNumber  = jQuery("#la__block").data("page");
        let flag = true;
     
        function laBlockReset(response){
            let items = jQuery(response);
            jQuery(".la__row").fadeOut(300, function(){
                jQuery("#la__block").empty();
                jQuery("#la__block").append(items).fadeIn("slow");
            });
         
            // jQuery("#va__block-sort").val("avail");
        }
    
    
        // // slide toggle va__card body
    
        // jQuery("#va__grid").on("click", ".va__card-header", function(){
        //     jQuery(this).parent().find(".va__card-body").slideToggle("slow");
        // });
       
    
        // live_archive search on pressing enter key
        jQuery('.la__block-header--right .search__wrapper input').on('keypress', function (e) {
            
            if(e.which === 13){
    
            //Disable textbox to prevent multiple submit
            jQuery(this).attr("disabled", "disabled");
    
            //Do Stuff, submit, etc..
            let keyword = jQuery(this).val();
            // console.log(keyword);
            jQuery.ajax({
                    // action: 'filter_art_deco_event',
                    method: "POST",
                    url : imogenAjaxData.ajaxurl,
                    data : {
                        action: 'live_archive_search',
                        keyword :  keyword 
                    },
                    success : function( response  ) {
                    console.log(response);
                    if ( response ) {
                       // grid markup
                       laBlockReset(response);
                     
                    }else{
                        jQuery("#la__block").html("<div class='la__row'><p>No Item Found</p></div>");
                    }
                    }
                });
    
            //Enable the textbox again if needed.
            jQuery(this).removeAttr("disabled");
            }
        });
    
        // live_archive search icon click
        jQuery(".la__block-header--right .search__wrapper svg").click(function(){
            let keyword = jQuery(".la__block-header--right .search__wrapper input").val();
            console.log(keyword);
            jQuery.ajax({
                // action: 'filter_art_deco_event',
                method: "POST",
                url : imogenAjaxData.ajaxurl,
                data : {
                    action: 'live_archive_search',
                    keyword :  keyword 
                },
                success : function( response  ) {
                    // console.log(response);
                if ( response ) {
        
                    laBlockReset(response);
                    
                }else{
                    jQuery("#la__block").html("<p>No Item Found</p>");
                }
                }
            });
        });
    
    
        // live_archive filter on deleting the input value - reset the grid
        jQuery('.la__block-header--right .search__wrapper input').on('change', function (e) {
    
            //Do Stuff, submit, etc..
            let keyword = jQuery(this).val();
            keyword = keyword ? keyword : "";
            if (!keyword.trim()) {
                // is empty or whitespace
                console.log("reset");
                jQuery.ajax({
                    // action: 'filter_art_deco_event',
                    method: "POST",
                    url : imogenAjaxData.ajaxurl,
                    data : {
                        action: 'live_archive_search_reset'
                    },
                    success : function( response  ) {
                        if ( response ) {
                
                            laBlockReset(response);
    
                            
                        }
                    }
                });
            }
        });
    
    
    
        // sorting 
        jQuery('.la__block-header--right select').change(function() {
            let sortKey = jQuery(this).val();
            let keyword = jQuery(".la__block-header--right .search__wrapper input").val();
            console.log(sortKey);
            console.log(keyword);
    
            jQuery.ajax({
                // action: 'filter_art_deco_event',
                method: "POST",
                url : imogenAjaxData.ajaxurl,
                data : {
                    action: 'live_archive_sort',
                    keyword :  keyword ,
                    sortKey : sortKey,
                    postPerPage : postPerPage
                },
                success : function( response  ) {
                    if ( response ) {
            
                        console.log(response);
                        let items = jQuery(response);
                        laBlockReset(response);
                        currentPageNumber = 1;
                        // jQuery(".va__grid__item").fadeOut(300, function(){
                        //     jQuery("#va__grid").empty();
                        //     jQuery("#va__grid").append(items).fadeIn("slow");
                        // });
    
                        // jQuery("#va__grid").empty();
                        // jQuery("#va__grid").append(items).fadeIn();
    
                    
                    }
                }
            });
            
        });
        

       
        jQuery(window).scroll(function(e){
            console.log(`currentPageNumber: ${currentPageNumber} : maxPage: ${maxPage}`);
            let scrollThreshold = jQuery(document).height() - jQuery(window).height() - jQuery(this).scrollTop() ; 
            if(flag && currentPageNumber < maxPage && scrollThreshold < 150){
                flag = false;
                let sortKey = jQuery(".la__block-header--right .select__wrapper select").val()
                // e.preventDefault();
               // do ajax call
                    console.log("loading");
                    jQuery.ajax({
                       // action: 'filter_art_deco_event',
                       method: "POST",
                       url : imogenAjaxData.ajaxurl,
                       data : {
                           action: 'live_archive_load_more',
                           pagenumber : currentPageNumber + 1,
                           sortkey : sortKey,
                           postPerPage : postPerPage
                       },
                       success : function( response  ) {
                           console.log(response);
                           if ( response ) {
                               let items = jQuery(response);
                               jQuery("#la__block").append(items);
                               currentPageNumber++;
                               flag = true;
                           }
                       }
                   });
                    
                    // console.log(`after load more ${count}`);
            }else{
                // do nothing
                return;
            }
        });
    
    });
    
    
    
    
    
    
    
    
    
}

export default LiveArchiveSearch;