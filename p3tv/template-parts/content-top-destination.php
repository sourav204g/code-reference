	<!--Latest Listings Start-->
	<section class="latest_listings">
	    <div class="container">
	        <div class="block-title text-center">
	            <h4>Handpicked places</h4>
	            <h2><?php echo get_field('traveltographer_our_top_destinations_title'); ?></h2>
	            <p><?php echo get_field('traveltographer_our_top_destinations_sub_title'); ?></p>
	        </div>
	        <div class="row">
	            <div class="col-xl-12">
	                <div class="latest_listings_carousel owl-theme owl-carousel">


	                	<?php if( have_rows('traveltographer_our_top_destinations_list') ):

        					    // Loop through rows.
        					    while( have_rows('traveltographer_our_top_destinations_list') ) : the_row();  ?>

        					        <div class="latest_listings_single">
        					            <div class="latest_listings_image">
        					                <img src="<?php echo get_sub_field('travelt_top_destination_image')['url']; ?>" alt="<?php echo get_sub_field('travelt_top_destination_image')['alt']; ?>">
        					            </div>
        					            <div class="latest_listings_content">
        					                <div class="title">
        					                    <h3><a href="<?php echo get_sub_field('traveltographer_our_top_destination_url'); ?>"><?php echo get_sub_field('traveltographer_our_top_destination_name'); ?></a></h3>
        					                    <p><?php echo get_sub_field('traveltographer_our_top_destination_content'); ?></p>
        					                </div>
        					                 <!-- <ul class="list-unstyled latest_listings_contact_info">
        					                    <li><i class="fas fa-map-marker-alt"></i>80 Broklyn Street USA</li>
        					                    <li><a href="tel:+13456789"><i class="fa fa-phone"></i>92 666 888 0000</a></li>
        					                </ul> -->
        					              
        					                <div class="latest_listings_content_bottom">
        					                    <div class="left">
        					                        <h6>Explore Photographers</h6>
        					                    </div>
        					                </div>
        					            </div>
        					        </div>

        				<?php  endwhile; endif; ?>


	      
	                    

	                   
	                    
	                   
	                </div>
	            </div>
	        </div>
	    </div>
	</section>