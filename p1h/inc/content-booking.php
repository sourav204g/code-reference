<?php

	//if (is_admin()) { // If admin page
	
		function timeConvert($n) {

			$num = $n;
			$hours = ( $num / 60 );

			$rhours = floor($hours);

			// $minutes = ($hours - $rhours) * 60; // 9-July-2019
			$minutes = round(($hours - $rhours) * 60);

			$rminutes = round($minutes, 2);
			
			$rminutes = str_pad($rminutes, 2, "0", STR_PAD_LEFT);
			
			return $rhours . ":" . $rminutes . " Hours";
		}
	
	//}

	function handyman_booking_details_callback( $post ) {

	// var_dump( $post->post_status !== 'draft' );
	// if( $post->post_status !== 'draft' && $post->post_status !== 'auto-draft' ) :
	
	global $wpdb;

	$bookingDetails = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM hxp_handyman_booking WHERE booking_id = %s", array( $post->ID ) ), 'ARRAY_A');

	$fetch_hour_price = (float) $bookingDetails['hour_price'];
	$per_min_cost = $fetch_hour_price/60;

	// var_dump($bookingDetails);
	// exit;

	$unserialized_scheduled_address = unserialize(base64_decode($bookingDetails['scheduled_address']));
	$handyman_name 					= get_post($bookingDetails['handyman_id'])->post_title;
	$scheduled_date_strtotime 		= strtotime( $bookingDetails['scheduled_date'] );
	$scheduled_date 				= date('F j, Y', $scheduled_date_strtotime);
	
	$hnd_post_values 				= unserialize(base64_decode($bookingDetails['selected_service'])); // Service
	$selected_products 				= unserialize(base64_decode($bookingDetails['selected_product'])); // Product

	$itemCount = 0;

	if ($hnd_post_values) {
		$itemCount += count($hnd_post_values);
	}

	if ($selected_products) {
		$itemCount += count($selected_products);
	}
	

?>

	<style>
		.booking-card table, .customer-card table { font-size: 13px; }
	</style>
	
	<div class="booking-card-container customer-container">
			<div class="customer-card">
			<label class="booking-card-label">Customer Details</label>
			<label class="handyman-name"><?php echo $handyman_name; ?></label>
			<label class="completion-time">Quantity - <?php echo $itemCount; ?> (Items)</label>
			<label class="arrival-time"><?php echo $bookingDetails['scheduled_arrival_time']; ?></label>
			<label class="job-date"><?php echo $scheduled_date; ?></label>
			<table>
				<tbody>
					<tr>
						<td><span>Name:</span> <?php echo $unserialized_scheduled_address['hnd_customer_name']; ?></td>
						<td><span>Email:</span> <?php echo $bookingDetails['customer_email']; ?></td>
						<td><span>Phone:</span> <?php echo $bookingDetails['customer_phone']; ?></td>
						<td><span>City:</span> <?php echo $unserialized_scheduled_address['hnd_customer_city']; ?></td>
						<td><span>State:</span> <?php echo $unserialized_scheduled_address['hnd_customer_state']; ?></td>
					</tr>
					<tr>
						<td colspan="4"><span>Address:</span> <?php echo $unserialized_scheduled_address['hnd_customer_address']; ?></td>
						<td><span>Zipcode:</span> <?php echo $bookingDetails['scheduled_zipcode']; ?></td>
					</tr>			
				</tbody>
			</table>
		</div> <!-- booking-card -->
	</div>

	<section class="booking-card-container">

		<?php require get_template_directory() . '/inc/service-card.php'; ?>
		<?php require get_template_directory() . '/inc/product-card.php'; ?>

	</section>

	<?php // endif; ?>

<?php }