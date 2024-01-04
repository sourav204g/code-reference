<?php 

if( $_POST && isset($_POST['handymn_sl_addon_services']) ) {
		handyman_add_to_cart();
}

if( $_POST && isset($_POST['handymn_hasno_option_values']) ) {
		handyman_add_to_cart_no_opt();
}

function handyman_add_to_cart() {

		// session_destroy();
		// var_dump($_POST);
		// var_dump($_POST['handyman_pro_nonce']);
		// var_dump(!wp_verify_nonce( $_POST['handyman_pro_nonce'], 'waiting_for_avengers_4_trailer' ));
		// exit;

		if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'waiting_for_avengers_4_trailer' ) ) {

				die( 'Failed security check' );

		} else {
					
					// REF - https://stackoverflow.com/questions/15986235/how-to-use-json-stringify-and-json-decode-properly
				
					if (get_field('handyman_add_on_services')) :

					$jsonOptStr = $_POST["handymn_service_opt"];
					$tempOptData = str_replace("\\", "", $jsonOptStr);
					$cleanOptDatazx = json_decode($tempOptData);

					$jsonSubStr = $_POST['handymn_service_sub'];
					$tempSubData = str_replace("\\", "", $jsonSubStr);
					$cleanSubDatazx = json_decode($tempSubData);

					if (isset($_POST['handymn_service_opt_deleted'])) {
						$del_op = str_replace("\\", "", $_POST['handymn_service_opt_deleted']);
						$del_op = json_decode($del_op);
					} else {
						$del_op = null;
					}

					if (isset($_POST['handymn_service_sub_deleted'])) {
						$del_sop = str_replace("\\", "", $_POST['handymn_service_sub_deleted']);
						$del_sop = json_decode($del_sop);
					} else {
						$del_sop = null;
					}
					

					



					$selected_all_addon_optionsStr = $_POST["handymn_sl_addon_services"];
					$temp_all_addon_Data = str_replace("\\", "", $selected_all_addon_optionsStr);
					$clean_all_addon_Datazx = json_decode($temp_all_addon_Data);

					// selected service option values // not needed now, but may be in future.
					/* $jsonOptStr_val = $_POST["handymn_service_opt_val"];
					$tempOptData_val = str_replace("\\", "", $jsonOptStr_val);
					$cleanOptDatazx_val = json_decode($tempOptData_val); */

					// selected service sub-option values
					$jsonSubStr_val = $_POST['handymn_service_sub_val'];
					$tempSubData_val = str_replace("\\", "", $jsonSubStr_val);
					$cleanSubDatazx_val = json_decode($tempSubData_val);

					// echo '<pre>';
					// var_dump($cleanOptDatazx, $cleanSubDatazx, $clean_all_addon_Datazx, $cleanSubDatazx_val);

					// var_dump($selected_all_addon_optionsStr);


					if ( $cleanOptDatazx == null || $cleanSubDatazx == null || $clean_all_addon_Datazx == null || $cleanSubDatazx_val == null ) {
						die( 'Something Went Wrong! Please Try again.' );
					}

					endif;

					if( !session_id() ) {

							session_start();

							// session_destroy(); // DELETE THIS LINE // THIS LINE IS ONLY FOR TESTING

							$_SESSION['hnd_post_values'][] = (array) $_POST;

							if (get_field('handyman_add_on_services')) :

								$_SESSION['hnd_del_options'][] = $del_op ? (array) $del_op : null;
								$_SESSION['hnd_del_suboptions'][] = $del_sop ? (array) $del_sop : null;

								$_SESSION['hnd_options'][] = (array) $cleanOptDatazx;
								$_SESSION['hnd_suboptions'][] = (array) $cleanSubDatazx;
								$_SESSION['all_service_setup'][] = (array) $clean_all_addon_Datazx;

								$_SESSION['hnd_suboptions_values'][] = (array) $cleanSubDatazx_val;

						    endif;

							wp_redirect( home_url('/cart/') , 302 );
							exit();

					}

				
		}

}

function handyman_add_to_cart_no_opt() {

	if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'waiting_for_avengers_4_trailer' ) ) {

				die( 'Failed security check' );

		} else {

					// echo '<pre>';
					// var_dump($_POST);
					// exit;

					/* if (isset($_FILES['filename']) && $_FILES['filename']['tmp_name'][0] === '') {
						wp_redirect( get_permalink( $_POST['handymn_service_id'] ) . '?m=required' );
						exit;
					} */

					$hpnv = array();
					$hpnv = (array) $_POST;

					// echo '<pre>';
					// var_dump($hpnv);
					// exit;

					$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
					$per_min_cost = $fetch_hour_price/60;


					// 4-July-2019 
					if (isset($hpnv['handymn_custom_price']) && $hpnv['handymn_custom_price'] !== '') {
						$servicePrice = (float) $hpnv['handymn_custom_price'];
						$handymn_custom_time = $servicePrice/$per_min_cost;

						// var_dump($servicePrice); // PENDING
						// var_dump($per_min_cost);
						// var_dump($servicePrice/$per_min_cost);
						// exit;

					} else {
						$servicePrice = $per_min_cost * get_field('handyman_est_time', $hpnv['handymn_service_id']);
					}
					

					if (get_field('handyman_product_premium', $hpnv['handymn_service_id'])) {
						
						$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $hpnv['handymn_service_id']))/100;

					} else {
						
						$handyman_premium = 0;
					}

					$servicePrice = $servicePrice + $handyman_premium;

					// IF discount is set
					if(get_field('handyman_product_discount', $hpnv['handymn_service_id'])) {

						$discount = get_field('handyman_product_discount', $hpnv['handymn_service_id']);

						$afterDiscount = ( $servicePrice * $discount ) / 100;

					} else {

						$afterDiscount = 0;
					}

					if ($hpnv['handymn_service_id'] !== 'custom') {
						$hpnv['handymn_service_name'] 	= get_the_title($hpnv['handymn_service_id']);
					} else {
						$hpnv['handymn_service_name'] 	= 'Custom Project Request';
					}

					
					
					// 6-July-2019
					if (isset($hpnv['handymn_custom_price']) && $hpnv['handymn_custom_price'] !== '') {

						$hpnv['handymn_service_time'] 	= $handymn_custom_time;

					} else {

						$hpnv['handymn_service_time'] 	= get_field('handyman_est_time', $hpnv['handymn_service_id']);

					}


					// echo "<pre>";
					// var_dump($_FILES);
					// exit;


					if (isset($_FILES['filename'])) {

						foreach ($_FILES['filename']['tmp_name'] as $key => $tmp_name) {

							if($tmp_name !== '') {

								$imageData = base64_encode(file_get_contents( $tmp_name ));
								$img = str_replace('data:image/png;base64,', '', $imageData);
								$img = str_replace(' ', '+', $img);	
								$getimagesrc = 'data: '.mime_content_type($image).';base64,'.$imageData;	
								$showimg = $getimagesrc;
								$insertimg = $img;

								$hpnv['handymn_show_image'][$key] = $showimg;
								$hpnv['handymn_insert_image'][$key] = $insertimg;

							}						

						}

					}


					// echo '<pre>';
					// var_dump($hpnv['handymn_show_image']);
					// var_dump($hpnv['handymn_insert_image']);
					// exit;


					$hpnv['handymn_per_min_cost'] 	= $per_min_cost;
					$hpnv['handymn_service_price'] 	= $servicePrice - $afterDiscount;
					$hpnv['handymn_premium'] 		= $handyman_premium;
					$hpnv['handymn_after_discount'] = $afterDiscount;
					// $hpnv['handymn_service_description'] 		= strip_tags(get_field('handyman_prod_services_description', $hpnv['handymn_service_id']));

					if (get_field('handyman_prod_shopping_cart_description', $hpnv['handymn_service_id'])) {
						$hpnv['handymn_service_description'] 		= htmlentities(get_field('handyman_prod_shopping_cart_description', $hpnv['handymn_service_id']));
					} else {
						$hpnv['handymn_service_description'] 		= htmlentities(get_field('handyman_prod_services_description', $hpnv['handymn_service_id']));
					}


					$hpnv['handymn_service_customer_to_supply'] = get_field('handyman_prod_services_customer_to_supply', $hpnv['handymn_service_id']);

					$hpnv['htmlentities'] = 'htmlentities';

					// echo '<pre>';
					// var_dump($hpnv);
					// exit;




					if( !session_id() ) {

							session_start();

							// session_destroy(); // DELETE THIS LINE // THIS LINE IS ONLY FOR TESTING

							$_SESSION['hnd_post_values'][] = $hpnv;

							$_SESSION['hnd_options'][] = array();
							$_SESSION['hnd_suboptions'][] = array();
							$_SESSION['all_service_setup'][] = array();

							$_SESSION['hnd_suboptions_values'][] = array();

							wp_redirect( home_url('/cart/') , 302 );
							exit();

					} else { // Added else: to make custom quote to work on /cart/ landing page.

						if ($_POST['handymn_service_id'] === 'custom') {

							$_SESSION['hnd_post_values'][] = $hpnv;

							$_SESSION['hnd_options'][] = array();
							$_SESSION['hnd_suboptions'][] = array();
							$_SESSION['all_service_setup'][] = array();

							$_SESSION['hnd_suboptions_values'][] = array();

							wp_redirect( home_url('/cart/') , 302 );
							exit();
							
						}

					}

		}

}