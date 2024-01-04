<!-- if yes/no option is selected. -->
<?php // var_dump($handyman_sub_option_group); ?>
<?php if ($handyman_sub_option_group['acf_fc_layout'] === 'handyman_sub_option_yesno' ) : ?>
	
		<div class="sub-options">
			<div class="ptagq">

				<span class="subtext"><?php echo $handyman_sub_option_group['handyman_so_yesno_label']; ?></span> 

				<?php /* if ($handyman_sub_option_group['handyman_yesno_cust_supply']): ?>
					<small class="cust-to-sup">(<b>Customer to Supply:</b> <?php echo $handyman_sub_option_group['handyman_yesno_cust_supply']; ?>)</small>
				<?php endif; */ ?>


				<?php if ($handyman_sub_option_group['handyman_yesno_shopping_cart_caption']):

							if ($handyman_sub_option_group['handyman_yesno_cust_supply']) {
								
								$hnd_yesnoLabel_yes = $handyman_sub_option_group['handyman_yesno_shopping_cart_caption'] . '~' . $handyman_sub_option_group['handyman_yesno_cust_supply'];
							
							} else {
								$hnd_yesnoLabel_yes = $handyman_sub_option_group['handyman_yesno_shopping_cart_caption'];
							}							
			           
		            else: 

		            	if ($handyman_sub_option_group['handyman_yesno_cust_supply']) {

		            	$hnd_yesnoLabel_yes = $handyman_sub_option_group['handyman_so_yesno_label'] . '~' . $handyman_sub_option_group['handyman_yesno_cust_supply']; 

		            	} else {
		            		$hnd_yesnoLabel_yes = $handyman_sub_option_group['handyman_so_yesno_label']; 
		            	}

		            endif; ?>

					<?php if ($handyman_sub_option_group['handyman_yesno_shopping_cart_caption']):

						$hnd_yesnoLabel_no = $handyman_sub_option_group['handyman_yesno_shopping_cart_caption'];
		           
		            else: 

		            	$hnd_yesnoLabel_no = $handyman_sub_option_group['handyman_so_yesno_label'];

		            endif; ?>


		            <?php       

		            	// var_dump($handyman_sub_option_group);                   

	                    if ( $handyman_sub_option_group['handyman_so_yesno_material'] != 0 && $handyman_sub_option_group['handyman_so_yesno_material'] != "" ) {
	                      $suboptionyesnoMaterial = $handyman_sub_option_group['handyman_so_yesno_material'];
	                    } else {
	                       $suboptionyesnoMaterial = 0;
	                    }

	            ?>

				<label for="<?php echo $outerKey . '|' . $innerKey . '|' . $subkey . '|' . '0'; ?>">
					
					<input id="<?php echo $outerKey . '|' . $innerKey . '|' . $subkey . '|' . '0'; ?>" 
						   data-ty="hnd_yesno" 
						   data-yes="yes" 
						   name="<?php echo 'addon_subservice_yes_no_' . $outerKey . '_' . $innerKey; ?>" 
					       type="radio" 
					       value="<?php echo $handyman_sub_option_group['handyman_so_yesno_labour_minutes'] . '|' . $suboptionyesnoMaterial; ?>" data-cap="<?php echo $hnd_yesnoLabel_yes; ?>" data-premium="<?php echo get_field('handyman_product_premium', $post->ID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $post->ID); ?>"> Yes
				</label>

			 	<label for="<?php echo $outerKey . '|' . $innerKey . '|' . $subkey . '|' . '1'; ?>">
			 		
			 		<input id="<?php echo $outerKey . '|' . $innerKey . '|' . $subkey . '|' . '1'; ?>" 
			 				data-ty="hnd_yesno" 
			 				data-yes="no" 
			 				name="<?php echo 'addon_subservice_yes_no_' . $outerKey . '_' . $innerKey; ?>" type="radio" 
			 				value="no" data-cap="<?php echo $hnd_yesnoLabel_no; ?>"> No
			 	</label>

			</div>
			 
		</div>

<?php endif; ?>
<!-- / if yes/no option is selected. -->