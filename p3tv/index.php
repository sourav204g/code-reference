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
 * @package TravelTographer
 */

get_header();
?>

			<section class="page-header" style="background-image: url(<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/main-slider/slide_v1_7.jpg);   margin-bottom: 60px;">
				<div class="container">
					<h2>Welcome to our blog</h2>
					<ul class="thm-breadcrumb list-unstyled">
						<li><span>Authentic stories, unforgettable moments and memories created using the power of photography!<br>
						Book a photoshoot and support local.</span></li>
					</ul>
				</div>
			</section>

			<section class="blog_one two blog-page">
				<div class="container">
					<div class="row">

						<?php
						
						if ( have_posts() ) : while ( have_posts() ) : the_post(); 

							 $desc = wp_strip_all_tags(get_the_content());
							 
							 $length = 115; // paragraph length

							 if(strlen($desc) <= $length) {

							 } else { 
							   $desc = substr($desc, 0, $length) . '...'; ?>
							 <?php }  

							?>

								<div class="col-xl-4">
								<!--Blog One single-->
								<div class="blog_one_single wow fadeInUp" data-wow-delay="100ms">
									<div class="blog_image"><img alt="Blog One Image" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>"></div>
									<div class="blog-one__content">
										<ul class="list-unstyled blog-one__meta">
											<li>
												<a href="#"><i class="far fa-user-circle"></i>By Admin</a>
											</li>
										</ul>
										<div class="blog_one_title">
											<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
										</div>
										<div class="blog_one_text">
											<p><?php echo $desc; ?></p>
										</div>
										<div class="blog_one_date">
											<p><?php the_time( 'j' ); ?><br><?php the_time( 'M' ); ?><br></p>
										</div>
									</div>
								</div>
								</div>

						<?php endwhile;

							the_posts_navigation();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
						
					</div>
				</div>
			</section>



			<?php get_template_part( 'template-parts/content', 'book-photoshoot' ); ?>


<?php
// get_sidebar();
get_footer();
