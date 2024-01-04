<?php
/**
 * Template Name: Reviews
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
	                <h2>Thank You<br/> for Your Awesome Reviews!</h2>
	            </div>
	        </section>

			<?php get_template_part( 'template-parts/content', 'filter' ); ?>

	        <!--Testimonials One Start-->
	        <section class="testimonials_onetwo">
	           
	            <div class="container">
	               
	                <div class="row">
	                    <div class="col-xl-12">
	                         <div class="block-title text-center">
	                            <h4>Our testimonials</h4>
	                            <h2>What They Say</h2>
	                            <p>Why customers love Traveltographer. Over 2 million photos captured!</p>
	                        </div>
	                        <div class="testimonials_onetwo_carousel">

	                        	<?php 

	                        		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
	                        		
	                        		$the_query = new WP_Query(array(
	                        			'post_type' => 'testimonials',
	                        			'post_status' => 'publish',
	                        			'paged'     => $paged,
	                        			'post_per_page' => -1
	                        		));

	                        	?>

	                        	<?php if ($the_query->have_posts()): while($the_query->have_posts()) : $the_query->the_post(); ?>

	                        		<div class="testimonials_onetwo_single">
		                                <div class="shadow-box"></div>
		                                <div class="row">
		                                    <div class="col-xl-4 testimonials_onetwo_image">
		                                        <img src="<?php echo get_field('traveltographer_reviewer_image')['url']; ?>" />
		                                    </div>
		                                     <div class="col-xl-8">
		                                         <div class="testimonials_onetwo_text">
		                                    <div class="testimonials_onetwo_rating_box">

		                                    	<?php for ( $i= get_field('traveltographer_review_rating'); $i > 0; $i-- ) : ?>
		                                    			<a href="#"><i class="fa fa-star"></i></a>
		                                    	<?php endfor; ?>
		                                        
		                                    </div>
		                                    <div class="testimonials_onetwo_text_box">
		                                        <p><?php echo get_field('traveltographer_review'); ?></p>
		                                    </div>
		                                    <div class="testimonials_quote_icontwo">
		                                        <span class="icon-quote"></span>
		                                    </div>
		                                    <div class="customer_info">
		                                        <h3><?php the_title(); ?>,<span>Customer</span></h3>
		                                    </div>
		                                </div>
		                                     </div>
		                                </div>
		                               
		                            </div>

	                        		
	                        	<?php endwhile; endif; wp_reset_postdata(); ?>

	        
	                            

	                          
	                            
	                            
	                        </div>
	                    </div>
	                   
	                </div>
	            </div>
	        </section>

			<?php get_template_part( 'template-parts/content', 'book-photoshoot' ); ?>

<?php
// get_sidebar();
get_footer();
