<?php
/**
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

	                        		<?php if ($post->ID !== 306): // IF NOT THANK YOU PAGE ?>
	                        				<?php the_content(); ?>
	                        		<?php else: ?>

	                        			<?php if (isset($_GET['pn']) && isset($_GET['action'])): 

	                        					$photographer_id = (int) $_GET['pn'];

	                        					$photographer_email = get_field('traveltographer_email', $photographer_id);

	                        					$photographer_password = wp_generate_password(10, true);

	                        					if (!get_field('traveltographer_email_verification_status', $photographer_id)) {
	                        						
	                        						update_field('traveltographer_email_verification_status', 1, $photographer_id);
	                        						
	                        						// Creating login account
                									$user_id = wp_insert_user( array(
                									  'user_login' => $photographer_email,
                									  'user_pass' => $photographer_password,
                									  'user_email' => $photographer_email,
                									  // 'first_name' => 'Jane',
                									  // 'last_name' => 'Doe',
                									  'display_name' => get_the_title($photographer_id),
                									  'role' => 'author'
                									));


                									// change author of the post.
                									$arg = array(
                									    'ID' => $photographer_id,
                									    'post_author' => $user_id,
                									);

                									wp_update_post( $arg );

													// var_dump($photographer_password);
													// var_dump($user_id);


													// Send login details
													$contactname = 'Traveltographer';
													$subject     = 'Congratulations! Your Registration is Complete!';
													$email_body  = '';

													$email_body  .= 'Dear ' . get_the_title($photographer_id) . ', <br><br>';

													$email_body  .= 'Congratulations! Your Registration is Complete!<br> You can now login to your account with the credential below.<br><br>';
													
													$email_body  .= 'Login URL: ' . home_url( '/sign-in/' ) . '<br>';
													$email_body  .= 'Username: ' . $photographer_email . '<br>';
													$email_body  .= 'Password: ' . $photographer_password . '<br>';


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
									                              'Email' => $photographer_email,
									                              'Name' => get_the_title($photographer_id)
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

									                 echo '<script> window.location.href = "' . home_url('/thank-you/') . '?status=complete"; </script>';

							  						 die();


	                        					} else {
	                        						echo "Your Email ID is already verified! Please wait for admin to send you your login credential. If you don't hear from admin in 1-2 days please email him at admin@example.com with your registered email ID.";
	                        					}
	                        				

	                        			?><?php elseif( isset($_GET['status']) && $_GET['status'] === 'complete' ): ?>

	                        					<p>Congratulations! Your Registration is Complete. Please check your email for login credential.</p>

	                        			<?php elseif( isset($_GET['pn']) && isset($_GET['em']) && $_GET['em'] === 'verify' ): ?>

	                        					<p><strong>Thank you for signing up!</strong> Please verify your email address to complete your registration. <!-- <a href="#">Resend</a> --></p>

	                        			<?php else: ?>

	                        				<?php the_content(); ?>
	                        				
	                        			<?php endif; ?>

	                        		<?php endif; ?>

	                                
	                            </div>
	                    </div>
	                </div>
	            </div>
	        </section>


<?php
// get_sidebar();
get_footer();
