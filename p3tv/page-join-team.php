<?php
/**
 * Template Name: Join Team
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

require 'vendor/autoload.php';
use \Mailjet\Resources;

$path = __DIR__ . '/inc/data/cities.json';

function isEmailUnique($email) {
		
		global $wpdb;

		$checkEmail = $wpdb->get_results( $wpdb->prepare( "SELECT user_email FROM tvl_users WHERE user_email = %s", array( $email ) ), 'ARRAY_A');


		return empty($checkEmail) ? true : false;

}

function process_form_data($data, $files) {

		if ( !isset( $data['traveltographer_nonce'] ) || !wp_verify_nonce( $data['traveltographer_nonce'], 'loki_season_1' ) ) {

			   die( 'Failed security check' );

		} else { // process data

				// echo "<pre>";
				// var_dump($_FILES['traveltographer_photos']);
				// exit;

				// echo "<pre>";
			 //    var_dump($files['traveltographer_document']);
			 //    exit;

				global $error_message, $path;

				$original = $data;

				unset($data['traveltographer_submit']);
				unset($data['traveltographer_website']);
				unset($data['traveltographer_instagram']);
				unset($data['traveltographer_facebook']);

				$json = file_get_contents( $path );

				$jsonData = json_decode($json, true);

				foreach( $data as $jkey => $value ){

					if ( $jkey == 'traveltographer_paypal' || $jkey == 'traveltographer_bankdetails' ) {
						continue;
					}

			        if( $value === '' ){
			            $error_message = "* are Required ";
			        }
			    }

			    $email = filter_var($data['traveltographer_email'], FILTER_SANITIZE_EMAIL); // SANITIZE EMAIL

			    if (!isset($error_message) && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			        $error_message = "You must specify a valid email address.";
			    }

			    if ( $files['traveltographer_document']['name'] !== '' ) {
			    	
			    	$id_proof_doc = $files['traveltographer_document']['name'];

			    	if (preg_match("/\.(pdf|jpeg|jpg|gif|webp|png)$/", $id_proof_doc) === 0 && !isset($error_message) ) {
			    		$error_message = "Only PDFs and Image formats are allowed!";
			    	}

			    } else {

			    	if (!isset($error_message)) {
			    		$error_message = "Upload ID Document!";
			    	}
			    	
			    }

			    if ( $files['traveltographer_photos']['name'] !== '' ) {

			    	foreach ($files['traveltographer_photos']['name'] as $key => $photo) {

			    		$ph = $photo;

				    	if (preg_match("/\.(gif|png|jpg|webp|jpeg)$/", $ph) === 0 && !isset($error_message) ) {
				    		$error_message = "Only gif, png, jpg, webp formats are allowed!";
				    		break;
				    	}
			    	
			    	}

			    } else {
			    	if (!isset($error_message)) {
			    		$error_message = "Upload Photos!";
			    	}
			    }
		    

				$traveltographer_fname 						=  sanitize_text_field($data['traveltographer_fname']);
				$traveltographer_lname  					=  sanitize_text_field($data['traveltographer_lname']);

				$traveltographer_email  					=  sanitize_email($data['traveltographer_email']);

				$traveltographer_confirm_email  			=  sanitize_email($data['traveltographer_confirm_email']);

				$traveltographer_bio  						=  sanitize_text_field($data['traveltographer_bio']);

				$traveltographer_country  					=  sanitize_text_field($data['traveltographer_country']);

				$travelt_city  								=  sanitize_text_field($data['travelt_city']);

				$paymentType  								=  sanitize_text_field($data['traveltographer_paytype']);




				$paypal_ID  							=  sanitize_email($data['traveltographer_paypal']);
				$bank_details  							=  sanitize_text_field($data['traveltographer_bankdetails']);


				if ((int) $traveltographer_country == 4) { // India
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[0]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}


				if ((int) $traveltographer_country == 5) { // Pakistan
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[1]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 3) { // UAE
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[2]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}


				if ((int) $traveltographer_country == 21) { // Italy
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[3]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 22) { // UK
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[4]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 23) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[5]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 24) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[6]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 25) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[7]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 26) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[8]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 27) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[9]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 28) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[10]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 29) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[11]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 30) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[12]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 31) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[13]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 32) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[14]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 33) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[15]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 34) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[16]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 35) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[17]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 36) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[18]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 37) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[19]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 38) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[20]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}

				if ((int) $traveltographer_country == 39) {
					if (!isset($error_message) && !in_array($travelt_city, $jsonData[21]['data'])) {
						$error_message = "Select correct city name from the list.";
					}
				}


				$traveltographer_phone  					=  sanitize_text_field($data['traveltographer_phone']);

				$traveltographer_address  					=  sanitize_text_field($data['traveltographer_address']);

				$traveltographer_website  					=  isset($original['traveltographer_website']) ? sanitize_text_field($original['traveltographer_website']) : '';
				$traveltographer_instagram  				=  isset($original['traveltographer_instagram']) ? sanitize_text_field($original['traveltographer_instagram']) : '';
				$traveltographer_facebook  					=  isset($original['traveltographer_facebook']) ? sanitize_text_field($original['traveltographer_facebook']) : '';

				$traveltographer_equipment  				=  sanitize_text_field($data['traveltographer_equipment']);
				$traveltographer_birthday  					=  sanitize_text_field($data['traveltographer_birthday']);

				$traveltographer_type  					    =  array_map( 'esc_attr', $data['traveltographer_type'] );

				if (!$traveltographer_type && !isset($error_message)) {
					$error_message = "Select the type of Photoghaphy you do.";
				}

				// echo "<pre>";
				// var_dump($traveltographer_type);
				// exit;

				$traveltographer_language  					=  sanitize_text_field($data['traveltographer_language']);

				// Validate Email
				if( !isEmailUnique($traveltographer_email)) {
					$error_message = "Email ID is already exists.";
				}

				// var_dump($traveltographer_email, $traveltographer_confirm_email);
				// exit;

				if( $traveltographer_email != $traveltographer_confirm_email ) {
					$error_message = "Email ID mismatches. Please confirm your email id.";
				}

				if ($paymentType == 'paypal' && $paypal_ID == "") {
					$error_message = "Paypal ID required.";
				}

				if ($paymentType == 'bank' && $bank_details == "") {
					$error_message = "Bank Details required.";
				}

				// pending.
				if (!isset($error_message)) {

					$new = wp_insert_post( array (
					    'post_type' => 'photographers',
					    'post_title' => $traveltographer_fname . ' ' . $traveltographer_lname,
					    'post_content' => $traveltographer_bio,
					    'post_status' => 'pending',
					    'comment_status' => 'closed',
					    'ping_status' => 'closed',
					));

					if($new) {

						$traveltographer_type     =  array_map("intval", $traveltographer_type);
						$traveltographer_country  =  (int) $traveltographer_country;

						wp_set_object_terms( $new, $traveltographer_type, 'photography_types' ); // Photography Type

						wp_set_object_terms( $new, $traveltographer_country, 'locations' ); // country

						update_field( 'traveltographer_languages', $traveltographer_language , $new);
						update_field( 'traveltographer_email', $traveltographer_email , $new);
						update_field( 'traveltographer_phone', $traveltographer_phone , $new);
						update_field( 'traveltographer_address', $traveltographer_address , $new);
						update_field( 'traveltographer_city', strtolower($travelt_city) , $new);
						update_field( 'traveltographer_birthday', $traveltographer_birthday , $new);
						update_field( 'traveltographer_equipment_used', $traveltographer_equipment , $new);

						update_field( 'traveltographer_payment_type', $paymentType , $new);

  
						if ($paymentType && $paymentType == 'paypal') {
							update_field( 'traveltographer_paypal_id', $paypal_ID , $new);
						}

						if ($paymentType && $paymentType == 'bank') {
							update_field( 'traveltographer_bank_details', $bank_details , $new);
						}


						if ($traveltographer_website) {
							update_field( 'traveltographer_website', $traveltographer_website , $new);
						}

						if ($traveltographer_facebook) {
							update_field( 'traveltographer_fb_account', $traveltographer_facebook , $new);
						}

						if ($traveltographer_instagram) {
							update_field( 'traveltographer_insta_account', $traveltographer_instagram , $new);
						}


						if ( ! function_exists( 'wp_handle_upload' ) ) {
						    require_once( ABSPATH . 'wp-admin/includes/file.php' );
						}

						// ID Proof 
						$document = $files['traveltographer_document']; // traveltographer_photos // traveltographer_document
					    
					    // REF - https://developer.wordpress.org/reference/functions/wp_handle_upload/
					    // REF - https://www.kvcodes.com/2015/11/invalid-form-submission-in-wordpress-wp_handle_upload/
					    // RELATED - https://developer.wordpress.org/reference/functions/media_handle_upload/

					    $file_attr = wp_handle_upload($document, array('test_form' => false));

					    $attachment = array(
					    	'guid' => $file_attr['url'], 
					    	'post_mime_type' => $file_attr['type'], 
					    	'post_title' => preg_replace('/\\.[^.]+$/', '', basename($document['name'])), 
					    	'post_content' => '', 
					    	'post_status' => 'inherit'
					    );
					    
					    // Adds file as attachment to WordPress
					    $attach_id = wp_insert_attachment($attachment, $file_attr['file'], $new);
						
				        update_field('traveltographer_id_proof', $attach_id, $new);

				        // gallery
				        $gallery = $files['traveltographer_photos'];

				  		// echo "<pre>";
						// var_dump($gallery);
						// exit;

				        $picture_attach_id =  array();

				        foreach ( $gallery['name'] as $key => $value ) {

				        		if ($gallery['name'][$key]) {

				        		    $picture = array(
				        		      'name'     => $gallery['name'][$key],
				        		      'type'     => $gallery['type'][$key],
				        		      'tmp_name' => $gallery['tmp_name'][$key],
				        		      'error'    => $gallery['error'][$key],
				        		      'size'     => $gallery['size'][$key]
				        		    );

        		            		$picture_attr = wp_handle_upload($picture, array('test_form' => false));

        		            		// var_dump($picture_attr);

        		            		$picture_attachment = array(
        		    			    	'guid' => $picture_attr['url'], 
        		    			    	'post_mime_type' => $picture_attr['type'], 
        		    			    	'post_title' => preg_replace('/\\.[^.]+$/', '', basename($picture['name'])), 
        		    			    	'post_content' => '', 
        		    			    	'post_status' => 'inherit'
        		    			    );

        		    			    // var_dump($picture_attachment);
        		    			    
        		    			    // Adds file as attachment to WordPress
        		    			    $picture_attach_id[] = wp_insert_attachment($picture_attachment, $picture_attr['file'], $new);
				        		}		        		

				        }

						  // echo "<pre>";
						  // var_dump('expression');
						  // var_dump($gallery);
						  // var_dump($picture_attach_id);
						  // exit;

				        update_field('traveltographer_gallery', $picture_attach_id, $new);

						$contactname = 'Traveltographer';
						$subject     = 'Action Required: Please confirm your email';
						$email_body  = '';

						$email_body  .= 'Dear ' . $traveltographer_fname . ', <br><br>';

						$email_body  .= 'Please confirm your email address by clicking on the link below.<br>';
						$email_body  .= '<a href="' . home_url('/thank-you/') . '?pn=' . $new .'&action=confirm">' . home_url('/thank-you/') . '?p='. $new .'&action=confirm</a>';


						$email_body  .= '<br><br><br>Regards,<br>Team Traveltographer.';


						// Sending email to user
				        $mj = new \Mailjet\Client('6d82e174bf1cb383c2db46d759983e2b','eb3c1c3fc1eda3cc563edafca794fa17',true,['version' => 'v3.1']);

		                try {

		                    $body = [
		                      'Messages' => [
		                        [
		                          'From' => [
		                            'Email' => "wordpress@traveltographer.com",
		                            'Name' => $contactname
		                          ],
		                          'To' => [
		                            [
		                              'Email' => $traveltographer_email,
		                              'Name' => $traveltographer_fname . ' ' . $traveltographer_lname
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

  						 //  wp_mail( $pro_email, 'Welcome!', 'Your Email: ' . $pro_email . ', Your Password: ' . $pro_confirm_password );

  						 wp_redirect( get_site_url() . '/thank-you/?pn=' .  $new . '&em=verify');
  						 die();

					}




				}


		}

}

if (isset($_POST['traveltographer_submit'])) {
	process_form_data($_POST, $_FILES);
}

get_header(); ?>

		<style>

			/*, .city-name .dropdown.bootstrap-select*/
			.bank-acc, .paypal-acc { display: none; }


			[name="traveltographer_ph_code"], [name="travelt_city"] { pointer-events: none; opacity: 0.5; }

			[data-country="4"] { display: block; }

			.input-group textarea { margin-bottom: 20px; }
			.col-md-12.ptype { display: flex; }

			p.error {
			    background: #dc3545;
			    color: white;
			    padding: 5px 15px;
			    border-radius: 4px;
			}

			@media screen and (max-width: 768px) {
				.col-md-12.ptype { flex-wrap: wrap; }
			}

		</style>

			<!--Page Header Start-->
	        <section class="page-header" style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/main-slider/slide_v1_9.jpg); background-position: center;">
	            <div class="container">
	                <h2>Join our team</h2>
	                <ul class="thm-breadcrumb list-unstyled">
	                    
	                    <li><span>Become part of our amazing community of worldwide photographers</span></li>
	                </ul>
	            </div>
	        </section>

	  		<!--Contact One single-->
	        <section class="contact-one join-our-team">
	            <div class="container">
	                <div class="row">
	                    <div class="col-xl-12">
	                        <div class="contact_one_left">
	                            <div class="block-title text-center">
	                                <h4>contact us</h4>
	                                <?php the_content(); ?>
	                            </div>
	                            
	                        </div>
	                    </div>

	                    <div class="col-xl-12 requirement">
	                        <?php echo get_field('traveltographer_professional_requirements'); ?>
	                      <hr/>  
	                    </div>

	                    <div class="col-xl-12">
	                        <p>Your application will be reviewed upon receipt and we'll be in touch within 48 hours!</p>
	                        <div class="contact-one__form__wrap">

	                        	<?php if (isset($error_message)): ?>
	                        			<p class="error"><?php echo $error_message; ?></p>
	                        	<?php endif; ?>
	                            
	                            <form action="" class="contact-one__form" method="POST" enctype="multipart/form-data" autocomplete="off">
	                                <div class="row">

	                                	<?php wp_nonce_field('loki_season_1', 'traveltographer_nonce'); ?>
	                                    
	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>First Name *</label>
	                                            <input type="text" name="traveltographer_fname" placeholder="Enter Your First Name *" value="<?php echo strip_tags($_POST['traveltographer_fname']); ?>">
	                                        </div>
	                                    </div>
	                                      <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Last Name *</label>
	                                            <input type="text" name="traveltographer_lname" placeholder="Enter Your Last Name *" value="<?php echo strip_tags($_POST['traveltographer_lname']); ?>">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-12">
	                                        <div class="input-group">
	                                            <label>About *</label>
	                                            <textarea name="traveltographer_bio" id="" cols="30" rows="10" placeholder="Enter Short Bio"><?php echo trim(strip_tags($_POST['traveltographer_bio'])); ?></textarea>
	                                        </div>
	                                    </div>

	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Email Address *</label>
	                                            <input type="email" name="traveltographer_email" placeholder="Email address" value="<?php echo strip_tags($_POST['traveltographer_email']); ?>">
	                                        </div>
	                                    </div>

	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Confirm Email Address *</label>
	                                            <input type="email" name="traveltographer_confirm_email" placeholder="Confirm Email address" onpaste="return false;" ondrop="return false;" autocomplete="off">
	                                        </div>
	                                    </div>
	                                    
	                                    

								        <div class="col-md-3">
								                <div class="input-group">
								                    <label>Country Name *</label>
								                    <select name="traveltographer_country">

								                     <option value="">Select Country</option>
								                     
								                     <?php $locations = get_terms( array( 
																      'taxonomy' => 'locations',
																      'hide_empty' => false,
													 ) ); ?>		

													<?php foreach ($locations as $key => $location): 

														if ( get_field('travelt_location_visibility', 'locations_' . $location->term_id) == 'show' )  :

														?>

															<?php if ($location->term_id == (int) $_POST['traveltographer_country']): ?>

															<option value="<?php echo $location->term_id; ?>" selected><?php echo $location->name; ?></option>

															<?php else: ?>

																<option value="<?php echo $location->term_id; ?>"><?php echo $location->name; ?></option>
																
															<?php endif; ?>

							                               
							                                    	
							                        <?php endif; endforeach; ?>

								                  </select>
								            </div>
								        </div>
								        
								        <div class="col-md-3 country-city" >
								                <div class="input-group"> <label for="x_cities">City Name *</label>

								                	<!-- <input list="x_cities" name="travelt_city" value="<?php // echo strip_tags($_POST['travelt_city']); ?>">  -->
								                	<!-- ATTRIBUTE: onkeydown="return false;" -->

								                	<select name="travelt_city" id="x_cities">
								                		
								                	</select>

			                	                	<!-- <datalist id="x_cities"></datalist> -->

								                </div>
								        </div>


								        <div class="col-md-2">
	                                        <div class="input-group">
	                                            <label>Country code *</label>
	                                            <select name="traveltographer_ph_code" id="">
	                                            	<option value="">Select Country Code</option>

	                                            	<?php foreach ($locations as $key => $location): ?>

	                                            			<?php if (get_field('travelt_country_code', 'locations_' . $location->term_id) == $_POST['traveltographer_ph_code']): ?>

	                                            				<option data-country="<?php echo $location->term_id; ?>" value="<?php echo get_field('travelt_country_code', 'locations_' . $location->term_id); ?>" selected><?php echo get_field('travelt_country_code', 'locations_' . $location->term_id); ?></option>

	                                            			<?php else: ?>

	                                            				<option data-country="<?php echo $location->term_id; ?>" value="<?php echo get_field('travelt_country_code', 'locations_' . $location->term_id); ?>"><?php echo get_field('travelt_country_code', 'locations_' . $location->term_id); ?></option>
	                                            				
	                                            			<?php endif; ?>

							                               
							                                    	
							                        <?php endforeach; ?>

	                                            </select>
	                                        </div>
	                                    </div>
	                                    
	                                    <div class="col-md-4">
	                                        <div class="input-group">
	                                            <label>Phone number *</label>
	                                            <input type="tel" name="traveltographer_phone" placeholder="Enter Your Phone number" value="<?php echo strip_tags($_POST['traveltographer_phone']); ?>">
	                                        </div>
	                                    </div>
	                                    
	                                    

	                                    <div class="col-md-12">
	                                        <div class="input-group">
	                                            <label>Where do you live *</label>
	                                            <input type="text" name="traveltographer_address" placeholder="Your address" value="<?php echo strip_tags($_POST['traveltographer_address']); ?>">
	                                        </div>
	                                    </div>

	                                    <div class="col-md-12">
	                                        <label>Portfolio / Website (Optional)</label>
	                                        <div class="input-group">
	                                          <span class="input-group-text">https://</span>
	                                          <input class="form-control" name="traveltographer_website" placeholder="example.com" type="text" value="<?php echo strip_tags($_POST['traveltographer_website']); ?>">
	                                        </div>
	                                    </div>
	                                    
	                                    <div class="col-md-12">
	                                        <label>Social Media Links (Optional)</label>
	                                        <div class="input-group">
	                                          <span class="input-group-text"><i class="fab fa-instagram fa-lg"></i></span>
	                                          <input class="form-control" placeholder="https://instagram.com/" name="traveltographer_instagram" type="text" value="<?php echo strip_tags($_POST['traveltographer_instagram']); ?>">
	                                        </div>
	                                        <div class="input-group">                      
	                                          <span class="input-group-text"><i class="fab fa-facebook-square fa-lg"></i></span>
	                                          <input class="form-control" name="traveltographer_facebook" placeholder="https://facebook.com/" type="text" value="<?php echo strip_tags($_POST['traveltographer_facebook']); ?>">
	                                        </div>
	                                    </div>

	                                    <div class="col-md-12">
	                                        <div class="input-group">
	                                            <label>Equipment used *</label>
	                                            <input type="text" name="traveltographer_equipment" placeholder="Enter Your Equipment details" value="<?php echo strip_tags($_POST['traveltographer_equipment']); ?>">
	                                        </div>
	                                    </div>

	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>When is your birthday? *</label>
	                                            <input type="date" name="traveltographer_birthday" placeholder="Enter Your Birthday Date" value="<?php echo strip_tags($_POST['traveltographer_birthday']); ?>">
	                                        </div>
	                                    </div>

	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>ID Document * (Upload PDF)</label>
	                                            <input type="file" name="traveltographer_document" placeholder="Upload ID Proof" accept="application/pdf, image/*">
	                                        </div>
	                                    </div>

	                                    <div class="col-md-12">
	                                        <label>What kinds of photography do you feel most comfortable doing *</label>
	                                        <div class="row">

	                           				
	                                          
	                                            <div class="col-md-12 ptype">

	                                            	<?php $photography_types = get_terms( array( 
																		      'taxonomy' => 'photography_types',
																		      'hide_empty' => false,
																		) ); 


													?><?php foreach ($photography_types as $key => $type): ?>

															<div class="input-group">
															    <input type="checkbox" name="traveltographer_type[]" value="<?php echo $type->term_id; ?>" <?php echo (in_array($type->term_id, $_POST['traveltographer_type'])) ? 'checked' : ''; ?>>
															    <label><?php echo $type->name; ?></label>
															</div>	                                                

	                                            	<?php endforeach; ?>

	                                            </div>
	                                            
	                                        </div>
	                                    </div>

	                                    <div class="col-md-12">
	                                    	<div class="input-group">
	                                            <label>Language(s) Spoken *</label>
	                                        	<input type="text" name="traveltographer_language" placeholder="Enter language(s) spoken" value="<?php echo strip_tags($_POST['traveltographer_language']); ?>">
	                                        </div>
	                                        
	                                    </div>

	                                    <div class="col-md-12">
	                                        <div class="input-group">
	                                            <label>Photos *</label>
	                                            <input type="file" name="traveltographer_photos[]" placeholder="Upload Photos" accept="image/*" multiple>
	                                        </div>
	                                    </div>

	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Preferred Payment Type *</label>
	                                            <select name="traveltographer_paytype" id="">
	                                            	<option value="">Select Payment Type</option>
	                                            	<option value="paypal" <?php echo ($_POST['traveltographer_paytype'] == 'paypal') ? 'selected' : ''; ?>>Paypal</option>
	                                            	<option value="bank" <?php echo ($_POST['traveltographer_paytype'] == 'bank') ? 'selected' : ''; ?>>Bank Transfer</option>
	                                            </select>
	                                        </div>
	                                    </div>

	                                    <?php 

	                                    	if (isset($_POST['traveltographer_paypal']) && $_POST['traveltographer_paypal'] !== '') {
	                                    		$stylep = 'style="display: block;"';
	                                    	} else {
	                                    		$stylep = '';
	                                    	}

	                                    	if (isset($_POST['traveltographer_bankdetails']) && $_POST['traveltographer_bankdetails'] !== '') {
	                                    		$styleb = 'style="display: block;"';
	                                    	} else {
	                                    		$styleb = '';
	                                    	}

	                                    ?>

	                                    <div class="col-md-6 paypal-acc" <?php echo $stylep; ?>>
	                                        <div class="input-group">
	                                            <label>Your Paypal ID</label>
	                                            <input type="email" name="traveltographer_paypal" placeholder="Paypal Email ID" value="<?php echo strip_tags($_POST['traveltographer_paypal']); ?>">
	                                        </div>
	                                    </div>

	                                    <div class="col-md-6 bank-acc" <?php echo $styleb; ?>>
	                                        <div class="input-group">
	                                            <label>Your Bank Details</label>
	                                            <textarea name="traveltographer_bankdetails"  placeholder="Bank Details" id="" cols="30" rows="10"><?php echo trim(strip_tags($_POST['traveltographer_bankdetails'])); ?></textarea>
	                                        </div>
	                                    </div>



	                                    <!-- <div class="col-md-12">
	                                        <label>How did you hear about us *</label>
	                                        <div class="row">
	                                          
	                                            <div class="col-md-4">
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Google</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Referral</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Word of Mouth</label>
	                                                </div>
	                                                
	                                            </div>
	                                            <div class="col-md-4">
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Facebook</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Twitter</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Ad</label>
	                                                </div>
	                                                
	                                            </div>
	                                            <div class="col-md-4">
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Instagram</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Our Website</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Other</label>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div> -->


	                                    <div class="col-md-12">
	                                        <div class="input-group contact__btn">
	                                            <button type="submit" name="traveltographer_submit" class="thm-btn contact-one__btn">SEND</button>
	                                        </div>
	                                    </div>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </section>
	      

			<?php get_template_part( 'template-parts/content', 'book-photoshoot' ); ?>

<?php
// get_sidebar();
get_footer(); ?>

<script type="text/javascript">

    $(function () {

    	$('[name="traveltographer_fname"], [name="traveltographer_lname"]').keyup(function(){
    		
    		var input = $(this).val();
    		var filter = input.replace(/[0-9]/g, "");

    		$(this).val(filter);

    		//console.log(/\d/.test(input));
    		
    		
    	});

    	$('[name="traveltographer_paytype"]').change(function() {

    		$('.paypal-acc').hide();
    		$('.bank-acc').hide();

    		if( $(this).val() == 'paypal' ) {
    			$('.paypal-acc').show();
    		}

    		if( $(this).val() == 'bank' ) {
    			$('.bank-acc').show();
    		}
    	});

    	$('[name="traveltographer_country"]').change(function(){ 

    		$('[name="travelt_city"]').val('');

    		let country = $(this).val();

				$.ajax({

                    url: travelt.root + '/wp-admin/admin-ajax.php', // Change path
                    type: 'POST',
                    data: {
                    	
                        action: 'load_cities_data',
                        id: country,
                        nonce: travelt.nonce
                    },

                    success: function(response) {

                    	console.log(response);

                    	let data = '';
                    	
                    	let res = $.parseJSON(response);

                    	// console.log(res);

                    	res.forEach(function(item, index) {

                    		data += '<option value="' + item + '">' + item + '</option>';

                    	});


                    	$('#x_cities').html('');
    					$('#x_cities').html(data);

                    },

                    error: function(error) {
                        console.log(error);
                    }

                });



    		if (country) { 

    			$('[name="traveltographer_ph_code"] [data-country="' + country + '"]').prop('selected', true);
    			$('[name="traveltographer_ph_code"]').css('opacity', '1');

    			$('[name="travelt_city"]').css({ 'pointer-events' : 'initial', 'opacity' : '1' });

    		} else {

    			$('[name="traveltographer_ph_code"] option:first').prop('selected', true);
    			$('[name="traveltographer_ph_code"]').css('opacity', '0.5');

    			$('#x_cities').html('');

    			$('[name="travelt_city"]').css({ 'pointer-events' : 'none', 'opacity' : '0.5' });
    		}
    		
    	});
		  
		  $("#datepicker").datepicker({
		        format:'dd/mm/yyyy', 
		        autoclose: true, 
		        todayHighlight: true
		  }).datepicker('update', new Date());

	});
	
</script>