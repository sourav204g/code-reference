<?php if ( isset($bookingDetails['selected_service']) && $bookingDetails['selected_service'] !== '' ) : // SERVICE ?>


		<?php 

				$pro_premium  = (int) $bookingDetails['handyman_premium'];

				// var_dump($pro_premium);

				$hnd_options = unserialize(base64_decode($bookingDetails['hnd_options']));
				$hnd_suboptions = unserialize(base64_decode($bookingDetails['hnd_suboptions']));
				$all_service_setup = unserialize(base64_decode($bookingDetails['configured_setup']));
				$hnd_suboptions_values = unserialize(base64_decode($bookingDetails['hnd_suboptions_values']));

				// $hnd_post_values
				// var_dump($hnd_options);
				// var_dump($hnd_suboptions);
				// var_dump($all_service_setup);
				// var_dump($hnd_suboptions_values);
				// exit;

				$service_prices = unserialize(base64_decode($bookingDetails['service_prices']));

				// var_dump($service_prices);
				// exit;

				// var_dump($service_prices[$key]);
				// exit;

				// var_dump($hnd_post_values);
				// exit;



		?>
			
		<?php foreach ( $hnd_post_values as $key => $hnd_post_value ): ?>

			<?php 

					// var_dump($hnd_post_value); 
					// var_dump(get_post( $hnd_post_value ));

			?>

			<div class="booking-card">
				
				<label class="booking-card-label">Service</label>
				<label class="completion-time"><?php echo $hnd_post_value['handymn_service_time']/60; ?> hours</label>
			
				<table>
					<tbody>
						<tr>
							<td>Service:</td>
							<td><a href="<?php echo get_permalink( $hnd_post_value['handymn_service_id'] ); ?>" style="color:white;" target="_blank"><?php echo $hnd_post_value['handymn_service_name']; ?></a></td>
							<td>$<?php echo round($hnd_post_value['handymn_service_price'], 2); ?></td>
						</tr>
						<tr>
							<td>Options:</td>
							<td colspan="2">

								<ul class="options">

									<?php

												$handyman_total = 0;  
												$handyman_total = $hnd_post_value['handymn_service_price']; 

												$handyman_total_time = 0;  
												$handyman_total_time = $hnd_post_value['handymn_service_time'];

									?>


									<?php  if (  isset( $hnd_options[$key] ) 
												&& isset( $hnd_suboptions[$key] ) 
												&& isset( $all_service_setup[$key] )
												&& isset( $hnd_post_values[$key] )
												&& isset( $hnd_suboptions_values[$key] )
											) : ?>

																				
										<?php foreach ( $hnd_options[$key] as $elkey => $option_data ) : 

											$indivisual_opt_elem = explode('|', $option_data);
											$opt_type = $indivisual_opt_elem[0];
											
											$__Q = $indivisual_opt_elem[1]; // Choosen Question Index
											$__O = $indivisual_opt_elem[2]; // Choosen Option Index


											if (isset($indivisual_opt_elem[3])) {
														$__O_Delete = $indivisual_opt_elem[3]; // If deleted.
											} else {
												$__O_Delete = null;
											}


											if ( $opt_type !== 'undefined' ) { // Check If has sub-option

												$indivisual_sub_elem = explode('|', $hnd_suboptions[$key][$elkey] );
												$__S = $indivisual_sub_elem[3]; // Choosen SubOption Index

												if (isset($indivisual_sub_elem[4])) {
														$__SO_Delete = $indivisual_sub_elem[4]; // If deleted.
												} else {
													$__SO_Delete = null;
												}

											}
									

											if ( $opt_type === 'handyman_sub_option_quantity' ) {

												if ( !isset($__O_Delete) ) {

													$selected_option_label = (string) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													$selected_option_labour_minutes = (int) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;

												} else {
													$selected_option_label = null;
													$selected_option_labour_minutes = 0;
												}

												

												if (!isset($__SO_Delete)) {


													$entered_suboption_quanity = (int) explode( '|', $hnd_suboptions_values[$key][$elkey] )[2];	


													$selected_suboption_label = $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_label . ' Qty - ' . $entered_suboption_quanity;
												
													

													$selected_suboption_labour_minutes = (int) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_labour_minutes * $entered_suboption_quanity;	

													
												} else {

													$selected_suboption_label = null;
													$selected_suboption_labour_minutes = 0;

												}


												// var_dump( $selected_option_label );
												// var_dump( $selected_option_labour_minutes );
												// var_dump( $selected_suboption_label );
												// var_dump( $selected_suboption_labour_minutes );

												
											} elseif( $opt_type === 'handyman_sub_option_yesno' ) {


												if ( !isset($__O_Delete) ) {

													$selected_option_label = (string) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													$selected_option_labour_minutes = (int) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;

												} else {
													$selected_option_label = null;
													$selected_option_labour_minutes = 0;
												}


												if (!isset($__SO_Delete)) {

														if ( (int) $__S ===  0 ) { // IF YES

															$selected_suboption_label = (string) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_label;
															$selected_suboption_labour_minutes = (int) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_labour_minutes;

														} else { // IF NO

															$selected_suboption_label = null;
															$selected_suboption_labour_minutes = 0;

														}

												} else {
															$selected_suboption_label = null;
															$selected_suboption_labour_minutes = 0;
												}


											} elseif( $opt_type === 'handyman_sub_option_list' ) {


												if ( !isset($__O_Delete) ) {

													$selected_option_label = (string) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													$selected_option_labour_minutes = (int) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;

												} else {
													$selected_option_label = null;
													$selected_option_labour_minutes = 0;
												}


												if (!isset($__SO_Delete)) {


													$selected_suboption_label = (string) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_label;

													$selected_suboption_labour_minutes = (int) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_labour_minutes;

												} else {
															$selected_suboption_label = null;
															$selected_suboption_labour_minutes = 0;
												}


												
											} elseif( $opt_type === 'undefined' ) {

												// $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O];

												if ( !isset($__O_Delete) ) {

													$selected_option_label = (string) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->handyman_option_label;
													$selected_option_labour_minutes = (int) $all_service_setup[$key][$__Q]->handyman_addon_options[$__O]->labour_minutes;

												} else {
													$selected_option_label = null;
													$selected_option_labour_minutes = 0;
												}


												$selected_suboption_label = null;
												$selected_suboption_labour_minutes = 0;

											}


										?><?php if (isset($selected_option_label)) : ?>
														
												
													<li>
														<span><em><?php echo $selected_option_label; ?> (Included)</em> - </span>
														<span>$<?php echo round($hnd_post_value['handymn_per_min_cost'] * $selected_option_labour_minutes, 2); ?></span>
													</li>

																	
																	
												<?php endif; ?>
												

												<?php if (isset($selected_suboption_label)): // IF SUBOPTION EXISTS ?>


													<li>
														<span><em><?php echo $selected_suboption_label; ?> (Included)</em> - </span>
														<span>$<?php echo round($hnd_post_value['handymn_per_min_cost'] * $selected_suboption_labour_minutes, 2); ?></span>
													</li>
												
													
												<?php endif; ?>


												<?php 

												// TOTAL PRICE
												$handyman_total += ( $selected_option_labour_minutes * (float) $hnd_post_value['handymn_per_min_cost']  ) + ( $selected_suboption_labour_minutes * (float) $hnd_post_value['handymn_per_min_cost'] );

												$handyman_total_time += $selected_option_labour_minutes + $selected_suboption_labour_minutes;

												?>

											
											<?php endforeach; ?>													
											
										<?php endif; ?>

										<?php // echo 'Total - ' . $handyman_total; ?>
										<?php // echo 'Time - ' . $handyman_total_time; ?>

										<span class="handyman_total_time" style="display: none;"><?php echo timeConvert($handyman_total_time); ?></span>

										<?php $pro_premium_cost	= ( $handyman_total * $pro_premium ) / 100; ?>

										<?php // var_dump($pro_premium_cost); ?>

										<!-- <li>
											<span><em>Rather than set the</em> - </span>
											<span>$210</span>
										</li>
										<li>
											<span><em>Note that visually the spaces aren't equal, since all the items have equal space on both sides</em> - </span>
											<span>$210</span>
										</li> -->

								</ul>
								
							</td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $pro_premium; ?>% Higher Labour Charges:</td>
							<td>$<?php echo round($pro_premium_cost, 2); ?></td>
						</tr>
						<tr>
							<td colspan="2">Total Amount:</td>
							<td>$<?php echo round((float) $service_prices[$key] + $pro_premium_cost, 2); ?></td>
						</tr>
						
						<?php if (isset($hnd_post_value['handymn_service_comments']) && $hnd_post_value['handymn_service_comments'] != ''): ?>

							<tr>
								<td colspan="2">Comments:</td>
								<td><?php echo $hnd_post_value['handymn_service_comments']; ?></td>
							</tr>
							
						<?php endif; ?>
						
					</tbody>
				</table>
			</div><!-- booking-card -->

		<?php endforeach; ?>

<?php endif; ?>

<script>
	
	let total_times = document.querySelectorAll('.handyman_total_time');

	total_times.forEach(function(evt, index){
		evt.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].innerHTML = total_times[index].innerHTML;
	});

</script>