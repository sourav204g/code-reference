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
<div class="blog has-sidebar">
<div class="container containerPadding productPage ">
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/post/content_blog', get_post_format() );	

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'myclassic' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Vorheriger Beitrag', 'myclassic' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . myclassic_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'myclassic' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Nächster Beitrag', 'myclassic' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . myclassic_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
				) );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div id="secondary">	
	<?php if ( is_active_sidebar( 'blog-side-bar' ) ) : ?>
		<?php dynamic_sidebar( 'blog-side-bar' ); ?>
	<?php endif; ?>
	</div>	
	
</div><!-- .wrap -->
</div></div>
<?php get_footer();
