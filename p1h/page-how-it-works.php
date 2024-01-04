<?php
/**
 * Template Name: How It Works
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


// echo '<pre>';
// var_dump(get_the_terms( 3327 , 'service_group' ));
// exit;

// $fetchServicesKeyword = new WP_Query(array(
// 							'post_type' => 'services',
// 							'meta_query'     => array(
// 			        			array(
// 			        				'key'     => 'hnd_search_keyword',
// 			        				'value'   => array('window'),
// 			        				// 'type'    => 'CHAR',
// 			        				'compare' => 'IN',
// 			        			),
// 							)
// 						));


// echo "<pre>";
// var_dump($fetchServicesKeyword->get_posts());
// exit;

get_header(); ?>
<!--7/4/21-->
<style>
	.how-work-box {
    	padding: 68px 100px;
}
	a.how-works-btn {
		background: #f14738;
		color: white;
		padding: 0.7rem 1.5rem;
		display: table;
		border-radius: 9px;
		font-size: 19px;
		font-weight: 600;
		letter-spacing: 0.7px;
		font-family: 'Lato', sans-serif;
		margin-left: auto;
		position: relative;
		top: 14px;
}
</style>
<!--end-->

	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">

						<?php

							// check if the repeater field has rows of data
							if( have_rows('handyman_pro_how_it_works') ):

								$count = 1; 

							 	// loop through the rows of data
							    while ( have_rows('handyman_pro_how_it_works') ) : the_row(); ?>

							    	<div class="how-works <?php echo ($count %2 == 0) ? 'flip' : ''; ?>">
										
										<div class="how-workimg"><img alt="<?php echo get_sub_field('handyman_pro_how_it_works_image')['alt']; ?>" src="<?php echo get_sub_field('handyman_pro_how_it_works_image')['url']; ?>"></div>
										
										<div class="how-work-detail">
											<div class="how-work-box">
												<span><?php echo $count; ?></span> <img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/img010<?php echo $count; ?>.png">
												<?php echo get_sub_field('handyman_pro_how_it_works_content'); ?>
											</div>
										</div>
									</div>
							        
							    <?php

							    $count++;

							    endwhile;

							endif; ?>


					</div>
				</div>
			</div>
		</div>
	</section>

<?php
get_footer();
