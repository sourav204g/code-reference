<?php session_start();

if( !isset( $_SESSION['prologin']) && !isset( $_SESSION['proid']) && $_SESSION['prologin'] !== true ) { // Bail
	wp_redirect( home_url('/pro-login/') , 302 );
	exit();
}

if( isset($_GET['logout']) && $_GET['logout'] === 'true' ) { // Logout
	// session_destroy();

	unset($_SESSION['prologin']);
	unset($_SESSION['proid']);
	unset($_SESSION['posttype_pro_id']);

	wp_redirect( home_url('/pro-login/') , 302 );
	exit();
}


/* Change Passowrd */
function pro_change_password_form() {

		if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'avengers_infinity_war' ) ) {

				die( 'Failed security check' );

		} else {

			global $wpdb;

			$edit_pro_old_password 						=  sanitize_text_field($_POST['edit_pro_old_password']);
			$edit_pro_new_password  					=  sanitize_text_field($_POST['edit_pro_new_password']);
			$edit_pro_confirm_password					=  sanitize_text_field($_POST['edit_pro_confirm_password']);

			if( $edit_pro_old_password !== '' || $edit_pro_new_password !== '' || $edit_pro_confirm_password !== '') {

				$old_password = get_field('pro_password', $_SESSION['posttype_pro_id']);

				if( $edit_pro_new_password === $edit_pro_confirm_password ) {

					if( $old_password === $edit_pro_old_password ) {

						$wpdb->query( $wpdb->prepare(
							    "UPDATE hxp_pros SET password = %s WHERE proid =" . $_SESSION['posttype_pro_id'],
								    array(
								        $edit_pro_confirm_password
								    )
						) );

						update_field( 'pro_password', $edit_pro_confirm_password , $_SESSION['posttype_pro_id']);

					} else {

						return $pswchangeError = 3; // Old password is incorrect.


					} // $old_password === $edit_pro_confirm_password

				} else { // $edit_pro_new_password === $edit_pro_confirm_password

					  	return $pswchangeError = 2; // Password mismatch.

				}
				

			} else { 

				return $pswchangeError = 1; // One or All field are empty.

			}


		}

		return false;

}

if( $_POST && isset($_POST['edit_profile_pro_chng_pass_form']) ) {
	global $changeStatus;
	$changeStatus =	pro_change_password_form();
}


/* Manage Skills */
function manage_pro_skills() {

		if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'avengers_infinity_war' ) ) {

				die( 'Failed security check' );

		} else {

			if(isset($_POST['pro_skills'])) {

				$pro_skills  				=  array_map("strip_tags", $_POST['pro_skills']);
				$pro_skills  				=  array_map("intval", $pro_skills);

				foreach ($pro_skills as $key => $pro_skill) {
					if(get_term_by('id', $pro_skill, 'service_categories')->parent !== 0) {
						$pro_skills[] = get_term_by('id', $pro_skill, 'service_categories')->parent; // Also add parent ids. 
					}
				}

				$pro_skills = array_unique($pro_skills); // remove dumplicate entry.

			} else {
				$pro_skills = false;
			}

			if($pro_skills) {
				// update skills
				wp_set_object_terms( $_SESSION['posttype_pro_id'], $pro_skills, 'service_categories' );
			}

		}

}

if( $_POST && isset($_POST['edit_profile_manage_skills']) ) {
		manage_pro_skills();
}


/* Manage Schedules */
function manage_schedule_pro_form() {

		if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'avengers_infinity_war' ) ) {

				die( 'Failed security check' );

		} else {

			if( isset($_POST['edit_pro_saturday']) ) {
				update_field( 'pro_show_saturday_as_available', true , $_SESSION['posttype_pro_id']);
			} else {
				update_field( 'pro_show_saturday_as_available', false , $_SESSION['posttype_pro_id']);
			}

			if( isset($_POST['edit_pro_sunday']) ) {
				update_field( 'pro_show_sunday_as_available', true , $_SESSION['posttype_pro_id']);
			} else {
				update_field( 'pro_show_sunday_as_available', false , $_SESSION['posttype_pro_id']);
			}

			if( isset($_POST['edit_pro_evening']) ) {
				update_field( 'pro_show_evening_as_available', true , $_SESSION['posttype_pro_id']);
			} else {
				update_field( 'pro_show_evening_as_available', false , $_SESSION['posttype_pro_id']);
			}

			// Off-Dates
			$edit_pro_off_dates 					=  sanitize_text_field($_POST['edit_pro_off_dates']);
			$edit_pro_off_dates_array 				= explode(',', $edit_pro_off_dates);

			foreach ($edit_pro_off_dates_array as $key => $edit_pro_off_date) {

				// var_dump($edit_pro_off_date);
				// var_dump(get_field('pro_schedule_off_dates', $_SESSION['posttype_pro_id']));

				$acfDate = DateTime::createFromFormat('m/d/Y', $edit_pro_off_date);
				$acfDate = $acfDate->format('Ymd');

				$pro_schedule_off_dates[]['pro_schedule_off_date'] = $acfDate;
			
			}
		
			update_field( 'pro_schedule_off_dates', $pro_schedule_off_dates , $_SESSION['posttype_pro_id']);



		}

}

if( $_POST && isset($_POST['edit_profile_manage_schedule']) ) {
		manage_schedule_pro_form();
}


/* Manage Zipcodes */
function in_array_r($needle, $haystack, $strict = false) {

    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

function manage_zipcodes_pro_form() {

		if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'avengers_infinity_war' ) ) {

				die( 'Failed security check' );

		} else {

				if(isset($_POST['prozip'])) {

					$zipcodeArr = array();

					if(get_field('pro_working_zipcodes', $_SESSION['posttype_pro_id'])) {

						$zipcodeArr = get_field('pro_working_zipcodes', $_SESSION['posttype_pro_id']);

					}

					foreach ( $_POST['prozip'] as $key => $prozip ) {

						if( !in_array_r( $prozip , $zipcodeArr) ) {

							$zipcodeArr[]['pro_zipcode'] = sanitize_text_field($prozip);

							update_field( 'pro_working_zipcodes', $zipcodeArr , $_SESSION['posttype_pro_id']);
							wp_redirect( get_site_url() . '/manage-zipcodes/?status=success' );

						} else {
							global $zipcodeError;
							$zipcodeError = 'Warning: Zipcode already added.';
						}
					
					}

					

				}

		}

}


if( $_POST && isset($_POST['manage_zipcodes_pro_form']) ) {
		manage_zipcodes_pro_form();
}

/* Edit Profile */
function edit_profile_pro_form() {

		if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'avengers_infinity_war' ) ) {

				die( 'Failed security check' );

		} else {


				$edit_profile['pro_first_name'] 	=  sanitize_text_field($_POST['edit_pro_first_name']);
				$edit_profile['pro_last_name']		=  sanitize_text_field($_POST['edit_pro_last_name']);

				$edit_profile['pro_street']			=  sanitize_text_field($_POST['edit_pro_street']);
				$edit_profile['pro_city']			=  sanitize_text_field($_POST['edit_pro_city']);
				$edit_profile['pro_county']			=  sanitize_text_field($_POST['edit_pro_county']);
				$edit_profile['pro_state']			=  sanitize_text_field($_POST['edit_pro_state']);
				$edit_profile['pro_zipcode']  		=  sanitize_text_field($_POST['edit_pro_zip_code']);

				$edit_profile['pro_home_phone']  	=  sanitize_text_field($_POST['edit_pro_home_phone']);
				$edit_profile['pro_cell_phone'] 	=  sanitize_text_field($_POST['edit_pro_cell_phone']);

				$edit_profile['pro_certified']  	=  sanitize_text_field($_POST['edit_pro_cirtified']);
				$edit_profile['pro_insured']  		=  sanitize_text_field($_POST['edit_pro_insured']);

				$edit_profile['edit_pro_bio'] 		= sanitize_textarea_field($_POST['edit_pro_bio']);

				$edit_profile['edit_pro_years_of_experience'] 		= sanitize_textarea_field($_POST['edit_pro_years_of_experience']);

				foreach ($edit_profile as $key => $profile_item) {
					
					if($profile_item === '') {

						global $hnx_error;

						$hnx_error = 'All fields are required *';

					}
					
				} // foreach


				if (!isset($hnx_error)) {

						update_field( 'pros_first_name', $edit_profile['pro_first_name'] , $_SESSION['posttype_pro_id']);
						update_field( 'pros_last_name',  $edit_profile['pro_last_name'] ,  $_SESSION['posttype_pro_id']);

						update_field( 'pro_home_phone',  $edit_profile['pro_home_phone'] , $_SESSION['posttype_pro_id']);
						update_field( 'pro_cell_phone',  $edit_profile['pro_cell_phone'] , $_SESSION['posttype_pro_id']);

						update_field( 'pro_years_of_experience',  $edit_profile['edit_pro_years_of_experience'] , $_SESSION['posttype_pro_id']);

						// certified, insured
						update_field( 'pro_is_certified', $edit_profile['pro_certified'] , $_SESSION['posttype_pro_id']);
						update_field( 'pro_has_insurance', $edit_profile['pro_insured'] , $_SESSION['posttype_pro_id']);


						$proAddress = array (
							  'pro_state' => $edit_profile['pro_state'],
							  'pro_county' => $edit_profile['pro_county'],
							  'pro_street' => $edit_profile['pro_street'],
							  'pro_city' => $edit_profile['pro_city'],
							  'pro_zipcode' => $edit_profile['pro_zipcode']
						);

						update_field( 'pro_address_group', $proAddress , $_SESSION['posttype_pro_id']);


						update_field( 'pro_bio_about', $edit_profile['edit_pro_bio'] , $_SESSION['posttype_pro_id']);

						wp_redirect( get_site_url() . '/edit-profile/?status=success' );

				} // !isset($hnx_error)


		}


} // edit_profile_pro_form()


if( $_POST && isset($_POST['edit_profile_pro_form']) ) {
		edit_profile_pro_form();
}