<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package handyman_pro
 */


// echo '<pre>';
// var_dump($post);

get_header(); ?>

	<style>
		
		div#about { margin-bottom: 30px; }
		
		/*reviews css start*/
		.testimonial_group .testimonial {
			border: 1px solid #cae0e7;
		    background: #fff;
		    border-bottom: 4px solid #cae0e7 !important;
		    padding: 20px !important;
		    width: 100% !important;
		    margin-bottom: 30px;
		    position: relative;
		}

		.testimonial_group .testimonial h3{
			font-size: 21px !important;
			font-weight: 600;
		}

		.stars, .rr_star {
		    color: #ffaf00;
		    font-size: 27px;
		    /*position: absolute;
		    right:20px;
		    top: 20px;*/
		}

		.testimonial_group .testimonial .rr_review_text .drop_cap {
		    position: absolute;
		    font-size: 100px;
		    top: -15px;
		    left:-35px !important;
		    line-height: 100px;
		    zoom: 1;
		    filter: alpha(opacity=25);
		    opacity: 0.25;
		    z-index: 0;
		}

		.testimonial_group .testimonial .rr_review_text {
		    position: relative;
		    margin-left: 35px;
		    margin-top: 12px;
		    line-height: 22px;
		}

		.read_more, .show_less {
		    font-size: 13px !important;
		    font-style: italic;
		    background: #f2ae00;
		    padding:4px 10px;
		    margin-top: 20px;
		    float: left; 
		    color: #fff;
		}

		.testimonial_group .testimonial .rr_review_name {
		    text-align: right;
		    padding-right:5px !important;
		    font-style: italic;
		    font-size:15px !important;
		    margin-top: 15px;
		}


		.form_table input[type="text"], input[type="password"], input[type="email"], textarea {
		    background: #e4e4e4 none repeat scroll 0 0;
		    border: medium none;
		    float: left;
		    font-size: 15px;
		    font-weight: 400;
		    margin-bottom: 10px;
		    padding: 10px 28px;
		    font-family: 'Lato', sans-serif;
		}

		.rr_review_form{
			width: 600px !important;
		}

		.form_table{
			width: 100% !important;
		}

		.rr_review_form .form_table .rr_form_row .rr_form_heading {
		    width: 30% !important;
		}

		.rr_review_form .form_table .rr_form_row .rr_form_input {
		    vertical-align: top;
		    padding-bottom: 10px;
		    width: 65%!important;
		}

		.rr_stars_container{ margin-left:20px; }

		.hnd-reviews {
			margin-top: 50px;
		    margin-bottom: 30px;
		    font-size: 35px !important;
		    text-align: center;
		    display: block;
		    width: 100%;
		}

	</style>
	
	<section class="overlape">
		<div class="block no-padding">
			<div class="parallax scrolly-invisible no-parallax" style="background:#00abb6;"></div>
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3 class="mbb80">PRO Handymans Profile</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="overlape">
		<div class="block remove-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="cand-single-user">
							<div class="share-bar circle">
								<!-- <a class="share-google" href="#" title=""><i class="la la-google"></i></a><a class="share-fb" href="#" title=""><i class="fa fa-facebook"></i></a><a class="share-twitter" href="#" title=""><i class="fa fa-twitter"></i></a> -->
							</div>
							<div class="can-detail-s">
								<div class="cst">
									<?php if (get_the_post_thumbnail_url($post->ID)): ?>

										<?php 

											$thumbnail_id    = get_post_thumbnail_id($post->ID);
	                                        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

										?>
										
										<img alt="<?php echo $alt; ?>" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>">

									<?php else: ?>

										<img alt="handymanpro" src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/handyman-img01.jpg">
										
									<?php endif; ?>

									
								</div>
								<h3><?php echo get_field('pros_first_name') . ' ' . get_field('pros_last_name'); ?></h3>
								<!-- <p><?php // echo get_field('pro_email', $post->ID); ?></p> -->
								<!-- <p>Member since October 5, 2012</p>
								<p><i class="la la-map-marker"></i>San Diego, CA, United States</p> -->
							</div>
							<div class="download-cv questions-popup">
								<!-- <a href="#" title="">SCHEDULE NOW <i class="la la-calendar"></i></a> -->
							</div>
						</div>
						<!-- <ul class="cand-extralink">
							<li>
								<a href="#about" title="">About</a>
							</li>
							<li>
								<a href="#insurance" title="">Insurance</a>
							</li>
							<li>
								<a href="#experience" title="">Work Experience</a>
							</li>
							<li>
								<a href="#skills" title="">Professional Skills</a>
							</li>
							<li>
								<a href="#reviews" title="">Reviews</a>
							</li> 
						</ul>-->
						<div class="cand-details-sec">
							<div class="row">
								<div class="col-lg-8 column">
									<div class="cand-details" id="about">
										<h1 class="fnt34">About <?php echo get_field('pros_first_name'); ?></h1>
										<div><?php echo get_field('pro_bio_about'); ?></div>
									</div>
									<div class="cand-details" id="experience">
										<h1 class="fnt34">Handyman Details</h1>
										<table class="table listing-details-table">
											<tbody>
											<?php /*	<tr>
													<th>Email Address</th>
													<td data-tracker-id="filtered-email">
														<?php echo substr( get_field('pro_email'), 0, 3) . '.....@...com'; ?> <span class="label label-default pull-right"><i class="fa fa-envelope"></i> Confirmed</span>
													</td>
												</tr>
												<tr>
													<th>Phone Number</th>
													<td data-tracker-id="filtered-phone">
														<?php echo '(' . substr( get_field('pro_cell_phone'), 0, 3) . ')' .  '(---)(--' . substr( get_field('pro_cell_phone'), 8, 10) . ')'; ?> <span class="label label-default pull-right"><i class="fa fa-th"></i> Confirmed</span>
													</td>
												</tr>
												<tr>
													<th>Zip Code</th>
													<td data-tracker-id="filtered-zip-code">
														<?php echo get_field('pro_address_group')['pro_zipcode']; ?>
													</td>
												</tr> */ ?>
												<tr>
													<th>Years of Experience</th>
													<td><?php echo get_field('pro_years_of_experience'); ?></td>
												</tr>

												<!-- <tr>
													<th>Provider Type</th>
													<td>Individual</td>
												</tr>
												<tr>
													<th>Experience</th>
													<td>
														<div class="facet-details">
															<a data-tracker-id="facet" href="/handymen/everywhere/residential">Residential</a><br>
														</div>
														<div class="facet-details">
															<a data-tracker-id="facet" href="/handymen/everywhere/commercial">Commercial</a><br>
														</div>
													</td>
												</tr> -->

												<?php $selected_pro_categories = get_the_terms($post, 'service_categories'); ?>

												<?php if ($selected_pro_categories) : ?>

												<tr>
													<th>Services</th>
													<td>

														<?php foreach ($selected_pro_categories as $key => $selected_pro_category ): ?>

															<div class="facet-details">
																<?php echo $selected_pro_category->name; ?><br>
															</div>
															
														<?php endforeach; ?>												
														
														
													</td>
												</tr>

												<?php endif; ?>

												<!-- <tr>
													<th>Training</th>
													<td>
														<div class="facet-details">
															<a data-tracker-id="facet" href="/handymen/everywhere/licensed-carpenter">Licensed Carpenter</a><br>
														</div>
														<div class="facet-details">
															<a data-tracker-id="facet" href="/handymen/everywhere/licensed-plumber">Licensed Plumber</a><br>
														</div>
													</td>
												</tr> -->

												<tr>
													<th>Is Certified?</th>
													<td><?php echo (get_field('pro_is_certified') !== 'no') ? 'Yes' : 'No'; ?></td>
												</tr>
												<tr>
													<th>Is Insured?</th>
													<td><?php echo (get_field('pro_has_insurance') !== 'no') ? 'Yes' : 'No'; ?><br></td>
												</tr>

											</tbody>
										</table>
									</div>
									<div class="cand-details" id="insurance">
										<p>Note: All statements concerning Insurance, Licenses and bonds are informational only and are self reported, since insurance, licenses and bonds can expire and can be canceled, homeowners should always check such information for themselves</p>
									</div>
								</div>
								<div class="col-lg-4 column">
									<div class="quick-form-job">
										<form>
											<h3>Quick Contact</h3><input placeholder="Enter your Name *" type="text"> <input placeholder="Email Address*" type="text"> <input placeholder="Phone Number" type="text"> <input placeholder="Enter yourMessage" type="text"> <button class="submit">Send Email</button> <span>You accepts our <a href="#" title="">Terms and Conditions</a></span>
										</form>
									</div>
									<div class="quick-img"><img alt="" src="images/pro-handyman.jpg" style="width: 100%;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="pro-bg" id="reviews">
		<div class="block less-top mtt30">
			<div class="container">
				<div class="row">

					<h2 class="ft26 hnd-reviews">Reviews</h2>

					<?php // var_dump($post->ID); ?>

					<?php echo do_shortcode('[RICH_REVIEWS_SHOW category="page" id="' . $post->ID . '" num="all"]'); // Plugin URL: https://wordpress.org/plugins/rich-reviews/ ?>

				</div>
			</div>
		</div>
	</section>

	<section class="pro-bg" id="reviews">
		<div class="block less-top mtt30">
			<div class="container">
				<div class="row">

					<?php echo do_shortcode('[RICH_REVIEWS_FORM]'); // Plugin URL: https://wordpress.org/plugins/rich-reviews/ ?>

				</div>
			</div>
		</div>
	</section>
	
	<!-- <section class="pro-bg" id="reviews">
		<div class="block less-top mtt30">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<h2 style="margin-bottom: 0;">Reviews</h2>
						<p>Showing 1 – 12 of 500 results</p>
					</div>
					<div class="col-md-7">
						<div class="sortby">
							<span>Filter Reviews</span>
							<div>
								<select>
									<option selected="selected">
										Most Recent
									</option>
									<option>
										Positive Reviews
									</option>
									<option>
										Disputed
									</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<hr style="color: #fff; margin-bottom:35px; opacity: 0.5;">
				<div class="content">
					<div class="loadMore">
						
						<div class="pro-border">
							<div class="grade">
								A
							</div>
							<div class="row">
								<div class="col-md-4">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th align="left"><strong>Heads</strong></th>
												<th align="left"><strong>Collected</strong></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Courteous?</td>
												<td>Yes</td>
											</tr>
											<tr class="success">
												<td>On Time?</td>
												<td>Yes</td>
											</tr>
											<tr>
												<td>Clean Up?</td>
												<td>Yes</td>
											</tr>
											<tr class="success">
												<td>Knowlegeable?</td>
												<td>Yes</td>
											</tr>
											<tr>
												<td>Quality?</td>
												<td>Yes</td>
											</tr>
											<tr class="success">
												<td>Choose for next project?</td>
												<td>Yes</td>
											</tr>
											<tr>
												<td>Price Reasonable?</td>
												<td>Yes</td>
											</tr>
											<tr class="success">
												<td>Rate 1 to 10?</td>
												<td>9</td>
											</tr>
											<tr>
												<td colspan="2">Job: $962.05 <span style=" float: right;text-align:right; font-weight:600;"><a data-target="#myModal1" data-toggle="modal">See Details &gt;</a></span></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-8">
									<div class="pro-border2">
										<p><strong>Customer Name:</strong> Bill/Barbara W<br>
										<strong>City:</strong> South Barrington<br>
										<strong>Job Date:</strong> 10/26/2017</p>
									</div>
									<div class="customerbox">
										<h3>Customer Comments</h3>
										<p class="b-description_readmore js-description_readmore">The rating would have been a 10 except for the following issues...poor communication at the beginning on the scope of work Nick did not understand what is was requesting. This lead to a more costly job than anticipated (this is why I rated the price question as I did). The original handyman did come but at least a day late and never returned. The man who actually did the work did a very nice job. All in all i`m pleased with the final product.</p>
									</div>
									<div class="companybox">
										<h3>Company Response</h3>
										<p>Dear Customer: Thank you for taking the time to fill out this quality control for our company, I am glad all went well at the end - Have a Great Holiday and please let us know if we can assist you again in the future - Thank you Nick Handyman pros.</p>
									</div>
								</div>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
	</section> -->





<?php
// get_sidebar();
get_footer();
