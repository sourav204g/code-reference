<?php
/**
 * Template Name: Edit Pro Profile
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


	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">

					<?php get_template_part( 'inc/pro', 'navigation' ); ?>

					<div class="col-lg-9 column mt088">
						<div class="padding-left">
							<div class="profile-title">
								<h3>Manage Profile</h3>

							</div>
							<div class="profile-form-edit" style="margin-top: 35px;">

								<?php
 
   								 if( isset($hnx_error) && $hnx_error !== '') : // Display Error ?>
 
 										<div class="row">
											<div class="col-lg-12">
												<p class="error" style="padding-left: 30px; border: 1px solid; padding-top: 5px; padding-bottom: 5px;"><?php echo $hnx_error; ?></p>
											</div>
										</div>							
 
								<?php endif; ?>	

								<?php if ( !isset($hnx_error) && isset($_GET['status']) && $_GET['status'] === 'success' ): ?>

									<div class="row">
											<div class="col-lg-12">
												<p class="success" style="padding-left: 30px; border: 1px solid; padding-top: 5px; padding-bottom: 5px;color: green;">Profile Updated.</p>
											</div>
									</div>
									
								<?php endif; ?>

								<form method="post" action="" id="editprofile">

									<?php wp_nonce_field('avengers_infinity_war', 'handyman_pro_nonce'); ?>

									<div class="row">
										<div class="col-lg-6">
											<span class="pf-title">First Name</span>
											<div class="pf-field">
												<input placeholder="First Name" name="edit_pro_first_name" type="text" value="<?php echo esc_html( get_field('pros_first_name', $_SESSION['posttype_pro_id']) ); ?>" required>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Last Name</span>
											<div class="pf-field">
												<input placeholder="Last Name" name="edit_pro_last_name" type="text" value="<?php echo esc_html( get_field('pros_last_name', $_SESSION['posttype_pro_id']) ); ?>" required>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Email Address</span>
											<div class="pf-field">
												<input placeholder="Email Address" type="email" value="<?php echo esc_html( get_field('pro_email', $_SESSION['posttype_pro_id']) ); ?>" readonly required>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Cell Number</span>
											<div class="pf-field">
												<input placeholder="Cell Number" name="edit_pro_cell_phone" type="number" value="<?php echo esc_html( get_field('pro_cell_phone', $_SESSION['posttype_pro_id']) ); ?>" required>
											</div>
										</div>

										<div class="col-lg-6">
											<span class="pf-title">Home Number</span>
											<div class="pf-field">
												<input placeholder="Home Number" name="edit_pro_home_phone" type="number" value="<?php echo esc_html( get_field('pro_home_phone', $_SESSION['posttype_pro_id']) ); ?>" required>
											</div>
										</div>

										<div class="col-lg-6">
											<span class="pf-title">Years of Experience</span>
											<div class="pf-field">
												<input placeholder="Years of Experience" name="edit_pro_years_of_experience" type="number" value="<?php echo esc_html( get_field('pro_years_of_experience', $_SESSION['posttype_pro_id']) ); ?>" required>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Certified</span>
											<div class="pf-field">
												<select name="edit_pro_cirtified" id="" required>
													<option value="yes" <?php echo ( get_field('pro_is_certified', $_SESSION['posttype_pro_id']) ) === 'yes' ? 'selected' : ''; ?>>Yes</option>
													<option value="no" <?php echo ( get_field('pro_is_certified', $_SESSION['posttype_pro_id']) ) === 'no' ? 'selected' : ''; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Insured</span>

											<div class="pf-field">
												<select name="edit_pro_insured" id="" required>
													<option value="yes" <?php echo ( get_field('pro_has_insurance', $_SESSION['posttype_pro_id']) ) === 'yes' ? 'selected' : ''; ?>>Yes</option>
													<option value="no" <?php echo ( get_field('pro_has_insurance', $_SESSION['posttype_pro_id']) ) === 'no' ? 'selected' : ''; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<span class="pf-title">Street</span>
											<div class="pf-field">
												<input placeholder="Entre your Steet" name="edit_pro_street" type="text" value="<?php echo esc_html( get_field('pro_address_group', $_SESSION['posttype_pro_id'])['pro_street'] ); ?>" required>
											</div>
										</div>		
										<div class="col-md-6">
												<span class="pf-title">City</span>
												<div class="pf-field">
													<input placeholder="Entre your City" name="edit_pro_city" type="text" value="<?php echo esc_html( get_field('pro_address_group', $_SESSION['posttype_pro_id'])['pro_city'] ); ?>" required>
												</div>
										</div>	
										<div class="col-md-6">
												<span class="pf-title">County</span>
												<div class="pf-field">
													<input placeholder="Entre your County" name="edit_pro_county" type="text" value="<?php echo esc_html( get_field('pro_address_group', $_SESSION['posttype_pro_id'])['pro_county'] ); ?>" required>
												</div>
										</div>	

										<div class="col-md-6">
												<span class="pf-title">State</span>
												<div class="pf-field">
													<input placeholder="Entre your State" name="edit_pro_state" type="text" value="<?php echo esc_html( get_field('pro_address_group', $_SESSION['posttype_pro_id'])['pro_state'] ); ?>" required>
												</div>
										</div>

										<div class="col-md-6">
												<span class="pf-title">Zipcode</span>
												<div class="pf-field">
													<input placeholder="Zip Code" name="edit_pro_zip_code" type="number" value="<?php echo esc_html( get_field('pro_address_group', $_SESSION['posttype_pro_id'])['pro_zipcode'] ); ?>" required>
												</div>
										</div>		

										<div class="col-lg-12">
											<span class="pf-title">Bio</span>
											<div class="pf-field">
												<textarea placeholder="Write Profile Bio" name="edit_pro_bio" required><?php echo ( get_field('pro_bio_about', $_SESSION['posttype_pro_id']) !== null ) ? esc_textarea(get_field('pro_bio_about', $_SESSION['posttype_pro_id'])) : ''; ?></textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<button type="submit" name="edit_profile_pro_form">Update</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


<?php
get_footer();
