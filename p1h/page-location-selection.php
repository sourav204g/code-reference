<?php
/**
 * Template Name: Location Selection Page
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

session_start();

// echo "<pre>";
// var_dump($_POST);
// exit;

if (!isset($_GET['manage-project'])) {

	if ( !isset($_SESSION['hnd_zipcode']) || empty($_POST) ) {
		wp_redirect( home_url( '/cart/' ) );
		exit();
	}

}



/* Manage Skills */
function fetch_customer_id( $phone ) {

		if ( !isset( $_POST['handyman_pro_nonce_3'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce_3'], 'waiting_for_avengers_4_trailer_3' ) ) {

				die( 'Failed security check' );

		} else {

				global $wpdb;
				
				$previOusAddressesFound = $wpdb->get_row( $wpdb->prepare( "SELECT scheduled_address FROM hxp_handyman_booking WHERE customer_phone = %s", array( $phone ) ), 'ARRAY_A');
				
				/* foreach ($previOusAddresses as $key => $previOusAddress ) {
					var_dump($previOusAddress['scheduled_address']);
					var_dump(  unserialize(base64_decode($previOusAddress['scheduled_address']))   );
				} */

				if (!empty($previOusAddressesFound)) {
					return true;
				} else {
					return false;
				}

				/* $args = array(

					        'posts_per_page' => -1,
					        'post_type' => 'customers',
					        
				);
		
				$the_query = new WP_Query( $args ); 

				$customers = $the_query->get_posts();

				foreach ( $customers as $key => $customer ) {

					if( get_field( 'handyman_pro_customer_phone', $customer->ID ) === $_POST['hnd_customer_no'] ) {

						if (get_field('handyman_pro_customer_previous_bookings', $customer->ID)) {
							return $customer->ID;
						} else {
							return false;
						}

					}
				} */


				
		}

}

function capture_handyman_details() {

		if ( !isset( $_POST['handyman_pro_nonce_2'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce_2'], 'waiting_for_avengers_4_trailer_2' ) ) {

				die( 'Failed security check' );

		} else {


					/*array (size=9)
						  'handyman_pro_nonce_2' => string '032e238e08' (length=10)
						  '_wp_http_referer' => string '/handymanpro-new/handyman-pros/' (length=31)
						  'new_booking_id' => string '' (length=0)
						  'hndy_pro_id' => string '463' (length=3)
						  'hndy_schedule_date' => string 'Thu Feb 14 2019 00:00:00 GMT+0530 (India Standard Time)' (length=55)
						  'hndy_schedule_time' => string '07:00 am - 08:00 am' (length=19)
						  'new_booking_service_name' => string '' (length=0)
						  'new_booking_selected_service_options' => string '' (length=0)
						  'hndy_schedule_submit' => string '' (length=0) */


					
					if ( $_POST['hndy_pro_id'] !== '' ) {


						$_SESSION['hnd_pro_details'] = (array) $_POST;

						/* if ($_POST['hndy_schedule_date'] !== '' && $_POST['hndy_schedule_time'] !== '') {

							$_SESSION['hnd_pro_details'] = (array) $_POST;

							
						} else {

							echo "<script>"; 
							echo "alert('Pro details are not submitted properly. Try again');"; 
							echo "window.location.href = 'http://localhost/handymanpro-new/cart/';"; // change url here // sourav
							echo "</script>";

						} */

					} else {
						wp_redirect( home_url( '/cart/' ) );
						exit();
					}

				
		}

}

if( $_POST && isset($_POST['__hndy_schedule_submit']) ) {
		capture_handyman_details();
}


// var_dump($_POST);
// exit;

get_header(); ?>

	<style>

		.customer-zipcode span {
		    background: beige;
		    pointer-events: none;
		    opacity: 0.8;
		    padding: 15px 25px;
		    width: 100%;
		    display: block;
		}

		[name="hnd_customer_zipcode"] {
		    pointer-events: none;
		    background: rgb(220 233 245 / 20%) !important;
		}
		
		.prev-addresses input {
		    padding: 0px;
		    background: transparent;
		    border: navajowhite;
		    pointer-events: none;
		    margin: 0px;
		}

		a.locl-new-address {
		    color: darkblue;
		    display: block;
		    position: relative;
		    top: 16px;
		    font-size: 14px;
		    text-decoration: underline;
		}

		[name="hnd_customer_heard"] {
			float: left;
		    width: 100%;
		    background: none;
		    border: 2px solid #e8ecec;
		    -webkit-border-radius: 8px;
		    -moz-border-radius: 8px;
		    -ms-border-radius: 8px;
		    -o-border-radius: 8px;
		    border-radius: 8px;
		    font-size: 13px;
		    color: #888888;
		    padding: 15px 25px;
		    font-family: 'Lato', sans-serif;
		    margin-bottom: 15px;
		}

	</style>

	<?php get_template_part( 'template-parts/content', 'breadcrumb2' ); ?>

	<section>
		<div class="block less-top">
			<div class="container">
				<div class="row">

								<div class="col-md-12">
									<div class="quick-form-job">

										<form action="<?php echo get_site_url() . '/booking-confirmation/' ?>" method="post">
											<!-- <h4 class="ft288">File The Customer Information Form</h4> -->
											<div class="row">

												<?php wp_nonce_field('avengers_infinity_war_endgame', 'handyman_pro_nonce_xx'); ?>

												<div class="col-md-4">
													<input placeholder="Enter your Full Name *" name="hnd_customer_name" type="text" required>
												</div>
												<div class="col-md-4">
													<input placeholder="Email Address*" name="hnd_customer_email" type="email" required>
												</div>
												<div class="col-md-4">
													<input placeholder="Phone Number" name="hnd_customer_phone" type="number" required>
												</div>

												<div class="col-md-4">
													<input placeholder="Enter your Address" name="hnd_customer_address" type="text" required>
												</div>

												<div class="col-md-4">
													<input placeholder="Enter your City" name="hnd_customer_city" type="text" required>
												</div>

												<div class="col-md-4">
													<input placeholder="Enter your State" name="hnd_customer_state" type="text" required>
												</div>

												<div class="col-md-6">

													<select name="hnd_customer_heard" id="" required>
														<option value="">Where did you hear about us?</option>

														<?php
														
														if( have_rows('hnd_hear_about_us_options', 'option') ):

														    
														    while( have_rows('hnd_hear_about_us_options', 'option') ) : the_row();

														        
														        $option = get_sub_field('hear_abt_us_option', 'option'); ?>


														    	<option value="<?php echo $option; ?>"><?php echo $option; ?></option>


														<?php   
														    	endwhile;

														endif; ?>
														
													</select>
													
												</div>

												<?php if (!isset($_GET['manage-project'])): ?>

													<input name="hnd_customer_zipcode" type="hidden" value="<?php echo $_SESSION['hnd_zipcode']; ?>" required>

													<div class="col-md-6 customer-zipcode">
														<span><?php echo $_SESSION['hnd_zipcode']; ?></span>
													</div>

												<?php else: ?>

													<style>
														[name="hnd_customer_zipcode"] { pointer-events: initial; background: none; }
													</style>

													<div class="col-md-6">
														<input name="hnd_customer_zipcode" type="number" value="" placeholder="Enter Zipcode" required>
													</div>

													<input type="hidden" name="hnd_manage_my_project" value="true">
													
												<?php endif; ?>

												
												<div class="col-md-12">
													<button class="submit" type="submit" name="hnd_customer_submit" >SUBMIT</button>
												</div>

											</div>
										</form>

									</div>
								</div>

				</div>
			</div>
		</div>
	</section>


<?php
get_footer(); ?>

<script>
	/* $('.locl-new-address').click(function(evt){
		evt.preventDefault();
		document.getElementById('hnd_customer_enter_phone_form').submit();
	}); */
</script>