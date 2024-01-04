<?php
/**
 * Template Name: Pro Login
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

get_template_part( 'inc/pro', 'login' );

get_header(); ?>


	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>


	<section>
		<div class="block remove-bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="pro-login">
							<div class="account-popup-area static">
								<div class="account-popup">
									<h2>PRO LOGIN</h2>

									<?php global $hnx_login_error;

									 if( isset($hnx_login_error) && $hnx_login_error !== '') : // Display Error ?>

										<p class="error"><?php echo $hnx_login_error; ?></p>

									<?php endif; ?>		

									<form method="post" action="">

										<?php wp_nonce_field('avengers_infinity_war', 'handyman_pro_nonce'); ?>

										<div class="cfield">
											<input placeholder="Username" name="pro_username" type="text"> <i class="la la-user"></i>
										</div>

										<div class="cfield">
											<input placeholder="Password" name="pro_password" type="password"><i class="la la-key"></i>
										</div>

											<!-- <p class="remember-label">
												<input id="cb1" name="cb" type="checkbox">
												<label for="cb1">Remember me</label>
											</p> -->

										<a href="#" title="">Forgot Password?</a> <button name="pro_login" type="submit">Login</button>

									</form>

								</div>
							</div><!-- LOGIN POPUP -->
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


<?php
get_footer();
