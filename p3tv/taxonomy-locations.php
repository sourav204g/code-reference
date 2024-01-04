<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TravelTographer
 */

global $wpdb;

$current_location = get_queried_object();

// echo "<pre>";
// var_dump($current_location->description);

$the_query = new WP_Query(array(
								'post_type' => 'photographers',
								'posts_per_page' => -1,
								'paged'     => $paged,
								'tax_query' => array(
										array(
											'taxonomy'         => 'locations',
											'field'            => 'id',
											'terms'            => $current_location->term_id,
											// 'include_children' => true,
											'operator'         => 'IN',
										)
									),
								'post_status' => array('publish', 'pending'),
							));

get_header();
?>

	
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
	                    <?php echo $current_location->description; ?>
	                </div>
	                <div class="row">
	                   
	                	<?php if ($the_query->have_posts()): while($the_query->have_posts()): $the_query->the_post();


	                		if ($post->post_status == 'publish')  : ?>

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
	                		                <?php if (get_the_post_thumbnail_url($post->ID)): ?>
        		                        		<img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="profile picture">
        		                        	<?php else: ?>
        		                        		<img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/team/blank-profile-picture.webp" alt="profile picture">
        		                        	<?php endif; ?>
	                		            </div>
	                		        </div>
	                		        <div class="listings_three-page_content">
	                		            <div class="box-title">
	                		                <h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
	                		                <!-- <h4><i class="fas fa-map-marker-alt"></i> Charleston, USA</h4> -->
	                		                <?php the_content(); ?>
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

	                		<?php else: if (get_field('traveltographer_email_verification_status') && get_field('traveltographer_account_status')) :


	                			$fetch_account_data = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM tvl_prev_accinfo WHERE profile_id = %d", array( $post->ID ) ), 'ARRAY_A');

	                			$info = json_decode( (string) $fetch_account_data['account_data'], true );

	                			// echo "<pre>";
	                			// var_dump($info);


	                			?>

	                			<div class="col-xl-4">
	                			    <div class="listings_three-page_single wow fadeInUp" data-wow-delay="0ms"
	                			        data-wow-duration="1200ms">
	                			        <div class="listings_three-page_image">
	                			            <div class="photograper_listings_carousel owl-carousel owl-theme">

	                			            	<?php $tr_images = $info['images']; ?>

	                			            	<?php foreach ( $tr_images as $key => $tr_image ): ?>

	                			            		<?php // echo '<pre>'; var_dump($tr_image); ?>

	                			            		<div class="item">
	                			            			<img src="<?php echo $tr_image; ?>" alt="image">
	                			            		</div>
	                			            		
	                			            	<?php endforeach; ?>
	                			                
	                			            </div>
	                			            <div class="author_img">
    	                		                <?php if (get_the_post_thumbnail_url($post->ID)): ?>
            		                        		<img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="profile picture">
            		                        	<?php else: ?>
            		                        		<img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/team/blank-profile-picture.webp" alt="profile picture">
            		                        	<?php endif; ?>
	                			            </div>
	                			        </div>
	                			        <div class="listings_three-page_content">
	                			            <div class="box-title">
	                			                <h3><a href="<?php echo get_permalink(); ?>"><?php echo $info['name']; ?></a></h3>
	                			                <!-- <h4><i class="fas fa-map-marker-alt"></i> Charleston, USA</h4> -->
	                			                <p><?php echo $info['bio']; ?></p>
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

	                		<?php endif; endif; ?>
	                		
	                	<?php endwhile; else: ?>

	                	<div class="col-xl-4">Coming Soon!</div>

	                	<?php endif; wp_reset_postdata(); ?>
	                    
	                   
	                </div>
	            </div>
	        </section>


<?php
// get_sidebar();
get_footer();
