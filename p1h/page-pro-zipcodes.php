<?php
/**
 * Template Name: Pro Manage Zipcodes
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

get_header(); 

wp_localize_script( 'handyman-zipcodes', 'pro-zipcodes' , array('county' => 'sourav') );

?>


	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>

	<style>
		.tags > .addedTag { background: #bec9ff; }
		.tags { border: none; padding-left: 0px; }
	</style>


	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">


					<?php get_template_part( 'inc/pro', 'navigation' ); ?>


					<div class="col-lg-9 column mt088">

						<div class="profile-title">
							<h3>Manage Zipcode</h3>
						</div>

						<?php if ( !isset($zipcodeError) && isset($_GET['status']) && $_GET['status'] === 'success' ): ?>

							<div class="row">
									<div class="col-lg-12">
										<p class="success" style="padding-left: 30px; border: 1px solid; color: green;    font-size: 14px;">Zipcode Updated.</p>
									</div>
							</div>
							
						<?php endif; ?>

						<?php if ( isset($zipcodeError) ): ?>

							<div class="row">
									<div class="col-lg-12">
										<p class="error" style="padding-left: 30px; border: 1px solid; padding-top: 5px; padding-bottom: 5px;"><?php echo $zipcodeError; ?></p>
									</div>
							</div>
							
						<?php endif; ?>


						<form method="post" action="" id="pro-manage-zipcodes">

							<div class="profile-form-edit">
							
								<div class="row">
									
									<div class="col-lg-4">
										<span class="pf-title">Select State</span>
										<div class="pf-field">
											<select class="select-state" name="select_state" required>

												<option value="">Select State</option>

												<?php foreach (get_field('handyman_manage_zipcode', 'option') as $key => $handyman_manage_state): ?>

													<?php $states[] = $handyman_manage_state['handyman_select_state__city']; ?>

												<?php endforeach; ?>

												<?php foreach ( array_unique($states) as $key => $state ): ?>

													<option value="<?php echo $state; ?>"><?php echo $state; ?></option>
													
												<?php endforeach; ?>

											</select>
										</div>
									</div>

									<div class="col-lg-4">
										<span class="pf-title">Select County</span>
										<div class="pf-field">
											<select class="select-county" id="select-county" name="select_county" required>
												<option value="">Select County</option>
											</select>
										</div>
									</div>
									
									<div class="col-lg-4">
										<span class="pf-title">Select City</span>
										<div class="pf-field">
											<select class="select-city" id="select-city" name="select_city" required>
												<option value="">Select City</option>
											</select>
										</div>
									</div>
									
									<hr>
									<div class="col-lg-12">
										<span class="pf-title">Select Your Service Area Zipcode</span>
									</div>
									
									<div class="col-lg-12">
										<div class="row check85">

												<div class="col-lg-12" id="zipcodes">

													<!-- <span>
															<input id="fdg" name="prozip[]" type="checkbox" value="751004">
															<label for="fdg" style="padding: 0 2em 2em 2em;">751004</label>
													</span> -->
													
												</div>
												
										</div>
										<div class="col-lg-12" style="padding-left: 0px;">
											<button type="submit" name="manage_zipcodes_pro_form">Update</button>
										</div>
									</div>
							
								</div>
							</div>
						
						<div class="padding-left">
							<div class="manage-jobs-sec">

								

								<div class="change-password" style="margin-top: 35px;">
									

										<?php wp_nonce_field('avengers_infinity_war', 'handyman_pro_nonce'); ?>

										<div class="row">
											<div class="col-lg-12">
												<span class="pf-title">Added Zipcodes</span>
												<div class="pf-field no-margin">

													<ul class="tags" style="margin-bottom: 0px;">

														<?php if ( get_field('pro_working_zipcodes', $_SESSION['posttype_pro_id']) ): ?>
															
														<?php foreach (get_field('pro_working_zipcodes', $_SESSION['posttype_pro_id']) as $key => $pro_working_zipcode): ?>

															<li class="addedTag" data-zip="<?php echo esc_html( $pro_working_zipcode['pro_zipcode'] ); ?>"><?php echo esc_html( $pro_working_zipcode['pro_zipcode'] ); ?><span class="tagRemove zipRemove">x</span></li>
															
														<?php endforeach; ?>

														<?php else: ?>

															<li class="addedTag" style="font-style: italic;">Empty</li>

														<?php endif; ?>

													</ul>

												</div>
											</div>
										</div>
								</div>
							</div>
						</div>


							
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

		


<?php
get_footer();