<?php
/**
 * Template Name: Photographers
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

						$photography_type = $_GET['type'] ?? '';
						$photographer_location = $_GET['loc'] ?? '';

						$photographer_city = strtolower($_GET['city']) ?? '';

						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  


						if (!empty($photography_type) && !empty($photographer_location) && !empty($photographer_city) ) {
							
							$the_query = new WP_Query(array(
								'post_type' => 'photographers',
								'posts_per_page' => -1,
								'paged'     => $paged,
								'meta_query'     => array(
										array(
											'key'     => 'traveltographer_city',
											'value'   => $photographer_city,
											'compare' => '=',
										)
								),
								'tax_query' => array(
										'relation' => 'AND',
										array(
											'taxonomy'         => 'photography_types',
											'field'            => 'id',
											'terms'            => $photography_type,
											// 'include_children' => true,
											'operator'         => 'IN',
										),
										array(
											'taxonomy'         => 'locations',
											'field'            => 'id',
											'terms'            => $photographer_location,
											// 'include_children' => true,
											'operator'         => 'IN',
										)
									),
								'post_status' => array('publish', 'pending'),
							));

						} else if( !empty($photographer_location) ) {


							$the_query = new WP_Query(array(
								'post_type' => 'photographers',
								'posts_per_page' => -1,
								'paged'     => $paged,
								'tax_query' => array(
										'relation' => 'AND',
										array(
											'taxonomy'         => 'locations',
											'field'            => 'id',
											'terms'            => $photographer_location,
											// 'include_children' => true,
											'operator'         => 'IN',
										)
									),
								'post_status' => array('publish', 'pending'),
							));


						} else {

							$the_query = new WP_Query(array(
								'post_type' => 'photographers',
								'paged'     => $paged,
								'posts_per_page' => -1,
								'post_status' => array('publish', 'pending'),
							));
						}

get_header(); ?>


			<section class="page-header" style="background-image: url(<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/main-slider/slide_v1_3.jpg);">
			    <div class="container">
			        <h2>Browse photographers in 50+ locations<br/> around the world</h2>
			        <!-- <ul class="thm-breadcrumb list-unstyled">
			            <li><span>Are you a photographer? <a href="#">Apply Now</a></span></li>
			        </ul> -->
			    </div>
			</section>

			<?php get_template_part( 'template-parts/content', 'filter' ); ?>
					
	        <section class="listings_three-page">
	            <div class="container">

	                <div class="block-title text-center">
	                    <h4>Explore Our categories</h4>
	                    <?php // the_content(); ?>
	                </div>

	                <div class="row">
	                   
	                	<?php if ($the_query->have_posts()): while($the_query->have_posts()): $the_query->the_post(); 

	                		$locations = wp_get_post_terms($post->ID, 'locations');

	                		?>

	                		<?php if ( get_field('traveltographer_email_verification_status') && get_field('traveltographer_account_status') ): ?>

	                		<div class="col-xl-4">
	                		    <div class="listings_three-page_single wow fadeInUp" data-wow-delay="0ms"
	                		        data-wow-duration="1200ms">
	                		        <div class="listings_three-page_image">
	                		            <div class="photograper_listings_carousel owl-carousel owl-theme">

	                		            	<?php $tr_images = get_field('traveltographer_gallery'); ?>

	                		            	<?php foreach ( $tr_images as $key => $tr_image ): ?>

	                		            		<?php // echo '<pre>'; var_dump($tr_image); ?>

	                		            		<div class="item">
	                		            			<img src="<?php echo $tr_image['sizes']['medium_large']; ?>" alt="<?php echo $tr_image['alt']; ?>">
	                		            		</div>
	                		            		
	                		            	<?php endforeach; ?>

	                		                
	                		            </div>
	                		            <div class="author_img">
	                		                <img src="assets/images/team/team-1-img-1.jpg" alt="">
	                		            </div>
	                		        </div>
	                		        <div class="listings_three-page_content">
	                		            <div class="box-title">
	                		                <h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
	                		                <h4><i class="fas fa-map-marker-alt"></i> <?php echo ucfirst(get_field('traveltographer_city')); ?>, <?php echo $locations[0]->name; ?></h4>
	                		                <?php echo the_content(); ?>
	                		            </div>
	                		            <div class="listings_three-page_content_bottom">
	                		                <div class="left">
	                		                    <a href="<?php echo get_permalink(); ?>">View Profile</a>
	                		                </div>
	                		                <div class="right">
	                		                    <a href="<?php echo get_permalink(); ?>">Book Us!</a>
	                		                </div>
	                		            </div>
	                		        </div>
	                		    </div>
	                		</div>

	                		<?php endif; ?>
	                		
	                	<?php endwhile; endif; wp_reset_postdata(); ?>
	                    
	                   
	                </div>
	            </div>
	        </section>

			

<?php
// get_sidebar();
get_footer();
