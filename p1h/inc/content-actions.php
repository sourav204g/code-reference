<?php
/**
 *
 * @package handyman
 */

remove_action( 'welcome_panel', 'wp_welcome_panel' );
add_action('wp_dashboard_setup', 'handyman_pro_remove_dashboard_widgets' );

add_action( 'admin_footer', 'handyman_pro_handyman_custom_dashboard' );
add_action('admin_menu', 'handyman_pro_remove_menus');
add_action('admin_menu', 'handyman_pro_remove_submenus');
add_action('admin_enqueue_scripts', 'handyman_pro_enqueue_scripts');

add_filter('wp_terms_checklist_args','handyman_pro_stop_reordering_categories');
add_filter( 'admin_menu', 'handyman_pro_register_custom_menu_link' );
add_filter( 'plugin_action_links', 'handyman_pro_lock_plugins', 10, 4 );


/**
 * Ajax Calls
 */

add_action('wp_ajax_handyman_load_state', 'handyman_pro_handyman_load_state__add_county');
add_action('wp_ajax_nopriv_handyman_load_state', 'handyman_pro_handyman_load_state__add_county'); 

add_action('wp_ajax_handyman_load_county', 'handyman_pro_handyman_load_county__add_city');
add_action('wp_ajax_nopriv_handyman_load_county', 'handyman_pro_handyman_load_county__add_city');

add_action('wp_ajax_handyman_load_city', 'handyman_pro_handyman_load_city__add_zipcode');
add_action('wp_ajax_nopriv_handyman_load_city', 'handyman_pro_handyman_load_city__add_zipcode');


/**
 * Pro Status Change
 */

add_action( 'transition_post_status', 'handyman_pro_pros_status', 10, 3 );
add_action( 'delete_post', 'handyman_pro_pros_delete' );


require get_template_directory() . '/inc/content-zipcode.php';

/**
 * Implement the Content Action feature.
 */