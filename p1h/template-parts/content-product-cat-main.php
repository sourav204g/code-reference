<?php 
global $service_category_object, $current_service_categories, $fetch_hour_price, $per_min_cost, $checkIFhasChildCAT; 
// var_dump($checkIFhasChildCAT);
 if (!empty($checkIFhasChildCAT)) :  ?>

	<div class="col-lg-9 col-md-9 col-sm-9 col-md-push-3">
		
		<div class="emply-list-sec style2">
			<div class="row">
				<?php $product_categories = $checkIFhasChildCAT; ?>
				<?php foreach ( $product_categories as $key => $product_category ): ?>
				
				<div class="col-md-4">
					<div class="emply-list">
						<div class="dvimag">
							<?php if (get_field('hnd_product_category_thumb_img', 'product_categories_' . $product_category->term_id)['url']): ?>
								<a href="<?php echo get_category_link( $product_category->term_id ); ?>" title=""><img alt="" src="<?php echo get_field('hnd_product_category_thumb_img', 'product_categories_' . $product_category->term_id)['url']; ?>" style="width: 100%;"></a>
							<?php else: ?>
								<a href="<?php echo get_category_link( $product_category->term_id ); ?>" title=""><img alt="" src="<?php echo home_url('/wp-content/themes/handyman_pro/assets/images/') . 'default-png03.png'; ?>" style="width: 100%;"></a>
								
							<?php endif ?>
							
						</div>
						<div class="emply-list-info">
							<h3 class="tx18"><a href="<?php echo get_category_link( $product_category->term_id ); ?>" style="text-transform: uppercase;" title=""><?php echo $product_category->name; ?></a></h3>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			
			
			
		</div>
	</div>

<?php else: ?>
	
	<div class="col-lg-9 col-md-9 col-sm-9 col-md-push-3">
							
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
			<div class="filterbar">
				<!-- <p>Showing results for "<?php echo $service_category_object->name; ?>"</p> -->
				<span class="prod-h" style="margin-right: 10px;">All products include taxes, delivery to your home and professional installation. </span><a class="howworks" data-target="#howworks" data-toggle="modal" href="#"> How it works </a>
				<!-- <p>Showing 1 – 12 of 40 results for "<?php echo $service_category_object->name; ?>"</p> -->
				<!-- <div class="sortby-sec cust_but customize">
					<a href="#">Can't find what you are looking for? Customize It</a>
				</div> -->
			</div>
			<div class="emply-list-sec style2">
				<div class="row">
					<?php
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
					?><?php if ( $the_query_group->have_posts() ) : while ( $the_query_group->have_posts() ) : $the_query_group->the_post(); ?>
							<?php // var_dump($post);
								if(get_the_terms( $post->ID, 'product_group' )) { // IN NOT NULL
									$service_group_ids['id'][] = get_the_terms( $post->ID, 'product_group' )[0]->term_id;
									$service_group_ids['post_img_link'][] = get_field('handyman_product_images', $post->ID)[0]['handyman_product_image']['url'];
									$service_group_ids['product_id'][] = $post->ID;
								}
								// var_dump($service_group_ids['post_img_link']);
								// echo '<pre>';
								// var_dump($service_group_ids);
								//exit;
							    ?>
							
					<?php endwhile; endif; wp_reset_postdata(); ?>
					<?php 	
						if(isset($service_group_ids)) :
							// Remove duplicate IDs
							$service_group_unique_ids = array_unique($service_group_ids['id']); 
							// var_dump($service_group_unique_ids);
							foreach ($service_group_unique_ids as $key => $service_group_id) : 
								$service_group = get_term($service_group_id);
								
								// var_dump($service_group_id);
								$productID = $service_group_ids['product_id'][$key];
									$args1 = array(
										        'posts_per_page' => -1,
										        'post_type' => 'products',
										        'tax_query' => array(
										            array (
										                'taxonomy' => 'product_group',
										                'field' => 'term_id',
										                'terms' => $service_group_ids['id'][$key],
										            ),
										        )
									);
							
									$the_query1 = new WP_Query( $args1 );
							?>
							<div class="col-md-4">
								
									<div class="emply-list p-emply-list">
										
										<div class="dvimag">
											<?php if(get_field('handyman_pro_service_group_thumbnail', 'product_group_' . $service_group->term_id)) : ?>
											<a href="<?php echo get_term_link($service_group->term_id, 'product_group'); ?>" title=""><img alt="<?php echo get_field('handyman_pro_service_group_thumbnail', 'product_group_' . $service_group->term_id)['alt']; ?>" src="<?php echo get_field('handyman_pro_service_group_thumbnail', 'product_group_' . $service_group->term_id)['url']; ?>" style=" width: 100%;"></a>
											<?php else: ?>
												<!-- <a href="<?php // echo get_term_link($service_group->term_id, 'product_group'); ?>" title=""><img alt="" src="<?php // echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png.png" style=" width: 100%;border: 1px solid #dadad5;"></a> -->
												<a href="<?php echo get_term_link($service_group->term_id, 'product_group'); ?>" title=""><img alt="" src="<?php echo $service_group_ids['post_img_link'][$key]; ?>" style=" width: 100%;border: 1px solid #dadad5;"></a>
											<?php endif; ?>
																						
										</div>
										<div align="center">
											<a class="btn spec" data-target="#specifications" data-toggle="modal">Features</a> 

											<div class="prod-spec" style="display: none;">
												<?php echo get_field('handyman_product_specifications', $the_query1->get_posts()[0]->ID);  ?>
											</div>
											
										</div> 
										<div class="emply-list-info">
											
											<h3><a href="<?php echo get_term_link($service_group->term_id, 'product_group'); ?>" title=""><?php echo $service_group->name; ?></a></h3>
											
											<h5 class="red5">Includes Product & Installation</h5>
											<?php if ($the_query1->post_count > 1) : ?>
												<?php 
												$typeofservices = '';
												foreach ($the_query1->get_posts() as $key => $prod) {
												
														// check if the repeater field has rows of data
														if( have_rows('handyman_product_link_to_services', $prod->ID) ):
														 	// loop through the rows of data
														    while ( have_rows('handyman_product_link_to_services', $prod->ID) ) : the_row(); 
														    $getServiceID = get_sub_field('handyman_product_link_to_service'); ?>
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
																	echo (float) get_field('handyman_prod_price', $productID) + round($servicePrice, 2); echo '</span>'; ?></strike>
																	
																	<span>$<?php echo '<span>'; ?><?php echo (float) get_field('handyman_prod_price', $productID) + round($servicePrice - $afterDiscount, 2); ?><?php echo '</span>'; ?></span> 
																	 
															</p>
														<?php    
														endwhile;
														endif;
												}
												?>
											<?php else: ?>
												<?php
												// check if the repeater field has rows of data
												if( have_rows('handyman_product_link_to_services', $productID) ):
												 	// loop through the rows of data
												    while ( have_rows('handyman_product_link_to_services', $productID) ) : the_row(); ?>
														
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
																echo (float) get_field('handyman_prod_price', $productID) + round($servicePrice, 2); echo '</span>'; ?></strike>
																
																<span>$<?php echo '<span>'; ?><?php echo (float) get_field('handyman_prod_price', $productID) + round($servicePrice - $afterDiscount, 2); ?><?php echo '</span>'; ?></span> 
																 
														</p>
												<?php
												    endwhile;
												endif; ?>
												
											<?php endif; ?>
											
										</div>
										<?php if (get_field('handyman_product_discount', $getServiceID)): ?>
											<div class="off30" style="background: rgba(242, 0, 0, 0.8);">
													<?php echo get_field('handyman_product_discount', $getServiceID); ?>% off
											</div>
											
										<?php endif; ?>
										
									</div>
							</div>
							<?php endforeach; ?>
						<?php endif; ?>
			 
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


				<?php if ( get_field('hnd_product_url_g', 'product_categories_' . $service_category_object->term_id) ): ?>

					<div class="col-lg-12">
				           <div class="browse-all-cat b22 ">

				           	<?php if (get_field('hnd_popup_content_g', 'product_categories_' . $service_category_object->term_id)): ?>

				           		<a target="_blank" class="style2 noradius blackbg hnd-external-link" data-link="<?php echo get_field('hnd_product_url_g', 'product_categories_' . $service_category_object->term_id); ?>" data-popuptext="<?php echo get_field('hnd_popup_content_g', 'product_categories_' . $service_category_object->term_id); ?>" title=""><?php echo get_field('hnd_product_question_g', 'product_categories_' . $service_category_object->term_id); ?></a>

				          

				           	<?php else: ?>

				           	    <a target="_blank" class="style2 noradius blackbg" href="<?php echo get_field('hnd_product_url_g', 'product_categories_' . $service_category_object->term_id); ?>" title=""><?php echo get_field('hnd_product_question_g', 'product_categories_' . $service_category_object->term_id); ?></a>
				           	  
				           	<?php endif; ?>

					          


				            </div>
			        </div>
					
				<?php endif; ?>

	</div>
<?php endif; ?>