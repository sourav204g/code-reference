<?php
/**
 * Template Name: Login
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

get_header();
?>

	<style>

				.ur-frontend-form { border: none; padding: 0px; }

				.form-row .input-text::-webkit-input-placeholder { /* Edge */
				  color: #828892 !important;
				  padding-left: 10px;
				}

				.form-row .input-text:-ms-input-placeholder { /* Internet Explorer */
				  color: #828892 !important;
				  padding-left: 10px;
				}

				.form-row .input-text::placeholder {
				  color: #828892 !important;
				  padding-left: 10px;
				}

				#user-registration, #user-registration.horizontal {
					box-shadow: none;
				}

				.form-row {
				    display: flex;
				    flex-direction: column;
				}

				.user-registration-form-row label {
					    font-family: var(--thm-font5);
					    color: var(--thm-gray);
					    font-size: 18px !important;
					    line-height: 28px;
					    font-weight: 500 !important;
				}

				.form-row input {
					    height: 65px;
					    width: 100%;
					    background: #f0f3f6;
					    border: none;
					    outline: none;
					    padding: 0 30px;
					    font-size: 16px;
					    color: var(--thm-gray);
					    margin-bottom: 20px;
					    border-radius: 4px !important;
				}

				.ur-frontend-form .ur-button-container { display: block; }

				.ur-frontend-form button, .ur-frontend-form button[type=submit], .ur-frontend-form input[type=submit] {
					padding: 15.5px 50px;
					margin-top: 15px;
				}

				.login-section p { margin-bottom: 0px; }

				input.user-registration-Button.button {
				    display: inline-block;
				    vertical-align: middle;
				    border: none;
				    outline: none;
				    background: var(--thm-primary);
				    font-size: 15px;
				    color: #ffffff;
				    font-weight: 500;
				    padding: 15.5px 50px;
				    border-radius: 4px;
				    text-transform: uppercase;
				    letter-spacing: 0.2em;
				    -webkit-transition: all 0.4s ease;
				    transition: all 0.4s ease;
				}

				input.user-registration-Button.button:hover { background-color: var(--thm-black); }

				.lost_password > a { font-size: 14px; }


			</style>

	<!--Main Bottom Start-->
	<section class="inner_bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-xl-12 col-lg-12">
	                <div class="main_bottom_left">
	                    <div class="main_bottom_content">
	                         <div class="main_bottom_left_title">
	                           <h3>Login</h3>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            
	        </div>
	    </div>
	</section>

	<!--Listings Details Start-->
	<section class="listings_details">
	    <div class="container">
	        <div class="row">
	            <!-- <div class="col-xl-5">
	                <div class="listings_details_sidebar">
	                    <div class="listings_details_sidebar__single contact_business22 text-center">
	                        <img src="<?php // bloginfo('stylesheet_directory'); ?>/assets/images/login-img.png" />
	                        <h3 class="listings_details_sidebar__title">Join our photographer community</h3>
	                        <p>We support you with an amazing team and online tools while you connect with new clients, edit your own photographs, and grow your income.</p>
	                        <div class="contact_business_details">
	                            
	                            <a href="<?php // echo home_url('/join-our-team/'); ?>" class="thm-btn contact_business_btn">Apply Now</a>
	                        </div>
	                    </div>
	                </div>
	            </div> -->
	            <div class="col-xl-8 offset-xl-2">
	                <div class="login-section">
	                    <?php if (!is_user_logged_in()): ?>

	                    	<?php the_content(); ?>
	                    	
	                    <?php endif; ?>

	                    <div class="contact-one__form__wrap">

	                    	<div class="contact-one__form">
	                    		<?php echo do_shortcode('[user_registration_my_account]'); ?>
	                    	</div>

	                    	<hr>

	                    <!-- <form action="#" class="contact-one__form">
	                        <div class="row">
	                            
	                            <div class="col-md-12">
	                                <div class="input-group">
	                                    <label>Email Address*</label>
	                                    <input type="email" name="name" placeholder="Enter Your Email Address">
	                                </div>
	                            </div>
	                            <div class="col-md-12">
	                                <div class="input-group" id="show_hide_password">
	                                    <label>Password*</label>
	                                    <input type="password" name="phone" placeholder="Enter Your Password">
	                                     <div class="input-group-addon">
	                                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
	                                              </div>
	                                </div>
	                            </div>
	                            <div class="col-md-12">
	                                <a href="#">Forgot password?</a>
	                            </div>
	                            
	                            <div class="col-md-12">
	                                <div class="input-group contact__btn">
	                                    <button type="submit" class="thm-btn contact-one__btn">Login</button>
	                                </div>
	                            </div>
	                            <div class="col-md-12">
	                                <p class="signup">Don't have an account? <a href="#">Sign Up!</a></p>
	                            </div>
	                        </div>
	                    </form> -->


	                </div>
	                </div>
	                
	            </div>
	            
	        </div>
	    </div>
	</section>

<?php
// get_sidebar();
get_footer(); ?>

<script type="text/javascript">

    $(document).ready(function() {

    	$('.user-registration-LostPassword').append('<p class="signup">Don\'t have an account? <a href="https://odhotels.in/sign-up/">Sign Up!</a></p>');

    	

	    /* $("#show_hide_password a").on('click', function(event) {
	        event.preventDefault();
	        if($('#show_hide_password input').attr("type") == "text"){
	            $('#show_hide_password input').attr('type', 'password');
	            $('#show_hide_password i').addClass( "fa-eye-slash" );
	            $('#show_hide_password i').removeClass( "fa-eye" );
	        }else if($('#show_hide_password input').attr("type") == "password"){
	            $('#show_hide_password input').attr('type', 'text');
	            $('#show_hide_password i').removeClass( "fa-eye-slash" );
	            $('#show_hide_password i').addClass( "fa-eye" );
	        }
	    }); */
	     
	});

</script>
