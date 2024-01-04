<?php
/**
 * TravelTographer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TravelTographer
 */

require 'vendor/autoload.php';
use \Mailjet\Resources;

$path = __DIR__ . '/inc/data/cities.json';

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function traveltographer_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on TravelTographer, use a find and replace
		* to change 'traveltographer' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'traveltographer', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'traveltographer' ),
			'menu-2' => esc_html__( 'Secondary', 'traveltographer' ),
			'menu-3' => esc_html__( 'Tertiary', 'traveltographer' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'traveltographer_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'traveltographer_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function traveltographer_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'traveltographer_content_width', 640 );
}
add_action( 'after_setup_theme', 'traveltographer_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function traveltographer_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'traveltographer' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'traveltographer' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'traveltographer_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function traveltographer_scripts() {


	wp_enqueue_style( 'traveltographer-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'traveltographer-style', 'rtl', 'replace' );

	wp_enqueue_script( 'traveltographer-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'traveltographer_script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '20221027', true );

	// localizing script
	wp_localize_script( 'traveltographer_script', 'travelt', 
		array( 
		'root' => get_site_url(), 
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce('moon-knite')
		) 
	);



}
add_action( 'wp_enqueue_scripts', 'traveltographer_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

add_filter('use_block_editor_for_post', '__return_false', 10);


require get_template_directory() . '/inc/custom_functions.php';

add_action('admin_enqueue_scripts', 'travelt_enqueue_scripts');

if ( ! function_exists( 'travelt_enqueue_scripts' ) ) {

	function travelt_enqueue_scripts() {

			global $pagenow, $typenow, $post;

			wp_enqueue_style( 'travelt_style', get_template_directory_uri() . '/assets/css/asty.css' );

			if($typenow === 'bookings') {
				wp_enqueue_script( 'travelt_script', get_template_directory_uri() . '/assets/js/panel.js', array('jquery'), '20220922', true );
			}

			wp_enqueue_script( 'travelt_admin', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'), '20220922', true );

			// localizing script
			wp_localize_script( 'travelt_admin', 'travelt', 
				array( 
				'root' => get_site_url(), 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce('moon-knite')
				) 
			);

	}

}

function travelt_send_emails_photographers($id) {

		global $wpdb;

		$booking_id = (int) $id;

		$booking = $wpdb->get_row( $wpdb->prepare( "SELECT booking_details FROM tvl_travelt_booking WHERE booking_id = %d", array( $booking_id ) ), 'ARRAY_A');
		
		$data = json_decode((string) $booking['booking_details'], true);

		$pref_photographer_id = (int) $data['travelt_photographer_id'];

		// $cast_pref_type = (array) get_the_terms( $pref_photographer_id, 'photography_types' );

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
			    )

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

		foreach ($the_query->get_posts() as $key => $post) {

					 if ( get_field('traveltographer_email_verification_status', $post->ID) && get_field('traveltographer_account_status', $post->ID) ) {

											// var_dump('expression');
											// exit;

											$photographer_id = $post->ID;

											// $cast_type = (array) get_the_terms( $photographer_id, 'photography_types' );

											// $ph_typeIDs = array_column($cast_type, 'term_id');

											// $result = !empty(array_intersect($pref_typeIDs, $ph_typeIDs));

											// if ($result) {

													$bookingDate = $data['travelt_date'];
													$bookingTime = $data['travelt_time'];

													// $postarr = [ 'post_title' => 'booking', 'post_content' => $data['travelt_date'] ];
													// wp_insert_post( $postarr );

						                        	$photographer_email = get_field('traveltographer_email', $photographer_id);

													// Send login details
													$contactname = 'Traveltographer';
													$subject     = 'Confirm your Availability!';
													$email_body  = '';

													$email_body  .= 'Dear ' . get_the_title($photographer_id) . ', <br><br>';

													$email_body  .= 'There has been a booking request for ' . $bookingDate . ' at ' . $bookingTime . '. Please click on the link below to confirm your availability. <br>';
													
													$email_body  .= home_url('/response/') . '?phid=' . $photographer_id . '&bid=' . $booking_id . '&confirm';

													$email_body  .= '<br><br><br>Regards,<br>Team Traveltographer.';


													// $email_body  .= json_encode($pref_photographer_id) . '<br><br>';
													// $email_body  .= json_encode(get_the_terms( $pref_photographer_id, 'photography_types' )) . '<br><br>';
													// $email_body  .= json_encode($pref_typeIDs) . '<br><br>';
													// $email_body  .= json_encode($ph_typeIDs) . '<br><br>';
													// $email_body  .= json_encode($result) . '<br><br>';


													// Sending email to user
											        $mj = new \Mailjet\Client('6d82e174bf1cb383c2db46d759983e2b','eb3c1c3fc1eda3cc563edafca794fa17',true,['version' => 'v3.1']);

									                try {

									                    $body = [
									                      'Messages' => [
									                        [
									                          'From' => [
									                            'Email' => "wordpress@traveltographer.com",
									                            'Name' => $contactname
									                          ],
									                          'To' => [
									                            [
									                              'Email' => $photographer_email,
									                              'Name' => get_the_title($photographer_id)
									                            ]
									                          ],
									                          'Subject' => $subject,
									                          // 'TextPart' => "My first Mailjet email",
									                          'HTMLPart' => $email_body,
									                          'CustomID' => "AppGettingStartedTest"
									                        ]
									                      ]
									                    ];

									                    $response = $mj->post(Resources::$Email, ['body' => $body]);
									                    // $response->success() && var_dump($response->getData());
									                    $response->success();

									                    // $postarr = [ 'post_title' => 'email', 'post_content' => son_encode($response->getData()) ];
									                    // wp_insert_post( $postarr );

									                } catch (Exception $e) {
									                    echo "Message could not be sent. Mailer Error: {$mailU->ErrorInfo}";
									                }

											// }


											
							
					} 
		}

		global $wpdb;

		$wpdb->query( $wpdb->prepare(
		    "UPDATE tvl_travelt_booking set email_status = '%d' WHERE booking_id = '%d'",
		    array(
		        1,
		        $booking_id // booking id
		    )
		));

}


/* function posts_for_current_author($query) {
    
    global $pagenow;
 
    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;
 
    if( !current_user_can( 'update_core' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }

    return $query;
}

add_filter('pre_get_posts', 'posts_for_current_author'); */

add_action( 'travelt_cron_hook', 'travelt_send_emails_photographers' );

if( isset($_GET['booking']) && $_GET['booking'] === 'success' && isset($_GET['bid']) ) {

	global $wpdb;

	$booking_id = (int) $_GET['bid'];

	$fetch = $wpdb->get_row( $wpdb->prepare( "SELECT email_status, booking_details FROM tvl_travelt_booking WHERE booking_id = %d", array( $booking_id ) ), 'ARRAY_A');

	if ( $fetch['email_status'] != 1 ) {

		wp_schedule_single_event( time() , 'travelt_cron_hook', array($_GET['bid']) );
	}

}

function send_cancellation_email( $photographer_id, $booking, $reason, $cancelledbycustomer = false ) {

					$data = json_decode((string) $booking['booking_details'], true);

					$bookingDate = $data['travelt_date'];
					$bookingTime = $data['travelt_time'];

					$photographer_email = get_field('traveltographer_email', $photographer_id);

					// Trigger Email -
					$contactname = 'Traveltographer';
					$subject     = 'Booking Cancelled!';
					$email_body  = '';

					$email_body  .= 'Dear ' . get_the_title($photographer_id) . ', <br><br>';

					$email_body  .= 'Your Booking on ' . $bookingDate . ' at ' . $bookingTime . ' has been cancelled.<br><br>';

					if ($cancelledbycustomer) {
						$email_body  .= 'Cancellation Reason - <br> Booking cancelled by Customer. <br>';
					} else {
						$email_body  .= 'Cancellation Reason - <br>' . $reason . '<br>';
					}

					// $email_body  .= 'Cancellation Reason - <br>' . $reason . '<br>';

					$email_body  .= '<br><br><br>Regards,<br>Team Traveltographer.';

					// Sending email to user
			        $mj = new \Mailjet\Client('6d82e174bf1cb383c2db46d759983e2b','eb3c1c3fc1eda3cc563edafca794fa17',true,['version' => 'v3.1']);

	                try {

	                    $body = [
	                      'Messages' => [
	                        [
	                          'From' => [
	                            'Email' => "wordpress@traveltographer.com",
	                            'Name' => $contactname
	                          ],
	                          'To' => [
	                            [
	                              'Email' => $photographer_email,
	                              'Name' => get_the_title($photographer_id)
	                            ]
	                          ],
	                          'Subject' => $subject,
	                          // 'TextPart' => "My first Mailjet email",
	                          'HTMLPart' => $email_body,
	                          'CustomID' => "AppGettingStartedTest"
	                        ]
	                      ]
	                    ];

	                    $response = $mj->post(Resources::$Email, ['body' => $body]);
	                    // $response->success() && var_dump($response->getData());
	                    return $response->success();

	                    // $postarr = [ 'post_title' => 'email', 'post_content' => son_encode($response->getData()) ];
	                    // wp_insert_post( $postarr );

	                } catch (Exception $e) {
	                    echo "Message could not be sent. Mailer Error: {$mailU->ErrorInfo}";
	                }
}

function send_confirmation_email( $photographer_id, $booking ) {

					$data = json_decode((string) $booking['booking_details'], true);

					$bookingDate = $data['travelt_date'];
					$bookingTime = $data['travelt_time'];

					$photographer_email = get_field('traveltographer_email', $photographer_id);

					// Trigger Email -
					$contactname = 'Traveltographer';
					$subject     = 'Booking Confirmation!';
					$email_body  = '';

					$email_body  .= 'Dear ' . get_the_title($photographer_id) . ', <br><br>';

					$email_body  .= 'Congratulations! Your Booking on ' . $bookingDate . ' at ' . $bookingTime . ' has been confirmed by admin.';

					$email_body  .= '<br><br>Regards,<br>Team Traveltographer.';

					// Sending email to user
			        $mj = new \Mailjet\Client('6d82e174bf1cb383c2db46d759983e2b','eb3c1c3fc1eda3cc563edafca794fa17',true,['version' => 'v3.1']);

	                try {

	                    $body = [
	                      'Messages' => [
	                        [
	                          'From' => [
	                            'Email' => "wordpress@traveltographer.com",
	                            'Name' => $contactname
	                          ],
	                          'To' => [
	                            [
	                              'Email' => $photographer_email,
	                              'Name' => get_the_title($photographer_id)
	                            ]
	                          ],
	                          'Subject' => $subject,
	                          // 'TextPart' => "My first Mailjet email",
	                          'HTMLPart' => $email_body,
	                          'CustomID' => "AppGettingStartedTest"
	                        ]
	                      ]
	                    ];

	                    $response = $mj->post(Resources::$Email, ['body' => $body]);
	                    // $response->success() && var_dump($response->getData());
	                    $response->success();

	                    // $postarr = [ 'post_title' => 'email', 'post_content' => son_encode($response->getData()) ];
	                    // wp_insert_post( $postarr );

	                } catch (Exception $e) {
	                    echo "Message could not be sent. Mailer Error: {$mailU->ErrorInfo}";
	                }

}

function send_confirmation_email_to_customer( $booking ) {

					$data = json_decode((string) $booking['booking_details'], true);

					$bookingDate = $data['travelt_date'];
					$bookingTime = $data['travelt_time'];

					$customer_name = $data['travelt_name'];
					$customer_email = $data['travelt_email'];

					// $photographer_email = get_field('traveltographer_email', $photographer_id);

					// Trigger Email -
					$contactname = 'Traveltographer';
					$subject     = 'Booking Confirmation!';
					$email_body  = '';

					$email_body  .= 'Dear ' . $customer_name . ', <br><br>';

					$email_body  .= 'Your Booking has been confirmed as of ' . $bookingDate . ' at ' . $bookingTime . '. One of our team members will reach out to you for further details shortly.';

					$email_body  .= '<br><br>Regards,<br>Team Traveltographer.';

					// Sending email to user
			        $mj = new \Mailjet\Client('6d82e174bf1cb383c2db46d759983e2b','eb3c1c3fc1eda3cc563edafca794fa17',true,['version' => 'v3.1']);

	                try {

	                    $body = [
	                      'Messages' => [
	                        [
	                          'From' => [
	                            'Email' => "wordpress@traveltographer.com",
	                            'Name' => $contactname
	                          ],
	                          'To' => [
	                            [
	                              'Email' => $customer_email,
	                              'Name' => $customer_name
	                            ]
	                          ],
	                          'Subject' => $subject,
	                          // 'TextPart' => "My first Mailjet email",
	                          'HTMLPart' => $email_body,
	                          'CustomID' => "AppGettingStartedTest"
	                        ]
	                      ]
	                    ];

	                    $response = $mj->post(Resources::$Email, ['body' => $body]);
	                    // $response->success() && var_dump($response->getData());
	                    $response->success();

	                    // $postarr = [ 'post_title' => 'email', 'post_content' => son_encode($response->getData()) ];
	                    // wp_insert_post( $postarr );

	                } catch (Exception $e) {
	                    echo "Message could not be sent. Mailer Error: {$mailU->ErrorInfo}";
	                }

}


function send_email_to_other_photographers( $photographer_id, $booking, $responses ) {

					$data = json_decode((string) $booking['booking_details'], true);

					$bookingDate = $data['travelt_date'];
					$bookingTime = $data['travelt_time'];

					/* $pref_photographer_id = (int) $data['travelt_photographer_id'];

					$cast_pref_type = (array) get_the_terms( $pref_photographer_id, 'photography_types' );

					$pref_typeIDs = array_column($cast_pref_type, 'term_id');

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

						)
					)); */

					// Sending email to user
					$mj = new \Mailjet\Client('6d82e174bf1cb383c2db46d759983e2b','eb3c1c3fc1eda3cc563edafca794fa17',true,['version' => 'v3.1']);

					$contactname = 'Traveltographer';
					$subject     = 'Booking Status!';
					$email_body  = '';

					foreach ( $responses as $key => $response ) :

										if ($photographer_id != $response['id']) :

											$photographer_email = get_field('traveltographer_email', $response['id']);

											$email_body  .= 'Dear ' . get_the_title($response['id']) . ', <br><br>';

											$email_body  .= 'The Booking on ' . $bookingDate . ' at ' . $bookingTime . ' has not been confirmed yet. We will get back to you shortly.';

											$email_body  .= '<br><br>Regards,<br>Team Traveltographer.';

							                try {

							                    $body = [
							                      'Messages' => [
							                        [
							                          'From' => [
							                            'Email' => "wordpress@traveltographer.com",
							                            'Name' => $contactname
							                          ],
							                          'To' => [
							                            [
							                              'Email' => $photographer_email,
							                              'Name' => get_the_title($response['id'])
							                            ]
							                          ],
							                          'Subject' => $subject,
							                          // 'TextPart' => "My first Mailjet email",
							                          'HTMLPart' => $email_body,
							                          'CustomID' => "AppGettingStartedTest"
							                        ]
							                      ]
							                    ];

							                    $response = $mj->post(Resources::$Email, ['body' => $body]);
							                    // $response->success() && var_dump($response->getData());
							                    $response->success();

							                    // $postarr = [ 'post_title' => 'email', 'post_content' => son_encode($response->getData()) ];
							                    // wp_insert_post( $postarr );

							                } catch (Exception $e) {
							                    echo "Message could not be sent. Mailer Error: {$mailU->ErrorInfo}";
							                }

						                endif;


					endforeach;

}

add_filter( 'manage_edit-bookings_columns', 'travelt_booking_columns' );

if ( ! function_exists( 'travelt_booking_columns' ) ) {

		function travelt_booking_columns($columns) {
			$columns = array(
				'cb' 					=> 	  '<input type="checkbox">',
				'title' 				=> __('Booking', 'traveltographer'),
				'xsd' 					=> __('Scheduled Date', 'traveltographer'),
				'xst'  					=> __('Scheduled Time', 'traveltographer'),
				'xph'  					=> __('Photographer', 'traveltographer'),
				// 'date'				=> __('Received', 'traveltographer'),
				'xstat'					=> __('Booking Status', 'traveltographer'),
			);

			return $columns;
		}
}

add_action( 'manage_bookings_posts_custom_column', 'travelt_booking_columns_data', 2, 99 );

if ( ! function_exists( 'travelt_booking_columns_data' ) ) {

		function travelt_booking_columns_data($column, $post_id) {

			global $wpdb;

			$booking = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM tvl_travelt_booking WHERE booking_id = %d", array( $post_id ) ), 'ARRAY_A');

			$customer = json_decode( $booking['booking_details'] );

			$output = ''; $xph = ''; $xstat = '';

			if (get_field('travelt_book_photographer', $post_id)) {
				$xph = get_the_title( get_field('travelt_book_photographer', $post_id) );
			} else {
				$xph = '-';
			}

			if (!get_field('travelt_booking_status', $post_id)) {
				$xstat = 'Open';
			} else {
				if (get_field('travelt_booking_status', $post_id) == 'cancel') {
					$xstat = 'Cancelled';
				}

				if (get_field('travelt_booking_status', $post_id) == 'complete') {
					$xstat = 'Completed';
				}
			}

			switch ($column) {
				case 'xsd':
					$output .= $customer->travelt_date;
					break;
				case 'xst':
					$output .= $customer->travelt_time;
					break;
				case 'xph': // Photographer
					$output .= $xph;
					break;
				case 'xstat': // Booking status
					$output .= $xstat;
					break;
			}

			echo $output;
		}
}

add_action('wp_ajax_load_cities', 'traveltographer_load_cities');
add_action('wp_ajax_nopriv_load_cities', 'traveltographer_load_cities');

if ( ! function_exists( 'traveltographer_load_cities' ) ) {

	function traveltographer_load_cities() {

		global $path;

		check_admin_referer( 'moon-knite', 'nonce' );

		$country = $_POST['id'];

		$json = file_get_contents( $path );

		$jsonData = json_decode($json, true);

		if (absint( $country ) === 4) { // India
			echo json_encode($jsonData[0]['data']);
		}

		if (absint( $country ) === 5) { // Pakistan
			echo json_encode($jsonData[1]['data']);
		}

		if (absint( $country ) === 3) { // UAE
			echo json_encode($jsonData[2]['data']);
		}
		
		die();

	}

}




add_action('wp_ajax_resend_confirmation_email', 'resend_confirmation_email');

if ( ! function_exists( 'resend_confirmation_email' ) ) {

	function resend_confirmation_email() {

		check_admin_referer( 'moon-knite', 'nonce' );

		$id = $_POST['id'];

						$contactname = 'Traveltographer';
						$subject     = 'Action Required: Please confirm your email';
						$email_body  = '';

						$email_body  .= 'Dear ' . get_the_title($id) . ', <br><br>';

						$email_body  .= 'Please confirm your email address by clicking on the link below.<br>';
						$email_body  .= '<a href="' . home_url('/thank-you/') . '?pn=' . $id .'&action=confirm">' . home_url('/thank-you/') . '?p='. $id .'&action=confirm</a>';


						$email_body  .= '<br><br><br>Regards,<br>Team Traveltographer.';


						// Sending email to user
				        $mj = new \Mailjet\Client('6d82e174bf1cb383c2db46d759983e2b','eb3c1c3fc1eda3cc563edafca794fa17',true,['version' => 'v3.1']);

		                try {

		                    $body = [
		                      'Messages' => [
		                        [
		                          'From' => [
		                            'Email' => "wordpress@traveltographer.com",
		                            'Name' => $contactname
		                          ],
		                          'To' => [
		                            [
		                              'Email' => get_field('traveltographer_email', $id),
		                              'Name' => get_the_title($id)
		                            ]
		                          ],
		                          'Subject' => $subject,
		                          // 'TextPart' => "My first Mailjet email",
		                          'HTMLPart' => $email_body,
		                          'CustomID' => "AppGettingStartedTest"
		                        ]
		                      ]
		                    ];

		                    $response = $mj->post(Resources::$Email, ['body' => $body]);
		                    // $response->success() && var_dump($response->getData());
		                    echo $response->success();
		                    die();

		                } catch (Exception $e) {
		                    echo "Message could not be sent. Mailer Error: {$mailU->ErrorInfo}";
		                }

	}

}

add_action('wp_ajax_load_cities_by_country', 'load_cities_by_country');

if ( ! function_exists( 'load_cities_by_country' ) ) {

	function load_cities_by_country() {

		check_admin_referer( 'moon-knite', 'nonce' );

		$options = '<option value="">- Select -</option>';

		$taxnow = 'locations';

		$id = (int) $_POST['id'];

		// $term_name = strtolower(get_term( $id )->name);

		// global $path;
		
		// $json = file_get_contents( $path );

		// $data = json_decode($json, true);

		// $index = array_search($term_name, array_column($data, 'country'));

		if ($id) {
			if( have_rows('travelt_cities', $taxnow . '_' . $id ) ):

						    // Loop through rows.
			    while( have_rows('travelt_cities', $taxnow . '_' . $id ) ) : the_row();

			        // Load sub field value.
			        $city = get_sub_field('travelt_city_q', $taxnow . '_' . $id );
			        // Do something...

			        $options .= '<option value="' . strtolower($city) . '">' . $city . '</option>';	

			    // End loop.
			    endwhile;

			endif;
		}

		// echo json_encode($index);
		// exit;

		echo $options;
		die();


	}

}

/* add_filter( 'pre_insert_term', function ( $term, $taxonomy )
{
    return ( 'locations' === $taxonomy )
        ? new WP_Error( 'term_addition_blocked', __( 'You cannot add terms to this taxonomy' ) )
        : $term;
}, 0, 2 ); */



add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 999 );

function remove_admin_bar_menu() 
{
	global $wp_admin_bar;  
	if ( !current_user_can( 'manage_options' ) ) {
		   $wp_admin_bar->remove_menu('new-content');
	}
}