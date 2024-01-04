<?php
/**
 * The template for displaying archive pages
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package handyman_pro
 */
$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;
$service_group_category_object = get_queried_object();
$prodArgs = array(
        'posts_per_page' => -1,
        'post_type' => 'products',
        'tax_query' => array(
            array (
                'taxonomy' => 'product_group',
                'field' => 'term_id',
                'terms' => $service_group_category_object->term_id,
            ),
        )
);

$the_query_prods = new WP_Query( $prodArgs );

$product_categoryAr = array();
$currentProductIDs  = array();
// $totalCount = $the_query_prod->found_posts; // count total products
// echo '<pre>';
// var_dump($the_query_prods->posts);
// exit;
get_header(); ?>
	
	<div class="loader-container">
		<div class="loader"></div>
	</div>

	<style>

		.job-single-head { position: relative; }

		.modal-body ul { padding-left: 40px; list-style: initial; }
		.head78 { background: transparent; padding-left: 0px; }
		.emply-list-info h4 { color: black; }

		.loader {
		  border: 16px solid #f3f3f3;
		  border-radius: 50%;
		  border-top: 16px solid #3498db;
		  width: 120px;
		  height: 120px;
		  -webkit-animation: spin 2s linear infinite; /* Safari */
		  animation: spin 2s linear infinite;
		  margin: 50vh auto;
		}

		/* Safari */
		@-webkit-keyframes spin {
		  0% { -webkit-transform: rotate(0deg); }
		  100% { -webkit-transform: rotate(360deg); }
		}

		@keyframes spin {
		  0% { transform: rotate(0deg); }
		  100% { transform: rotate(360deg); }
		}

		.loader-container {
		    background: rgba(255, 255, 255, 0.80);
		    position: absolute;
		    z-index: 99;
		    width: 100%;
		    height: 100%;
		}

		.p-emply-list { position: relative; }
		.p-emply-list .off30 { top: 24px; left: 24px; }

		@media screen and (min-width: 570px) {
			h2.head78.mobile { display: none; }
		}



.ma5slider .slide--active {
    display: block;
    z-index: 0;
}
		

	</style>
	<section class="">
		<div class="block no-padding">
			<div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php bloginfo('template_directory'); ?>/assets/images/resource/mslider222.jpg) repeat scroll 50% 422.28px transparent;">
			</div>
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3>Find Handyman Pro Products</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="block less-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">


						<?php // foreach ( $the_query_prods->posts as $key => $query_prod ): ?>

						<?php $query_prod = $the_query_prods->posts[0]; 

						if ($the_query_prods->post_count > 1) {
							$currentProductIDs[] = $the_query_prods->posts[0]->ID;
							$currentProductIDs[] = $the_query_prods->posts[1]->ID;
						} else {
							$currentProductIDs[] = $query_prod->ID;
						}


						?>
						
						<?php // if ( $the_query_prods->have_posts() ) : while ( $the_query_prods->have_posts() ) : $the_query_prods->the_post(); ?>
						
						<?php if (have_rows('handyman_product_link_to_services', $query_prod->ID )): ?>

						<h2 class="head78 mobile"><?php echo $service_group_category_object->name; ?></h2>
							
						<div class="job-single-sec">
							<div class="job-single-head" style="border: none;">
								<div class="row">
									<?php // var_dump(get_field('handyman_product_images')[0]['handyman_product_image']['url']); ?>
									
									<div class="col-md-4">

										

										<div class="ma5slider anim-horizontal horizontal-dots horizontal-navs center-dots inside-dots autoplay">
											<div class="slides">
												<?php if (get_field('handyman_product_images', $query_prod->ID )): ?>
													<a href="#slide-1"><img alt="" src="<?php echo get_field('handyman_product_images')[0]['handyman_product_image']['url']; ?>"></a>
												<?php endif; ?>
											</div>
											<div align="center">
												<a class="btn spec specificationsm" data-target="#specifications" data-toggle="modal">Features</a>
												<div class="specifications-content" style="display: none;">
													<?php echo get_field('handyman_product_specifications', $query_prod->ID ); ?>
												</div>
											</div>
											
											
										</div>
									</div>
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-12 hidden-xs">
												<h2 class="head78"><?php echo $service_group_category_object->name; ?></h2>
												<h5 class="red5">Includes Product & Installation</h5>
											</div>
											<div class="row col-md-12 hnd-no-of-prod">
												
												<?php
													
													
													
													foreach (get_the_terms( $query_prod->ID, 'product_categories' ) as $key => $product_category) {
														if( $product_category->parent === 0 ) {
															$product_categoryAr[] = $product_category->term_id;
														}
													}

													foreach ($the_query_prods->posts as $key => $prods_post ) {	

													// check if the repeater field has rows of data
													if( have_rows('handyman_product_link_to_services', $prods_post->ID) ):
													 	// loop through the rows of data
													    while ( have_rows('handyman_product_link_to_services', $prods_post->ID) ) : the_row(); ?>
													    	
													    	<div class="col-md-6 emply-list-info" style="margin-top: 1px;">
																<div class="emp6">
																	<?php 
																			$servicePrice = $per_min_cost * get_field('handyman_est_time', get_sub_field('handyman_product_link_to_service', $prods_post->ID));
																			if (get_field('handyman_product_premium', get_sub_field('handyman_product_link_to_service', $prods_post->ID))) {
																				
																				$handyman_premium = ($servicePrice * get_field('handyman_product_premium', get_sub_field('handyman_product_link_to_service', $prods_post->ID)))/100;
																			} else {
																				
																				$handyman_premium = 0;
																			}
																			$servicePrice = $servicePrice + $handyman_premium;
																			// IF Discount is set
																			if(get_field('handyman_product_discount', get_sub_field('handyman_product_link_to_service', $prods_post->ID))) {
																				$discount = get_field('handyman_product_discount', get_sub_field('handyman_product_link_to_service', $prods_post->ID));
																				$afterDiscount = ( $servicePrice * $discount ) / 100;
																			} else {
																				$afterDiscount = 0;
																			}
																			// $servicePrice = round($servicePrice - $afterDiscount, 2); 
																			//var_dump($servicePrice);
																			
																	?>
																	<h4 class="emp8">
																		<?php echo ucfirst(get_field('handyman_type_of_service', get_sub_field('handyman_product_link_to_service', $prods_post->ID))); ?>: 
																		
																		<del>$<?php echo (float) get_field('handyman_prod_price', $prods_post->ID) + round($servicePrice, 2); ?></del> <span> $<?php echo (float) get_field('handyman_prod_price', $prods_post->ID) + round($servicePrice - $afterDiscount, 2); ?></span>
																		
																	</h4>

																	<h5 class="red5">Includes Product &amp; Installation</h5>
																	
																	<div class="grid-info-box">
																		<a href="<?php echo get_permalink($prods_post->ID); ?>?service-id=<?php echo get_sub_field('handyman_product_link_to_service', $prods_post->ID); ?>" title="">Select This</a> 
																		<span class="bbb-hidde">
																			<a class="morebtn" href="#" onclick="show_mores('replacement'); return false;" style="margin-left: 10px;">View Details</a>
																		</span>
																	</div>
																	<div class="clearfix"></div>
																</div>
																<div class="hide-xs job-details replacement" style="padding-top: 1px;">
																	<div class="" style="padding-top: 0;">
																	<?php if (get_sub_field('handyman_product_service_description', $prods_post->ID)): 
																		echo get_sub_field('handyman_product_service_description', $prods_post->ID);
																	else:
																		echo get_field('handyman_prod_services_description', get_sub_field('handyman_product_link_to_service', $prods_post->ID));
																	endif; ?>
																	</div>
																</div>
															</div>
												<?php	    // display a sub field value
													        // get_sub_field('handyman_product_link_to_service');
													    endwhile;
													endif;

												} // foreach

												?>

											</div>
											
										</div>
									</div>
								</div>

								<?php if ($discount): ?>

									<div class="off30" style="background: rgba(242, 0, 0, 0.8);left: 24px;top:24px;">
											<?php echo $discount; ?>% off
									</div>
									
								<?php endif; ?>
							</div><!-- Job Head -->
						</div>

						<?php else: ?>
							<p style="text-align:center;">PRODUCT ISN'T FOUND.</p>
						<?php endif; ?>

						<?php // endforeach; ?>

						<?php // endwhile; endif; wp_reset_postdata(); ?>

						<?php 
							// var_dump($product_categoryAr);
							$product_categoryAr = array_unique($product_categoryAr);
							foreach ( $product_categoryAr as $key => $product_categoryAr_itemID ) {
								$args = array(
									        'posts_per_page' => -1,
									        'post_type' => 'products',
									        'tax_query' => array(
									            array (

									                'taxonomy' => 'product_categories',
									                'field' => 'term_id',
									                'terms' => $product_categoryAr_itemID,
									            ),
									        )
								);
						
								$the_query_moreproduct = new WP_Query( $args );
								foreach ( $the_query_moreproduct->posts as $key => $moreproductx ) {
									$relatedProductsAr[] = $moreproductx->ID;
								}														
								
							}
							$relatedProductsAr = array_unique($relatedProductsAr);
							$relatedProductsAr = array_diff($relatedProductsAr, $currentProductIDs); // 

							// var_dump($relatedProductsAr);
						?>

						<?php if ($relatedProductsAr): ?>

							<section>
								<div class="block less-top" style="margin-top: -25px;">
									<div class="container">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12">
												<h3>Related Products</h3>
												<hr>
												<!-- <div class="row m55d">
													<div class="col-md-12">
														<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
															<li class="nav-item">
																<a aria-controls="home" aria-selected="true" class="nav-link" data-toggle="tab" href="#home" id="home-tab" role="tab">NARROW SEARCH</a>
															</li>
															<li class="nav-item">
																<a aria-controls="profile" aria-selected="false" class="nav-link" data-toggle="tab" href="#profile" id="profile-tab" role="tab">SORT BY</a>
															</li>
														</ul>
														<div class="tab-content" id="myTabContent">
															<div aria-labelledby="home-tab" class="tab-pane fade show text-align" id="home" role="tabpanel">
																<h3 class="register-heading">NARROW SEARCH FOR PRODUCTS</h3>
																<form method="post">
																	<div class="row register-form">
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Brand
																				</option>
																				<option>
																					Dacor (74)
																				</option>
																				<option>
																					Electrolux (10)
																				</option>
																				<option>
																					Fisher &amp; Paykel (4)
																				</option>
																				<option>
																					Frigidaire (4)
																				</option>
																				<option>
																					GE (2)
																				</option>
																				<option>
																					KitchenAid (6)
																				</option>
																				<option>
																					Maytag (2)
																				</option>
																				<option>
																					Whirlpool (7)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Bridge Element
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Burner Grate Material
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Color
																				</option>
																				<option>
																					Black
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Commercial Style
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Control Type
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Cooking Surface Style
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Cooking Surface Type
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Cooktop Size Group
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Downdraft Exhaust
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Dual/Triple Element
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Hot Surface Indicator Lights
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Ignition Type
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Induction Heating
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Keep Warm Zone
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Lowe's Exclusive
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Melting Burner
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Number of Burners/Cooking Zones
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Number of Elements/Cooking Zones
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Price
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Rating
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Simmer Burner
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Simmer Element
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																		<div class="form-group col-md-4">
																			<select>
																				<option selected="selected" value="Sh Brand">
																					Shop By Sub-Brand
																				</option>
																				<option>
																					No (26)
																				</option>
																				<option>
																					Yes (6)
																				</option>
																			</select>
																		</div>
																	</div>
																</form>
															</div>
															<div aria-labelledby="profile-tab" class="tab-pane fade show text-align" id="profile" role="tabpanel">
																<h3 class="register-heading">SORT BY PRODUCTS</h3>
																<div class="row register-form">
																	<form method="post">
																		<div class="form-group col-md-12">
																			<input checked name="sort" type="radio" value="Best Sellers">Best Sellers
																		</div>
																		<div class="form-group col-md-12">
																			<input checked name="sort" type="radio" value="Best Sellers"> Customer Ratings
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
												</div> -->
												<div class="emply-list-sec style2">
													<div class="row">
														
														<?php foreach ( $relatedProductsAr as $key => $relatedProductID ): ?>
															<?php // var_dump($relatedProductID); ?>
															<?php 
															$product_groupv = get_the_terms( $relatedProductID, 'product_group' )[0]->term_id;
															$product_groupv_link = get_term_link($product_groupv);
															?>
															<div class="col-md-3">
																<div class="emply-list p-emply-list">
																	
																	<div class="dvimag">
																		<a href="<?php echo $product_groupv_link; ?>" title="">
																			<img alt="" src="<?php echo get_field('handyman_product_images', $relatedProductID)[0]['handyman_product_image']['url']; ?>" style=" width: 100%;">
																		</a>
																	</div>
																	<div align="center">
																		<a class="btn spec specificationsm1" data-target="#specifications" data-toggle="modal">Features</a>
																		<div class="specifications-content1" style="display: none;">
																			<?php echo get_field('handyman_product_specifications', $relatedProductID); ?>
																		</div>
																	</div>
																
																	<div class="emply-list-info ">
																		<h3 style="text-align: center;">
																			<a href="<?php echo $product_groupv_link; ?>" title=""><?php echo get_the_title($relatedProductID); ?></a>
																		</h3>
																		<h5 class="red5">Includes Product & Installation</h5>
																		<!-- type -->
																		<?php
																		// check if the repeater field has rows of data
																		if( have_rows('handyman_product_link_to_services', $relatedProductID) ):
																		 	// loop through the rows of data
																		    while ( have_rows('handyman_product_link_to_services', $relatedProductID) ) : the_row(); ?>
																				
																				<?php $getServiceID = get_sub_field('handyman_product_link_to_service'); ?>
																		    	<p class="blk5"><?php echo ucfirst(get_field('handyman_type_of_service', $getServiceID)); ?>
																				<strike><?php 
																						$servicePrice = $per_min_cost * get_field('handyman_est_time', $getServiceID);
																						if (get_field('handyman_product_premium', $getServiceID)) {
																							
																							$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $getServiceID))/100;
																						} else {
																							
																							$handyman_premium = 0;
																						}
																						$servicePrice = $servicePrice + $handyman_premium;
																						// IF Discount is set
																						if(get_field('handyman_product_discount', $getServiceID)) {
																							$discount = get_field('handyman_product_discount', $getServiceID);
																							$afterDiscount = ( $servicePrice * $discount ) / 100;
																						} else {
																							$afterDiscount = 0;
																						}
																						echo '$<span>'; 
																						echo (float) get_field('handyman_prod_price', $relatedProductID) + round($servicePrice, 2); echo '</span>'; ?></strike>
																						
																						<span>$<?php echo '<span>'; ?><?php echo (float) get_field('handyman_prod_price', $relatedProductID) + round($servicePrice - $afterDiscount, 2); ?><?php echo '</span>'; ?></span> 
																						 
																				</p>
																		<?php
																		    endwhile;
																		endif; ?>
																		<!-- / type -->
																	</div>
																

																<?php if (get_field('handyman_product_discount', $getServiceID)): ?>

																	<div class="off30" style="background: rgba(242, 0, 0, 0.8);">
																			<?php echo get_field('handyman_product_discount', $getServiceID); ?>% off
																	</div>
																	
																<?php endif; ?>

																</div>
															</div>
															
														<?php endforeach; ?>												
														
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
													</div> --><!-- Pagination -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							
						<?php endif ?>
						
						



					</div>
				</div>
			</div>
		</div>
	</section>
	<script language="javascript" type="text/javascript">
		
		if (jQuery('.job-single-sec:first-child .hnd-no-of-prod > .emply-list-info').length < 2 && jQuery('.job-single-sec').length < 2) {
			// document.location.href = jQuery('.job-single-sec:first-child .hnd-no-of-prod > .emply-list-info > .emp6 > .grid-info-box a').prop('href');
			jQuery('.loader-container').css('display', 'none'); // 15-march--2021
		} else {
			jQuery('.loader-container').css('display', 'none');
		}



		function show_mores(nextclass) {
			jQuery("."+nextclass).toggle();
		}
		
	</script>
<?php
get_footer(); ?>
<!-- Specifications Modal -->
<div class="modal" id="specifications">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Features</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	
	$('.specificationsm').click(function(){
		let specs = $(this).next().html();
		$('.modal-body').html(specs);
	});

	$('.specificationsm1').click(function(){
		let specs = $(this).next().html();
		$('.modal-body').html(specs);
	});
	// REF - https://stackoverflow.com/questions/21863462/bootstrap-modal-dynamic-content
	// $('#specifications').on('show.bs.modal', function(){
	// 	let specs = $('.specifications-content').html();
	//     $('.modal-body').html(specs);
	// });
</script>