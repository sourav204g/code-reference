<?php

/**

 * The template for displaying archive pages

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 *

 * @package handyman_pro

 */

$service_category_object = get_queried_object();

$current_service_categories = get_terms( array( 

	'taxonomy' => 'product_categories',

	// 'hide_empty' => false, // Remove Comment to Display all categories

	'parent' => $service_category_object->term_id

) );

if (empty($current_service_categories)) {

	$current_service_categories[] = $service_category_object;

}

$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');

$per_min_cost = $fetch_hour_price/60;

get_header(); ?>

	<style>

		.p-emply-list { position: relative; }

		.p-emply-list .off30 { top: 24px; left: 24px; }

		.prod-h {

			    color: red !important;

			    display: inline-block;

			    font-size: 20px !important;

			    margin-left: 10px;

			        margin-top: 5px;

			        font-weight: bold;

			}

	</style>

	<!-- Hero Banner -->

	<section class="">

		<div class="block no-padding">

			<div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php bloginfo('template_directory'); ?>/assets/images/resource/mslider222.jpg) repeat scroll 50% 422.28px transparent;"></div>

			<div class="container fluid">

				<div class="row">

					<div class="col-lg-12">

						<div class="inner-header">

							<h3><?php single_cat_title('');?></h3>

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



					<?php get_template_part( 'template-parts/content', 'product-carousel' ); ?>

					<?php get_template_part( 'template-parts/content', 'product-cat-sidebar' ); ?>

					<?php get_template_part( 'template-parts/content', 'product-cat-main' ); ?>



					<?php get_template_part( 'page', 'products' ); ?>

				

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

get_footer(); ?>



<script>

	$('.spec').click(function(){

		let specs = $(this).next().html();

		$('.modal-body').html(specs);

	});

</script>





	<!-- Specifications Modal -->

	<!-- <div class="modal" id="specifications">

		<div class="modal-dialog modal-lg">

			<div class="modal-content">

				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLabel">Specifications</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

				</div>

				<div class="modal-body specifications-content">

						contents

				</div>

				<div class="modal-footer">

					<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>

				</div>

			</div>

		</div>

	</div> -->

