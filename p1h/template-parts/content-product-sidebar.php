<?php global $servicePrice, $afterDiscount, $getServiceID, $IDProduct, $handyman_show_addons; 

// var_dump($IDProduct);
// var_dump($post->ID);

// var_dump($handyman_show_addons);

?>

	<!-- Right Price Bar -->
	<style>
		.sub-options, input[type="radio"] { display: none; }
	</style>

	<div class="cart-page2-container clearfix">

		<div class="cart-page2">

			<div class="cart-head22">

			        <?php if (!isset($afterDiscount)): $afterDiscount = 0; endif; ?>
			    
			        <!-- <h3>Selected Items ( <span class="hnd-item-count">1</span> )  -->
			        <h3>Total Price: 
			          <span class="cart-head-span hndy_total_price"><?php echo '$<span>' . round(( $servicePrice - $afterDiscount ) + get_field('handyman_prod_price'), 2) . '</span>'; ?> USD</span>
			        </h3>

			        <h4 class="completion-time">Approximate Completion Time: <span class="hn_service_com_time" data-comt="<?php echo get_field('handyman_est_time', $getServiceID); ?>"><?php echo timeConvert(get_field('handyman_est_time', $getServiceID)); ?></span></h4>
			     
			</div>

			<div class="clearfix"></div>

		</div>

		<div class="price-bg-ser">

			<ul class="ybs-list ybs-list--condensed">

			    <?php /* if (get_field('handyman_est_time', $getServiceID) > 0):  // 24-march-2021 */ ?>

			    <?php if (isset($getServiceID)): ?>

			          <li class="ybs-list-item price-section transition-item-enter transition-item-enter-active">
			            
			            <div class="ybs-title ybs8">

			            <?php $cart_caption_main = get_field('handyman_product_shopping_cart_caption_main');

			            $show_quantityl = get_field('handyman_product_show_quantity');

			            if ($cart_caption_main != '' && $show_quantityl != '' ): ?>

			                  <?php if ( strpos($cart_caption_main, '{qt}') !== false ) : ?>

				                    <h6 class="subheader">
				                      <?php echo str_replace('{qt}', '<span class="quan">1</span>', $cart_caption_main); ?> <!-- (<?php // echo get_field('handyman_type_of_service', $getServiceID); ?>) -->

				                      <?php if (get_field('handyman_prod_services_customer_to_supply', $getServiceID)): ?>

				                                  <small class="subheader-small">
				                                    <b>Customer to Supply: </b><?php echo get_field('handyman_prod_services_customer_to_supply', $getServiceID); ?>
				                                  </small>
				                                  
				                      <?php endif; ?> 
				                      
				                    </h6>

			                  <?php else: ?>

				                    <h6 class="subheader">
				                      <?php echo $cart_caption_main . ' - <span class="quan">1</span> qty'; ?> 
				                      <!-- (<?php // echo get_field('handyman_type_of_service', $getServiceID); ?>) -->
				                      <?php if (get_field('handyman_prod_services_customer_to_supply', $getServiceID)): ?>

				                                  <small class="subheader-small">
				                                    <b>Customer to Supply: </b><?php echo get_field('handyman_prod_services_customer_to_supply', $getServiceID); ?>
				                                  </small>
				                                  
				                      <?php endif; ?> 
				                    </h6>
			                    
			                  <?php endif; ?>

			            <?php else: ?>

			                  <?php if ($show_quantityl != ''): ?>

			                    <h6 class="subheader">
			                      <?php the_title(); ?>
			                      
			                      <?php if (get_field('handyman_product_customer_to_supply')): ?>

			                                  <small class="subheader-small">
			                                    <b>Customer to Supply: </b><?php echo get_field('handyman_product_customer_to_supply'); ?>
			                                  </small>
			                                  
			                      <?php endif; ?> 
			                    </h6>

			                  <?php else: ?>

			                    <?php if ($cart_caption_main != ''): ?>

			                      <h6 class="subheader">
			                        <?php echo $cart_caption_main; ?> (<?php echo get_field('handyman_type_of_service', $getServiceID); ?>)
			                        
			                        <?php if (get_field('handyman_product_customer_to_supply')): ?>

			                                    <small class="subheader-small">
			                                      <b>Customer to Supply: </b><?php echo get_field('handyman_product_customer_to_supply'); ?>
			                                    </small>
			                                    
			                        <?php endif; ?>

			                      </h6>

			                    <?php else: ?>

			                      <h6 class="subheader">
			                      <?php the_title(); ?> (<?php echo get_field('handyman_type_of_service', $getServiceID); ?>)
			                      
			                      <?php if (get_field('handyman_product_customer_to_supply')): ?>

			                                  <small class="subheader-small">
			                                    <b>Customer to Supply: </b><?php echo get_field('handyman_product_customer_to_supply'); ?>
			                                  </small>
			                                  
			                      <?php endif; ?>

			                    </h6>
			                      
			                    <?php endif; ?>

			                    
			                    
			                  <?php endif; ?>                                 
			                
			            <?php endif; ?> 

			              
			            </div>

			            <div class="ybs-value"> $<span class="quanc" data-op="<?php echo round(($servicePrice - $afterDiscount) + get_field('handyman_prod_price'), 2); ?>"><?php echo round(($servicePrice - $afterDiscount) + get_field('handyman_prod_price'), 2); ?></span> USD </div>

			          </li>
			      
			    <?php endif; ?>

			          <li class="opt-cap ybs-list-item price-section transition-item-enter transition-item-enter-active" style="color: #FF5722; font-weight: bold;display: none;">Selected Options</li>

			</ul>
			

		</div>

		<div class="customer-popup-sec">

		    <?php if (get_field('handyman_product_customer_to_supply', $post->ID)): ?>
		        <p>Customer To Supply:<span data-toggle="modal" data-target="#customer-supply">Read More</span></p>
		    <?php else: ?>
		        <p>Technical Materials:<span data-toggle="modal" data-target="#technical-materials">Read More</span></p>                                                
		    <?php endif; ?> 

		</div>

	</div><!-- End Right Price Bar -->





	<!--  -->

	<div class="grid-info-box" style="margin-bottom: 0px;padding-bottom: 0px;">

		<textarea id="hnd_comm_text" name="handymn_service_comments" placeholder="Add Comments (Optional)" rows="3" style="padding: 10px 12px !important; width: 100%; min-height: 80px !important;"></textarea>

	</div>



	<div class="clearfix"></div>

	<?php if (!get_field('handyman_add_on_services', $IDProduct)): ?>

		<div class="grid-info-box account-btns">
			<div class="">
				<span class="add-to-cart"><i aria-hidden="true" class="fa fa-cart-plus"></i> Add To Cart</span>
			</div>
		</div>
		
	<?php endif; ?>

	<div class="clearfix"></div>


	<div class="grid-info-box account-btns">

		<!-- <div class="questions-popup">

                    <span class="add-to-cart"><i aria-hidden="true" class="fa fa-cart-plus"></i> Add To Cart</span>

                  </div> -->

		<span class="add-comment" style="" title=""><i aria-hidden="true" class="fa fa-comments-o"></i> Add Comment</span>

		<div class="row final_statement_btn no-margin" style="display: none">

			<button id="submit_for_scheduling_imi" style="margin-right: 15px;">Add to Cart</button>

		</div>

	</div>

	<div class="clearfix"></div>

	

	<div class="final_statement_mobile no-margin" style="display: none">

		<div class="">

			<h2>We can match you with pros for this job</h2>

			<h5>Let us introduce you to some great pros we know</h5>

			<div class="row fixtext mtt70">

				<div class="col-md-3">

					<img src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/fix-icon101.png"><span>Fixed<br>

					Hourly Rates</span>

				</div>

				<div class="col-md-3">

					<img src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/fix-icon102.png"><span>Live Online<br>

					Scheduling</span>

				</div>

				<div class="col-md-5">

					<img src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/fix-icon103.png"><span>100%<br>

					Satisfaction Guarantee</span>

				</div>

			</div>

		</div>

	</div>