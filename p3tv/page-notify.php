<?php
/**
 * Template Name: Notify
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

/* 
 * Read POST data 
 * reading posted data directly from $_POST causes serialization 
 * issues with array data in POST. 
 * Reading raw POST data from input stream instead. 
 */   

$raw_post_data = file_get_contents('php://input'); 
$raw_post_array = explode('&', $raw_post_data); 
$myPost = array(); 
foreach ($raw_post_array as $keyval) { 
    $keyval = explode ('=', $keyval); 
    if (count($keyval) == 2) 
        $myPost[$keyval[0]] = urldecode($keyval[1]); 
} 
 
// Read the post from PayPal system and add 'cmd' 
$req = 'cmd=_notify-validate'; 
if(function_exists('get_magic_quotes_gpc')) { 
    $get_magic_quotes_exists = true; 
} 
foreach ($myPost as $key => $value) { 
    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
    } else { 
        $value = urlencode($value); 
    } 
    $req .= "&$key=$value"; 
} 
 
/* 
 * Post IPN data back to PayPal to validate the IPN data is genuine 
 * Without this step anyone can fake IPN data 
 */ 
$paypalURL = 'https://www.paypal.com/cgi-bin/webscr'; 
$ch = curl_init($paypalURL); 
if ($ch == FALSE) { 
    return FALSE; 
} 

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $req); 
curl_setopt($ch, CURLOPT_SSLVERSION, 6); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1); 
 
// Set TCP timeout to 30 seconds 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name')); 
$res = curl_exec($ch); 
 
/* 
 * Inspect IPN validation result and act accordingly 
 * Split response headers and payload, a better way for strcmp 
 */  

$tokens = explode("\r\n\r\n", trim($res)); 
$res = trim(end($tokens)); 


if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) { 
     
    // Retrieve transaction info from PayPal 
    $item_number    = (int) $_POST['item_number'];  // Booking ID
    $txn_id         = $_POST['txn_id']; 
    $payment_gross  = $_POST['mc_gross']; // Payment Amount
    $currency_code  = $_POST['mc_currency']; 
    $payment_status = $_POST['payment_status']; 
    $payment_date   = $_POST['payment_date']; 


    // update_field( 'traveltographer_test', 'inserted' , $item_number);


    // DATABASE QUERY - PENDING
     
    // Check if transaction data exists with the same TXN ID 

    global $wpdb;
    
    $prevPayment = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM tvl_travelt_booking WHERE txn_id = %s", array( $txn_id ) ), 'ARRAY_A');
    
    if( $wpdb->num_rows > 0 ){
        
        exit();
    
    } else{

    	// INSERT TO DATABASE
    	$wpdb->query( $wpdb->prepare(
    	    "UPDATE tvl_travelt_booking set payment_status = '%s', txn_id = '%s', amount = '%f', total_paypal_response = '%s', payment_date = '%s' WHERE booking_id = '%d'",
    	    array(
    	        $payment_status,
    	        $txn_id,
    	        $payment_gross,
    	        json_encode($_POST),
    	        $payment_date,
    	        $item_number
    	    )
    	));

        wp_schedule_single_event( time() , 'travelt_cron_hook', array($item_number) );
        die(); 

    } 
 
}


get_header();
?>

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

	                        		<!-- empty -->

	                                
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </section>


<?php
// get_sidebar();
get_footer();
