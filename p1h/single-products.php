<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package handyman_pro
 */

if( isset($_GET['service-id']) ) {
	$getServiceID = (int) $_GET['service-id'];
	if (!get_field('handyman_post_type', $getServiceID)) {
		wp_redirect( home_url('/') , 302 );
		exit();
	}
} else {
	wp_redirect( home_url('/') , 302 );
	exit();
}

function handyman_add_to_cart() {
		if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'waiting_for_avengers_4_trailer' ) ) {
				die( 'Failed security check' );
		} else {
				if( !session_id() ) {
							session_start();
							// session_destroy(); // DELETE THIS LINE // THIS LINE IS ONLY FOR TESTING
							$_SESSION['hnd_product_post_values'][] = (array) $_POST;
							$_SESSION['hnd_product_options'][] = array(); // empty array
							$_SESSION['hnd_product_suboptions'][] = array(); // empty array
							$_SESSION['all_product_setup'][] = array(); // empty array
							$_SESSION['hnd_product_suboptions_values'][] = array(); // empty array
							
							wp_redirect( home_url('/cart/') , 302 );
							exit();
				}
				
		}
}

if( $_POST && isset($_POST['handymn_asso_service_id']) && isset($_POST['handymn_product_no_option']) ) {
		handyman_add_to_cart();
}

$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;

// echo '<pre>';
// var_dump(get_field('handyman_product_link_to_services'));
// exit;

$handyman_show_addons = false;
$handyman_other_option_ID = false;

if (get_field('handyman_product_link_to_services')) {
	foreach (get_field('handyman_product_link_to_services') as $key => $linkedservices) {
		if ($linkedservices['handyman_product_link_to_service'] === $_GET['service-id']) {
			
			if ($linkedservices['handyman_show_addons'] === 'yes') {
				$handyman_show_addons = true;
			} else {
				$handyman_show_addons = false;
			}

			 if (!empty($linkedservices['hnd_use_product_options_of'])) {
				$handyman_other_option_ID = (int) $linkedservices['hnd_use_product_options_of'];
			} else {
				$handyman_other_option_ID = false;
			} 
		}
	}
}

// var_dump($handyman_show_addons);
// exit;

get_header(); ?>


	<style>

		.add-to-cart {
			float: left; font-size: 15px; background: #f2ae00; border: 1px solid #f2ae00; color: #ffffff !important; padding: 8px 15px; line-height: 20px; margin: 10px 0; margin: 6px 0; margin-left: 0; margin-top: 20px;width: auto !important;cursor: pointer;
		}
		.add-comment {
			margin-left: 15px; background: #323232; border: 1px solid #323232; padding: 8px 15px; line-height: 20px; margin-top: 20px; color: #ffffff; float: left; font-size: 15px;display: none;
		}
		.error {
		    color: red;
		    text-align: left;
		    margin-bottom: 12px;
		}
		h4.hnd-product-price > del > span {
		    color: #848484 !important;
		    font-weight: normal;
		}

		.specifications-content h4 { margin-top: 15px; }

		.specifications-content ul { margin-left: 20px; }

		.specifications-content ul li {
		    list-style: disc;
		    margin-bottom: 5px;
		}

		[name="hnd_showquantity"] {
		    height: 47px;
		}

		button#down { border-radius: 0; }

		h5.red5.desktop { display: none; }

		@media screen and (min-width: 768px) {

			h5.red5.mobile { display: none; }
			h5.red5.desktop { display: block; }
			
		}

       @media (min-width:320px) and (max-width:479px) {
		.account-btns .add-to-cart{
			width: 100% !important;
			background: #43b6d5 !important;
			font-size: 18px;
			text-align: center;
			border: 1px solid #43b6d5;
            color: #ffffff !important;
            padding: 12px 15px;
            line-height: 25px;
		}

		.social-share-sec { margin-bottom: 1.5rem; }

	   }

	</style>

	<section class="overlape">
		<div class="block no-padding">
			<div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php bloginfo('template_directory'); ?>/assets/images/resource/mslider222.jpg) repeat scroll 50% 422.28px transparent;"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3><?php the_title(); ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="block less-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-8 column">
						<div class="job-single-sec">
							<div class="job-single-head">
								<div class="row">
									<div class="col-md-6 emply-list-info dk-lg" style="margin-top: 1px;">
										<h2 class="ft26"><?php the_title(); ?></h2>
										<h4 class="hnd-product-price">
											<?php echo ucfirst(get_field('handyman_type_of_service', $getServiceID)); ?>: <del><?php 
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
													echo (float) get_field('handyman_prod_price') + round($servicePrice, 2); echo '</span>'; ?></del>
													<span>$<?php echo '<span>'; ?><?php echo (float) get_field('handyman_prod_price') + round($servicePrice - $afterDiscount, 2); ?><?php echo '</span>'; ?></span> 
													 
										</h4>

										<h5 class="red5 mobile">Includes Product & Installation</h5>

										<div class="social-share-sec">
					                          <h6>Share This Deal : </h6>
					                        <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>?service-id=<?php echo $getServiceID; ?>" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/facebook.png" class="img-fluid" alt="facebook"></a>
					                        <a href="http://twitter.com/share?url=<?php echo get_permalink(); ?>?service-id=<?php echo $getServiceID; ?>&text=<?php echo urlencode(get_the_title()); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/twitter.png" class="img-fluid" alt="twitter" target="_blank"></a>
					                        <a href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo get_the_title() . ' '; ?><?php echo get_permalink(); ?>?service-id=<?php echo $getServiceID; ?>" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/mail.png" class="img-fluid" alt="mail"></a>

					                    </div>
									</div>
									
									<div class="col-md-6">
										<div class="ma5slider anim-horizontal horizontal-dots horizontal-navs center-dots inside-dots autoplay">
											
											<div class="slides">
												<?php
												// check if the repeater field has rows of data
												if( have_rows('handyman_product_images') ):
													$count = 1;
												 	// loop through the rows of data
												    while ( have_rows('handyman_product_images') ) : the_row(); ?>
												    	<a href="#slide-<?php echo $count; ?>"><img alt="<?php echo get_sub_field('handyman_product_image')['alt']; ?>" src="<?php echo get_sub_field('handyman_product_image')['url']; ?>"></a> 
												<?php 		
													$count++;
												    endwhile;
												endif;
												?>
									
												
											</div>
											<?php if (get_field('handyman_product_discount', $getServiceID)): ?>
												<div class="off50">
													<?php echo get_field('handyman_product_discount', $getServiceID); ?>% Off
												</div>
												
											<?php endif; ?>

											<!-- <div align="center">
												<a class="btn spec specificationsm" data-target="#specifications" data-toggle="modal">Specifications</a>
											</div> -->

											<!-- <div class="dk-lg" style="margin-top: 10px;" align="center">
												<a class="btn spec specificationsm" data-target="#specifications" data-toggle="modal">Specifications</a>
												<div class="specifications-content" style="display: none;">
													<?php // echo get_field('handyman_product_specifications'); ?>
												</div>
											</div> -->
											
											<div align="center">
												<a class="btn spec specificationsm" data-target="#specifications" data-toggle="modal">Specifications</a>
												<div class="specifications-content" style="display: none;">
													<?php echo get_field('handyman_product_specifications', $getServiceID->ID ); ?>
												</div>
											</div>
											
										    <!--
											<div class="specifications-content hidden-xs">
												<h4>Product Description</h4>
												<?php //echo get_field('handyman_product_specifications'); ?>
											</div>
											-->
										
											
										</div>
									</div>
									<div class="col-md-6 emply-list-info" style="margin-top: 1px;">
										<h2 class="ft26 hidden-xs"><?php the_title(); ?></h2>
										<h4 class="hnd-product-price hidden-xs">
											<?php echo ucfirst(get_field('handyman_type_of_service', $getServiceID)); ?>: <del><?php 
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
													echo (float) get_field('handyman_prod_price') + round($servicePrice, 2); echo '</span>'; ?></del>
													<span>$<?php echo '<span>'; ?><?php echo (float) get_field('handyman_prod_price') + round($servicePrice - $afterDiscount, 2); ?><?php echo '</span>'; ?></span> 
													 
										</h4>

										<h5 class="red5 desktop">Includes Product & Installation</h5>

										<div class="social-share-sec">
					                          <h6>Share This Deal : </h6>
					                        <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>?service-id=<?php echo $getServiceID; ?>" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/facebook.png" class="img-fluid" alt="facebook"></a>
					                        <a href="http://twitter.com/share?url=<?php echo get_permalink(); ?>?service-id=<?php echo $getServiceID; ?>&text=<?php echo urlencode(get_the_title()); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/twitter.png" class="img-fluid" alt="twitter" target="_blank"></a>
					                        <a href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo get_the_title() . ' '; ?><?php echo get_permalink(); ?>?service-id=<?php echo $getServiceID; ?>" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/mail.png" class="img-fluid" alt="mail"></a>

					                    </div>

										<?php // var_dump(get_field('handyman_prod_price')); ?>


										<?php if (get_field('handyman_product_show_quantity', $post->ID) && get_field('handyman_prod_price', $post->ID) > 0): ?>

										  <div class="form-group2 show-quantity">
										      <div class="row">
										        <div class="col-md-6 shq-left">
										          <em class="">
										            <?php echo get_field('handyman_product_show_quantity', $post->ID); ?>
										          </em>
										        </div>
										        <div class="col-md-6 shq-right">
										          <div class="input-group" style="margin-top: 12px;">
										            <div class="input-group-btn">
										              <button class="btn btn-default" id="down" onclick="down1('1')">
										                <i class="fa fa-minus"></i><span class="glyphicon glyphicon-minus"></span>
										              </button>
										            </div><input class="form-control input-number mynu" id="myNumber" name="hnd_showquantity" placeholder="Quantity" type="number" value="1" readonly>
										            <div class="input-group-btn">
										              <button class="btn btn-default" id="up" onclick="up1('1000')"><i class="fa fa-plus"></i></button>
										            </div>
										          </div>
										        </div>
										      </div>
										    </div><!-- new R -->        
										  
										<?php endif; ?>
										
										

										<div class="job-details">

											
											<?php 
												$mofiedDesc = 0;
												$mofiedDesCotent = '';
												foreach ( get_field('handyman_product_link_to_services') as $key => $plink_to_service) {			
												
													if ( (int) $plink_to_service['handyman_product_link_to_service'] === $getServiceID && 
														 $plink_to_service['handyman_product_service_description'] !== '' ) {
													
															$mofiedDesc = 1;
															$mofiedDesCotent = $plink_to_service['handyman_product_service_description'];
													}
												}
												if ($mofiedDesc) {
													echo $mofiedDesCotent;
												} else {
													echo $mofiedDesCotent = get_field('handyman_prod_services_description', $getServiceID); 
												}
											?>

									</div>
										
										<?php if (!get_field('handyman_add_on_services', $post->ID)): ?>
										
										<form id="handymn_product_form" action="" method="post">
											
											<?php wp_nonce_field('waiting_for_avengers_4_trailer', 'handyman_pro_nonce'); ?>
											
											<input type="hidden" name="handymn_prod_type" value="product" required>
											<input type="hidden" name="handymn_asso_service_id" value="<?php echo $getServiceID; ?>" required>
											<input type="hidden" name="handymn_product_id" value="<?php echo $post->ID; ?>" required>
											<input type="hidden" data-min="10" name="handymn_prod_quantity" id="" value="1" placeholder="Enter Quantity" required>
											<input type="hidden" name="handymn_original_price" value="<?php echo $servicePrice; ?>">
											<input type="hidden" name="handymn_product_no_option" value="true" required>

											<input type="hidden" name="handymn_service_time" value="<?php echo get_field('handyman_est_time', $getServiceID); ?>" required>
											<input type="hidden" name="handymn_service_price" value="<?php echo $servicePrice - $afterDiscount; ?>" required>
											<input type="hidden" name="handymn_product_price" value="<?php echo get_field('handyman_prod_price'); ?>" required>
											<input type="hidden" name="asso_serv_description" value="<?php echo htmlentities($mofiedDesCotent); ?>" required>

											<input type="hidden" name="handymn_original_price" value="<?php echo $servicePrice; ?>">

											<input type="hidden" name="handymn_service_comments" id="hnd_comm_hidden1">

											<?php if(get_field('handyman_product_customer_to_supply', $post->ID)) : ?>

												<input type="hidden" name="handyman_product_customer_to_supply" value="<?php echo get_field('handyman_product_customer_to_supply', $post->ID); ?>">

											<?php endif; ?>





											<!-- <div>
												 <input type="number" data-min="10" name="handymn_prod_quantity" id="" value="1" placeholder="Enter Quantity" required>
											</div>
											 <div class="grid-info-box account-btns">
												<div class="">
													<span class="add-to-cart"><i aria-hidden="true" class="fa fa-cart-plus"></i> Add To Cart</span>
												</div>
											</div> -->
											

											<input type="hidden" data-spremium="<?php echo get_field('handyman_product_premium', $getServiceID); ?>" value="">
											<input type="hidden" data-sdiscount="<?php echo get_field('handyman_product_discount', $getServiceID); ?>" value="">

 
										</form>

										<?php endif; ?>


									</div>
								</div>
							</div><!-- Job Head -->
							
						</div>

						<?php if ($handyman_other_option_ID) { 

						      		$IDProduct = $handyman_other_option_ID;

						      	} else {

						      		$IDProduct = $post->ID;

						      	} ?>

						<?php // var_dump($handyman_other_option_ID); exit; ?>


						<!-- Option Sub-Option -->

						<?php if (isset($getServiceID) && get_field('handyman_add_on_services', $IDProduct) && $handyman_show_addons ): ?>

						  <div class="col-md-12 clearfix">

						    <h4 class="ft28 op-finish-hide">Options:</h4>
						    <hr class="op-finish-hide" style="border: 1px solid #f2ae00;">

						    <form action="" id="service_questionnaire_form" method="post">

						    	<input type="hidden" name="handymn_prod_type" value="product" required>
								<input type="hidden" name="handymn_asso_service_id" value="<?php echo $getServiceID; ?>" required>
								<input type="hidden" name="handymn_product_id" value="<?php echo $post->ID; ?>" required>
								<input type="hidden" data-min="10" name="handymn_prod_quantity" id="" value="1" placeholder="Enter Quantity" required>

								<input type="hidden" name="handymn_original_price" value="<?php echo $servicePrice; ?>">
						    
							    <input type="hidden" name="handymn_service_id" value="<?php echo $getServiceID; ?>">
							    <input type="hidden" name="handymn_service_name" value="<?php the_title(); ?>">
							    <input type="hidden" name="handymn_showquantity" value="1" />
							    <input type="hidden" name="handymn_service_comments" id="hnd_comm_hidden">
							    <input type="hidden" name="handymn_alternate_option_id" value="<?php echo $handyman_other_option_ID; ?>">
							    <input type="hidden" name="handymn_alternate_option_show_hide" value="<?php echo $handyman_show_addons; ?>">
							    <input type="hidden" name="asso_serv_description" value="<?php echo htmlentities($mofiedDesCotent); ?>" required>

							    <?php if(get_field('handyman_product_customer_to_supply', $post->ID)) : ?>

												<input type="hidden" name="handyman_product_customer_to_supply" value="<?php echo get_field('handyman_product_customer_to_supply', $post->ID); ?>">

								<?php endif; ?>

						      <?php if (get_the_post_thumbnail_url($getServiceID)): ?>
						        <input type="hidden" name="handymn_service_featured_img" value="<?php echo get_the_post_thumbnail_url($getServiceID); ?>">
						      <?php else: ?>
						        <input type="hidden" name="handymn_service_featured_img" value="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png">
						      <?php endif; ?>

						      <?php 

						        $fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
						        $per_min_cost = $fetch_hour_price/60;

						        $servicePrice = $per_min_cost * get_field('handyman_est_time', $getServiceID);

						        if (get_field('handyman_product_premium', $getServiceID)) {
						          
						          $handyman_premium = ($servicePrice * get_field('handyman_product_premium', $getServiceID))/100;

						        } else {
						          
						          $handyman_premium = 0;
						        }

						        $servicePrice = $servicePrice + $handyman_premium;

						        // If discount is set
						        if(get_field('handyman_product_discount', $getServiceID)) {

						          $discount = get_field('handyman_product_discount', $getServiceID);

						          $afterDiscount = ( $servicePrice * $discount ) / 100;

						        } else {

						          $afterDiscount = 0;
						        }

						        
						        ?>

						        <?php wp_nonce_field('waiting_for_avengers_4_trailer', 'handyman_pro_nonce'); ?>

						        <!-- // REF - http://php.net/manual/en/json.constants.php -->
						        <input type="hidden" name="handymn_sl_addon_services" value='<?php echo json_encode(get_field('handyman_add_on_services', $IDProduct), JSON_HEX_APOS); ?>'>

						        <input type="hidden" name="handymn_service_time" value="<?php echo get_field('handyman_est_time', $getServiceID); ?>">
						        <input type="hidden" name="handymn_per_min_cost" value="<?php echo $per_min_cost; ?>">
						        <input type="hidden" name="handymn_service_price" value="<?php echo $servicePrice - $afterDiscount; ?>">
						        <input type="hidden" name="handymn_premium" value="<?php echo $handyman_premium; ?>">
						        <input type="hidden" name="handymn_after_discount" value="<?php echo $afterDiscount; ?>">


						        <input type="hidden" name="handymn_product_price" value="<?php echo get_field('handyman_prod_price'); ?>">
						        <!-- <input type="hidden" name="handymn_service_time" value="<?php // echo get_field('handyman_est_time', $getServiceID); ?>"> -->

						        <!-- <input type="hidden" name="handymn_service_description" value="<?php // echo strip_tags(get_field('handyman_prod_services_description', $getServiceID)); ?>">   -->

						        <input type="hidden" name="handymn_service_description" value="<?php echo htmlentities(get_field('handyman_prod_services_description', $getServiceID)); ?>">  
						        
						        
						        <input type="hidden" name="handymn_service_customer_to_supply" value="<?php echo get_field('handyman_prod_services_customer_to_supply', $getServiceID); ?>">

						        <input type="hidden" name="handymn_service_opt" value="">
						        <input type="hidden" name="handymn_service_sub" value="">
						        <input type="hidden" name="handymn_service_opt_val" value="">
						        <input type="hidden" name="handymn_service_opt_visibility" value="">
						        <input type="hidden" name="handymn_service_sub_val" value="">

						        <input type="hidden" data-spremium="<?php echo get_field('handyman_product_premium', $getServiceID); ?>" value="">
						        <input type="hidden" data-sdiscount="<?php echo get_field('handyman_product_discount', $getServiceID); ?>" value="">

						        <div class="sunny"></div>

						      
						      <div class="hnd-opttab-container">

						        <?php foreach (get_field('handyman_add_on_services', $IDProduct) as $outerKey => $handyman_add_on_services) : 

    						        	// var_dump($outerKey);
    						            
    						            $handyman_addon_options = $handyman_add_on_services['handyman_addon_options']; ?>

    						            <div class="tab transition-item-enter transition-item-enter-active <?php echo 'addon_service_' . $outerKey; ?><?php echo $outerKey === 0 ? ' active' : ''; ?>" style="<?php echo $outerKey == 0 ? 'display: block' : ''; ?>">
    						              <!-- <h3>What Is The Walls Height?</h3> -->
    						              <div class="ques-group-container">

    						                <div class="ques-group"><h3><?php echo $handyman_add_on_services['handyman_addon_question']; ?></h3>

    						                <?php foreach ( $handyman_addon_options as $innerKey => $handyman_addon_options_item ): ?>

    						                  <?php // var_dump($handyman_addon_options_item); ?>

    						                  <div class="ques <?php echo ($handyman_addon_options_item['handyman_sub_option_groups'][0]['acf_fc_layout']) ? 'has_sub_option ' . $handyman_addon_options_item['handyman_sub_option_groups'][0]['acf_fc_layout'] : ''; ?>">

    						                    <div class="ptag" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>">


    						                      <?php                          

    						                            if ( $handyman_addon_options_item['handyman_material_price'] != 0 && $handyman_addon_options_item['handyman_material_price'] != "" ) {
    						                              $optionMaterialCost1 = $handyman_addon_options_item['handyman_material_price'];
    						                            } else {
    						                               $optionMaterialCost1 = 0;
    						                            }


    						                      ?>

    						                      <?php if ( $handyman_addon_options_item['handyman_shopping_cart_caption_opt'] ): // Show Cart caption if avaiable. ?>

    						                        <?php if ( $handyman_addon_options_item['handyman_addon_sub_option_customer_supply'] ): ?>

    						                            <input id="<?php echo $outerKey . '|' . $innerKey; ?>" 
    						                          name="<?php echo 'addon_service_' . $outerKey; ?>"
    						                          type="radio" 
    						                          data-key="<?php echo $outerKey; ?>" 
    						                          value="<?php echo esc_attr($handyman_addon_options_item['handyman_shopping_cart_caption_opt']) . '~' . $handyman_addon_options_item['handyman_addon_sub_option_customer_supply'] . '|' . $handyman_addon_options_item['labour_minutes'] . '|' . $optionMaterialCost1; ?>" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>" data-premium="<?php echo get_field('handyman_product_premium', $getServiceID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $getServiceID); ?>">

    						                        <?php else: ?>

    						                          <input id="<?php echo $outerKey . '|' . $innerKey; ?>" 
    						                          name="<?php echo 'addon_service_' . $outerKey; ?>"
    						                          type="radio" 
    						                          data-key="<?php echo $outerKey; ?>" 
    						                          value="<?php echo esc_attr($handyman_addon_options_item['handyman_shopping_cart_caption_opt']) . '|' . $handyman_addon_options_item['labour_minutes'] . '|' . $optionMaterialCost1; ?>" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>" data-premium="<?php echo get_field('handyman_product_premium', $getServiceID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $getServiceID); ?>">
    						                          
    						                        <?php endif; ?>

    						                      <?php else: ?>

    						                        <?php if ( $handyman_addon_options_item['handyman_addon_sub_option_customer_supply'] ): ?>

    						                          <input id="<?php echo $outerKey . '|' . $innerKey; ?>" 
    						                        name="<?php echo 'addon_service_' . $outerKey; ?>"
    						                        type="radio" 
    						                        data-key="<?php echo $outerKey; ?>" 
    						                        value="<?php echo esc_attr($handyman_addon_options_item['handyman_option_label']) . '~' . $handyman_addon_options_item['handyman_addon_sub_option_customer_supply'] . '|' . $handyman_addon_options_item['labour_minutes'] . '|' . $optionMaterialCost1; ?>" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>" data-cts="<?php echo $handyman_addon_options_item['handyman_addon_sub_option_customer_supply']; ?>" data-premium="<?php echo get_field('handyman_product_premium', $getServiceID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $getServiceID); ?>">

    						                        <?php else: ?>

    						                          <?php 

    						                              // echo '<pre>';
    						                              // var_dump($handyman_addon_options_item);

    						                              if ( $handyman_addon_options_item['labour_minutes'] !== '0' || 
    						                                  $optionMaterialCost1 !== 0 || 
    						                                  $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] !== false || ($handyman_addon_options_item['handyman_addon_sub_option_check'] !== true &&
    						                                    $handyman_addon_options_item['handyman_sub_option_groups'] !== true)

    						                                ) {

    						                                $hnd_visibility = 'show';
    						                              
    						                              } else {

    						                                $hnd_visibility = 'hide';
    						                              }

    						                          ?>

    						                          <input id="<?php echo $outerKey . '|' . $innerKey; ?>" 
    						                        name="<?php echo 'addon_service_' . $outerKey; ?>"
    						                        type="radio" 
    						                        data-key="<?php echo $outerKey; ?>" 
    						                        value="<?php echo esc_attr($handyman_addon_options_item['handyman_option_label']) . '|' . $handyman_addon_options_item['labour_minutes'] . '|' . $optionMaterialCost1; ?>" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>" data-cts="<?php echo $handyman_addon_options_item['handyman_addon_sub_option_customer_supply']; ?>" data-visibility="<?php echo $hnd_visibility; ?>" data-premium="<?php echo get_field('handyman_product_premium', $getServiceID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $getServiceID); ?>">

    						                        <?php endif; ?>                       
    						                        
    						                      <?php endif; ?>

    						                      

    						                      <label for="<?php echo $outerKey . '|' . $innerKey; ?>">
    						                        <?php 

    						                          $optionsacx = '';
    						                          $optionsacx .= $handyman_addon_options_item['handyman_option_label'];


    						                          $optCost = $per_min_cost * $handyman_addon_options_item['labour_minutes'];



    						                          // Premium
    						                          if (get_field('handyman_product_premium', $getServiceID)) {
    						                          
    						                            $OPpremium = ( $optCost * get_field('handyman_product_premium', $getServiceID))/100;

    						                          } else {
    						                            
    						                            $OPpremium = 0;
    						                          }

    						                          $optCost = $optCost + $OPpremium;



    						                          // Discount
    						                          if (get_field('handyman_product_discount', $getServiceID)) {
    						        
    						                            $OPdiscount = ($optCost * get_field('handyman_product_discount', $getServiceID))/100;

    						                          } else {
    						                            
    						                            $OPdiscount = 0;

    						                          }

    						                          $optCost = $optCost - $OPdiscount;


    						                          $optionMaterialCost = 0;

    						                          if ( $handyman_addon_options_item['handyman_material_price'] != '0' ) {
    						                            $optionMaterialCost = $handyman_addon_options_item['handyman_material_price'];
    						                          }


    						                          $optCost = $optCost + $optionMaterialCost;
    						                          

    						                          if ( $handyman_addon_options_item['labour_minutes'] != '0' ) {

    						                            $optionsacx .= ' - Add $ <em data-prc="' . $optCost . '">' .  round($optCost, 2) . '</em>';

    						                          } else {

    						                            if ($optionMaterialCost != 0) {
    						                                $optionsacx .= '<em data-prc="' . $optCost . '">  - Add $ ' . $optCost . '</em>';
    						                            } else {
    						                                $optionsacx .= '<em data-prc="' . $optCost . '"></em>';
    						                            }

    						                            

    						                          }

    						                          echo $optionsacx;

    						                        ?>
    						                      </label>


    						                      <?php if ($handyman_addon_options_item['handyman_addon_sub_option_check'] && $handyman_addon_options_item['handyman_sub_option_groups']): // checking if sub-option option is checked ?>


    						                        <?php foreach ($handyman_addon_options_item['handyman_sub_option_groups'] as $subkey => $handyman_sub_option_group ): // Sub-Options ?>

    						                          <?php include('template-parts/content-op-quantity-product.php'); ?>
    						                          <?php include('template-parts/content-op-yesno-product.php'); ?>
    						                          <?php include('template-parts/content-op-list-product.php'); ?>
    						          
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


						      

						      <div class="row" style="margin-top: 25px;">
						        <div class="col-md-8">
						          <div class="pro-bar op-finish-hide">
						                  <div class="progress">
						                        <div id="progress-bar"></div>
						                    </div>
						                  </div>
						              </div>
						              <div class="col-md-4">
						                <div id="backnext" >
						                  <div style="overflow:auto;">
						              <div id="backnext">
						                <button id="nextBtn" onclick="nextPrev(1)" style="float:right;" type="button">Next</button>
						                <button id="prevBtn" onclick="nextPrev(-1)" style="float:right; display: none; margin-right:10px;" type="button">Back</button> 
						              </div>
						                  </div>
						              </div>
						      


						          <div style="clear: both;"></div>
						          <div style="text-align:center; display: none; padding-top:30px; padding-bottom:30px; margin-top:20px; width: 120px; margin-bottom: 20px; clear: both; margin: 0 auto;" id="stepss">

						            <?php for ($i=0; $i < count(get_field('handyman_add_on_services', $getServiceID)) ; $i++) : ?>
						              <span class="step"></span>
						            <?php endfor; ?>

						          </div>
						          </div>
						      </div>
						      

						    <!-- </form> -->

						  </div>

						  

						  <div class="col-md-12">
						    <div class="row final_statement_desktop no-margin mtt30" style="display: none">

						      <div class="col-md-12">
						        <!-- <h2>We can match you with pros for this job</h2>
						        <h5>Let us introduce you to some great pros we know</h5>
						        <div class="row fixtext mtt70">
						          <div class="col-md-3">
						            <img src="<?php // bloginfo('template_directory'); ?>/assets/images/fix-icon101.png"><span>Fixed<br>
						            Hourly Rates</span>
						          </div>
						          <div class="col-md-3">
						            <img src="<?php // bloginfo('template_directory'); ?>/assets/images/fix-icon102.png"><span>Live Online<br>
						            Scheduling</span>
						          </div>
						          <div class="col-md-5">
						            <img src="<?php // bloginfo('template_directory'); ?>/assets/images/fix-icon103.png"><span>100%<br>
						            Satisfaction Guarantee</span>
						          </div>
						        </div> -->
						        <div class="mtt50">
						          <button style="margin-right: 15px;display: none;" type="submit" name="submit_for_scheduling" id="submit_for_scheduling">Add to Cart</button>
						        </div>
						      </div>
						    </div>
						      </form>

						    

						  </div>

						<?php endif; ?>

						<!-- / Option Sub-Option -->


					</div>
					<div class="col-lg-4 col-md-4 column">						
						<?php get_template_part( 'template-parts/content', 'product-sidebar' ); ?>
					</div>
				</div>
			</div>
		</div>
	</section><!--Questions popup Box Start-->

<?php
get_footer(); ?>

<!-- Specifications Modal -->
<div class="modal" id="specifications">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Specifications</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php bloginfo('template_directory'); ?>/assets/js/product.js"></script>

<script>


	
	$(function(){

		$('.add-to-cart').click(function(){
			let product_quanity = $('[name="handymn_prod_quantity"]').val();
			if( product_quanity != '') {
				if (product_quanity != 0 ) {
					$('#handymn_product_form').submit();
				} else {
					alert('Quanity value can not be 0');
				}
			} else {
				alert('Enter Quanity');
			}
		});


		// REF - https://stackoverflow.com/questions/21863462/bootstrap-modal-dynamic-content
		$('#specifications').on('show.bs.modal', function(){
			let specs = $('.specifications-content').html();
		    $('.modal-body').html(specs);
		});
		let orPrice = parseFloat($('.hnd-product-price > del > span').text());
		let flPrice = parseFloat($('.hnd-product-price > span > span').text());
		// On quantity change
		$('[name="handymn_prod_quantity"]').keyup(function(){
			let qty = $(this).val();
			// console.log(orPrice);
			// console.log(flPrice);
			$('.hnd-product-price > del > span').text( orPrice * qty );
			$('.hnd-product-price > span > span').text( flPrice * qty );
		});
	});
	
</script>