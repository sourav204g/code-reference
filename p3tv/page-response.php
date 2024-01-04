<?php
/**
 * Template Name: Response
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TravelTographer
 */

// echo "<pre>";
// var_dump($post->ID);

require 'vendor/autoload.php';
use \Mailjet\Resources;


if ( isset($_GET['payment_status']) && isset($_GET['txn_id']) && isset($_GET['mc_gross']) && isset($_GET['item_number']) ) {

	$new = (int) $_GET['item_number'];

	
	global $wpdb;

	// INSERT TO DATABASE
	$wpdb->query( $wpdb->prepare(
	    "UPDATE tvl_travelt_booking set payment_status = '%s', txn_id = '%s', amount = '%f', total_paypal_response = '%s', payment_date = '%s' WHERE booking_id = '%d'",
	    array(
	        $_GET['payment_status'],
	        $_GET['txn_id'],
	        $_GET['mc_gross'],
	        json_encode($_GET),
	        $_GET['payment_date'],
	        $new
	    )
	));

	wp_redirect( home_url( '/response/?bid=' . $new . '&booking=success' ) );
	die(); 
	
}

get_header(); ?>

			
		   <?php if ( isset($_GET['new']) && isset($_GET['payment']) && isset($_GET['amt']) ): ?>


		   					<form name="travelt_paypal" id="travelt_paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
		   			            
		   			            <!-- Identify your business so that you can collect the payments. -->
		   			            <input type="hidden" name="business" value="info@gaga-photography.com">
		   						
		   			            <!-- Specify a Buy Now button. -->
		   			            <input type="hidden" name="cmd" value="_xclick">
		   						
		   			            <!-- Specify details about the item that buyers will purchase. -->
		   			            <input type="hidden" name="item_name" value="account-<?php echo $_GET['new']; ?>">
		   			            <input type="hidden" name="item_number" value="<?php echo $_GET['new']; ?>">

		   			            <input type="hidden" name="amount" value="<?php echo $_GET['amt']; ?>">

		   			            <input type="hidden" name="currency_code" value="USD">
		   						
		   			            <!-- Specify URLs -->
		   			            <input type="hidden" name="notify_url" value="<?php echo home_url('/notify/'); ?>">
		   			            <input type="hidden" name="return" value="<?php echo home_url('/response/'); ?>">
		   			            <input type="hidden" name="cancel_return" value="<?php echo home_url('/payment-cancellation/'); ?>">
		   						
		   			            <!-- Display the payment button. -->
		   			            <input type="submit" name="submit" id="make-payment">
		   					
		   					</form>

		   					<script>
		   						document.getElementById('make-payment').click();
		   					</script>
		   			
		   		
		   <?php endif; ?>


			<!--Main Bottom Start-->
	        <section class="inner_bg">
	            <div class="container">
	                <div class="row">
	                    <div class="col-xl-12 col-lg-12">
	                        <div class="main_bottom_left">
	                            <div class="main_bottom_content">
	                                 <div class="main_bottom_left_title">
	                                   <h3><?php the_title(); ?></h3>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    
	                </div>
	            </div>
	        </section>

	        <!--Contact One single-->
	        <section class="contact-one">
	            <div class="container">
	                <div class="row">
	                    
	                    <div class="col-xl-12">
	                        <div class="block-title text-left">         

	                        		<?php if ( isset($_GET['confirm']) && isset($_GET['phid']) && isset($_GET['bid']) ): 

	                        			$photographer_id = (int) $_GET['phid'];
	                        			$booking_id 	 = (int) $_GET['bid'];

	                        			// If Post exists
	                        			if ( get_post_status ($photographer_id) && get_post_status ($booking_id) ) { 
	                        				
	                        				 global $wpdb;

	                        				 $fetch = $wpdb->get_row( $wpdb->prepare( "SELECT booking_date, response FROM tvl_travelt_booking WHERE booking_id = %d", array( $booking_id ) ), 'ARRAY_A');

	                        				 // echo "<pre>";
	                        				 // var_dump($fetch);

	                        				 if ($fetch) {

	                        				 	$currentDateTime = new DateTime();

	                        				 	$fetchedDateTime = new DateTime($fetch['booking_date'], new DateTimeZone('Asia/Dubai'));

												$currentDateTime->setTimezone(new DateTimeZone('Asia/Dubai'));

												// var_dump($currentDateTime);
												// var_dump($fetchedDateTime);
												// var_dump($currentDateTime->diff($fetchedDateTime)->days);

												if ( $currentDateTime->diff($fetchedDateTime)->days > 0 ) { // If more than 24 hours
													echo "This Response cannot be received as the token has expired!";
												} else { // 

													if ($fetch['response']) {

														$res = json_decode( $fetch['response'] );

														$i = count($res);

														$found = array_search($photographer_id, array_column($res, 'id'));

														// var_dump($found);

														if ($found !== false) { // IF found
															echo "Your Response has already been received! Please wait for admin to revert!";
														} else {
															
															$res[$i]['id']   = $photographer_id;
															$res[$i]['name'] = get_the_title($photographer_id);
															$res[$i]['time'] = $currentDateTime->format('m/d/Y g:i A');

															echo "Thank you! Your Response has been received";
														}

													} else {

														$res = array();
														$res[0]['id']   = $photographer_id;
														$res[0]['name'] = get_the_title($photographer_id);
														$res[0]['time'] = $currentDateTime->format('m/d/Y g:i A');

														 echo "Thank you! Your Response has been received";
													
													}

													 $wpdb->query( $wpdb->prepare(
													    "UPDATE tvl_travelt_booking set response = '%s' WHERE booking_id = '%d'",
													    array(
													        json_encode($res),
													        $booking_id
													    )
													));

													

												}

	                        				 	
	                        				 } else {
	                        				 	echo "Status: Invalid.";
	                        				 }

	                        			} else {
	                        				echo "Status: Invalid.";
	                        			}

	                        		

	                        		elseif( isset($_GET['booking']) && $_GET['booking'] === 'success' && isset($_GET['bid']) ):

	                        			echo 'Your Booking Request submitted successfully.';
										// die();

	                        		else:

	                        			wp_redirect( home_url() );
										die();

	                        		endif; ?>

	                                
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </section>


<?php
// get_sidebar();
get_footer();
