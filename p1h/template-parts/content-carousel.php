<?php 
$service_category_object = get_queried_object();

$current_service_categories = get_terms( array( 
	'taxonomy' => 'service_categories',
	// 'hide_empty' => false, // Remove Comment to Display all categories
	'parent' => $service_category_object->term_id
) );
?><?php
					$args_group = array(
								        'posts_per_page' => -1,
								        'post_type' => 'services',
								        'tax_query' => array(
								            array (
								                'taxonomy' => 'service_categories',
								                'field' => 'term_id',
								                'terms' => $service_category_object->term_id,
								            ),
								        )
					);
			
					$the_query_group = new WP_Query( $args_group );
				
$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;

// var_dump($service_category_object->name);
?>
<!-- Carousel  -->
<section class="hnd-top0ca mob-service-carousel">
		<div class="block less-top">
			<div class="container">
				<div class="row">
					

					<!-- <div class="col-md-12 bbb-hidde">
						<p><a href="#">Home</a> / <?php // echo $service_category_object->name; ?></p>
					</div> -->

					<?php 

					/* $explode  = explode('/', get_term_link($service_category_object->term_id, 'service_categories'));
					$explode  = array_splice($explode,4);
					$indxpl = count($explode) - 1;
					unset($explode[$indxpl]);

					$last = end(array_keys($explode));

					// echo '<pre>'; var_dump($last);

					?>

					<div class="col-md-12 breadcrumb-new bbb-hidde mob-service-brdcrumb">
						<span><a href="<?php echo home_url( '/' ); ?>"><i class="fa fa-home" aria-hidden="true"></i></a></span>
						<i class="fa fa-angle-right" aria-hidden="true"></i>

						<?php if ($explode > 1): ?>

							<?php foreach ($explode as $key => $expl):

								$explID = get_term_by('slug', $expl, 'service_categories')->term_id;

								$explLink = get_term_link($explID, 'service_categories');

								$iteml = str_replace('-', ' ', $expl);

								if ($key !== $last): ?>

									<span><a href="<?php echo $explLink; ?>"><?php echo $iteml; ?></a></span>
									<i class="fa fa-angle-right" aria-hidden="true"></i>

								<?php else: ?>

									<span><?php echo $iteml; ?></span>
									
								<?php endif; ?>
								
							<?php endforeach; ?>
							
						<?php endif; ?>
					</div>
					<div class="col-md-12">
					    <h4 style="margin-top: 10px;font-weight: bold;letter-spacing: 1px;text-transform: uppercase;"><?php echo $service_category_object->name; ?></h4>
					</div>


                        	<?php */

							// echo '<pre>';

                        	// var_dump(get_field('hnd_carousel_services', 'service_categories_' . $service_category_object->term_id));

                        	// check if the repeater field has rows of data
                        	if( have_rows('hnd_carousel_services', 'service_categories_' . $service_category_object->term_id) ): ?>

                        	<div class="center slider bbb-hidde">

                        	<?php 	

                        		// loop through the rows of data
                        	    while ( have_rows('hnd_carousel_services', 'service_categories_' . $service_category_object->term_id) ) : the_row(); 

                        	    $group_id = (int) get_sub_field('hnd_carousel_service');

                        	    $args_group = array(
											        'posts_per_page' => -1,
											        'post_type' => 'services',
											        'tax_query' => array(
											            array (
											                'taxonomy' => 'service_group',
											                'field' => 'term_id',
											                'terms' => $group_id,
											            ),
											        ),
											        'orderby' => 'meta_value',
											        'meta_key' => 'handyman_type_of_service',
											        'order' => 'DESC'
								);
						
								$the_query_group = new WP_Query( $args_group );

								$services_type = array();
								$servicePricePremium = array();
								$afterDiscountPrice = array();
								$services_ID = array();

								foreach ( $the_query_group->get_posts() as $key => $post ) {									

									$service_name = $post->post_title;
									$service_permalink = get_permalink($post->ID);

									if (get_the_post_thumbnail_url($post->ID)) {
										$service_image = get_the_post_thumbnail_url($post->ID);
									} else {
										$service_image = get_template_directory_uri() . '/assets/images/default-png02.png';
									}								

									// var_dump(get_template_directory_uri() . '/assets/images/default-png02.png');
									// exit;

									$service_discount = get_field('handyman_product_discount', $post->ID);

									$services_type[] 		= get_field('handyman_type_of_service', $post->ID);

									$services_ID = $post->ID;

									$servicePrice = $per_min_cost * get_field('handyman_est_time', $post->ID);
									
									// Premium
									if (get_field('handyman_product_premium', $post->ID)) {
										$preimum = ( $servicePrice * get_field('handyman_product_premium', $post->ID) ) / 100;
									} else {
										$preimum = 0;
									}
									
									$servicePricePremium[] = $servicePrice = $servicePrice + $preimum;

									// Discount		
									if (get_field('handyman_product_discount', $post->ID)) {				
										$discount = ( $servicePrice * get_field('handyman_product_discount', $post->ID) ) / 100;
									} else {
										$discount = 0;
									}
									
									$afterDiscountPrice[] = $servicePrice = round($servicePrice - $discount, 2);

								}

								if ($the_query_group->found_posts > 1 ) {
									$service_permalink = get_term_link($group_id, 'service_group');

									// var_dump($group_id);
									// var_dump(get_term_link($group_id, 'service_group'));
								}

								// var_dump($service_name);
								// var_dump($service_permalink);
								// var_dump($service_discount);


                        	    ?>

    							    <div class="shabg">
    							      <div class="emply-list" style="margin-bottom: 5px;">
    									    <div class="row">
    									        <div class="col-xs-6 col-sm-6 col-md-6">
    									            <div class="dvimag">
    									                <a href="<?php echo $service_permalink; ?>"><img alt="" src="<?php echo $service_image; ?>" style=" width: 100%; height: 120px;">

    									                <?php if ($service_discount > 0): ?>
    									                	 <span class="off50">
	    									                    <?php echo $service_discount; ?>% off
	    									                 </span>
    									                <?php endif ?>
    									                </a>
    									               

    									            </div>
    									        </div>
    									        <div class="col-xs-6 col-sm-6 col-md-6 pdl0">
    									            <div class="tleft carousel-text">

    									                <h4 class="h4"><?php echo $service_name; ?></h4>

    									                <?php

    									                // var_dump($services_type);

    									                foreach ( $services_type as $key3 => $serv_type ): ?>

    									                	<h4><a href="<?php echo $service_permalink; ?>" title=""><?php echo ucfirst($serv_type); ?> - 
    														
    														<?php if ($afterDiscountPrice[$key3] > 0): ?>
																
    															<?php if ($service_discount > 0): ?>

    																<del>$<?php echo round($servicePricePremium[$key3], 2); ?></del><span>$<?php echo round($afterDiscountPrice[$key3], 2); ?></span></a></h4>

    															<?php else: ?>

    																<span>$<?php echo round($servicePricePremium[$key3], 2); ?></span></a></h4>

    															<?php endif; ?>

																
															

															<?php else: ?>
																<?php include(get_template_directory() . '/inc/has-nobase-has-options-carousel.php'); ?>
															<?php endif; ?>
    														
    									                	
    									                <?php endforeach; ?>

    									            </div>
    									        </div> 
    									    </div>
    								    </div>
    							    </div>


                        	<?php       
                        	    endwhile; ?>

                        	</div>
							<!-- End Carousel -->

                        	<?php endif; wp_reset_postdata(); ?>




				</div>
			</div>
		</div>
	</section>
<!-- / Carousel -->