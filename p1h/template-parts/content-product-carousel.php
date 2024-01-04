<?php 
$service_category_object = get_queried_object();

$current_service_categories = get_terms( array( 
	'taxonomy' => 'product_categories',
	// 'hide_empty' => false, // Remove Comment to Display all categories
	'parent' => $service_category_object->term_id
) );
?><?php
					$args_group = array(
								        'posts_per_page' => -1,
								        'post_type' => 'products',
								        'tax_query' => array(
								            array (
								                'taxonomy' => 'product_categories',
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
					

					<?php 

                        	// check if the repeater field has rows of data
                        	if( have_rows('hnd_carousel_services', 'product_categories_' . $service_category_object->term_id) ): ?>

                        	<div class="center slider bbb-hidde">

                        	<?php 	

                        		// loop through the rows of data
                        	    while ( have_rows('hnd_carousel_services', 'product_categories_' . $service_category_object->term_id) ) : the_row(); 

                        	    $group_id = (int) get_sub_field('hnd_carousel_service');

                        	    $args_group = array(
											        'posts_per_page' => -1,
											        'post_type' => 'products',
											        'tax_query' => array(
											            array (
											                'taxonomy' => 'product_group',
											                'field' => 'term_id',
											                'terms' => $group_id,
											            ),
											        ),
											        'orderby' => 'meta_value',
											        'meta_key' => 'handyman_prod_price',
											        'order' => 'DESC'
								);
						
								$the_query_group = new WP_Query( $args_group );

								// echo '<pre>';
								// var_dump($the_query_group->get_posts());
								// exit();



								$services_type = array();
								$servicePricePremium = array();
								$afterDiscountPrice = array();

								foreach ( $the_query_group->get_posts() as $key => $post ) {	

									$handyman_product_link_to_services = get_field('handyman_product_link_to_services', $post->ID);	

									$hndlinkedservCount = count(get_field('handyman_product_link_to_services', $post->ID));

									foreach ($handyman_product_link_to_services as $keyi => $hnd_product_link_to_service ) {

											$linkedServiceID = (int) $hnd_product_link_to_service['handyman_product_link_to_service'];	

											// var_dump('$service_name ');
											// exit;

											$service_name = $post->post_title;
											$service_permalink = get_permalink($post->ID) . '?service-id=' . $linkedServiceID;



											// echo '<pre>';
											// var_dump(get_field('handyman_product_images', $post->ID)[0]['handyman_product_image']['url']);
											// exit;

											if (get_field('handyman_product_images', $post->ID)[0]['handyman_product_image']['url']) {
												$service_image = get_field('handyman_product_images', $post->ID)[0]['handyman_product_image']['url'];
											} else {
												$service_image = get_template_directory_uri() . '/assets/images/default-png02.png';
											}		

											// echo '<pre>';
											// var_dump(get_field('handyman_product_link_to_services', $post->ID)[0]['handyman_product_link_to_service']);
											// exit;		

											// var_dump(get_template_directory_uri() . '/assets/images/default-png02.png');
											// exit;

											// echo '<pre>';
											// var_dump('expression');
											// var_dump(get_filed('handyman_product_link_to_services',  $post->ID));
											// exit;

											$service_discount = get_field('handyman_product_discount', $linkedServiceID);

											$services_type[] 		= get_field('handyman_type_of_service', $linkedServiceID);

											$productPrice = get_field('handyman_prod_price', $post->ID);

											$servicePrice = $per_min_cost * get_field('handyman_est_time', $linkedServiceID);

											
											
											// Premium
											if (get_field('handyman_product_premium', $linkedServiceID)) {
												$preimum = ( $servicePrice * get_field('handyman_product_premium', $linkedServiceID) ) / 100;
											} else {
												$preimum = 0;
											}
											
											$servicePrice = $servicePrice + $preimum;

											$servicePricePremium[] = $servicePrice + $productPrice;

											// var_dump($preimum);
											// exit;

											// Discount		
											if (get_field('handyman_product_discount', $linkedServiceID)) {				
												$discount = ( ( $servicePrice * get_field('handyman_product_discount', $linkedServiceID) ) / 100 );
											} else {
												$discount = 0;
											}
											
											$servicePrice = round(($servicePrice - $discount), 2);

											$afterDiscountPrice[] = $servicePrice + $productPrice;

									}

								}



								if ($the_query_group->found_posts > 1 || $hndlinkedservCount > 1) {
									$service_permalink = get_term_link($group_id, 'product_group');

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
																<del>$<?php echo $servicePricePremium[$key3]; ?></del><span>$<?php echo $afterDiscountPrice[$key3]; ?></span></a></h4>
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