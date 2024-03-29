jQuery(document).ready(function(){
    jQuery(document).foundation();

    var images_loaded = 0;
    var total_images = jQuery(".gallery img").length;
    var percent_slice = 100 / total_images;
    var current_percent = 0;

    jQuery(".gallery img").one("load", function() {
        images_loaded++;
        current_percent += percent_slice;
        if(images_loaded == total_images){
            jQuery(".gallery").pycsLayout({
	        gutter: 4,
	        idealHeight: 200,
            });
            jQuery(".loader-wrapper").hide();
        }
    }).each(function() {
        if(this.complete){
            jQuery(this).load();
        }
    });
});
