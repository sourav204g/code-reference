<?php
/**
 * Template Name: Booking Confirmation Page
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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'inc/vendor/autoload.php';

require 'vendor/autoload.php';
use \Mailjet\Resources;

// var_dump($_POST);
// var_dump($_SESSION['hnd_product_post_values']);
// var_dump($_SESSION['hnd_pro_details']);
// var_dump($_SESSION['hnd_zipcode']);
// var_dump($_SESSION['hnd_post_values']);
// var_dump($_SESSION['hnd_options']);
// var_dump($_SESSION['hnd_suboptions']);
// var_dump($_SESSION['all_service_setup']);
// var_dump($_SESSION['hnd_suboptions_values']);
// var_dump($_SESSION['cart_item_total']);

// var_dump($_SESSION['cart_item_total']);
// var_dump($_SESSION['cart_product_item_total']);
// var_dump($_SESSION['hour_price']);
// var_dump($_SESSION['asso_labour_min']);
// var_dump(get_field('pro_premium', $_SESSION['hnd_pro_details']['hndy_pro_id']));
// exit;

// hnd_options
// hnd_suboptions
// hnd_suboptions_values

/* $serialize = base64_encode(serialize($_SESSION['all_service_setup']));
echo '_______';
var_dump(unserialize(base64_decode($serialize)));
exit; */

get_template_part( 'template-parts/content', 'email-templates' );

function handyman_booking_details() {

		if ( !isset( $_POST['handyman_pro_nonce_xx'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce_xx'], 'avengers_infinity_war_endgame' ) ) {

				die( 'Failed security check' );

		} else {

                // echo '<pre>';
                // var_dump($_SESSION['cart_item_total_min']);
                // exit;

                // hnd_product_options
                // hnd_product_suboptions
                // all_product_setup - done
                // hnd_product_suboptions_values

                $hnd_totalmin = 0;
                if (isset($_SESSION['cart_product_item_total_min'])) {
                    foreach ( $_SESSION['cart_product_item_total_min'] as $key => $pMinute ) {
                        $hnd_totalmin += $pMinute;
                    }
                }

                // echo '<pre>';
                // var_dump($_SESSION['cart_item_total_min']);
                // exit;

                if (isset($_SESSION['cart_item_total_min'])) {
                    foreach ( $_SESSION['cart_item_total_min'] as $key => $sMinute ) {
                        $hnd_totalmin += $sMinute;
                    }
                }


                $hour_price                         = (float) $_SESSION['hour_price'];
                $scheduled_address                  = array_map("strip_tags", $_POST);

                // var_dump($scheduled_address);
                // exit;

                $customer_phone                     = sanitize_text_field($scheduled_address['hnd_customer_phone']);
                $customer_email                     = sanitize_email($scheduled_address['hnd_customer_email']);
                $scheduled_zipcode                  = sanitize_text_field($scheduled_address['hnd_customer_zipcode']);

                $serialized_scheduled_address       = base64_encode(serialize($scheduled_address));

                $handyman_id                        = (int) sanitize_text_field($_SESSION['hnd_pro_details']['hndy_pro_id']);

                // echo "<pre>";
                // var_dump($scheduled_address['hnd_manage_my_project']);
                // exit;

                if ( isset($_SESSION['hnd_pro_details']['hndynoscedule']) ) {
                   $noschedule = true;
                } else {
                    $noschedule = false;
                }


                if ( isset($scheduled_address['hnd_manage_my_project']) ) {
                   $managemyproject = true;
                } else {
                    $managemyproject = false;
                }

                // var_dump($_SESSION['hnd_pro_details']);
                // exit;
                
                $scheduled_date                     = sanitize_text_field($_SESSION['hnd_pro_details']['hndy_schedule_date']);
                $scheduled_date                     = substr( $scheduled_date, 4, 11 );

                $scheduled_date_db                  = $scheduled_date = strtotime($scheduled_date);
                $scheduled_date                     = date('m/d/Y', $scheduled_date);


                $scheduled_date_db                  = date('Y-m-d', $scheduled_date_db);


                $scheduled_arrival_time             = sanitize_text_field($_SESSION['hnd_pro_details']['hndy_schedule_time']);

                $configured_setup                   = isset( $_SESSION['all_service_setup'] ) ? (array) $_SESSION['all_service_setup'] : '';

                $all_product_setup                   = isset( $_SESSION['all_product_setup'] ) ? (array) $_SESSION['all_product_setup'] : '';


                // not sure what is $data? didn't get time to check also.
                $data       = $_SESSION['handymn_upload_image'];    
                
                // not sure what is $insertedimg? didn't get time to check also.
                $insertedimg = $_SESSION['handymn_insert_image']; 

                $get_values_img = $_SESSION['hnd_post_values'];   

                // echo '<pre>';
                // var_dump($get_values_img);
                // exit;

                $getimgdata = array();

                foreach ($get_values_img as $key => $loopvalue) {

                    $insertddata[$key]['id'] = $loopvalue['handymn_service_id'];

                    if (isset($loopvalue['handymn_insert_image']) && isset($loopvalue['handymn_show_image']) && $loopvalue['handymn_insert_image'][0] !== '') {

                        define( 'UPLOAD_DIR', 'wp-content/themes/handyman_pro/assets/images/uploads/' );
                        
                        foreach ($loopvalue['handymn_insert_image'] as $key1 => $handymn_insert_image) {

                            $imagename = $handymn_insert_image;
                            
                            if(!empty($imagename)){
                                
                                $data = base64_decode($imagename);

                                $basename=uniqid();
                                $file = UPLOAD_DIR . $basename . '.png';
                                $success=file_put_contents($file, $data);
                                $insertimg=    $basename.'.png';

                                $insertddata[$key]['image'][$key1] = $insertimg;

                            }


                        } // foreach

                        
                    } else {

                        $insertddata[$key]['image'][0] = $loopvalue['handymn_service_featured_img'];
                    }                    


                } // foreach

                // echo '<pre>';
                // var_dump( $insertddata);
                // exit;

                $getimgdata = serialize($insertddata);


                $selected_service                   = isset( $_SESSION['hnd_post_values'] ) ? (array) $_SESSION['hnd_post_values'] : '';
                $selected_product                   = isset( $_SESSION['hnd_product_post_values'] ) ? (array) $_SESSION['hnd_product_post_values'] : '';

                $hnd_options                        = isset( $_SESSION['hnd_options'] ) ? (array) $_SESSION['hnd_options'] : '';
                $hnd_suboptions                     = isset( $_SESSION['hnd_suboptions'] ) ? (array) $_SESSION['hnd_suboptions'] : '';
                $hnd_suboptions_values              = isset( $_SESSION['hnd_suboptions_values'] ) ? (array) $_SESSION['hnd_suboptions_values'] : '';


                $hnd_product_options                        = isset( $_SESSION['hnd_product_options'] ) ? (array) $_SESSION['hnd_product_options'] : '';
                $hnd_product_suboptions                     = isset( $_SESSION['hnd_product_suboptions'] ) ? (array) $_SESSION['hnd_product_suboptions'] : '';
                $hnd_product_suboptions_values              = isset( $_SESSION['hnd_product_suboptions_values'] ) ? (array) $_SESSION['hnd_product_suboptions_values'] : '';


                $service_prices                     = isset( $_SESSION['cart_item_total'] ) ? (array) $_SESSION['cart_item_total'] : '';
                $product_prices                     = isset( $_SESSION['cart_product_item_total'] ) ? (array) $_SESSION['cart_product_item_total'] : '';

                $asso_labour_min                    = isset( $_SESSION['asso_labour_min'] ) ? (array) $_SESSION['asso_labour_min'] : '';

                $handyman_premium                   = (int) get_field('pro_premium', $_SESSION['hnd_pro_details']['hndy_pro_id']);


                if ($asso_labour_min !== '') {
                    $serialized_asso_labour_min        = base64_encode(serialize($asso_labour_min));
                } else {
                    $serialized_asso_labour_min        = '';
                }


                if ($service_prices !== '') {
                    $serialized_service_prices        = base64_encode(serialize($service_prices));
                } else {
                    $serialized_service_prices        = '';
                }

                if ($product_prices !== '') {
                    $serialized_product_prices        = base64_encode(serialize($product_prices));
                } else {
                    $serialized_product_prices        = '';
                }

                if ($hnd_options !== '') {
                    $serialized_hnd_options        = base64_encode(serialize($hnd_options));
                } else {
                    $serialized_hnd_options        = '';
                }

                if ($hnd_suboptions !== '') {
                    $serialized_hnd_suboptions        = base64_encode(serialize($hnd_suboptions));
                } else {
                    $serialized_hnd_suboptions        = '';
                }

                if ($hnd_suboptions_values !== '') {
                    $serialized_hnd_suboptions_values        = base64_encode(serialize($hnd_suboptions_values));
                } else {
                    $serialized_hnd_suboptions_values        = '';
                }

                if ($hnd_product_options !== '') {
                    $serialized_product_options        = base64_encode(serialize($hnd_product_options));
                } else {
                    $serialized_product_options        = '';
                }

                if ($hnd_product_suboptions !== '') {
                    $serialized_hnd_product_suboptions        = base64_encode(serialize($hnd_product_suboptions));
                } else {
                    $serialized_hnd_product_suboptions        = '';
                }

                if ($hnd_product_suboptions_values !== '') {
                    $serialized_hnd_product_suboptions_values        = base64_encode(serialize($hnd_product_suboptions_values));
                } else {
                    $serialized_hnd_product_suboptions_values        = '';
                }

                if ($configured_setup !== '') {
                    $serialized_configured_setup        = base64_encode(serialize($configured_setup));
                } else {
                    $serialized_configured_setup        = '';
                }

                if ($all_product_setup !== '') {
                    $serialized_all_product_setup        = base64_encode(serialize($all_product_setup));
                } else {
                    $serialized_all_product_setup        = '';
                }

                if ($selected_service !== '') {
                        $serialized_selected_service        = base64_encode(serialize($selected_service));
                } else {
                        $serialized_selected_service        = '';
                }

                if ($selected_product !== '') {
                        $serialized_selected_product        = base64_encode(serialize($selected_product));
                } else {
                        $serialized_selected_product        = '';
                }

                // CONTINUE FROM HERE - PENDING
                $booking_id = wp_insert_post( array (
                    'post_type' => 'bookings',
                    'post_title' => date('F j, Y', strtotime($scheduled_date)),
                    'post_content' => '',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                ));


                global $wpdb;

                $errorCode = $wpdb->query( $wpdb->prepare(
                            "INSERT ignore INTO hxp_handyman_booking ( booking_id, configured_setup, selected_service, selected_product, hnd_options, hnd_suboptions, hnd_suboptions_values, hour_price, service_prices, product_prices, asso_labour_min, handyman_id, handyman_premium, scheduled_date, scheduled_arrival_time, customer_phone, customer_email, scheduled_address, scheduled_zipcode, booking_status, total_labour_mins, uploadedimage, hnd_product_options, hnd_product_suboptions, hnd_product_suboptions_values, all_product_setup ) VALUES ( %d, %s, %s, %s, %s, %s, %s, %f, %s, %s, %s, %d, %d, %s, %s, %s, %s, %s, %s, %s, %d, %s, %s, %s, %s, %s )",
                            array(
                                    $booking_id,
                                    $serialized_configured_setup,
                                    $serialized_selected_service,
                                    $serialized_selected_product,
                                    $serialized_hnd_options,
                                    $serialized_hnd_suboptions,
                                    $serialized_hnd_suboptions_values,
                                    $hour_price,
                                    $serialized_service_prices,
                                    $serialized_product_prices,
                                    $serialized_asso_labour_min,
                                    $handyman_id,
                                    $handyman_premium,
                                    $scheduled_date_db,
                                    $scheduled_arrival_time,
                                    $customer_phone,
                                    $customer_email,
                                    $serialized_scheduled_address,
                                    $scheduled_zipcode,
                                    'received',
                                    $hnd_totalmin,
                                    $getimgdata,
                                    $serialized_product_options,
                                    $serialized_hnd_product_suboptions,
                                    $serialized_hnd_product_suboptions_values,
                                    $serialized_all_product_setup
                            )
                        ) );


                if( !$errorCode ) {
                    echo 'Error: Duplicate Entry.';
                    die();
                }

                if($booking_id) {  

                    // Calling the rest API
                    $url = 'http://fn-calendarsyncer.azurewebsites.net/api/SyncToProTrack/' . $booking_id;
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);

                    $headers = array(
                        // 'Content-type: application/json',
                        'x-functions-key: wXsBHlE6BQE0K4WEy/r5MnOk0aE4V0HTXaBRp5qjTHtn2zNeO3vVYA==',
                    );

                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($ch);

                    if ($e = curl_error($ch)) {
                        $restAPIResponse = $e;
                    } else {
                        $restAPIResponse = $response; // json_decode( $response )
                    }

                    curl_close($ch);

                    // REST API Response
                    update_field( 'restapi_response', $restAPIResponse , $booking_id);

                    
                    update_field( 'hnd_booking_status', 'received' , $booking_id); // Update Booking Status

                    update_field( 'booking_customer_full_name', $scheduled_address['hnd_customer_name'] , $booking_id); 
                    update_field( 'booking_customer_email_address', $customer_email , $booking_id); 
                    update_field( 'booking_customer_phone_no', $customer_phone , $booking_id); 
                    update_field( 'booking_cutomer_address', $scheduled_address['hnd_customer_address'] , $booking_id); 
                    update_field( 'booking_cutomer_city', $scheduled_address['hnd_customer_city'] , $booking_id); 
                    update_field( 'booking_cutomer_state', $scheduled_address['hnd_customer_state'] , $booking_id); 
                    update_field( 'booking_cutomer_zipcode', $scheduled_zipcode , $booking_id); 

                    update_field( 'hnd_schedule_handyman', $handyman_id , $booking_id);
                    update_field( 'hnd_schedule_date', $scheduled_date , $booking_id); 
                    update_field( 'hnd_schedule_arrival_time', $scheduled_arrival_time , $booking_id); 
                }

                // Empty Sessions
                unset($_SESSION['hnd_post_values']);
                unset($_SESSION['hnd_options']);
                unset($_SESSION['hnd_suboptions']);
                unset($_SESSION['all_service_setup']);
                unset($_SESSION['hnd_suboptions_values']);
                unset($_SESSION['cart_item_total']);

                unset($_SESSION['cart_product_item_total']);
                unset($_SESSION['hnd_product_post_values']);
                unset($_SESSION['asso_labour_min']);

                unset($_SESSION['hnd_zipcode']);
                unset($_SESSION['hnd_pro_details']);
                unset($_SESSION['hour_price']);

                unset($_SESSION['all_product_setup']);
                unset($_SESSION['hnd_product_options']);
                unset($_SESSION['hnd_product_suboptions']);
                unset($_SESSION['hnd_product_suboptions_values']);

                // var_dump($_SESSION);
                // exit;

                if (!$_SESSION['custom_scheduling']) {
                   // send email:
                    // booking_confirmation_email( $scheduled_address['hnd_customer_name'], $customer_email, $booking_id, get_permalink( $booking_id ), $scheduled_date, $scheduled_arrival_time, $handyman_id );


                    booking_confirmation_emailJET( $scheduled_address['hnd_customer_name'], $customer_email, $booking_id, get_permalink( $booking_id ), $scheduled_date, $scheduled_arrival_time, $handyman_id, $noschedule, $managemyproject );



                } else {

                    booking_confirmation_emailJET( $scheduled_address['hnd_customer_name'], $customer_email, $booking_id, get_permalink( $booking_id ), null , null, $handyman_id, $noschedule, $managemyproject );

                    // booking_confirmation_email( $scheduled_address['hnd_customer_name'], $customer_email, $booking_id, get_permalink( $booking_id ), null , null, $handyman_id );

                    unset($_SESSION['custom_scheduling']);
                }

                wp_redirect( get_permalink( $booking_id ));
                exit;
				
		}

}

if( $_POST && isset($_POST['hnd_customer_submit']) ) {
		handyman_booking_details();
}


/* 
	// ADD THE FORM INPUT TO $new_post ARRAY
    $new_post = array(
    'post_title'    =>   $title,
    'post_content'  =>   $description,
    'post_category' =>   array($_POST['cat']),  // Usable for custom taxonomies too
    'tags_input'    =>   array($tags),
    'post_status'   =>   'publish',           // Choose: publish, preview, future, draft, etc.
    'post_type' =>   'post',  //'post',page' or use a custom post type if you want to

    );
 
    //SAVE THE POST
    $pid = wp_insert_post($new_post);
 
    //SET OUR TAGS UP PROPERLY
    wp_set_post_tags($pid, $_POST['post_tags']);

    //REDIRECT TO THE NEW POST ON SAVE
    if ($pid) {
        $link = get_permalink( $pid );
        wp_redirect( $link );
        exit();
    }

*/

/* get_template_part( 'template-parts/content', 'email-templates' ); */

function changeTimeFormat($bookingslot) {

    $timeqx = explode(' - ', $bookingslot);
    $newFormat = array();

    foreach ($timeqx as $key => $qx) {
       $q = explode(' ', $qx);
       $newFormat[] = date("h:i a", strtotime( $q[0] ));
    }
    
    return implode(' - ', $newFormat);

}

/* function  booking_confirmation_email( $customer_name, $customer_email, $bookingID, $url_link, $scheduled_date, $scheduled_arrival_time, $handyman_id  ) {

				// USER 
                $subject     = 'Booking ID - ' . $bookingID;
                $contactname = 'Handyman Pro';
                // $email_body  = $url_link; // mail_template__handyman(); // email_template__user()
                $contactemail = 'handyman@handymanproservices.com';

                $email_body = '';
                $email_body .= 'Dear ' . $customer_name . ', <br><br>';
                // $email_body .= 'Thank you for your home project request with Handyman Pros ' . get_field('pros_first_name', $handyman_id) . ' ' . get_field('pros_last_name', $handyman_id) . '.<br><br>A representive will be in touch within 24 hours to arrange a job date for you. For quicker scheduling please call Handyman Pros at (847) 726-1061.<br><br>';

                if ( $scheduled_date !== null &&  $scheduled_arrival_time !== null ) {

                     $email_body .= 'Thank you for your project request with Handyman Pros. Your job is on ' . $scheduled_date . ' starting between ' . changeTimeFormat($scheduled_arrival_time) . ' with ' . get_field('pros_first_name', $handyman_id) . ' ' . get_field('pros_last_name', $handyman_id) . '.<br><br>';

                } else {

                    $email_body .= 'Thank you for your project request with Handyman Pros. Technician ' . get_post($handyman_id)->post_title . ' will be contacting you within 24 hours.<br><br>';

                }

                $email_body .= 'To review the job details, please click here <a href="' . $url_link . '" target="_blank">Job Detail</a>.<br><br>';
                $email_body .= 'Sincerely, <br><br>';
                $email_body .= 'Handyman Pros';

                try {

                    $mailU = new PHPMailer(true);
                   
                    //Server settings
                    // $mailU->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                    $mailU->isSMTP();                                            // Send using SMTP
                    $mailU->Host       = 'email-smtp.ap-south-1.amazonaws.com';  // Set the SMTP server to send through
                    $mailU->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mailU->Username   = 'AKIAVGIJQ6OJDWPJC4NS';                       // SMTP username
                    $mailU->Password   = 'BEdkfw33v8bxmgrr3ueQui248l+LhuuS2EIUbOQLfs0P';                   // SMTP password
                    $mailU->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mailU->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mailU->setFrom('noreply@odhotels.in', $contactname);
                    $mailU->addAddress($customer_email, $customer_name);  // Add a recipient
                    $mailU->addReplyTo($contactemail, 'Handyman Pro');

                    // Attachments
                    // $mailU->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    // $mailU->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    // Content
                    $mailU->isHTML(true);    // Set email format to HTML
                    $mailU->Subject = $subject;
                    $mailU->Body    = $email_body;

                    $mailU->send();
                    // echo 'Message has been sent';

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mailU->ErrorInfo}";
                }

                // HANDYMEN
                $subject_handyman     = 'Handyman Job Request | Booking ID - ' . $bookingID;
                $contactname_handyman = 'Handyman Pro';
                // $email_body_handyman  = email_template_booking_details($bookingID); // email_template__user()

                $email_body_handyman  = '';
                $email_body_handyman  .= 'Hi ' . get_field('pros_first_name', $handyman_id) . ' ' . get_field('pros_last_name', $handyman_id) . ',<br><br>';

                $email_body_handyman  .= $customer_name . ' has submitted a job request on the website.<br><br>';

                // $email_body_handyman  .= $customer_name . ' has submitted a job request on the website. Please call ' . $customer_name . ' to schedule a job date.<br><br>';

                $email_body_handyman .= 'To review the job details, please click here <a href="' . $url_link . '" target="_blank">Job Detail</a>.<br><br>';


                try {

                    $mailH = new PHPMailer(true);
                   
                    //Server settings
                    // $mailH->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                    $mailH->isSMTP();                                            // Send using SMTP
                    $mailH->Host       = 'email-smtp.ap-south-1.amazonaws.com';  // Set the SMTP server to send through
                    $mailH->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mailH->Username   = 'AKIAVGIJQ6OJDWPJC4NS';                       // SMTP username
                    $mailH->Password   = 'BEdkfw33v8bxmgrr3ueQui248l+LhuuS2EIUbOQLfs0P';                   // SMTP password
                    $mailH->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mailH->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mailH->setFrom('noreply@odhotels.in', $contactname_handyman);

                    // $mailH->addAddress('sourav.seoinfotechsolution@gmail.com', get_field('pros_first_name', $handyman_id));  

                    // Add a recipient
                    $mailH->addAddress(get_field('pro_email', $handyman_id), get_field('pros_first_name', $handyman_id));  
                    $mailH->addAddress('sourav.seoinfotechsolution@gmail.com', $contactname_handyman); // handyman@handymanproservices.com

                    $mailH->addReplyTo($customer_email, 'Handyman Pro');

                    // Attachments
                    // $mailH->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    // $mailH->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    // Content
                    $mailH->isHTML(true);    // Set email format to HTML
                    $mailH->Subject = $subject_handyman;
                    $mailH->Body    = $email_body_handyman;

                    $mailH->send();
                    // echo 'Message has been sent';

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mailH->ErrorInfo}";
                }
} */

function  booking_confirmation_emailJET( $customer_name, $customer_email, $bookingID, $url_link, $scheduled_date, $scheduled_arrival_time, $handyman_id, $noschedule, $managemyproject ) {

                // USER 
                $subject     = 'Booking ID - ' . $bookingID;
                $contactname = 'Handyman Pro';
                // $email_body  = $url_link; // mail_template__handyman(); // email_template__user()
                $contactemail = 'handyman@handymanproservices.com';

                $email_body = '';
                $email_body .= 'Dear ' . $customer_name . ', <br><br>';
                // $email_body .= 'Thank you for your home project request with Handyman Pros ' . get_field('pros_first_name', $handyman_id) . ' ' . get_field('pros_last_name', $handyman_id) . '.<br><br>A representive will be in touch within 24 hours to arrange a job date for you. For quicker scheduling please call Handyman Pros at (847) 726-1061.<br><br>';

                if ( $scheduled_date !== null &&  $scheduled_arrival_time !== null ) {

                     if ($noschedule) { // IF noschedule is true.

                        $email_body .= 'Thank you for your home project request with ' . get_post($handyman_id)->post_title . ', ' . get_field('pros_first_name', $handyman_id) . ' will get in touch with you within 24 hours to arrange a job date for you. For quicker scheduling please call Handyman Pros at (847) 726-1061<br><br>';

                    } else {

                        if ($managemyproject) {

                            $email_body .= 'Thank you for your project request with Handyman Pros. Your personal project manager will get in touch with you within 24 hours to arrange a job date for you.<br><br>';
                            
                        } else {
                            $email_body .= 'Thank you for your project request with Handyman Pros. Your job is on ' . $scheduled_date . ' starting between ' . changeTimeFormat($scheduled_arrival_time) . ' with ' . get_field('pros_first_name', $handyman_id) . ' ' . get_field('pros_last_name', $handyman_id) . '.<br><br>'; 
                        }

                                       
                    }

                } else {

                    $email_body .= 'Thank you for your project request with Handyman Pros. Technician ' . get_post($handyman_id)->post_title . ' will be contacting you within 24 hours.<br><br>';

                }

                $email_body .= 'To review the job details, please click here <a href="' . $url_link . '" target="_blank">Job Detail</a>.<br><br>';
                $email_body .= 'Sincerely, <br><br>';
                $email_body .= 'Handyman Pros';

                $mj = new \Mailjet\Client('6d82e174bf1cb383c2db46d759983e2b','eb3c1c3fc1eda3cc563edafca794fa17',true,['version' => 'v3.1']);

                try {

                    $body = [
                      'Messages' => [
                        [
                          'From' => [
                            'Email' => "noreply@handymanproservices.com",
                            'Name' => $contactname
                          ],
                          'To' => [
                            [
                              'Email' => $customer_email,
                              'Name' => $customer_name
                            ]
                          ],
                          'Subject' => $subject,
                          // 'TextPart' => "My first Mailjet email",
                          'HTMLPart' => $email_body,
                          'CustomID' => "AppGettingStartedTest"
                        ]
                      ]
                    ];

                    $response = $mj->post(Resources::$Email, ['body' => $body]);
                    // $response->success() && var_dump($response->getData());
                    $response->success();

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mailU->ErrorInfo}";
                }

                // HANDYMEN
                $subject_handyman     = 'Handyman Job Request | Booking ID - ' . $bookingID;
                $contactname_handyman = 'Handyman Pro';
                // $email_body_handyman  = email_template_booking_details($bookingID); // email_template__user()

                $email_body_handyman  = '';
                $email_body_handyman  .= 'Dear ' . get_field('pros_first_name', $handyman_id) . ' ' . get_field('pros_last_name', $handyman_id) . ',<br><br>';


                if ( $scheduled_date !== null &&  $scheduled_arrival_time !== null ) {

                     if ($noschedule) { // IF noschedule is true.

                        $email_body_handyman  .= 'Customer ' . $customer_name . ' has submitted a job request, you must get in touch with customer within 24 hours to arrange schedule date.<br><br>';

                        $email_body_handyman .= 'To review the job details, please click here <a href="' . $url_link . '" target="_blank">Job Detail</a>.<br><br>';

                    } else {

                        $dt = strtotime($scheduled_date);
                        $dt = date("l F d, Y", $dt);

                        $email_body_handyman  .= 'Customer ' . $customer_name . ' has scheduled a job with you for ' . $dt . ' with arrival time between ' . changeTimeFormat($scheduled_arrival_time) . '.<br><br>';

                        $email_body_handyman .= 'To review the job details, please click here <a href="' . $url_link . '" target="_blank">Job Detail</a>.<br><br>';
                    }

                } else {

                    $email_body_handyman  .= 'Customer ' . $customer_name . ' has submitted a job request (it is more than 8 hours job), you must get in touch with customer within 24 hours to arrange schedule date.<br><br>';

                    $email_body_handyman .= 'To review the job details, please click here <a href="' . $url_link . '" target="_blank">Job Detail</a>.<br><br>';

                }

                try {

                    $body = [
                      'Messages' => [
                        [
                          'From' => [
                            'Email' => "noreply@handymanproservices.com",
                            'Name' => $contactname_handyman
                          ],
                          'To' => [
                            [
                              'Email' => get_field('pro_email', $handyman_id),
                              'Name' => get_field('pros_first_name', $handyman_id)
                            ],
                            [
                              'Email' => 'sourav.seoinfotechsolution@gmail.com',
                              'Name' => 'Sourav'
                            ]
                          ],
                          'Subject' => $subject_handyman,
                          // 'TextPart' => "My first Mailjet email",
                          'HTMLPart' => $email_body_handyman,
                          'CustomID' => "AppGettingStartedTest"
                        ]
                      ]
                    ];

                    $response = $mj->post(Resources::$Email, ['body' => $body]);
                    // $response->success() && var_dump($response->getData());

                    $response->success();

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mailH->ErrorInfo}";
                }


                // ADMIN
                $subject_admin     = 'Handyman Job Request | Booking ID - ' . $bookingID;
                $contactname_admin = 'Handyman Pro';
                // $email_body_admin  = email_template_booking_details($bookingID); // email_template__user()

                $email_body_admin  = '';
                $email_body_admin  .= 'Dear Handyman Pros,<br><br>';


                if ( $scheduled_date !== null &&  $scheduled_arrival_time !== null ) {

                     if ($noschedule) { // IF noschedule is true.

                        $email_body_admin  .= 'Customer ' . $customer_name . ' has submitted a job request on the website with ' . get_post($handyman_id)->post_title . ' that has no schedule posted, please make sure the handyman ' . get_post($handyman_id)->post_title . ' or Handyman Pros contact customer within 24 hours to arrange a scheduling date.<br><br>';

                        $email_body_admin .= 'To review the job details, please click here <a href="' . $url_link . '" target="_blank">Job Detail</a>.<br><br>';

                    } else {

                        if ($managemyproject) {

                            $email_body_admin  .= 'Customer ' . $customer_name . ' has requested a personal project manager for this job, please make sure to contact customer within 24 hours to arrange a scheduling date.<br><br>';

                        } else {

                            $dt = strtotime($scheduled_date);
                            $dt = date("l F d, Y", $dt);

                            $email_body_admin  .= 'Customer ' . $customer_name . ' has scheduled a job with ' . get_post($handyman_id)->post_title .  ' for ' . $dt . ' with arrival time between ' . changeTimeFormat($scheduled_arrival_time) . '.<br><br>';

                        }

                        

                        $email_body_admin .= 'To review the job details, please click here <a href="' . $url_link . '" target="_blank">Job Detail</a>.<br><br>';
                    }

                } else {

                    $email_body_admin  .= 'Customer ' . $customer_name . ' has submitted a job request (it is more than 8 hours job) on the website with ' . get_post($handyman_id)->post_title . ', please make sure the handyman ' . get_post($handyman_id)->post_title . ' or Handyman Pros contact customer within 24 hours to arrange a scheduling date.<br><br>';

                    $email_body_admin .= 'To review the job details, please click here <a href="' . $url_link . '" target="_blank">Job Detail</a>.<br><br>';

                }

                try {

                    $body = [
                      'Messages' => [
                        [
                          'From' => [
                            'Email' => "noreply@handymanproservices.com",
                            'Name' => $contactname_admin
                          ],
                          'To' => [
                            [
                              'Email' => 'sourav.seoinfotechsolution@gmail.com',
                              'Name' => 'Sourav'
                            ],
                            [
                              'Email' => 'handyman@handymanproservices.com',
                              'Name' => $contactname_admin
                            ]
                          ],
                          'Subject' => $subject_admin,
                          // 'TextPart' => "My first Mailjet email",
                          'HTMLPart' => $email_body_admin,
                          'CustomID' => "AppGettingStartedTest"
                        ]
                      ]
                    ];

                    $response = $mj->post(Resources::$Email, ['body' => $body]);
                    // $response->success() && var_dump($response->getData());

                    $response->success();

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mailH->ErrorInfo}";
                }


}

get_header(); ?>

	<style>
		.text89.thank-you-text { line-height: 30px; }
	</style>

	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>

	<section>

		<div class="block less-top">

			<div class="container">
				<div class="row">
					<div class="col-md-12 mt-crt30">
						<div class="simple-text22">
							<h3>THANK YOU</h3><span class="text89 thank-you-text">We have received your message and would like to thank you for writing to us. If your inquiry is urgent, please use the telephone number listed below to talk to one of our staff members. Otherwise, We're here to help.<br>
							Check out our FAQs, send us an email or call us at 1 (800) 555-5555.<br>
							Talk to you soon,</span>
							<div class="clearfix"></div>
						</div>
					</div>

				</div>
			</div>

		</div>

	</section>


<?php
get_footer();