<!-- if list option is selected. -->
<?php if ($handyman_sub_option_group['acf_fc_layout'] === 'handyman_sub_option_list' ) : ?>
	
		<div class="sub-options">
			
			<span class="sub-question"><?php echo $handyman_sub_option_group['handyman_so_list_question']; ?></span> 


			<?php foreach ( $handyman_sub_option_group['handyman_so_list_options'] as $subsubkey => $handyman_so_list_option ): ?>


				<?php                          

	                    if ( $handyman_so_list_option['handyman_so_list_options_material'] != 0 && $handyman_so_list_option['handyman_so_list_options_material'] != "" ) {
	                      $suboptionlistMaterial = $handyman_so_list_option['handyman_so_list_options_material'];
	                    } else {
	                       $suboptionlistMaterial = 0;
	                    }


	            ?>

		<?php // echo '<pre>'; var_dump($handyman_so_list_option['handyman_so_list_options_material']); ?>

				<div class="ptagq">

					<span class="subtext" style="display: none;"><?php echo $handyman_sub_option_group['handyman_so_list_question']; ?></span>

					<?php if ($handyman_so_list_option['handyman_subsub_list_shopping_cart_caption']):

						$hnd_listLabel = $handyman_so_list_option['handyman_subsub_list_shopping_cart_caption'];
		           
		            else: 

		            	$hnd_listLabel = $handyman_so_list_option['handyman_so_list_options_label'];

		            endif; ?>

		            <?php if ( $handyman_so_list_option['handyman_subsub_list_shopping_cart_caption'] ): ?>

			            <?php if ($handyman_so_list_option['handyman_subsub_list_customer_to_supply']): ?>

			            	 <input id="<?php echo $outerKey . '|' . $innerKey . '|' . $subkey . '|' . $subsubkey; ?>" 
						data-ty="hnd_list" 
						name="<?php echo 'addon_subservice_list_' . $outerKey . '_' . $innerKey; ?>" 
						type="radio" 
						value="<?php echo esc_attr($handyman_so_list_option['handyman_subsub_list_shopping_cart_caption']) . '~' . $handyman_so_list_option['handyman_subsub_list_customer_to_supply'] . '|' . $handyman_so_list_option['handyman_so_list_options_labour_minutes'] . '|' . $suboptionlistMaterial; ?>" data-premium="<?php echo get_field('handyman_product_premium', $getServiceID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $getServiceID); ?>">

						<?php else: ?>

							 <input id="<?php echo $outerKey . '|' . $innerKey . '|' . $subkey . '|' . $subsubkey; ?>" 
						data-ty="hnd_list" 
						name="<?php echo 'addon_subservice_list_' . $outerKey . '_' . $innerKey; ?>" 
						type="radio" 
						value="<?php echo esc_attr($handyman_so_list_option['handyman_subsub_list_shopping_cart_caption']) . '|' . $handyman_so_list_option['handyman_so_list_options_labour_minutes'] . '|' . $suboptionlistMaterial; ?>" data-premium="<?php echo get_field('handyman_product_premium', $getServiceID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $getServiceID); ?>">
			            	
			            <?php endif; ?>

                     

                    <?php else: ?>

                     <?php if ($handyman_so_list_option['handyman_subsub_list_customer_to_supply']): ?>

                     	 <input id="<?php echo $outerKey . '|' . $innerKey . '|' . $subkey . '|' . $subsubkey; ?>" 
						data-ty="hnd_list" 
						name="<?php echo 'addon_subservice_list_' . $outerKey . '_' . $innerKey; ?>" 
						type="radio" 
						value="<?php echo esc_attr($handyman_so_list_option['handyman_so_list_options_label']) . '~' . $handyman_so_list_option['handyman_subsub_list_customer_to_supply'] . '|' . $handyman_so_list_option['handyman_so_list_options_labour_minutes'] . '|' . $suboptionlistMaterial; ?>" data-premium="<?php echo get_field('handyman_product_premium', $getServiceID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $getServiceID); ?>">

                     <?php else: ?>

                     	 <input id="<?php echo $outerKey . '|' . $innerKey . '|' . $subkey . '|' . $subsubkey; ?>" 
						data-ty="hnd_list" 
						name="<?php echo 'addon_subservice_list_' . $outerKey . '_' . $innerKey; ?>" 
						type="radio" 
						value="<?php echo esc_attr($handyman_so_list_option['handyman_so_list_options_label']) . '|' . $handyman_so_list_option['handyman_so_list_options_labour_minutes'] . '|' . $suboptionlistMaterial; ?>" data-premium="<?php echo get_field('handyman_product_premium', $getServiceID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $getServiceID); ?>">

                     <?php endif; ?>                     
                      
                    <?php endif; ?>					

					<label for="<?php echo $outerKey . '|' . $innerKey . '|' . $subkey . '|' . $subsubkey; ?>">
						
						<?php 

						$suboptionlistL = '';
						$suboptionlistL .= $handyman_so_list_option['handyman_so_list_options_label'];

						
						$suboptionlistCost = $per_min_cost * $handyman_so_list_option['handyman_so_list_options_labour_minutes'];

						// Premium
						if (get_field('handyman_product_premium', $getServiceID)) {
						
						  $ListPremium = ( $suboptionlistCost * get_field('handyman_product_premium', $getServiceID) )/100;

						} else {
						  
						  $ListPremium = 0;
						}

						$suboptionlistCost = $suboptionlistCost + $ListPremium;


						// Discount
						if (get_field('handyman_product_discount', $getServiceID)) {
						
						  $ListDiscount = ($suboptionlistCost * get_field('handyman_product_discount', $getServiceID))/100;

						} else {
						  
						  $ListDiscount = 0;

						}


						$suboptionlistCost = $suboptionlistCost - $ListDiscount;

						$suboptionlistCost = $suboptionlistCost + $suboptionlistMaterial;
						
						?>

						<?php echo $suboptionlistL . ' - $' .round($suboptionlistCost, 2); ?>

					</label>

				</div>
				
			<?php endforeach; ?>


		</div>

<?php endif; ?>
<!-- / if list option is selected. -->