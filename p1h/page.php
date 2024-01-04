<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package handyman_pro
 */


get_header(); ?>


	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="terms-conditions">

							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

								<?php the_content(); ?>

							<?php endwhile; endif; ?>
				
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


<?php
get_footer();
