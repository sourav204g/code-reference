<?php

add_action( 'init', 'traveltographer_photographers_post_type'  );

if ( ! function_exists( 'traveltographer_photographers_post_type' ) ) {

		function traveltographer_photographers_post_type() {
			
				$labels = array(
					"name" => __( 'Photographers', 'traveltographer' ),
					"singular_name" => __( 'Photographer', 'traveltographer' ),
					'add_new'				=> __( 'Add New' , 'traveltographer' ),
				    'add_new_item'			=> __( 'Add New Photographer' , 'traveltographer' ),
				    'edit_item'				=> __( 'Edit Photographer' , 'traveltographer' ),
				    'new_item'				=> __( 'New Photographer' , 'traveltographer' ),
				    'view_item'				=> __( 'View Photographer', 'traveltographer' ),
				    'search_items'			=> __( 'Search Photographers', 'traveltographer' ),
				    'not_found'				=> __( 'No Photographers found', 'traveltographer' ),
				    'not_found_in_trash'	=> __( 'No Photographers found in Trash', 'traveltographer' ), 
				);

				$args = array(

					"label" => __( 'Photographers', 'traveltographer' ),
					"labels" => $labels,
					"description" => "",
					"public" => true,
					"publicly_queryable" => true,
					"show_ui" => true,
					"show_in_rest" => false,
					"rest_base" => "",
					"has_archive" => false,
					"show_in_menu" => true,
					"exclude_from_search" => false,
					"capability_type" => "post",
					'capabilities' => array(
					    // 'create_posts' => 'do_not_allow', 
					),
					"map_meta_cap" => true,
					"hierarchical" => false,
					"rewrite" => array( "slug" => "photographers", "with_front" => true ),
					"query_var" => true,
					"menu_icon" => 'dashicons-camera', 
					"supports" => array( "title", "editor", "thumbnail", "comments" ),

					// array( 'comments', 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' )

					);

				register_post_type( "photographers", $args );

		}

}

add_action( 'init', 'traveltographer_categories' );

if ( ! function_exists( 'traveltographer_categories' ) ) {

	function traveltographer_categories() {

		$labels = array(

				    'name'                          => 'Photography Categories',
				    'singular_name'                 => 'Photography Category',
				    'search_items'                  => 'Search Categories',
				    'popular_items'                 => 'Popular Categories',
				    'all_items'                     => 'All Categories',
				    'parent_item'                   => 'Parent Category',
				    'edit_item'                     => 'Edit Category',
				    'update_item'                   => 'Update Category',
				    'add_new_item'                  => 'Add New Category',
				    'new_item_name'                 => 'New Category',
				    'separate_items_with_commas'    => 'Separate Categories with commas',
				    'add_or_remove_items'           => 'Add or remove Categories',
				    'choose_from_most_used'         => 'Choose from most used Categories'
				);

		$args = array(
				    'label'                         => 'Categories',
				    'labels'                        => $labels,
				    'public'                        => true,
				    'hierarchical'                  => true,
				    'show_ui'                       => true,
				    'show_in_nav_menus'             => true,
				    'args'                          => array( 'orderby' => 'term_order' ),
				    'rewrite'                       => array( 'slug' => 'photography_types', 'with_front' => true, 'hierarchical' => true ),
				    'query_var'                     => true
				);

		register_taxonomy( 'photography_types', array('photographers'), $args );
	}
}

add_action( 'init', 'traveltographer_locations' );

if ( ! function_exists( 'traveltographer_locations' ) ) {

	function traveltographer_locations() {

		$labels = array(

				    'name'                          => 'Locations',
				    'singular_name'                 => 'Location',
				    'search_items'                  => 'Search Locations',
				    'popular_items'                 => 'Popular Locations',
				    'all_items'                     => 'All Locations',
				    'parent_item'                   => 'Parent Location',
				    'edit_item'                     => 'Edit Location',
				    'update_item'                   => 'Update Location',
				    'add_new_item'                  => 'Add New Location',
				    'new_item_name'                 => 'New Location',
				    'separate_items_with_commas'    => 'Separate Locations with commas',
				    'add_or_remove_items'           => 'Add or remove Locations',
				    'choose_from_most_used'         => 'Choose from most used Locations'
				);

		$args = array(
				    'label'                         => 'Locations',
				    'labels'                        => $labels,
				    'public'                        => true,
				    'hierarchical'                  => true,
				    'show_ui'                       => true,
				    'show_in_nav_menus'             => true,
				    'args'                          => array( 'orderby' => 'term_order' ),
				    'rewrite'                       => array( 'slug' => 'locations', 'with_front' => true, 'hierarchical' => true ),
				    'query_var'                     => true,
				);

		register_taxonomy( 'locations', array('photographers'), $args );




	}
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Promotion Bar',
		'menu_title'	=> 'Promotion Bar',
		'menu_slug' 	=> 'promotion-bar-settings',
		'capability'	=> 'update_core',
		'redirect'		=> false
	));
	
}

// function take_away_publish_permissions() {
//         $user = get_role('author');
//         $user->add_cap('publish_posts',false);
// }
   
// add_action('init', 'take_away_publish_permissions' );

function postPending($post_ID) {

     if(!current_user_can('administrator') && get_role('author')) {
        //Unhook this function
        remove_action('post_updated', 'postPending', 10, 3);

        return wp_update_post(array('ID' => $post_ID, 'post_status' => 'pending'));

        // re-hook this function
        add_action( 'post_updated', 'postPending', 10, 3 );
     }

 }

add_action('post_updated', 'postPending', 10, 3);

add_action( 'init', 'traveltographer_testimonial_post_type'  );

if ( ! function_exists( 'traveltographer_testimonial_post_type' ) ) {

		function traveltographer_testimonial_post_type() {
			
				$labels = array(
					"name" => __( 'Testimonials', 'traveltographer' ),
					"singular_name" => __( 'Testimonial', 'traveltographer' ),
					'add_new'				=> __( 'Add New' , 'traveltographer' ),
				    'add_new_item'			=> __( 'Add New Testimonial' , 'traveltographer' ),
				    'edit_item'				=> __( 'Edit Testimonial' , 'traveltographer' ),
				    'new_item'				=> __( 'New Testimonial' , 'traveltographer' ),
				    'view_item'				=> __( 'View Testimonial', 'traveltographer' ),
				    'search_items'			=> __( 'Search Testimonials', 'traveltographer' ),
				    'not_found'				=> __( 'No Testimonials found', 'traveltographer' ),
				    'not_found_in_trash'	=> __( 'No Testimonials found in Trash', 'traveltographer' ), 
				);

				$args = array(

					"label" => __( 'Testimonials', 'traveltographer' ),
					"labels" => $labels,
					"description" => "",
					"public" => true,
					"publicly_queryable" => true,
					"show_ui" => true,
					"show_in_rest" => false,
					"rest_base" => "",
					"has_archive" => false,
					"show_in_menu" => true,
					"exclude_from_search" => false,
					"capability_type" => "post",
					'capabilities' => array(
					    'edit_post'          => 'update_core',
					    'read_post'          => 'update_core',
					    'delete_post'        => 'update_core',
					    'edit_posts'         => 'update_core',
					    'edit_others_posts'  => 'update_core',
					    'delete_posts'       => 'update_core',
					    'publish_posts'      => 'update_core',
					    'read_private_posts' => 'update_core'
					),
					"map_meta_cap" => true,
					"hierarchical" => false,
					"rewrite" => array( "slug" => "testimonials", "with_front" => true ),
					"query_var" => true,
					"menu_icon" => 'dashicons-format-quote', 
					"supports" => array( "title", "editor", "thumbnail" ),

					);

				register_post_type( "testimonials", $args );

		}

}

// Ref - https://www.wpbeginner.com/wp-tutorials/how-to-add-admin-notices-in-wordpress/
function travelt_admin_notice_warning() {

	global $post_type, $pagenow, $post;

	if(!current_user_can('administrator') && get_role('author')) {
		echo '<style> .subsubsub, .page-title-action { display: none !important; } </style>';
	}

	echo '<style> [data-name="traveltographer_email_verification_status"], [data-name="traveltographer_account_status"] { display: none; } </style>';

	if ( $post_type === 'photographers' && $pagenow === 'post.php' && !get_field('traveltographer_email_verification_status', $post->ID) ) {

		if ( !current_user_can( 'publish_posts' ) ) { 

			echo '<div class="notice notice-error is-dismissible email-verify-status">
	      <p><b>Action Required</b>: Please check your email and confirm your email address.</p>
	      </div><style> .email-verify-status { background: #d63638; color: white; }  .notice-dismiss:before { color: white; } </style>' ;

		} else {
			echo '<div class="notice notice-error is-dismissible email-verify-status">
	      <p><b>Important</b>: Email address is not verified! <button class="email-confirmation-resend">Resend</button></p>
	      </div>
	      <style> 
	      .email-verify-status { background: #d63638; color: white; }  .notice-dismiss:before { color: white; } 
	      button.email-confirmation-resend {
	          background: black;
	          text-transform: uppercase;
	          display: inline-block;
	          position: relative;
	          background-image: linear-gradient(hsla(0, 0%, 100%, 0.6) , hsla(0, 0%, 100%, 0 ) 50%, hsla(0, 0%, 0%, 0.3) 50%, hsla(0, 0%, 100%, 0.2));
	          font-family: sans-serif;
	          font-weight: bold;
	          font-size: 12px;
	          color: white;
	          padding: 7px 14px;
	          border: none;
	          border-radius: 14px;
	          cursor: pointer;
	          transition: transform 0.1s, box-shadow 0.1s;
	      }
	      </style>' ;
		}

		
	}

}

add_action( 'admin_notices', 'travelt_admin_notice_warning' );

function travelt_remove_menu_pages() {

    global $pagenow, $user_ID;

    if ( !current_user_can( 'publish_posts' ) ) {

       remove_menu_page('edit.php');
       remove_menu_page('upload.php'); // Media
       remove_menu_page('edit-comments.php'); // Comments
       remove_menu_page( 'tools.php' ); // Tools 
       // remove_menu_page('edit.php?post_type=page'); // Pages
       remove_menu_page('wpcf7'); // Contact Form 7 Menu
    
        if($pagenow === 'admin.php') { 
			wp_redirect( admin_url( 'edit.php?post_type=photographers', 'https' ) );
			die();
		}

    }
}

add_action( 'admin_init', 'travelt_remove_menu_pages' );


function travelt_photographers_details( $post ) {

	global $wpdb;

	$booking_id = (int) $post->ID;

	$booking = $wpdb->get_row( $wpdb->prepare( "SELECT booking_details FROM tvl_travelt_booking WHERE booking_id = %d", array( $booking_id ) ), 'ARRAY_A');


	
	$data = json_decode((string) $booking['booking_details'], true);

	$pref_photographer_id = (int) $data['travelt_photographer_id'];

	// $cast_pref_type = (array) get_the_terms( $pref_photographer_id, 'photography_types' );

	// echo "<pre>";
	// var_dump($cast_pref_type);
	// exit;

	// $pref_typeIDs = array_column($cast_pref_type, 'term_id');

	$pref_typeIDs =  (int) $data['travelt_phtype'];

	$the_query = new WP_Query(array(
		'post_type' => 'photographers',
		'post_status' => array('pending', 'publish'),
		'posts_per_page' => -1,
		'tax_query' => array(

		    array (
		        'taxonomy' => 'photography_types',
		        'field' => 'term_id',
		        'terms' => $pref_typeIDs, // Filtering photographers with the same category type as the selected photographer.
		    ),

		),
		'meta_query'     => array(
			array(
				'key'     => 'traveltographer_city',
				'value'   => strtolower(get_field('traveltographer_city', $pref_photographer_id)),
				'type'    => 'CHAR',
				'compare' => '=',
			)
		)
	));

	// echo "<pre>";
	// var_dump(get_field('traveltographer_city', $pref_photographer_id), $pref_typeIDs);

	// var_dump($the_query->get_posts());
	
	// exit;



	?>

	<style>
		.ph-details-wrapper ul {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-orient: vertical;
			-webkit-box-direction: normal;
			-ms-flex-direction: column;
			flex-direction: column;
			padding-left: 0;
			margin-bottom: 0;
			height: 440px;
			overflow: scroll;
		}

		.ph-details-wrapper ul li  {
				position: relative;
			    display: block;
			    padding: 0.75rem 1.25rem;
			    margin-bottom: -1px;
			    background-color: #fff;
			    border: 1px solid rgba(0,0,0,.125);
		}

		.ph-details-wrapper ul li a { text-decoration: none; text-transform: capitalize; outline: none; }

		.ph-details-wrapper ul li a:active, a:focus { outline: none; }

		.ph-details-wrapper ul li a:hover { color: #ff9800; }

		.ph-details-wrapper .thickbox { color: initial; }

	</style>

	<div class="ph-details-wrapper">
		<ul>

			<?php add_thickbox(); ?>

			<?php foreach ($the_query->get_posts() as $key => $post) :

					 if ( get_field('traveltographer_email_verification_status', $post->ID) && get_field('traveltographer_account_status', $post->ID) ) : // var_dump($post); ?>

					 	<div id="photographer-<?php echo $post->ID; ?>" style="display:none;">
					 	     <div class="de-booking-wrapper">
					 	     	<h2>Photographer Details</h2>
					 	     	<div class="photographer-de">
					 	     		
					 	     		<?php $country = get_the_terms($post->ID, 'locations'); 

					 	     		$country_code = get_field('travelt_country_code', 'locations_' . $country[0]->term_id);

					 	     		// echo '<pre>'; var_dump($country_code);  ?>

					 	     		<div class="table" style="margin-bottom: 0px;">
					 	     								    
     								    <div class="row header">
     								      <div class="cell">ID</div>
     								      <div class="cell">Name</div>
     								      <div class="cell">City</div>
     								      <div class="cell">Email</div>
     								      <div class="cell">Phone</div>
     								      <!-- <div class="cell">Scheduled Date</div>
     								      <div class="cell">Scheduled Time</div> -->
     								    </div>
     								    
     								    <div class="row">
     								      <div class="cell" data-title="ID"><?php echo $post->ID; ?></div>
     								      <div class="cell" data-title="Name"><?php echo $post->post_title; ?></div>
     								      <div class="cell" data-title="City"><?php echo get_field('traveltographer_city', $post->ID); ?></div>
     								      <div class="cell" data-title="Email"><?php echo get_field('traveltographer_email', $post->ID); ?></div>
     								      <div class="cell" data-title="Phone"><a href="tel:<?php echo $country_code . get_field('traveltographer_phone', $post->ID); ?>"><?php echo $country_code . '-' . get_field('traveltographer_phone', $post->ID); ?></a></div>
     								      <!-- <div class="cell" data-title="Scheduled Date"><?php // echo $customer->travelt_date; ?></div>
     								      <div class="cell" data-title="Scheduled Time"><?php // echo $customer->travelt_time; ?></div> -->
     								    </div>
     								    
     								</div>

     								<p style="text-align: right;"><a target="_blank" href="<?php echo home_url('/wp-admin/') ?>post.php?post=<?php echo $post->ID; ?>&action=edit">View Profile</a></p>

					 	     	</div>
					 	     </div>
					 	</div>

						<li><a href="#TB_inline?&width=auto&height=550&inlineId=photographer-<?php echo $post->ID; ?>" class="thickbox"><?php echo '[ ' . $post->ID . ' ] ' . $post->post_title; ?></a></li>	

					<?php endif; ?>	

			<?php endforeach; ?>
		</ul>
	</div>

<?php }


function travelt_booking_details( $post ) {
	global $wpdb;

	$booking = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM tvl_travelt_booking WHERE booking_id = %d", array( $post->ID ) ), 'ARRAY_A');

	$customer = json_decode( $booking['booking_details'] );

	// echo "<pre>";
	// var_dump(json_decode( $booking['booking_details'] )); ?>

	<div class="booking-card-container customer-container">
			<div class="customer-card">

				<style>

					#travelt-booking-box-id {
					  font-size: 14px;
					  line-height: 20px;
					  font-weight: 400;
					  -webkit-font-smoothing: antialiased;
					  font-smoothing: antialiased;
					}

					#travelt-booking-box-id .inside {
						    background-image: linear-gradient(#607d8b, #121c20);
					}

					@media screen and (max-width: 580px) {
					  #travelt-booking-box-id {
					    font-size: 16px;
					    line-height: 22px;
					  }
					}

					.booking-card-container.customer-container {
					    padding-top: 20px;
					}

					.wrapper {
					  margin: 0 auto;
					  padding: 40px;
					  max-width: 800px;
					}

					.table {
					  margin: 0 0 40px 0;
					  width: 100%;
					  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
					  display: table;
					  align-self: flex-start;
					}

					@media screen and (max-width: 580px) {
					  .table {
					    display: block;
					  }
					}

					.row {
					  display: table-row;
					  background: #f6f6f6;
					  background-image: linear-gradient(#f6f7f7, #dcdcde);
					  border: 1px solid #f0f0f1;
					}

					.row:nth-of-type(odd) {
					  background: #e9e9e9;
					}

					.row.header {
					  font-weight: 900;
					  color: #ffffff;
					  background: #ea6153;
					}

					.row.green {
					  background: #27ae60;
					}

					.row.blue {
					  background: #2980b9;
					}

					.responses {
							display: inline-block;
						    background-image: linear-gradient(#a7aaad, #646970);
						    border: 1px solid #f0f0f1;
						    color: #212121;
						    margin: 5px;
						    padding: 35px 10px !important;
						    border-radius: 2px;
						    cursor: pointer;
					}
					
					@media screen and (max-width: 580px) {
					  
					  .row {
					    padding: 14px 0 7px;
					    display: block;
					  }

					  .row.header {
					    padding: 0;
					    height: 6px;
					  }

					  .row.header .cell {
					    display: none;
					  }

					  .row .cell {
					    margin-bottom: 10px;
					  }

					  .row .cell:before {
					    margin-bottom: 3px;
					    content: attr(data-title);
					    min-width: 98px;
					    font-size: 10px;
					    line-height: 10px;
					    font-weight: bold;
					    text-transform: uppercase;
					    color: #969696;
					    display: block;
					  }

					  .cell.responses {
					  	margin: 0px;
					  	padding: 20px 10px !important;
					  }

					  .responses-wraper .row { padding: 0px; }

					  .row .cell.responses:before { color: #212121; }

					  .cell.booked { padding: 10px 15px !important; }

					}

					.cell {
					  padding: 6px 12px;
					  display: table-cell;
					  font-size: 14px;
					  text-transform: uppercase;
					}

					.table-container {
					    display: grid;
					    grid-template-columns: 3fr 1fr;
					    grid-gap: 20px;
					}

					.responses > div {
					    padding: 10px;
					    margin: 0px;
					    font-size: 14px;

					}

					.responses > div {
					    padding: 10px;
					    margin: 0px;
					    font-size: 12px;
				        font-weight: 500;
				        text-transform: uppercase;
					    display: inline-block;
					    background-image: linear-gradient(#f6f7f7, #dcdcde);
					    border: 1px solid #f0f0f1;
					    color: #212121;
					    margin: 5px;
					    padding: 4px 10px;
					    border-radius: 2px;
					    cursor: pointer;
					    width: 90%;
					}

					/* .responses > div:nth-of-type(odd) {
					    background: #e9e9e9;
					} */

					/* CSS */
					.button-15, .button-16 {
					  background-image: linear-gradient(#42A1EC, #0070C9);
					  border: 1px solid #0077CC;
					  border-radius: 4px;
					  box-sizing: border-box;
					  color: #FFFFFF;
					  cursor: pointer;
					  direction: ltr;
					  font-family: "SF Pro Text","SF Pro Icons","AOS Icons","Helvetica Neue",Helvetica,Arial,sans-serif;
					  font-size: 12px;
					  font-weight: 400;
					  letter-spacing: -.022em;
					  line-height: 1.47059;
					  min-width: 30px;
					  overflow: visible;
					  padding: 4px 15px;
					  text-align: center;
					  vertical-align: baseline;
					  user-select: none;
					  -webkit-user-select: none;
					  touch-action: manipulation;
					  white-space: nowrap;
					}

					.button-16 {
						background-image: linear-gradient(#ea6153, #bf4337);
						border: 1px solid #ea6153;
					}

					.button-15:disabled, .button-16:disabled {
					  cursor: default;
					  opacity: .3;
					}

					.button-15:hover, .button-16:hover {
					  background-image: linear-gradient(#51A9EE, #147BCD);
					  border-color: #1482D0;
					  text-decoration: none;
					}

					.button-15:active, .button-16:active {
					  background-image: linear-gradient(#3D94D9, #0067B9);
					  border-color: #006DBC;
					  outline: none;
					}

					.button-15:focus, .button-16:focus {
					  box-shadow: rgba(131, 192, 253, 0.5) 0 0 0 3px;
					  outline: none;
					}

					.cell.booked {
					    display: inline-block;
					    background-image: linear-gradient(#42A1EC, #0070C9);
					    border: 1px solid #0077CC;
					    color: white;
					    margin: 5px;
					    padding: 2px 40px;
					    border-radius: 2px;
					    cursor: pointer;
					    text-transform: uppercase;
					    font-size: 12px;
					    font-weight: 500;
					}

					.cell.booked:before { color: #212121; }
					.cell.preferred {
						text-transform: uppercase;
						font-weight: 500;
						font-size: 12px;
						color: #797b81;
					}

					.cancellation-form {
					    display: flex;
					    flex-direction: column;
					}

					.cancellation-table { opacity: 0.3; }

					.cancellation-table:hover { opacity: 1; }

					a.thickbox {
					    color: white;
					    text-decoration: none;
					}

					.booking-card-container span.tag {
					    margin-top: 5px;
					    display: inline-block;
					    background: #cfcfcf;
					    color: white;
					    padding: 2px 10px;
					    font-size: 11px;
					}

					.booking-card-container span.tag[data-selected] { background: #3799e7; }

					.table.transaction div.cell small {
					    background: #ffeb3b;
					    padding: 2px 10px;
					    color: black;
					}

					@media screen and (max-width: 580px) {

					  .cancellation-table:hover { opacity: 0.3; }

					  .table-container { display: block; }

					  .cell {
					    padding: 2px 16px;
					    display: block;
					  }


					}

				</style>

				<div class="table-container">
					
					<div class="table-first">

						<?php 

						// echo "<pre>";
						// var_dump($booking);



						if ($booking['txn_id']):

								


						 ?>

							<div class="table transaction" style="margin-bottom: 0px;">
							   
							    <div class="row">
							      <div class="cell" data-title="Transaction ID">Transaction ID <small><?php echo $booking['txn_id']; ?></small></div>
							      <div class="cell" data-title="Amount">Amount <small><?php echo $booking['amount']; ?> USD</small></div>
							      <div class="cell" data-title="Payment Status">Payment Status <small><?php echo $booking['payment_status']; ?></small></div>
							      <div class="cell" data-title="Payment Date">Payment Date <small><?php echo $booking['payment_date']; ?></small></div>
							    </div>
							    
							</div>
							
						<?php endif; ?>
						
						<div class="table">
						    
						    <div class="row header">
						      <div class="cell">Name</div>
						      <div class="cell">Email</div>
						      <div class="cell">Phone</div>
						      <div class="cell">Scheduled Date</div>
						      <div class="cell">Scheduled Time</div>
						    </div>
						    
						    <div class="row">
						      <div class="cell" data-title="Name"><?php echo $customer->travelt_name; ?></div>
						      <div class="cell" data-title="Email"><?php echo $customer->travelt_email; ?></div>
						      <div class="cell" data-title="Phone"><?php echo $customer->travelt_phone; ?></div>
						      <div class="cell" data-title="Scheduled Date"><?php echo $customer->travelt_date; ?></div>
						      <div class="cell" data-title="Scheduled Time"><?php echo $customer->travelt_time; ?></div>
						    </div>
						    
						</div>

						<div class="table">
						    
						    <div class="row header green">
						      <div class="cell">Preferred Photographer</div>
						      <div class="cell">Booked Photographer</div>
						      <div class="cell">City</div>
						      <div class="cell">Email</div>
						      <div class="cell">Phone</div>
						    </div>
						    
						    <div class="row">
						      <div class="cell preferred" data-title="Preferred Photographer">
						      	<?php 

						      	echo '[ ID: ' . $customer->travelt_photographer_id . ' ] ' . get_the_title( $customer->travelt_photographer_id ) . '<br>';

						      	$phoTypes = (array) get_the_terms( $customer->travelt_photographer_id, 'photography_types' ); 

						      	foreach ( $phoTypes as $key => $phoType ) : ?>

						      		<span class="tag" <?php echo ($customer->travelt_phtype == $phoType->term_id) ? 'data-selected' : ''; ?>><?php echo $phoType->name; ?></span>

						      	<?php endforeach; ?>
						      	
						      	</div>

						      <?php if (get_field('travelt_book_photographer', $post->ID)): ?>

						      	<style> #acf-group_62ff76156fcb8 { pointer-events: none; opacity: 0.4; -webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; } </style>

						      	<?php // add_thickbox(); ?>

						      	<div id="photographer-details" style="display:none;">
						      	     <div class="de-booking-wrapper">
						      	     	<h2>Photographer Details</h2>
						      	     	<div class="photographer-de">
						      	     		<!-- PENDING -->
						      	     	</div>
						      	     </div>
						      	</div>

						      	<div class="cell booked" data-title="Booked Photographer">
						      		<!-- <a href="#TB_inline?&width=600&height=550&inlineId=photographer-details" class="thickbox"> -->
						      			<?php echo '[ ID: ' . get_field('travelt_book_photographer', $post->ID) . ' ] ' . get_the_title( get_field('travelt_book_photographer', $post->ID) ); ?>
						      				
						      		<!-- </a> -->
						      			
						      	</div> 

						      	<div class="cell" data-title="City">
						    		<?php echo get_field('traveltographer_city', $customer->travelt_photographer_id); ?>
						      	</div> 

						      	<div class="cell"><?php echo get_field('traveltographer_email', get_field('travelt_book_photographer', $post->ID)); ?></div>

						      	<?php $country = get_the_terms($customer->travelt_photographer_id, 'locations'); 

						      	$country_code = get_field('travelt_country_code', 'locations_' . $country[0]->term_id);


						      	?>

						      	<div class="cell"><a href="tel:<?php echo $country_code . get_field('traveltographer_phone', get_field('travelt_book_photographer', $post->ID)); ?>"><?php echo $country_code . '-' . get_field('traveltographer_phone', get_field('travelt_book_photographer', $post->ID)); ?></a></div>
							
								<!-- <div id="booking-cancellation" style="display:none;">
								     <div class="cancel-booking-wrapper">
								     	<h2>Cancel Booking</h2>
								     	<div class="cancellation-form">
								     		<label for="cancellation-reason">Cancellation Reason</label>
								     		<textarea name="cancellation_reason" id="cancellation-reason" cols="30" rows="10"></textarea>
								     		<button class="confirm-cancel">Submit</button>
								     	</div>
								     </div>
								</div> -->

								<!-- <a href="#TB_inline?&width=600&height=550&inlineId=booking-cancellation" class="thickbox">Cancel</a> -->


								<!-- <small><a href="http://example.com?TB_iframe=true&width=600&height=550" class="thickbox">Cancel</a></small> -->

						      <?php else: ?>

						      	<div class="cell" data-title="Booked Photographer"> - </div>
						      	<div class="cell" data-title="Booked Photographer"> - </div>
						      	<div class="cell" data-title="Booked Photographer"> - </div>
						      	<div class="cell" data-title="Booked Photographer"> - </div>
						      	
						      <?php endif; ?>
						      
						    </div>
						    
						</div>

						<?php if ($booking['cancellation']): ?>

							<div class="table cancellation-table">
							    
							    <div class="row header" style="background: #646970;">
							      <div class="cell">Date &amp; Time</div>
							      <div class="cell">ID</div>
							      <div class="cell">Name</div>
							      <div class="cell">Cancellation Reason</div>
							    </div>

							    <?php // echo "<pre>"; var_dump(json_decode($booking['cancellation'])); 
							    foreach (json_decode($booking['cancellation']) as $key => $cancellation): ?>

							    	<div class="row">
							    	  <div class="cell" data-title="Date"><?php echo $cancellation->date; ?> </div>
							    	  <div class="cell" data-title="ID"><?php echo $cancellation->id; ?></div>
							    	  <div class="cell" data-title="Name"><?php echo get_the_title( $cancellation->id ); ?></div>
							    	  <div class="cell" data-title="Cancellation Reason"><?php echo ($cancellation->reason) ? $cancellation->reason : ' - '; ?></div>
							    	</div>
							    	
							    <?php endforeach; ?>

							    
							</div>
							
						<?php endif; ?>

						

					</div>

					<div class="table responses-wraper">
					    
					    <div class="row header blue">
					      <div class="cell">Responses</div>
					    </div>
					    
					    <div class="row">
					      <div class="cell responses" data-title="Responses">

					      	<?php if ( $booking['response'] ) : 

					      		$responses = json_decode( (string) $booking['response'], true );
					      		
					      		$style = 'style="background-image: linear-gradient(#673ab7, #2f165a); border: 1px solid #673ab7; color: white;"';

					      		foreach ( $responses as $key => $response ): 

					      			// var_dump($response['id']);
					      			// var_dump( $post->ID  );

					      			?>
					      	
					      			<div class="ph" title="<?php echo $response['id']; ?>" id="p-<?php echo $response['id']; ?>" <?php echo ($response['id'] == get_field('travelt_book_photographer', $post->ID) ) ? $style : ''; ?>><span class=""><?php echo $response['name']; ?></span> - 
										<span class="datetime"><?php echo $response['time']; ?></span>
									</div>

					      	<?php endforeach; endif; ?>

					      </div>
					    </div>
					    
					</div>
				</div>
		
			</div> <!-- booking-card -->
	</div>


<?php }


add_action( 'init', 'traveltographer_booking_post_type'  );

if ( ! function_exists( 'traveltographer_booking_post_type' ) ) {

		function traveltographer_booking_post_type() {
			
				$labels = array(
					"name" => __( 'Bookings', 'traveltographer' ),
					"singular_name" => __( 'Booking', 'traveltographer' ),
					'add_new'				=> __( 'Add New' , 'traveltographer' ),
				    'add_new_item'			=> __( 'Add New Booking' , 'traveltographer' ),
				    'edit_item'				=> __( 'Edit Booking' , 'traveltographer' ),
				    'new_item'				=> __( 'New Booking' , 'traveltographer' ),
				    'view_item'				=> __( 'View Booking', 'traveltographer' ),
				    'search_items'			=> __( 'Search Bookings', 'traveltographer' ),
				    'not_found'				=> __( 'No Bookings found', 'traveltographer' ),
				    'not_found_in_trash'	=> __( 'No Bookings found in Trash', 'traveltographer' ), 
				);

				$args = array(

					"label" => __( 'Bookings', 'traveltographer' ),
					"labels" => $labels,
					"description" => "",
					"public" => true,
					"publicly_queryable" => true,
					"show_ui" => true,
					"show_in_rest" => false,
					"rest_base" => "",
					"has_archive" => false,
					"show_in_menu" => true,
					"exclude_from_search" => false,
					"capability_type" => "post",
					'capabilities' => array(
					    'edit_post'          => 'update_core',
					    'read_post'          => 'update_core',
					    'delete_post'        => 'update_core',
					    'edit_posts'         => 'update_core',
					    'edit_others_posts'  => 'update_core',
					    'delete_posts'       => 'update_core',
					    'publish_posts'      => 'update_core',
					    'read_private_posts' => 'update_core'
					),
					"map_meta_cap" => true,
					"hierarchical" => false,
					"rewrite" => array( "slug" => "bookings", "with_front" => true ),
					"query_var" => true,
					"menu_icon" => 'https://odhotels.in/wp-content/themes/traveltographer/assets/images/booking.png', 
					"supports" => array( "title", "editor", "thumbnail" ),

					);

				    register_post_type( "bookings", $args );

		}

}

function travelt_booking_view() {

	global $post;

	if(!isset($post)) return;
	
	// if($post->post_status !== 'publish') return;

    add_meta_box( 'travelt-booking-box-id', 
    			__( 'Booking Details', 'traveltographer' ), 
    			'travelt_booking_details', 
    			'bookings',
    			'normal',
    			'high'
   	);


   	add_meta_box( 'travelt-photographers-box-info', 
    			__( 'Photographers', 'traveltographer' ), 
    			'travelt_photographers_details', 
    			'bookings',
    			'normal',
    			'low'
   	);


}

add_action( 'add_meta_boxes', 'travelt_booking_view' );

add_action( 'acf/save_post', 'travelt_photographers_account_status', 30, 3 );

function travelt_photographers_account_status( $post_id ) {

	global $wpdb;

	$current_posttype = get_post_type ( $post_id );
	$current_status = get_post_status ( $post_id );

	if ($current_posttype === 'photographers') {
		if ( $current_status == 'publish' ) {

					$account = array(); // Photographer's account.

					$account_status = get_field('traveltographer_account_status', $post_id);

			        if (!$account_status) {
						update_field('traveltographer_account_status', 1, $post_id);
					}

					$post = get_post($post_id);

					// Save profile info in prev_post table.
					$account['name'] = $post->post_title;
					$account['bio']  = $post->post_content;

					$categories = get_the_terms($post_id, 'photography_types');

					foreach ($categories as $key => $cat):
						$account['type'][] = $cat->term_id;
					endforeach;

					$account['languages'] = get_field('traveltographer_languages');

					$images = get_field('traveltographer_gallery');

					foreach( get_field('traveltographer_gallery') as $image ):
						$account['images'][] = $image['url'];
					endforeach;
					
					$fetch_account_data = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM tvl_prev_accinfo WHERE profile_id = %d", array( $post_id ) ), 'ARRAY_A');

					$dateTime = new DateTime();

					$dateTime->setTimezone(new DateTimeZone('Asia/Dubai'));

					if ($fetch_account_data) {

						$wpdb->query( $wpdb->prepare(
						    "UPDATE tvl_prev_accinfo set account_data = '%s', date_time = '%s' WHERE profile_id = '%d'",
						    array(
						        json_encode($account),
						        $dateTime->format('m/d/Y g:i A'),
						        $post_id
						    )
						));

					} else {

						$wpdb->query( $wpdb->prepare(
						    "INSERT ignore INTO tvl_prev_accinfo (profile_id, account_data, date_time) VALUES ( %d, %s, %s )",
						    array(
						        $post_id,
						        json_encode($account),
						        $dateTime->format('m/d/Y g:i A')
						    )
						) );
					}

		}
	}

	if($current_posttype === 'bookings') {

				$booking = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM tvl_travelt_booking WHERE booking_id = %d", array( $post_id ) ), 'ARRAY_A');

				$booking_status = get_field('travelt_booking_status', $post_id);

				if ($booking_status) {

					// echo "<pre>";
					// var_dump($travelt_booked_photographer);
					// var_dump($booking);
					// var_dump($travelt_cancellation_reason);
					// exit;

					if ($booking_status == 'cancel') {

						$travelt_booked_photographer = get_field('travelt_book_photographer', $post_id);

						$travelt_cancellation_reason = '';
						send_cancellation_email( $travelt_booked_photographer, $booking, $travelt_cancellation_reason, true );
						wp_trash_post($post_id); // Move to Trash
						wp_redirect( home_url( '/wp-admin/' ) . 'edit.php?post_type=bookings' );
						die();
					}
					
				} else {

					$travelt_booked_photographer = get_field('travelt_booked_photographer', $post_id);

					if ($travelt_booked_photographer) { // If selected for cancellation
						
						$travelt_cancellation_reason = get_field('travelt_cancellation_reason', $post_id);

						update_field('travelt_book_photographer', null, $post_id);
						update_field('travelt_booked_photographer', null, $post_id);
						update_field('travelt_cancellation_reason', '', $post_id);

						$response = send_cancellation_email( $travelt_booked_photographer, $booking, $travelt_cancellation_reason );

						$dateTime = new DateTime();

						$dateTime->setTimezone(new DateTimeZone('Asia/Dubai'));

						if ($booking['cancellation']) {

							$cancellations = json_decode((string) $booking['cancellation'], true);

							$i = count($cancellations);

							$cancellations[$i]['id']     = $travelt_booked_photographer;
							$cancellations[$i]['reason'] = $travelt_cancellation_reason;
							$cancellations[$i]['date']   = $dateTime->format('m/d/Y g:i A');

							if ($response) {
								$cancellations[$i]['email_sent'] = 'yes';
							}
							
						} else {
							
							$cancellations = array();

							$cancellations[0]['id']     = $travelt_booked_photographer;
							$cancellations[0]['reason'] = $travelt_cancellation_reason;
							$cancellations[0]['date']   = $dateTime->format('m/d/Y g:i A');

							if ($response) {
								$cancellations[0]['email_sent'] = 'yes';
							}

						}

						// Update Db
						$wpdb->query( $wpdb->prepare(
						    "UPDATE tvl_travelt_booking set confirmation_email = '%d', cancellation = '%s' WHERE booking_id = '%d'",
						    array(
						    	0,
						        json_encode($cancellations),
						        $post_id
						    )
						));

					
					} else {

						$photographer_booked = get_field('travelt_book_photographer', $post_id);

						if ($photographer_booked) { // If photographer is booked

							if ($booking['confirmation_email'] != '1') {

									send_confirmation_email( $photographer_booked, $booking );

									send_confirmation_email_to_customer(/*$photographer_booked,*/ $booking);

								    if ( $booking['response'] ) : 

								          		$responses = json_decode( (string) $booking['response'], true );
								          		
								          		// echo '<pre>';
								          		// var_dump($responses);
								          		// exit;

											    send_email_to_other_photographers($photographer_booked, $booking, $responses);

								    endif;

									$wpdb->query( $wpdb->prepare( // Update Db
									    "UPDATE tvl_travelt_booking set confirmation_email = '%d' WHERE booking_id = '%d'",
									    array(
									        1,
									        $post_id
									    )
									));
							}
							
						}

					}

				} // booking status

				


    }
	
}

add_filter('acf/load_field/name=travelt_book_photographer', 'travelt_load_choices');

if ( ! function_exists( 'travelt_load_choices' ) ) {

	function travelt_load_choices( $field ) {

		global $wpdb, $post;

		$booking = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM tvl_travelt_booking WHERE booking_id = %d", array( $post->ID ) ), 'ARRAY_A');
	    
	    // reset choices
	    $field['choices'] = array();

	    if ( $booking['response'] ) : 

	          		$responses = json_decode( (string) $booking['response'], true );
	          		// echo '<pre>';
	          		// var_dump($responses);

				    foreach ( $responses as $key => $response ): 

				    	$id = $response['id'];
				    	$name = $response['name'];
				          	
				        $field['choices'][ $id ] = '[ ID: ' . $id . ' ] ' . $name;		

				    endforeach; 

	    endif;
	   
	    // return the field
	    return $field;
	    
	}

}

add_filter('acf/load_field/name=travelt_booked_photographer', 'travelt_load_booked_photographer');

if ( ! function_exists( 'travelt_load_booked_photographer' ) ) {

	function travelt_load_booked_photographer( $field ) {

		global $post;

		$field['choices'] = array();

		$travelt_booked_photographer = get_field('travelt_book_photographer', $post->ID);
	    
		if ($travelt_booked_photographer) {
			$field['choices'][ $travelt_booked_photographer ] = '[ ID: ' . $travelt_booked_photographer . ' ] ' . get_the_title( $travelt_booked_photographer );	
		}
	   
	    // return the field
	    return $field;
	    
	}

}

add_filter('acf/load_field/name=travelt_select_type', 'travelt_load_travelt_select_type');

if ( ! function_exists( 'travelt_load_travelt_select_type' ) ) {

	function travelt_load_travelt_select_type( $field ) {

		$field['choices'] = array();

		$photography_types = get_terms( array( 
		      'taxonomy' => 'photography_types',
		      'hide_empty' => false,
		) ); 

		foreach ($photography_types as $key => $type):

			$field['choices'][ $type->term_id ] = $type->name;	

		endforeach;
	   
	    // return the field
	    return $field;
	    
	}

}

if (is_admin()) {
	add_filter('acf/load_field/name=travelt_select_city', 'travelt_load_cities');
}

if ( ! function_exists( 'travelt_load_cities' ) ) {

	function travelt_load_cities( $field ) {

		global $taxnow, $path;

		$field['choices'] = array();

		// $json = file_get_contents( $path );

		// $jsonData = json_decode($json, true);

		if( have_rows('travelt_cities', $taxnow . '_' . absint( $_GET['tag_ID'] ) ) ):

		    // Loop through rows.
		    while( have_rows('travelt_cities', $taxnow . '_' . absint( $_GET['tag_ID'] ) ) ) : the_row();

		        // Load sub field value.
		        $city = get_sub_field('travelt_city_q', $taxnow . '_' . absint( $_GET['tag_ID'] ) );
		        // Do something...

		        $field['choices'][strtolower($city)] = $city;	

		    // End loop.
		    endwhile;

		endif;
		
	    // return the field
	    return $field;
	    
	}

}


add_filter('acf/load_field/name=traveltographer_city', 'travelt_load_grapher_city');

if ( ! function_exists( 'travelt_load_grapher_city' ) ) {

	function travelt_load_grapher_city( $field ) {

		$taxnow = 'locations';

		$terms = get_the_terms( get_the_ID() , 'locations' );

		global $path;

		$field['choices'] = array();

		// $json = file_get_contents( $path );

		// $jsonData = json_decode($json, true);

		if ($terms) {		

			if( have_rows('travelt_cities', $taxnow . '_' . $terms[0]->term_id ) ):

			    // Loop through rows.
			    while( have_rows('travelt_cities', $taxnow . '_' . $terms[0]->term_id ) ) : the_row();

			        // Load sub field value.
			        $city = get_sub_field('travelt_city_q', $taxnow . '_' . $terms[0]->term_id );
			        // Do something...

			        $field['choices'][strtolower($city)] = $city;	

			    // End loop.
			    endwhile;

			endif;

		}
	   
	    // return the field
	    return $field;
	    
	}

}

add_action('wp_ajax_load_cities_data', 'travelt_load_cities_data');
add_action('wp_ajax_nopriv_load_cities_data', 'travelt_load_cities_data');

if ( ! function_exists( 'travelt_load_cities_data' ) ) { 

	function travelt_load_cities_data() {

		check_admin_referer( 'moon-knite', 'nonce' );

		global $path;

		$taxnow = 'locations';

		$country = $_POST['id'];

		// $json = file_get_contents( $path );

		// $jsonData = json_decode($json, true);

		$field = array();

		if ($country) {
			if( have_rows('travelt_cities', $taxnow . '_' . $country ) ):

			    // Loop through rows.
			    while( have_rows('travelt_cities', $taxnow . '_' . $country ) ) : the_row();

			        // Load sub field value.
			        $city = get_sub_field('travelt_city_q', $country );
			        // Do something...

			        $field[] = $city;	

			    // End loop.
			    endwhile;

			endif;
		}

		echo json_encode($field);
		die();

	}

}

 add_action('admin_enqueue_scripts', 'traveltadmin_enqueue_scripts');

 if ( ! function_exists( 'traveltadmin_enqueue_scripts' ) ) {

	function traveltadmin_enqueue_scripts() {

		wp_enqueue_script( 'calendar_script', get_template_directory_uri() . '/assets/js/dashboard.js', array('jquery'), '20221118', true );		
		
		// localizing script
		wp_localize_script( 'calendar_script', 'traveltadmin', 
			array( 
			'root' => get_site_url(), 
			'ajax' => admin_url( 'admin-ajax.php' ) ,
			'nonce' => wp_create_nonce('wakanda-forever')
			) 
		);

	}

}



add_action('wp_ajax_load_traveltographer_booking_details', 'travelt_load_booking_details');
add_action('wp_ajax_nopriv_load_traveltographer_booking_details', 'travelt_load_booking_details');

if ( ! function_exists( 'travelt_load_booking_details' ) ) {  // PENDING - CONTINUE FROM HERE

	function travelt_load_booking_details() {

		check_admin_referer( 'wakanda-forever', 'nonce' );

		global $wpdb;

		$booking = array();

		if (!current_user_can('manage_options')) {

			$the_query_user = new WP_Query(array(
				'post_type' => 'photographers',
				'posts_per_page' => 1,
				'post_status' => 'publish'
			));

			$photographer_ID = $the_query_user->get_posts()[0]->ID;

			// var_dump($photographer_ID);

			$the_query = new WP_Query(array(
					'post_type' => 'bookings',
					'posts_per_page' => -1,
					'meta_key' => 'travelt_book_photographer',
					'meta_value' => $photographer_ID,
					'post_status' => 'publish'

			));

		} else {

			    $the_query = new WP_Query(array(

					'post_type' => 'bookings',
					'posts_per_page' => -1,
					'post_status' => 'publish'

				));
		}	   


		if ($the_query->get_posts()): 

			foreach ( $the_query->get_posts() as $key=> $post ):

			$photographer = get_the_title( get_field('travelt_book_photographer', $post->ID) );

			$db = $wpdb->get_row( $wpdb->prepare( "SELECT booking_details FROM tvl_travelt_booking WHERE booking_id = %d", array( $post->ID ) ), 'ARRAY_A');
	
			$data = json_decode((string) $db['booking_details'], true);

			$datetime = new DateTime();
			$newDate  = $datetime->createFromFormat('d/m/Y', $data['travelt_date']);

			$start = $newDate->format('Y-m-d');

			$new_time = DateTime::createFromFormat('h:i A', $data['travelt_time']);
			$time_24  = $new_time->format('H:i:s');

			$booking[$key]['test'] = $time_24;
			
			// $start = date('Y-m-d', $start) . 'T' . $_start . ':00';
			// $start = date('Y-m-d', $start);
			// $customer->travelt_date
			// $customer->travelt_time

			// $start = strtotime( $bookingDetail['scheduled_date'] );
			// = date('Y-m-d', $scheduled_date) . 'T' . $_start . ':00';

			$booking[$key]['title'] = $photographer; // . ' [ ' . $post->post_title . ' ]'
			$booking[$key]['start'] = $start . 'T' . $time_24;
			$booking[$key]['url'] = admin_url( 'post.php' ) . '?post=' . $post->ID . '&action=edit';

		endforeach; endif; wp_reset_postdata();

		echo json_encode($booking);
		exit();

	}

}