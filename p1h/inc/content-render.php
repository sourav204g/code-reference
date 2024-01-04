<?php
/**
 * Handyman  functions.
 *
 * @package handyman
 */


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Add Zipcode',
		'menu_title'	=> 'Add Zipcode',
		'menu_slug' 	=> 'zipcode-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Master Config',
		'menu_title'	=> 'Master Config',
		'menu_slug' 	=> 'master-config',
		'capability'	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-admin-tools',
		'redirect'		=> false
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Contact Settings',
		'menu_title'	=> 'Contact Settings',
		'menu_slug' 	=> 'contact-settings',
		'capability'	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-email',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Add City',
		'menu_title'	=> 'Add City',
		'parent_slug'	=> 'zipcode-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Add County',
		'menu_title'	=> 'Add County',
		'parent_slug'	=> 'zipcode-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Add State',
		'menu_title'	=> 'Add State',
		'parent_slug'	=> 'zipcode-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Add Country',
		'menu_title'	=> 'Add Country',
		'parent_slug'	=> 'zipcode-settings',
	));
	
}

// function custom_dashboard_help() { echo 'custom text'; }

if ( ! function_exists( 'handyman_pro_enqueue_scripts' ) ) {

	function handyman_pro_enqueue_scripts() {

		global $pagenow, $typenow, $post;
		// var_dump($pagenow);
		// exit;

			if($typenow === 'services' || $typenow === 'products' ) {

				wp_enqueue_style( 'handyman_admin_style', get_template_directory_uri() . '/assets/admin/css/pstyle.css' );
				wp_enqueue_script( 'handyman_admin_script', get_template_directory_uri() . '/assets/admin/js/pmain.js', array('jquery'), '20180517', true );
			}

			wp_enqueue_style( 'handyman_admin_style', get_template_directory_uri() . '/assets/admin/css/style.css' );

			wp_enqueue_style( 'fullcalendar_style', get_template_directory_uri() . '/assets/css/fullcalendar.min.css' );
			
			wp_enqueue_script( 'moment', get_template_directory_uri() . '/assets/js/moment.min.js', array('jquery'), '20180517', true );
			wp_enqueue_script( 'fullcalendar', get_template_directory_uri() . '/assets/js/fullcalendar.min.js', array('jquery'), '20180517', true );

			if( $pagenow !== 'nav-menus.php' && $post->ID != 99){
				wp_enqueue_script( 'handyman_admin_script', get_template_directory_uri() . '/assets/admin/js/main.js', array('jquery'), '20180517', true );
			}			
		
			// localizing script
			wp_localize_script( 'handyman_admin_script', 'handymanx', 
				array( 
				'root' => get_site_url() , 
				'ajaxurl' => admin_url( 'admin-ajax.php' ) ,
				'nonce' => wp_create_nonce('deadpool-2')
				) 
			);


	}

}

if ( ! function_exists( 'handyman_pro_remove_dashboard_widgets' ) ) {

	function handyman_pro_remove_dashboard_widgets() {
	    global $wp_meta_boxes;

	    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);

	    // wp_add_dashboard_widget('custom_help_widget', 'Custom Widget', 'custom_dashboard_help');
	 
	}

}

if ( ! function_exists( 'handyman_pro_handyman_custom_dashboard' ) ) {

	function handyman_pro_handyman_custom_dashboard() {
	
		// Bail if not viewing the main dashboard page
		if ( get_current_screen()->base !== 'dashboard' ) {
			return;
		} 

		global $wpdb;

		$bookingDetails = $wpdb->get_results( 'SELECT * FROM hxp_handyman_booking', 'ARRAY_A');

		$bookingData = array();

		foreach ( $bookingDetails as $keyo => $bookingDetail ) {

			if (unserialize(base64_decode($bookingDetail['selected_service']))) {
				
			foreach ( unserialize(base64_decode($bookingDetail['selected_service'])) as $keyi => $selected_service ) {

				$bookingData[$keyo]['service_name'][] = $selected_service['handymn_service_name'] . ' - ' . get_field('handyman_type_of_service', $selected_service['handymn_service_id']);

			} // ForEach: Selected Service

			$bookingData[$keyo]['total_time'][] = timeConvertRound($bookingDetail['total_labour_mins']);

			}  // IF: Selected Service


			if (unserialize(base64_decode($bookingDetail['selected_product']))) {		

			foreach ( unserialize(base64_decode($bookingDetail['selected_product'])) as $keyi => $selected_product ) {

				// print_r($selected_product);

				$asso_labour_mins 	= unserialize(base64_decode($bookingDetail['asso_labour_min']));

				$asso_labour_mins = array_values($asso_labour_mins);

				$bookingData[$keyo]['service_name'][] = get_the_title( $selected_product['handymn_product_id'] ) . ' - ' . get_the_title( $selected_product['handymn_asso_service_id'] ) . ' - ' . get_field('handyman_type_of_service', $selected_product['handymn_asso_service_id']);


				$product_quantity 			= (int) $selected_product['handymn_prod_quantity'];
				$asso_labour_min 			= (int) $asso_labour_mins[$keyi];

				$bookingData[$keyo]['total_time'][] = timeConvertRound( $asso_labour_min * $product_quantity);

				
			} // foreach: Selected Product

			} // IF: Selected Product


			$scheduled_date 				= strtotime( $bookingDetail['scheduled_date'] );
			$scheduled_arrival_time         = explode('-', $bookingDetail['scheduled_arrival_time']);

			$_start = str_replace( ' am', '', trim($scheduled_arrival_time[0]) );
			$_start = str_replace( ' pm', '', trim( $_start ) );

			$start_digit = explode(':', $_start)[0];


			$_end = str_replace( ' am', '', trim($scheduled_arrival_time[1]) );
			$_end = str_replace( ' pm', '', trim( $_end ) );

			$end_digit = explode(':', $_end)[0];

			$time_duration = ($end_digit - $start_digit);
			
			$bookingData[$keyo]['_start'] 	        = date('Y-m-d', $scheduled_date) . 'T' . $_start . ':00';
			// $bookingData[$keyo]['arrival_duration']	= $time_duration; // 12-JULY-2021
			$bookingData[$keyo]['arrival_duration']	= 0;
			$bookingData[$keyo]['booking_id']	 = $bookingDetail['booking_id'];
			$bookingData[$keyo]['handyman_name'] = get_field('pros_first_name', $bookingDetail['handyman_id']) . ' ' . get_field('pros_last_name', $bookingDetail['handyman_id']);
			// $bookingData[$keyo]['start'] 	= date('Y-m-d', $scheduled_date) . 'T' . $_start . ':00';


		} // foreach loop


		echo '<div id="dashboard__calendar_data" style="display:none;">' . json_encode($bookingData) . '</div>';


		$dashboard_all_handymen = new WP_Query(array(
			'post_type' => 'pros',
			'posts_per_page' => -1,
			'post_status' => 'publish'

		));

		?>

			<style> #dashboard-widgets-wrap { display: none; } </style>
			
			<div class="welcome-panel" id="handymanx_dashboard_calendar">
				
			</div>

			<select name="" id="handymanx_dashboard_select" style="float:right;">
					
					<option value="">Select Handyman</option>

					<?php foreach ($dashboard_all_handymen->get_posts() as $key => $dashboard_handyman): ?>
						<option value="<?php echo $dashboard_handyman->ID; ?>"><?php echo $dashboard_handyman->post_title; ?></option>
					<?php endforeach; ?>

			</select>

			<div class="clear" id="handymanx_dashboard_clear"></div>

			<?php if (is_admin()): ?>

				<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>

				<script src="<?php echo get_template_directory_uri() . '/assets/admin/js/calender-change.js'; ?>"></script>

				<script src="<?php echo get_template_directory_uri() . '/assets/admin/js/calender-load.js'; ?>"></script>
				
			<?php endif; ?>

			

	<?php }

}

if ( ! function_exists( 'handyman_pro_remove_menus' ) ) {

	function handyman_pro_remove_menus() {
		global $menu;

		// var_dump($menu);
		// exit();

		$restricted = array( /* __('Dashboard') , __('Posts'), */ __('Media'), __('Links'), /* __('Pages'), */ __('Appearance'), __('Tools'), __('Users'), __('Settings'),  __('Comments'), __('Plugins') , __('Contact')  );
		
		end($menu);

		while (prev($menu)) {

			$value = explode(' ', $menu[key($menu)][0]);
			if( in_array( $value[0] != NULL ? $value[0] : "" , $restricted ) ) unset( $menu[key($menu)] );
		}

		// var_dump($menu);
		// exit;

		// unset($menu['80.025']);  // custom-field
		unset($menu[31]); // contact-form7

	}

}

// define( 'ACF_LITE' , true );

if ( ! function_exists( 'handyman_pro_register_custom_menu_link' ) ) {
	function handyman_pro_register_custom_menu_link(){

		global $menu;

		// var_dump($menu);
		// exit;

		// $menu['25.11'][0] = 'Pro Reviews';

	    $menu[62][0] = 'Menu';
	    $menu[62][1] = 'manage_options';
	    $menu[62][2] = 'nav-menus.php';
	    $menu[62][3] = '';
	    $menu[62][4] = 'menu-top menu-icon-page';
	    $menu[62][5] = 'menu-menu';
	    $menu[62][6] = 'dashicons-menu';

	    return $menu;

	}
}

if ( ! function_exists( 'handyman_pro_remove_submenus' ) ) {

	function handyman_pro_remove_submenus() {
	  
	  global $submenu;

	  // var_dump($submenu);
	  // exit();

	  // unset($submenu['rich_reviews_settings_main'][0]);
	  // unset($submenu['rich_reviews_settings_main'][3]);
	  // unset($submenu['rich_reviews_settings_main'][4]);
	  // unset($submenu['rich_reviews_settings_main'][5]);

	  // unset($submenu['edit.php?post_type=product'][16]);
	  // unset($submenu['edit.php?post_type=product'][17]);
	  
	  unset($submenu['edit.php?post_type=pros'][5]);
	  unset($submenu['edit.php?post_type=pros'][10]);
	  unset($submenu['edit.php?post_type=pros'][15]);

	  // unset($submenu['edit.php?post_type=products'][15]);
	  // unset($submenu['edit.php?post_type=products'][16]);

	}

}


if ( ! function_exists( 'handyman_pro_lock_plugins' ) ) {

	function handyman_pro_lock_plugins( $actions, $plugin_file, $plugin_data, $context ) {

		// var_dump($actions['deactivate']);
		// exit();

		if ( array_key_exists( 'deactivate', $actions ) ) {
			unset( $actions['deactivate'] );
		}
			
		return $actions;
	}

}

 

if ( ! function_exists( 'handyman_pro_stop_reordering_categories' ) ) {

	function handyman_pro_stop_reordering_categories($args) {
	    $args['checked_ontop'] = false;
	    return $args;
	}

}


// Ajax Call on Ajax Call
if ( ! function_exists( 'handyman_pro_handyman_load_state__add_county' ) ) { 

	function handyman_pro_handyman_load_state__add_county() {

		check_admin_referer( 'deadpool-2', 'prosecure' );

		$choices = array();

		foreach (get_field('handyman_manage_state', 'option') as $key => $handyman_manage_state) {
			if ($handyman_manage_state['handyman_select_country'] === $_POST['country']) {

				$choices[] = $handyman_manage_state['handyman_add_state'];
				
			}
		}

		// add_filter('get_country_val', function() {
		// 	return $_POST['country'];
		// });


		if(!empty($choices)) {
			echo json_encode($choices);
		} else {
			echo '';
		}

		exit();

	}

}


// Ajax Call on Ajax Call
if ( ! function_exists( 'handyman_pro_handyman_load_county__add_city' ) ) { 

	function handyman_pro_handyman_load_county__add_city() {

		check_admin_referer( 'deadpool-2', 'prosecure' );

		$choices = array();

		foreach (get_field('handyman_manage_county', 'option') as $key => $handyman_manage_county) {
			if ($handyman_manage_county['handyman_select_country'] === $_POST['country'] && $handyman_manage_county['handyman_select_state'] === $_POST['state']) {

				$choices[] = $handyman_manage_county['handyman_add_county'];
				
			}
		}

		// add_filter('get_state_val', function() {
		// 	return $_POST['state'];
		// });


		if(!empty($choices)) {
			echo json_encode($choices);
		} else {
			echo '';
		}

		exit();

	}

}

// Ajax Call on Ajax Call
if ( ! function_exists( 'handyman_pro_handyman_load_city__add_zipcode' ) ) { 

	function handyman_pro_handyman_load_city__add_zipcode() {

		check_admin_referer( 'deadpool-2', 'prosecure' );

		$choices = array();

		foreach (get_field('handyman_manage_city', 'option') as $key => $handyman_manage_city) {

			if ( $handyman_manage_city['handyman_select_country'] === $_POST['country'] && $handyman_manage_city['handyman_select_state__city'] === $_POST['state'] && $handyman_manage_city['handyman_select_county__city'] === $_POST['county'] ) {

				$choices[] = $handyman_manage_city['handyman_add_city__city'];
				
			}
		}

		// add_filter('get_state_val', function() {
		// 	return $_POST['state'];
		// });


		if(!empty($choices)) {
			echo json_encode($choices);
		} else {
			echo '';
		}

		exit();

	}

}


// Change status upon status change or delete or restore
if ( ! function_exists( 'handyman_pro_pros_status' ) ) { 

	function handyman_pro_pros_status( $new_status, $old_status, $post ) {

		global $wpdb;

		if($post->post_type === 'pros') {

			if( $new_status === 'publish' ) {

		    	// Update Status
				$wpdb->query( $wpdb->prepare(
				    "UPDATE hxp_pros set status = '%s' WHERE proid = '%d'",
				    array(
				        'publish',
				        $post->ID
				    )
				));

			} else { // pending, draft, trash etc.

				// Update Status
				$wpdb->query( $wpdb->prepare(
				    "UPDATE hxp_pros set status = '%s' WHERE proid = '%d'",
				    array(
				        'pending',
				        $post->ID
				    )
				));

			} // if($old_status === 'pending' && $new_status === 'publish')

		} // $post->post_type

	}

}


// Delete pro account when permanently removed.
if ( ! function_exists( 'handyman_pro_pros_delete' ) ) {

		function handyman_pro_pros_delete( $post_id ) {

			global $wpdb;

			$post_type = get_post_type( $post_id );

			if( $post_type == 'pros') {

				// Delete Pro
				$wpdb->query( $wpdb->prepare( "DELETE FROM hxp_pros
		                WHERE proid = %d", $post_id ) );

			}

		}

}



/*

// Upon Pro status change - publish
if ( ! function_exists( 'handyman_pro_status_change_publish' ) ) { 
	function handyman_pro_status_change_publish( $post ) {
	    if ( 'pros' === $post->post_type ) {

	    	global $wpdb;

	    	// Insert form datas into Pros table
			$wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_pros set status = '%s' WHERE proid = '%d'",
			    array(
			        'publish',
			        $post->ID
			    )
			));

	        
	    }
	}
}

// Upon Pro status change - pending
if ( ! function_exists( 'handyman_pro_status_change_pending' ) ) { 
	function handyman_pro_status_change_pending( $post ) {
	    if ( 'pros' === $post->post_type ) {

	    	global $wpdb;

	    	// Insert form datas into Pros table
			$wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_pros set status = '%s' WHERE proid = '%d'",
			    array(
			        'pending',
			        $post->ID
			    )
			));

	        
	    }
	}
}

// Upon Pro status change - draft
if ( ! function_exists( 'handyman_pro_status_change_draft' ) ) { 
	function handyman_pro_status_change_draft( $post ) {
	    if ( 'pros' === $post->post_type ) {

	    	global $wpdb;

	    	// Insert form datas into Pros table
			$wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_pros set status = '%s' WHERE proid = '%d'",
			    array(
			        'pending',
			        $post->ID
			    )
			));

	        
	    }
	}
}

*/

// https://developer.yoast.com/features/seo-tags/descriptions/api/
function prefix_filter_description_example( $description ) {
  
  if ( is_singular('services') ) {

  	global $post, $fetch_hour_price, $per_min_cost;

  	$HasBasePrice = false;
  	$HasAddOns = false;

  	if (get_field('handyman_est_time', $post->ID) == 0) {

  		if (get_field('handyman_add_on_services', $post->ID)) {

  			$HasAddOns = true;
  		 	
  		 	$LabourMinz = array();

  		 	foreach (get_field('handyman_add_on_services', $post->ID)[0]['handyman_addon_options'] as $key => $handyman_add_on_services ) {

  		 	  if ( (int) $handyman_add_on_services['labour_minutes'] !== 0 ) {
  		 	        $LabourMinz[] = (int) $handyman_add_on_services['labour_minutes'];
  		 	  }

  		 	}

  		 	sort($LabourMinz);

  		 	$optFirstLabourMin = $LabourMinz[0];

  		 	$servicePrice = $per_min_cost * (int) $optFirstLabourMin;
  		}

  	} else {
  		$HasBasePrice = true;
  		$servicePrice = $per_min_cost * get_field('handyman_est_time', $post->ID);
  	}

  	if (get_field('handyman_product_premium', $post->ID)) {
  	  
  	  $handyman_premium = ($servicePrice * get_field('handyman_product_premium', $post->ID))/100;

  	} else {
  	  
  	  $handyman_premium = 0;
  	}

  	$servicePrice = $servicePrice + $handyman_premium;

  	// If discount is set
  	if(get_field('handyman_product_discount', $post->ID)) {

  	  $discount = get_field('handyman_product_discount', $post->ID);

  	  $afterDiscount = ( $servicePrice * $discount ) / 100;

  	} else {

  	  $afterDiscount = 0;
  	}

  	$servicePrice = $servicePrice - $afterDiscount;


  	var_dump($HasBasePrice, $HasAddOns);

  	if ($HasBasePrice) {
  		$description = 'Price: ' . round($servicePrice, 2) . ' USD | ' . $description;
  	}

  	if (!$HasBasePrice && $HasAddOns) {
  		$description = 'Price: ' . round($servicePrice, 2) . ' USD and UP | ' . $description;
  	}

  	if (!$HasBasePrice && !$HasAddOns) {
  		$description = 'Custom Pricing | ' . $description;
  	}

  }

  return $description;
}

add_filter( 'wpseo_metadesc', 'prefix_filter_description_example' );