<?php /* Template Name: Mit titel */ ?>
<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage My_Classic
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div class="container containerPadding productPage ">
 <div class="wrap">
	<div id="primary" class="content-area txtSection">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div>
<!-- || Service Section || -->	
			
    <section class="serviceSection sections">
        <h2>Service</h2>
        <?php dynamic_sidebar('service_bottom_section');  ?>
    </section>
			<!-- || Service Section End || -->	<!--#primary -->
 </div><!-- .wrap -->
</div>

<?php get_footer();
