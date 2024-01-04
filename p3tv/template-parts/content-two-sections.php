	 <!--Two Section Start-->
	<section class="two_section">
	    <div class="container-full-width">
	        <div class="row">
	            

	            <?php if( have_rows('traveltographer_banners') ):

        					    // Loop through rows.
        					    while( have_rows('traveltographer_banners') ) : the_row();  ?>

        					        <div class="col-xl-6">
        					            <div class="section_one">
        					                <div class="section_one_bg"
        					                    style="background-image: url(<?php echo get_sub_field('traveltographer_banner_image')['url']; ?>)"></div>
        					                <div class="section_one_content">
        					                    <h2><?php echo get_sub_field('traveltographer_banner_title'); ?></h2>
        					                    <p><?php echo get_sub_field('traveltographer_banner_sub_title'); ?></p>
        					                    <div class="section_one_btn">
        					                        <a href="<?php echo get_sub_field('traveltographer_banner_url'); ?>" class="thm-btn">Book Your Traveltographer</a>
        					                    </div>
        					                </div>
        					            </div>
        					        </div>

        		<?php  endwhile; endif; ?>

	        </div>
	    </div>
	</section>