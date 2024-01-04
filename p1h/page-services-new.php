<?php

/**

 * Template Name: All Services New

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



function handyman_service_count($id) {



	$args = array(

		'post_type' => 'services',

		'tax_query' => [

        	[

            'taxonomy' => 'service_categories',

            'terms' => $id,

        	],

    	],

	);



	$handyman_services = get_posts($args);



	$service_count = 0;



	foreach ( $handyman_services as $key => $handyman_service ) {

		if(get_field('handyman_post_type', $handyman_service->ID)['value'] !== 'product') {

			$service_count++;

		}

	}



	return $service_count;



}



get_header(); ?>



	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>



<style type="text/css">

	.dvimag { 
		border: 1px solid #e8e8e8;
	}

	.service-pro2{
	  margin-bottom:20px;
	}

	.service-pro2 h2{
	  font-size: 30px;
	  line-height: 30px;
	  text-align: left;
	  padding-bottom: 0px;
	  margin-bottom: 10px;
	  color: #f2ae00;
	}

	.service-pro2 h2 span{
	   font-size:16px;
	  line-height: 24px;
	  text-align: left;
	  margin-bottom: 0px;
	  color: #323232;
	}

	.service-pro2 p{
	  font-size:18px;
	  line-height: 24px;
	  text-align: left;
	  margin-bottom: 0px;
	}

	.service-pro2 .mt25{
		margin-top: 25px;
		margin-bottom: 30px
	}

	.service-pro2 .handyman-servbox{
		border: 1px solid #eeefed;
		padding: 15px 20px 30px;
		margin-bottom: 25px;
	}

    .service-pro2 .handyman-servbox h3{
	  font-size: 21px;
	  line-height:26px;
	  text-align: left;
	  padding-bottom: 10px;
	  margin-bottom:10px;
	  border-bottom: 1px solid #eeefed;
	  color: #f2ae00;
	  text-transform:capitalize;
	}

	.service-pro2 .handyman-servbox ul li{
	  padding-bottom: 8px;
	  margin-bottom: 0px;
	}

	.service-pro2 .handyman-servbox ul li a{
	  font-size:16.6px;
	  line-height:26px;
	  text-align: left;
	  color: #000000;
	  text-transform:capitalize;
	}

	.service-pro2 .handyman-servbox ul li a:hover{
	  font-size:16.6px;
	  color: #f2ae00;
	}

	.service-pro2 .handyman-servbox .sev-but{
      border: 1px solid #000000;
      padding: 8px 10px 8px 15px;
      background: #ffffff;
      font-size: 16px !important;
      line-height: 22px;
      position: relative;
     }

     .service-pro2 .handyman-servbox .sev-but:hover{
      border: 1px solid #323232;
      background: #323232;
      color: #fff;
     }

	
}

</style>



	<section>

		<div class="block less-top">

			<div class="container">

				<div class="row">

					<div class="col-md-12 bbb-hidde">
						<p><a href="#">Home</a> / Handyman Services</p>
					</div>

					<div class="col-md-12 emply-list-sec style2 bbb-hidde" style="margin-bottom:45px;">

						<div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">



							<?php $service_categories = get_terms( array( 



									'taxonomy' => 'service_categories',

									'hide_empty' => false,

									'parent' => 0



							) ); ?>

							

							<ol class="carousel-indicators">

								<?php foreach ( $service_categories as $key => $service_category ): ?>

								<li class="<?php echo ($key == 0) ? 'active' : ''; ?>" data-slide-to="<?php echo $key; ?>" data-target="#carouselExampleIndicators"></li>

								<?php endforeach; ?>

							</ol>



							<div class="carousel-inner">



								<?php foreach ( $service_categories as $key => $service_category ): ?>



								<div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">

									<div class="emply-list" style="margin-bottom: 5px;">

										<div class="row">

											<div class="col-xs-12 col-sm-12 col-md-6">

												<div class="dvimag">

													<a href="<?php echo get_category_link( $service_category->term_id ); ?>" title="<?php echo $service_category->name; ?>">



														<?php if (get_field('handymanpro_service_category_icon', 'service_categories_' . $service_category->term_id )): ?>



															<img alt="<?php echo get_field('handymanpro_service_category_icon', 'service_categories_' . $service_category->term_id )['alt']; ?>" src="<?php echo get_field('handymanpro_service_category_icon', 'service_categories_' . $service_category->term_id )['url']; ?>" style=" width: 100%;">



														<?php else: ?>



															<img alt="<?php echo $service_category->name; ?>" src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png01.png" style=" width: 100%;border: 1px solid #dadad5;">

															

														<?php endif; ?>



													</a>

													<div class="off50">
                                                      <?php echo $service_category->name; ?>
														

													</div>

												</div>

											</div>

											<div class="col-xs-12 col-sm-12 col-md-6 pdl0">

												<div class="emply-list-info allser">

													<h3 style="text-align: center;"><a href="<?php echo get_category_link( $service_category->term_id ); ?>" title="<?php echo $service_category->name; ?>"><?php echo $service_category->name; ?></a></h3>

												</div>

											</div>

										</div>

									</div>

								</div>



								<?php endforeach; ?>



							



							</div>



							<a class="carousel-control-prev" data-slide="prev" href="#carouselExampleIndicators" role="button"><span aria-hidden="true" class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a> <a class="carousel-control-next" data-slide="next" href="#carouselExampleIndicators" role="button"><span aria-hidden="true" class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>



						</div>

					</div>



					<!-- Sidebar -->

					<div class="col-lg-3 col-md-3 col-sm-3 col-md-pull-9">

						<div class="experties1" id="toggle-widget">		



						<?php $service_categories = get_terms( array( 



									'taxonomy' => 'service_categories',

									'hide_empty' => false,

									'parent' => 0



						) ); ?><?php foreach ( $service_categories as $key => $service_category ): ?>



								<?php $indivisual_categories = get_terms( array( 



											'taxonomy' => 'service_categories',

											'hide_empty' => false,

											'parent' => $service_category->term_id



								) ); ?>



								<div>



									<h2 class=""><?php echo $service_category->name; ?></h2>

									<div class="content" style="display: none;">



										<?php



										if (!empty($indivisual_categories))  : 



										foreach ($indivisual_categories as $key => $indivisual_category ): ?>



											<div class="subcategory">

													<div class="name">

														<a href="<?php echo get_category_link( $indivisual_category->term_id ); ?>"><?php echo $indivisual_category->name; ?></a>

													</div>



											</div>

									

										<?php endforeach; ?>



										<?php else: ?>



											<div class="subcategory">

													<div class="type">

														Nothing found

													</div>

											</div>



										<?php endif; ?>



									</div>

								</div>

								

							<?php endforeach; ?>



						</div>

					</div>

					<!-- Sidebar -->



					<div class="col-lg-9 col-md-9 col-sm-9 col-md-push-3">

						

						<div class="filterbar">

							<p>Home - Showing 1 – 12 of 40 results for <span>"Handynan Service"</span></p>

							<?php get_template_part( 'template-parts/content', 'customize-button' ); ?>

						</div>



						<div class="emply-list-sec style2 service-pro2">

						<!-- Essential Home Services Start -->

                        <h2>Essential Home Services <span>Instantly Schedule From Over 600 Pre- Priced Essential Home Services.</span></h2>

						<div class="row mt25">
							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Installations</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Repairs</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Plumbing</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Electrical</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Furniture Assembly</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Carpentry Projects</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->
						</div>

						<!-- Essential Home Services Ens -->

                        <!-- Home Improvement Projects Start -->
						<h2>Home Improvement Projects <span>Improve your home value with our affordable remodeling projects.</span></h2>

						<div class="row mt25">
							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Kitchen Remodeling</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Bathroom</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Flooring/Tiling</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

						</div>
						<!-- Home Improvement Projects End -->

                        <!-- Remodeling Products Start -->
						<h2>Remodeling Products <span>Including Product, Proffesional Installation, Taxes And Delivery.</span></h2>

						<div class="row mt25">
							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Garbage Disposals</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Garage Door Openers</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

							<!-- Service Box  Start-->
							<div class="col-md-4">
								<div class="handyman-servbox">
									<h3>Toilets</h3>
									<ul>
										<li><a href="#">Appliances</a></li>
										<li><a href="#">Ceiling Coverings</a></li>
										<li><a href="#">Cooling</a></li>
										<li><a href="#">Door Treatments</a></li>
										<li><a href="#">Doors Installations</a></li>
										<li><a href="#">Electrical</a></li>
									</ul>
									<a class="sev-but" href="#">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Service Box  End-->

						
						</div>

						<!-- Remodeling Products End -->

							

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



<?php get_footer(); ?>