<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package handyman_pro
 */

$service_category_object = get_queried_object();

get_header(); ?>

	<style>

		.emply-list-info p strong { font-weight: normal; color: #4c4c4c; }
		.emply-list-info p del { color: #2e45c3; padding-left: 4px; }
		.emply-list-info p span { color: #f44336;     font-weight: 600; padding-left: 4px; }
		
		a.view-details {
		    background: #325d88;
		    color: white;
		    padding: 5px 12px 6px 12px;
		    margin-top: 14px;
		    font-size: 14px;
		}

		span.no-discount {
		    color: #2e45c3 !important;
		}

		.emply-list-info > p {
			font-size: 14px;
		}


		.breadcrumb-new a { color: #2196f3; }

		.filterbar {
		    display: flex;
		    justify-content: space-between;
		}

		.breadcrumb-new {
			text-transform: capitalize;
		    position: relative;
		    top: 7px;
		}

		.desktop { display: none; }

		@media screen and (max-width: 570px ) {

			.hide-cat-mob { display: none; }
			
			.sidebar-heading-catd, .filterbar { display: none; }
			
			h3.mobile {
			    text-transform: uppercase;
			    padding: 10px;
			    margin-top: 68px;
			    font-weight: bold;
			}

			.mob-service-carousel {
			    top: -30px;
			    margin-bottom: -35px;
			}
		}

		@media screen and (min-width: 570px ) {
			.hnd-top0ca { display: none; }
			.desktop { display: block; }
			h3.mobile { display: none; }
		}

		.page-breacrumbs1 {
		    position: relative;
		    top: 18px;
		}

	</style>

	<!-- Hero Banner -->

	<section class="">
		<div class="block no-padding hide-cat-mob">
			<div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php bloginfo('template_directory'); ?>/assets/images/resource/mslider222.jpg) repeat scroll 50% 422.28px transparent;"></div>
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3><?php echo $service_category_object->name; ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<h3 class="mobile" style=""><?php echo $service_category_object->name; ?></h3>

	<section class="breadcrumb-sec desktop">
		<div class="block no-padding gray">
			<div class="container">
				<div class="row">
							<div class="col-md-3">
								<div class="inner-title2 cat">
									<h3 class="" style=""><?php echo $service_category_object->name; ?></h3>
									<?php /* if (get_field('handyman_pro_pages_sub_heading')): ?>
										<span><?php echo get_field('handyman_pro_pages_sub_heading'); ?></span>
									<?php endif; */ ?>
								</div>
							</div>
							
							<div class="col-md-9">
								<div class="page-breacrumbs1">
								<div class="filterbar">

									<?php 

									$explode  = explode('/', get_term_link($service_category_object->term_id, 'service_categories'));
									$explode  = array_splice($explode,4);
									$indxpl = count($explode) - 1;
									unset($explode[$indxpl]);

									$last = end(array_keys($explode));

									// echo '<pre>'; var_dump($last);

									?>

									<div class="breadcrumb-new">
										<span><a href="<?php echo home_url( '/' ); ?>"><i class="fa fa-home" aria-hidden="true"></i></a></span>
										<i class="fa fa-angle-right" aria-hidden="true"></i>

										<?php if ($explode > 1): ?>

											<?php foreach ($explode as $key => $expl):

												$explID = get_term_by('slug', $expl, 'service_categories')->term_id;

												$explLink = get_term_link($explID, 'service_categories');

												$iteml = str_replace('-', ' ', $expl);

												if ($key !== $last): ?>

													<span><a href="<?php echo $explLink; ?>"><?php echo $iteml; ?></a></span>
													<i class="fa fa-angle-right" aria-hidden="true"></i>

												<?php else: ?>

													<span><?php echo $iteml; ?></span>
													
												<?php endif; ?>
												
											<?php endforeach; ?>
											
										<?php endif; ?>
									</div>

									<!-- <p>Showing results for "<?php echo $service_category_object->name; ?>"</p> -->
									<!-- <p>Showing 1 – 12 of 40 results for "<?php // echo $service_category_object->name; ?>"</p> -->
									<?php get_template_part( 'template-parts/content', 'customize-button' ); ?>
								</div>
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

					<?php get_template_part( 'template-parts/content', 'carousel' ); ?>
					
					<?php get_template_part( 'template-parts/content', 'cat-sidebar' ); ?>

					<?php get_template_part( 'template-parts/content', 'cat-main' ); ?>

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
get_footer();
