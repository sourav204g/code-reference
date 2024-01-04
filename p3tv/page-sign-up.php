<?php
/**
 * Template Name: Signup
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

get_header(); ?>

			<style>

				.ur-frontend-form { border: none; padding: 0px; }

				.form-row .input-text::-webkit-input-placeholder { /* Edge */
				  color: #828892 !important;
				}

				.form-row .input-text:-ms-input-placeholder { /* Internet Explorer */
				  color: #828892 !important;
				}

				.form-row .input-text::placeholder {
				  color: #828892 !important;
				}

				.ur-frontend-form .ur-form-row .ur-form-grid {
/*				    display: grid;*/
    				grid-template-columns: 1fr 1fr;
				    column-gap: 30px;
				}

				.field-user_email { grid-column: 1 / 3; }

				.form-row {
				    display: flex;
				    flex-direction: column;
				}

				.form-row .ur-label {
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


			</style>

			<!--Main Bottom Start-->
	        <section class="inner_bg">
	            <div class="container">
	                <div class="row">
	                    <div class="col-xl-12 col-lg-12">
	                        <div class="main_bottom_left">
	                            <div class="main_bottom_content">
	                                 <div class="main_bottom_left_title">
	                                   <h3>Sign Up</h3>
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
	                    <div class="col-xl-5">
	                        <div class="listings_details_sidebar">
	                            <div class="listings_details_sidebar__single contact_business22 text-center">
	                                <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/login-img.png" />
	                                <h3 class="listings_details_sidebar__title">Join our photographer community</h3>
	                                <p>We support you with an amazing team and online tools while you connect with new clients, edit your own photographs, and grow your income.</p>
	                                <div class="contact_business_details">
	                                    
	                                    <a href="#" class="thm-btn contact_business_btn">Apply Now</a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-xl-7">
	                        <div class="login-section">
	                            <?php the_content(); ?>

	                            <div class="contact-one__form__wrap">

	                            <?php echo do_shortcode( '[user_registration_form id="206"]' ); ?>

	                            <hr>

	                            <!-- <form action="#" class="contact-one__form">
	                                <div class="row">
	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>First name</label>
	                                            <input type="text" name="name" placeholder="Enter Your first name">
	                                        </div>
	                                    </div>

	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Last name</label>
	                                            <input type="text" name="name" placeholder="Enter Your last name">
	                                        </div>
	                                    </div>
	                                    
	                                    <div class="col-md-12">
	                                        <div class="input-group">
	                                            <label>Email Address*</label>
	                                            <input type="email" name="name" placeholder="Enter Your Email Address">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="input-group" id="show_hide_password">
	                                            <label>Password*</label>
	                                            <input type="password" name="phone" placeholder="Enter Your Password">
	                                             <div class="input-group-addon">
	                                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
	                                                      </div>
	                                        </div>
	                                    </div>
	                                     <div class="col-md-6">
	                                        <div class="input-group" id="show_hide_password">
	                                            <label>Re-type password*</label>
	                                            <input type="password" name="phone" placeholder="Enter Your Password">
	                                             <div class="input-group-addon">
	                                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
	                                                      </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-12">
	                                        <p class="signup2">By creating an account, you accept the <a href="#">Terms of Service </a>and <a href="#">Privacy Policy.</a></p>
	                                    </div>
	                                    
	                                    <div class="col-md-12">
	                                        <div class="input-group contact__btn">
	                                            <button type="submit" class="thm-btn contact-one__btn">Sign Up</button>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-12">
	                                        <p class="signup">Already have an account? <a href="#">Log in.</a></p>
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

    	$('[type="text"]').keyup(function(){
    		
    		var input = $(this).val();
    		var filter = input.replace(/[0-9]/g, "");

    		$(this).val(filter);

    		//console.log(/\d/.test(input));
    		
    		
    	});

    	$('.ur-button-container').prepend('<p class="signup2">By creating an account, you accept the <a href="#">Terms of Service </a>and <a href="#">Privacy Policy.</a></p>');

    	$('.ur-button-container').append('<p class="signup signin">Already have an account? <a href="https://odhotels.in/sign-in/">Log in.</a></p>');

    	
    
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
