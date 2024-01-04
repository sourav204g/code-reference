<!-- Categories One Start -->
<section class="categories_one">
    <div class="categories_one_shape wow slideInLeft animated" data-wow-delay="600ms"
        style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/shapes/map-1.png)"></div>
    
    <div class="container">
        <div class="bgbg888">
         <div class="block-title text-center" style="margin-bottom: 10px;">
            <h4>As Featured In:</h4>
          </div>
        <div class="row">
            
               <div class="col-xl-12">
                 

                <div class="categories_one_carousel owl-theme owl-carousel">

                	<?php if( have_rows('traveltographer_featured_in') ):

					    // Loop through rows.
					    while( have_rows('traveltographer_featured_in') ) : the_row();

					        // Load sub field value.
					        $image = get_sub_field('traveltographer_featured_in_logo'); ?>

					        <div class="categories_one_single">
					            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
					        </div>


					<?php  endwhile; endif; ?>
                   
                </div>
            </div>
        </div>
    </div></div>
</section>