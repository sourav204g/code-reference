<?php
/**
 * Template Name: Contact
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
				.wpcf7-form-control-wrap { display: block; width: 100%; }
			</style>

			<!--Main Bottom Start-->
	        <section class="inner_bg">
	            <div class="container">
	                <div class="row">
	                    <div class="col-xl-12 col-lg-12">
	                        <div class="main_bottom_left">
	                            <div class="main_bottom_content">
	                                 <div class="main_bottom_left_title">
	                                   <h3>Contact Us</h3>
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
	                    
	                    <div class="col-xl-7">
	                        <div class="block-title text-left">
	                                <h4>contact us</h4>
	                                
	                                <?php the_content(); ?>
	                            </div>
		                        <div class="contact-one__form__wrap">
		                            <?php echo do_shortcode( '[contact-form-7 id="161" title="Contact Us"]' ); ?>
		                        </div>
	                    </div>
	                    <div class="col-xl-5">
	                        <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" style="width:100%; border-radius: 15px;" />
	                    </div>
	                </div>
	            </div>
	        </section>

	          <!--Two Section Start-->
	        	<!-- <section class="two_section">
	            <div class="container-full-width">
	                <div class="row">
	                    <div class="col-xl-6">
	                        <div class="section_one">
	                            <div class="section_one_bg"
	                                style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/resources/two-setion-img-1.jpg); background: #0a1d4b;"></div>
	                            <div class="section_one_content">
	                                <h2>Join as a photographer</h2>
	                                
	                                <div class="section_one_btn">
	                                    <a href="#" class="thm-btn">Apply Now</a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-xl-6">
	                        <div class="section_two">
	                            <div class="section_two_bg"
	                                style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/resources/two-setion-img-2.jpg); background: #0c286b;;"></div>
	                            <div class="section_two_content">
	                                <h2>FAQ's: Questions?</h2>
	                               
	                                <div class="section_one_btn">
	                                    <a href="#" class="thm-btn">Start here</a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        	</section> -->

<?php
// get_sidebar();
get_footer(); ?>
