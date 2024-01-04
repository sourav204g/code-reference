<?php
/**
 * Template Name: Pricing
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

			<!--Page Header Start-->
	        <section class="page-header" style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/main-slider/slide_v1_2.jpg);">
	            <div class="container">
	                <h2>Select a Package<br/> Which Fits You the Best.</h2>
	                <!-- <ul class="thm-breadcrumb list-unstyled">
	                    <li><span>Are you a photographer? <a href="#">Apply Now</a></span></li>
	                </ul> -->
	            </div>
	        </section>

			<?php // get_template_part( 'template-parts/content', 'filter' ); ?>

	         <!--pricing one Start-->
	        <section class="pricing_one" style="    margin-top: 60px;">
	            <div class="container">
	                <div class="block-title text-center">
	                    <h4>LET’S FIND OUT</h4>
	                    <?php the_content(); ?>
	                </div>
	                <div class="row">

	                	<?php if( have_rows('traveltographer_pricing') ):

	        				    // Loop through rows.
	        				    while( have_rows('traveltographer_pricing') ) : the_row();

	        				        // Load sub field value.
	        				        $travel_package_name = get_sub_field('travel_package_name'); 
	        				        $travel_package_price = get_sub_field('travel_package_price'); 

	        				        $travel_package_minutes = get_sub_field('travel_package_minutes');
	        				        $travel_package_photos = get_sub_field('travel_package_photos');
	        				        $travel_package_location = get_sub_field('travel_package_location');
	        				        $travel_package_note = get_sub_field('travel_package_note');


	        				        ?>

	        				        <div class="col-xl-4">
				                        <!--Pricing One _single-->
				                        <div class="pricing_one_single wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1200ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 0ms; animation-name: fadeInUp;">
				                            <div class="pricing_one_top">
				                                <p><?php echo $travel_package_name; ?></p>
				                                <h2><?php echo $travel_package_price; ?></h2>
				                            </div>
				                            <ul class="pricing_one_list list-unstyled">
				                                <li><i class="far fa-clock"></i><?php echo $travel_package_minutes; ?></li>
				                                <li><i class="fas fa-file-image"></i><?php echo $travel_package_photos; ?></li>
				                                <li><i class="fas fa-map-marker-alt"></i><?php echo $travel_package_location; ?></li>
				                                <li><i class="fas fa-laptop"></i><?php echo $travel_package_note; ?></li>
				                            </ul>
				                            <div class="pricing_one_btn">
				                                <a href="#" class="thm-btn" type="button" data-toggle="modal" data-target="#exampleModal" data-package="<?php echo $travel_package_name; ?>">Request Now</a>
				                            </div>
				                            
				                        </div>
				                    </div>


	        			<?php  endwhile; endif; ?>





	                    
	        			<div style="width: 100%;">
	        				<ul class="thm-breadcrumb list-unstyled">
	        				    <li><span style="color:#000;">Are you a photographer? <a href="<?php echo home_url('/join-our-team/'); ?>">Apply Now</a></span></li>
	        				</ul>
	        			</div>
	                   
	                 

	                </div>
	            </div>
	        </section>

			<?php get_template_part( 'template-parts/content', 'book-photoshoot' ); ?>

<?php
// get_sidebar();
get_footer();
