<?php
/**
 * Template Name: Pro Manage Skills
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


function selectedCategory($id, $selected_categories) {

	if ($selected_categories) {
		foreach ($selected_categories as $key => $category) {
				if( $category->term_id === $id ) {
					return 'checked';
				}

		}
	}


}

get_template_part( 'inc/dashboard', 'functions' );

get_header(); ?>


	<style>
		.pro-skills { display: grid;grid-template-columns: repeat(3, 1fr); }
	</style>
	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>


	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">


					<?php get_template_part( 'inc/pro', 'navigation' ); ?>


					<div class="col-lg-9 column mt088">
						<div class="padding-left">
							<div class="profile-title">
								<h3>Manage Skills</h3>
							</div>
							<form method="post" action="" id="pro-manage-skills">
							<div class="profile-form-edit" style="margin-top: 35px;">
								<div class="col-lg-12">
									<p>Please check each option that applies to you</p>
									<div class="row check85">
										<div class="col-lg-12 pro-skills">

											<?php wp_nonce_field('avengers_infinity_war', 'handyman_pro_nonce'); ?>



											<?php 

											$selected_categories = get_the_terms( $_SESSION['posttype_pro_id'], "service_categories" );

											$service_categories_or_skills = get_terms( array( 

												'taxonomy' => 'service_categories',
												'hide_empty' => false,
												// 'parent' => 0

											) );
											
											if(!empty($service_categories_or_skills)) :

											?><?php foreach ($service_categories_or_skills as $key => $pro_skill) : ?>

												<span><input id="skill-<?php echo $key; ?>" name="pro_skills[]" type="checkbox" value="<?php echo esc_html($pro_skill->term_id); ?>" <?php echo selectedCategory( $pro_skill->term_id, $selected_categories ); ?>><label for="skill-<?php echo $key; ?>"><?php echo $pro_skill->name; ?></label></span>

											<?php endforeach; 

											else: ?>

											<p>Nothing Found.</p>

											<?php endif; ?>


										</div>
									</div>
								</div>
								<div class="col-lg-12" style="margin-top: 35px;">
									<button type="submit" name="edit_profile_manage_skills">Update</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

		


<?php
get_footer();