<?php

	function isPasswordEnteredCorrect($pro_password, $pro_confirm_password) {
		return $pro_password === $pro_confirm_password ? true : false;
	}

	function isUsernameUnique($pro_username) {
		
		global $wpdb;

		$checkUsername = $wpdb->get_results( $wpdb->prepare( "SELECT username FROM hxp_pros WHERE username = %s", array( $pro_username ) ), 'ARRAY_A');

		return empty($checkUsername) ? true : false;

	}

	function isEmailUnique($pro_email) {
		
		global $wpdb;

		$checkEmail = $wpdb->get_results( $wpdb->prepare( "SELECT email FROM hxp_pros WHERE email = %s", array( $pro_email ) ), 'ARRAY_A');

		return empty($checkEmail) ? true : false;

	}

	function process_form_data() {

		global $wpdb;

		if ( !isset( $_POST['handyman_pro_nonce'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'avengers_infinity_war' ) ) {

			   die( 'Failed security check' );

		} else { // process data

			// var_dump($_POST);
			// exit();

			$pro_username 					=  sanitize_text_field($_POST['pro_username']);
			$pro_email  					=  sanitize_email($_POST['pro_email']);
			$pro_password					=  sanitize_text_field($_POST['pro_password']);
			$pro_confirm_password			=  sanitize_text_field($_POST['pro_confirm_password']);


			if($pro_username === '') {
				die('Error: Username is a required field.');
			}

			if($pro_email === '') {
				die('Error: Email is a required field.');
			}

			if($pro_password === '' || $pro_confirm_password === '') {
				die('Error: Password is a required field.');
			}

			// Validate Username
			if( !isUsernameUnique($pro_username) ) {
				die('Error: Username exists.');
			}

			// Validate Email
			if( !isEmailUnique($pro_email)) {
				die('Error: Email exists.');
			}

			if( isPasswordEnteredCorrect($pro_password, $pro_confirm_password) ) {

				

				$pro_first_name 				=  sanitize_text_field($_POST['pro_first_name']);
				$pro_last_name  				=  sanitize_text_field($_POST['pro_last_name']);

				$pro_street						=  sanitize_text_field($_POST['pro_street']);
				$pro_city						=  sanitize_text_field($_POST['pro_city']);
				$pro_county						=  sanitize_text_field($_POST['pro_county']);
				$pro_state						=  sanitize_text_field($_POST['pro_state']);
				$pro_country					=  sanitize_text_field($_POST['pro_country']);
				$pro_zipcode  					=  sanitize_text_field($_POST['pro_zipcode']);
				$pro_home_phone  				=  sanitize_text_field($_POST['pro_home_phone']);
				$pro_cell_phone  				=  sanitize_text_field($_POST['pro_cell_phone']);


				$pro_legally_eligible  			=  sanitize_text_field($_POST['pro_legally_eligible']);
				$pro_convicted_crime  			=  sanitize_text_field($_POST['pro_convicted_crime']);
				$pro_year_of_experience  		=  sanitize_text_field($_POST['pro_year_of_experience']);
				$pro_skill_rating_carpentry  	=  sanitize_text_field($_POST['pro_skill_rating_carpentry']);
				$pro_skill_rating_painting  	=  sanitize_text_field($_POST['pro_skill_rating_painting']);
				$pro_skill_rating_tiling  		=  sanitize_text_field($_POST['pro_skill_rating_tiling']);
				$pro_skill_rating_plumbing  	=  sanitize_text_field($_POST['pro_skill_rating_plumbing']);
				$pro_skill_rating_electrical  	=  sanitize_text_field($_POST['pro_skill_rating_electrical']);

				$pro_certified  				=  sanitize_text_field($_POST['pro_certified']);
				$pro_insured  					=  sanitize_text_field($_POST['pro_insured']);

				$pro_evenning  					= sanitize_text_field($_POST['pro_evenning']) === 'true' ? true : false;
				$pro_saturday  					= sanitize_text_field($_POST['pro_saturday']) === 'true' ? true : false;
				$pro_sunday  					= sanitize_text_field($_POST['pro_sunday']) === 'true' ? true : false;

				// var_dump($pro_certified);
				// var_dump($pro_insured);
				// var_dump($pro_evenning);
				// var_dump($pro_saturday);
				// var_dump($pro_sunday);
				// exit();

				if(isset($_POST['pro_high_school'])) {
					$pro_high_school 				=  sanitize_text_field($_POST['pro_high_school']);
				}

				if(isset($_POST['pro_college'])) {
					$pro_college 				=  sanitize_text_field($_POST['pro_college']);
				}

				if(isset($_POST['pro_training'])) {
					$pro_college 				=  sanitize_text_field($_POST['pro_training']);
				}
			
				$pro_high_school_year  			=  sanitize_text_field($_POST['pro_high_school_year']);
				$pro_college_year  				=  sanitize_text_field($_POST['pro_college_year']);
				$pro_training_year  			=  sanitize_text_field($_POST['pro_training_year']);

				$pro_employer1  				=  sanitize_text_field($_POST['pro_employer1']);
				$pro_position1 					=  sanitize_text_field($_POST['pro_position1']);
				$pro_how_long1  				=  sanitize_text_field($_POST['pro_how_long1']);
				$pro_date_left1  				=  sanitize_text_field($_POST['pro_date_left1']);
				$pro_reason_left1  				=  sanitize_text_field($_POST['pro_reason_left1']);

				$pro_employer2  				=  sanitize_text_field($_POST['pro_employer2']);
				$pro_position2 					=  sanitize_text_field($_POST['pro_position2']);
				$pro_how_long2  				=  sanitize_text_field($_POST['pro_how_long2']);
				$pro_date_left2  				=  sanitize_text_field($_POST['pro_date_left2']);
				$pro_reason_left2  				=  sanitize_text_field($_POST['pro_reason_left2']);

				$pro_employer3  				=  sanitize_text_field($_POST['pro_employer3']);
				$pro_position3 					=  sanitize_text_field($_POST['pro_position3']);
				$pro_how_long3  				=  sanitize_text_field($_POST['pro_how_long3']);
				$pro_date_left3  				=  sanitize_text_field($_POST['pro_date_left3']);
				$pro_reason_left3  				=  sanitize_text_field($_POST['pro_reason_left3']);

				$pro_employer4  				=  sanitize_text_field($_POST['pro_employer4']);
				$pro_position4 					=  sanitize_text_field($_POST['pro_position4']);
				$pro_how_long4  				=  sanitize_text_field($_POST['pro_how_long4']);
				$pro_date_left4  				=  sanitize_text_field($_POST['pro_date_left4']);
				$pro_reason_left4  				=  sanitize_text_field($_POST['pro_reason_left4']);

				$pro_year  						=  sanitize_text_field($_POST['pro_year']);
				$pro_make  						=  sanitize_text_field($_POST['pro_make']);
				$pro_model  					=  sanitize_text_field($_POST['pro_model']);
				$pro_comments_questions  		=  sanitize_text_field($_POST['pro_comments_questions']);


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


				if(isset($_POST['pro_tools'])) {

					$pro_tools  				=  array_map("strip_tags", $_POST['pro_tools']);
					$pro_tools  				=  array_map("strval", $pro_tools);

					$pro_tools_arr = array();

					foreach ($pro_tools as $key => $pro_tool) {
						$pro_tools_arr[]['pro_tool'] =  $pro_tool;						
					}

				} else {
					$pro_tools_arr = false;
				}
 		

				$newpro = wp_insert_post( array (
				    'post_type' => 'pros',
				    'post_title' => $pro_first_name . ' ' . $pro_last_name,
				    'post_content' => '',
				    'post_status' => 'pending',
				    'comment_status' => 'closed',
				    'ping_status' => 'closed',
				));


				if($newpro) {
					
						update_field( 'pros_first_name', $pro_first_name , $newpro);
						update_field( 'pros_last_name',  $pro_last_name ,  $newpro);
						update_field( 'pro_email',       $pro_email ,      $newpro);
						update_field( 'pro_home_phone',  $pro_home_phone , $newpro);
						update_field( 'pro_cell_phone',  $pro_cell_phone , $newpro);

						$proAddress = array (
							  'pro_state' => $pro_state,
							  'pro_county' => $pro_county,
							  'pro_street' => $pro_street,
							  'pro_city' => $pro_city,
							  'pro_zipcode' => $pro_zipcode
						);

						update_field( 'pro_address_group', $proAddress , $newpro);

						// Insert form datas into Pros table
						$errorCode = $wpdb->query( $wpdb->prepare(
						    "INSERT ignore INTO hxp_pros (username, email, password, proid, status) VALUES ( %s, %s, %s, %d, %s )",
						    array(
						        $pro_username,
						        $pro_email,
						        $pro_confirm_password,
						        $newpro,
						        'pending'
						    )
						) );

						if( !$errorCode ) {
							echo 'Error: Duplicate Entry.';
							die();
						}
						
						// updating custom fields
						update_field( 'pro_username', $pro_username , $newpro);
						update_field( 'pro_password', $pro_password , $newpro);


						// certified, insured
						update_field( 'pro_is_certified', $pro_certified , $newpro);
						update_field( 'pro_has_insurance', $pro_insured , $newpro);

						if($pro_saturday) {

						}

						update_field( 'pro_show_saturday_as_available', $pro_saturday , $newpro);
						update_field( 'pro_show_sunday_as_available', $pro_sunday , $newpro);
						update_field( 'pro_show_evening_as_available', $pro_evenning , $newpro);


						if($pro_skills) {
							// update skills
							wp_set_object_terms( $newpro, $pro_skills, 'service_categories' );
						}

						if($pro_tools_arr) {
							// update tools
							update_field( 'pro_tools_inventory', $pro_tools_arr , $newpro);
						}


						 // Sending email to user
  						 wp_mail( $pro_email, 'Welcome!', 'Your Email: ' . $pro_email . ', Your Password: ' . $pro_confirm_password );

  						 wp_redirect( get_site_url() . '/thank-you/' );
  						 die();


				} // $newpro

			} else {

				echo "<script> alert('Password Mismatch'); /* windlow.location.href = window.location; */ </script>";
				die('Password Mismatch. Go back and Try Again.');

			} // isPasswordEnteredCorrect()


		   
		} // else ends

	} // process_form_data()


	if( $_POST && isset($_POST['pro_submit']) ) {
		process_form_data();
	}