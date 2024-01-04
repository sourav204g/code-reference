<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

			<section class="error-404 not-found ">
				<header class="page-header">
					<h3 class="page-title">Entschuldigung - Diese Seite existiert nicht mehr.</h3>
				</header><!-- .page-header -->
				<div class="page-content">
					<p>Schauen Sie sich gerne um. Möchten Sie auf unserer Webseite suchen?</p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
</div>

<?php get_footer();
