<?php
/**
 * Template Name: Categories
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

$locations = get_terms( array( 
			      'taxonomy' => 'photography_types',
			      'hide_empty' => false,
 ) );

get_header(); ?>

			<!--Page Header Start-->
	        <section class="page-header" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID); ?>);">
	            <div class="container">
	                <h2>Photo Shooting Occasions</h2>
	                <!-- <ul class="thm-breadcrumb list-unstyled">
	                    <li><span>Are you a photographer? <a href="<?php // echo home_url('/join-our-team/'); ?>">Apply Now</a></span></li>
	                </ul> -->
	            </div>
	        </section>

			<?php get_template_part( 'template-parts/content', 'filter' ); ?>


	        <!--How It Works-->
	        <section class="four_boxes" style="padding-top: 10px;">
	            <div class="container">
	                <div class="block-title text-center">
	                    <h4>LET’S FIND OUT</h4>
	                    <?php the_content(); ?>
	                </div>
	                <div class="row location-main">

	                	<?php foreach ($locations as $key => $location): ?>

	                		<div class="col-xl-3 col-lg-6 col-md-6">
	                		   <!--Popular Places Single-->
	                		        <div class="popular_places_single">
	                		            <div class="popular_places_image">
	                		                <img class="w100" src="<?php echo get_field('traveltographer_destination_image', 'locations_' . $location->term_id)['url']; ?>" alt="<?php echo get_field('traveltographer_destination_image', 'locations_' . $location->term_id)['alt']; ?>">
	                		                
	                		                <div class="popular_places_text">
	                		                    <p>Enjoy in</p>
	                		                    <h3><?php echo $location->name; ?></h3>
	                		                </div>
	                		            </div>
	                		            <div class="popular_places_hover">
	                		                <div class="popular_places_hover_circle">
	                		                    <a href="<?php echo get_category_link( $location->term_id ); ?>"><span class="icon-right-arrow"></span></a>
	                		                </div>
	                		                <p>Enjoy in</p>
	                		                <h3><?php echo $location->name; ?></h3>
	                		            </div>
	                		        </div>
	                		</div>
	                		
	                	<?php endforeach; ?>

	            </div>
	        </section>	      

			<?php get_template_part( 'template-parts/content', 'book-photoshoot' ); ?>

<?php
// get_sidebar();
get_footer(); ?>