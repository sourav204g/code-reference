<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage My_Classic
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div class="container containerPadding productPage ">
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'myclassic' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Vorheriger Beitrag', 'myclassic' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . myclassic_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'myclassic' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Nächster Beitrag', 'myclassic' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . myclassic_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
				) );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->
</div>
<?php get_footer();
