<?php if ( isset($_SESSION['hnd_post_values']) && !empty($_SESSION['hnd_post_values']) ): 

$hasCustomService = false;

$freeEstimate = false;

$customerTOsupply = false;

?>
			
<?php foreach ( $_SESSION['hnd_post_values'] as $key => $hnd_post_value ): 


	if ($hnd_post_value['handymn_service_id'] == 'custom') {
		$freeEstimate = true;
	}

	// if ($tableitem > 1) {
	// 	$tableitem += $key + 1;
	// } else {
	// 	$tableitem += $key;
	// }
?>
<style>
.hndgroup { display: flex; }
.hndgroup h3 {
    margin-left: 10px;
    position: relative;
    top: 3px;
}
@media screen and (max-width: 576px){
.cart-mob-heading h4 {
    margin: 0rem;
    font-size: 22px;
}
.cart-mob-remove .item-remove {
    text-align: center;
    font-size: 14px;
    position: relative;
    top: unset;
    left: unset;
    margin-left: 0.6rem;
    padding: 5px 10px;
    letter-spacing: 0.5px;
}
.hndgroup {
    display: block;
}
.hndgroup h3 {
    position: relative;
    top: unset;
    margin: 0;
    padding: 0.3rem 0rem 1rem;
}
.hndgroup strong {
    font-weight: 600;
    font-size: 14px;
}
	tbody ul {
    padding-left: 30px;
}
}
</style>
						
	<div id="" class="row mycart" style="margin:25px 0 0px;">
		<div class="col-md-12" style="padding: 0;">
			
			<div class="cart-product">
				<div class="row">
					
												
					<?php // echo '<pre>'; var_dump(get_field('handyman_type_of_service', $hnd_post_value['handymn_service_id'])); ?>
				
					<div class="col-md-12" style="margin-top: 30px;">
						<table id="myTable" class="table table-bordered22">
							<thead>
								<tr>
									<th style="display: grid;grid-template-columns: 1fr 1fr 1fr;"><strong>Item #<?php echo $tableitem; ?></strong> 
										<h3 class="completion_time" style="display:inline-block;text-align: center;">Completion Time: <span>__</span></h3>
									</th>
									<th><strong>Price</strong>
									</th>
									<th><strong></strong>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
									    
									   <div class="row">
							        <?php if (get_the_post_thumbnail_url($hnd_post_value['handymn_service_id'])) { ?>
										
										<div class="col-md-4 col-12 pot8">
                                      	
                                      		<!-- <a href="#" class="item-remove2"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
											<img alt="<?php the_title(); ?>" src="<?php echo get_the_post_thumbnail_url($hnd_post_value['handymn_service_id']); ?>" style="width: 100%;">
										</div>
								<?php } else {  ?>
									<div class="col-md-4 col-12 pot8">
	                                  	<!-- <a href="#" class="item-remove2"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
										<img alt="<?php the_title(); ?>" src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/customservice.png" style="border: 1px solid #ddd;width: 100%;"></div>
									<?php /* if(!empty($hnd_post_value['handymn_insert_image'])) : ?>
										<div class="col-md-4 col-6 pot8">
	                                  	<!-- <a href="#" class="item-remove2"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
										<img alt="<?php the_title(); ?>" src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/customservice.png" style="border: 1px solid #ddd;width: 100%;"></div>
									<?php else: ?>
										<div class="col-md-4 col-6 pot8">
	                                  	<!-- <a href="#" class="item-remove2"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
										<img alt="<?php the_title(); ?>" src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/customservice.png" style="border: 1px solid #ddd;width: 100%;"></div>
										
									<?php endif; */ ?>
									
								<?php } ?>
								<div class="col-md-6 col-12 pot8 cart-mob-heading">
								
								    <h4><?php echo esc_html($hnd_post_value['handymn_service_name']); ?></h4>
								    <div class="hndgroup">
								    <?php /* if ($hnd_post_value['handymn_service_id'] !== 'custom'): ?>
															<?php echo ucfirst(get_field('handyman_type_of_service', $hnd_post_value['handymn_service_id'])); ?>
															
									<?php endif; */ ?>
									<?php $cart_caption_main = false; ?>
									<?php if (isset($hnd_post_value['handymn_showquantity']) && $hnd_post_value['handymn_showquantity'] > 1): ?>
										
										<strong>
											<?php 
											/* 4th Jan */
											$cart_caption_main = get_field('handyman_prod_shopping_cart_caption_main', $hnd_post_value['handymn_service_id']);
											if ($hnd_post_value['handymn_service_id'] !== 'custom'): 
												$type = ' (' . ucfirst(get_field('handyman_type_of_service', $hnd_post_value['handymn_service_id'])) . ')';
											else :
												$type = '';
												
											endif;
											if ($cart_caption_main != ''): ?>
												<?php if ( strpos($cart_caption_main, '{qt}') !== false ) : ?>
													<?php // echo esc_html($hnd_post_value['handymn_service_name']) . $type . ' - ' . str_replace('{qt}', $hnd_post_value['handymn_showquantity'], $cart_caption_main); 
													echo str_replace('{qt}', $hnd_post_value['handymn_showquantity'], $cart_caption_main);
													?>
												<?php else: ?>
													<?php echo $cart_caption_main . ' - ' . $hnd_post_value['handymn_showquantity'] . ' qty'; ?>
													
												<?php endif; ?>
											<?php else: ?>
												<?php echo esc_html($hnd_post_value['handymn_service_name']) . ' - ' . $hnd_post_value['handymn_showquantity'] . ' qty'; ?> 
												
											<?php endif; /* 4th Jan */ ?>																		
										</strong>
									<?php else: ?>
										<?php $cart_caption_main1 = get_field('handyman_prod_shopping_cart_caption_main', $hnd_post_value['handymn_service_id']); ?>
										<?php if ($cart_caption_main1 !== ''): ?>
											<strong>
												<?php if ( strpos($cart_caption_main1, '{qt}') !== false ) : ?>
													<?php echo esc_html(str_replace('{qt}', $hnd_post_value['handymn_showquantity'], $cart_caption_main1)); ?>
												<?php else: ?>
													<?php // var_dump($hnd_post_value['handymn_showquantity']); ?>
													<?php if ($hnd_post_value['handymn_showquantity'] > 1): ?>
														<?php echo $cart_caption_main1 . ' - ' . $hnd_post_value['handymn_showquantity'] . ' qty'; ?>
													<?php else: ?>
														<?php echo $cart_caption_main1; ?>
														
													<?php endif; ?>
													
												<?php endif; ?>														
												
											</strong>
										<?php else: ?>
										<?php /* <strong><?php echo esc_html($hnd_post_value['handymn_service_name']); ?> 
											
											<?php if ($hnd_post_value['handymn_service_id'] !== 'custom'): ?>
												(<?php echo ucfirst(get_field('handyman_type_of_service', $hnd_post_value['handymn_service_id'])); ?>) 
												
											<?php endif; ?>
											<?php echo (isset($hnd_post_value['handymn_custom_price'])) ? '<em style="font-size: 12px; font-style: italic;">- Customer\'s budget for this service.</em>' : ''; ?></strong>
										 */ ?>															
											
										<?php endif; ?>
									<?php endif; ?>
									<?php // var_dump($hnd_post_value['handymn_sl_addon_services']); ?>
									
									<?php if (!$cart_caption_main && !$cart_caption_main1 && $hnd_post_value['handymn_service_id'] !== 'custom'): ?>
										
										<?php if ( get_field('handyman_est_time', $hnd_post_value['handymn_service_id']) < 1 && !isset($hnd_post_value['handymn_sl_addon_services']) ): $hasCustomService = true; ?>

											<?php // echo '<pre>'; var_dump($hnd_post_value['handymn_custom_price']); ?>

											<strong>Customer Wants to Pay: </strong>
										
										<?php else: ?>
											<strong><?php echo ucfirst(get_field('handyman_type_of_service', $hnd_post_value['handymn_service_id'])) . ': '; ?></strong>
											
										<?php endif; ?>
										
										
									<?php endif; ?>
									
									<?php if( $hnd_post_value['handymn_service_id'] == 'custom' && get_field('handyman_est_time', $hnd_post_value['handymn_service_id']) == 0 ) : $hasCustomService = true; ?>

										<?php // var_dump($hnd_post_value['handymn_service_id']); ?>

										<strong>Customer Wants to Pay: </strong>

									<?php endif; ?>

									<h3 class="hnd-tl">Price: <span>$<?php echo $hnd_post_value['handymn_service_price'] ?> USD</span></h3>
									</div>  <!-- hndgroup -->
								</div>
								<div class="col-md-2 col-12 cart-mob-remove">
								    <a href="<?php echo get_permalink() . '?action=remove&type=service&id=' . $key; ?>" class="item-remove parenttrash"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</a>
								</div>
							</div> 
									    
									    
																							
										
										
										<?php if( get_field('handyman_est_time', $hnd_post_value['handymn_service_id']) > 0 ) : ?>
													<?php // var_dump($hnd_post_value['handymn_service_description']); ?>
													
													<!-- Includes -->
													<?php if ($hnd_post_value['handymn_service_description'] != ''): ?>
														<h5 style="margin-top: 20px;">Job Description:</h5>
														<?php if (isset($hnd_post_value['htmlentities'])): ?>
																<div style="margin-top: 15px;">
																	<?php echo html_entity_decode($hnd_post_value['handymn_service_description']); ?>
																</div>
															<?php else: ?>
																<div style="margin-top: 15px;">
																	<?php echo $hnd_post_value['handymn_service_description']; ?>
																</div>
																
															<?php endif; ?>
													
													<?php endif; ?>
													
													<?php // var_dump(isset($hnd_post_value['handymn_service_comments'])); ?>
													<!-- Comments -->
													<?php if ( isset($hnd_post_value['handymn_service_comments']) && $hnd_post_value['handymn_service_comments'] != ''): ?>
														<div class="" style="margin-top: 20px;">
															<h5 style="display: inline-block;margin-right: 5px;">Customer Comments:</h5>
															
															<span><?php echo esc_html($hnd_post_value['handymn_service_comments']); ?></span>
														
														</div>
													<?php endif; ?>
													<!-- Customers to Supply -->
													<?php if ($hnd_post_value['handymn_service_customer_to_supply'] != ''): ?>

														<?php $customerTOsupply = true; ?>

														<div class="" style="margin-top: 20px;">
															<h5 style="display: inline-block;margin-right: 5px;">Customer to supply:</h5>
															<span><?php echo esc_html($hnd_post_value['handymn_service_customer_to_supply']); ?></span>
																	
														</div>
													
													<?php endif; ?>
										<?php else: ?>
													<!-- Includes -->
													<?php if ($hnd_post_value['handymn_service_description'] != ''): ?>
														<h5 style="margin-top: 20px;">Job Description:</h5>
														
														<?php $cart_caption_main1 = get_field('handyman_prod_shopping_cart_caption_main', $hnd_post_value['handymn_service_id']); ?>
														<?php if ($cart_caption_main1 !== ''): ?>
															<div style="margin-top: 15px;">
																<?php if ( strpos($cart_caption_main1, '{qt}') !== false ) : ?>
																	<?php echo esc_html(str_replace('{qt}', $hnd_post_value['handymn_showquantity'], $cart_caption_main1)); ?>
																<?php else: ?>
																	<?php // var_dump($hnd_post_value['handymn_showquantity']); ?>
																	<?php if ($hnd_post_value['handymn_showquantity'] > 1): ?>
																		<?php echo $cart_caption_main1 . ' - ' . $hnd_post_value['handymn_showquantity'] . ' qty'; ?>
																	<?php else: ?>
																		<?php echo $cart_caption_main1; ?>
																		
																	<?php endif; ?>
																	
																<?php endif; ?>																	
																
															</div>
														<?php else: ?>




															<?php if (isset($hnd_post_value['htmlentities'])): ?>
																<div style="margin-top: 15px;">
																	<?php echo html_entity_decode($hnd_post_value['handymn_service_description']); ?>
																</div>
															<?php else: ?>
																<div style="margin-top: 15px;">

																	<?php // echo '<pre>'; var_dump($hnd_post_value); ?>


																	<?php echo $hnd_post_value['handymn_service_description']; ?>
																</div>
																
															<?php endif; ?>
															
															
														<?php endif; ?>
														<!-- Comments -->
														<?php if ( isset($hnd_post_value['handymn_service_comments']) && $hnd_post_value['handymn_service_comments'] != ''): ?>
															<div class="" style="margin-top: 20px;">
																<h5 style="display: inline-block;margin-right: 5px;">Customer Comments:</h5>
																
																<span><?php echo esc_html($hnd_post_value['handymn_service_comments']); ?></span>
															
															</div>
														<?php endif; ?>
													<?php else: ?>
														<?php // echo '<pre>'; var_dump($hnd_post_value['handymn_service_id']); ?>
														<?php /* if ($hnd_post_value['handymn_service_id'] == 'custom'): ?>
															<strong><?php echo 'Custom Project Request <em style="font-size: 12px; font-style: italic;">- Customer Wants to Pay.</em>'; ?></strong>	
															
														<?php endif; */ ?>
														
														<?php // echo '<pre>'; var_dump($hnd_post_value); ?>
														<!-- Comments -->
														<?php if ( isset($hnd_post_value['handymn_service_comments']) && $hnd_post_value['handymn_service_comments'] != ''): ?>
															<div class="">
																<h5 style="margin-top: 20px;display: inline-block;margin-right: 5px;">Customer Comments:</h5>
																
																<span><?php echo esc_html($hnd_post_value['handymn_service_comments']); ?></span>
															
															</div>
														<?php endif; ?>
													
													<?php endif; ?>

													<!-- Customers to Supply -->
													<?php if ($hnd_post_value['handymn_service_customer_to_supply'] != ''): ?>

														<?php $customerTOsupply = true; ?>

														<div class="" style="margin-top: 20px;">
															<h5 style="display: inline-block;margin-right: 5px;">Customer to supply: </h5>
															<span><?php echo esc_html($hnd_post_value['handymn_service_customer_to_supply']); ?></span>
																	
														</div>
													<?php else: ?>
														<?php if (isset( $_SESSION['hnd_options'][$key]) && !empty($_SESSION['hnd_options'][$key])): ?>
															<!-- do something -->
														<?php else: ?>
															<div class="" style="margin-top: 20px;">
																<h5 style="display: inline-block;margin-right: 5px;">Customer to supply:</h5>
																<span>All Materials</span>
																	
															</div>
															
														<?php endif; ?>
														
													
													<?php endif; ?>
										<?php endif; ?>
										
									</td>
									<?php if (isset($hnd_post_value['handymn_showquantity']) && $hnd_post_value['handymn_showquantity'] > 1): ?>
											<td>$<?php echo round($hnd_post_value['handymn_service_price']  * $hnd_post_value['handymn_showquantity'], 2); ?> USD</td>
										<?php else: ?>
											<td>$<?php echo round($hnd_post_value['handymn_service_price'], 2); ?> USD</td>
										<?php endif; ?>
									<td></td>
								</tr>
								
								<?php if (isset( $_SESSION['hnd_options'][$key]) && !empty($_SESSION['hnd_options'][$key])): 

								// echo '<pre>';
								// var_dump($_SESSION['hnd_options'][$key]);

								?>	
								
								<tr>
									<td colspan="3" class="total-pi"><strong>Selected Options</strong>
									</td>
								</tr>

								<?php endif; ?>
								<?php 	
										$handyman_total = 0;  
										$handyman_total_time = 0;  
										
										if (isset($hnd_post_value['handymn_showquantity']) && $hnd_post_value['handymn_showquantity'] > 1) {
											
											$handyman_total = $hnd_post_value['handymn_service_price'] * $hnd_post_value['handymn_showquantity']; 
											$handyman_total_time = $hnd_post_value['handymn_service_time'] * $hnd_post_value['handymn_showquantity'];
										} else {
											$handyman_total = $hnd_post_value['handymn_service_price']; 
											$handyman_total_time = $hnd_post_value['handymn_service_time'];
										}
											// var_dump($handyman_total );
											// var_dump($_SESSION['hnd_options'][$key]);
											// var_dump($_SESSION['hnd_suboptions'][$key]);
								?>
								
								<?php 
										// echo '<pre>';
										// var_dump($_SESSION['hnd_options']);
								?>
								
								<?php if ( isset($hnd_post_value['handymn_service_id']) 
											&& isset( $_SESSION['hnd_options'][$key] ) 
											&& isset( $_SESSION['hnd_suboptions'][$key] ) 
											&& isset( $_SESSION['all_service_setup'][$key] )
											&& isset( $_SESSION['hnd_post_values'][$key] )
											&& isset( $_SESSION['hnd_suboptions_values'][$key] )
										
										) :



								?>
								
									<?php foreach ( $_SESSION['hnd_options'][$key] as $elkey => $option_data ) : 

										// var_dump($option_data);
										// var_dump($_SESSION['hnd_del_options'][$key][$elkey]);

										// IF DELETED IN TEMP CART.
										if (isset($_SESSION['hnd_del_options'][$key]) && $option_data === $_SESSION['hnd_del_options'][$key][$elkey]) {

											$option_data = $_SESSION['hnd_del_options'][$key][$elkey] . '|deleted';
										} 

										// echo '<pre>'; 
										// var_dump($_SESSION['hnd_post_values'][$key]['handymn_service_opt_val']);
										$stripslashes = stripslashes($_SESSION['hnd_post_values'][$key]['handymn_service_opt_val']);
										$post_values = json_decode($stripslashes);
									
										// var_dump($elkey);
										// var_dump($option_data);
										$indivisual_opt_elem = explode('|', $option_data);
										$opt_type = $indivisual_opt_elem[0];
										
										$__Q = $indivisual_opt_elem[1]; // Choosen Question Index
										$__O = $indivisual_opt_elem[2]; // Choosen Option Index
										
										if (isset($indivisual_opt_elem[3])) {
													$__O_Delete = $indivisual_opt_elem[3]; // If deleted.
										} else {
											$__O_Delete = null;
										}
										if ( $opt_type !== 'undefined' ) { // Check If has sub-option


											// IF DELETED IN TEMP CART. - SUB OPTION
											if (isset($_SESSION['hnd_del_suboptions'][$key]) && $_SESSION['hnd_suboptions'][$key][$elkey] === $_SESSION['hnd_del_suboptions'][$key][$elkey]) {
											
												$_SESSION['hnd_suboptions'][$key][$elkey] = $_SESSION['hnd_del_suboptions'][$key][$elkey] . '|deleted';
											} 


											$indivisual_sub_elem = explode('|', $_SESSION['hnd_suboptions'][$key][$elkey] );
											$__S = $indivisual_sub_elem[3]; // Choosen SubOption Index
											if (isset($indivisual_sub_elem[4])) {
													$__SO_Delete = $indivisual_sub_elem[4]; // If deleted.
											} else {
												$__SO_Delete = null;
											}
										}
								
										if ( $opt_type === 'handyman_sub_option_quantity' ) {
											
											if ( !isset($__O_Delete) ) {
												if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply) {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt. '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													} else {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label. '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													}
												} else {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
													$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt;
													} else {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													}
												}
												$selected_option_labour_minutes = (int) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;
											} else {
												$selected_option_label = null;
												$selected_option_labour_minutes = 0;
											}
											
											if (!isset($__SO_Delete)) {
										
												$entered_suboption_quanity = (int) explode( '|', $_SESSION['hnd_suboptions_values'][$key][$elkey] )[2];
												if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_shopping_cart_caption) {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_cust_supply) {
														$stringCap = $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_shopping_cart_caption . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_cust_supply . '</span>';
													} else {
														$stringCap = $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_shopping_cart_caption;
													}
													
													
												} else {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_cust_supply) {
														
														$stringCap = $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_label . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_cust_supply . '</span>';
													} else {
														$stringCap = $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_label;
													}
													
												}
												if ( strpos($stringCap, '{qt}') !== false ) {
													$selected_suboption_label = str_replace('{qt}', $entered_suboption_quanity, $stringCap);
												} else {
													$selected_suboption_label = $stringCap . ' Qty - ' . $entered_suboption_quanity;
												}
												$selected_suboption_labour_minutes = (int) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_labour_minutes * $entered_suboption_quanity;
												if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_material) {
													
													$suboption_material_prc = (float) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_material * $entered_suboption_quanity;
												
												} else {
													$suboption_material_prc = 0;
												}
												
												
											} else {
												$selected_suboption_label = null;
												$selected_suboption_labour_minutes = 0;
												$suboption_material_prc = 0;
											}
											// var_dump( $selected_option_label );
											// var_dump( $selected_option_labour_minutes );
											// var_dump( $selected_suboption_label );
											// var_dump( $selected_suboption_labour_minutes );
											
										} elseif( $opt_type === 'handyman_sub_option_yesno' ) {
											
											if ( !isset($__O_Delete) ) {
												if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply) {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt. '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													} else {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label. '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													}
													
												} else {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt;
													} else {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													}
												}																
												$selected_option_labour_minutes = (int) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;
											} else {
												$selected_option_label = null;
												$selected_option_labour_minutes = 0;
											}
											
											if (!isset($__SO_Delete)) {
													if ( (int) $__S ===  0 ) { // IF YES
														if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_yesno_shopping_cart_caption) {
															if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_yesno_cust_supply) {
																$selected_suboption_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_yesno_shopping_cart_caption . ' <span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_yesno_cust_supply . '</span>';
															} else {
																$selected_suboption_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_yesno_shopping_cart_caption;
															}
														} else {
															$selected_suboption_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_label;
														}
														$selected_suboption_labour_minutes = (int) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_labour_minutes;
														if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_material) {
													
																$suboption_material_prc = (float) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_material;
															
														} else {
															$suboption_material_prc = 0;
														}
													} else { // IF NO
														$selected_suboption_label = null;
														$selected_suboption_labour_minutes = 0;
														$suboption_material_prc = 0;
													}
											} else {
														$selected_suboption_label = null;
														$selected_suboption_labour_minutes = 0;
														$suboption_material_prc = 0;
											}
										} elseif( $opt_type === 'handyman_sub_option_list' ) {
											
											if ( !isset($__O_Delete) ) {
												if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply) {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
														
													} else {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													}
													
												} else {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt;
													} else {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													}
													
												}
												
												$selected_option_labour_minutes = (int) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;
											} else {
												$selected_option_label = null;
												$selected_option_labour_minutes = 0;
											}
											if (!isset($__SO_Delete)) {
												
												if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_shopping_cart_caption) {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_customer_to_supply) { 
														$selected_suboption_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_shopping_cart_caption . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_customer_to_supply . '</span>';
													} else {
														$selected_suboption_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_shopping_cart_caption;
													}
													
													
												} else {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_customer_to_supply) {
														$selected_suboption_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_label  . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_customer_to_supply . '</span>';
													} else {
														$selected_suboption_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_label;
													}
													
												}
											// echo '<pre>';
											// var_dump($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_material);
												$selected_suboption_labour_minutes = (int) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_labour_minutes;
												if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_material) {
													
													$suboption_material_prc = (float) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_material;
												
												} else {
													$suboption_material_prc = 0;
												}
											} else {
														$selected_suboption_label = null;
														$selected_suboption_labour_minutes = 0;
														$suboption_material_prc = 0;
											}
											
										} elseif( $opt_type === 'undefined' ) {
											// $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O];
											if ( !isset($__O_Delete) ) {
												if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply) {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													} else {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													}
													
												} else {
													if ($_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt;
													} else {
														$selected_option_label = (string) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													}
												}
												
												$selected_option_labour_minutes = (int) $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;
											} else {
												$selected_option_label = null;
												$selected_option_labour_minutes = 0;
											}
											
											$selected_suboption_label = null;
											$selected_suboption_labour_minutes = 0;
											$suboption_material_prc = 0;
										}
										
									?>
										
										<?php 
											// Option Object Data - 15-Feb-2020
											$ndop_caption_opt 			= $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt;
											$ndop_customer_supply 		= $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply;
											$ndop_labour_minutes 		= $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;
											$ndop_material_price 		= $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_material_price;
											$ndop_mmultiply_p_quantity 	= $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_multiply_by_parent_quantity;
											$ndop_sub_option_check 		= $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_check;
											$ndop_sub_option_groups 	= $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups;
											if ( $ndop_caption_opt !== '' || 
													$ndop_customer_supply !== '' || 
													$ndop_labour_minutes !== '0' || 
													$ndop_material_price !== '0' || 
													$ndop_mmultiply_p_quantity !== false || ($ndop_sub_option_check !== true &&
														$ndop_sub_option_groups !== true)
												) {
												$trClass = '';
											
											} else {
												$trClass = 'hnd-tr-hide';
											}
											$materialPrc = 0;
										?>
										
										
										<?php 
											// PREMIUM/ DISCOUNT CODE GOES HERE
											// var_dump(get_field('handyman_product_premium', $hnd_post_value['handymn_service_id']));
										?>
										<?php 
											if (get_field('handyman_product_premium', $hnd_post_value['handymn_service_id'])) {
				
											$option_premium = ( ( $hnd_post_value['handymn_per_min_cost'] * $selected_option_labour_minutes ) * get_field('handyman_product_premium', $hnd_post_value['handymn_service_id']))/100;
											$sub_option_premium = ( ( $hnd_post_value['handymn_per_min_cost'] * $selected_suboption_labour_minutes ) * get_field('handyman_product_premium', $hnd_post_value['handymn_service_id']))/100;
											
											} else {
												
												$option_premium = 0;
												$sub_option_premium = 0;
											}
											$selected_option_labour_cost = ( ( $hnd_post_value['handymn_per_min_cost'] * $selected_option_labour_minutes ) + $option_premium );
											$selected_suboption_labour_cost = ( ( $hnd_post_value['handymn_per_min_cost'] * $selected_suboption_labour_minutes ) + $sub_option_premium );
											// var_dump($selected_suboption_labour_cost);
											// var_dump($sub_option_premium);
											// IF Discount is set
											if(get_field('handyman_product_discount', $hnd_post_value['handymn_service_id'])) {
												
												$option_discount = ( $selected_option_labour_cost * get_field('handyman_product_discount', $hnd_post_value['handymn_service_id']) ) / 100;
												$sub_option_discount = ( $selected_suboption_labour_cost * get_field('handyman_product_discount', $hnd_post_value['handymn_service_id']) ) / 100;
											} else {
												$option_discount = 0;
												$sub_option_discount = 0;
											}
											// var_dump($sub_option_discount);
											$selected_option_labour_cost = $selected_option_labour_cost - $option_discount;
											$selected_suboption_labour_cost = $selected_suboption_labour_cost - $sub_option_discount;
											// var_dump($hnd_post_value['handymn_per_min_cost'] * $selected_option_labour_minutes);
											// var_dump($selected_option_labour_cost);
											// var_dump($selected_option_labour_cost);
											// var_dump($option_discount);
											// var_dump('----------------');
											// var_dump($selected_option_labour_cost); */
											// var_dump($selected_option_labour_cost);
											// var_dump($selected_suboption_labour_cost);
											// var_dump($selected_option_labour_cost);
											// var_dump($selected_suboption_labour_cost);
										?>
										<?php if (isset($selected_option_label)): ?>
											
											<tr class="<?php echo $trClass; ?>">
												<td>
													
													<?php // echo '<pre>'; var_dump(explode('|', $post_values[$elkey])); 
													
													$materialPrc = explode('|', $post_values[$elkey])[2];
													//var_dump($materialPrc);
													echo $selected_option_label; ?> <?php echo ($selected_option_labour_minutes > 0) ? '' : ''; // (Included) ?>
														
												</td>
													<?php if ( isset( explode('|', $post_values[$elkey])[3]) && isset($hnd_post_value['handymn_showquantity']) && $hnd_post_value['handymn_showquantity'] > 1 ): ?>
														<td>$<?php echo round( $selected_option_labour_cost * $hnd_post_value['handymn_showquantity'] + $materialPrc * $hnd_post_value['handymn_showquantity'], 2); ?> USD</td>
													<?php else: ?>
														<td>$<?php echo round($selected_option_labour_cost + $materialPrc, 2); ?> USD</td>
														
													<?php endif; ?>
													
													<td class="del10"><a href="<?php echo get_permalink() . '?action=remove&service=true&type=option&eid=' . $key . '&aid=' . $elkey; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													</td>
											</tr>
											
										<?php endif; ?>
										
										
										<?php if (isset($selected_suboption_label)): // IF SUBOPTION EXISTS ?>
											<tr>
												<td><?php echo $selected_suboption_label; ?> <?php echo ($selected_suboption_labour_minutes > 0) ? '' : ''; // (Included) ?></td>
													<td>$<?php echo round( $selected_suboption_labour_cost + $suboption_material_prc, 2); ?> USD </td>
													<td class="del10"><a href="<?php echo get_permalink() . '?action=remove&service=true&type=suboption&eid=' . $key . '&aid=' . $elkey; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													</td>
											</tr>
											
										<?php endif; ?>
										<?php 
										// TOTAL PRICE
										if ( isset( explode('|', $post_values[$elkey])[3]) && isset($hnd_post_value['handymn_showquantity']) && $hnd_post_value['handymn_showquantity'] > 1 ): 
											$handyman_total += ( $hnd_post_value['handymn_showquantity'] * $selected_option_labour_cost + $materialPrc * $hnd_post_value['handymn_showquantity']  ) + $selected_suboption_labour_cost + $suboption_material_prc;
										
											$handyman_total_time += $hnd_post_value['handymn_showquantity'] * $selected_option_labour_minutes + $selected_suboption_labour_minutes;
										
										else:
											$handyman_total += ( $selected_option_labour_cost + $materialPrc ) + $selected_suboption_labour_cost + $suboption_material_prc;
								
											
										
											$handyman_total_time += $selected_option_labour_minutes + $selected_suboption_labour_minutes;
										endif;
										?>
									
									<?php endforeach; ?>													
									
								<?php endif; ?>			
								
								<?php 
								
									$_SESSION['cart_item_total'][ $key ] = round($handyman_total, 2);
									$_SESSION['cart_item_total_min'][ $key ] = $handyman_total_time;
									// var_dump( round($handyman_total, 2) ); 
								?>									
								<tr>
									<td class="total-p"><strong>Total Price</strong>
									</td>
									<td class="total-pi">
										<strong>$<?php echo round($handyman_total, 2); ?> USD</strong>
										<span class="hnd_total_time" style="display: none;"><?php echo timeConvert(trim($handyman_total_time)); // echo round($handyman_total_time/60, 2); ?></span>
									</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<?php if(!empty($hnd_post_value['handymn_insert_image'])) { ?>
						<h4 style="margin-top: 14px;display: block;">Customer Pictures</h4>
						<?php } ?>
						<div class="container">
							<div class="row">							
									<?php // echo '<pre>'; var_dump($hnd_post_value['handymn_insert_image']); ?>
									<?php if(!empty($hnd_post_value['handymn_insert_image'])) { ?>
									<?php	if ( $_GET && isset( $_GET['item'] ) && isset( $_GET['rmv'] ) ) :
											$item_number = (int) $_GET['item'];
											$image_number = (int) $_GET['rmv'];
											unset($_SESSION['hnd_post_values'][$item_number]['handymn_insert_image'][$image_number]);
											unset($_SESSION['hnd_post_values'][$item_number]['handymn_show_image'][$image_number]);
											$_SESSION['hnd_post_values'][$item_number]['handymn_insert_image'] = array_values($_SESSION['hnd_post_values'][$item_number]['handymn_insert_image']);
											$_SESSION['hnd_post_values'][$item_number]['handymn_show_image'] = array_values($_SESSION['hnd_post_values'][$item_number]['handymn_show_image']);
									endif;  ?>
										<?php foreach ($hnd_post_value['handymn_insert_image'] as $imk => $handymn_insert_image): ?>
			                              
			                              <div class="col-md-4 col-6 pot8">
			                              	<a href="<?php echo get_permalink() . '?item=' . $key . '&rmv=' . $imk; ?>" class="item-remove2" data-index="<?php echo $imk; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											<img alt="<?php the_title(); ?>" src="<?php echo $hnd_post_value['handymn_show_image'][$imk]; ?>" style="border: 1px solid #ddd;width: 100%;" class="hnd-custom-img">
										  </div>
											
										<?php endforeach; ?>
									
									<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- row mycart -->
<?php $tableitem++; endforeach; ?>
<?php endif; ?>