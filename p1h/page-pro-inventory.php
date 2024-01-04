<?php
/**
 * Template Name: Pro Manage Inventory
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

$pro_tools_inventory = get_field('pro_tools_inventory', $_SESSION['posttype_pro_id']);

function selectedTool($tool, $pro_tools_inventory) {

	foreach ($pro_tools_inventory as $key => $inventory) {
		if( $inventory['pro_tool'] === $tool ) {
			return 'checked';
		}
	}

}

get_header(); ?>


	<style> .tools > span { width: 24%; display: inline-block; pointer-events: none; } </style>

	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>

	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">
					
					<?php get_template_part( 'inc/pro', 'navigation' ); ?>

					<div class="col-lg-9 column mt088">
						<div class="padding-left">
							<div class="profile-title">
								<h3>View Tools Inventory</h3>								
							</div>
							<div class="profile-form-edit" style="margin-top: 35px;">
								<div class="col-lg-12">
									<!-- <p>Please check each option that applies to you</p> -->
									<div class="row check85">

										<div class="col-lg-12 tools">

											<?php if (get_field('handyman_pro_tools_config', 'option')): ?>		

											<?php foreach ( get_field('handyman_pro_tools_config', 'option') as $key => $tool ): ?>

											<?php if ($pro_tools_inventory): ?>

												<span><input id="as<?php echo $key; ?>" name="spealism" type="checkbox" <?php echo selectedTool( $tool['handyman_pro_tool'], $pro_tools_inventory ); ?>><label for="as<?php echo $key; ?>"><?php echo $tool['handyman_pro_tool']; ?></label></span>

											<?php else: ?>

												<?php $proInventoryEmpty = 1; ?>
												
											<?php endif; ?>
										
											<?php endforeach; ?>

											<?php endif; ?>


											<?php if (isset($proInventoryEmpty) && $proInventoryEmpty === 1): ?>
													<p style="padding-left: 15px;">Inventory Not Found.</p>
											<?php endif; ?>
										
										</div>

									</div>
								</div>
								<!-- <div class="col-lg-12" style="margin-top: 35px;">
									<button type="submit">Update</button>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

		


<?php
get_footer();