<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package handyman_pro
 */

get_header();

$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;

?>

	<style>

		.emply-list-info p strong { font-weight: normal; color: #4c4c4c; }
		.emply-list-info p del { color: #2e45c3; padding-left: 4px; }
		.emply-list-info p span { color: #f44336;     font-weight: 600; padding-left: 4px; }
		a.view-details {
		    background: #325d88;
		    color: white;
		    padding: 5px 12px 6px 12px;
		    margin-top: 14px;
		    font-size: 14px;
		}

		span.no-discount {
		    color: #2e45c3 !important;
		}

		/*----9/4/21----*/

		.search-page-heading-wrapper{
			display: flex;
    		justify-content: space-between;
    		align-items: center;
		}

		.cust_but.desktop { display: none; }

		@media screen and (min-width: 768px) {
			.cust_but.desktop { display: block; }
			.cust_but.mobile { display: none; }
		}

	</style>

	<section class="overlape">
		<div class="block no-padding">
			<div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php bloginfo('template_directory'); ?>/assets/images/resource/mslider222.jpg) repeat scroll 50% 422.28px transparent;"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3><?php printf( esc_html__( 'Search Results for: %s', 'handyman_pro' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 search-page-heading-wrapper">
						<div class="inner-title2">
							<h3><?php printf( esc_html__( 'Search Results for: %s', 'handyman_pro' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
						</div>
						<div class="sortby-sec cust_but customize desktop">
							<a data-target="#customize-it" data-toggle="modal" href="#">Can't find it ? <u>See More Options</u></a>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="terms-conditions">

							<div class="container">
								<div class="row">

									<?php

										$search = trim($_GET['s']);

										if (substr($search, -1) != 's') {
											$search = $search;
										} else {
											$search = substr_replace($search, '', -1);
										}

										$service_groups = get_terms( array( 
											'taxonomy' => 'service_group',
											'hide_empty' => false,
											'name__like' => $search
										) );
										
										// echo '<pre>';
										// var_dump($current_service_group);
										// exit;

									
									?>
									
									<?php if ( !empty($service_groups) ) : ?>

									<?php foreach ($service_groups as $key => $service_group): ?>

										<?php 
											
											$args = array(
												        'posts_per_page' => -1,
												        'post_status' => 'publish',
												        'post_type' => 'services',
												        'tax_query' => array(
												            array (
												                'taxonomy' => 'service_group',
												                'field' => 'term_id',
												                'terms' => $service_group->term_id,
												            ),
												        )
											);
									
											$the_query = new WP_Query( $args );

											$totalCount = $the_query->found_posts; //	

											// $the_query->posts	
										
										?>

										<?php if ($totalCount > 1): ?>
											
												<div class="col-md-3">
														
														<div class="emply-list" style="text-align: center;border: 1px solid #ddd; padding: 15px; box-shadow: 2px 2px 4px 0px #0000002b;margin-bottom: 30px;height: 315px;">

															<div class="dvimag" style="border: 1px solid #ddd;">
																
																<?php if (get_field('handyman_product_discount', $the_query->posts[0]->ID) > 0): ?>
																			<div class="off30" style="background: rgba(242, 0, 0, 0.8);">
																				<?php echo get_field('handyman_product_discount', $the_query->posts[0]->ID); ?>% off
																			</div>
																			
																<?php endif; ?>

																<a href="<?php echo get_term_link($service_group->term_id, 'service_group'); ?>" title="">
																			<img alt="" src="<?php echo get_the_post_thumbnail_url($the_query->posts[0]->ID); ?>" style="width: 100%;">
																</a>

															</div>
															
															<div class="emply-list-info">
																
																<h3 style="margin-bottom: 0px;"><a href="<?php echo get_term_link($service_group->term_id, 'service_group'); ?>" title=""><?php echo $service_group->name; ?></a></h3>

																<?php if ( isset($the_query->posts) ): ?>
																		
																		<?php foreach ($the_query->posts as $key => $servicePosta ): ?>

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
																							
																							echo '$' . round($servicePrice, 2); ?></del>

																							<span><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span></p>

																					<?php else: ?>

																						<?php $afterDiscount = 0; ?>

																						<span class="no-discount"><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span></p>
																						
																					<?php endif; ?>

																			<?php else: ?>

																				<?php $servicePrice = $per_min_cost * get_field('handyman_est_time', $servicePosta->ID); ?>

																				<?php include(get_template_directory() . '/inc/has-nobase-has-options-cat.php'); ?> 
																			
																			<?php endif; ?>								
																			
																		<?php endforeach; ?>
																		
																<?php endif; ?>

																<p></p>
																<a class="view-details" href="<?php echo get_term_link($service_group->term_id); ?>">View Details</a>

															</div>

														</div>

												</div> <!-- col-md-4 -->

										<?php else: ?>

												<?php if (!empty($the_query->posts)): ?>
													
														<div class="col-md-3">
													
																<div class="emply-list" style="text-align: center;border: 1px solid #ddd; padding: 15px; box-shadow: 2px 2px 4px 0px #0000002b;margin-bottom: 30px;height: 315px;">

																	<div class="dvimag" style="border: 1px solid #ddd;">
																		
																		<?php if (get_field('handyman_product_discount', $the_query->posts[0]->ID) > 0): ?>
																			<div class="off30" style="background: rgba(242, 0, 0, 0.8);">
																				<?php echo get_field('handyman_product_discount', $the_query->posts[0]->ID); ?>% off
																			</div>
																			
																		<?php endif; ?>

																		<a href="<?php echo get_permalink($the_query->posts[0]->ID); ?>" title="">
																			<img alt="" src="<?php echo get_the_post_thumbnail_url($the_query->posts[0]->ID); ?>" style="width: 100%;"></a>
																	</div>
																	
																	<div class="emply-list-info">
																		
																		<h3 style="margin-bottom: 0px;"><a href="<?php echo get_permalink($the_query->posts[0]->ID); ?>" title=""><?php echo $the_query->posts[0]->post_title; ?></a></h3>

																		<p><strong><?php echo ucfirst(get_field('handyman_type_of_service', $the_query->posts[0]->ID)); ?></strong> - 


																		<?php if ( get_field('handyman_est_time', $the_query->posts[0]->ID) > 0 ): ?>

																				<?php $servicePrice = $per_min_cost * get_field('handyman_est_time', $the_query->posts[0]->ID); ?>

																				<?php if (get_field('handyman_product_discount', $the_query->posts[0]->ID)): ?>

																					<del><?php 
																				
																						if (get_field('handyman_product_premium', $the_query->posts[0]->ID)) {
																							
																							$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $the_query->posts[0]->ID))/100;
																						} else {
																							
																							$handyman_premium = 0;
																						}
																						$servicePrice = $servicePrice + $handyman_premium;
																						// If Discount is set
																						if(get_field('handyman_product_discount', $the_query->posts[0]->ID)) {
																							$discount = get_field('handyman_product_discount', $the_query->posts[0]->ID);
																							$afterDiscount = ( $servicePrice * $discount ) / 100;
																						} else {
																							$afterDiscount = 0;
																						}
																						echo '$' . round($servicePrice, 2); ?></del><span><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span></p>

																				<?php else: ?>

																					<?php $afterDiscount = 0; ?>
																					<span class="no-discount"><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span></p>
																					
																				<?php endif; ?>


																		<?php else: ?>

																				<?php $servicePosta = $the_query->posts[0]; ?>
																				
																				<?php $servicePrice = $per_min_cost * get_field('handyman_est_time', $the_query->posts[0]->ID); ?>

																				<?php include(get_template_directory() . '/inc/has-nobase-has-options-cat.php'); ?> 
																				
																		<?php endif; ?>

																		<a class="view-details" href="<?php echo get_permalink($the_query->posts[0]->ID); ?>">View Details</a>

																	</div>

																</div>
														</div> <!-- col-md-4 -->

												<?php endif; ?>

										<?php endif; ?>
										
									<?php endforeach;?>
									
									<?php else :

											get_template_part( 'template-parts/content', 'none' );

									endif; ?>

								</div>
								<div class="row">
									<div class="col-md-12"><?php // wp_pagenavi(); ?></div>
									<div class="col-md-12">
										<div class="sortby-sec cust_but customize mobile">
							<a data-target="#customize-it" data-toggle="modal" href="#">Can't find it ? <u>See More Options</u></a>
						</div>
									</div>
								</div>
							</div>


				
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
// get_sidebar();
get_footer();