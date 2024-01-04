<?php // var_dump($handyman_sub_option_group); ?>
<!-- if quantity option is selected. -->
<?php if ($handyman_sub_option_group['acf_fc_layout'] === 'handyman_sub_option_quantity' ) : ?>

		<div class="sub-options nums numbers-row" style="">

			<div class="ptagq">
			<span class="subtext"><?php echo $handyman_sub_option_group['handyman_so_quantity_label']; ?> 

				<?php /* if ($handyman_sub_option_group['handyman_so_quantity_cust_supply']): ?>
					<small class="cust-to-sup">(<b>Customer to Supply:</b> <?php echo $handyman_sub_option_group['handyman_so_quantity_cust_supply']; ?>)</small>
				<?php endif; */ ?>
				
			</span>

					<?php 

						if ( $handyman_sub_option_group['handyman_so_quantity_material'] != 0 && $handyman_sub_option_group['handyman_so_quantity_material'] != "" ) {

						  		$suboptionQtyMaterial = $handyman_sub_option_group['handyman_so_quantity_material'];

						} else {
						   		$suboptionQtyMaterial = 0;
						}

					?>
				

					<!-- new R -->
		             <div class="form-group2 show-quantity">
                              
                              <div class="input-group">

						            <?php if ($handyman_sub_option_group['handyman_so_quantity_shopping_cart_caption']):

						            	if ($handyman_sub_option_group['handyman_so_quantity_cust_supply']) {
						            		$hnd_qtyLabel = $handyman_sub_option_group['handyman_so_quantity_shopping_cart_caption'] . '~' . $handyman_sub_option_group['handyman_so_quantity_cust_supply'];
						            	} else {
						            		$hnd_qtyLabel = $handyman_sub_option_group['handyman_so_quantity_shopping_cart_caption'];
						            	}					            	

						            else: 

						            	if ($handyman_sub_option_group['handyman_so_quantity_cust_supply']) {
						            		$hnd_qtyLabel = $handyman_sub_option_group['handyman_so_quantity_label'] . '~' . $handyman_sub_option_group['handyman_so_quantity_cust_supply'];
						            	} else {
						            		$hnd_qtyLabel = $handyman_sub_option_group['handyman_so_quantity_label'];
						            	}

						            	

						            endif; ?>
						            
						            <input type="number" 
											data-ty="hnd_qty" 
											data-min="<?php echo $handyman_sub_option_group['handyman_so_quantity_labour_minutes']; ?>" data-material="<?php echo $suboptionQtyMaterial; ?>" 
											name="<?php echo 'addon_subservice_quantity_' . $outerKey . '_' . $innerKey; ?>" 
											id="<?php echo $outerKey . '|' . $innerKey . '|' . $subkey . '|' . '0'; ?>" 
											value="1" class="hnd_opt_qty form-control input-number mynu" data-cap="<?php echo $hnd_qtyLabel; ?>" data-premium="<?php echo get_field('handyman_product_premium', $post->ID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $post->ID); ?>">
						            
						            <!-- <div class="input-group-btn">
						                <div id="<?php echo 'addon_subservice_quantity_' . $outerKey . '_' . $innerKey; ?>upp" class="btn btn-default bgd8" onclick="upp('1000', '<?php echo 'addon_subservice_quantity_' . $outerKey . '_' . $innerKey; ?>')"><i class="fa fa-plus"></i></div>
						            </div> -->

                              </div>
                     </div>
                     <!-- new R -->
			</div>



			<!-- <div class="inc button">+</div>
			<div class="dec button">-</div> -->

		</div>

		<div class="clearfix"></div>

<?php endif; ?>
<!-- / if quantity option is selected. -->

<script type="text/javascript">
    function upp(max, name) {
    // document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
    document.querySelector('[name=' + name + ']').value = parseInt(document.querySelector('[name=' + name + ']').value) + 1;
    if (document.querySelector('[name=' + name + ']').value >= parseInt(max)) {
        document.querySelector('[name=' + name + ']').value = max;
    }

    $('[data-ty="hnd_qty"]').trigger('change');
    
}
function dpown(min, name) {
    // document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;
    document.querySelector('[name=' + name + ']').value = parseInt(document.querySelector('[name=' + name + ']').value) - 1;
    if (document.querySelector('[name=' + name + ']').value <= parseInt(min)) {
        document.querySelector('[name=' + name + ']').value = min;
    }
    
    $('[data-ty="hnd_qty"]').trigger('change');
    
}
</script>