<?php
/**
 * Template Name: Pro Change Password
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

	<style> .error {padding-left: 30px;} </style>

	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">

					<?php get_template_part( 'inc/pro', 'navigation' ); ?>
					
					<div class="col-lg-9 column">
						<div class="padding-left">
							<div class="manage-jobs-sec">
								<h3>Change Password</h3>


								<?php if ( isset($changeStatus) ): ?>

									<?php if ($changeStatus === 1): ?>
										<p class="error">All Fields are required.</p>
									<?php endif; ?>

									<?php if ($changeStatus === 2): ?>
										<p class="error">Password Missmatch. Try again.</p>
									<?php endif; ?>

									<?php if ($changeStatus === 3): ?>
										<p class="error">Old Password is incorrect.</p>
									<?php endif; ?>
									
								<?php endif; ?>



								<div class="change-password" style="margin-top: 35px;">
									<form method="post" action="" id="edit_profile_change_psw">
										<?php wp_nonce_field('avengers_infinity_war', 'handyman_pro_nonce'); ?>
										<div class="row">
											<div class="col-lg-6">
												<span class="pf-title">Old Password</span>
												<div class="pf-field">
													<input type="password" name="edit_pro_old_password" required>
												</div><span class="pf-title">New Password</span>
												<div class="pf-field">
													<input type="password" name="edit_pro_new_password" required>
												</div><span class="pf-title">Confirm Password</span>
												<div class="pf-field">
													<input type="password" name="edit_pro_confirm_password" required>
												</div><button type="submit" name="edit_profile_pro_chng_pass_form">Update</button>
											</div>
											<div class="col-lg-6">
												<i class="la la-key big-icon"></i>
											</div>
										</div>
									</form>
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