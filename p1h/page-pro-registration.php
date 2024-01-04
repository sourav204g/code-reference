<?php
/**
 * Template Name: Pro Registration
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


get_template_part( 'inc/process', 'form-data' );

get_header(); ?>


	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>


	<style>

		.profile-form-edit > form {
		   padding-left: initial;
		}

		.bdbt10 {
		    border-bottom: 1px solid #939fc8;
		    padding-bottom: 15px;
		    font-size: 25px !important;
		    color: #FF5722;
		    margin: 40px auto 30px auto;
		}

		.pf-title {
		    float: left;
		    width: 100%;
		    margin-top: 14px;
		    font-family: 'Lato', sans-serif;
		    font-size: 13px;
		    color: #3F51B5;
		    margin-bottom: 6px;
		    font-weight: 500;
		    text-align: left !important;
		}

		.pf-field > input, .pf-field > textarea, .pf-field > select {
		    float: left;
		    width: 100%;
		    border: 1px solid #8f9bc3;
		    padding: 4px 12px 4px 12px;
		    background: #ffffff;
		    font-family: 'Lato', sans-serif;
		    font-size: 13px;
		    color: #101010;
		    line-height: 24px;
		}

		.pf-title.visibility { visibility: hidden; }

		.right-side label {
		    padding: 0 0 0 1.5em;
		    height: 1.5em;
		    line-height: 1.5;
		    cursor: pointer;
		    letter-spacing: 0.5px;
		    font-family: 'Lato', sans-serif;
		    font-size: 13px;
		}

		.right-side label::before, .right-side label::after {
		    width: 15px !important;
		    height: 15px !important;
		}

		.right-side label::before {
		    border: 1px solid #8f9bc3;
		    -webkit-border-radius: 0px;
		    -moz-border-radius: 0px;
		    -ms-border-radius: 0px;
		    -o-border-radius: 0px;
		    border-radius: 0;
		    margin-top: 2px;
		}

		.pro-skills { display: grid;grid-template-columns: repeat(3, 1fr); }

		.pro-skills span { padding: 2px 0px; }

		input[type="checkbox"] + label::after {
		    color: #3F51B5;
		}

		input[type="checkbox"]:checked + label::before, input[type="radio"]:checked + label::before {
		    background: #ffffff;
		    border-color: #03A9F4;
		}

		.skill-rating {
		    display: grid;
		    grid-template-columns: repeat(5, 1fr);
		    margin-top: 10px;
		}

		.skill-rating span {  font-size: 13px; }
		.skill-rating input[type="number"] {
		    width: 99%;
		    border: 1px solid #8f9bc3;
		    margin-top: 2px;
		    padding: 4px 12px 4px 12px;
		}

		.row.margin-top { margin-top: 10px; }

		.education-qualification, .employment-history, .truck-van {
		    display: grid;
		    grid-template-columns: repeat(5, 1fr);
		    font-size: 13px;
    		margin-top: 5px;
		}

		.truck-van { grid-template-columns: repeat(3, 1fr); }

		.education-qualification > span {
			justify-self: center;

		}

		span.completed { grid-column: 2 / 4; }

		span.completed select {
			    border: 1px solid #8f9bc3;
			    padding: 0px 25px 0px 25px;
			    background: #ffffff;
			    font-family: 'Lato', sans-serif;
			    font-size: 13px;
			    color: #101010;
			    line-height: 24px;
		}

		.edubackground {
			float: none; /*margin-bottom: 15px;*/ display: block; margin-top: 0px;
		}

		.submit-btn { margin-top: 20px; }

		.pro-date {  margin-top: 10px; }
		.pro-date input { line-height: 22px; }

		@media screen and (max-width: 980px) {

			input[type="text"], input[type="number"], input[type="password"], input[type="email"], textarea, select {
				margin-bottom: 10px;
			}

			select {
				border-radius: 0px;
				height: auto;
			}

			.pf-title { margin-top: 0px; }
			.pf-title.visibility { display: none; }

			.pro-skills { display: grid;grid-template-columns: repeat(3, 1fr); }

		}

		/*.disableit { pointer-events: none; opacity: 0.5 }*/

	</style>



	<section>
		<div class="block less-top">
			<div class="container">
				<div class="profile-form-edit">
					<form action="" method="post" id="handyman-rsg">

						<div class="row">
							<div class="col-md-6">

										<!-- <h2 class="bdbt10" style="margin-top: 0px;">Personal Information</h2> -->

										<?php wp_nonce_field('avengers_infinity_war', 'handyman_pro_nonce'); ?>

										<div class="row">
											<div class="col-md-12">
												<span class="pf-title" style="margin-top: 0px;">Account Info</span>
												<div class="pf-field">
													<input placeholder="Username" name="pro_username" type="text">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<!-- <span class="pf-title">First Name</span> -->
												<div class="pf-field">
													<input placeholder="First Name" name="pro_first_name" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<!-- <span class="pf-title">Last Name</span> -->
												<div class="pf-field">
													<input placeholder="Last Name" name="pro_last_name" type="text">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<!-- <span class="pf-title">Email</span> -->
												<div class="pf-field">
													<input placeholder="Email" name="pro_email" type="email">
												</div>
											</div>										
										</div>

										<div class="row">
											<div class="col-md-12">
												<!-- <span class="pf-title">First Name</span> -->
												<div class="pf-field">
													<input placeholder="Password" name="pro_password" type="password">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<!-- <span class="pf-title">First Name</span> -->
												<div class="pf-field">
													<input placeholder="Confirm Password" name="pro_confirm_password" type="password">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<span class="pf-title">Address</span>
												<div class="pf-field">
													<input placeholder="Street" name="pro_street" type="text">
												</div>
											</div>		
											<div class="col-md-6">
												<span class="pf-title visibility">Address</span>
												<div class="pf-field">
													<input placeholder="City" name="pro_city" type="text">
												</div>
											</div>								
										</div>
	
										<div class="row">
											<div class="col-md-6">
												<!-- <span class="pf-title">County</span> -->
												<div class="pf-field">
													<input placeholder="County" name="pro_county" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<!-- <span class="pf-title">State</span> -->
												<div class="pf-field">
													<input placeholder="State" name="pro_state" type="text">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<!-- <span class="pf-title">Country</span> -->
												<div class="pf-field">
													<input placeholder="Country" name="pro_country" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<!-- <span class="pf-title">Zip Code</span> -->
												<div class="pf-field">
													<input placeholder="Zip Code" name="pro_zipcode" type="number">
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-6">
												<!-- <span class="pf-title">Home Phone</span> -->
												<div class="pf-field">
													<input placeholder="Home Phone Number" name="pro_home_phone" type="number">
												</div>
											</div>
											<div class="col-md-6">
												<!-- <span class="pf-title">Cell No</span> -->
												<div class="pf-field">
													<input placeholder="Cell Phone Number" name="pro_cell_phone" type="number">
												</div>
											</div>
										</div>

										<div class="row disableit">
											<div class="col-md-12">
												<span class="pf-title">Are you legally eligible for employment in this country?</span>
												<div class="pf-field">
													<select class="" name="pro_legally_eligible">
														<option>
															Yes
														</option>
														<option>
															No
														</option>
													</select>
												</div>
											</div>
										</div>

										<div class="row disableit">
											<div class="col-md-12">
												<span class="pf-title">Have you evern been convicted of a crime?</span>
												<div class="pf-field">
													<select class="" name="pro_convicted_crime">
														<option>
															Yes
														</option>
														<option>
															No
														</option>
													</select>
												</div>
											</div>
										</div>

										<div class="row disableit">
											<div class="col-md-12">
												<span class="pf-title">How many years of experience do you have? (10 years minimum)</span>
												<div class="pf-field">
													<input placeholder="years of experience" name="pro_year_of_experience" type="number">
												</div>
											</div>
										</div>

							</div> <!-- col-md-6 -->
							<div class="col-md-6 right-side">

								<div class="row margin-top">
									<div class="col-md-12">
										<span class="pf-title" style="float: none;">Skills</span><br>
										<div class="pro-skills">

											<?php 


											$service_category_object = get_queried_object();
											$service_categories_or_skills = get_terms( array( 

												'taxonomy' => 'service_categories',
												'hide_empty' => false,
												// 'parent' => 0

											) );


											// var_dump($service_categories_or_skills);
											// exit();


											?><?php foreach ($service_categories_or_skills as $key => $pro_skill) : ?>

												<?php // var_dump($pro_skill); ?>

												<span><input id="skill-<?php echo $key; ?>" name="pro_skills[]" type="checkbox" value="<?php echo esc_html($pro_skill->term_id); ?>"><label for="skill-<?php echo $key; ?>"><?php echo $pro_skill->name; ?></label></span>
											<?php endforeach; ?>



										</div>
									</div>
								</div>

								<div class="row margin-top disableit">
									<div class="col-md-12">
										<span class="pf-title " style="float: none;">Tools Inventory</span><br>
										<div class="pro-skills">

											<?php

											if(get_field('handyman_pro_tools_config', 'option')) :

											foreach (get_field('handyman_pro_tools_config', 'option') as $key => $handyman_pro_tool) : ?>
											
										        <span><input id="as<?php echo $key; ?>" value="<?php echo $handyman_pro_tool['handyman_pro_tool']; ?>" name="pro_tools[]" type="checkbox"><label for="as<?php echo $key; ?>"><?php echo $handyman_pro_tool['handyman_pro_tool']; ?></label></span>

											<?php  endforeach; endif; ?>

										</div>
									</div>
								</div>

								<div class="row margin-top disableit">
									<div class="col-md-12" style="">
										<span class="pf-title " style="float: none;">On a scale of 1-10, which skills are your strongest?</span><br>

											<div class="skill-rating">
												<span>Carpentry <input class="" name="pro_skill_rating_carpentry" type="number"></span>
												<span>Painting <input class="" name="pro_skill_rating_painting" type="number"></span>
												<span>Tiling <input class="" name="pro_skill_rating_tiling" type="number"></span>
												<span>Plumbing <input class="" name="pro_skill_rating_plumbing" type="number"></span>
												<span>Electrical <input class="" name="pro_skill_rating_electrical" type="number"></span>
											</div>										

									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<span class="pf-title">Are you Certified Professional?</span>
										<div class="pf-field">
											<select class="" name="pro_certified">
												<option value="yes">
													Yes
												</option>
												<option value="no">
													No
												</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<span class="pf-title">Are you Insured?</span>
										<div class="pf-field">
											<select class="" name="pro_insured">
												<option value="yes">
													Yes
												</option>
												<option value="no">
													No
												</option>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<span class="pf-title">Can you work in the evenning?</span>
										<div class="pf-field">
											<select class="" name="pro_evenning">
												<option value="true">
													Yes
												</option>
												<option value="false">
													No
												</option>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<span class="pf-title">Can you work on Saturday?</span>
										<div class="pf-field">
											<select class="" name="pro_saturday">
												<option value="">
													Select Option
												</option>
												<option value="true">
													Yes
												</option>
												<option value="false">
													No
												</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<span class="pf-title">Can you work on Sunday?</span>
										<div class="pf-field">
											<select class="" name="pro_sunday">
												<option value="true">
													Yes
												</option>
												<option value="false">
													No
												</option>
											</select>
										</div>
									</div>
								</div>

								
							</div> <!-- col-md-6 -->
						</div> <!-- row -->

						<hr>
					
						<div class="row margin-top disableit">

							<div class="col-md-12">

									<span class="pf-title edubackground" style="float: none;margin-bottom: 15px;">Educational Background</span>

									<div class="education-qualification">
										<span>High School -</span>
										<span class="completed">
											
											<span>Completed<input name="pro_high_school" type="radio"></span>

											<select class="" name="pro_high_school_year">
												<option value="">
													Year
												</option>
												<option value="2018">
													2018
												</option>
												<option value="2017">
													2017
												</option>
												<option value="2016">
													2016
												</option>
											</select>

										</span>
										<span>Attending <input name="pro_high_school" type="radio"></span>
										<span>N/A <input name="pro_high_school" type="radio"></span>
									</div>

									<div class="education-qualification">
										<span>University or College	-</span>
										<span class="completed">
											
											<span>Completed<input name="pro_college" type="radio"></span>

											<select class="" name="pro_college_year">
												<option value="">
													Year
												</option>
												<option value="2018">
													2018
												</option>
												<option value="2017">
													2017
												</option>
												<option value="2016">
													2016
												</option>
											</select>

										</span>
										<span>Attending <input name="pro_college" type="radio"></span>
										<span>N/A <input name="pro_college" type="radio"></span>
									</div>

									<div class="education-qualification">
										<span>Specialized Training	-</span>
										<span class="completed">
											
											<span>Completed<input name="pro_training" type="radio"></span>

											<select class="" name="pro_training_year">
												<option value="">
													Year
												</option>
												<option value="2018">
													2018
												</option>
												<option value="2017">
													2017
												</option>
												<option value="2016">
													2016
												</option>
											</select>

										</span>
										<span>Attending <input name="pro_training" type="radio"></span>
										<span>N/A <input name="pro_training" type="radio"></span>
									</div>

				
								
							</div> <!-- col-md-12 -->
							<div class="col-md-12">

									<span class="pf-title margin-top" style="float: none;margin-top: 15px;display: block;">	Employment History</span>

									<?php for ($i=1; $i <= 4; $i++) : ?> 

										<div>
											<strong style="font-size: 13px; margin-top: 15px; display: block;">Job #<?php echo $i; ?></strong>
											<div class="employment-history">
												<span>
													<div class="pf-field"><input placeholder="Employer" name="pro_employer<?php echo $i; ?>" type="text"></div>
												</span>

												<span>
													<div class="pf-field"><input placeholder="Position" name="pro_position<?php echo $i; ?>" type="text"></div>
												</span>

												<span>
													<div class="pf-field"><input placeholder="How long?" name="pro_how_long<?php echo $i; ?>" type="text"></div>
												</span>

												<span>
													<div class="pf-field"><input placeholder="Date left" name="pro_date_left<?php echo $i; ?>" type="text"></div>
												</span>

												<span>
													<div class="pf-field"><input placeholder="Reason left" name="pro_reason_left<?php echo $i; ?>" type="text"></div>
												</span>

											</div>
										</div>

									<?php endfor; ?>

									
									

								
							</div> <!-- col-md-12 -->

							<div class="col-md-12">

									<span class="pf-title edubackground" style="float: none;margin-top: 15px;">Truck/ Van</span>
										
									<div class="truck-van">
										<span class="pro-date">
											<div class="pf-field"><input placeholder="Year" name="pro_year" type="date"></div>
										</span>

										<span>
											<div class="pf-field"><input placeholder="Make" name="pro_make" type="text"></div>
										</span>

										<span>
											<div class="pf-field"><input placeholder="Model" name="pro_model" type="text"></div>
										</span>
									</div>
								
							</div>

							<div class="col-md-12">

									<span class="pf-title edubackground" style="float: none;margin-top: 15px;">Additional Comments or Questions</span>


									<div class="comments-or-questions">

										<textarea name="pro_comments_questions" rows="2" cols="20"  style="height:158px;width:100%;"></textarea>
										
									</div>
								
							</div>
							
						</div> <!-- row -->


						<div class="row">
							<div class="col-md-12">
								<div class="submit-btn">
										<input name="pro_submit" type="submit"></span>
									</div>
							</div>
						</div>
		







					</form>
				</div>
			</div>
		</div>
	</section>



<?php
get_footer(); ?>