<?php
/**
 * Template Name: Cart Page
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package handyman_pro
 */

/* function timeConvert($n) {
	//var_dump($n);
	$num = $n;
	$hours = ( $num / 60);
	//var_dump($hours);
	$rhours = floor($hours);
	$minutes = ($hours - $rhours) * 60;
	// var_dump($minutes);
	$rminutes = round($minutes, 2);
	return $rhours . "." . $rminutes . " Hours";
} */

$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;
session_start();

// echo "<pre>";
// var_dump($_SESSION['hnd_del_options']);
// var_dump($_SESSION['hnd_del_suboptions']);
// exit;

// echo '<pre>';
// session_destroy();
// var_dump($_SESSION);
// exit;
$_SESSION['service_request'] = ''; // for new zipcode

$_SESSION['hour_price'] = $fetch_hour_price;

// Removing Product Items
if( isset($_GET['action']) && 
	isset($_GET['type']) && 
	$_GET['type'] === 'product' && 
	$_GET['action'] === 'remove' && 
	isset($_GET['id']) ) {
	$session_index = $_GET['id'];

	if ( count($_SESSION['hnd_product_post_values']) > 1 ) {

		unset($_SESSION['hnd_product_options'][$session_index]);
		unset($_SESSION['hnd_product_suboptions_values'][$session_index]);
		unset($_SESSION['hnd_product_suboptions'][$session_index]);
		unset($_SESSION['all_product_setup'][$session_index]);

		unset($_SESSION['cart_product_item_total'][$session_index]);
		unset($_SESSION['cart_product_item_total_min'][$session_index]);
		unset($_SESSION['hnd_product_post_values'][$session_index]);
		unset($_SESSION['asso_labour_min'][$session_index]);

		wp_redirect( home_url( '/cart/' ) );
		exit();
		
	} else {

		unset($_SESSION['hnd_product_options']);
		unset($_SESSION['hnd_product_suboptions_values']);
		unset($_SESSION['hnd_product_suboptions']);
		unset($_SESSION['all_product_setup']);

		unset($_SESSION['cart_product_item_total']);
		unset($_SESSION['cart_product_item_total_min']);
		unset($_SESSION['hnd_product_post_values']);
		unset($_SESSION['asso_labour_min']);

		wp_redirect( home_url( '/cart/' ) );
		exit();
	}
}

// Removing Service Items
if( isset($_GET['action']) && 
	isset($_GET['type']) && 
	$_GET['type'] === 'service' && 
	$_GET['action'] === 'remove' && 
	isset($_GET['id']) ) {
	$session_index = $_GET['id'];
	if ( count($_SESSION['hnd_post_values']) > 1 ) {

		unset($_SESSION['hnd_post_values'][$session_index]);
		unset($_SESSION['hnd_options'][$session_index]);
		unset($_SESSION['hnd_suboptions'][$session_index]);
		unset($_SESSION['all_service_setup'][$session_index]);
		unset($_SESSION['hnd_suboptions_values'][$session_index]);
		unset($_SESSION['cart_item_total'][$session_index]);
		unset($_SESSION['cart_item_total_min'][$session_index]);

		unset($_SESSION['hnd_del_options'][$session_index]);
		unset($_SESSION['hnd_del_suboptions'][$session_index]);

		wp_redirect( home_url( '/cart/' ) );
		exit();
		
	} else {

		unset($_SESSION['hnd_post_values']);
		unset($_SESSION['hnd_options']);
		unset($_SESSION['hnd_suboptions']);
		unset($_SESSION['all_service_setup']);
		unset($_SESSION['hnd_suboptions_values']);
		unset($_SESSION['cart_item_total']);
		unset($_SESSION['cart_item_total_min']);

		unset($_SESSION['hnd_del_options']);
		unset($_SESSION['hnd_del_suboptions']);


		wp_redirect( home_url( '/cart/' ) );
		exit();
	}
}


// Removing addons -- services
if( isset($_GET['service']) && isset($_GET['action']) && 
	$_GET['action'] === 'remove' && 
	isset($_GET['eid']) && 
	isset($_GET['aid']) && 
	isset($_GET['type'])
) {
	$item_index  = $_GET['eid'];
	$addon_index = $_GET['aid'];
	$atype  = $_GET['type'];
	if( $atype === 'option' ) {
		$_SESSION['hnd_options'][$item_index][$addon_index] = $_SESSION['hnd_options'][$item_index][$addon_index] . '|deleted';
		wp_redirect( home_url( '/cart/' ) );
		exit();
	} // option
	if( $atype === 'suboption' ) {
		$_SESSION['hnd_suboptions'][$item_index][$addon_index] = $_SESSION['hnd_suboptions'][$item_index][$addon_index] . '|deleted';
		wp_redirect( home_url( '/cart/' ) );
		exit();
		
	} // suboption
}


// Removing addons - products
if( isset($_GET['product']) && isset($_GET['action']) && 
	$_GET['action'] === 'remove' && 
	isset($_GET['eid']) && 
	isset($_GET['aid']) && 
	isset($_GET['type'])
) {
	$item_index  = $_GET['eid'];
	$addon_index = $_GET['aid'];
	$atype  = $_GET['type'];
	if( $atype === 'option' ) {
		$_SESSION['hnd_product_options'][$item_index][$addon_index] = $_SESSION['hnd_product_options'][$item_index][$addon_index] . '|deleted';
		wp_redirect( home_url( '/cart/' ) );
		exit();
	} // option
	if( $atype === 'suboption' ) {
		$_SESSION['hnd_product_suboptions'][$item_index][$addon_index] = $_SESSION['hnd_product_suboptions'][$item_index][$addon_index] . '|deleted';
		wp_redirect( home_url( '/cart/' ) );
		exit();
		
	} // suboption
}


get_header(); ?>

<style>

.cart-page { cursor: pointer; }

.cart-head.cart-head-panel a:nth-child(1) {
    display: inline-block;
}
.cart-head.cart-head-panel h3{
	padding-top: 7px;
}

.cart-head.cart-head-panel h3.printvisibility {
	padding-top: 17px;
}

@media screen and (max-width: 576px) {
    .mob-hidden{
        display:none;
    }
    .zip-frm-wrapper .simple-text22{
	    padding: 25px 15px;
    }
    .zip-frm-wrapper .simple-text22 h3{
	    margin-bottom: 5px;
    }
}

/*26-3-22*/

button.sbmt-est-btn {
    background: #00a3e8;
    border-radius: 0;
    padding: 18px;
}

div#mngProj {
    top: calc(50% - 50px);
}

.mg-proj-btn{
	position: relative;
	background: #ff7f24;
	width: 100%;
}

.mg-proj-btn:hover{
	background: #f2ae00;
}

.mg-proj-btn span {
    background-image: linear-gradient(135deg, #fd6d6d 0%, #c90202 100%);
    font-size: 31px;
    font-weight: 600;
    height: 100%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 0;
    padding: 6px 18px;
    cursor:pointer;
    border-left: 5px solid #c70000;
    box-shadow: 2px 0px 4px 1px inset #cb23236b;
}

.mg-proj-btn span:hover {
    background-image: linear-gradient(135deg, #c90202 0%, #fd6d6d 100%);
}

</style>


	<div class="hidden-xs">
		<?php get_template_part( 'template-parts/content', 'breadcrumb2' ); ?>
	</div>

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/page-cart.css">

	<section>
	<div class="block less-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12" data-toggle="collapse" href="#filter" aria-expanded="false" aria-controls="filter">
					<a>
						<div class="cart-page">
							<div class="cart-icon">
								<i class="fa fa-cart-plus"></i>
							</div>
							<?php if ( isset($_SESSION['hnd_post_values']) && !empty($_SESSION['hnd_post_values']) || isset($_SESSION['hnd_product_post_values']) && !empty($_SESSION['hnd_product_post_values']) ): ?>
							<?php 
								$cartCount = 0;
								if ( isset($_SESSION['hnd_post_values']) && !empty($_SESSION['hnd_post_values']) ) {
									$cartCount += count($_SESSION['hnd_post_values']);
								} else {
									$cartCount += 0;
								}
								if ( isset($_SESSION['hnd_product_post_values']) && !empty($_SESSION['hnd_product_post_values']) ) {
									$cartCount += count($_SESSION['hnd_product_post_values']);
								} else {
									$cartCount += 0;
								}
							?>
							<div class="cart-head cart-head-panel">
								<?php if ( $cartCount > 1 ): ?>
										<h3>( <?php echo $cartCount; ?> Items ) <span class="cart-head-span">..</span></h3>
								<?php else: ?>
										<h3>( <?php echo $cartCount; ?> Item ) <span class="cart-head-span">..</span></h3>
										
								<?php endif; ?>
								<h4 class="completion-time"></h4>
								<!-- <h4>Completion Time: _ Minutes</h4> -->
								 <h3 class="printvisibility"><a href="#" onclick="cartprint();" ><i class="fa fa-print"></i></a></h3>
								<i class="fa fa-chevron-down cart-head2" aria-hidden="true"></i>
							</div>
							<?php else: ?>
							<?php 
									unset($_SESSION['hnd_pro_details']); // Delete Session when cart is empty.
									unset($_SESSION['hnd_zipcode']); // Delete Session when cart is empty.
							?>
							<div class="cart-head">
								<h3>( 0 Items ) Empty Cart</h3>
								<!-- <h4>Completion Time: 0 Minutes</h4> -->
								<i class="fa fa-chevron-down cart-head2" aria-hidden="true"></i>
							</div>
							<?php endif; ?>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
				<div class="collapse filter_bg" id="filter">
					<div class="container" style="position: relative;">
						<h3 class="cartheadinglogo"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/resource/logo.png"></h3>

						<?php 

							if ( isset($_SESSION['hnd_product_post_values']) && !empty($_SESSION['hnd_product_post_values']) || 
								 isset($_SESSION['hnd_post_values']) && !empty($_SESSION['hnd_post_values']) ) {


								if (!isset($_SESSION['cart2'])) {
									// echo 'SOURAV';
									echo '<script> window.location.href = "' . home_url( '/cart-2/' ) . '"; </script>';
									
								} else {
									unset($_SESSION['cart2']);
								}

							}


						$tableitem = 1;

						?>
						
						<?php include('cart-services.php'); ?>
						<?php include('cart-products.php'); ?>	

						<?php global $hasCustomService; // var_dump($hasCustomService); ?>				

						<?php if (!isset($cartCount)): ?>
							<p style=" text-align: center; margin-top: 30px; ">The cart is empty.</p>
						<?php endif; ?>

						<div class="hnd-terms container print-hide">


							<?php if ($customerTOsupply || $customerTOsupply_Prod || $_SESSION['hnd_product_post_values']): ?>

								<span id="customer-to-supply">Customer to supply: <a href="#">Read More..</a></span>

							<?php else: ?>

								<span id="tech-materials">Technical Materials: <a href="#">Read More..</a></span>
								
							<?php endif; ?>
							
							<span id="debris">Debris: <a href="#">Read More..</a></span>
							<span id="insurance">Insurance: <a href="#">Read More..</a></span>

							<?php if ($hasCustomService): ?>

							<span id="customerwants">Customer wants to pay: <a href="#">Read More..</a></span>

							<?php endif; ?>
						</div>
						
						<div class="tech-materials hnd-terms hnd-terms-content container termsval">
							<strong>Technical Materials</strong>
							<p>Some minor technical materials may also be needed for your project that we might need to supply. If needed, these materials are charged as follows: 
							store bought materials are charged base on store receipt plus 20% mark up and, depending on distance, a delivery charge. Truck stock items are charged 
							a 20% mark up with no delivery charge.</p>
						</div>

						<div class="customer-to-supply hnd-terms hnd-terms-content container termsval">
							<strong>Customer to supply</strong>
							<p>Customer saves money by supplying as many materials, parts and fixtures as possible for the project per the "Customer to supply" list above. Some additional technical materials may also be needed for your project that we might need to supply. If needed, these materials are charged as follows: store bought materials are charged based on store receipt plus 20% mark up and, depending on distance, a delivery charge. Truck stock items are charged a 20% mark up with no delivery charge.</p>
						</div>

						<div class="debris hnd-terms hnd-terms-content container termsval">
							<strong>Debris</strong>
							<p>We will dispose of large debris, parts and fixtures in heavy duty bags and place on outside curb for customer's local disposal pickup. All small debris, dust and papers will be thoroughly cleaned by us and disposed in customer's disposal containers. <b>Note:</b> Hauling away debris available for an extra fee.</p>
						</div>

						<div class="insurance hnd-terms hnd-terms-content container termsval">
							<strong>Insurance</strong>
							<p>All statements concerning Insurance, Licenses and Bonds are informational only and are self reported. Since insurance, licenses and bonds can expire and can be cancelled, homeowners should always check such information for themselves.</p>
						</div>

						<?php if ($hasCustomService): ?>

								<div class="customerwants hnd-terms hnd-terms-content container termsval">
									
									<strong>Customer wants to pay</strong>

									<p>Customer name the price custom described projects are accepted on a fairly price based offer and skill level requests. We will let you know of any discrepancies at time of job.</p>
								</div>

						<?php endif; ?>
                      
					</div>
				</div>

				<!-- <div class="col-md-12 print-height"></div> -->

				<div class="hnd-terms container print-hide hnd-cart-warning" style="display: none;">
					<b>Warning: </b> The total amount of this work order falls below our <b>$125.00</b> minimum charge. To take full advantage of this minimum charge of $125.00, please add more items to the cart.
				</div>
				
				


				<?php if (isset($cartCount)): ?>
				
				<div class="col-md-12 mt-crt30 zip-frm-wrapper">
					<div class="simple-text22">
											<div class="live-scheduling-container" >
												<h3>Enter Your Zip Code</h3>
												<span class="mob-hidden">Your one call for handyman
						                          can solve all your house problems & needs.</span>
												<div class="clearfix"></div>
												<div class="signup22" align="center">
													<div class="input-group" style="margin-top: 20px">
														<form action="<?php  echo get_site_url() . '/handyman-pros/';  ?>" method="post">
															<?php wp_nonce_field('waiting_for_avengers_4_trailer', 'handyman_pro_nonce'); ?>
															<?php if (isset($_SESSION['hnd_post_values'])) : ?>
																<input type="hidden" name="cdl_item_count" value="<?php echo count($_SESSION['hnd_post_values']); ?>">
																
															<?php endif; ?>
															<input class="input-group-field bgcc" name="cdl_zipcode" placeholder="Enter Your Zip Code" type="number" required>
															
															<div class="input-group-button">
																<button class="button11 bgd8" name="cdl_submit" type="submit" style="margin-right: 0px !important;">Submit for Scheduling </button>


																<?php 

																if ( $cartCount < 2 &&  $_SESSION['hnd_post_values'][0]['handymn_service_id'] !== 'custom'): ?>

																	<?php // var_dump($freeEstimate); ?>

																	<?php if ($freeEstimate && $cartCount < 2): ?>

																		<button class="button11 sbmt-est-btn" name="cdl_submit" type="submit" style="margin-right: 0px !important;">Submit for Estimate Only </button>
																		
																	<?php endif ?>

																	<div class="button11 mg-proj-btn" style="padding:0px;">
																		<a href="<?php echo home_url('/customer-details/?manage-project'); ?>" class="button103 manage-projectx" style="margin: 0px;background-color: #ff7f24;">Manage My Project </a><span data-toggle="modal" data-target="#mngProj">?</span>
																		
																	</div>

																	<a href="<?php echo home_url('#shop-more'); ?>" class="button103">Shop for More Items</a>
																	
																<?php endif; ?>

																
															 
                                                               
															</div>
                                                            
														</form>
													</div>
												</div>
											</div>
	
						<div class="revise--btn-group schedule-btns" style="display: none;">
							<?php 
									$phone = get_field('handyman_contact_phone_no', 'option'); 
									$str = array(' ', '+', '(', ')', '-');
									foreach ($str as $key => $value) {
										$phone = explode($value, $phone); 
										$phone = implode('', $phone);
									}
							?>
							<button class="button11 bgd8 bbb-hidde" name="live-scheduling" type="button">Live Scheduling</button>
							<a href="tel:<?php echo $phone; ?>" class="button11 bbb-hidde" type="button">Schedule by Phone</a>
							<a href="<?php echo home_url('/all-services/'); ?>" class="button13 bbb-hidde" type="button">Shop for More Items</a>
					
						</div>
						
					</div>
				</div>
				<?php endif; ?>
				<div class="col-md-12"></div>
			</div>
</section>

<?php
get_footer(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>

<script>

	let durations = Array();

	function cartprint() {
		$('#filter').addClass('show');
		window.print();
	}

	function totalTime(durations) {

		// console.log(durations);
		
		const totalDurations = durations.slice(1)
		.reduce((prev, cur) => moment.duration(cur).add(prev),
			moment.duration(durations[0]))

		// console.log(totalDurations);

		if (totalDurations['_data']['days'] > 0) {

			let day = totalDurations['_data']['days'] * 24;
			let h   = totalDurations['_data']['hours'] + day;

			let m = totalDurations['_data']['minutes'];
			
			if (m < 10) {
				m = '0' + m;
			}

			return `Approximate Completion Time: ${h}:${m} Hours`;
		

		} else {
			return `Approximate Completion Time: ${moment.utc(totalDurations.asMilliseconds()).format("HH:mm")} Hours`;
		}
		
		// return 'Completion Time: ' + (rhours + total) + ":" + rminutes + " hours";
	}
	
	$(function(){

		let talcost = 0;
		$('#filter .container').find('.mycart').each(function(){
			let cost = $(this).find('.cart-product .row div:last-child table tbody tr:last-child td.total-pi strong').text();

			$(this).find('.hnd-tl span').text(cost);

			// console.log(cost);
			
			cost = cost.replace('$', '');
			cost = parseFloat(cost.replace(' USD', ''));
			talcost += cost;
		});

		$('#filter .container').find('.myproductcart').each(function(){
			let cost = $(this).find('.cart-product .row div:last-child table tbody tr:last-child td.total-pi strong').text();

			$(this).find('.hnd-tl span').text(cost);
			
			cost = cost.replace('$', '');
			cost = parseFloat(cost.replace(' USD', ''));
			talcost += cost;
		});

		$('.cart-head-span').html('...');
		$('.cart-head-span').html('$<span>' + talcost.toFixed(2));
		$('[name="live-scheduling"]').click(function(){
			$('.live-scheduling-container').toggle();
		});

		$('.mycart, .myproductcart').each(function(){
			let time = $(this).find('.cart-product .hnd_total_time').text();
			time = time.replace(' Hours', '');
			durations.push(time);
			$(this).find('.completion_time span').text(time);
			// console.log(durations);
		});

		/* $('.myproductcart').each(function(){
			let time = $(this).find('.cart-product .completion_time_product').text();
			time = time.replace(' Hours', '');
			time = time.replace('Completion Time: ', '');
			taltime += parseFloat(time);
		}); */

		// console.log(taltime);

		// taltime = taltime.toFixed(2);

		// console.log(taltime);

		// completion_time_product
		// var radixPos = String(taltime).indexOf('.');
		
		// if (radixPos > 0) {
		// 	var deci = parseInt(String(taltime).slice(radixPos + 1));
		// } else {
		// 	var deci = 0;
		// }

		// console.log(durations);

		$('.completion-time').text(totalTime(durations));
		// console.log(taltime);
		// console.log( radixPos );
		// console.log( deci );

		// Warning
		var tlPrice = parseFloat($('.cart-head-span > span').text());
		// console.log(tlPrice);

		if (tlPrice < 125.00) {
			$('.hnd-cart-warning').show();
		} else {
			$('.hnd-cart-warning').hide();
		}
		
		// terms&conditions
		$('#tech-materials').click(function(e){
			e.preventDefault();
			$('.tech-materials').toggle();
			$('.customer-to-supply').hide();
			$('.debris').hide();
			$('.insurance').hide();
		});


		$('#customer-to-supply').click(function(e){
			e.preventDefault();
			$('.customer-to-supply').toggle();
			$('.tech-materials').hide();
			$('.debris').hide();
			$('.insurance').hide();
		});

		$('#debris').click(function(e){
			e.preventDefault();
			$('.debris').toggle();
			$('.tech-materials').hide();
			$('.customer-to-supply').hide();
			$('.insurance').hide();
			$('.customerwants').hide();
		});

		$('#insurance').click(function(e){
			e.preventDefault();
			$('.insurance').toggle();
			$('.tech-materials').hide();
			$('.customer-to-supply').hide();
			$('.debris').hide();
			$('.customerwants').hide();
		});

		$('#customerwants').click(function(e){
			e.preventDefault();
			$('.customerwants').toggle();
			$('.tech-materials').hide();
			$('.customer-to-supply').hide();
			$('.debris').hide();
			$('.insurance').hide();
		});


	});

</script>


<div class="modal" id="mngProj">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		  <div class="modal-header">
		    <h5 class="modal-title" id="exampleModalLabel">Manage My Project</h5>
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		      <span aria-hidden="true">&times;</span>
		    </button>
		  </div>
		  <div class="modal-body">
		    Manage my project feature allows you to designate a free live project manager to manage your project and schedule a job date for you.
		  </div>
		  <div class="modal-footer">
		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
		  </div>
		</div>
	</div>
</div>