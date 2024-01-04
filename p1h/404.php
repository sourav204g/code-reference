<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package handyman_pro
 */

get_header();
?>

<section class="overlape">
		<div class="block no-padding">
			<div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php echo get_field('handyman_pro_pages_hero_banner')['url']; ?>) repeat scroll 50% 422.28px transparent;"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3>404 Page</h3>
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
								<h3>Page Not Found!</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="terms-conditions">

						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'handyman_pro' ); ?></h1>

						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search!', 'handyman_pro' ); ?></p>
			
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();





