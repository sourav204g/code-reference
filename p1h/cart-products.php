<style>
	.hnd-group { display: flex; }
	.hnd-group span { margin-left: 10px; }
</style><?php 
	// echo "<pre>";
	// var_dump($_SESSION['hnd_product_post_values']);
	if ( isset($_SESSION['hnd_product_post_values']) && !empty($_SESSION['hnd_product_post_values']) ) : // Product 

	$customerTOsupply_Prod = false;

	?>
						
	<?php foreach ( $_SESSION['hnd_product_post_values'] as $key => $hnd_product_post_value ): ?>

	<?php if ($hnd_product_post_value['handyman_product_customer_to_supply']): 

		$customerTOsupply_Prod = true;

	endif; ?>
	
	<?php 
		// echo '<pre>';
		// var_dump($hnd_product_post_value);
		// if ($tableitem > 1) {
		// 	$tableitem += $key + 1;
		// } else {
		// 	$tableitem += $key;
		// }	
		
		// var_dump($hnd_product_post_value['handymn_asso_service_id']); 
		// var_dump(get_post($hnd_product_post_value['handymn_product_id']->post_title))
	?><?php 
				
				$servicePrice = $per_min_cost * get_field('handyman_est_time', $hnd_product_post_value['handymn_asso_service_id']);
					// var_dump($servicePrice);
					// var_dump(round($per_min_cost,2));
					// exit();
				if (get_field('handyman_product_premium', $hnd_product_post_value['handymn_asso_service_id'])) {
					
					$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $hnd_product_post_value['handymn_asso_service_id']))/100;
				} else {
					
					$handyman_premium = 0;
				}
				$servicePrice = $servicePrice + $handyman_premium;
				
				// IF Discount is set
				if(get_field('handyman_product_discount', $hnd_product_post_value['handymn_asso_service_id'])) {
					$discount = get_field('handyman_product_discount', $hnd_product_post_value['handymn_asso_service_id']);
					$afterDiscount = ( $servicePrice * $discount ) / 100;
				} else {
					$afterDiscount = 0;
				}
				
				$product_org_price = (float) get_field('handyman_prod_price', $hnd_product_post_value['handymn_product_id']) + round($servicePrice, 2); 
				$product_final_price = (float) get_field('handyman_prod_price', $hnd_product_post_value['handymn_product_id']) + round($servicePrice - $afterDiscount, 2);
	
	?><?php if(get_field('handyman_product_discount', $hnd_product_post_value['handymn_asso_service_id'])) : ?>
<style>
	@media screen and (max-width: 768px) {
		a.item-remove.parenttrash.prod { right: calc(100% - 60%); }
	}
</style>
<?php else: ?>
	<style>
		@media screen and (max-width: 768px) {
			a.item-remove.parenttrash.prod {
			    position: relative;
			    left: 28px;
			    top: 58px;
			}
		}
	</style>
<?php endif; ?>
	
<style type="text/css">
.cart-items-inner-wrapper {
    margin: 0 -15px;
}
	
	@media screen and (max-width: 576px){
.cart-product h4 {
    margin: 0 0 6px;
    font-size: 22px;
}
.cart-mob-remove .item-remove.parenttrash.prod {
    text-align: center;
    font-size: 14px;
    position: relative;
    top: unset;
    left: unset;
    margin: 1rem 0 0;
    padding: 5px 10px;
    letter-spacing: 0.5px;
    right: unset;
    display: inline-block;
}
.hnd-group {
    display: block;
}
.hnd-group span {
    margin-left: 0px; 
}
.hnd-group h3 {
    position: relative;
    top: unset;
    margin: 0;
    padding: 0rem 0rem 0rem;
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
	<!-- PRODUCTS
    =========================== -->
	<div id="" class="row myproductcart" style="margin:25px 0 0px;">
		<div class="col-md-12" style="padding: 0;">
			
			<div class="cart-product">
				<div class="row">
			
					<!-- Product Customer to supply -->
					<!-- <div class="col-md-12" style="margin-top: 20px;margin-bottom: 20px;">
						<h5>Customer to supply:</h5>
						<?php // echo get_field('handyman_prod_services_customer_to_supply', $hnd_product_post_value['handymn_asso_service_id']); ?>
						
					</div> -->
					<div class="col-md-12">
						<table id="myTable" class="table table-bordered22">
							<thead>
								<tr>
									<th style="display: grid;grid-template-columns: 1fr 1fr 1fr;">
										<strong>Item #<?php echo $tableitem; ?></strong>
										<!-- <h3 class="completion_time_product" style="text-align:center;display: inline-block;">Completion Time: <span><?php // echo timeConvert(get_field('handyman_est_time', $hnd_product_post_value['handymn_asso_service_id']) * $hnd_product_post_value['handymn_prod_quantity']); ?></span></h3> -->
										<h3 class="completion_time" style="display:inline-block;text-align: center;">Completion Time: <span>__</span></h3>
									</th>
									<th><strong>Price</strong>
									</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td>
									    
									    <div class="row cart-items-inner-wrapper">
									        <div class="col-md-4 cart-mob-heading">
                        						<?php if (get_field('handyman_product_discount', $hnd_product_post_value['handymn_service_id'])): ?>
                        							<div class="off30" style="background: rgba(242, 0, 0, 0.8);">
                        								<?php echo get_field('handyman_product_discount', $hnd_product_post_value['handymn_service_id']); ?>% off
                        							</div>
                        						<?php endif; ?>
						
						                        <img src="<?php echo get_field('handyman_product_images', $hnd_product_post_value['handymn_product_id'])[0]['handyman_product_image']['url']; ?>" style="width: 100%;" />
					                        </div>
    					                   <div class="col-md-6">
    						
                        						<h4><?php echo get_post($hnd_product_post_value['handymn_product_id'])->post_title; ?></h4>					
                        						
                        						<strong style=" font-size: 14px; font-style: italic; margin-bottom: 5px; display: block; color: darkcyan; ">Includes <?php echo get_post($hnd_product_post_value['handymn_asso_service_id'])->post_title . ' and ' . ucfirst(get_field('handyman_type_of_service', $hnd_product_post_value['handymn_asso_service_id'])) . ' labour'; ?></strong>		
                        
                        						
                        						<div class="hnd-group">
                        							<h3 class="hnd-tl">Price: <span>$<?php echo round($handyman_total, 2); ?> USD</span></h3>	
                        							<span style="font-size: 12px;">Quantity: <?php echo (int) $hnd_product_post_value['handymn_prod_quantity']; ?></span>	
                        							
                        						</div>
                        													
    
    					                    </div>
    					                    <div class="col-md-2 col-12 cart-mob-remove">
    					                        <a href="<?php echo get_permalink() . '?action=remove&type=product&id=' . $key; ?>" class="item-remove parenttrash prod"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</a>
    					                    </div>
									  </div>
									    
									    
									    <?php // echo '<pre>'; var_dump($hnd_product_post_value); ?>
									    
										<strong><?php // echo get_post($hnd_product_post_value['handymn_product_id'])->post_title; ?> <!-- (<?php // echo ucfirst(get_field('handyman_type_of_service', $hnd_product_post_value['handymn_asso_service_id'])); ?>) --></strong>
										<!-- <br> -->
										
										<?php if ( get_field('handyman_product_link_to_services', $hnd_product_post_value['handymn_product_id']) ): ?>
											<h5 style="margin-top: 20px;">Job Description:</h5>
											<?php // echo get_field('handyman_prod_services_description', $hnd_product_post_value['handymn_asso_service_id']); ?>
											<?php 
												$mofiedDesc = 0;
												$mofiedDesCotent = '';
												foreach ( get_field('handyman_product_link_to_services', $hnd_product_post_value['handymn_product_id']) as $key => $plink_to_service) {			
												
													if ( $plink_to_service['handyman_product_link_to_service'] === $hnd_product_post_value['handymn_asso_service_id'] && 
														 $plink_to_service['handyman_product_service_description'] !== '' ) {
													
															$mofiedDesc = 1;
															$mofiedDesCotent = $plink_to_service['handyman_product_service_description'];
													}
												}
												// var_dump($plink_to_service['handyman_product_link_to_service']);
												// var_dump($hnd_product_post_value['handymn_asso_service_id']);
												if ($mofiedDesc) {
													echo $mofiedDesCotent;
												} else {
													echo $mofiedDesCotent = get_field('handyman_prod_services_description', $hnd_product_post_value['handymn_asso_service_id']); 
												}
											?>
											
										<?php endif; ?>
										<?php if ( isset($hnd_product_post_value['handymn_service_comments']) && $hnd_product_post_value['handymn_service_comments'] != ''): ?>
											<div class="" style="margin-top: 20px;">
												<h5 style="display: inline-block;margin-right: 5px;">Customer Comments:</h5>
												
												<span><?php echo esc_html($hnd_product_post_value['handymn_service_comments']); ?></span>
											
											</div>
										<?php endif; ?>
									</td>
									<td>$<?php echo $product_final_price * (int) $hnd_product_post_value['handymn_prod_quantity']; ?></td>
									<td></td>
								</tr>
								<!-- product option -->
								<?php 
								// var_dump($hnd_product_post_value['handymn_service_id']);
								// var_dump($_SESSION['hnd_product_options']);
								// var_dump($_SESSION['hnd_product_suboptions']);
								// var_dump($_SESSION['all_product_setup']);
								// var_dump($_SESSION['hnd_product_post_values']);
								// var_dump($_SESSION['hnd_product_suboptions_values']);
								// exit;
								?>
								<?php 	
										
										$handyman_total = 0;  
										$handyman_total_time = 0;  
										// var_dump($hnd_product_post_value['handymn_showquantity']);
										
										if (isset($hnd_product_post_value['handymn_showquantity']) && $hnd_product_post_value['handymn_showquantity'] > 1) {
											
											$handyman_total = $hnd_product_post_value['handymn_service_price'] * $hnd_product_post_value['handymn_showquantity'] + ( $hnd_product_post_value['handymn_product_price'] * $hnd_product_post_value['handymn_showquantity'] ); 
											$handyman_total_time = $hnd_product_post_value['handymn_service_time'] * $hnd_product_post_value['handymn_showquantity'];
										} else {
											$handyman_total = $hnd_product_post_value['handymn_service_price'] + $hnd_product_post_value['handymn_product_price']; 
											$handyman_total_time = $hnd_product_post_value['handymn_service_time'];
										}
											// var_dump($handyman_total);
											// var_dump($handyman_total );
											// var_dump($handyman_total_time );
											
											// var_dump($_SESSION['hnd_product_options'][$key]);
											// var_dump($_SESSION['hnd_product_suboptions'][$key]);
											// echo '<pre>';
											// var_dump($_SESSION['hnd_product_options'][$key]);
								?>
								<?php if (isset( $_SESSION['hnd_product_options'][$key]) && !empty($_SESSION['hnd_product_options'][$key])): ?>	
									
								<tr>
									<td colspan="3" class="total-pi"><strong>Selected Options</strong>
									</td>
								</tr>
								<?php endif; ?>
								
								<?php 
										// var_dump($_SESSION);
										// hnd_product_options
										// hnd_product_suboptions 
										// all_product_setup
										// hnd_product_suboptions_values
										// echo '<pre>';
										// var_dump($hnd_product_post_value['handymn_service_id']);
										// var_dump($_SESSION['hnd_product_options'][$key]);
										// var_dump($_SESSION['hnd_product_suboptions'][$key]);
										// var_dump($_SESSION['all_product_setup'][$key]);
										// var_dump($_SESSION['hnd_product_post_values'][$key]);
										// var_dump($_SESSION['hnd_product_suboptions_values'][$key]);
										if ( isset($hnd_product_post_value['handymn_service_id']) 
											&& isset( $_SESSION['hnd_product_options'][$key] ) 
											&& isset( $_SESSION['hnd_product_suboptions'][$key] ) 
											&& isset( $_SESSION['all_product_setup'][$key] )
											&& isset( $_SESSION['hnd_product_post_values'][$key] )
											&& isset( $_SESSION['hnd_product_suboptions_values'][$key] )
										
										) : 
									?>
									<?php foreach ( $_SESSION['hnd_product_options'][$key] as $elkey => $option_data ) : 
										// echo '<pre>'; 
										// var_dump($_SESSION['hnd_product_post_values'][$key]['handymn_service_opt_val']);
										$stripslashes = stripslashes($_SESSION['hnd_product_post_values'][$key]['handymn_service_opt_val']);
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
											$indivisual_sub_elem = explode('|', $_SESSION['hnd_product_suboptions'][$key][$elkey] );
											$__S = $indivisual_sub_elem[3]; // Choosen SubOption Index
											if (isset($indivisual_sub_elem[4])) {
													$__SO_Delete = $indivisual_sub_elem[4]; // If deleted.
											} else {
												$__SO_Delete = null;
											}
										}
										if ( $opt_type === 'handyman_sub_option_quantity' ) {
											
											if ( !isset($__O_Delete) ) {
												if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply) {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt. '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													} else {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label. '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													}
												} else {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
													$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt;
													} else {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													}
												}
												$selected_option_labour_minutes = (int) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;
											} else {
												$selected_option_label = null;
												$selected_option_labour_minutes = 0;
											}
											
											if (!isset($__SO_Delete)) {
										
												$entered_suboption_quanity = (int) explode( '|', $_SESSION['hnd_product_suboptions_values'][$key][$elkey] )[2];
												if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_shopping_cart_caption) {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_cust_supply) {
														$stringCap = $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_shopping_cart_caption . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_cust_supply . '</span>';
													} else {
														$stringCap = $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_shopping_cart_caption;
													}
													
													
												} else {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_cust_supply) {
														
														$stringCap = $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_label . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_cust_supply . '</span>';
													} else {
														$stringCap = $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_label;
													}
													
												}
												if ( strpos($stringCap, '{qt}') !== false ) {
													$selected_suboption_label = str_replace('{qt}', $entered_suboption_quanity, $stringCap);
												} else {
													$selected_suboption_label = $stringCap . ' Qty - ' . $entered_suboption_quanity;
												}
												$selected_suboption_labour_minutes = (int) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_labour_minutes * $entered_suboption_quanity;
												if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_material) {
													
													$suboption_material_prc = (float) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_material * $entered_suboption_quanity;
												
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
												if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply) {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt. '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													} else {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label. '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													}
													
												} else {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt;
													} else {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													}
												}																
												$selected_option_labour_minutes = (int) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;
											} else {
												$selected_option_label = null;
												$selected_option_labour_minutes = 0;
											}
											
											if (!isset($__SO_Delete)) {
													if ( (int) $__S ===  0 ) { // IF YES
														if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_yesno_shopping_cart_caption) {
															if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_yesno_cust_supply) {
																$selected_suboption_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_yesno_shopping_cart_caption . ' <span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_yesno_cust_supply . '</span>';
															} else {
																$selected_suboption_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_yesno_shopping_cart_caption;
															}
														} else {
															$selected_suboption_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_label;
														}
														$selected_suboption_labour_minutes = (int) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_labour_minutes;
														if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_material) {
													
																$suboption_material_prc = (float) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_material;
															
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
												if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply) {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
														
													} else {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													}
													
												} else {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt;
													} else {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													}
													
												}
												
												$selected_option_labour_minutes = (int) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;
											} else {
												$selected_option_label = null;
												$selected_option_labour_minutes = 0;
											}
											if (!isset($__SO_Delete)) {
												
												if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_shopping_cart_caption) {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_customer_to_supply) { 
														$selected_suboption_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_shopping_cart_caption . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_customer_to_supply . '</span>';
													} else {
														$selected_suboption_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_shopping_cart_caption;
													}
													
													
												} else {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_customer_to_supply) {
														$selected_suboption_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_label  . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_subsub_list_customer_to_supply . '</span>';
													} else {
														$selected_suboption_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_label;
													}
													
												}
											// echo '<pre>';
											// var_dump($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_material);
												$selected_suboption_labour_minutes = (int) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_labour_minutes;
												if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_material) {
													
													$suboption_material_prc = (float) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_material;
												
												} else {
													$suboption_material_prc = 0;
												}
											} else {
														$selected_suboption_label = null;
														$selected_suboption_labour_minutes = 0;
														$suboption_material_prc = 0;
											}
											
										} elseif( $opt_type === 'undefined' ) {
											// $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O];
											if ( !isset($__O_Delete) ) {
												if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply) {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													} else {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label . '<span class="cts-cart"><b> Customer to supply: </b>' . $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply . '</span>';
													}
													
												} else {
													if ($_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt) {
														
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt;
													} else {
														$selected_option_label = (string) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													}
												}
												
												$selected_option_labour_minutes = (int) $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;
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
											$ndop_caption_opt 			= $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_shopping_cart_caption_opt;
											$ndop_customer_supply 		= $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_customer_supply;
											$ndop_labour_minutes 		= $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;
											$ndop_material_price 		= $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_material_price;
											$ndop_mmultiply_p_quantity 	= $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_multiply_by_parent_quantity;
											$ndop_sub_option_check 		= $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_addon_sub_option_check;
											$ndop_sub_option_groups 	= $_SESSION['all_product_setup'][$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups;
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
											// var_dump(get_field('handyman_product_premium', $hnd_product_post_value['handymn_service_id']));
										?>
										<?php 
											if (get_field('handyman_product_premium', $hnd_product_post_value['handymn_service_id'])) {
											$option_premium = ( ( $hnd_product_post_value['handymn_per_min_cost'] * $selected_option_labour_minutes ) * get_field('handyman_product_premium', $hnd_product_post_value['handymn_service_id']))/100;
											$sub_option_premium = ( ( $hnd_product_post_value['handymn_per_min_cost'] * $selected_suboption_labour_minutes ) * get_field('handyman_product_premium', $hnd_product_post_value['handymn_service_id']))/100;
											
											} else {
												
												$option_premium = 0;
												$sub_option_premium = 0;
											}
											$selected_option_labour_cost = ( ( $hnd_product_post_value['handymn_per_min_cost'] * $selected_option_labour_minutes ) + $option_premium );
											$selected_suboption_labour_cost = ( ( $hnd_product_post_value['handymn_per_min_cost'] * $selected_suboption_labour_minutes ) + $sub_option_premium );
											// var_dump($selected_suboption_labour_cost);
											// var_dump($sub_option_premium);
											// IF Discount is set
											if(get_field('handyman_product_discount', $hnd_product_post_value['handymn_service_id'])) {
												
												$option_discount = ( $selected_option_labour_cost * get_field('handyman_product_discount', $hnd_product_post_value['handymn_service_id']) ) / 100;
												$sub_option_discount = ( $selected_suboption_labour_cost * get_field('handyman_product_discount', $hnd_product_post_value['handymn_service_id']) ) / 100;
											} else {
												$option_discount = 0;
												$sub_option_discount = 0;
											}
											// var_dump($sub_option_discount);
											$selected_option_labour_cost = $selected_option_labour_cost - $option_discount;
											$selected_suboption_labour_cost = $selected_suboption_labour_cost - $sub_option_discount;
											// var_dump($hnd_product_post_value['handymn_per_min_cost'] * $selected_option_labour_minutes);
											// var_dump($selected_option_labour_cost);
											// var_dump($selected_option_labour_cost);
											// var_dump($option_discount);
											// var_dump('----------------');
											// var_dump($selected_option_labour_cost); */
											// var_dump($selected_option_labour_cost);
											// var_dump($selected_suboption_labour_cost);
											// var_dump($handyman_total);
											// var_dump($handyman_total_time);
										?>
										<?php if (isset($selected_option_label)): ?>
											
											<tr class="<?php echo $trClass; ?>">
												<td>
													
													<?php // echo '<pre>'; var_dump(explode('|', $post_values[$elkey])); 
													
													$materialPrc = explode('|', $post_values[$elkey])[2];
													//var_dump($materialPrc);
													echo $selected_option_label; ?> <?php echo ($selected_option_labour_minutes > 0) ? '' : '(Included)'; ?>
														
												</td>
													<?php if ( isset( explode('|', $post_values[$elkey])[3]) && isset($hnd_product_post_value['handymn_showquantity']) && $hnd_product_post_value['handymn_showquantity'] > 1 ): ?>
														<td>$<?php echo round( $selected_option_labour_cost * $hnd_product_post_value['handymn_showquantity'] + $materialPrc * $hnd_product_post_value['handymn_showquantity'], 2); ?> USD</td>
													<?php else: ?>
														<td>$<?php echo round($selected_option_labour_cost + $materialPrc, 2); ?> USD</td>
														
													<?php endif; ?>
													
													<td class="del10"><a href="<?php echo get_permalink() . '?action=remove&product=true&type=option&eid=' . $key . '&aid=' . $elkey; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													</td>
											</tr>
											
										<?php endif; ?>
										
										
										<?php if (isset($selected_suboption_label)): // IF SUBOPTION EXISTS ?>
											<tr>
												<td><?php echo $selected_suboption_label; ?> <?php echo ($selected_suboption_labour_minutes > 0) ? '' : '(Included)'; ?></td>
													<td>$<?php echo round( $selected_suboption_labour_cost + $suboption_material_prc, 2); ?> USD </td>
													<td class="del10"><a href="<?php echo get_permalink() . '?action=remove&product=true&type=suboption&eid=' . $key . '&aid=' . $elkey; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													</td>
											</tr>
											
										<?php endif; ?>
										<?php 
										// TOTAL PRICE
										if ( isset( explode('|', $post_values[$elkey])[3]) && isset($hnd_product_post_value['handymn_showquantity']) && $hnd_product_post_value['handymn_showquantity'] > 1 ): 
											$handyman_total += ( $hnd_product_post_value['handymn_showquantity'] * $selected_option_labour_cost + $materialPrc * $hnd_product_post_value['handymn_showquantity']  ) + $selected_suboption_labour_cost + $suboption_material_prc;
										
											$handyman_total_time += $hnd_product_post_value['handymn_showquantity'] * $selected_option_labour_minutes + $selected_suboption_labour_minutes;
										
										else:
											$handyman_total += ( $selected_option_labour_cost + $materialPrc ) + $selected_suboption_labour_cost + $suboption_material_prc;															
										
											$handyman_total_time += $selected_option_labour_minutes + $selected_suboption_labour_minutes;
										endif;
										// var_dump($selected_option_labour_minutes);
										// var_dump($selected_suboption_labour_minutes);
										// var_dump($handyman_total_time);
										?>
									
									<?php endforeach; ?>													
									
								<?php endif; ?>			
								<?php 
									// var_dump($handyman_total);
									// var_dump($handyman_total_time);
									// var_dump($product_final_price);
									$_SESSION['cart_product_item_total'][ $key ] = round($handyman_total, 2);
									$_SESSION['cart_product_item_total_min'][ $key ] = $handyman_total_time;
									// var_dump( round($handyman_total, 2) ); 
								?>
								<!-- / product option -->
								<tr>
									<td class="total-p"><strong>Total Price</strong>
									</td>
									<td class="total-pi">
										<strong>$<?php echo round($handyman_total, 2); ?> USD</strong>
										<span class="hnd_total_time" style="display: none;"><?php echo timeConvert(trim($handyman_total_time)); // echo round($handyman_total_time/60, 2); ?></span>
									</td>
									<td></td>
								</tr>
								<!-- <tr>
									<td class="total-p"><strong>Total Price</strong></td>
									<td class="total-pi"><strong>$<?php // echo $product_final_price * (int) $hnd_product_post_value['handymn_prod_quantity']; ?></strong>
									</td>
									<td></td>
								</tr> -->
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div><!-- myproductcart -->
	<?php 
		$_SESSION['cart_product_item_total'][ $key ] = round($product_final_price, 2) * (int) $hnd_product_post_value['handymn_prod_quantity']; 
		$_SESSION['asso_labour_min'][ $key ] = get_field('handyman_est_time', $hnd_product_post_value['handymn_asso_service_id']);
		$_SESSION['cart_product_item_total_min'][ $key ] = $_SESSION['asso_labour_min'][ $key ] * (int) $hnd_product_post_value['handymn_prod_quantity']; 
	?>
	<?php $tableitem++; endforeach; ?>
<?php endif; ?>