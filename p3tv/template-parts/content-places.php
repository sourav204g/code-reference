<!--Popular Places Start-->
<section class="popular_places">
    <div class="container">
        <div class="block-title text-center">
            <h4>Around the World</h4>
            <h2><?php echo get_field('traveltographer_popular_places_title'); ?></h2>
            <p><?php echo get_field('traveltographer_popular_places_sub_title'); ?></p>
        </div>
    </div>
    <div class="container-fullwidth">
        
        <div class="row">
            <div class="col-xl-12">
                <div class="popular_places_carousel owl-theme owl-carousel">

                    <?php global $locations;                   


                    foreach ($locations as $key => $location): ?>

                            <div class="popular_places_single">
                                <div class="popular_places_image">


                                    <?php if ( isset(get_field('traveltographer_destination_image', 'locations_' . $location->term_id)['url']) ): ?>

                                        <img class="w100" src="<?php echo get_field('traveltographer_destination_image', 'locations_' . $location->term_id)['url']; ?>" alt="<?php echo get_field('traveltographer_destination_image', 'locations_' . $location->term_id)['alt']; ?>">
                                        
                                    <?php endif; ?>


                                    
                                    
                                    <div class="popular_places_text">
                                        <p>Enjoy in</p>
                                        <h3><?php echo $location->name; ?></h3>
                                    </div>
                                </div>
                                <div class="popular_places_hover">
                                    <div class="popular_places_hover_circle">
                                        <a href="<?php echo get_category_link( $location->term_id ); ?>"><span class="icon-right-arrow"></span></a>
                                    </div>
                                    <p>Enjoy in</p>
                                    <h3><?php echo $location->name; ?></h3>
                                </div>
                            </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <div class="grow_business_btn22">
           <a href="<?php echo home_url( '/destinations/' ); ?>" class="thm-btn">View All Destinations</a>
         </div>
    </div>
</section>