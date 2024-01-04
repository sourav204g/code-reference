<?php
/**
 * Template Name: Pro Dashboard
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

get_template_part( 'inc/dashboard', 'functions' );

get_header(); ?>


	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>

		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">

					<?php get_template_part( 'inc/pro', 'navigation' ); ?>

					<div class="col-lg-9 column">
						<div class="padding-left mtt58">
							<div class="manage-jobs-sec">
								<h3>PRO Dashboard</h3>
								<div class="cat-sec">
									<div class="row no-gape">
										<!-- <div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="<?php // echo get_site_url() . '/job-alert/'; ?>" title=""><i class="fa fa-bell-o" aria-hidden="true"></i> <span>Job Alerts</span>
												<p>14 Applications</p></a>
											</div>
										</div> -->
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="<?php echo get_site_url() . '/manage-schedule/'; ?>"><i class="fa fa-calendar" aria-hidden="true"></i> <span>Manage Schedule</span></a>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="<?php echo get_site_url() . '/manage-zipcodes/'; ?>" ><i class="fa fa-map-marker" aria-hidden="true"></i> <span>Manage Zipcode</span></a>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="<?php echo get_site_url() . '/manage-inventory/'; ?>"><i class="fa fa-wrench" aria-hidden="true"></i> <span>Manage Tools Inventory</span></a>
											</div>
										</div>
									</div>
								</div>
								<div class="cat-sec">
									<div class="row no-gape">
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category follow-companies-popup">
												<a href="<?php echo get_site_url() . '/manage-skills/'; ?>"><i class="fa fa-hand-rock-o" aria-hidden="true"></i><span>Manage Skills</span></a>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="<?php echo get_site_url() . '/edit-profile/'; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Edit Profile</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


<?php
get_footer();