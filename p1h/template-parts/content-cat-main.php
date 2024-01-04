<?php 

$service_category_object = get_queried_object();
$current_service_categories = get_terms( array( 
	'taxonomy' => 'service_categories',
	// 'hide_empty' => false, // Remove Comment to Display all categories
	'parent' => $service_category_object->term_id
) );

if (empty($current_service_categories)) {
	$current_service_categories[] = $service_category_object;
	// echo 'hello';
} else {

	$child_service_categories = array();

	foreach ( $current_service_categories as $key => $if_child_category ) {

			$child_service_categories_temp = get_terms( array( 
					'taxonomy' => 'service_categories',
					// 'hide_empty' => false, // Remove Comment to Display all categories
					'parent' => $if_child_category->term_id
				) );

			if (!empty($child_service_categories_temp)) {
			
				$child_service_categories[$key]['parent'] = $if_child_category->name;
				$child_service_categories[$key]['list'] = $child_service_categories_temp;
				
			}

	}


}


$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;

?><div class="col-lg-9 column">
    <?php 
        $term           =  get_queried_object();
        $service_image  =  get_field('service_banner_image', $term);
        $service_mob_image  =  get_field('service_mobile_image', $term);
        $service_text   =  get_field('services_banner_text', $term);
        $service_link   =  get_field('services_banner_link', $term);

        // var_dump($service_image);
       
    if($service_image) { ?>
        <div class="service-cat-banner-sec" style="margin-bottom: 1.5rem;">
            <img class="img-fluid desktop-cat-img" src="<?php echo $service_image['url']; ?>">
            <img class="img-fluid mobile-cat-img" src="<?php echo $service_mob_image['url']; ?>" style="display:none;">
            <div class="handyman-price-btn-wrapper">
                <a href="<?= $service_link?>"><?= $service_text ?></a>
                <small class="hnd-note-general">Note: Available only through online scheduling.</small>
            </div>
        </div>
    <?php } else { ?>

    	<?php if ($service_text): ?>

    		<div class="service-cat-banner-sec" style="margin-bottom: 1.5rem;">
    		    <div class="handyman-price-btn-wrapper">
    		        <a href="<?= $service_link?>"><?= $service_text ?></a>
    		        <small class="hnd-note-general">Note: Available only through online scheduling.</small>
    		    </div>
    		</div>
    		
    	<?php endif; ?>

    	

    <?php } ?>
	
	<div class="emply-list-sec style2">
		<div class="row">
			
			<?php
					$args_group = array(
								        'posts_per_page' => -1,
								        'post_type' => 'services',
								        'tax_query' => array(
								            array (

								                'taxonomy' => 'service_categories',
								                'field' => 'term_id',
								                'terms' => $service_category_object->term_id,
								            ),
								        ),
								        'orderby' => 'title',
								        'order' => 'ASC'
					);
			
					$the_query_group = new WP_Query( $args_group );
				
			?>

			<?php if ( $the_query_group->have_posts() ) : while ( $the_query_group->have_posts() ) : $the_query_group->the_post(); ?>
					<?php // var_dump($post);
					if(get_the_terms( $post->ID, 'service_group' )) { // IN NOT NULL
						$service_group_ids[] = get_the_terms( $post->ID, 'service_group' )[0]->term_id;
					}
				?>
			<?php endwhile; endif; wp_reset_postdata(); ?>
			
			<?php 	
				if(isset($service_group_ids)) :
					// Remove duplicate IDs
					$service_group_unique_ids = array_unique($service_group_ids); 
					foreach ($service_group_unique_ids as $key => $service_group_id) : 

						$servicePosta = null; // Resting
						$service_group = get_term($service_group_id);
						// var_dump($service_group);
					?><?php 
							
							$args_serv = array(
										        'posts_per_page' => -1,
										        'post_type' => 'services',
										        'tax_query' => array(
										            array (

										                'taxonomy' => 'service_group',
										                'field' => 'term_id',
										                'terms' => $service_group->term_id,
										            ),
										        ),
								        'orderby' => 'meta_value',
								        'meta_key' => 'handyman_type_of_service',
								        'order' => 'DESC'
							);
					
							$the_query_serv = new WP_Query( $args_serv );
							$totalCount = $the_query_serv->found_posts; // 
							
							if( $totalCount === 1 ) {
								$servicePost = $the_query_serv->posts[0];
							} else {
								$servicePost = null;
								$servicePostAll = $the_query_serv->posts;
							}
						
					?><?php if( isset($servicePost) ) : 
					
								// Show post instead of service group, if service group has only one item. ?>
						<?php // echo '<pre>'; var_dump($servicePost); exit; ?>

						<div class="col-md-4">
							
							<div class="emply-list" style="text-align: center;border: 1px solid #ddd; padding:15px; box-shadow: 2px 2px 4px 0px #0000002b; margin-bottom: 30px;height: 315px;">
								
								<div class="dvimag" style="/*border: 1px solid #ddd;*/">
									
									<?php if (get_field('handyman_product_discount', $servicePost->ID) > 0): ?>
										
										<div class="off30" style="background: rgba(242, 0, 0, 0.8);">
											<?php echo get_field('handyman_product_discount', $servicePost->ID); ?>% off
										</div>
										
									<?php endif; ?>

									<?php if (get_the_post_thumbnail_url($servicePost->ID)): ?>
									
										<a href="<?php echo get_permalink($servicePost->ID); ?>" title="">
											<img alt="" src="<?php echo get_the_post_thumbnail_url($servicePost->ID); ?>" style=" width: 100%;">
										</a>

									<?php else: ?>
										
										<a href="<?php echo get_permalink($servicePost->ID); ?>" title="">
											<img alt="" src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png" style=" width: 100%;">
										</a>
										
									<?php endif; ?>

								</div>
								<div class="emply-list-info">
									<h3 style="margin-bottom: 0px;">
										<a href="<?php echo get_permalink($servicePost->ID); ?>" title=""><?php echo $servicePost->post_title; ?></a>
									</h3>
									
									<p style="margin-bottom: 8px;"><strong><?php echo ucfirst(get_field('handyman_type_of_service', $servicePost->ID)); ?></strong> - 

										<?php if ( get_field('handyman_est_time', $servicePost->ID) > 0 ): ?>

											<?php $servicePrice = $per_min_cost * get_field('handyman_est_time', $servicePost->ID); ?>

											<?php 

												if (get_field('handyman_product_premium', $servicePost->ID)) {
													
													$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $servicePost->ID))/100;
												
												} else {
													
													$handyman_premium = 0;
												}

												$servicePrice = $servicePrice + $handyman_premium;

											?>

											<?php if (get_field('handyman_product_discount', $servicePost->ID) > 0) : ?>

												<del><?php 
													
													$discount = get_field('handyman_product_discount', $servicePost->ID);
													$afterDiscount = ( $servicePrice * $discount ) / 100;


													echo '$' . round($servicePrice); ?></del><span><?php echo '$' . round($servicePrice - $afterDiscount); ?></span></p>

											<?php else: ?>

												<?php $afterDiscount = 0; ?>
												<span class="no-discount"><?php echo '$' . round($servicePrice - $afterDiscount); ?></span></p>
												
											<?php endif; ?>

										<?php else: ?>

											<?php $servicePrice = $per_min_cost * get_field('handyman_est_time', $servicePost->ID); ?>

											<?php include(get_template_directory() . '/inc/has-nobase-has-options-cat.php'); ?>     
											
										<?php endif; ?>
										
										<a href="<?php echo get_permalink($servicePost->ID); ?>" class="view-details">View Details</a>
								</div>
							</div>
						</div>
					
					<?php else: // show service group. ?>
						
						<?php // echo '<pre>'; var_dump($servicePostAll[0]->ID); exit; ?>

						<div class="col-md-4">
							
							<div class="emply-list" style="text-align: center;border: 1px solid #ddd; padding: 15px; box-shadow: 2px 2px 4px 0px #0000002b;margin-bottom: 30px;height: 315px;">
								
								<div class="dvimag" style="border: 1px solid #ddd;">
									
									<?php if (get_field('handyman_product_discount', $servicePostAll[0]->ID) > 0): ?>

										<div class="off30" style="background: rgba(242, 0, 0, 0.8);">
											<?php echo get_field('handyman_product_discount', $servicePostAll[0]->ID); ?>% off
										</div>
										
									<?php endif; ?>


									<?php if (get_the_post_thumbnail_url($servicePostAll[0]->ID)) {

											$serviceImg = get_the_post_thumbnail_url($servicePostAll[0]->ID);

									} elseif(get_the_post_thumbnail_url($servicePostAll[1]->ID)) {
											$serviceImg = get_the_post_thumbnail_url($servicePostAll[1]->ID);
									} else {
										$serviceImg = null;
									} ?>





									<?php if(get_field('handyman_pro_service_group_thumbnail', 'service_group_' . $service_group->term_id)) : ?>

									<a href="<?php echo get_term_link($service_group->term_id, 'service_group'); ?>" title=""><img alt="<?php echo get_field('handyman_pro_service_group_thumbnail', 'service_group_' . $service_group->term_id)['alt']; ?>" src="<?php echo get_field('handyman_pro_service_group_thumbnail', 'service_group_' . $service_group->term_id)['url']; ?>" style=" width: 100%;"></a>
									<!-- <div class="off50">50% off</div> -->

									<?php else: ?>

										<?php if ($serviceImg): ?>

											<a href="<?php echo get_term_link($service_group->term_id, 'service_group'); ?>" title=""><img alt="" src="<?php echo $serviceImg; ?>" style=" width: 100%;"></a>

										<?php else: ?>

											<a href="<?php echo get_term_link($service_group->term_id, 'service_group'); ?>" title=""><img alt="" src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png" style=" width: 100%;"></a>
											
										<?php endif; ?>

									<?php endif; ?>

								</div>
								<div class="emply-list-info">
									<h3 style="margin-bottom: 0px;">
										<a href="<?php echo get_term_link($service_group->term_id, 'service_group'); ?>" title=""><?php echo $service_group->name; ?></a>
									</h3>
									<?php if ( isset($servicePostAll) ): 
										$servicetypea = '';
									?>
										<?php foreach ($servicePostAll as $key => $servicePosta ): ?>

											<p><strong><?php echo ucfirst(get_field('handyman_type_of_service', $servicePosta->ID )); ?></strong> - 
										
										<?php if (get_field('handyman_est_time', $servicePosta->ID) > 0): ?>

											<?php $servicePrice = $per_min_cost * get_field('handyman_est_time', $servicePosta->ID); ?>

											<?php if (get_field('handyman_product_discount', $servicePosta->ID) > 0): ?>

												<del><?php 
													
													if (get_field('handyman_product_premium', $servicePosta->ID)) {
														
														$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $servicePosta->ID))/100;
													} else {
														
														$handyman_premium = 0;
													}
													$servicePrice = $servicePrice + $handyman_premium;
													// IF Discount is set
													if(get_field('handyman_product_discount', $servicePosta->ID)) {
														$discount = get_field('handyman_product_discount', $servicePosta->ID);
														$afterDiscount = ( $servicePrice * $discount ) / 100;
													} else {
														$afterDiscount = 0;
													}
													echo '$' . round($servicePrice); ?></del>

													<span><?php echo '$' . round($servicePrice - $afterDiscount); ?></span></p>

											<?php else: ?>

												<?php $afterDiscount = 0; ?>

												<span class="no-discount"><?php echo '$' . round($servicePrice - $afterDiscount); ?></span></p>
												
											<?php endif; ?>

												

										<?php else: ?>

											<?php $servicePrice = $per_min_cost * get_field('handyman_est_time', $servicePosta->ID); ?>

											<?php include(get_template_directory() . '/inc/has-nobase-has-options-cat.php'); ?>  
										
										<?php endif; ?>								
											
										<?php endforeach; ?>
										
									<?php endif; ?>
                                    <p></p>
									<a href="<?php echo get_term_link($service_group->term_id, 'service_group'); ?>" class="view-details">View Details</a>
								</div>
							</div>
						</div>
					
					<?php endif; ?>
					
					<?php endforeach; ?>
					
					<?php else: ?>
						
						<div class="col-md-12">
							<div class="emply-list" style="    text-align: center;">
								<p style="border: 1px solid #ddd; padding: 10px; font-size: 0.8rem;">No Services Found.</p>
							</div>
						</div>

					<?php endif; ?>
			
					
			
		</div>
	</div>
        <div class="row findit">
            <?php get_template_part( 'template-parts/content', 'customize-button' ); ?>
        </div>
		<!-- <div class="pagination">
			<ul>
				<li class="prev">
					<a href=""><i class="la la-long-arrow-left"></i> Prev</a>
				</li>
				<li>
					<a href="">1</a>
				</li>
				<li class="active">
					<a href="">2</a>
				</li>
				<li>
					<a href="">3</a>
				</li>
				<li><span class="delimeter">...</span></li>
				<li>
					<a href="">14</a>
				</li>
				<li class="next">
					<a href="">Next <i class="la la-long-arrow-right"></i></a>
				</li>
			</ul>
		</div>  --><!-- Pagination -->

	</div>
</div>