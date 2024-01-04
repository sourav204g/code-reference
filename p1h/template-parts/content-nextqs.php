<style> 

		input[type="radio"] { display: none; } 

		.sub-options {
		    padding-left: 50px;
		}

		.sub-question { display: block;  }
		.sub-question {
		    display: block;
		    text-align: left;
		    font-size: 22px;
		    color: #f2ae00;
		    margin-bottom: 5px;
		}

		.ques.handyman_sub_option_quantity {
		    display: flex;
		}

		.nums .button {
			transform: scale(0.9);
			position: relative;
   			top: -1px;
		}

		.nums .button:last-child { margin-left: 0px; }

		/*[type="radio"] { display: initial !important;  }*/

		label {
		    padding-left: 25px !important;
		}

		/*.sub-options.nums.numbers-row {display: flex;margin: 0px;margin-left: 10px;}*/

		.ptag { font-size: 18px; line-height: 22px; color: #fff; text-align: left; }

		/*.has_sub_option .sub-options { display: none !important; }*/

		.sub-options { display: none; }


		/*.account-popup-area { display: block !important; }*/

		/* .handyman-sub-group .ybs-title.ybs8 .subheader {
		    font-size: 12px !important;
		}

		.handyman-sub-group .ybs-value {
		        font-size: 14px !important;
			    text-align: right !important;
			    padding-top: 8px;
			    padding-left: 5px;
		} */

	</style>


	<div class="col-md-12 mtt70">

		<!-- <h2><?php // the_title(); ?></h2>
		<hr style="border: 1px solid #f2ae00;"> -->

		<h4 style="color: #fff; font-size: 24px;">Service info</h4>

		<div class="progress">
        	<div id="progress-bar"></div>
    	</div>

	</div>

	<div class="col-md-12">

		<form action="" id="service_questionnaire_form" method="post">


			
			<input type="hidden" name="handymn_service_id" value="<?php echo $post->ID; ?>">
			<input type="hidden" name="handymn_service_name" value="<?php the_title(); ?>">
			<input type="hidden" name="handymn_showquantity" value="1" />
			<input type="hidden" name="handymn_service_comments" id="hnd_comm_hidden">

			<?php if (get_the_post_thumbnail_url($post->ID)): ?>
				<input type="hidden" name="handymn_service_featured_img" value="<?php echo get_the_post_thumbnail_url($post->ID); ?>">
			<?php else: ?>
				<input type="hidden" name="handymn_service_featured_img" value="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png">
			<?php endif; ?>

			<?php 

				$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
				$per_min_cost = $fetch_hour_price/60;

				$servicePrice = $per_min_cost * get_field('handyman_est_time', $post->ID);

				if (get_field('handyman_product_premium', $post->ID)) {
					
					$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $post->ID))/100;

				} else {
					
					$handyman_premium = 0;
				}

				$servicePrice = $servicePrice + $handyman_premium;

				// If discount is set
				if(get_field('handyman_product_discount', $post->ID)) {

					$discount = get_field('handyman_product_discount', $post->ID);

					$afterDiscount = ( $servicePrice * $discount ) / 100;

				} else {

					$afterDiscount = 0;
				}

				
				?>

				<?php wp_nonce_field('waiting_for_avengers_4_trailer', 'handyman_pro_nonce'); ?>

				<!-- // REF - http://php.net/manual/en/json.constants.php -->
				<input type="hidden" name="handymn_sl_addon_services" value='<?php echo json_encode(get_field('handyman_add_on_services'), JSON_HEX_APOS); ?>'>

				<input type="hidden" name="handymn_service_time" value="<?php echo get_field('handyman_est_time', $post->ID); ?>">
				<input type="hidden" name="handymn_per_min_cost" value="<?php echo $per_min_cost; ?>">
				<input type="hidden" name="handymn_service_price" value="<?php echo $servicePrice - $afterDiscount; ?>">
				<input type="hidden" name="handymn_premium" value="<?php echo $handyman_premium; ?>">
				<input type="hidden" name="handymn_after_discount" value="<?php echo $afterDiscount; ?>">
				<!-- <input type="hidden" name="handymn_service_time" value="<?php // echo get_field('handyman_est_time', $post->ID); ?>"> -->
				<input type="hidden" name="handymn_service_description" value="<?php echo strip_tags(get_field('handyman_prod_services_description', $post->ID)); ?>">
				
				<input type="hidden" name="handymn_service_customer_to_supply" value="<?php echo get_field('handyman_prod_services_customer_to_supply', $post->ID); ?>">

				<input type="hidden" name="handymn_service_opt" value="">
				<input type="hidden" name="handymn_service_sub" value="">
				<input type="hidden" name="handymn_service_opt_val" value="">
				<input type="hidden" name="handymn_service_sub_val" value="">

			
			<div class="hnd-opttab-container">
				<?php foreach (get_field('handyman_add_on_services') as $outerKey => $handyman_add_on_services) : 
					  
					  $handyman_addon_options = $handyman_add_on_services['handyman_addon_options']; ?>

					  <div class="tab <?php echo 'addon_service_' . $outerKey; ?><?php echo $outerKey === 0 ? ' active' : ''; ?>" style="<?php $outerKey === 0 ? 'display: block' : ''; ?>">
							<!-- <h3>What Is The Walls Height?</h3> -->
							<div class="ques-group-container">

								<div class="ques-group"><h3><?php echo $handyman_add_on_services['handyman_addon_question']; ?></h3>

								<?php foreach ( $handyman_addon_options as $innerKey => $handyman_addon_options_item ): ?>

									<?php // var_dump($handyman_addon_options_item); ?>

									<div class="ques <?php echo ($handyman_addon_options_item['handyman_sub_option_groups'][0]['acf_fc_layout']) ? 'has_sub_option ' . $handyman_addon_options_item['handyman_sub_option_groups'][0]['acf_fc_layout'] : ''; ?>">

										<div class="ptag" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>">

											<input id="<?php echo $outerKey . '|' . $innerKey; ?>" 
												name="<?php echo 'addon_service_' . $outerKey; ?>"
												type="radio" 
												data-key="<?php echo $outerKey; ?>" 
												value="<?php echo esc_attr($handyman_addon_options_item['handyman_option_label']) . '|' . $handyman_addon_options_item['labour_minutes']; ?>" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>">

											<label for="<?php echo $outerKey . '|' . $innerKey; ?>">
												<?php 

													$optionsacx = '';
													$optionsacx .= $handyman_addon_options_item['handyman_option_label'];
													

													if ( $handyman_addon_options_item['labour_minutes'] != '0' ) {
														$optionsacx .= ' - Add $ <em data-prc="' . $per_min_cost * $handyman_addon_options_item['labour_minutes'] . '">' .  round($per_min_cost * $handyman_addon_options_item['labour_minutes'], 2) . '</em>';
													} else {

														$optionsacx .= '<em data-prc="' . $per_min_cost * $handyman_addon_options_item['labour_minutes'] . '"></em>';

													}

													echo $optionsacx;

												?>
											</label>


											<?php if ($handyman_addon_options_item['handyman_addon_sub_option_check'] && $handyman_addon_options_item['handyman_sub_option_groups']): // checking if sub-option option is checked ?>


												<?php foreach ($handyman_addon_options_item['handyman_sub_option_groups'] as $subkey => $handyman_sub_option_group ): // Sub-Options ?>

													<?php include('content-quantity.php'); ?>
													<?php include('content-yesno.php'); ?>
													<?php include('content-list.php'); ?>
					
												<?php endforeach; ?>

												
											<?php endif; ?>


										</div>

									</div>
									
								<?php endforeach; ?>

								</div> <!-- ques ques-group --> 

							</div>
					   </div>

				<?php endforeach; ?>
			</div>


			<div style="overflow:auto;">
				<div id="backnext">
					<button id="prevBtn" onclick="nextPrev(-1)" style="float:left; display: none; margin-right:10px;" type="button">Back</button> <button id="nextBtn" onclick="nextPrev(1)" style="float:left;" type="button">Next</button>
				</div>
			</div>

			<div style="clear: both;"></div>
			<div style="text-align:center; padding-top:30px; padding-bottom:30px; margin-top:20px; width: 120px; margin-bottom: 20px; clear: both; margin: 0 auto;" id="stepss">

				<?php for ($i=0; $i < count(get_field('handyman_add_on_services')) ; $i++) : ?>
					<span class="step"></span>
				<?php endfor; ?>

			</div>

		<!-- </form> -->

	</div>


	<div class="row final_statement no-margin mtt30" style="display: none">

		<div class="col-md-8">
			<h2>We can match you with pros for this job</h2>
			<h5>Let us introduce you to some great pros we know</h5>
			<div class="row fixtext mtt70">
				<div class="col-md-4">
					<img src="<?php bloginfo('template_directory'); ?>/assets/images/fix-icon01.png"><span>Fixed<br>
					hourly rates</span>
				</div>
				<div class="col-md-4">
					<img src="<?php bloginfo('template_directory'); ?>/assets/images/fix-icon02.png"><span>Flexible<br>
					scheduling</span>
				</div>
				<div class="col-md-4">
					<img src="<?php bloginfo('template_directory'); ?>/assets/images/fix-icon03.png"><span>100%<br>
					Satisfaction Guarantee</span>
				</div>
			</div>
			<div class="mtt50">
				<button style="margin-right: 15px;" type="submit" name="submit_for_scheduling" id="submit_for_scheduling">Add to Cart</button>
				<!-- <button>Submit for Scheduling</button> -->
				<!-- <button id="prevBtn" type="button">Shop for More Items</button> -->
			</div>
		</div>

		</form>

		<div class="col-md-4">
			<div style="position: relative;">
				<div class="ybs">
					<header class="ybs-header">
						<h4><span class="hn_service_price">_ USD</span><br>
						Total Estimated Cost</h4>
					</header>
					<header class="ybs-header ybs-title1" style="background: #fff;">
						<h4>Service Estimate Details <i aria-hidden="true" class="fa fa-angle-down"></i></h4>
					</header>
					<div class="ybs-content">

						<section class="ybs-section">
							<div class="ybs-row ybs-row--grid">
								<div class="ybs-title">
									<h5><?php the_title(); ?>: </h5>
								</div>
								<div class="ybs-value1">
									<div class="ybh18">
										<?php if ($afterDiscount !== 0): ?>
												<a href="#" class="bestd"><del><?php echo '$' . round($servicePrice, 2) . ' USD'; ?></del><span class="after-discount"><?php echo ' $' . round($servicePrice - $afterDiscount, 2) . ' USD'; ?></span></a>
										<?php else: ?>
												<a href="#" class="bestd"><span><?php echo '$' . round($servicePrice, 2) . ' USD'; ?></span></a>
										<?php endif; ?>
										
									</div>
								</div>
							</div>
						</section>

						<section class="ybs-section">
							<div class="ybs-row ybs-row--grid">
								<div class="ybs-title">
									<h5>Completion Time:</h5>
								</div>
								<div class="ybs-value1">
									<div class="ybh18">
										<a href="#" class="hn_service_com_time">_ hours</a>
									</div>
								</div>
							</div>
						</section>
						<section class="ybs-section">
							<div class="ybs-row ybs-details">
								<h5>Selected Options</h5>

								<ul class="ybs-list ybs-list--condensed">									

										<!-- <li class="ybs-list-item">
											<div class="ybs-title ybs8">
												<h6 class="subheader">Integral One Piece Vanity</h6>
												<ul class="handyman-sub-group">

													<li class="ybs-list-item">
														<div class="ybs-title ybs8">
															<h6 class="subheader">Integral One Piece Vanity</h6>
														</div>
														<div class="ybs-value">
															$15 USD
														</div>
													</li>
														
												</ul>
											</div>
											<div class="ybs-value">
												$15 USD
											</div>
										</li> -->

								</ul>


							</div>
						</section>

						<!-- <section class="ybs-section">
							<div class="ybs-row ybs-row--grid">
								<div class="ybs-title">
									<h5>Subtotal <small>(2.5 hours)</small></h5>
								</div>
								<div class="ybs-value">
									$132.50 USD
								</div>
							</div>
						</section> -->

					</div>
					<footer class="ybs-footer">
						<div class="ybs-row ybs-row--highlight ybs-ow--grid">
							<ul class="ybs-list" id="ybs-items">
								<li class="ybs-list-item">
									<div class="ybs-title">
										<h4>Total</h4>
									</div>
									<div class="ybs-value1">
										<h4 class="hndy_total_price">_ USD</h4>
									</div>
								</li>
								<!-- <li class="ybs-list-item">
									<div class="ybs-title">
										<h6 class="subheader">VAT included <small>(5.0%)</small></h6>
									</div>
									<div class="ybs-value no-ptop">
										<h6 class="subheader">$8.10 USD</h6>
									</div>
								</li> -->
							</ul>
						</div>
					</footer>
					<div class="ybs-overlay">
						<div class="ybs-loader sk-three-bounce">
							<div class="sk-child sk-bounce1"></div>
							<div class="sk-child sk-bounce2"></div>
							<div class="sk-child sk-bounce3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>