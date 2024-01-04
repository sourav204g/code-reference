<?php
/**
 * Template Name: Pro Manage Schedule
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

$edit_pro_saturday 	= get_field('pro_show_saturday_as_available', $_SESSION['posttype_pro_id']);
$edit_pro_sunday 	= get_field('pro_show_sunday_as_available', $_SESSION['posttype_pro_id']);
$edit_pro_evening 	= get_field('pro_show_evening_as_available', $_SESSION['posttype_pro_id']);

$edit_pro_off_dates = get_field('pro_schedule_off_dates', $_SESSION['posttype_pro_id']);

$date_to_display = '';

foreach ($edit_pro_off_dates as $key => $edit_pro_off_date) {

	// var_dump( $edit_pro_off_date['pro_schedule_off_date'] );
	// var_dump( substr( $edit_pro_off_date['pro_schedule_off_date'], 0, 4) );
	// var_dump( substr( $edit_pro_off_date['pro_schedule_off_date'], 4, 2) );
	// var_dump( substr( $edit_pro_off_date['pro_schedule_off_date'], 6, 2) );

	$off_date_year 	= substr( $edit_pro_off_date['pro_schedule_off_date'], 0, 4 );
	$off_date_month = substr( $edit_pro_off_date['pro_schedule_off_date'], 4, 2 );
	$off_date_day 	= substr( $edit_pro_off_date['pro_schedule_off_date'], 6, 2 );

	$date_to_display .= $off_date_month . '/' . $off_date_day . '/' . $off_date_year . ',';

}

$date_to_display = trim($date_to_display, ',');

// var_dump($edit_pro_saturday, $edit_pro_sunday, $edit_pro_evening);
// exit();


get_header(); ?>

	<style>

		a.schedule-time-btn {
		    font-size: 0.6em;
		    background: #323232;
		    color: #dad8d8;
		    padding: 3px 8px;
		    border-radius: 5px;
		    box-shadow: 2px 3px 0px 0px #00000040;
		}

		.btplus { cursor: pointer; font-size: 15px; padding: 20px 0px !important; }

		.row.time-row { margin-top: 5px; }

		.tags > .addedTag { background: #bec9ff; margin-top: 10px; }
		.tags { border: none; padding-left: 0px; }

		[name="edit_pro_schedule_time"] {
		    height: 0px !important;
		    padding: 0px !important;
		}

	</style>


	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>


	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">


					<?php get_template_part( 'inc/pro', 'navigation' ); ?>


					<div class="col-lg-9 column mt088">
						<div class="padding-left">
							<div class="profile-title">
								<h3>Manage Schedule</h3>
							</div>
							<div class="profile-form-edit" style="margin-top: 35px;">
								<form method="post" action="" id="pro-manage-schedule">

									<?php wp_nonce_field('avengers_infinity_war', 'handyman_pro_nonce'); ?>

									<div class="row">

										<div class="col-lg-4">
											<p><input id="edit_pro_saturday" name="edit_pro_saturday" type="checkbox" <?php echo ($edit_pro_saturday) ? 'checked' : ''; ?> ><label for="edit_pro_saturday">Show Saturday As Available</label></p>
										</div>
										<div class="col-lg-4">
											<p><input id="edit_pro_sunday" name="edit_pro_sunday" type="checkbox" <?php echo ($edit_pro_sunday) ? 'checked' : ''; ?>><label for="edit_pro_sunday">Show Sunday As Available</label></p>
										</div>
										<div class="col-lg-4">
											<p><input id="edit_pro_evening" name="edit_pro_evening" type="checkbox" <?php echo ($edit_pro_evening) ? 'checked' : ''; ?>><label for="edit_pro_evening">Show Evening As Available</label></p>
										</div>
										<div class="col-lg-12">
											<span class="pf-title">Schedule Off Date</span>
											<div class="pf-field">
												<input class="form-control off_dates_datepicker" name="edit_pro_off_dates" placeholder="Select Dates" type="text" value="<?php echo esc_html($date_to_display); ?>">
											</div>
										</div>


										<div class="col-lg-12">

											<div class="row">
												<div class="col-lg-12">
													<span class="pf-title" style="margin-bottom: 0px;">Schedule Time</span>
												</div>
											</div>

											<ul class="tags pro_schedule_time_ul" style="margin-bottom: 0px;">

											<?php $schedule_time_input = ''; ?>

											<?php if (get_field('pro_schedule_time', $_SESSION['posttype_pro_id'])): ?>
												
											<?php foreach (get_field('pro_schedule_time', $_SESSION['posttype_pro_id']) as $key => $pro_schedule_time): ?>

												
												<?php global $schedule_time_input; $schedule_time_input = $pro_schedule_time['pro_schedule_time_from'] . '-' . $pro_schedule_time['pro_schedule_time_to'] . ','; ?>

												<li class="addedTag" data-timeindex="<?php echo $key; ?>"><em class="time-value"><?php echo $pro_schedule_time['pro_schedule_time_from'] . '-' . $pro_schedule_time['pro_schedule_time_to'] ?></em> <span class="tagRemove timeRemove">x</span></li>
												
											<?php endforeach; ?>

											<?php endif; ?>

											</ul>

											<?php // var_dump($schedule_time_input); exit(); ?>

											<input type="text" name="edit_pro_schedule_time" id="" value="<?php echo esc_html( $schedule_time_input ); ?>">

											<div class="clearfix"></div>

											<?php if (isset($fromtoerrorText)): ?>

												<p class="error"><?php echo $fromtoerrorText; ?></p>
												
											<?php endif; ?>

											<div class="time-row-container">

											<!-- <?php // if (isset($_POST) && isset($_POST['edit_pro_from']) && isset($_POST['edit_pro_to'])): ?> -->

													<div class="row time-row">
														<div class="col-lg-5">
															<div class="pf-field">
																<input type="text" class="timepicker-f valid" name="edit_pro_from" id="">
															</div>
														</div>
														<div class="col-lg-5">
															<div class="pf-field">
																<input type="text" class="timepicker-f valid" name="edit_pro_to" id="">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="btplus time-schedule">
																Add
															</div>
															<div class="clearfix"></div>
														</div>
													</div>
												
											<!-- <?php // endif; ?> -->

											</div> <!-- time-row-container -->

										</div>
										<div class="col-lg-12">
											<button type="submit" name="edit_profile_manage_schedule">Update</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

		


<?php
get_footer();