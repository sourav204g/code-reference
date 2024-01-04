<?php
/**
 * Template Name: Home
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

$gallery = get_field('traveltographer_hero_images');
$size = 'full'; 

$gallery_arr = array();

foreach( $gallery as $ga ):

	$gallery_arr[]['src'] = esc_url($ga['url']);

endforeach;

$locations = get_terms( array( 
      'taxonomy' => 'locations',
      'hide_empty' => false,
) );

// echo '<pre>';
// var_dump(json_encode($gallery_arr));
// exit;

get_header(); ?>

	<!-- Banner Section One Start -->
	<section class="banner-one">
	    <div class="banner-bg-slide"
	        data-options='{ "delay": 5000, "slides": <?php echo json_encode($gallery_arr); ?>, "transition": "fade", "timer": false, "align": "top" }'>
	    </div><!-- /.banner-bg-slide -->

	    <div class="container">
	        <div class="content-box">
	            <div class="top-title">
	                <div class="sub-title">Let’s Explore</div>
	                <h1><?php echo get_field('traveltographer_hero_image_title'); ?></h1>
	                <p><?php echo get_field('traveltographer_hero_image_sub_title'); ?></p>
	            </div>
	            <form method="GET" action="<?php echo home_url('/photographers/'); ?>" class="banner_one_form select_one">
	                <ul class="input_box_inner list-unstyled">
	                    <!-- <li class="input_box">
	                        <input type="text" name="listing_name" placeholder="What are you looking for?">
	                    </li> -->
	                    <li class="input_box banner_one_select_one">
	                        
                                
	                        <select class="selectpicker" name="loc" data-width="100%">
	                             <option selected="selected">Enter Your Destination Name</option>
	                             <option>UAE</option>
                                    
	                            <?php foreach ($locations as $key => $location): ?>
	                            <option value="<?php echo $location->term_id; ?>"><?php echo $location->name; ?></option> 
	                            <?php endforeach; ?>
	                        </select>
	                    </li>
	                    
	                </ul>
	                <div class="banner_one_form_btn">
	                    <button class="thm-btn" type="submit"><span
	                            class="icon-magnifying-glass"></span>Search</button>
	                </div>
	            </form>
	        </div>
	        <div class="banner_one_bottom">
	            <div class="banner_one_bottom_bg"
	                style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/shapes/banner-1-shape-1.png)">
	            </div>
	            <p>Or browse the selected Destination</p>
	        </div>
	    </div>
	</section>

	<?php get_template_part( 'template-parts/content', 'brand' ); ?>

	<?php get_template_part( 'template-parts/content', 'how-it-works' ); ?>

	<?php get_template_part( 'template-parts/content', 'places' ); ?>

	<?php get_template_part( 'template-parts/content', 'types' ); ?>

	<?php get_template_part( 'template-parts/content', 'why-best' ); ?>
	
	<?php get_template_part( 'template-parts/content', 'top-destination' ); ?>

	<?php get_template_part( 'template-parts/content', 'two-sections' ); ?>

	<?php get_template_part( 'template-parts/content', 'testimonial' ); ?>

	<?php get_template_part( 'template-parts/content', 'blog' ); ?>

	

<?php
// get_sidebar();
get_footer();
