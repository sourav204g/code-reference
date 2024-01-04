<?php
/**
* Template Name: Handyman Listing Page
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

	require 'vendor/autoload.php';
	use \Mailjet\Resources;

	/* Start - Removing cart items */
	$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
	$per_min_cost = $fetch_hour_price/60;
	session_start();

		$totalmin = 0;

		if (isset($_SESSION['cart_item_total_min']) && !empty($_SESSION['cart_item_total_min']) ) {

			// $totalmin = 0;
			$custom_scheduling = false;

			foreach ($_SESSION['cart_item_total_min'] as $key => $total_min) {
				$totalmin += $total_min;
			}

			if ($totalmin >= 480) { // if 8 hours or more than 8 hours

				$custom_scheduling = true;
				$_SESSION['custom_scheduling'] = $custom_scheduling;
			}

		}

		if (isset($_SESSION['cart_product_item_total_min']) && !empty($_SESSION['cart_product_item_total_min']) ) {

			// $totalmin = 0;
			$custom_scheduling = false;

			foreach ($_SESSION['cart_product_item_total_min'] as $key => $total_min) {
				$totalmin += $total_min;
			}

			if ($totalmin >= 480) { // if 8 hours or more than 8 hours

				$custom_scheduling = true;
				$_SESSION['custom_scheduling'] = $custom_scheduling;
			}

		}


		// var_dump($totalmin);
		// exit;


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

				wp_redirect( home_url( '/handyman-pros/' ) );
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

				wp_redirect( home_url( '/handyman-pros/' ) );
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
				wp_redirect( home_url( '/handyman-pros/' ) );
				exit();
				
			} else {
				unset($_SESSION['hnd_post_values']);
				unset($_SESSION['hnd_options']);
				unset($_SESSION['hnd_suboptions']);
				unset($_SESSION['all_service_setup']);
				unset($_SESSION['hnd_suboptions_values']);
				unset($_SESSION['cart_item_total']);
				unset($_SESSION['cart_item_total_min']);
				wp_redirect( home_url( '/handyman-pros/' ) );
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
				wp_redirect( home_url( '/handyman-pros/' ) );
				exit();
			} // option
			if( $atype === 'suboption' ) {
				$_SESSION['hnd_suboptions'][$item_index][$addon_index] = $_SESSION['hnd_suboptions'][$item_index][$addon_index] . '|deleted';
				wp_redirect( home_url( '/handyman-pros/' ) );
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
				wp_redirect( home_url( '/handyman-pros/' ) );
				exit();
			} // option
			if( $atype === 'suboption' ) {
				$_SESSION['hnd_product_suboptions'][$item_index][$addon_index] = $_SESSION['hnd_product_suboptions'][$item_index][$addon_index] . '|deleted';
				wp_redirect( home_url( '/handyman-pros/' ) );
				exit();
				
			} // suboption
		}

		
/* End - Removing cart items */
if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'waiting_for_avengers_4_trailer' ) ) {
		// wp_redirect( home_url( '/cart/' ) ); // Redirect If cart is empty.
		// die( 'Failed security check' );
} else {
		
		if( !session_id() ) {
			session_start();
		}

		// var_dump($_POST['cdl_zipcode']);
		// exit;
		
		if ( $_POST && isset($_POST['cdl_zipcode']) ) {
			if ( $_POST['cdl_zipcode'] !== '' ) {
				$_SESSION['hnd_zipcode'] = (int) $_POST['cdl_zipcode'];
			} else {
				echo 'Zipcode Missing';
				exit();
			}
			 
		} else {
			wp_redirect( home_url( '/cart/' ) ); // Redirect If cart is empty.
			exit();
		}
		/* $selected_service_IDs = array();
		foreach ( $_SESSION['hnd_post_values'] as $key => $handymn_service ) {
			$service_categories = get_the_terms( $handymn_service['handymn_service_id'], 'service_categories' ); 
			foreach ( $service_categories as $key => $service_category ) {
			  	$selected_service_IDs[] = $service_category->term_id;
			}
		}
		$selected_service_IDs = array_unique($selected_service_IDs); // Logic to display pros based on given skill set. */
							
}


	// Email service_request
	function  service_request( $zipcode ) {

                $contactname = 'Handyman Pro';
                // $email_body  = $url_link; // mail_template__handyman(); // email_template__user()
                $contactemail = 'handyman@handymanproservices.com'; 

                $email_body = '';
                $email_body .= 'Dear admin, <br><br>';
                
                $email_body .= 'A customer has requested for a service in the <strong>'. $zipcode .'</strong> area code.<br><br>';

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
                              'Email' => $contactemail,
                              'Name' => 'Nick'
                            ]
                          ],
                          'Subject' => 'Service Request',
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

                
	}
	
	get_header(); ?>

	

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/page-handyman.css">
	<style type="text/css">

		td.new.day, td.old.day { visibility: hidden; }

		.booking_form { position: relative; }

		.booking_form > .loader {
			display: none;
		    position: absolute;
		    background: #000000a8;
		    left: 0;
		    right: 0;
		    top: 0;
		    bottom: 12px;
		    border-radius: 14px;
		}

		.booking_form > .loader > img {
		    width: 30px;
		    position: relative;
		    top: 49%;
		}

		.hnd-cart-warning {
		    color: #FF5722;
		    margin-bottom: 30px;
		}

		.hnd-cart-warning b {
		    font-weight: bold;
		}

		#hidebuttons {
			display: flex;
			    justify-content: center;
			    position: relative;
			    top: -10px;
		}

.displayDate {
    position: relative;
    color: white;
    font-size: 14px;
    background: black;
    display: inline-block;
    padding: 7px 16px;
    margin-top: 30px;
}

		.no-schedule-msg {
			display: none;
		    width: 40%;
		    text-align: left;
		    margin: 0 auto;
		    margin-top: 40px;
		    margin-bottom: 30px;
		    background: aliceblue;
		    padding: 34px;
		    padding-bottom: 65px;
		    border: 1px solid #323232;
		    text-align: justify;
		    line-height: 24px;
		}

		.no-schedule-msg > strong {
		    color: red;
		    text-transform: uppercase;
		}

/*		.pro-no-schedule .no-schedule-msg { display: block; }*/

		.pro-no-schedule .hndy_schedule_btn, .pro-no-schedule .custom-scheduling { display: none; }

		.loader-pro {
			display: none;
		    position: absolute;
		    z-index: 999;
		    left: 0;
		    right: 0;
		    top: 0;
		    bottom: 0;
		    text-align: center;
		    background: rgb(26 37 48 / 30%);
		    padding-top: 45%;
		}

		.badges-pro{
			margin-top:20px;
		}
		.badges-pro ul li{
			margin-bottom:10px;
		}
		.badges-pro ul li img{
			width: 34px;
		    float: left;
		    margin-right:6px;
		}
		.badges-pro ul li span{
			font-size: 16px;
			font-weight: 600;
			line-height: 34px;
		}
		
	    .rating-dsk-hidden{
	        display:none;
	        margin: 1rem 0 0;
	    }

	    .pro-but2.questions-popup.hndy_schedule_btn { z-index: 0; }
	    
	    @media screen and (max-width: 576px) {

	    .discount-icon { display: none; }

	    .rating-dsk-hidden{
	        display:block;
	    }
	    .rating-mob-hidden{
	        display:none;
	    }
	    .prof-badges-wrapper{
	        margin-bottom:0px;
	    }
        .prof-btn, .sch-btn {
            padding: 10px 0;
            margin: 3px 0;
            height: auto;
            line-height: unset;
            font-size: 15px!important;
            border: none;
        }
        .pro-reviews {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 0 11px;
            padding: 0px 0 10px;
            border-bottom: solid 1px white;
        }
        .pro-reviews .pro-rating {
            margin: 0;
            border: none;
            font-size: 19px!important;
            padding: 0;
        }
        .prof-mob-btn-wrapper {
		    display: flex;
		    flex-direction: column-reverse;
		    max-height: 83px;
		    height: 100vh;
		    justify-content: flex-end;
		    width: 100%;
		}
	   }
	   
	/*1-4-21*/
	
	 .calender-pop-bx {
        background-color: #000;
    }
    .calender-wrapper-row {
        border-radius: 12px;
        position: relative;
        overflow: hidden;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }
    .row.calender-prof-sec {
        width: 90%;
        margin: 2rem auto 1rem;
    }
    .calender-prof-img {
        background: white;
        height: 100%;
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }
    .row.calender-prof-sec h5, .row.calender-prof-sec h3 {
        color: white;
        margin: 9px;
        text-align: left;
    }
	 .calender-left-wrraper {
        background: #425c77;
        border: solid 1px #425c77;
    }
    .calender-pop-bx .booking_form .form-group {
        margin-bottom: 0px;
    }
    .calender-pop-bx .booking_form .datepicker-switch {
        background: transparent;
    }
    .calender-pop-bx .booking_form .prev, .calender-pop-bx .booking_form .next {
        background: transparent;
    }
    .calender-right-wrraper {
        background: white;
        padding: 0 2rem;
    }
    .calender-left-wrraper .booking_summary {
        background: transparent;
    }
    .calender-pop-bx .datepicker table tr th {
        color: white;
        border: none!important;
        text-transform: uppercase;
        padding: 13px 0;
    }
    .calender-pop-bx .datepicker table tr td {
        color: white;
        border:none!important;
        width: 55px;
        height: 55px;
        padding: 17px 0;
        border-radius: 100px;
    }
    .calender-pop-bx .datepicker table tr td.disabled {
        color: #6c839a;
    }
    .calender-pop-bx .datepicker table tr td.day:hover, .calender-pop-bx .datepicker table tr td.day.focused {
        background: #fff;
        color: #425c77;
    }
    .calender-pop-bx .datepicker table tr td.active.day {
        background: #fff!important;
        color: #425c77!important;
    }
    .calender-pop-bx h2.whtext {
        color: #1f1e1e!important;
        text-align: center;
        margin: 15px 0;
        font-size: 25px;
    }
    .calender-pop-bx .days8 {
        width: 100%;
        border: solid 1px #a9a3a3;
        border-radius: 3px;
        padding: 10px;
        color: #616060;
    }
    .calender-pop-bx .days8:hover {
        color: #fff;
    }
.calender-pop-bx p.whtext-approx {
    font-size: 24px;
    color: #1f1e1e;
    margin: 2rem 0 2rem;
    line-height: 30px;
    text-align: center;
    letter-spacing: -0.3px;
}
span.time-pick-txt {
    color: #425c77;
    font-size: 20px;
}

    span.days8 { 
    	pointer-events: none;
    	user-select: none;
    	opacity: 0.5;
    }
    
    /*5-04-21*/
    
    .no-pros-avaiable{
        text-align: center;
        width: 95%;
        margin: auto;
    }
.no-pros-avaiable > strong {
    display: block;
    margin-bottom: 30px;
    line-height: 33px;
    font-size: 24px;
    color: crimson;
    letter-spacing: 0.5px;
    padding: 0 12rem;
}
.no-pros-avaiable p {
    font-size: 17px;
    margin-bottom: 24px;
    line-height: 30px;
    letter-spacing: 0.3px;
}
.no-pros-avaiable .row {
    text-align: left;
    background: #f7f7f7;
    margin: 3rem auto;
    border: solid 3px #eaeaea;
    border-radius: 12px;
    width: 90%;
    position: relative;
    overflow: hidden;
}
.no-pros-avaiable .row .left-sec{
   background: #eaeaea; 
}
.no-pros-avaiable .row .right-sec{
    padding: 3rem 2.5rem 0 4rem;
}
.no-pros-avaiable .left-sec img {
    position: relative;
    top: 2px;
}
.no-pros-avaiable .row a {
    display: table;
    margin: 0.8rem 0;
    background: #3e3e3e;
    padding: 0.8rem;
    width: 95%;
    color: white;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 0.2px;
    border-radius: 2px;
    font-size: 15px;
}
.no-pros-avaiable .row a:hover {
    background: #d29804;
}
.lesstop-custom{
    padding-bottom:0;
}

.custom-scheduling {
    text-align: center;
    width: 80%;
    margin: 0 auto;
    margin-top: 50px;
    margin-bottom: 30px;
    background: var(--gray-dark);
    padding: 35px;
    padding-bottom: 10px;
    box-shadow: -2px 2px 4px 0px rgb(52 58 64 / 20%);
    overflow: hidden;
}

.custom-scheduling > p {
    color: #dc3545;
    font-size: 24px;
    line-height: 30px;
}

button.pro-but2.continue-btn {
    background: #f2ae00;
    font-weight: bold;
    margin-top: 20px;
    margin: 0 auto;
    text-align: center;
    display: block;
}

/*13/10/2021*/

.res-logo.mob-logo-hide {
    display: none!important;
}
.account-popup .close-popup {
    position: absolute;
    width: 45px;
    height: 45px;
    line-height: 44px;
    top: 7px;
    right: 7px;
    background: #425c77;
    z-index: 1;
    border-radius: 0 8px;
    border:solid 1px white;
}
@media screen and (max-width: 576px) {

.calender-prof-img {
    display: none;
}
.calender-wrapper-row {
    width: 100%;
}
.days8 {
    width: 95% !important;
}
.calender-right-wrraper {
    padding: 0 0.5rem;
}

.calender-pop-bx p.whtext-approx {
    font-size: 24px;
    margin: 0rem 0 2rem;
    line-height: 14px;
}
span.time-pick-txt {
    font-size: 18px;
}
.calender-right-wrraper span.calend-total-time {
	font-size: 19px;
    line-height: 28px;
    margin: 0.6rem 0rem 0;
    display: block;
    letter-spacing: -0.8px;
}
.no-pros-avaiable > strong {
    line-height: 28px;
    font-size: 20px;
    padding: 0;
}
}

/*25-11-21*/

.profile-modal-body{
	max-height: unset;
}
button.schedule-btn {
    font-size: 18px !important;
    text-transform: uppercase;
    padding: 12px 20px;
    margin-bottom: 11px;
    background: #343a40;
    width: 100%;
}
button.schedule-btn:focus {
    outline: none;
}
.custom-scheduling {
    display: none;
}
.pro-no-schedule .no-schedule-msg {
    display: none;
}

.custom-scheduling.active, .pro-no-schedule .no-schedule-msg.active{
	display: table;
	color: #555555;
}

td.hnd-certificate, td.hnd-insurance {
    text-transform: capitalize;
}
span.exp-value {
    color: #fca81a;
}
.pro-but1, .pro-but2, .pro-but3 {
    padding: 12px 15px;
    margin-bottom: 11px;
}
.pro-but1:hover {
    background: #028507;
    color: white;
}
.no-sch-btn-wrapper {
    display: flex;
    justify-content: space-between;
}
.no-schedule-msg i.fa-times {
    background: #cd4141;
    width: auto;
    height: 38px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 2px;
    color: #fdfdfd;
    font-size: 17px;
    padding: 5px 12px;
    cursor: pointer;
}
.no-schedule-msg i.fa-times span {
    padding-left: 5px;
}
.no-schedule-msg i.fa-times:hover {
	background: #af3b3b;
}

@media screen and (max-width: 576px) {
    .no-schedule-msg {
		width: 100%;
		padding: 20px 25px;
	}
.pro-but2 {
    font-size: 15px !important;
}
	button.schedule-btn {
    font-size: 15px !important;
    letter-spacing: -0.1px;
}
/*23-2-23*/

.calender-pop-bx .datepicker table tr td {
    width: 29px;
    height: 29px;
    padding: 6px 0;
}
.row.calender-prof-sec {
    margin: 0rem auto 0rem;
    width: 100%;
}
.row.calender-prof-sec h3 {
	margin: 0 0 9px;
    text-align: left;
    font-size: 24px;
}
.account-popup .close-popup {
    width: 35px;
    height: 35px;
    top: 12px;
    right: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.calender-wrapper-row .la-close {
    font-size: 16px;
}
.calender-pop-bx .datepicker table tr th {
    padding: 2px 0 12px;
    font-size: 16px;
    letter-spacing: 0.5px;
}
.calender-pop-bx .datepicker table tr th.dow {
	font-size: 12px;
    letter-spacing: 1px;

}
.displayDate {
    margin-top: 12px;
}
.calender-right-wrraper .mbtlr20 {
    margin: 10px 15px;
}
.datepicker-days .prev, .datepicker-days .next {
    font-size: 20px!important;
}
.calender-prof-sec .col-md-4 {
    margin-bottom: 10px;
}
}

@media print {
         .no-print {display: none;}
      }



.pro-rating .rating { 
  border: none;
  float: left;
  
}

.pro-rating .rating > input { display: none; } 
.pro-rating .rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.pro-rating .rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.pro-rating .rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 

.pro-rating .rating span{
    font-size: 20px !important;
    text-align: center;
    color: #323232;
    font-weight:bold;
   
}
.pro-rating {
    margin-top:15px;
    height: 60px;
}

.pro-rating .rating{
    font-size: 18px !important;
    text-align: center;
    color: #ffaf00;
    padding-bottom: 12px;
    line-height: 50px;
    height: 60px;
     width: 100%;
    
}

.pro-bg2 {
    background: #f2f5f8;
    height: 100%;
    padding: 10px !important;
}
		
	</style>

	<div class="hidden-xs">
		<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
	</div>

	<!-- Cart Sec -->
	<section>
		<div class="block less-top lesstop-custom">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<a data-toggle="collapse" href="#filter" aria-expanded="false" aria-controls="filter">
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
								<div class="cart-head">
									<?php if ( $cartCount > 1 ): ?>
											<h3>( <?php echo $cartCount; ?> Items ) <span class="cart-head-span">..</span></h3>
									<?php else: ?>
											<h3>( <?php echo $cartCount; ?> Item ) <span class="cart-head-span">..</span></h3>
									<?php endif; ?>
									<h4 class="completion-time"></h4>
									<!-- <h4>Completion Time: _ Minutes</h4> -->
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
					<!-- Cart Inner -->
					<div class="collapse filter_bg" id="filter" data-zip="<?php echo $_SESSION['hnd_zipcode']; ?>">
						<div class="container" style="position: relative;">

							<?php 

								if ( isset($_SESSION['hnd_product_post_values']) && !empty($_SESSION['hnd_product_post_values']) || 
									 isset($_SESSION['hnd_post_values']) && !empty($_SESSION['hnd_post_values']) ) {

									 if (!isset($_SESSION['cart3'])) {
										// echo 'SOURAV';
										echo '<script> window.location.href = "' . home_url( '/cart-3/' ) . '"; </script>';
										
									 } else {
										unset($_SESSION['cart3']);
									 }

								}

							$tableitem = 1;

							?>

							<?php include('cart-services.php'); ?>
							<?php include('cart-products.php'); ?>	

						</div>
					</div>
					<!-- Cart Inner -->

					<!-- <div class="col-md-12 print-height"></div> -->

					<div class="hnd-terms container print-hide hnd-cart-warning" style="display: none;">
						<b>Warning: </b> The total amount of this work order falls below our <b>$125.00</b> minimum charge. To take full advantage of this minimum charge of $125.00, please add more items to the cart.
					</div>

					
					
			</div>
		</div>
	</section>
	<!-- Cart Sec -->
	<section class="pro-bg">
		<div class="block less-top mtt30">
			<div class="container" style="display: flex;flex-direction: column-reverse;">
				<?php  
					/*  Logic to display pros based on given skill set. - Uncomment if needed.
					=================================================================== 
						$the_query = new WP_Query(array(
							'post_type' => 'pros',
							'posts_per_page' => -1,
							'tax_query' => array(
									'relation' => 'OR',
									array(
										'taxonomy'         => 'service_categories',
										'field'            => 'id',
										'terms'            => $selected_service_IDs,
										// 'include_children' => true,
										'operator'         => 'IN',
									)
								),
							'post_status' => 'publish',
						)); 
					*/
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
						
						$the_query = new WP_Query(array(
							'post_type' => 'pros',
							'post_status' => 'publish',
							'paged'     => $paged,
							'post_per_page' => -1
						));

						$checkZip = false;
				
				?>

				<?php if ( $the_query->have_posts() ) : $tabID = 0; 

					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					<?php if ( get_field( 'pro_working_zipcodes', $post->ID ) ) : // True, only if Pro has set zipcodes ?>
						
						<?php $zipcodeExist = false; ?>
						
						<?php 	
								// var_dump(!isset($_SESSION['hnd_zipcode'])); exit;
								if (!isset($_SESSION['hnd_zipcode'])) {
									echo '<script> window.location.href = "' . home_url( '/cart/' ) . '"; </script>';
									exit();
								}
						?>
						
						<?php foreach ( get_field( 'pro_working_zipcodes', $post->ID ) as $key => $pro_zipcode ): ?>
							
							<?php if ( $pro_zipcode['pro_zipcode'] == $_SESSION['hnd_zipcode'] ): ?>
	
								 <?php $zipcodeExist = true; ?>
								
							<?php endif; ?>
							
						<?php endforeach; ?>

						<?php if ( $zipcodeExist === true ): // if given zipcode matches ?>
						
						<?php 

							$checkZip = true;

							global $wpdb;

							// $bookingsByProID = $wpdb->get_results( $wpdb->prepare( "SELECT scheduled_date FROM hxp_handyman_booking WHERE handyman_id = %d AND ( booking_status = 'new' OR booking_status = 'received' ) AND scheduled_date >= CURDATE() GROUP BY scheduled_date", array( $post->ID ) ), 'ARRAY_A');

							// echo "<pre>";
							// var_dump($bookingByProID);
							
							$Areviews = $wpdb->get_row( $wpdb->prepare( "SELECT count(*) FROM hxp_richreviews WHERE ( review_rating = %d || review_rating = %d ) AND post_id = %d AND review_status = %d", array( 4, 5, $post->ID, 1 ) ), 'ARRAY_A');

							$Oreviews = $wpdb->get_row( $wpdb->prepare( "SELECT count(*) FROM hxp_richreviews WHERE ( review_rating = %d || review_rating = %d || review_rating = %d ) AND post_id = %d AND review_status = %d", array( 3, 2, 1, $post->ID, 1 ) ), 'ARRAY_A');
							// var_dump($Areviews);

							// var_dump(get_field('pro_dont_show_schedule', $post->ID));

							$noScheduleSelected = get_field('pro_dont_show_schedule', $post->ID);

						?>
																	
						<div class="pro-handy <?php echo $noScheduleSelected ? 'pro-no-schedule' : ''; ?>" style="order:<?php echo $Areviews['count(*)'] ?>">
							<div class="row">
								<?php if (get_the_post_thumbnail_url($post->ID)): ?>
									<?php 
										$thumbnail_id    = get_post_thumbnail_id($post->ID);
                                        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
									?>
									
									<div class="col-5 col-md-2"><img alt="<?php echo $alt; ?>" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" style="width: 100%"></div>
								<?php else: ?>
									<div class="col-5 col-md-2"><img alt="handymanpro" src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/handyman-img01.jpg" style="width: 100%"></div>
									
								<?php endif; ?>
								
								<div class="col-7 col-md-3">
									
									<h2><?php echo get_field('pros_first_name', $post->ID) . ' ' . get_field('pros_last_name', $post->ID)[0]; ?></h2>
									
									<?php $handyman_pro_address = get_field('pro_address_group', $post->ID); ?>
									
									<?php if (  $handyman_pro_address['pro_state'] !== '' ||
												$handyman_pro_address['pro_county'] !== '' ||
												$handyman_pro_address['pro_street'] !== '' ||
												$handyman_pro_address['pro_city'] !== '' ||
												$handyman_pro_address['pro_zipcode'] !== '' ) : ?>
									
									<?php /*<p class="pro-lo"><?php echo $handyman_pro_address['pro_street'] . ', ' . $handyman_pro_address['pro_city'] . ', ' . $handyman_pro_address['pro_county'] . ', ' . $handyman_pro_address['pro_state'] . ', ' . $handyman_pro_address['pro_zipcode']; ?></p> */?>

									<?php endif; ?>

									<?php if (get_field('pro_premium', $post->ID) != 0): ?>			

											<!--<p style="font-size: 14px; font-weight: 600; color:#ea3737; display:none;">
											    <img src="https://seofieddemo.com/handyman/wp-content/themes/handyman_pro/assets/images/discount-coupon.png" style="height: 21px;">
    										<span><?php echo get_field('pro_premium', $post->ID); ?></span>% Higher Price<a data-toggle="modal" href="#higherprice"><i class="fa fa-question" aria-hidden="true" style="font-size: 13px; background:#323232; color: #fff; padding:2px 8px; margin-left: 8px; "></i></a></p>-->
                                            
                                            <p style="font-size: 14px; font-weight: 600; color:#ea3737; ">
											    <img class="discount-icon" src="<?php echo bloginfo( 'stylesheet_directory' ); ?>/assets/images/Discount-icon.png" style="height: 31px; padding-right: 3px; position:relative; top:6px;">
    										<span><span>Extra </span><?php echo get_field('pro_premium', $post->ID); ?></span>% Discount <a data-toggle="modal" href="#extradiscount"><i class="fa fa-question" data-namez="<?php echo ucfirst(get_field('pros_first_name', $post->ID)); ?>" aria-hidden="true" data-discount="<?php echo get_field('pro_premium', $post->ID); ?>" style="font-size: 13px; background:#323232; color: #fff; padding:2px 8px; margin-left: 8px; "></i></a></p>
    										
									<?php endif; ?>

									<div class="pro-handy-bio">
										<?php /*
										  $bio = get_field('pro_bio_about', $post->ID);
                                          $length = 160; // paragraph length
                                          if(strlen($bio) <= $length) { ?>
                                            <p><?php //echo $bio; ?></p>
                                          <?php }
                                          else { 
                                            $small_desc = substr($bio, 0, $length) . '..'; ?>
                                            <p><?php echo trim($small_desc); ?></p>
                                          <?php } 
										?>
										
										<?php // echo get_field('pro_bio_about', $post->ID); */ ?>
											
									</div>

									<?php $selected_pro_categories = get_the_terms($post, 'service_categories'); ?>
									<?php // echo '<pre>'; var_dump($selected_pro_categories); ?>
									<?php /* if ($selected_pro_categories): // Categories ?> 
										<?php foreach ($selected_pro_categories as $key => $selected_pro_category ): ?>
											<button class="pro-exbt"><?php echo $selected_pro_category->name; ?></button>
											
										<?php endforeach; ?>
										
									<?php endif; */ ?>								
								</div>
								
								<!--2 columns repeated here-->
								
								<div class="col-6 col-md-2 rating-dsk-hidden">
									<div class="pro-bg2">
										<div class="pro-rating col-a rating-mob-hidden">
										<div class="rating"> <span>4.8</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-half-o" aria-hidden="true"></i>
   
</div><div class="clearfix"></div>
										</div>
										<div class="pro-reviews">
											(<?php echo $Areviews['count(*)'] ?>) <div class="pro-rating col-a rating-dsk-hidden"> A </div> Reviews
										</div>
										<button class="pro-but3 box1 hxnd-pro-reviews" data-id="<?php echo $post->ID; ?>" type="button" >Reviews</button>
									</div>
								</div>
								
								<div class="col-6 col-md-2 rating-dsk-hidden">
									<?php if (get_field('pro_show_saturday_as_available', $post->ID)): ?>
										<input type="hidden" name="hnd_off_saturday" value='1'>
									<?php else: ?>
										<input type="hidden" name="hnd_off_saturday" value='0'>
										
									<?php endif; ?>
									<?php if (get_field('pro_show_sunday_as_available', $post->ID)): ?>
										<input type="hidden" name="hnd_off_sunday" value='1'>
									<?php else: ?>
										<input type="hidden" name="hnd_off_sunday" value='0'>
										
									<?php endif; ?>
									
									<input type="hidden" name="hnd_timing_x" value='<?php echo json_encode(get_field('pro_schedule_time', $post->ID)); ?>'>
									<input type="hidden" name="hnd_off_dates" value='<?php echo json_encode(get_field('pro_schedule_off_dates', $post->ID)); ?>'>
									<div class="prof-mob-btn-wrapper">
										
										<!-- <a class="pro-but1" href="<?php // echo get_permalink($post->ID); ?>" target="_blank">Profile</a> -->
										<a data-toggle="modal" data-id="<?php echo $post->ID; ?>"  class="open-AddBookDialog btn btn-primary pro-but1 prof-btn" href="#addBookDialog">Profile</a>

										<?php if (!$custom_scheduling): ?>

												<?php if ($noScheduleSelected): ?>

													<button class="schedule-btn">Schedule</button>

												<?php else: ?>

													<button class="pro-but2 questions-popup hndy_schedule_btn" data-pro-id="<?php echo $post->ID; ?>" data-pro-name="<?php echo get_field('pros_first_name', $post->ID) . ' ' . get_field('pros_last_name', $post->ID)[0]; ?>">Schedule</button>
													
												<?php endif; ?>

										<?php else: ?>

											<button class="schedule-btn">Schedule</button>

										<?php endif; ?>

										<?php /* if (!$custom_scheduling): ?>

										<button class="pro-but2 questions-popup hndy_schedule_btn sch-btn" data-pro-id="<?php echo $post->ID; ?>" data-pro-name="<?php echo get_field('pros_first_name', $post->ID) . ' ' . get_field('pros_last_name', $post->ID); ?>">Schedule</button>

										<?php endif; */ ?>

										<div class="clearfix"></div>

										<button class="pro-but3 box1 hxnd-pro-reviews rating-mob-hidden" data-id="<?php echo $post->ID; ?>" type="button" >Reviews</button>
										<!-- <a data-toggle="modal" data-id="<?php // echo $post->ID; ?>"  class="open-ReviewDialog btn pro-but3" href="#reviewdialog">Reviews</a> -->

									</div>
								</div>
								<!--columns repeated end-->
								
								<div class="col-12 col-md-3 prof-badges-wrapper">
									<div class="badges-pro">

									<?php // var_dump(get_field('pro_is_certified', $post->ID)); ?>


									<ul>

										<?php if (get_field('pro_is_certified', $post->ID) == 'yes'): ?>

											<li><img src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/certified-pro-icon.png" /> <span>Certified Pro</span></li>

											
										<?php endif; ?>

										<?php if (get_field('pro_is_awarded', $post->ID) == 'yes'): ?>

											<li><img src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/award-icon.png" /> <span>Super Service Award</span></li>
											
										<?php endif; ?>
										

										<li><img src="<?php bloginfo('template_directory');?>/assets/images/exp-icon.png" /> <span>Experience :</span> <span class="exp-value"> <?php echo get_field('pro_years_of_experience', $post->ID); ?> Years</span></li>

										<?php if (get_field('pro_has_insurance', $post->ID) == 'yes'): ?>

											<li><img src="<?php bloginfo('template_directory');?>/assets/images/insured-ic.png" /> <span>Insured</span></li>
											
										<?php endif; ?>

										<li class="rating-mob-hidden rating-dsk-hidden"><img src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/Discount-icon.png" /> <span>Extra Discount Coupon</span></li>
									</ul>
								</div>
								</div>
								<div class="col-6 col-md-2 rating-mob-hidden">
									<div class="pro-bg2">

										<div class="pro-rating col-a">
										  
									    <div class="rating"> <span>4.8</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-half-o" aria-hidden="true"></i>
   
</div><div class="clearfix"></div>
                                          
                                        										</div>
										<div class="pro-reviews">
											(<?php echo $Areviews['count(*)'] ?>) Reviews
										</div>
										
									</div>
								</div>
								<div class="col-6 col-md-2 rating-mob-hidden">
									<?php if (get_field('pro_show_saturday_as_available', $post->ID)): ?>
										<input type="hidden" name="hnd_off_saturday" value='1'>
									<?php else: ?>
										<input type="hidden" name="hnd_off_saturday" value='0'>
										
									<?php endif; ?>
									<?php if (get_field('pro_show_sunday_as_available', $post->ID)): ?>
										<input type="hidden" name="hnd_off_sunday" value='1'>
									<?php else: ?>
										<input type="hidden" name="hnd_off_sunday" value='0'>
										
									<?php endif; ?>
									
									<input type="hidden" name="hnd_timing_x" value='<?php echo json_encode(get_field('pro_schedule_time', $post->ID)); ?>'>
									<input type="hidden" name="hnd_off_dates" value='<?php echo json_encode(get_field('pro_schedule_off_dates', $post->ID)); ?>'>
									<div>
										
										<!-- <a class="pro-but1" href="<?php // echo get_permalink($post->ID); ?>" target="_blank">Profile</a> -->
										<a data-toggle="modal" data-id="<?php echo $post->ID; ?>"  class="open-AddBookDialog  pro-but1" href="#addBookDialog">Profile</a>

										<?php if (!$custom_scheduling): ?>

												<?php if ($noScheduleSelected): ?>

													<button class="schedule-btn">Schedule</button>

												<?php else: ?>

													<button class="pro-but2 questions-popup hndy_schedule_btn" data-pro-id="<?php echo $post->ID; ?>" data-pro-name="<?php echo get_field('pros_first_name', $post->ID) . ' ' . get_field('pros_last_name', $post->ID)[0]; ?>">Schedule</button>
													
												<?php endif; ?>

										<?php else: ?>

											<button class="schedule-btn">Schedule</button>

										<?php endif; ?>

										<div class="clearfix"></div>

										<button class="pro-but3 box1 hxnd-pro-reviews" data-id="<?php echo $post->ID; ?>" type="button" >Reviews</button>
										<!-- <a data-toggle="modal" data-id="<?php // echo $post->ID; ?>"  class="open-ReviewDialog btn pro-but3" href="#reviewdialog">Reviews</a> -->

										

									</div>
								</div>
								
								<div class="col-md-12">	
								
									<?php get_template_part( 'template-parts/content', 'pro-review' ); ?>
								</div>

							</div>


						<?php if (!$noScheduleSelected && $custom_scheduling): ?>

									<div class="custom-scheduling">
										<p>This Project is more than 8 hours and needs to be manually scheduled by our office. Please select your favorite technician and continue to scheduling.</p>

										<button class="pro-but2 continue-btn" data-pro-id="<?php echo $post->ID; ?>" data-pro-name="<?php echo get_field('pros_first_name', $post->ID) . ' ' . get_field('pros_last_name', $post->ID); ?>">Continue</button>
									</div>


							
						<?php endif; ?>

						<?php if ($noScheduleSelected): ?>

							<div class="no-schedule-msg">
								<strong>No Schedule Posted:</strong> <?php echo get_field('pros_first_name', $post->ID); ?> has not posted a work schedule. If you would like to schedule an appointment with <?php echo get_field('pros_first_name', $post->ID); ?>, please submit your project request below and <?php echo get_field('pros_first_name', $post->ID); ?> will get in touch with you within 24 hours.

							<form class="account-popup hnd_no_schedule_form" style="margin-top: 20px;" method="post" action="<?php echo get_site_url() . '/customer-details/' ?>">
							
								<?php wp_nonce_field('waiting_for_avengers_4_trailer_2', 'handyman_pro_nonce_2'); ?>

								<input type="hidden" name="hndy_pro_id" value="<?php echo $post->ID; ?>">
								<input type="hidden" name="hndynoscedule" value="true">
								<input type="hidden" name="__hndy_schedule_submit" value="">

								<div class="no-sch-btn-wrapper">
									<button type="submit" name="hndy_no_schedule_submit">Submit</button>
									<i class="fa fa-times"> <span> Close </span></i>
								</div>
										
								</form>
							</div>
							
						<?php endif; ?>


						</div>





						<?php endif; ?>


					<?php endif; ?>

				<?php $tabID++; endwhile; ?>				
				
				<?php // wp_pagenavi(array( 'query' => $the_query )); // WP-PageNavi Plugin ?>
				
				<?php else: // if does not have_posts() for pros ?>

					<div class="pro-handy">
						<div class="row">
							<div class="col-md-12">
								<p>No Pros are avaiable for that service.</p>
							</div>
						</div>
					</div>

				<?php endif; ?>

				<?php if (!$checkZip): ?>

					<div class="no-pros-avaiable no-print">
						<strong>We're Sorry, there are no Handyman Pro Services available in your selected <?php echo $_SESSION['hnd_zipcode']; ?> area.</strong>

						<p><strong style="text-decoration: underline;color: #2196f3;"><a onclick="window.print();">Click Here</a></strong> to print the quote above and use it as a guide when hiring a handyman for this project, however, this quote is based on local rates of certain areas and rates costs could differ for your area.</p>

						<p>If you are interested in becoming an area owner, manager, or service provider, please click one of the links below to request information.</p>
                        <div class="row" >
                            <div class="col-lg-6 left-sec">
                                <img src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/handy-pro-img101.png" class="img-fluid">
                            </div>
                            <div class="col-lg-6 right-sec" style="padding-top: 3rem;padding-left: 4rem;padding-right: 2.5rem;">
                                <p>Handyman Pros offer business and service providers opportunities nationwide. If you're interested in a fantastic business opportunity in a fast growing industry, or you like to become a service provider contact us today for more information.</p>
                                <a href="mailto:handyman@handymanproservices.com?subject=I'D Like Business Opp Information">I'D Like Business Opp Information</a>
                                <a href="mailto:handyman@handymanproservices.com?subject=I'D Like To Be A Service Provider">I'D Like To Be A Service Provider</a>
                            </div>
                        </div>
					</div>

					<?php 

						// var_dump($_SESSION['service_request']);

						if (isset($_SESSION['service_request'])) {

							$zpcode = (int) $_SESSION['hnd_zipcode'];
							global $wpdb;

							$zip = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM hxp_zipcodes WHERE zipcode = %d", array( $zpcode ) ), 'ARRAY_A');

							if (!isset($zip)) {
									$wpdb->query( $wpdb->prepare(
			                            "INSERT ignore INTO hxp_zipcodes ( zipcode, counter ) VALUES ( %d, %d )",
			                            array(
			                                    $zpcode,
			                                    1
			                            )
									) );

							} else {

								$counter = (int)$zip['counter'] + 1;

								// var_dump($counter);
								// exit;

								$wpdb->query( $wpdb->prepare(
								    "UPDATE hxp_zipcodes set counter = '%d' WHERE zipcode = '%d'",
								    array(
								        $counter,
								        $zip['zipcode']
								    )
								));

							}

							service_request( $_SESSION['hnd_zipcode'] ); // Send Email
							unset($_SESSION['service_request']);
						}
					

					?>
					
				<?php endif; ?>


			</div>
		</div>
	</section><!--Questions popup Box Start-->


	
		
	








	<div class="account-popup-area questions-popup-box calender-pop-bx">
		
		<form class="account-popup mtt50 hnd_calender_popup" method="post" action="<?php echo get_site_url() . '/customer-details/' ?>">
			<?php wp_nonce_field('waiting_for_avengers_4_trailer_2', 'handyman_pro_nonce_2'); ?>
			<input type="hidden" name="new_booking_id" value="<?php // echo $_POST['new_booking_id']; ?>">
			<input type="hidden" name="hndy_pro_id" value="">
			<input type="hidden" name="hndy_schedule_date" value="">
			<input type="hidden" name="hndy_schedule_time" value="">
			<input type="hidden" name="new_booking_service_name" value="<?php // echo $_POST['new_booking_service_name']; ?>">
			<input type="hidden" name="new_booking_selected_service_options" value="<?php // echo $_POST['new_booking_selected_service_options']; ?>">
			<input type="hidden" name="__hndy_schedule_submit" value="">
			<div class="container questions-questions">
				<div class="row">
					<div class="col-md-12">
						<div class="res-logo mob-logo-hide">
							<a href="index.html" title=""><img alt="" src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/resource/logo1.png"></a>
						</div>
					</div>
				</div>
				<div class="row calender-wrapper-row" id="qsset">
					<span class="close-popup"><i class="la la-close"></i></span>
					<div class="col-md-6 calender-left-wrraper">
					    <div class="row calender-prof-sec">
                            <div class="col-md-4">
                                <div class="calender-prof-img">
                                    <img src="<?php bloginfo('template_directory');?>/assets/images/calender-prof-img.jpg" class="img-fluid">
                                </div>
                                </div>
                            <div class="col-md-8">
                                <!-- <h5>You are scheduling with</h5> -->
                                <div class="hnd-names-av">
                                	<h3 class="calen-pro-name">...</h3>
                                	<!-- <h3> Availability</h3> -->
                                </div>
                                
                            </div>
                        </div>
						<div class="booking_form">
							<div class="loader"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/datepicker-loader.gif" alt=""></div>
							<div class="form-group booking_summary">
								<div class="available_handyman_datepicker"></div>
							</div>
						</div>
					</div>
					<div class="col-md-6 calender-right-wrraper">
						<fieldset>

							<div class="row">
								<div class="col-lg-12">
									<div class="tab-sec">
										<!--<ul class="nav nav-tabs">-->
										<!--	<li>-->
										<!--		<a class="current" data-tab="rjobs" style="width: 100%;">Timings</a>-->
										<!--	</li>-->
										<!--</ul>-->
										<div class="tab-content current" id="rjobs">

											<div class="displayDate"></div>
											<div class="row mbtlr20">
												<div class="col-md-12 hnd_display_timing">
													<!--Select Date to reveal timings.-->
													<span style="color:red;">Select a date to reveal available time slots.</span>
												</div>
											</div>
										</div>
                                        <div align="center" class="col-md-12" id="hidebuttons" style="display:none;">
                                            <button type="submit" name="hndy_schedule_submit">Continue</button>
                                        </div>
									
									</div>
								</div>
								<div></div>
							</div>

														<div class="form__header" style=" text-align: left;">
							    
							    <p class="whtext-approx">
							    	<!-- Approximate Job Completion<br> -->
							    	<span class="calend-total-time">...</span><br> <span class="time-pick-txt">Please select an available time</span></p>

								<!-- <h2 class="whtext">What time do you prefer?</h2> -->
							</div>
							<!-- <p class="whtext" style="font-size: 14px; margin-top:8px;"><i aria-hidden="true" class="fa fa-smile-o"></i> Please take into consideration, that there might be a few minutes of delay due to intense traffic.</p> -->
						</fieldset>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- Profile Details Modal -->
<!-- Higher price Modal -->
  <div class="modal hide" id="higherprice" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="margin-left: 15px;">Higher price</h4>
          <button type="button" style="margin-right: 15px;" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body higher">
        	<p>
                This serviceman has not participated in the extra discount program and has a <span>_</span>% higher price than what you were quoted in your shopping cart items.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	<!-- Modal -->
  <div class="modal hide" id="addBookDialog" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="margin-left: 15px;">Profile Details</h4>
          <button type="button" style="margin-right: 15px;" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body profile-modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal -->
  <div class="modal hide" id="reviewdialog" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="margin-left: 15px;">Reviews</h4>
          <button type="button" style="margin-right: 15px;" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
        	<div class="row">
				<div class="showreview"></div>
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	<div class="modal hide" id="addBookDialog1">
		<div class="modal-header">
			<h2 class="ft26 hnd-reviews">Profile Details</h2><button class="close" data-dismiss="modal">×</button>
		</div>
		<div class="modal-body"></div>
	</div>
	<div class="modal hide" id="reviewdialog1">
		<div class="modal-header">
			<h2 class="ft26 hnd-reviews">Reviews</h2><button class="close" data-dismiss="modal">×</button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="showreview"></div>
			</div>
		</div>
	</div>
	<!-- / Modal -->
	
	<!-- Higher price Modal -->
  <div class="modal hide" id="extradiscount" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="margin-left: 15px;">Extra Discount</h4>
          <button type="button" style="margin-right: 15px;" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body higher">
        	<p><span class="pronamez" style="font-weight: bold;">...</span> offers an extra <span class="prodisc">...</span>% discount today. If you hire this tech make sure you ask for this extra discount that is offered over and above all other discounts.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	
<?php
get_footer(); ?>
<script>

	var selectedZip = $('[data-zip]').data('zip');



	
	$(function(){

		$('.hndy_no_schedule_submit').click(function(e){
			e.preventDefault();
			$('.hnd_no_schedule_form').submit();
		});

		$('.continue-btn').click(function(e){
			e.preventDefault();
			let proID = $(this).data('pro-id');
			$('[name="hndy_pro_id"]').val(proID);
			$('.hnd_calender_popup').submit();
		});

		$('.hndy_schedule_btn').click(function(){

			console.time("timer");

			// $('.loader-pro').show();

			let proID = $(this).data('pro-id');
			let proName = $(this).data('pro-name');

			$('.available_handyman_datepicker').removeAttr('class').addClass('available_handyman_datepicker');
			$('.available_handyman_datepicker').addClass('available_handyman_datepicker' + proID);
			// $( '.available_handyman_datepicker' + proID ).val('').datepicker('update');
			$('[name="hndy_pro_id"]').val(proID);

			$('.calen-pro-name').text(proName);

			// $('.hnd_calender_popup').submit();

			$('[name="hndy_schedule_date"]').val('');

			let chkTiming  = $(this).parent().prev().prev().val(); // time
			let chkOffline = $(this).parent().prev().val(); // dates

			let off_saturday = parseInt($(this).parent().parent().find('[name="hnd_off_saturday"]').val());
			let off_sunday   = parseInt($(this).parent().parent().find('[name="hnd_off_sunday"]').val());

			// console.log(off_saturday, off_sunday);
		
			if( typeof off_saturday === 'undefined' || typeof off_sunday === 'undefined' ) {
				location.reload();
			} 


			let weekend = Array();

			weekend[0] = (off_saturday) ? '' : '6';
			weekend[1] = (off_sunday) ? '' : '0';

			// console.log(off_saturday, off_sunday);
			let filtered = weekend.filter(function (el) {
			  return el != '';
			});

			// console.log(filtered);
			if( typeof chkTiming === 'undefined' ) {
				location.reload();
			}

			if( typeof chkOffline === 'undefined' ) {
				location.reload();
			}


			let timings = JSON.parse( $(this).parent().prev().prev().val() );	
			let offdates = JSON.parse( $(this).parent().prev().val() );
			let offdates1 = Array();
			
			if (offdates) {
				offdates.forEach(function(item, index){
						offdates1.push(item.pro_schedule_off_date);
				});
			}
			
			//  let timingStr = '';
			// if(chkTiming != 'false') {
			// 	timings.forEach(function(item, index){
			// 		timingStr += '<div class="days8">' + item.pro_schedule_time_from + ' - ' + item.pro_schedule_time_to + '</div>';
			// 	});
			// 	$('.hnd_display_timing').html('');
			// 	$('.hnd_display_timing').html(timingStr);
			// } else {
			// 	$('.hnd_display_timing').html('');
			// 	$('.hnd_display_timing').html('No Timing');
			// } 

			$( '.available_handyman_datepicker' + proID ).datepicker({
									    format: 'mm/dd/yyyy',
									    // multidate : true,
									    startDate : '0d',
									    datesDisabled : offdates1, // RFE - https://bootstrap-datepicker.readthedocs.io/en/stable/options.html#datesdisabled
									    daysOfWeekDisabled : weekend
									    
			});

			$('.booking_form > .loader').show();

			setTimeout(function () { calling_datepicker_func( proID, offdates1, weekend ); }, 500);

			console.timeEnd("timer");


		});

		var currentMonthNum = [ '', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' ];

		function loopThroughDates(currentMonth, currentYear, daysInCurrentMonth) {

				let today = new Date();
			
				if ( currentMonth == today.getMonth() + 1 ) {
						var ddx = today.getDate(); // start iteration from this date
				} else {
					var ddx = 1; // start iteration from 1
				}

				console.log(currentMonth);
				console.log(today.getMonth() + 1);

				console.log(ddx);

				var blockUnavailableDates = [];

				// var emptyDay = [16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];

				// console.log(emptyDay);

				for (var i = ddx; i <= daysInCurrentMonth; i++) {

									// 4 JUNE 2023 - CONTINUE - SOURAV
									/* if (emptyDay.includes(i)) {
										continue;
									} */

									let day  = 0;
									let da   = i;

				   					if (i < 10) {
				   						day = '0' + i;
				   					} else {
				   						day = i;
				   					}

				   					let formatdate = currentMonthNum[currentMonth] + '/' + day + '/' + currentYear;

				   	                // console.log(formatdate);
				
							   	    // Ajax Call goes here.
								  	$.ajax({
						                url: zipobg.root + '/wp-admin/admin-ajax.php', // Change path
						                type: 'POST',
						                async: false,
						                data: {
						                    action: 'available_pro_dates',
						                    proID: $('[name="hndy_pro_id"]').val(),
						                    proSDate: formatdate,
						                    zipcode: selectedZip,
						                    totalmin: <?php echo $totalmin; ?>,
						                    security: zipobg.nonce
						                },
						                success: function(response) {  
						                	if (response !== '') {  
							                	
							                	let res = JSON.parse(response);	

							                	if (!res.evening_as_available) { 
							                		 res.time_list.length = 7; // REF - https://love2dev.com/blog/javascript-remove-from-array/
							                	}			

							                	if (res.time_slot) {

							                		if(res.scheduled_zipcode) {

									                	var clientKey = "js-MIqRsxKD4OmtpWbaiQesJWzm2A2uCm0q2OrnZS9AgE4XO9PTyUQiqFD3GvNefNeJ";
														var maxDistance = 10; var distanceInMiles = 0;

														let zipcode1 = selectedZip;
														let zipcode2 = res.scheduled_zipcode.filter(function (el) {
														  return el != null;
														}); // booking zipcodes // 

														// console.log(zipcode2);

														var distanceM = false;

														zipcode2.forEach(function(elem){

						        							// Build url
															var buildUrl = "https://www.zipcodeapi.com/rest/"+ clientKey + "/distance.json/" + zipcode1 + "/" + elem + "/mile";


															$.get( buildUrl, function( data ) {

																// console.log(data);

																if(data.distance > maxDistance) {
																	// console.log(formatdate);
																	blockUnavailableDates.push(formatdate);
																	// No bookings avaiable for today. Try Other dates.
																	// $('td:contains(' + i + ')').not('.new').addClass('disabled disabled-date');
																}
										                		            	
																
															});

						        						});

													}

							                	} else {

							                		// $('td:contains(' + i + ')').not('.new').addClass('disabled disabled-date');
							                		// console.log(formatdate);
							                		blockUnavailableDates.push(formatdate);
							                		// blockUnavailableDates.push(formatdate);
							                		// No bookings avaiable for today. Try Other dates.
							                	}
							                	
							                	

											}
						                },
						                error: function(error) {
						                    console.log(error);
						                }
						            
						            });


				} // for loop

				return blockUnavailableDates;
		}

		/* $(document).on('click', '.booking_form .next, .booking_form .prev', function() {
			$('.booking_form > .loader').show();
		}); */

		function calling_datepicker_func( proid, offdates, weekends ) {

			// alert(proid);
			// $(".available_handyman_datepicker").datepicker('remove'); //detach

			function getDaysInMonth(year, month) {
			  return new Date(year, month, 0).getDate();
			}

			const date = new Date();
			
			let currentMonth = date.getMonth() + 1; // 👈️ months are 0-based 
			let  currentYear = date.getFullYear(); 

			// console.log(currentMonth);
			// console.log(currentYear);

			// 👇️ Days In Current Month
			let daysInCurrentMonth = getDaysInMonth(currentYear, currentMonth);
			// console.log(daysInCurrentMonth);
			

			$('.available_handyman_datepicker' + proid).datepicker().on('changeMonth', function(e){

				$('.booking_form > .loader').show();

				 // let test = ['07/18/2022', '07/19/2022', '07/20/2022', '07/21/2022'];			   

				_currentMonth = new Date(e.date).getMonth() + 1;  // 👈️ months are 0-based 
			    _currentYear  = new Date(e.date).getFullYear();
			    _daysInCurrentMonth = getDaysInMonth(_currentYear, _currentMonth);

			    function fetchOffdates() {

				  	let response = loopThroughDates(_currentMonth, _currentYear, _daysInCurrentMonth);				  	

				  	if (response) {

				  		// console.log(currentMonthNum[_currentMonth - 1]);
				  		// console.log(_currentYear);

				  		setTimeout(function () {

				  			console.log(response);
				  			console.log(offdates);

				  			response = response.concat(offdates);

				  			console.log(response);

				  			$(".available_handyman_datepicker").datepicker('remove');

				  			$( '.available_handyman_datepicker' + proid ).datepicker({
				  			    format: 'mm/dd/yyyy',
				  			    defaultViewDate: {
				  			       year: _currentYear,
				  			       month: currentMonthNum[_currentMonth - 1]
				  			    }, // REF - https://stackoverflow.com/questions/33955166/set-month-view-for-bootstrap-datepicker-without-setting-date
				  			    //  defaultDate: "07/13/2022",
				  			    // multidate : true,
				  			    startDate : '0d',
				  			    datesDisabled : response, // RFE - https://bootstrap-datepicker.readthedocs.io/en/stable/options.html#datesdisabled
				  			    daysOfWeekDisabled : weekends
				  			    
				  			});

				  			$('.booking_form > .loader').hide();

				  		}, 800);

				  		
				  	}

				  	// console.log(uniqueItems);				  	
				  	// console.log(combined);
				
				}

				setTimeout(function () {fetchOffdates() }, 500);

			});

			getoffdates = loopThroughDates(currentMonth, currentYear, daysInCurrentMonth);

			if (getoffdates) {

					

					setTimeout(function () {

							getoffdates = getoffdates.concat(offdates);

							console.log(getoffdates);
							// console.log(offdates);

							$(".available_handyman_datepicker").datepicker('remove');

							$( '.available_handyman_datepicker' + proid ).datepicker({
									    format: 'mm/dd/yyyy',
									    // multidate : true,
									    startDate : '0d',
									    datesDisabled : getoffdates, // RFE - https://bootstrap-datepicker.readthedocs.io/en/stable/options.html#datesdisabled
									    daysOfWeekDisabled : weekends
									    
							}).on('changeDate ', function(ev){ // http://dkconnects.com/demo01/handymanpro/handyman-pros/ 

								$('.hnd_display_timing').html('');
								$('.hnd_display_timing').html('<span class="hnd-loading-d">loading..</span>');

								console.log('DATE: ' + ev.dates[0]);
								$('[name="hndy_schedule_date"]').val(ev.dates[0]);
								 var monthNum = { 'Jan' : '01', 'Feb' : '02', 'Mar' : '03', 'Apr' : '04', 'May' : '05', 'Jun' : '06', 'Jul' : '07', 'Aug' : '08', 'Sep' : '09', 'Oct' : '10', 'Nov' : '11', 'Dec' : '12', };
								// alert(ev.dates[0]);
								  let date = ev.dates[0] + ''; // REF - https://stackoverflow.com/questions/10145946/what-is-causing-the-error-string-split-is-not-a-function
								  date = date.split(' '); 
								  let dx   = date[0];
								  let key = date[1];
								  var monthnn = { 'Jan' : 'January', 'Feb' : 'February', 'Mar' : 'March', 'Apr' : 'April', 'May' : 'May', 'Jun' : 'June', 'Jul' : 'July', 'Aug' : 'August', 'Sep' : 'September', 'Oct' : 'October', 'Nov' : 'November', 'Dec' : 'December' };
								  var daynn = { 'Mon' : 'Monday', 'Tue' : 'Tuesday', 'Wed' : 'Wednesday', 'Thu' : 'Thursday', 'Fri' : 'Friday', 'Sat' : 'Saturday', 'Sun' : 'Sunday' };
								  let formatdate = monthNum[key] + '/' + date[2] + '/' + date[3];
								  let displayDate = daynn[dx] + ', ' + monthnn[key] + ' ' + date[2];
								  let displayDate1 = monthnn[key] + ' ' + date[2] + ', ' + date[3];
								  $('[data-tab="rjobs"]').text(displayDate).append('<br><small></small>');
								  $('.displayDate').text(displayDate1);

								  //console.log(formatdate);


								  console.log(selectedZip);
								  // console.log(formatdate);


								  // Ajax Call goes here.
								  	$.ajax({
						                url: zipobg.root + '/wp-admin/admin-ajax.php', // Change path
						                type: 'POST',
						                data: {
						                    action: 'available_pro_dates',
						                    proID: $('[name="hndy_pro_id"]').val(),
						                    proSDate: formatdate,
						                    zipcode: selectedZip,
						                    totalmin: <?php echo $totalmin; ?>,
						                    security: zipobg.nonce
						                },
						                success: function(response) {  
						                	if (response !== '') {  
							                	
							                	let res = JSON.parse(response);		

							                	console.log('Return Value: ', res);

							                	if (!res.evening_as_available) { 
							                		 res.time_list.length = 7; // REF - https://love2dev.com/blog/javascript-remove-from-array/
							                	}			

							                	if (res.time_slot) {

							                		if(res.scheduled_zipcode) {

									                	var clientKey = "js-MIqRsxKD4OmtpWbaiQesJWzm2A2uCm0q2OrnZS9AgE4XO9PTyUQiqFD3GvNefNeJ";
														var maxDistance = 10; var distanceInMiles = 0;

														let zipcode1 = selectedZip;
														let zipcode2 = res.scheduled_zipcode; // booking zipcodes

														var distanceM = false;

														zipcode2.forEach(function(elem){

						        							// Build url
															var buildUrl = "https://www.zipcodeapi.com/rest/"+ clientKey + "/distance.json/" + zipcode1 + "/" + elem + "/mile";


															$.get( buildUrl, function( data ) {

																console.log(data);

																if(data.distance > maxDistance) {
																	distanceM = true; // More than 10 miles.
																}
																		  		
																console.log('Distance:', data.distance);

										                		$('.hnd_display_timing').html('');

										                		console.log('More than 10 miles:', distanceM);

										                		if (distanceM) {
										                			$('.hnd_display_timing').text('No bookings avaiable for today. Try Other dates.');
										                		} else {


						                								if (res.time_list) {

						                									res.time_list.forEach(function(elem){

						                										if (res.time_slot.includes(elem)) {
						                											$('.hnd_display_timing').append('<div class="days8" data-slot="' + elem + '">' + changeTimeFormat(elem) + '</div>');
						                										} else {
						                											$('.hnd_display_timing').append('<span class="days8" data-slot="' + elem + '">' + changeTimeFormat(elem) + '</span>');
						                										}

						                			        				});

						                								} else {

						                									res.time_slot.forEach(function(elem){
						                			        					$('.hnd_display_timing').append('<div class="days8" data-slot="' + elem + '">' + changeTimeFormat(elem) + '</div>');
						                			        				});

						                								}


										                		}
										                		            	
																$('[name="hndy_schedule_time"]').val(''); 

															});

						        						});

													} else { 

														$('.hnd_display_timing').html('');

														res.time_slot.forEach(function(elem){
									        					$('.hnd_display_timing').append('<div class="days8" data-slot="' + elem + '">' + changeTimeFormat(elem) + '</div>');
									        			});

														$('[name="hndy_schedule_time"]').val('');

													} // res.scheduled_zipcode


							                	} else {
							                		$('[name="hndy_schedule_time"]').val('');
													$('.hnd_display_timing').html('');
													$('.hnd_display_timing').text('No bookings avaiable for today. Try Other dates.');
							                	}
							                	
							                	

											}
						                },
						                error: function(error) {
						                    console.log(error);
						                }
						            });
								
							});

							$('.booking_form > .loader').hide();

					}, 100);

					

			}

			// setInterval(function () { $('.booking_form > .loader').hide(); }, 7000);

		}


		$('body').on('click', '.hnd_display_timing div.days8', function(){
		    	$('.hnd_display_timing div.days8').removeAttr('style');
				$(this).css({ 'background': '#3276b1', 'color': 'white', 'border-color': '#285e8e', 'border-radius': '4px' });
				$('[name="hndy_schedule_time"]').val( $(this).data('slot') );
				$( "#hidebuttons" ).show();
		});
		
		// close 
		$('.close-popup').click(function(){ location.reload(); });
		
		// On Submit
		$('[name="hndy_schedule_submit"]').click(function(evnt){
			if ( $('[name="hndy_schedule_date"]').val() !== '' && $('[name="hndy_schedule_time"]').val()  !== '' ) {
				// do nothing				
			} else {
				evnt.preventDefault();
				alert('Select Date and Time');
			}
		});
		
	});

	$('body').on('click', 'div.days8', function(){
		$('[data-tab="rjobs"] small').text('( ' + $(this).text() + ' )');
	});

</script>
<!-- For Cart -->
<script>

	let durations = Array();

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

			return `App Completion Time: ${h}:${m} Hours`;
		

		} else {
			return `App Completion Time: ${moment.utc(totalDurations.asMilliseconds()).format("HH:mm")} Hours`;
		}
		
		// return 'Completion Time: ' + (rhours + total) + ":" + rminutes + " hours";
	}

	/* function totalTime(durations) {
		
		const totalDurations = durations.slice(1)
		.reduce((prev, cur) => moment.duration(cur).add(prev),
			moment.duration(durations[0]))

		return `Total Completion Time: ${moment.utc(totalDurations.asMilliseconds()).format("HH:mm")} Hours`;

		// return 'Completion Time: ' + (rhours + total) + ":" + rminutes + " hours";
	} */

	function changeTimeFormat(time) {
		let timing = time.split(' - ');
		let newTiming = new Array();

		timing.forEach(function(i){
		    let t = moment(i, 'HH:mm A').format('hh:mm A');
		    newTiming.push(t);
		});

		return newTiming.join(' - ');
	}

	$(function(){

		let talcost = 0;

		$('#filter .container').find('.mycart').each(function(){
			let cost = $(this).find('.cart-product .row div:last-child table tbody tr:last-child td.total-pi strong').text();

			$(this).find('.hnd-tl span').text(cost);
			
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
		});

		/* $('.myproductcart').each(function(){
			let time = $(this).find('.cart-product .completion_time_product').text();
			time = time.replace(' Hours', '');
			time = time.replace('Completion Time: ', '');
			taltime += parseFloat(time);
		}); */

		/* var radixPos = String(taltime).indexOf('.');
		
		if (radixPos > 0) {
			var deci = parseInt(String(taltime).slice(radixPos + 1));
		} else {
			var deci = 0;
		}*/ 


		$('.completion-time').text(totalTime(durations));
		$('.calend-total-time').text(totalTime(durations));


		// Warning
		var tlPrice = parseFloat($('.cart-head-span > span').text());
		// console.log(tlPrice);

		if (tlPrice < 125.00) {
			$('.hnd-cart-warning').show();
		} else {
			$('.hnd-cart-warning').hide();
		}

		// name 

		$('[data-namez]').click(function(){
			let name = $(this).data('namez');
			let discount = $(this).data('discount');
			$('.pronamez').text('');
			$('.pronamez').text(name);
			$('.prodisc').text('');
			$('.prodisc').text(discount);
		});
		
		// console.log( parseInt(taltime) );
		// console.log( parseInt(taltime) );
	});
</script>


<!-- 20-Aug-2019 -->
<script>
	$(function(){

		$('.negative-tab').click(function() {
			$(this).parents('.reviews-new').find('.positive-reviews-wrapper').hide();
			$(this).parents('.reviews-new').find('.negative-reviews-wrapper').show();
		});

		$('.positive-tab').click(function() {
			$(this).parents('.reviews-new').find('.negative-reviews-wrapper').hide();
			$(this).parents('.reviews-new').find('.positive-reviews-wrapper').show();
		});

		$('a.nav-item.nav-link.box1').click(function(evt) {
			evt.preventDefault();
			$('.hnd-box5').hide();
		});

		// terms&conditions
		$('#customer-to-supply').click(function(e){
			e.preventDefault();
			$('.customer-to-supply').toggle();
			$('.debris').hide();
			$('.insurance').hide();
		});

		$('#debris').click(function(e){
			e.preventDefault();
			$('.debris').toggle();
			$('.customer-to-supply').hide();
			$('.insurance').hide();
		});

		$('#insurance').click(function(e){
			e.preventDefault();
			$('.insurance').toggle();
			$('.customer-to-supply').hide();
			$('.debris').hide();
		});

		$(document).on("click", '[href="#higherprice"]', function(e) {
			e.preventDefault();
			let percentage = $(this).prev().text();
			console.log(percentage);
			$('#higherprice').find('.modal-body.higher span').text(percentage);
			$('#higherprice').modal('show');
		});
		

		$(document).on("click", ".open-AddBookDialog", function() {
			// $.noConflict();
			var proId = $(this).data('id');
			// console.log(proId);
			// Ajax Call goes here.
			$.ajax({
				url: zipobg.root + '/wp-admin/admin-ajax.php', // Change path
				type: 'POST',
				data: {
					action: 'available_pro_profile',
					proID: proId,
					security: zipobg.nonce
				},
				success: function(response) {
					let res = JSON.parse(response);
					console.log(res);
					$('#addBookDialog .modal-body').html('<section class="overlape"> <div class="block remove-top"> <div class="container"> <div class="row"> <div class="col-lg-12"> <div class="cand-single-user"> <div class="share-bar circle"> </div> <div class="can-detail-s"> <div class="cst"> <img alt="' + res.imgalt + '" src="' + res.imgsrc + '"> </div> </div> <div class="download-cv questions-popup"> </div> </div> <div class="cand-details-sec"> <div class="row"> <div class="col-lg-12 column"> <div class="cand-details" id="about"><div></div> </div> <div class="cand-details" id="experience"> <h3>About ' + res.first_name + '</h3><p>' + res.bio + '</p><table class="table listing-details-table"> <tbody><tr> <th>Years of Experience</th> <td>' + res.yearsofexperience + ' </td> </tr> <tr> <th>Is Certified?</th> <td class="hnd-certificate">' + res.pro_is_certified + '</td> </tr> <tr> <th>Is Insured?</th> <td class="hnd-insurance">' + res.pro_has_insurance + '<br></td> </tr> </tbody> </table> </div> <div class="cand-details" id="insurance"> <p>Note: All statements concerning Insurance, Licenses and bonds are informational only and are self reported, since insurance, licenses and bonds can expire and can be canceled, homeowners should always check such information for themselves</p> </div> </div> </div> </div> </div> </div> </div> </div> </section>');

					/* $('#addBookDialog .modal-body').html('<section class="overlape"> <div class="block remove-top"> <div class="container"> <div class="row"> <div class="col-lg-12"> <div class="cand-single-user"> <div class="share-bar circle"> </div> <div class="can-detail-s"> <div class="cst"> <img alt="' + res.imgalt + '" src="' + res.imgsrc + '"> </div> </div> <div class="download-cv questions-popup"> </div> </div> <div class="cand-details-sec"> <div class="row"> <div class="col-lg-12 column"> <div class="cand-details" id="about"><div></div> </div> <div class="cand-details" id="experience"> <h3>About ' + res.first_name + '</h3><p>' + res.bio + '</p><table class="table listing-details-table"> <tbody> <tr> <th>Email Address</th> <td data-tracker-id="filtered-email"> ' + res.emailid + ' <span class="label label-default pull-right"><i class="fa fa-envelope"></i> Confirmed</span> </td> </tr> <tr> <th>Phone Number</th> <td data-tracker-id="filtered-phone"> ' + res.homephone + '  <span class="label label-default pull-right"><i class="fa fa-th"></i> Confirmed</span> </td> </tr> <tr> <th>Zip Code</th> <td data-tracker-id="filtered-zip-code"> ' + res.address.pro_zipcode + '  </td> </tr> <tr> <th>Years of Experience</th> <td>' + res.yearsofexperience + ' </td> </tr> <tr> <th>Is Certified?</th> <td class="hnd-certificate">' + res.pro_is_certified + '</td> </tr> <tr> <th>Is Insured?</th> <td class="hnd-insurance">' + res.pro_has_insurance + '<br></td> </tr> </tbody> </table> </div> <div class="cand-details" id="insurance"> <p>Note: All statements concerning Insurance, Licenses and bonds are informational only and are self reported, since insurance, licenses and bonds can expire and can be canceled, homeowners should always check such information for themselves</p> </div> </div> </div> </div> </div> </div> </div> </div> </section>'); */
				},
				error: function(error) {
					console.log(error);
				}
			});
		});


		// Order Reviews
		// .hnd-order-reviews

		$(document).on("change", ".hnd-order-reviews", function() {
			// $.noConflict();

			$('.hnd-box5').hide();
			$('.hxnd-showreview').html('');
			$('.hxnd-showreview').html('<div class="testimonial_group">Loading..</div>');	

			var proId = $(this).data('id');
			var sort  = $(this).val();

			$('.hxnd-pro-reviews-' + proId).show();
			//console.log(proId);
			// Ajax Call goes here.
			$.ajax({
				url: zipobg.root + '/wp-admin/admin-ajax.php', // Change path
				type: 'POST',
				data: {
					action: 'available_pro_review',
					proID: proId,
					sort: sort,
					security: zipobg.nonce
				},
				success: function(response) {

					if (response != "") {

						$('.hxnd-showreview').html('');
						$('.hxnd-showreview').html(response);

					} else {
						$('.hxnd-showreview').html('');
						$('.hxnd-showreview-' + proId).append('<div class="row"><div class="testimonial_group"><div class="testimonial" itemscope="" itemtype="http://schema.org/Review">No Reviews found</div></div></div>');
					}


				},
				error: function(error) {
					console.log(error);
				}
			});
		});

		//Review Dialog
		$(document).on("click", ".hxnd-pro-reviews", function() {
			// $.noConflict();

			$('.hnd-box5').hide();
			$('.hxnd-showreview').html('');
			$('.hxnd-showreview').html('<div class="testimonial_group">Loading..</div>');	

			var proId = $(this).data('id');

			$('.hxnd-pro-reviews-' + proId).show();
			//console.log(proId);
			// Ajax Call goes here.
			$.ajax({
				url: zipobg.root + '/wp-admin/admin-ajax.php', // Change path
				type: 'POST',
				data: {
					action: 'available_pro_review',
					proID: proId,
					security: zipobg.nonce
				},
				success: function(response) {
					// let res = JSON.parse(response);		
					// $('.hxnd-showreview').html(response);

					if (response != "") {

						$('.hxnd-showreview').html('');
						$('.hxnd-showreview').html(response);

						/* if (res['positive']) {
							
							let positive = Object.values(res['positive']);

							$(positive).each(function(i) {
								// console.log(res[i].reviewername);
								$('[data-t="positive"] .hxnd-showreview-' + proId).append('<div class="testimonial_group"> <div class="testimonial" itemscope="" itemtype="http://schema.org/Review"> <h3 class="rr_title" itemprop="name"></h3> <div class="clear"></div> <span itemprop="itemReviewed" itemscope="" itemtype="http://schema.org/Product"> <div class="clear"></div> </span> <div class="stars"> ' + positive[i].review_rating + ' </div> <div class="clear"></div> <div class="rr_review_text"><span class="drop_cap">“</span><span itemprop="reviewBody">' + positive[i].review_text + '</span>”<br><a href="#" class="read_more" tabindex="0">Read More</a><a href="#" class="show_less" style="display:none;" tabindex="0">Show Less</a></div> <div class="rr_review_name" itemprop="author" itemscope="" itemtype="http://schema.org/Person"> <span itemprop="name"> - ' + positive[i].reviewername + ' </span></div> <div class="clear"></div> </div> </div>');
							});

						} else {
							$('[data-t="positive"] .hxnd-showreview-' + proId).append('<div class="row"><div class="testimonial_group"><div class="testimonial" itemscope="" itemtype="http://schema.org/Review">No Reviews found</div></div></div>');
						}


						if (res['disputed']) {
							
							let disputed = Object.values(res['disputed']);

							$(disputed).each(function(i) {
								// console.log(res[i].reviewername);
								$('[data-t="disputed"] .hxnd-showreview-' + proId).append('<div class="testimonial_group"> <div class="testimonial" itemscope="" itemtype="http://schema.org/Review"> <h3 class="rr_title" itemprop="name"></h3> <div class="clear"></div> <span itemprop="itemReviewed" itemscope="" itemtype="http://schema.org/Product"> <div class="clear"></div> </span> <div class="stars"> ' + disputed[i].review_rating + ' </div> <div class="clear"></div> <div class="rr_review_text"><span class="drop_cap">“</span><span itemprop="reviewBody">' + disputed[i].review_text + '</span>”<br><a href="#" class="read_more" tabindex="0">Read More</a><a href="#" class="show_less" style="display:none;" tabindex="0">Show Less</a></div> <div class="rr_review_name" itemprop="author" itemscope="" itemtype="http://schema.org/Person"> <span itemprop="name"> - ' + disputed[i].reviewername + ' </span></div> <div class="clear"></div> </div> </div>');
							});
						} else {
							$('[data-t="disputed"] .hxnd-showreview-' + proId).append('<div class="row"><div class="testimonial_group"><div class="testimonial" itemscope="" itemtype="http://schema.org/Review">No Reviews found</div></div></div>');
						} */


					} else {
						$('.hxnd-showreview').html('');
						$('.hxnd-showreview-' + proId).append('<div class="row"><div class="testimonial_group"><div class="testimonial" itemscope="" itemtype="http://schema.org/Review">No Reviews found</div></div></div>');
					}


				},
				error: function(error) {
					console.log(error);
				}
			});
		});
	});
</script>
<!-- For Cart -->

<!--Job Details-->
<script type="text/javascript">
	// $('.box1').on('click', function() {
	// 	$('.box5').fadeToggle("slow");
	// });
</script>


<div id="myModal1" class="modal fade" style="display: none" role="dialog">

	<div class="modal-dialog top89">



		<!-- Modal content-->

		<div class="modal-content">

			<div class="modal-header">
<h4 class="modal-title">Job Details</h4>
				<button type="button" class="close bt10" data-dismiss="modal">&times;</button>

				

			</div>

			<div class="modal-body">

				<div class="row">

					<div class="col-md-12">

						<p>Total cost: $416.75</p>

					</div>

				</div>

				<div class="row">

					<div class="col-md-9">

						<p>Picture #1: Install customer supplied drywall and tape one coat as shown between red lines</p>

					</div>

					<div class="col-md-3">

						<p>$375.00</p>

					</div>

				</div>

				<div class="row">

					<div class="col-md-9">

						<p>We need to have connection for the dishwasher (dishwasher was there already). to be estimated at time of job Dishwasher ok, disconnected garbage disposal switch</p>

					</div>

					<div class="col-md-3">

						<p>$34.75</p>

					</div>

				</div>

				<div class="row">

					<div class="col-md-9">

						<p>Material</p>

					</div>

					<div class="col-md-3">

						<p>$7.00</p>

					</div>

				</div>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default bt10" data-dismiss="modal">Close</button>

			</div>

		</div>



	</div>

</div>

<!-- <div class="loader-pro">
	<img src="<?php // bloginfo( 'stylesheet_directory' ); ?>/assets/images/pulse.gif" alt="">
</div> -->



<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('click', '.preview-booking', function() {

			let url = $(this).data('url');

			$('.hnd-preview').html('');
			$('.hnd-preview').html('<iframe src="' + url + '" width="800" height="600" frameborder="0" scrolling="yes" allowfullscreen></iframe>');
		});


		$('.schedule-btn').click(function(){
			$(this).parents('.pro-handy').find('.custom-scheduling, .no-schedule-msg').addClass('active');
		});

		$('.no-schedule-msg i.fa-times').click(function(){
			$(this).parents('.pro-handy').find('.custom-scheduling, .no-schedule-msg').removeClass('active');
		});
	});
</script>