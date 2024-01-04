<?php
/**
 * Template Name: Contact Us
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

	<style> .pf-title { margin-bottom: 0px; } </style>

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 column">
						<div class="contact-form">
							<!-- <h3>Keep In Touch</h3> -->
							<?php echo do_shortcode('[contact-form-7 id="480" title="Contact Us Page"]'); ?>
						</div>
					</div>
					<div class="col-lg-6 column">
						<div class="contact-textinfo">
							<h3>Handyman Pro's Office</h3>
							
							<ul>
								<li><i class="la la-map-marker"></i><span><?php echo get_field('handyman_contact_address', 'option'); ?></span></li>
								<li><i class="la la-phone"></i><span>Call Us : <?php echo get_field('handyman_contact_phone_no', 'option'); ?></span></li>

								<?php if (get_field('handyman_contact_fax', 'option')): ?>
									<li><i class="la la-fax"></i><span>Fax : <?php echo get_field('handyman_contact_fax', 'option'); ?></span></li>
								<?php endif; ?>

								<li><i class="la la-envelope-o"></i><span>Email : <?php echo get_field('handyman_contact_email', 'option'); ?></span></li>

							</ul>

							<?php if (get_field('handyman_contact_google_map', 'option')): ?>
								<a class="fill" href="<?php echo get_field('handyman_contact_google_map', 'option'); ?>" style="display: block; width: 100%; text-align: center;">See on Map</a>
							<?php endif; ?>

							<!-- <a class="fill" href="#" style="display: block; width: 100%; text-align: center;">See on Map</a> --><!-- <a href="#" title="">Directions</a> -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


<?php
get_footer();