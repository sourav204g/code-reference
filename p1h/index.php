<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package handyman_pro
 */

get_header();
?>


	<section class="overlape">
		<div class="block no-padding">
			<div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php echo get_field('handyman_pro_pages_hero_banner', 91)['url']; ?>) repeat scroll 50% 422.28px transparent;"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3>Blog</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="block no-padding gray">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner2">
							<div class="inner-title2">
								<h3>Blog</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- <section>
		<div class="block no-padding gray">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner2">
							<div class="inner-title2">
								<h3>Blog</h3>
								<?php // if (get_field('handyman_pro_pages_sub_heading', 91)): ?>
									<span><?php // echo get_field('handyman_pro_pages_sub_heading', 91); ?></span>
								<?php // endif; ?>
							</div>
							<div class="page-breacrumbs">
								<ul class="breadcrumbs">
									<li>
										<a href="<?php // echo home_url('/'); ?>" title="">Home</a>
									</li>
									<li>
										<a href="#" title="" style="pointer-events: none;">Blog</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="blog-sec">
							<div class="row" id="masonry">

								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								
								<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
									<div class="my-blog">
										<div class="blog-thumb">
											<a href="<?php the_permalink(); ?>" title="">

												<?php if (get_the_post_thumbnail_url($post->ID)): ?>

													<img alt="" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>">

												<?php else: ?>

													<img alt="" src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/resource/b1.jpg">
													
												<?php endif; ?>

												
											</a>
											<div class="blog-metas">
												<a href="<?php the_permalink(); ?>" title=""><?php echo get_the_date(); ?></a> <a href="<?php the_permalink(); ?>" title=""><?php echo get_comments_number(); ?> Comments</a>
											</div>
										</div>
										<div class="blog-details">
											
											<h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
											<?php the_excerpt(); ?>

											<a href="<?php the_permalink(); ?>" title="">Read More <i class="la la-long-arrow-right"></i></a>

										</div>
									</div>
								</div>

								<?php endwhile; ?>

								<?php else: ?>

									<div class="col-lg-12">
										<p>Nothing Found.</p>
									</div>
								
								<?php endif; ?>						
								
							</div>
						</div>
						<div class="pagination">
							<?php wp_pagenavi(); ?>
						</div><!-- Pagination -->
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
// get_sidebar();
get_footer();
