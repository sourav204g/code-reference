<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TravelTographer
 */

get_header();
?>

		<?php
		while ( have_posts() ) :
			the_post(); ?>


			<section class="page-header" style="background-image: url(<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/main-slider/slide_v1_4.jpg);">
					<div class="container">
						<h2><?php the_title(); ?></h2>
						<!-- <ul class="thm-breadcrumb list-unstyled">
							<li><span>Authentic stories, unforgettable moments and memories created using the power of photography!<br>
							Find your photographer and support local.</span></li>
						</ul> -->
					</div>
			</section><!--Blog Deail Start-->


				<section class="blog_detail">
					<div class="container">
						<div class="row">
							<div class="col-xl-12 col-lg-12">
								<div class="blog_detail_left">
									<div class="blog-detail_image_box"><img alt="" src="assets/images/main-slider/slide_v1_6.jpg"></div>
									<div class="blog-detail__content">
										<ul class="list-unstyled blog-detail__meta">
											<li>
												<a href="#"><i class="far fa-user-circle"></i>by Admin</a>
											</li>
											<li>
												<a href="#"><i class="far fa-clock"></i> <?php the_time('F jS, Y'); ?></a>
											</li>
										</ul>
										<div class="blog_detail_date">
											<p><?php the_time( 'j' ); ?><br><?php the_time( 'M' ); ?></p>
										</div>
										<div class="blog_detail_title">
											<h3><?php the_title(); ?></h3>
										</div>
										<div class="blog_detail_text">
											<?php the_content(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<hr>

						<?php 

						the_post_navigation(
										array(
											'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'traveltographer' ) . '</span> <span class="nav-title">%title</span>',
											'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'traveltographer' ) . '</span> <span class="nav-title">%title</span>',
										)
									);

						?>
						
					</div>
				</section>

				<?php get_template_part( 'template-parts/content', 'book-photoshoot' ); ?>


		<?php endwhile; // End of the loop. ?>

<?php
// get_sidebar();
get_footer();
