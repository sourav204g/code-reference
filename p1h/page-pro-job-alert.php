<?php
/**
 * Template Name: Pro Job Alert
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

get_header(); ?>


	

	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>


	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">
					

					<?php get_template_part( 'inc/pro', 'navigation' ); ?>


					<div class="col-lg-9 column">
						<div class="padding-left">
							<div class="manage-jobs-sec">
								<h3>Job Alerts</h3>
								<table>
									<thead>
										<tr>
											<td>Title</td>
											<td>Booking Date</td>
											<td>Created & Expired</td>
											<td>Status</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="table-list-title">
													<h3><a href="#" title="">Vanity Sink Top Replacement</a></h3><span><i class="la la-map-marker"></i>Sacramento, California</span>
												</div>
											</td>
											<td><span class="applied-field">October 27, 2018</span></td>
											<td><span>October 27, 2018</span><br>
											<span>April 25, 2018</span></td>
											<td><span class="status active">DONE</span></td>
											<td>
												<ul class="action_job">
													<li>
														<span>View Job</span><a href="#" title=""><i class="la la-eye"></i></a>
													</li>
													<li>
														<span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a>
													</li>
													<li>
														<span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a>
													</li>
												</ul>
											</td>
										</tr>
										<tr>
											<td>
												<div class="table-list-title">
													<h3><a href="#" title="">Vanity Sink Top Replacement</a></h3><span><i class="la la-map-marker"></i>Sacramento, California</span>
												</div>
											</td>
											<td><span class="applied-field">October 27, 2018</span></td>
											<td><span>October 27, 2018</span><br>
											<span>April 25, 2018</span></td>
											<td><span class="status active">DONE</span></td>
											<td>
												<ul class="action_job">
													<li>
														<span>View Job</span><a href="#" title=""><i class="la la-eye"></i></a>
													</li>
													<li>
														<span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a>
													</li>
													<li>
														<span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a>
													</li>
												</ul>
											</td>
										</tr>
										<tr>
											<td>
												<div class="table-list-title">
													<h3><a href="#" title="">Vanity Sink Top Replacement</a></h3><span><i class="la la-map-marker"></i>Sacramento, California</span>
												</div>
											</td>
											<td><span class="applied-field">October 27, 2018</span></td>
											<td><span>October 27, 2018</span><br>
											<span>April 25, 2018</span></td>
											<td><span class="status active">DONE</span></td>
											<td>
												<ul class="action_job">
													<li>
														<span>View Job</span><a href="#" title=""><i class="la la-eye"></i></a>
													</li>
													<li>
														<span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a>
													</li>
													<li>
														<span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a>
													</li>
												</ul>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


		
<?php
get_footer();