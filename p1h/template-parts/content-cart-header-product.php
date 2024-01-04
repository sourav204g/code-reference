<?php global $per_min_cost; if (isset($_SESSION['hnd_product_post_values'])): ?>



	<strong>Products:</strong>
	
	<?php foreach ( $_SESSION['hnd_product_post_values'] as $key => $hnd_product_post_value ): ?>

		<?php // var_dump($hnd_product_post_value['handymn_asso_service_id']); ?>

		<?php
				
								$servicePrice = $per_min_cost * get_field('handyman_est_time', $hnd_product_post_value['handymn_asso_service_id']);

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



	 ?>

		<li>
			<div class="job-listingtop">
				<div class="job-title-sec">
					<div class="c-logo"><img alt="" src="<?php echo get_field('handyman_product_images', $hnd_product_post_value['handymn_product_id'] )[0]['handyman_product_image']['url']; ?>"></div>
					<div>
						<h3><a href="<?php echo get_permalink( $hnd_product_post_value['handymn_product_id'] ); ?>" title=""><?php echo get_post($hnd_product_post_value['handymn_product_id'])->post_title; ?></a></h3>
						
						<!-- <span><?php // echo get_field('handyman_type_of_service', $hnd_product_post_value['handymn_asso_service_id']); ?>: $<?php // echo $product_final_price * (int) $hnd_product_post_value['handymn_prod_quantity']; ?></span> -->

						<span><?php echo get_field('handyman_type_of_service', $hnd_product_post_value['handymn_asso_service_id']); ?>: $<?php echo $_SESSION['cart_product_item_total'][$key]; ?></span>


					</div>
				</div>
			</div><!-- Job -->
		</li>
		
	<?php endforeach; ?>

<?php endif; ?>