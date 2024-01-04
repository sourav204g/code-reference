<?php

/**

 * The template for displaying archive pages

 * 

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 *

 * @package handyman_pro

 */



$service_group_category_object = get_queried_object();

$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');

$per_min_cost = $fetch_hour_price/60;

get_header(); ?>

	<style>

		

		input.wpcf7-form-control.wpcf7-submit {

		    float: left;

		    font-size: 22px !important;

		    color: #fff;

		    background: #f2ae00;

		    letter-spacing: 1px;

		    border: none;

		    font-size: 17px;

		    cursor: pointer;

		    width: 100%;

		    border-radius: 4px;

		    font-family: 'Lato', sans-serif;

		    padding: 8px 10px;

		    margin-bottom: 15px;

		    border: 1px solid #f2ae00;

		}



		.quick-form-job {  margin-top: 24px; }

		.emp6 { overflow: hidden; }

		.job-details { text-align: left; }

		span.no-discount { color: #616161; font-size: 17px; }



		@media screen and (max-width: 520px) {

			.grid-no-info { text-align: center; }

			.grid-no-info a { float: none; }

		}


.ma5slider .slide--active {
    z-index: 0;
}
		



	</style>

	<section class="">

		<div class="block no-padding">

			<div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php bloginfo('template_directory'); ?>/assets/images/resource/mslider222.jpg) repeat scroll 50% 422.28px transparent;">

			</div>

			<div class="container fluid">

				<div class="row">

					<div class="col-lg-12">

						<div class="inner-header">

							<h3><?php echo $service_group_category_object->name; ?></h3>

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>

	<section>

		<div class="block less-top">

			<div class="container">

				<div class="row">



					<?php if ( get_field('hnd_product_url_g', 'service_group_' . $service_group_category_object->term_id) ): ?>



						<div class="col-lg-12">

					           <div class="browse-all-cat b22 ">



					           	<?php if (get_field('hnd_popup_content_g', 'service_group_' . $service_group_category_object->term_id)): ?>



					           		<!-- <a class="style2 noradius blackbg hnd-external-link" data-link="<?php // echo get_field('hnd_product_url_g', 'service_group_' . $service_group_category_object->term_id); ?>" data-popuptext="<?php // echo get_field('hnd_popup_content_g', 'service_group_' . $service_group_category_object->term_id); ?>" title=""><?php // echo get_field('hnd_product_question_g', 'service_group_' . $service_group_category_object->term_id); ?></a> -->



					           		<a class="style2 noradius blackbg" href="<?php echo get_field('hnd_product_url_g', 'service_group_' . $service_group_category_object->term_id); ?>" title="" data-toggle="modal" data-target="#blk-btn-popup"><?php echo get_field('hnd_product_question_g', 'service_group_' . $service_group_category_object->term_id); ?></a>



					          



					           	<?php else: ?>



					           	    <a class="style2 noradius blackbg removeq" href="<?php echo get_field('hnd_product_url_g', 'service_group_' . $service_group_category_object->term_id); ?>" title=""><?php echo get_field('hnd_product_question_g', 'service_group_' . $service_group_category_object->term_id); ?></a>

					           	  

					           	<?php endif; ?>



						          





					            </div>

				        </div>

						

					<?php endif; ?>



					





					<div class="col-lg-12 col-md-12 column">

						<div class="job-single-sec">

							<div class="job-single-head">

								<div class="row">

									<div class="col-6 col-md-4">

										

										<div class="ma5slider anim-horizontal horizontal-dots horizontal-navs center-dots inside-dots autoplay">



											<?php 



												$args_serv = array(

															        'posts_per_page' => -1,

															        'post_type' => 'services',

															        'tax_query' => array(

															            array (



															                'taxonomy' => 'service_group',

															                'field' => 'term_id',

															                'terms' => $service_group_category_object->term_id,

															            ),

															        )

												);

										

												$the_query_serv = new WP_Query( $args_serv );



												$totalCount = $the_query_serv->found_posts; // 

												if( $totalCount > 0 ) {

													$servicePost = $the_query_serv->posts[0]; // Note: Since the discount value will be same for both installation and replacement, here is taking first service into account. 

												} else {

													$servicePost = null;

													$servicePostAll = $the_query_serv->posts;

												}



											?>

											

											<?php if (get_the_post_thumbnail_url($the_query_serv->posts[0]->ID)) {



													$serviceImg = get_the_post_thumbnail_url($the_query_serv->posts[0]->ID);



											} elseif( isset($the_query_serv->posts[1]->ID) && get_the_post_thumbnail_url($the_query_serv->posts[1]->ID)) {

													$serviceImg = get_the_post_thumbnail_url($the_query_serv->posts[1]->ID);

											} else {

												$serviceImg = null;

											} ?>







											<div class="slides" style="border: 1px solid #ddd;">

												<?php if(get_field('handyman_pro_service_group_thumbnail', 'service_group_' . $service_group_category_object->term_id)) : ?>

												<!-- children = slides -->

												<a href="#"><img alt="<?php echo get_field('handyman_pro_service_group_thumbnail', 'service_group_' . $service_group_category_object->term_id)['alt']; ?>" src="<?php echo get_field('handyman_pro_service_group_thumbnail', 'service_group_' . $service_group_category_object->term_id)['url']; ?>" style=" width: 100%;"></a>

												<?php else: ?>

														

														<?php if ($serviceImg): ?>

															<a href="#"><img alt="" src="<?php echo $serviceImg; ?>" style=" width: 100%;"></a>

														<?php else: ?>

															<a href="#"><img alt="" src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png" style=" width: 100%;"></a>

														<?php endif; ?>

														

														

												<?php endif; ?>

											</div>





											<?php if ($servicePost && get_field('handyman_product_discount', $servicePost->ID) > 0): ?>

											<div class="off50">

												<?php echo get_field('handyman_product_discount', $servicePost->ID); ?>% off

											</div>

											<?php endif; ?>



										</div>

										

										<!-- Contact Form 7 -->

                                       <div class="hidden-xs">

										<?php  get_template_part( 'template-parts/content', 'quick-contact' ); ?>

                                       </div>

									</div>

									<div class="col-6 col-md-4 bbb-hidde fabt">

										<h5><?php echo $service_group_category_object->name; ?></h5>

									</div>

									

									<!-- <div class="col-md-4">

										<div class="ma5slider anim-horizontal horizontal-dots horizontal-navs center-dots inside-dots autoplay" style="border: 1px solid #ddd;">

											<div class="slides">

												<?php // if(get_field('handyman_pro_service_group_thumbnail', 'service_group_' . $service_group_category_object->term_id)) : ?>

												

												<a href="#"><img alt="<?php // echo get_field('handyman_pro_service_group_thumbnail', 'service_group_' . $service_group_category_object->term_id)['alt']; ?>" src="<?php // echo get_field('handyman_pro_service_group_thumbnail', 'service_group_' . $service_group_category_object->term_id)['url']; ?>" style=" width: 100%;"></a>

												<?php // else: ?>

														<a href="#"><img alt="" src="<?php // echo bloginfo('stylesheet_directory'); ?>/assets/images/handyman-default.png" style=" width: 100%;"></a>

												<?php // endif; ?>

											</div>

											<!- <div class="off50">

												50% off

											</div> 

										</div>-->





									<div class="col-md-8">

										<div class="row">

											<div class="col-md-12 hidden-xs">

												<h2 class="head78"><?php echo $service_group_category_object->name; ?></h2>

											</div>

											<?php 



													// REF - https://wordpress.stackexchange.com/questions/178708/sort-alphabetically-by-custom-field

													// REF - https://www.advancedcustomfields.com/resources/query-posts-custom-fields/



													$args = array(

														        'posts_per_page' => -1,

														        'post_type' => 'services',

														        'tax_query' => array(

														            array (

	 

														                'taxonomy' => 'service_group',

														                'field' => 'term_id',

														                'terms' => $service_group_category_object->term_id,

														            ),

														        ),

														        'orderby' => 'meta_value',

														        'meta_key' => 'handyman_type_of_service',

														        'order' => 'DESC'

													);

											

													$the_query = new WP_Query( $args );

												

											?>

											<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>



												<?php // var_dump(get_field('handyman_type_of_service', $post->ID)); exit; ?>

								

											<?php if (get_field('handyman_type_of_service', $post->ID)): ?>

											<div class="col-md-6 emply-list-info" style="margin-top: 1px;">

												<div class="emp6">

												

													<h4 class="emp8">

														

														<?php /* $typeofservices = ''; ?>

															

														<?php foreach (get_field('handyman_type_of_service', $post->ID) as $key => $handyman_type_of_service): ?>

															<?php $typeofservices .= $handyman_type_of_service['label'] . ' | '; ?>

															

														<?php endforeach; ?>

														<?php echo trim( $typeofservices, ' | ' ) . ':'; */ ?>



														<?php echo ucfirst(get_field('handyman_type_of_service', $post->ID)); ?>



														<?php if (get_field('handyman_est_time', $post->ID) != 0): ?>



															<?php $servicePrice = $per_min_cost * get_field('handyman_est_time', $post->ID); ?>



															<?php if (get_field('handyman_product_premium', $post->ID)) {

																			

																			$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $post->ID))/100;

																		} else {

																			

																			$handyman_premium = 0;

																		}

																		

																		$servicePrice = $servicePrice + $handyman_premium;

															?>



															<?php if (get_field('handyman_product_discount', $post->ID) > 0): ?>



																:<del><?php 

															

																	$discount = get_field('handyman_product_discount', $post->ID);

																	$afterDiscount = ( $servicePrice * $discount ) / 100;



																	echo ' $' . round($servicePrice, 2); ?></del> <span><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span>



															<?php else: ?>



																<?php $afterDiscount = 0; ?>

																 :<span class="no-discount"><?php echo ' $' . round($servicePrice - $afterDiscount, 2); ?></span>



																

															<?php endif; ?>



														<?php else: ?>



															<?php include('inc/has-nobase-has-options.php'); ?>



															<?php if (!get_field('handyman_add_on_services', $post->ID)): ?>



														      : <a href="<?php the_permalink(); ?>" style="font-size: 16px;"><span>Get a Quote</span></a></h4>

														      

														    <?php endif; ?>  



														<?php endif; ?>





													</h4>



													<?php if (get_field('handyman_prod_services_description', $post->ID)): ?>

													

													<div class="grid-info-box">

														<a href="<?php the_permalink(); ?>" title="">Select This</a>

														<span class="bbb-hidde"><a href="#" style="margin-left: 10px;" class="morebtn" onclick="show_mores('<?php echo 'j' . $post->ID; ?>'); return false;">View Details</a></span>

													</div>



													<?php else: ?>



														<div class="grid-info-box grid-no-info">

															<a href="<?php the_permalink(); ?>" title="">Select This</a>

														</div>



													<?php endif; ?>



													<div class="hide-xs job-details <?php echo 'j' . $post->ID; ?>" style="padding-top: 0;">

													

														<?php if (get_field('handyman_prod_services_description', $post->ID)): ?>



															<div class="handyman-service-description">

																<h5>Job Description:</h5>

																<?php echo get_field('handyman_prod_services_description', $post->ID); ?>

															</div>

															

														<?php endif; ?>

														



														<?php if (get_field('handyman_prod_services_customer_to_supply', $post->ID)): ?>



															<div class="customers-to-supply">

																<h5>Customer To Supply:</h5>

																<?php echo get_field('handyman_prod_services_customer_to_supply', $post->ID); ?>

															</div>

															

														<?php endif; ?>



														

														

													</div>

												</div>

											</div>

											<?php endif; ?>

											<?php endwhile; endif; wp_reset_postdata(); ?>

										</div>

										<div class="bbb-hidde">

										<?php  get_template_part( 'template-parts/content', 'quick-contact' ); ?>

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

get_footer(); ?>

<script language="javascript" type="text/javascript">

	function show_mores(nextclass)

	{

		jQuery("."+nextclass).toggle();

	}

	

</script>