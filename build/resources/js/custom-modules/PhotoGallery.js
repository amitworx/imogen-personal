function PhotoGallery(){
    jQuery(function(){
        jQuery('.live__archive-gallery').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            // other options
            gallery: {
                enabled: true
              },
          });
    });
}

export default PhotoGallery;