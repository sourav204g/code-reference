<?php if ( isset($bookingDetails['selected_product']) && $bookingDetails['selected_product'] !== '' ) : // PRODUCT ?>

			<?php 

				$product_prices 	= unserialize(base64_decode($bookingDetails['product_prices']));
				$product_prices 	= array_values($product_prices);
				$asso_labour_mins 	= array_values(unserialize(base64_decode($bookingDetails['asso_labour_min'])));
				$pro_premium   		= (int) $bookingDetails['handyman_premium'];

				// var_dump($pro_premium);

			?>
			
			<?php foreach ( array_values($selected_products) as $key => $selected_product ): ?>


				<?php 

					// var_dump($product_prices);
					// exit;

					$product_name 				= get_post( $selected_product['handymn_product_id'] )->post_title;
					$product_price 				= (float) get_field('handyman_prod_price', $selected_product['handymn_product_id']);
					$product_quantity 			= (int) $selected_product['handymn_prod_quantity'];

					$asso_service_name 			= get_post( $selected_product['handymn_asso_service_id'] )->post_title;
					$asso_service_type 			= get_field('handyman_type_of_service', $selected_product['handymn_asso_service_id']);

					$handymn_service_price 		= $hnd_post_values[$key]['handymn_service_price'];

					$pro_premium_cost	        =  ( ($asso_labour_mins[$key] * $per_min_cost) * $pro_premium ) / 100;
					$pro_premium_cost           = $pro_premium_cost * $product_quantity; // premium cost with quantity

					// var_dump($pro_premium_cost);

				?>


				<div class="booking-card">
					<label class="booking-card-label product-lb">Product</label>
					<label class="completion-time"><?php echo timeConvert( $asso_labour_mins[$key] * $product_quantity); // echo ($asso_labour_mins[$key]/60) * $product_quantity; ?></label>
					<table>
						<tbody>
							<tr>
								<td>Product:</td>
								<td><a href="<?php echo get_permalink( $selected_product['handymn_product_id'] ); ?>/?service-id=<?php echo $selected_product['handymn_asso_service_id']; ?>" style="color:white;" target="_blank"><?php echo $product_name; ?> ( <?php echo $product_quantity . 'x'; ?> )</a></td>
								<td>$<?php echo $product_prices[$key]; ?></td>
							</tr>
							<tr>
								<td>Includes:</td>
								<td colspan="2"><em style="opacity: 0.4;">(<?php echo $asso_service_name . ' - ' . $asso_service_type; ?>)</em></td>
							</tr>
							<tr>
								<td colspan="2"><?php echo $pro_premium; ?>% Higher Labour Charges:</td>
								<td>$<?php echo round($pro_premium_cost, 2); ?></td>
							</tr>
							<tr>
								<td colspan="2">Total Amount:</td>
								<td>$<?php echo round($pro_premium_cost + $product_prices[$key], 2); ?></td>
							</tr>
						</tbody>
					</table>
				</div>

			<?php endforeach; ?>

<?php endif; ?>