<?php

/**
 * Template Name: Products
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


$current_service_categories = get_terms( array( 
	'taxonomy' => 'product_categories',
	'hide_empty' => false, // Remove Comment to Display all categories
	'parent' => 0
) );

$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;

if (is_page()) { 
	get_header(); 
} else {
		$eleminatedCATID = get_queried_object()->term_id;
} ?>

	<?php // get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
	<style> 
			.pf-title { margin-bottom: 0px; } 
			.inner-title2 { width: auto !important; }
			.prod-h {
			    color: red !important;
			    display: inline-block;
			    font-size: 20px !important;
			}
/*--------8/4/21---------
-----------------------*/

strong.more-remodelling-title {
    font-size: 24px;
    margin-bottom: 27px;
    display: block;
}

.all-prd-subhead-wrapper .inner-title2{
    width: 100%!important;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 6px;
}
.all-prd-subhead-wrapper .inner-title2 span{
	width:auto!important;
	margin-top: 0;
	font-weight: bold;
}
h4.expert-txt {
    margin: 0;
    color: red;
    font-weight: 600;
    font-size: 20px;
    letter-spacing: 0.6px;
    display: none;
}
@media screen and (max-width: 992px) {
.all-prd-subhead-wrapper .inner-title2 {
    padding: 0px 0px 20px;
}
}
@media screen and (max-width: 576px) {
.all-prd-subhead-wrapper .inner-title2 {
    display: block;
    margin-top: 0px;
    padding: 18px 0 7px
}
.all-prd-subhead-wrapper .inner-title2 span {
    padding-bottom: 15px;
    display: none;
}
/*--9/04/21--*/
.prd-cstm-title .inner-title2>h3 {
    font-size: 27px;
}
.all-prd-subhead-wrapper {
	display: flex;
    align-items: center;
}
.prd-cstm-title .inner-title2 {
    padding: 18px 0 6px;
}
h4.expert-txt {
    display: block;
}
}

/*23-12-21*/

body {
	padding: 0!important;
}
.modal-backdrop {
    display: none;
}
.features-modal{
	z-index: 9999;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 100vh;
    width: 100%;
/*    display: flex!important;*/
    align-items: center;
}
.features-modal:before {
    content: "";
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
	background: rgb(0 0 0 / 79%);
}
.features-modal .modal-dialog {
    position: absolute;
    top: 54%;
    left: 50%;
    transform: translate(-50%, -50%)!important;
}

	</style>


	<?php if (is_page()) : ?>

	<!-- Hero Banner -->
	<section class="overlape">
		<div class="block no-padding">
			<div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php echo home_url('/wp-content/uploads/2019/06/') . 'customservice-662.png'; ?>) repeat scroll 50% 422.28px transparent;"></div>
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3>All Products</h3>
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
					<div class="col-lg-3 col-7 prd-cstm-title">
						<div class="inner2">
							<div class="inner-title2">
								<h3><?php the_title(); ?> </h3>
								
								<?php /* if (get_field('handyman_pro_pages_sub_heading')): ?>
									<span><?php echo get_field('handyman_pro_pages_sub_heading'); ?></span>
								<?php endif; */ ?>
							</div>
<!-- 							<div class="page-breacrumbs">
								<ul class="breadcrumbs">
									<li>
										<a href="<?php echo home_url('/'); ?>" title="">Home</a>
									</li>
									<li>
										<a href="#" title="" style="pointer-events: none;"><?php the_title(); ?></a>
									</li>
								</ul>
							</div> -->
						</div>
					</div>
					<div class="col-lg-9 col-md-12  col-5 all-prd-subhead-wrapper">
						<div class="inner-title2">
							<span class="prod-h">All products include taxes, delivery to your home and professional installation.</span>
							<a class="howworks" data-target="#howworks" data-toggle="modal" href="#"> How it works </a>
						</div>
					</div>
					<div class="col-lg-12">
						<h4 class="expert-txt">Include Expert Installation</h4>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php endif; ?>
<section><hr></section>
	<section>
		<div class="block less-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3 col-md-pull-9">
						<strong class="more-remodelling-title">More Remodelling Products</strong>
							<div class="experties1" id="toggle-widget">
								<?php // var_dump($current_service_categories) ?>

									
								<?php foreach ( $current_service_categories as $key => $current_service_category ): ?>
									<?php // var_dump($current_service_category->term_id); ?>
									<div style="<?php echo ( $eleminatedCATID == $current_service_category->term_id ) ? 'display:none;' : ''; ?>">
										<h2 class="active"><?php echo $current_service_category->name; ?></h2>
										<div class="content">
											<?php 
													global $checkIFhasChildCAT;
													$checkIFhasChildCAT = get_terms( array( 
														'taxonomy' => 'product_categories',
														'hide_empty' => false, // Remove Comment to Display all categories
														'parent' => $current_service_category->term_id
													) ); // Showing sub-sub-categories of sub-categories here.
													if (!empty($checkIFhasChildCAT)) : 
														
														foreach ($checkIFhasChildCAT as $key => $childCAT) : ?>
															<div class="subcategory">
																	<div class="name">
																		<a href="<?php echo get_term_link( $childCAT->term_id ); ?>"><?php echo $childCAT->name; ?></a>
																	</div>
															</div>						
														<?php endforeach; ?>
													
												<?php else: 

														$args = array(
															        'posts_per_page' => -1,
															        'post_type' => 'products',
															        'tax_query' => array(
															            array (
															                'taxonomy' => 'product_categories',
															                'field' => 'term_id',
															                'terms' => $current_service_category->term_id,
															            ),
															        )
														);
												
														$the_query = new WP_Query( $args );
													
														?>
														<?php if ( $the_query->have_posts() ) : 
															$prodgroupChk = array();
															while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
																<?php 
																	if(get_the_terms( $post->ID, 'product_group' )) { // IN NOT NULL
																		$service_group_id_sidebar = get_the_terms( $post->ID, 'product_group' )[0];
																	}
																	$args1 = array(
																		        'posts_per_page' => -1,
																		        'post_type' => 'products',
																		        'tax_query' => array(
																		            array (
																		                'taxonomy' => 'product_group',
																		                'field' => 'term_id',
																		                'terms' => $service_group_id_sidebar->term_id,
																		            ),
																		        )
																	);
															
																	$the_query1 = new WP_Query( $args1 );
																	// echo '<pre>';
																	// var_dump($the_query1->post_count);
																	// exit;
																	
																?>
																<?php if (!in_array($service_group_id_sidebar->term_id, $prodgroupChk)): 
																	$prodgroupChk[] = $service_group_id_sidebar->term_id; ?>
																	<div class="subcategory"> <!-- these are services/ products -->
																	<div class="name">
																		<a href="<?php echo get_term_link($service_group_id_sidebar->term_id, 'product_group'); ?>"><?php echo $service_group_id_sidebar->name; ?></a>
																	</div>
																	<div class="type">
																		<?php /* $typeofservices = ''; ?>
																		<?php foreach (get_field('handyman_type_of_service', $post->ID) as $key => $handyman_type_of_service): ?>
																			<?php $typeofservices .= $handyman_type_of_service['label'] . ' | '; ?>
																			
																		<?php endforeach; ?>
																		<?php echo trim( $typeofservices, ' | ' ); */ ?>
																		<?php // echo get_field('handyman_type_of_service', $post->ID); ?>
																		<?php
																		if ($the_query1->post_count > 1) {
																			$typeofservices = '';
																			foreach ($the_query1->get_posts() as $key => $prod) {
																				
																				// check if the repeater field has rows of data
																				if( have_rows('handyman_product_link_to_services', $prod->ID) ):
																				 	// loop through the rows of data
																				    while ( have_rows('handyman_product_link_to_services', $prod->ID) ) : the_row();
																				    $getServiceID = get_sub_field('handyman_product_link_to_service'); 
																				    $typeofservices .= ucfirst(get_field('handyman_type_of_service', $getServiceID)) . '/ ';
																				    endwhile;
																				endif;
																			}
																		} else {
																			// check if the repeater field has rows of data
																			if( have_rows('handyman_product_link_to_services', $post->ID) ):
																				$typeofservices = '';
																			 	// loop through the rows of data
																			    while ( have_rows('handyman_product_link_to_services', $post->ID) ) : the_row(); 
																			    $getServiceID = get_sub_field('handyman_product_link_to_service'); 
																			    $typeofservices .= ucfirst(get_field('handyman_type_of_service', $getServiceID)) . '/ ';
																			    endwhile;
																			endif;
																		}
																		?>
																		<span class=""><?php echo trim( $typeofservices, '/ ' ); ?></span>
																		
																	</div>
																</div>
																	
																<?php endif; ?>
															<?php endwhile; ?>
														<?php else: ?>
															<p style="border: 1px solid #ddd; padding: 10px; font-size: 0.7rem; text-align: center;">Nothing Found.</p>
														<?php endif; wp_reset_postdata(); ?>
												<?php endif; ?>
																	
										</div>
									</div>
									
								<?php endforeach; ?>
							
							</div>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-9 col-md-push-3">

						<?php if (!is_page()) : ?>
							<!-- <strong class="more-remodelling-title">More Remodelling Products</strong> -->
						<?php endif; ?>					
						
						<div class="emply-list-sec style2">
							<div class="row">
								
								<?php $product_categories = get_terms( array( 
										'taxonomy' => 'product_categories',
										'hide_empty' => false,
										'parent' => 0
								) ); ?>

								
								<?php foreach ( $product_categories as $key => $product_category ): ?>
								
								<div class="col-md-4" style="<?php echo ( $eleminatedCATID == $product_category->term_id ) ? 'display:none;' : ''; ?>">
									<div class="emply-list">
										<div class="dvimag">
											<?php if (get_field('hnd_product_category_thumb_img', 'product_categories_' . $product_category->term_id)['url']): ?>
												<a href="<?php echo get_category_link( $product_category->term_id ); ?>" title=""><img alt="" src="<?php echo get_field('hnd_product_category_thumb_img', 'product_categories_' . $product_category->term_id)['url']; ?>" style="width: 100%;"></a>
											<?php else: ?>
												<a href="<?php echo get_category_link( $product_category->term_id ); ?>" title=""><img alt="" src="<?php echo home_url('/wp-content/themes/handyman_pro/assets/images/') . 'default-png03.png'; ?>" style="width: 100%;"></a>
												
											<?php endif ?>
											
										</div>
										<div class="emply-list-info">
											<h3 class="tx18"><a href="<?php echo get_category_link( $product_category->term_id ); ?>" style="text-transform: uppercase;" title=""><?php echo $product_category->name; ?></a></h3>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
							
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- <div class="account-popup-area customize-box">
		<div class="account-popup">
			<span class="close-popup"><i class="la la-close"></i></span>
			<h3>Customize Your Service</h3>
			<form>
				<div class="pf-field">
					<textarea placeholder="If you can`t find what you are looking for from our list of services, you can type in here and describe in your own words and name the price you want to pay."></textarea>
				</div>
				<div style="margin-bottom: 15px;">
					<strong>Enter the $ amount you want to pay</strong>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="cfield">
							<input placeholder="Price" type="text"> <i class="la la-dollar" style="font-weight: bold;"></i>
						</div>
					</div>
					<div class="col-md-6 mat">
						<h4><strong>+ MAT</strong> <a class="mat_help" href="#">?</a></h4>
					</div>
				</div><button type="submit">DONE</button>
			</form>
		</div>
	</div> -->
<?php
if (is_page()) { get_footer(); } ?>
<!-- Specifications Modal -->
<div class="modal features-modal" id="specifications">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Specificatioons</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	$('.specificationsm').click(function(){
		let specs = $(this).next().html();
		$('.modal-body').html(specs);
	});
	// REF - https://stackoverflow.com/questions/21863462/bootstrap-modal-dynamic-content
	// $('#specifications').on('show.bs.modal', function(){
	// 	let specs = $('.specifications-content').html();
	//     $('.modal-body').html(specs);
	// });
</script>