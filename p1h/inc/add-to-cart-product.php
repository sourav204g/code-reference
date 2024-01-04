<?php 

if( $_POST && isset($_POST['handymn_sl_addon_services']) ) {

		handyman_add_to_cart_prod();
}

function handyman_add_to_cart_prod() {

		if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'waiting_for_avengers_4_trailer' ) ) {

				die( 'Failed security check' );

		} else {


					$pid1 = (int)  $_POST['handymn_product_id'];

					if ($_POST['handymn_alternate_option_show_hide'] == '1' && $_POST['handymn_alternate_option_id']) {
						$pid1 = (int)  $_POST['handymn_alternate_option_id'];
					}


					// var_dump($pid);
					// exit;
					
					// REF - https://stackoverflow.com/questions/15986235/how-to-use-json-stringify-and-json-decode-properly
				
					if (get_field('handyman_add_on_services', $pid1)) :

							// echo '<pre>';
							// var_dump($_POST);
							// exit;

							$jsonOptStr = $_POST["handymn_service_opt"];
							$tempOptData = str_replace("\\", "", $jsonOptStr);
							$cleanOptDatazx = json_decode($tempOptData);

							$jsonSubStr = $_POST['handymn_service_sub'];
							$tempSubData = str_replace("\\", "", $jsonSubStr);
							$cleanSubDatazx = json_decode($tempSubData);

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

							// var_dump($cleanSubDatazx_val);


							if ( $cleanOptDatazx == null || $cleanSubDatazx == null || $clean_all_addon_Datazx == null || $cleanSubDatazx_val == null ) {
								die( 'Something Went Wrong! Please Try again.' );
							}

					endif;

					if( !session_id() ) {

							session_start();

							// session_destroy(); // DELETE THIS LINE // THIS LINE IS ONLY FOR TESTING

							$_SESSION['hnd_product_post_values'][] = (array) $_POST;

							if (get_field('handyman_add_on_services', $pid1)) :

								$_SESSION['hnd_product_options'][] = (array) $cleanOptDatazx;
								$_SESSION['hnd_product_suboptions'][] = (array) $cleanSubDatazx;
								$_SESSION['all_product_setup'][] = (array) $clean_all_addon_Datazx;

								$_SESSION['hnd_product_suboptions_values'][] = (array) $cleanSubDatazx_val;

						    endif;

							wp_redirect( home_url('/cart/') , 302 );
							exit();

					}

				
		}

}