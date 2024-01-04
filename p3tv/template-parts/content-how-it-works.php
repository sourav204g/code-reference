	<!--How It Works-->
	<section class="four_boxes">
	    <div class="container">
	        <div class="block-title text-center">
	            <h4>LET’S FIND OUT</h4>
	            <h2><?php echo get_field('traveltographer_how_it_works_title'); ?></h2>
	            <p><?php echo get_field('traveltographer_how_it_works_sub_title'); ?></p>
	        </div>
	        <div class="row">

            	<?php if( have_rows('traveltographer_how_it_works_columns') ):

            		$icons = array(
            			'<span class="icon-selection"></span>',
            			'<span class="icon-focus"></span>',
            			'<span class="icon-delete"></span>',
            			'<span class="icon-exploration"></span>',
            		);

            		$i = 0;

				    // Loop through rows.
				    while( have_rows('traveltographer_how_it_works_columns') ) : the_row();

				        // Load sub field value.
				        $icon_title = get_sub_field('traveltographer_how_it_works_icon_title'); 
				        $icon_sub_title = get_sub_field('traveltographer_how_it_works_icon_sub_title'); ?>

				        <div class="col-xl-3 col-lg-6 col-md-6">
        	                <!--Four Boxes Single-->
        	                <div class="four_boxes_single">
        	                    <div class="four_boxes_icon">
        	                        <?php echo $icons[$i]; ?>
        	                    </div>
        	                    <h3><?php echo $icon_title; ?></h3>
        	                    <p><?php echo $icon_sub_title; ?></p>
        	                    <div class="four_boxes_shape"></div>
        	                </div>
        	            </div>


					<?php $i++; endwhile; endif; ?>


	        </div>
	        <div class="four_boxes_bottom">
	            <p>Don’t hesitate, contact us for better business. <a href="<?php echo home_url( '/photographers/' ); ?>">Book A Photoshoot</a></p>
	        </div>
	    </div>
	</section>