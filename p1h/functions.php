<?php
/**
 * handyman pro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package handyman_pro
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'inc/vendor/autoload.php';

require 'vendor/autoload.php';
use \Mailjet\Resources;

add_filter('use_block_editor_for_post', '__return_false');

if ( ! function_exists( 'handyman_pro_setup' ) ) :
	
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function handyman_pro_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on handyman pro, use a find and replace
		 * to change 'handyman_pro' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'handyman_pro', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'handyman_pro' ),
			'menu-2' => esc_html__( 'Secondary', 'handyman_pro' ),
			'menu-3' => esc_html__( 'Tertiary', 'handyman_pro' ),
			'menu-4' => esc_html__( 'Quaternary', 'handyman_pro' ),
			'menu-6' => esc_html__( 'Category Menu', 'handyman_pro' ),
			'menu-5' => esc_html__( 'Mobile Menu', 'handyman_pro' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'handyman_pro_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'handyman_pro_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function handyman_pro_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'handyman_pro_content_width', 640 );
}
add_action( 'after_setup_theme', 'handyman_pro_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function handyman_pro_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'handyman_pro' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'handyman_pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'handyman_pro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function handyman_pro_scripts() {
	
	wp_enqueue_style( 'handyman_pro-style', get_stylesheet_uri() );

	wp_enqueue_script( 'handyman_pro-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'handyman_pro-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('autocomplete', get_stylesheet_directory_uri().'/assets/js/jquery.auto-complete.js', array('jquery'));

	wp_enqueue_script( 'handyman_lscript', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '20190810', true );

	// localizing script
	wp_localize_script( 'handyman_lscript', 'handymanx_fnt', 
		array( 
		'root' => get_site_url() , 
		'ajaxurl' => admin_url( 'admin-ajax.php' ) ,
		'nonce' => wp_create_nonce('avengers-end-game')
		) 
	);


}

add_action( 'wp_enqueue_scripts', 'handyman_pro_scripts' );

/**
 * Implement the Content Render feature.
 */
require get_template_directory() . '/inc/content-render.php';

/**
 * Implement the Content Action feature.
 */
require get_template_directory() . '/inc/content-actions.php';

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

add_action( 'init', 'handyman_pro_service_post_type'  );
add_action( 'init', 'handyman_pro_product_post_type'  );
// add_action( 'init', 'handyman_pro_product_post_type'  ); // delete if not needed
add_action( 'init', 'handyman_pro_service_categories' );
add_action( 'init', 'handyman_pro_product_categories' );
add_action( 'init', 'handyman_pro_service_groups' );
add_action( 'init', 'handyman_pro_product_groups' );
add_filter( 'manage_edit-services_columns', 'handyman_pro_service_columns' );
add_action( 'manage_services_posts_custom_column', 'handyman_pro_service_columns_data', 2, 99 );
add_filter( 'manage_edit-products_columns', 'handyman_pro_product_columns' );
add_action( 'manage_products_posts_custom_column', 'handyman_pro_product_columns_data', 2, 99 );
add_filter('gettext','handyman_pro_service_custom_enter_title');


if ( ! function_exists( 'handyman_pro_service_custom_enter_title' ) ) {

		function handyman_pro_service_custom_enter_title( $input ) {

		    global $post_type;

		    	if( is_admin() && 'Enter title here' == $input && 'services' == $post_type )
		        return 'Enter Service Name';

		    return $input;
		}
		
}

if ( ! function_exists( 'handyman_pro_service_post_type' ) ) {

		function handyman_pro_service_post_type() {
			
				$labels = array(
					"name" => __( 'Services', 'handyman_pro' ),
					"singular_name" => __( 'Service', 'handyman_pro' ),
					'add_new'				=> __( 'Add New' , 'handyman_pro' ),
				    'add_new_item'			=> __( 'Add New Service' , 'handyman_pro' ),
				    'edit_item'				=> __( 'Edit Service' , 'handyman_pro' ),
				    'new_item'				=> __( 'New Service' , 'handyman_pro' ),
				    'view_item'				=> __( 'View Service', 'handyman_pro' ),
				    'search_items'			=> __( 'Search Services', 'handyman_pro' ),
				    'not_found'				=> __( 'No Services found', 'handyman_pro' ),
				    'not_found_in_trash'	=> __( 'No Services found in Trash', 'handyman_pro' ), 
				);

				$args = array(

					"label" => __( 'Services', 'handyman_pro' ),
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
					"rewrite" => array( "slug" => "services", "with_front" => true ),
					"query_var" => true,
					"menu_icon" => 'dashicons-tagcloud', 
					"supports" => array( "title", "editor", "thumbnail" ),

					);

				register_post_type( "services", $args );

		}

}


if ( ! function_exists( 'handyman_pro_product_post_type' ) ) {

		function handyman_pro_product_post_type() {
			
				$labels = array(
					"name" => __( 'Products', 'handyman_pro' ),
					"singular_name" => __( 'Product', 'handyman_pro' ),
					'add_new'				=> __( 'Add New' , 'handyman_pro' ),
				    'add_new_item'			=> __( 'Add New Product' , 'handyman_pro' ),
				    'edit_item'				=> __( 'Edit Product' , 'handyman_pro' ),
				    'new_item'				=> __( 'New Product' , 'handyman_pro' ),
				    'view_item'				=> __( 'View Product', 'handyman_pro' ),
				    'search_items'			=> __( 'Search Products', 'handyman_pro' ),
				    'not_found'				=> __( 'No Products found', 'handyman_pro' ),
				    'not_found_in_trash'	=> __( 'No Products found in Trash', 'handyman_pro' ), 
				);

				$args = array(

					"label" => __( 'Products', 'handyman_pro' ),
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
					"rewrite" => array( "slug" => "products", "with_front" => true ),
					"query_var" => true,
					"menu_icon" => 'dashicons-carrot', 
					"supports" => array( "title", "editor", "thumbnail" ),

					);

				register_post_type( "products", $args );

		}

}


if ( ! function_exists( 'handyman_pro_service_categories' ) ) {

	function handyman_pro_service_categories() {

		$labels = array(

				    'name'                          => 'Service Categories',
				    'singular_name'                 => 'Service Category',
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
				    'label'                         => 'Service Categories',
				    'labels'                        => $labels,
				    'public'                        => true,
				    'hierarchical'                  => true,
				    'show_ui'                       => true,
				    'show_in_nav_menus'             => true,
				    'args'                          => array( 'orderby' => 'term_order' ),
				    'rewrite'                       => array( 'slug' => 'service-categories', 'with_front' => true, 'hierarchical' => true ),
				    'query_var'                     => true
				);

		register_taxonomy( 'service_categories', array('services', 'pros'), $args );
	}
}


if ( ! function_exists( 'handyman_pro_product_categories' ) ) {

	function handyman_pro_product_categories() {

		$labels = array(

				    'name'                          => 'Product Categories',
				    'singular_name'                 => 'Product Category',
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
				    'label'                         => 'Product Categories',
				    'labels'                        => $labels,
				    'public'                        => true,
				    'hierarchical'                  => true,
				    'show_ui'                       => true,
				    'show_in_nav_menus'             => true,
				    'args'                          => array( 'orderby' => 'term_order' ),
				    'rewrite'                       => array( 'slug' => 'product-categories', 'with_front' => true, 'hierarchical' => true ),
				    'query_var'                     => true
				);

		register_taxonomy( 'product_categories', array('products'), $args );
	}
}

if ( ! function_exists( 'handyman_pro_service_groups' ) ) {

	function handyman_pro_service_groups() {

		$labels = array(

				    'name'                          => 'Service Groups',
				    'singular_name'                 => 'Service Group',
				    'search_items'                  => 'Search Service Groups',
				    'popular_items'                 => 'Popular Service Groups',
				    'all_items'                     => 'All Service Groups',
				    'parent_item'                   => 'Parent Service Group',
				    'edit_item'                     => 'Edit Service Group',
				    'update_item'                   => 'Update Service Group',
				    'add_new_item'                  => 'Add New Service Group',
				    'new_item_name'                 => 'New Service Group',
				    'separate_items_with_commas'    => 'Separate Service Groups with commas',
				    'add_or_remove_items'           => 'Add or remove Service Group',
				    'choose_from_most_used'         => 'Choose from most used Service Groups'
				);

		$args = array(
				    'label'                         => 'Service Groups',
				    'labels'                        => $labels,
				    'public'                        => true,
				    'hierarchical'                  => true,
				    'show_ui'                       => true,
				    'show_in_nav_menus'             => true,
				    'args'                          => array( 'orderby' => 'term_order' ),
				    'rewrite'                       => array( 'slug' => 'service-group', 'with_front' => true, 'hierarchical' => true ),
				    'query_var'                     => true
				);

		register_taxonomy( 'service_group', array('services'), $args );
	}
}


if ( ! function_exists( 'handyman_pro_product_groups' ) ) {

	function handyman_pro_product_groups() {

		$labels = array(

				    'name'                          => 'Product Groups',
				    'singular_name'                 => 'Product Group',
				    'search_items'                  => 'Search Product Groups',
				    'popular_items'                 => 'Popular Product Groups',
				    'all_items'                     => 'All Product Groups',
				    'parent_item'                   => 'Parent Product Group',
				    'edit_item'                     => 'Edit Product Group',
				    'update_item'                   => 'Update Product Group',
				    'add_new_item'                  => 'Add New Product Group',
				    'new_item_name'                 => 'New Product Group',
				    'separate_items_with_commas'    => 'Separate Product Groups with commas',
				    'add_or_remove_items'           => 'Add or remove Product Group',
				    'choose_from_most_used'         => 'Choose from most used Product Groups'
				);

		$args = array(
				    'label'                         => 'Product Groups',
				    'labels'                        => $labels,
				    'public'                        => true,
				    'hierarchical'                  => true,
				    'show_ui'                       => true,
				    'show_in_nav_menus'             => true,
				    'args'                          => array( 'orderby' => 'term_order' ),
				    'rewrite'                       => array( 'slug' => 'product-group', 'with_front' => true, 'hierarchical' => true ),
				    'query_var'                     => true
				);

		register_taxonomy( 'product_group', array('products'), $args );
	}
}


if ( ! function_exists( 'handyman_pro_service_columns' ) ) {

		function handyman_pro_service_columns($columns) {
			$columns = array(
				'cb' 					=> 	  '<input type="checkbox">',
				'title' 				=> __('Service Name', 'handyman_pro'),
				'xtype' 				=> __('Type', 'handyman_pro'),
				'xcat'  				=> __('Categories', 'handyman_pro'),
				'xgrp'  				=> __('Group', 'handyman_pro'),
				'date'					=> __('Date', 'handyman_pro'),
			);

			return $columns;
		}
}

if ( ! function_exists( 'handyman_pro_service_columns_data' ) ) {

		function handyman_pro_service_columns_data($column, $post_id) {

			$output = ''; $listedIn = ''; $grpListedIn = '';

			if(!empty(get_the_terms( $post_id, 'service_categories' ))) {

				foreach (get_the_terms( $post_id, 'service_categories' ) as $key => $category) {
					$listedIn .= $category->name . ', ';
				}

				$listedIn = trim($listedIn, ', ');

			}

			if(!empty(get_the_terms( $post_id, 'service_group' ))) {

				foreach (get_the_terms( $post_id, 'service_group' ) as $key => $category) {
					$grpListedIn .= $category->name . ' - ID:' . $category->term_id . ', ';
				}

				$grpListedIn = trim($grpListedIn, ', ');

			}

			if(get_field('handyman_type_of_service', $post_id)) {
				$xtype_val = get_field('handyman_type_of_service', $post_id);
			} else {
				$xtype_val = '';
			} 

			switch ($column) {
				case 'xtype':
					$output .= $xtype_val;
					break;
				case 'xcat':
					$output .= $listedIn;
					break;
				case 'xgrp':
					$output .= $grpListedIn;
					break;
			}

			echo $output;
		}
}


if ( ! function_exists( 'handyman_pro_product_columns' ) ) {

		function handyman_pro_product_columns($columns) {
			$columns = array(
				'cb' 					=> 	  '<input type="checkbox">',
				'title' 				=> __('Product Name', 'handyman_pro'),
				'xsku' 				=> __('SKU', 'handyman_pro'),
				'xtype' 				=> __('Type', 'handyman_pro'),
				'xcat'  				=> __('Categories', 'handyman_pro'),
				'xgroup'  				=> __('Group', 'handyman_pro'),
				'date'					=> __('Date', 'handyman_pro'),
			);

			return $columns;
		}
}

if ( ! function_exists( 'handyman_pro_product_columns_data' ) ) {

		function handyman_pro_product_columns_data($column, $post_id) {

			$output = ''; $listedIn = ''; $grp = ''; $sku = '';

			if(!empty(get_the_terms( $post_id, 'product_categories' ))) {

				foreach (get_the_terms( $post_id, 'product_categories' ) as $key => $category) {
					$listedIn .= $category->name . ', ';
				}

				$listedIn = trim($listedIn, ', ');

			}

			if( get_field('handyman_prod_sku', $post_id) ) {

				$sku = get_field('handyman_prod_sku', $post_id);
			}

			if( get_field('handyman_product_link_to_services', $post_id) ) {

				$type = '';

				foreach ( get_field('handyman_product_link_to_services', $post_id) as $key => $linked_service ) {
					$serviceID = $linked_service['handyman_product_link_to_service'];
					$type .= ucfirst(get_field('handyman_type_of_service', $serviceID)) . ', ';
				}
				
			}

			if(!empty(get_the_terms( $post_id, 'product_group' ))) {

				foreach (get_the_terms( $post_id, 'product_group' ) as $key => $category) {
					$grp .= $category->name . ' - ID:' . $category->term_id . ', ';
				}

				$grp = trim($grp, ', ');

			}

			switch ($column) {
				case 'xsku':
					$output .= rtrim($sku, ', ');
					break; 
				case 'xtype':
					$output .= rtrim($type, ', ');
					break; 
				case 'xcat':
					$output .= $listedIn;
					break;
				case 'xgroup':
					$output .= $grp;
					break;
			}

			echo $output;
		}
}


// Loader
add_action( 'in_admin_header', function() {

	global $current_screen;

	// var_dump($current_screen);
	// exit();

	echo '<style>a.toplevel_page_zipcode-settings div.dashicons-admin-generic:before { content: "\f109" !important; } </style>';

	if( $current_screen->id === 'toplevel_page_zipcode-settings' || $current_screen->id === 'add-zipcode_page_acf-options-add-city' || $current_screen->id === 'add-zipcode_page_acf-options-add-county' || $current_screen->id === 'add-zipcode_page_acf-options-add-state' || $current_screen->id === 'add-zipcode_page_acf-options-add-country' || $current_screen->id === 'dashboard' ) {

		echo '<style> #wpcontent { height: 100vh; } </style>';
		echo '<div class="loader_container"><div class="handyman_loader"></div></div>'; 
	}


} );

/* ============================================================================= */

add_action( 'init', 'handyman_pro_pros_post_type'  );

if ( ! function_exists( 'handyman_pro_pros_post_type' ) ) {

		function handyman_pro_pros_post_type() {
			
				$labels = array(
					"name" => __( 'Pros', 'handyman_pro' ),
					"singular_name" => __( 'Pro', 'handyman_pro' ),
					'add_new'				=> __( 'Add New' , 'handyman_pro' ),
				    'add_new_item'			=> __( 'Add New Pro' , 'handyman_pro' ),
				    'edit_item'				=> __( 'Edit Pro' , 'handyman_pro' ),
				    'new_item'				=> __( 'New Pro' , 'handyman_pro' ),
				    'view_item'				=> __( 'View Pro', 'handyman_pro' ),
				    'search_items'			=> __( 'Search Pros', 'handyman_pro' ),
				    'not_found'				=> __( 'No Pros found', 'handyman_pro' ),
				    'not_found_in_trash'	=> __( 'No Pros found in Trash', 'handyman_pro' ), 
				);

				$args = array(

					"label" => __( 'Pros', 'handyman_pro' ),
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
					"rewrite" => array( "slug" => "pros", "with_front" => true ),
					"query_var" => true,
					"menu_icon" => 'dashicons-businessman', 
					"supports" => array( "title", "editor", "thumbnail" ),

					);

				register_post_type( "pros", $args );

		}

}



add_action( 'add_meta_boxes_pros', 'handyman_pro_change_pro_category_title', 10, 1);

function handyman_pro_change_pro_category_title($post)  {

		global $wp_meta_boxes;

		// echo '<pre>';
		// print_r($wp_meta_boxes);
		// exit();

		unset( $wp_meta_boxes['pros']['side']['core']['service_categoriesdiv'] );

		add_meta_box('service_categoriesdiv', __('Skills'), 'post_categories_meta_box', 'pros', 'side', 'low', array('taxonomy' => 'service_categories') );

}

// add_action( 'init', 'handyman_pro_customer_post_type'  );

if ( ! function_exists( 'handyman_pro_customer_post_type' ) ) {

		function handyman_pro_customer_post_type() {
			
				$labels = array(
					"name" => __( 'Customers', 'handyman_pro' ),
					"singular_name" => __( 'Customer', 'handyman_pro' ),
					'add_new'				=> __( 'Add New' , 'handyman_pro' ),
				    'add_new_item'			=> __( 'Add New Customer' , 'handyman_pro' ),
				    'edit_item'				=> __( 'Edit Customer' , 'handyman_pro' ),
				    'new_item'				=> __( 'New Customer' , 'handyman_pro' ),
				    'view_item'				=> __( 'View Customer', 'handyman_pro' ),
				    'search_items'			=> __( 'Search Customers', 'handyman_pro' ),
				    'not_found'				=> __( 'No Customers found', 'handyman_pro' ),
				    'not_found_in_trash'	=> __( 'No Customers found in Trash', 'handyman_pro' ), 
				);

				$args = array(

					"label" => __( 'Customers', 'handyman_pro' ),
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
					"rewrite" => array( "slug" => "customers", "with_front" => true ),
					"query_var" => true,
					"menu_icon" => 'dashicons-groups', 
					"supports" => array( "title", "editor", "thumbnail" ),

					);

				register_post_type( "customers", $args );

		}

}


add_filter('acf/location/rule_match/taxonomy', 'handyman_pro_acf_location_rules_match_taxonomy', 20, 3);

if ( ! function_exists( 'handyman_pro_acf_location_rules_match_taxonomy' ) ) {
	function handyman_pro_acf_location_rules_match_taxonomy($match, $rule, $options) {

	  if ($rule['param'] == 'taxonomy' && !isset($_GET['tag_ID'])) {
	    // if the rule is for taxonomy but $_GET['tag_ID'] is not set
	    // then this is the main taxonomy page and not a term page
	    // set match to false
	    $match = false;
	  }
	  
	  return $match;
	}
}


add_action( 'admin_init', 'handyman_pro_pros_restrictions' );

function handyman_pro_pros_restrictions() {

	global $current_user;

	if ( is_user_logged_in() ) { 

		$role = ( array ) $current_user->roles;

		if( $role[0] === 'subscriber' && is_admin() ) {
			wp_redirect( get_home_url() , 302 );
		}
		
	}

}

function  handyman_pro_remove_toolbar_node($wp_admin_bar) {

	global $current_user;

	if ( is_user_logged_in() && !current_user_can( 'manage_options' )) { 

			$wp_admin_bar->remove_node('wp-logo');
			$wp_admin_bar->remove_node('site-name');
			$wp_admin_bar->remove_node('search');
	}
	
}

add_action('admin_bar_menu', 'handyman_pro_remove_toolbar_node', 999);

function handyman_pro_enqueue_zipcode() {

	if ( is_page(400) || is_page(401) || is_singular('services') || is_page(503) ) { // Manage zipcode Page

		$zipcodes = array( 
			'zipcode' => json_encode( get_field('handyman_manage_zipcode', 'option') ) 
		);

		$zipcodes['root'] = get_site_url();
		$zipcodes['nonce'] = wp_create_nonce('deadpool-2');

	    wp_enqueue_script( "zipcodescript", get_template_directory_uri() . "/assets/js/zipcode.js", array('jquery'), '180720', true );

	    wp_localize_script( "zipcodescript", "zipobg", $zipcodes );
	}
 
}

add_action( "wp_enqueue_scripts", "handyman_pro_enqueue_zipcode" );

// Delete Zipcode - Pro
function handyman_pro_delete_zipcode() {

	check_ajax_referer( 'deadpool-2', 'security' );

	session_start();

	$pros_selected_zipcodes = get_field('pro_working_zipcodes', $_SESSION['posttype_pro_id']);

	
	$prozip_key = array_search($_POST['data'], array_column($pros_selected_zipcodes, 'pro_zipcode'));

	unset($pros_selected_zipcodes[$prozip_key]);

	update_field( 'pro_working_zipcodes', $pros_selected_zipcodes , $_SESSION['posttype_pro_id']);
	echo 'Zipcode: ' . $_POST['data'] . ' removed.';
	die();

}

add_action('wp_ajax_deletezipcode', 'handyman_pro_delete_zipcode');
add_action('wp_ajax_nopriv_deletezipcode', 'handyman_pro_delete_zipcode');

// Add Time - Pro
function handyman_pro_add_schedule_time() {

	check_ajax_referer( 'deadpool-2', 'security' );

	session_start();

	$pro_schedule_times = get_field('pro_schedule_time', $_SESSION['posttype_pro_id']);

	$index = count($pro_schedule_times);

	$timeData = explode('-', $_POST['data']);


	foreach ($pro_schedule_times as $key => $_time ) {

		$current_start = DateTime::createFromFormat('H:i a', $timeData[0]);
		$current_end = DateTime::createFromFormat('H:i a', $timeData[1]);
		$old_start = DateTime::createFromFormat('H:i a', $_time['pro_schedule_time_from']);
		$old_end = DateTime::createFromFormat('H:i a', $_time['pro_schedule_time_to']);

		if ( ($old_start <= $current_end) && ($old_end > $current_start) ) {
		    $conflict = 1;
		}

	}

	if(isset($conflict) && $conflict === 1) {
		echo 0;
	} else {

		$pro_schedule_times[$index]['pro_schedule_time_from'] = sanitize_text_field($timeData[0]);
		$pro_schedule_times[$index]['pro_schedule_time_to'] = sanitize_text_field($timeData[1]);

		update_field( 'pro_schedule_time', $pro_schedule_times , $_SESSION['posttype_pro_id']);
		echo json_encode($pro_schedule_times[$index]);
	}

	die();

}

add_action('wp_ajax_addtimeschedule', 'handyman_pro_add_schedule_time');
add_action('wp_ajax_nopriv_addtimeschedule', 'handyman_pro_add_schedule_time');


// Delete Schedule Time - Pro
function handyman_pro_delete_timeschedule() {

	check_ajax_referer( 'deadpool-2', 'security' );

	session_start();

	// print_r($_POST);

	$pro_schedule_times = get_field('pro_schedule_time', $_SESSION['posttype_pro_id']);

	$protime_key = (int) $_POST['data']['index'];

	unset($pro_schedule_times[$protime_key]);

	update_field( 'pro_schedule_time', $pro_schedule_times , $_SESSION['posttype_pro_id']);
	echo 'Time: ' . $_POST['data']['value'] . ' removed.';
	die();

}

add_action('wp_ajax_deletetimeschedule', 'handyman_pro_delete_timeschedule');
add_action('wp_ajax_nopriv_deletetimeschedule', 'handyman_pro_delete_timeschedule');

// Excerpt
add_filter('excerpt_length', 'handyman_pro_excerpt_length', 999);
function handyman_pro_excerpt_length($length) { return 15; }

function handyman_pro_excerpt_more($more) { 
	global $post;
	// return '... <a class="moretag" href="'. get_permalink($post->ID) . '"> continue reading &raquo;</a>';
	return ':';
}
add_filter('excerpt_more', 'handyman_pro_excerpt_more');

/* Booking posttype */
add_action( 'init', 'handyman_pro_booking_post_type'  );

if ( ! function_exists( 'handyman_pro_booking_post_type' ) ) {

		function handyman_pro_booking_post_type() {
			
				$labels = array(
					"name" => __( 'Bookings', 'handyman_pro' ),
					"singular_name" => __( 'Booking', 'handyman_pro' ),
					'add_new'				=> __( 'Add New' , 'handyman_pro' ),
				    'add_new_item'			=> __( 'Add New Booking' , 'handyman_pro' ),
				    'edit_item'				=> __( 'Edit Booking' , 'handyman_pro' ),
				    'new_item'				=> __( 'New Booking' , 'handyman_pro' ),
				    'view_item'				=> __( 'View Booking', 'handyman_pro' ),
				    'search_items'			=> __( 'Search Bookings', 'handyman_pro' ),
				    'not_found'				=> __( 'No Bookings found', 'handyman_pro' ),
				    'not_found_in_trash'	=> __( 'No Bookings found in Trash', 'handyman_pro' ), 
				);

				$args = array(

					"label" => __( 'Bookings', 'handyman_pro' ),
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
					"rewrite" => array( "slug" => "bookings", "with_front" => true ),
					"query_var" => true,
					"menu_icon" => 'dashicons-admin-home', 
					"supports" => array( "title" ), // "editor", "thumbnail"

					);

				register_post_type( "bookings", $args );

		}

}

/* Featured service listing options */
/* add_filter('acf/load_field/name=hnd_featured_listing', 'featured_service_categories_choices');

if ( !function_exists( 'featured_service_categories_choices' ) ) {

	function featured_service_categories_choices( $field ) {
	    
	    // Reset choices
	    $field['choices'] = array();

	   $service_categories = get_terms( array( 

			'taxonomy' => 'service_categories',
			'hide_empty' => false,

		) );

	   foreach ( $service_categories as $key => $service_category ) {
	   		  $field['choices'][ $service_category->term_id ] = $service_category->name;
	   }

	   // return the field
       return $field;
	    
	}

} */


add_filter('acf/load_field/name=handyman_product_link_to_service', 'handyman_product_link_to_service'); // Note: Minor Issue - This is creating layout problem on ACF congiguration page - so comment it out while working and uncomment it when work is done. 

if ( !function_exists( 'handyman_product_link_to_service' ) ) {

	function handyman_product_link_to_service( $field ) {
	    
	   // Reset choices
	   $field['choices'] = array();


		$service_categories = get_terms( array( 

			'taxonomy' => 'service_categories',
			'hide_empty' => false, // Remove Comment to Display all categories

		) );

		$child_service_categories = array();

	   foreach ( $service_categories as $key => $service_categor ) {

	   		 if($service_categor->parent !== 0 ) {

	   		  	// $child_service_categories[$key]['term_id']  = $service_categor->term_id;
	   		  	// $child_service_categories[$key]['name'] 	= $service_categor->name;

	   		  	$argsx = array(

			        'posts_per_page' => -1,
			        'post_type' => 'services',
			        'post_status' => array('draft', 'publish'),
			        'tax_query' => array(

			            array (

			                'taxonomy' => 'service_categories',
			                'field' => 'term_id',
			                'terms' => $service_categor->term_id,
			            ),

			        )
				);

	   		  	$the_query = new WP_Query( $argsx );

	   		  	foreach ($the_query->posts as $key => $servc_item ) {

	   		  		if($servc_item->post_status !== 'draft') {
	   		  			$field['choices'][ $service_categor->name ][ $servc_item->ID ] = $servc_item->post_title . ' [ID: ' . $servc_item->ID . '] ' . ' - ' . get_field('handyman_type_of_service', $servc_item->ID);
	   		  		} else {
	   		  			$field['choices'][ $service_categor->name ][ $servc_item->ID ] = $servc_item->post_title . ' [DRAFT] ';
	   		  		}

	   		  		// var_dump($servc_item );
	   		  		
	   		  	}



	   		  } // if($service_categor->parent !== 0 )
	   }



	   // return the field
       return $field;
	    
	}

}

// REF - https://wordpress.org/plugins/require-post-category/

/* Booking Custom Custom Field */
function handyman_register_meta_boxes() {

	global $post;

	if(!isset($post)) return;

	if($post->post_status !== 'publish'){
        return; // REF - https://wordpress.stackexchange.com/questions/156603/show-meta-box-only-when-post-is-being-published-first-time
    }

    add_meta_box( 'handyman-booking-box-id', 
    			__( 'Booking Details', 'handyman_pro' ), 
    			'handyman_booking_details_callback', 
    			'bookings',
    			'normal',
    			'high'
   	);


}


add_action( 'add_meta_boxes', 'handyman_register_meta_boxes' );

require get_template_directory() . '/inc/content-booking.php';

// Add Tools Inventory
add_filter('acf/load_field/name=hnd_reschedule_handyman', 'handyman_pro_load_reschedule_handyman_choices');

if ( ! function_exists( 'handyman_pro_load_reschedule_handyman_choices' ) ) {

	function handyman_pro_load_reschedule_handyman_choices( $field ) {
	    
	    // reset choices
	    $field['choices'] = array();

	    $the_query = new WP_Query(array(

			'post_type' => 'pros',
			'posts_per_page' => -1,
			'post_status' => 'publish'

		));

		foreach ( $the_query->get_posts() as $key => $indivisual_pro ) {
			$field['choices'][ $indivisual_pro->ID ] = $indivisual_pro->post_title;
		}
	   
	    // return the field
	    return $field;
	    
	}

}

/* booking columns and its datas */
add_filter( 'manage_edit-bookings_columns', 'handyman_pro_booking_columns' );
add_action( 'manage_bookings_posts_custom_column', 'handyman_pro_booking_columns_data', 2, 99 );

if ( ! function_exists( 'handyman_pro_booking_columns' ) ) {

		function handyman_pro_booking_columns($columns) {
			$columns = array(
				'cb' 					=> 	  '<input type="checkbox">',
				'title' 				=> __('Booking For', 'handyman_pro'),
				'customer_name'  		=> __('Customer Name', 'handyman_pro'),
				'customer_phone' 		=> __('Customer Phone', 'handyman_pro'),
				'handyman_name' 		=> __('Pro Name', 'handyman_pro'),
				'booking_status' 		=> __('Status', 'handyman_pro'),
				// 'date'		=> __('Date', 'handyman_pro'),
			);

			return $columns;
		}
}

if ( ! function_exists( 'handyman_pro_booking_columns_data' ) ) {

		function handyman_pro_booking_columns_data($column, $post_id) {

			$output = '';

			global $wpdb;

			$bookingDetails = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM hxp_handyman_booking WHERE booking_id = %s", array( $post_id ) ), 'ARRAY_A');

			$unserialized_scheduled_address = unserialize(base64_decode($bookingDetails['scheduled_address']));

			$handyman_name 					= get_post($bookingDetails['handyman_id'])->post_title;
			$scheduled_date_strtotime 		= strtotime( $bookingDetails['scheduled_date'] );
			$scheduled_date 				= date('F j, Y', $scheduled_date_strtotime);

			switch ($column) {
				case 'title':
					$output .= $scheduled_date;
					break;

				case 'customer_name':
					$output .= $unserialized_scheduled_address['hnd_customer_name'];
					break;

				case 'customer_phone':
					$output .= $bookingDetails['customer_phone'];
					break;

				case 'handyman_name':
					$output .= $handyman_name;
					break;

				case 'booking_status':
					$output .= ucfirst(get_field( 'hnd_booking_status', $post_id));
					break;
			}

			echo $output;
		}
}

/* Services Choices - Booking */
add_filter('acf/load_field/name=handyman_booking_service', 'handyman_booking_service'); // Note: Minor Issue - This is creating layout problem on ACF congiguration page - so comment it out while working and uncomment it when work is done. 

if ( !function_exists( 'handyman_booking_service' ) ) {

	function handyman_booking_service( $field ) {
	    
	   // Reset choices
	   $field['choices'] = array();


		$service_categories = get_terms( array( 

			'taxonomy' => 'service_categories',
			'hide_empty' => false, // Remove Comment to Display all categories

		) );

		$child_service_categories = array();

	   foreach ( $service_categories as $key => $service_categor ) {

	   		 if($service_categor->parent !== 0 ) {

	   		  	// $child_service_categories[$key]['term_id']  = $service_categor->term_id;
	   		  	// $child_service_categories[$key]['name'] 	= $service_categor->name;

	   		  	$argsx = array(

			        'posts_per_page' => -1,
			        'post_type' => 'services',
			        'tax_query' => array(

			            array (

			                'taxonomy' => 'service_categories',
			                'field' => 'term_id',
			                'terms' => $service_categor->term_id,
			            ),

			        )
				);

	   		  	$the_query = new WP_Query( $argsx );

	   		  	foreach ($the_query->posts as $key => $servc_item ) {
	   		  		$field['choices'][ $service_categor->name ][ $servc_item->ID ] = $servc_item->post_title . ' - ' . get_field('handyman_type_of_service', $servc_item->ID);
	   		  	}



	   		  } // if($service_categor->parent !== 0 )
	   }



	   // return the field
       return $field;
	    
	}

}

/* Services Choices - Booking */
add_filter('acf/load_field/name=handyman_booking_product_link_to_service', 'handyman_booking_product_link_to_service'); // Note: Minor Issue - This is creating layout problem on ACF congiguration page - so comment it out while working and uncomment it when work is done. 

if ( !function_exists( 'handyman_booking_product_link_to_service' ) ) {

	function handyman_booking_product_link_to_service( $field ) {
	    
	   // Reset choices
	   $field['choices'] = array();


		$service_categories = get_terms( array( 

			'taxonomy' => 'service_categories',
			'hide_empty' => false, // Remove Comment to Display all categories

		) );

		$child_service_categories = array();

	   foreach ( $service_categories as $key => $service_categor ) {

	   		 if($service_categor->parent !== 0 ) {

	   		  	// $child_service_categories[$key]['term_id']  = $service_categor->term_id;
	   		  	// $child_service_categories[$key]['name'] 	= $service_categor->name;

	   		  	$argsx = array(

			        'posts_per_page' => -1,
			        'post_type' => 'services',
			        'tax_query' => array(

			            array (

			                'taxonomy' => 'service_categories',
			                'field' => 'term_id',
			                'terms' => $service_categor->term_id,
			            ),

			        )
				);

	   		  	$the_query = new WP_Query( $argsx );

	   		  	foreach ($the_query->posts as $key => $servc_item ) {
	   		  		$field['choices'][ $service_categor->name ][ $servc_item->ID ] = $servc_item->post_title . ' - ' . get_field('handyman_type_of_service', $servc_item->ID);
	   		  	}



	   		  } // if($service_categor->parent !== 0 )
	   }



	   // return the field
       return $field;
	    
	}

}

/* Product Choices - Booking */
add_filter('acf/load_field/name=handyman_booking_product', 'handyman_booking_product'); // Note: Minor Issue - This is creating layout problem on ACF congiguration page - so comment it out while working and uncomment it when work is done. 

if ( !function_exists( 'handyman_booking_product' ) ) {

	function handyman_booking_product( $field ) {
	    
	   // Reset choices
	   $field['choices'] = array();


		$service_categories = get_terms( array( 

			'taxonomy' => 'product_categories',
			'hide_empty' => false, // Remove Comment to Display all categories

		) );

		$child_service_categories = array();

	   foreach ( $service_categories as $key => $service_categor ) {

	   		 if($service_categor->parent !== 0 ) {

	   		  	// $child_service_categories[$key]['term_id']  = $service_categor->term_id;
	   		  	// $child_service_categories[$key]['name'] 	= $service_categor->name;

	   		  	$argsx = array(

			        'posts_per_page' => -1,
			        'post_type' => 'products',
			        'tax_query' => array(

			            array (

			                'taxonomy' => 'product_categories',
			                'field' => 'term_id',
			                'terms' => $service_categor->term_id,
			            ),

			        )
				);

	   		  	$the_query = new WP_Query( $argsx );

	   		  	foreach ($the_query->posts as $key => $servc_item ) {
	   		  		$field['choices'][ $service_categor->name ][ $servc_item->ID ] = $servc_item->post_title;
	   		  	}



	   		  } // if($service_categor->parent !== 0 )
	   }

	   // return the field
       return $field;
	    
	}

}


	// $bookingDetails = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM hxp_handyman_booking WHERE booking_id = %s", array( '950' ) ), 'ARRAY_A');

	// var_dump($bookingDetails);
	// exit;

	// $unserialized = unserialize(base64_decode($bookingDetails['selected_product']));
	// echo '<pre>';
	// var_dump($unserialized);
	// exit;



/* Upon Publish - Booking */
function handyman_action_publish_booking( $new_status, $old_status, $post ) {
    
	if ( $post->post_type !== 'bookings' ) return;

	if ( $old_status == 'auto-draft' && $new_status == 'publish'  || $old_status == 'draft' && $new_status == 'publish' ) {

		 global $wpdb;

	     $customer_phone = sanitize_text_field( $_POST['acf']['field_5c67bf5b8e163'] );
	     $customer_email = sanitize_text_field( $_POST['acf']['field_5c67bf3f8e162'] );

	     $scheduled_address = array(

		     	  'hnd_customer_name' => sanitize_text_field( $_POST['acf']['field_5c67bf2a8e161'] ),
				  'hnd_customer_email' => sanitize_text_field( $_POST['acf']['field_5c67bf3f8e162'] ),
				  'hnd_customer_phone' => sanitize_text_field( $_POST['acf']['field_5c67bf5b8e163'] ),
				  'hnd_customer_address' => sanitize_text_field( $_POST['acf']['field_5c67bf748e164'] ),
				  'hnd_customer_city' => sanitize_text_field( $_POST['acf']['field_5c67bf8c8e165'] ),
				  'hnd_customer_state' => sanitize_text_field( $_POST['acf']['field_5c67bfa68e166'] ),
				  'hnd_customer_zipcode' => sanitize_text_field( $_POST['acf']['field_5c67bfb78e167'] ),

	     );

     	$serialized_scheduled_address = base64_encode(serialize($scheduled_address));

     	$scheduled_zipcode = sanitize_text_field( $_POST['acf']['field_5c67bfb78e167'] );

     	$hour_price = (float) get_field('handyman_master_config_per_hour_price', 'option');

		$handyman_id = sanitize_text_field( $_POST['acf']['field_5c5ecafa36252'] );
		$handyman_premium = get_field('pro_premium', $handyman_id);

		$scheduled_date = strtotime(sanitize_text_field( $_POST['acf']['field_5c5ecb8d8d419'] ));
		// $scheduled_date = date('m/d/Y', $scheduled_date );
		$scheduled_date = date('Y-m-d', $scheduled_date );

		// var_dump($_POST['acf']['field_5c5ecb8d8d419'] );


		$scheduled_arrival_time = sanitize_text_field( $_POST['acf']['field_5c5ecbcc8d41a'] );


		if ( isset($_POST['acf']['field_5c6ce8cc0faab']) && !empty($_POST['acf']['field_5c6ce8cc0faab']) ) {

			$total_labour_min_prod = 0;

			$handyman_booking_products = array_values($_POST['acf']['field_5c6ce8cc0faab']);

			foreach ( $handyman_booking_products as $key => $handyman_booking_product ) {
					
					$hndKngProdId = $handyman_booking_product['field_5c6ce8f50faac'];
					$hndKngProdQnty = $handyman_booking_product['field_5c6cea2748c83'];
					$hndKngProdAssoSrvsId = $handyman_booking_product['field_5c6ce9e948c82'];


					$per_min_cost_bp = $hour_price/60;
					$service_labour_cost_bp = get_field('handyman_est_time', $hndKngProdAssoSrvsId) * $per_min_cost_bp;

					$total_labour_min_serv += (int) get_field('handyman_est_time', $hndKngProdAssoSrvsId);

					$service_labour_cost_bp  = $service_labour_cost_bp + ( ($service_labour_cost_bp * get_field('handyman_product_premium', $hndKngProdAssoSrvsId))/100 );
					$service_labour_cost_bp  = $service_labour_cost_bp - ( ($service_labour_cost_bp * get_field('handyman_product_discount', $hndKngProdAssoSrvsId))/100 );


					$product_prices[$key]  = (float) get_field('handyman_prod_price', $hndKngProdId) * (int) $hndKngProdQnty + $service_labour_cost_bp;
					$asso_labour_min[$key] = get_field('handyman_est_time', $hndKngProdAssoSrvsId);

					$total_labour_min_prod += ( (int) get_field('handyman_est_time', $hndKngProdAssoSrvsId) * (int) $hndKngProdQnty );

					$selected_product[$key]['handymn_prod_type'] = 'product';
					$selected_product[$key]['handymn_asso_service_id'] = $hndKngProdAssoSrvsId;
					$selected_product[$key]['handymn_product_id'] = $hndKngProdId;
					$selected_product[$key]['handymn_prod_quantity'] = $hndKngProdQnty;

			}

			$serialized_product_prices         = base64_encode(serialize($product_prices));
			$serialized_asso_labour_min        = base64_encode(serialize($asso_labour_min));

			$serialized_selected_product        = base64_encode(serialize($selected_product));

		} else {

			$serialized_product_prices = '';
			$serialized_asso_labour_min = '';
			$serialized_selected_product = '';
			$total_labour_min_prod = 0;
		}


		$configured_setup = array();
		$hnd_options = array();
		$hnd_suboptions = array();
		$hnd_suboptions_values = array();

		if ( isset($_POST['acf']['field_5c6ce88f0faa9']) && !empty($_POST['acf']['field_5c6ce88f0faa9']) ) {

			$total_labour_min_serv = 0;

			$selected_services = array_values($_POST['acf']['field_5c6ce88f0faa9']);
			$service_total_bp  = array();
		
			foreach ( $selected_services as $keyo => $selected_service ) {

					$service_total_bp[$keyo] = 0;

					$hndKngSrvId = $selected_service['field_5c6ce8a90faaa']; // Service ID

					$per_min_cost_bp = $hour_price/60;
					$service_labour_cost_bp = get_field('handyman_est_time', $hndKngSrvId) * $per_min_cost_bp;

					$total_labour_min_serv += (int) get_field('handyman_est_time', $hndKngSrvId);

					$service_labour_cost_bp  = $service_labour_cost_bp + ( ($service_labour_cost_bp * get_field('handyman_product_premium', $hndKngSrvId))/100 );
					$service_labour_cost_bp  = $service_labour_cost_bp - ( ($service_labour_cost_bp * get_field('handyman_product_discount', $hndKngSrvId))/100 );

					// var_dump($service_labour_cost_bp);
					// exit;

					$service_total_bp[$keyo] += $service_labour_cost_bp;

					if ( isset($selected_service['field_5c6ce95a48c7f']) && !empty($selected_service['field_5c6ce95a48c7f']) ) {

						$selected_service_values = array_values($selected_service['field_5c6ce95a48c7f']);
						
						foreach ( $selected_service_values as $keyi => $added_option ) {

							$configured_setup[$keyo][$keyi] = new stdClass(); // RFE - https://stackoverflow.com/questions/1738865/initialize-objects-like-arrays-in-php
							$configured_setup[$keyo][$keyi]->handyman_addon_question = '';
							$configured_setup[$keyo][$keyi]->handyman_addon_options[0] = new stdClass();
							$configured_setup[$keyo][$keyi]->handyman_addon_options[0]->handyman_option_label = $added_option['field_5c6ce98b48c80'];
							$configured_setup[$keyo][$keyi]->handyman_addon_options[0]->labour_minutes = $added_option['field_5c6ce9a548c81'];
							$configured_setup[$keyo][$keyi]->handyman_addon_options[0]->handyman_addon_sub_option_check = false;
							$configured_setup[$keyo][$keyi]->handyman_addon_options[0]->handyman_sub_option_groups = false;

							$total_labour_min_serv += (int) $added_option['field_5c6ce9a548c81'];

							$service_total_bp[$keyo] += $added_option['field_5c6ce9a548c81'] * $per_min_cost_bp;

							$hnd_options[$keyo][$keyi] = 'undefined|' . $keyi . '|0';
							$hnd_suboptions[$keyo][$keyi] = '';
							$hnd_suboptions_values[$keyo][$keyi] = '';


						}

					}

							// var_dump($hndKngSrvId);
							// var_dump(get_post($hndKngSrvId));
							// exit;

							$selected__service[$keyo]['handymn_service_id'] = $hndKngSrvId;
							$selected__service[$keyo]['handymn_service_name'] = get_post($hndKngSrvId)->post_title;
							$selected__service[$keyo]['handymn_per_min_cost'] = $per_min_cost_bp;
							$selected__service[$keyo]['handymn_service_time'] = get_field('handyman_est_time', $hndKngSrvId);

							$selected__service[$keyo]['handymn_service_price'] = $service_labour_cost_bp;
							
							// handymn_service_time
							// handymn_service_id
							// handymn_service_name
							// handymn_service_price
							// handymn_per_min_cost


			}


			$service_prices = $service_total_bp;
			$serialized_service_prices        = base64_encode(serialize($service_prices));


			$serialized_configured_setup 		= base64_encode(serialize($configured_setup));
			$serialized_hnd_options        		= base64_encode(serialize($hnd_options));
			$serialized_hnd_suboptions      	= base64_encode(serialize($hnd_suboptions));
			$serialized_hnd_suboptions_values   = base64_encode(serialize($hnd_suboptions_values));
			$serialized_selected_service        = base64_encode(serialize($selected__service));

		} else {

			$serialized_configured_setup = '';
			$serialized_hnd_options = '';
			$serialized_hnd_suboptions = '';
			$serialized_hnd_suboptions_values = '';
			$serialized_service_prices   = '';
			$serialized_selected_service = '';
			$total_labour_min_serv = 0;

		}

		// var_dump($service_total_bp);
		// exit;

		$total_labour_min_serv_prod = $total_labour_min_serv + $total_labour_min_prod;

     	$errorCode = $wpdb->query( $wpdb->prepare(
                            "INSERT ignore INTO hxp_handyman_booking ( booking_id, customer_phone, customer_email, scheduled_address, scheduled_zipcode, handyman_id, handyman_premium, scheduled_date, scheduled_arrival_time, hour_price, booking_status, product_prices, asso_labour_min, configured_setup, hnd_options, hnd_suboptions, hnd_suboptions_values, service_prices, selected_service, selected_product, total_labour_mins ) VALUES ( %d, %s, %s, %s, %s, %d, %s, %s, %s, %f, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %d )",
                            array(
                                    $post->ID,
                                    $customer_phone,
                                    $customer_email,
                                    $serialized_scheduled_address,
                                    $scheduled_zipcode,
                                    $handyman_id,
									$handyman_premium,
									$scheduled_date, // $scheduled_date
									$scheduled_arrival_time,
									$hour_price,
									'new',
									$serialized_product_prices,
									$serialized_asso_labour_min,
									$serialized_configured_setup,
									$serialized_hnd_options,
									$serialized_hnd_suboptions,
									$serialized_hnd_suboptions_values,
									$serialized_service_prices,
									$serialized_selected_service,
									$serialized_selected_product,
									$total_labour_min_serv_prod

                            )
                        ) );


        if( !$errorCode ) {
            echo 'Error: Duplicate Entry.';
            die();
        }

        $hndbookingpost = array(
		   'ID' =>  $post->ID,
		   'post_title'    => date('F j, Y', strtotime($scheduled_date)),
		  /* 'post_content'  => $post_content,
		  'post_status'   => 'publish',
		  'post_author'   => $post_author,
		  'post_category' => $post_categories // REF - https://stackoverflow.com/questions/17617858/wordpress-wp-insert-post-wp-update-post */
		);

		wp_update_post( $hndbookingpost );

		// SEND EMAILS - PENDING
        $subject     = 'Service Confirmation Details';
        $contactname = 'Handyman Pro';
        $email_body  = get_permalink( $post->ID ); // mail_template__handyman(); // email_template__user()
        $contactemail = 'noreply@dkconnects.com';

        // Send Grid
        $url = 'https://api.sendgrid.com/';    
        $user = 'getrafic';          
        $pass = 'Emails@2017';                 
        $params = array(          
            'api_user'  => $user,            
            'api_key'   => $pass,            
            'to'        => $customer_email,                    
            // 'cc'        => $to_admin1,                    
            // 'bcc'        => $to_admin2,            
            'subject'   => 'Booking ID - ' . $post->ID,                    
            'fromname' => $contactname,            
            'html'      => $email_body,            
            'text'      => '',            
            'from'      => '<noreply@dkconnects.com>',          
            'replyto'      => $contactemail,          
    
            );

        $request =  $url.'api/mail.send.json';        
  
        // Generate curl request         
        $session = curl_init($request);
  
        // Tell curl to use HTTP POST         
        curl_setopt ($session, CURLOPT_POST, true);
  
        // Tell curl that this is the body of the POST          
        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
  
        // Tell curl not to return headers, but do return the response          
        curl_setopt($session, CURLOPT_HEADER, false);
  
        // Tell PHP not to use SSLv3 (instead opting for TLS)          
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
  
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);        
  
        // obtain response
        $response = curl_exec($session);          
        curl_close($session);

		// var_dump($new_status, $old_status);
		// exit;

	}

}
         
// add the action 
add_action( 'transition_post_status', 'handyman_action_publish_booking', 9999, 3);

function handyman_action_update_booking( $post_ID, $post, $update ) { // - PENDING - CONTINUE FROM HERE

  // remove_action( current_action(), __FUNCTION__ ); // REF - https://wordpress.stackexchange.com/questions/178747/maximum-function-nesting-level-of-100-reached-after-adding-a-new-filter

  if ( $post->post_type !== 'bookings' ) return;

  remove_action( 'save_post', 'handyman_action_update_booking', 99999, 3 ); // Avoid Loops With save_post in WordPress // REF - https://tommcfarlin.com/save_post-in-wordpress/
  
  if ($update) { // true

  		global $wpdb;

		$proID 		= get_field('hnd_schedule_handyman', $post->ID);
		$proDate 	= get_field('hnd_schedule_date', $post->ID);
		$proAT 		= get_field('hnd_schedule_arrival_time', $post->ID);

		$proFullName = get_field('pros_first_name', $proID) . ' ' . get_field('pros_last_name', $proID);
		$proEmail    = get_field('pro_email', $proID);

		$fetch_bookingDetails = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM hxp_handyman_booking WHERE booking_id = %s", array( $post->ID ) ), 'ARRAY_A');

		// echo '<pre>';
		// var_dump($fetch_bookingDetails['booking_id']);
		// exit;

		if ($fetch_bookingDetails['handyman_id'] !== $proID) { // Handyman ID
			
			 $wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_handyman_booking set handyman_id = '%d', handyman_premium = '%d' WHERE booking_id = '%d'",
			    array(
			        $proID,
			        get_field('pro_premium', $proID),
			        $fetch_bookingDetails['booking_id']
			    )
			));

			 	// SEND EMAILS - PENDING
		        $subject     = 'Service Confirmation Details';
		        $contactname = 'Handyman Pro';
		        $email_body  = get_permalink( $fetch_bookingDetails['booking_id'] ); // mail_template__handyman(); // email_template__user()
		        $contactemail = 'noreply@dkconnects.com';

		        // Send Grid
		        $url = 'https://api.sendgrid.com/';    
		        $user = 'getrafic';          
		        $pass = 'Emails@2017';                 
		        $params = array(          
		            'api_user'  => $user,            
		            'api_key'   => $pass,            
		            'to'        => $fetch_bookingDetails['customer_email'],                    
		            // 'cc'        => $to_admin1,                    
		            // 'bcc'        => $to_admin2,            
		            'subject'   => 'Booking ID - ' . $fetch_bookingDetails['booking_id'],                    
		            'fromname' => $contactname,            
		            'html'      => $email_body,            
		            'text'      => '',            
		            'from'      => '<noreply@dkconnects.com>',          
		            'replyto'      => $contactemail,          
		    
		            );

		        $request =  $url.'api/mail.send.json';        
		  
		        // Generate curl request         
		        $session = curl_init($request);
		  
		        // Tell curl to use HTTP POST         
		        curl_setopt ($session, CURLOPT_POST, true);
		  
		        // Tell curl that this is the body of the POST          
		        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		  
		        // Tell curl not to return headers, but do return the response          
		        curl_setopt($session, CURLOPT_HEADER, false);
		  
		        // Tell PHP not to use SSLv3 (instead opting for TLS)          
		        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		  
		        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);        
		  
		        // obtain response
		        $response = curl_exec($session);          
		        curl_close($session);

		}

		if ($fetch_bookingDetails['scheduled_date'] !== $proDate) { // Schedule Date

			$wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_handyman_booking set scheduled_date = '%s' WHERE booking_id = '%d'",
			    array(
			        $proDate,
			        $fetch_bookingDetails['booking_id']
			    )
			));

			$hndbookingpostUpdate = array(
			   'ID' =>  $fetch_bookingDetails['booking_id'],
			   'post_title'    => date('F j, Y', strtotime($proDate)),
			);

			wp_update_post( $hndbookingpostUpdate );

			// SEND EMAILS - PENDING
		        $subject     = 'Service Confirmation Details';
		        $contactname = 'Handyman Pro';
		        $email_body  = get_permalink( $fetch_bookingDetails['booking_id'] ); // mail_template__handyman(); // email_template__user()
		        $contactemail = 'noreply@dkconnects.com';

		        // Send Grid
		        $url = 'https://api.sendgrid.com/';    
		        $user = 'getrafic';          
		        $pass = 'Emails@2017';                 
		        $params = array(          
		            'api_user'  => $user,            
		            'api_key'   => $pass,            
		            'to'        => $fetch_bookingDetails['customer_email'],                    
		            // 'cc'        => $to_admin1,                    
		            // 'bcc'        => $to_admin2,            
		            'subject'   => 'Booking ID - ' . $fetch_bookingDetails['booking_id'],                    
		            'fromname' => $contactname,            
		            'html'      => $email_body,            
		            'text'      => '',            
		            'from'      => '<noreply@dkconnects.com>',          
		            'replyto'      => $contactemail,          
		    
		            );

		        $request =  $url.'api/mail.send.json';        
		  
		        // Generate curl request         
		        $session = curl_init($request);
		  
		        // Tell curl to use HTTP POST         
		        curl_setopt ($session, CURLOPT_POST, true);
		  
		        // Tell curl that this is the body of the POST          
		        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		  
		        // Tell curl not to return headers, but do return the response          
		        curl_setopt($session, CURLOPT_HEADER, false);
		  
		        // Tell PHP not to use SSLv3 (instead opting for TLS)          
		        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		  
		        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);        
		  
		        // obtain response
		        $response = curl_exec($session);          
		        curl_close($session);
		}

		if ($fetch_bookingDetails['scheduled_arrival_time'] !== $proAT) { // Arrival Time

			$wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_handyman_booking set scheduled_arrival_time = '%s' WHERE booking_id = '%d'",
			    array(
			        $proAT,
			        $fetch_bookingDetails['booking_id']
			    )
			));

			// SEND EMAILS - PENDING
		        $subject     = 'Service Confirmation Details';
		        $contactname = 'Handyman Pro';
		        $email_body  = get_permalink( $fetch_bookingDetails['booking_id'] ); // mail_template__handyman(); // email_template__user()
		        $contactemail = 'noreply@dkconnects.com';

		        // Send Grid
		        $url = 'https://api.sendgrid.com/';    
		        $user = 'getrafic';          
		        $pass = 'Emails@2017';                 
		        $params = array(          
		            'api_user'  => $user,            
		            'api_key'   => $pass,            
		            'to'        => $fetch_bookingDetails['customer_email'],                    
		            // 'cc'        => $to_admin1,                    
		            // 'bcc'        => $to_admin2,            
		            'subject'   => 'Booking ID - ' . $fetch_bookingDetails['booking_id'],                    
		            'fromname' => $contactname,            
		            'html'      => $email_body,            
		            'text'      => '',            
		            'from'      => '<noreply@dkconnects.com>',          
		            'replyto'      => $contactemail,          
		    
		            );

		        $request =  $url.'api/mail.send.json';        
		  
		        // Generate curl request         
		        $session = curl_init($request);
		  
		        // Tell curl to use HTTP POST         
		        curl_setopt ($session, CURLOPT_POST, true);
		  
		        // Tell curl that this is the body of the POST          
		        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		  
		        // Tell curl not to return headers, but do return the response          
		        curl_setopt($session, CURLOPT_HEADER, false);
		  
		        // Tell PHP not to use SSLv3 (instead opting for TLS)          
		        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		  
		        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);        
		  
		        // obtain response
		        $response = curl_exec($session);          
		        curl_close($session);
		}

  	
  }

  add_action( 'save_post', 'handyman_action_update_booking', 99999, 3 );

}

add_action( 'save_post', 'handyman_action_update_booking', 99999, 3 ); // REF - https://wordpress.stackexchange.com/questions/134664/what-is-correct-way-to-hook-when-update-post


// Notify Customer
function handyman_sendRescheduleEmail($bookingID, $customerEmail, $proFullName, $scheduledDate, $aarivalTime, $change ) { 
// The parameters are not in use except the $bookingID.


				// CUSTOMER 
                $subject     = 'Changes in Booking' . ' - Booking ID: ' . $bookingID;
                $contactname = 'Handyman Pro';
                $email_body  = 'Your booking has been changed. Please check the details: ' . get_permalink($bookingID);
                $contactemail = 'noreply@dkconnects.com';

                // Send Grid
                $url = 'https://api.sendgrid.com/';
                $user = 'getrafic';          
                $pass = 'Emails@2017';                 
                $params = array(          
                    'api_user'  => $user,            
                    'api_key'   => $pass,            
                    'to'        => $customerEmail,                    
                    // 'cc'        => $to_admin1,                    
                    // 'bcc'        => $to_admin2,            
                    'subject'   => 'Booking ID - ' . $bookingID,                    
                    'fromname' => $contactname,            
                    'html'      => $email_body,            
                    'text'      => '',            
                    'from'      => '<noreply@dkconnects.com>',          
                    'replyto'      => $contactemail,          
            
                    );
      
                $request =  $url.'api/mail.send.json';        
          
                // Generate curl request         
                $session = curl_init($request);
          
                // Tell curl to use HTTP POST         
                curl_setopt ($session, CURLOPT_POST, true);
          
                // Tell curl that this is the body of the POST          
                curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
          
                // Tell curl not to return headers, but do return the response          
                curl_setopt($session, CURLOPT_HEADER, false);
          
                // Tell PHP not to use SSLv3 (instead opting for TLS)          
                curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
          
                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);        
          
                // obtain response
                $response = curl_exec($session);          
                curl_close($session);

                /*  $subject_handyman     = 'Job Alert';
                $contactname_handyman = 'Handyman Pro';
                $email_body_handyman  = email_template__handyman(); // email_template__user()
                $contactemail_handyman = 'noreply@dkconnects.com';

                // Send Grid
                $url = 'https://api.sendgrid.com/';    
                $user = 'getrafic';          
                $pass = 'Emails@2017';                 
                $params = array(          
                    'api_user'  => $user,            
                    'api_key'   => $pass,            
                    'to'        => 'sourav.seoinfotechsolution@gmail.com',  // handyman@handymanproservices.com             
                    // 'cc'        => $to_admin1,                    
                    // 'bcc'        => $to_admin2,            
                    'subject'   => $subject_handyman,                    
                    'fromname' => $contactname_handyman,            
                    'html'      => $email_body_handyman,            
                    'text'      => '',            
                    'from'      => '<noreply@dkconnects.com>',          
                    'replyto'      => $contactemail_handyman,          
            
                    ); 
      
                $request =  $url.'api/mail.send.json';        
          
                // Generate curl request         
                $session = curl_init($request);
          
                // Tell curl to use HTTP POST         
                curl_setopt ($session, CURLOPT_POST, true);
          
                // Tell curl that this is the body of the POST          
                curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
          
                // Tell curl not to return headers, but do return the response          
                curl_setopt($session, CURLOPT_HEADER, false);
          
                // Tell PHP not to use SSLv3 (instead opting for TLS)          
                curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
          
                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);        
          
                // obtain response
                $response = curl_exec($session);          
                curl_close($session); */

}


	function timeConvertRound($n) {
				//var_dump($n);
				$num = $n;
				$hours = ( $num / 60);

				//var_dump($hours);
				$rhours = floor($hours);
				$minutes = ($hours - $rhours) * 60;
				// var_dump($minutes);
				$rminutes = round($minutes, 2);
				return ceil($rhours . "." . $rminutes);
	}


	function timeConvertMintoHR($n) {
				//var_dump($n);
				$num = $n;
				$hours = ( $num / 60);

				//var_dump($hours);
				$rhours = floor($hours);
				$minutes = ($hours - $rhours) * 60;
				// var_dump($minutes);
				$rminutes = round($minutes, 2);
				return $rhours . "." . $rminutes;
	}


// Ajax Call on Ajax Call
if ( ! function_exists( 'handyman_pro_handyman_load_date_time' ) ) { 

	function handyman_pro_handyman_load_date_time() {

		check_admin_referer( 'deadpool-2', 'prosecure' );

		global $wpdb;

		$proID = (int) $_POST['proID'];

		$proSDate = strtotime($_POST['proSDate']);
		// $newformatbooking = date('m/d/Y', $proSDate);

		$newformatbooking = date('Y-m-d', $proSDate);

		$bookingDetails = $wpdb->get_results( $wpdb->prepare( "SELECT scheduled_date, scheduled_arrival_time, booking_status, total_labour_mins FROM hxp_handyman_booking WHERE handyman_id = %s AND ( booking_status = 'new' OR booking_status = 'received' ) AND scheduled_date = %s", array( $proID, $newformatbooking ) ), 'ARRAY_A');


		$ehecking_evening_as_available = get_field('pro_show_evening_as_available', $proID);

		$availabilityData['time'] = array( '08:00 am - 09:00 am', '09:00 am - 11:00 am', '10:00 am - 12:00 pm', '11:00 am - 13:00 pm', '13:00 pm - 15:00 pm' );
		
		if ($ehecking_evening_as_available) { // True
			array_push( $availabilityData['time'], '14:00 pm - 16:00 pm', '15:00 pm - 17:00 pm', '16:00 pm - 18:00 pm', '17:00 pm - 19:00 pm', '18:00 pm - 20:00 pm', '19:00 pm - 21:00 pm' );
		}

		$hnd_booked_slots = array();

		if (!empty($bookingDetails)) {

			foreach ( $bookingDetails as $key => $bookingDetail ) {

					$hnd_booked_slots[] = $bookingDetail['scheduled_arrival_time'];

			}

		} // !empty($bookingDetails)

		echo json_encode($hnd_booked_slots);
		exit();

	}

}

add_action('wp_ajax_handyman_load_date_time', 'handyman_pro_handyman_load_date_time');
add_action('wp_ajax_nopriv_handyman_load_date_time', 'handyman_pro_handyman_load_date_time');

function handyman_booking_edit_screen()
{
    if (!empty($_GET['post']) )
    {
        
        $post = get_post($_GET['post']);

        if ($post->post_type !== 'bookings') return;

        global $wpdb;

        $proID = (int) get_field('hnd_schedule_handyman', $post->ID);

        $proSDate = strtotime(get_field('hnd_schedule_date', $post->ID));
		// $newformatbooking = date('m/d/Y', $proSDate);

		$newformatbooking = date('Y-m-d', $proSDate);

		$bookingDetails = $wpdb->get_results( $wpdb->prepare( "SELECT scheduled_date, scheduled_arrival_time, booking_status, total_labour_mins FROM hxp_handyman_booking WHERE handyman_id = %s AND ( booking_status = 'new' OR booking_status = 'received' ) AND scheduled_date = %s", array( $proID, $newformatbooking ) ), 'ARRAY_A');

		$handyman_time = array();
		$ehecking_evening_as_available = get_field('pro_show_evening_as_available', $proID);

		$availabilityData['time'] = array( '08:00 am - 09:00 am', '09:00 am - 11:00 am', '10:00 am - 12:00 pm', '11:00 am - 13:00 pm', '13:00 pm - 15:00 pm' );
		
		if ($ehecking_evening_as_available) { // True
			array_push( $availabilityData['time'], '14:00 pm - 16:00 pm', '15:00 pm - 17:00 pm', '16:00 pm - 18:00 pm', '17:00 pm - 19:00 pm', '18:00 pm - 20:00 pm', '19:00 pm - 21:00 pm' );
		}

		$hnd_booked_slots = array();

		if (!empty($bookingDetails)) {

			foreach ( $bookingDetails as $key => $bookingDetail ) {

					$hnd_booked_slots[] = $bookingDetail['scheduled_arrival_time'];

			}

		} // !empty($bookingDetails)

		if( is_admin() && $post->post_type === 'bookings' ) : ?>

			<div class="availability-data" style="display: none;"><?php echo json_encode($hnd_booked_slots); ?></div>

		<?php endif;

       
   }
}

add_action( 'load-post.php', 'handyman_booking_edit_screen' ); // REF - https://wordpress.stackexchange.com/questions/94212/hooking-into-the-post-editing-screen-for-an-existing-page-only

function handyman_booking_trash_action( $post_id ) {

   if ( 'bookings' !== get_post_type( $post_id ) ) return;

   // remove_action( current_action(), __FUNCTION__ ); // REF - https://wordpress.stackexchange.com/questions/178747/maximum-function-nesting-level-of-100-reached-after-adding-a-new-filter
   
   global $wpdb;

   // Update Status
   $wpdb->query( $wpdb->prepare(
	    "UPDATE hxp_handyman_booking set booking_status = 'trashed' WHERE booking_id = '%d'",
	    array(
	        $post_id
	    )
	));  

}

add_action( 'trashed_post', 'handyman_booking_trash_action' );

function handyman_booking_untrashed_action( $post_id ) {

   if ( 'bookings' !== get_post_type( $post_id ) ) return;

   remove_action( current_action(), __FUNCTION__ );
   
   global $wpdb;

   $bookingStatusAcf = get_field('hnd_booking_status', $post_id);

   // Update Status
    $wpdb->query( $wpdb->prepare(
	    "UPDATE hxp_handyman_booking set booking_status = '%s' WHERE booking_id = '%d'",
	    array(
	    	$bookingStatusAcf,
	        $post_id
	    )
	));  

}

add_action( 'untrashed_post', 'handyman_booking_untrashed_action' );

// Delete booking from hxp_handyman_booking table permanently.
function handyman_booking_delete_action( $post_id ) {

   if ( 'bookings' !== get_post_type( $post_id ) ) return;

   remove_action( current_action(), __FUNCTION__ );
   
   global $wpdb;

   // Delete Booking
   $wpdb->query( $wpdb->prepare( "DELETE FROM hxp_handyman_booking
		                WHERE booking_id = %d", $post_id ) );

}

add_action( 'delete_post', 'handyman_booking_delete_action' );


/* Ajax call response for avaiable dates in front-end */
add_action('wp_ajax_available_pro_dates', 'handyman_pro_available_pro_dates');
add_action('wp_ajax_nopriv_available_pro_dates', 'handyman_pro_available_pro_dates');

if ( ! function_exists( 'handyman_pro_available_pro_dates' ) ) { 

	function handyman_pro_available_pro_dates() {

		check_ajax_referer( 'deadpool-2', 'security' );

		global $wpdb;

		$choices = array();

		$proID = (int) $_POST['proID'];

		$proSDate = strtotime($_POST['proSDate']);

		$newformatbooking = date('Y-m-d', $proSDate);

		

		$prevBookings = $wpdb->get_results( $wpdb->prepare( "SELECT scheduled_date, scheduled_arrival_time, booking_status, total_labour_mins, scheduled_zipcode FROM hxp_handyman_booking WHERE handyman_id = %s AND ( booking_status = 'new' OR booking_status = 'received' ) AND scheduled_date = %s", array( $proID, $newformatbooking ) ), 'ARRAY_A');

		$handyman_time = array();
		$ehecking_evening_as_available = get_field('pro_show_evening_as_available', $proID);

		$availabilityData['time'] = array( '08:00 am - 09:00 am', '09:00 am - 11:00 am', '10:00 am - 12:00 pm', '11:00 am - 13:00 pm', '12:00 pm - 14:00 pm', '13:00 pm - 15:00 pm', '14:00 pm - 16:00 pm' );
		
		if ($ehecking_evening_as_available) { // True

			$choices['evening_as_available'] = true;

			array_push( $availabilityData['time'], '15:00 pm - 17:00 pm', '16:00 pm - 18:00 pm', '17:00 pm - 19:00 pm', '18:00 pm - 20:00 pm', '19:00 pm - 21:00 pm' );


		} else {

			$choices['evening_as_available'] = false;

			array_push( $availabilityData['time'], '15:00 pm - 17:00 pm', '16:00 pm - 18:00 pm', '17:00 pm - 19:00 pm', '18:00 pm - 20:00 pm', '19:00 pm - 21:00 pm' );

			$blockEvenningSlots = array ( // BLOCK Everything From 4PM
				"booking_status" => "received",
				"scheduled_arrival_time" => "16:00 pm - 18:00 pm",
				"scheduled_date" => $newformatbooking,
				"scheduled_zipcode" => $_POST['zipcode'], 
				"total_labour_mins" => "360" // 6 hours - upto 22:00 pm
			);

			$prevBookings[] = $blockEvenningSlots;

		}

		$filteredTime = array();
		$filteredTime = array_diff($availabilityData['time'], get_field('block_hnd_time_slots', 'option'));

		$availabilityData['time'] = array_values($filteredTime);

		if (!empty($prevBookings)) {

			$originaltimeSlots = $timeSlots = $availabilityData['time'];



			$choices['time_list'] = $availabilityData['time']; // Final slots

			$sortByArrivalTime = array_column($prevBookings, 'scheduled_arrival_time');
			array_multisort($sortByArrivalTime, SORT_ASC, $prevBookings);

			$booked   = array();
			$avaiable = array();

			foreach ( $prevBookings as $keyPB => $prevBooking ) {

					$choices['booking'][] = $prevBooking;

					$choices['scheduled_zipcode'][] = $prevBooking['scheduled_zipcode'];
					
					$beginTime 				= explode(' ', $prevBooking['scheduled_arrival_time'])[0]; // start time

					$prevBookingtimestamp   = strtotime( $prevBooking['total_labour_mins'] . " minutes", strtotime($beginTime));

					$choices['time_list1'] = $timeSlots; //

					$index = array_search( $prevBooking['scheduled_arrival_time'] , $timeSlots);

					$choices['scheduled_arrival_time1'] = $prevBooking['scheduled_arrival_time']; //
					$choices['index1'] = $index; //



					if ($index) { 
						array_splice($timeSlots, 0, $index);

					} else { // IF Index is 'false'. If scheduled_arrival_time is random.

						 // stripos("12:00 pm - 14:00 pm","12:00");

						foreach ($timeSlots as $key => $timeSlot) {
							if (stripos($timeSlot, $beginTime) === 0) {
								// $choices['test_STRIPOS'][] = stripos($timeSlot, $beginTime);
								$index_found = $key;
							}
						}

						// $choices['test_TIMESLOTS'] = $timeSlots;
						// $choices['test_INDEX_FOUND'][] = $index_found;

						array_splice($timeSlots, 0, $index_found);

						// $choices['test_BEGIN_TIME'][] = $beginTime;

						// $choices['test_ARRIVAL_TIME_DESKTOP'][] = $prevBooking['scheduled_arrival_time'];
						// $choices['test_ARRAY_index'][] = $index;

					}

					$choices['time_list2'] = $timeSlots;
							 

					foreach ($timeSlots as $keyTS => $timeSlot) {

							$startTime 			= explode(' ', $timeSlot)[0]; // start time range part of timeSlots
							$timeSlottimestamp  = strtotime($startTime);

							if( $prevBookingtimestamp >  $timeSlottimestamp ) {
								$booked[] = $timeSlot;
							}
					}

			}



			array_unique($booked);

			// $choices['test_booked'] = $booked;

			$timeSlots = $originaltimeSlots;

			$labour = (int) $_POST['totalmin'];

			// $choices['_test_totalmin'][] = $labour; // 


			foreach ( $timeSlots as $key => $OTS ) {
				if( !in_array($OTS, $booked) ) {

					$choices['available'][] = $OTS;

					$slot = $OTS;

					$newStartTime 			= explode(' ', $slot)[0];
					$newBookingtimestamp 	= strtotime( $labour . " minutes", strtotime($newStartTime));

					// $choices['test_newStartTime'][] = $newStartTime;
					// $choices['test_newBookingtimestamp'][] = $newBookingtimestamp;


					$index = array_search( $slot , $timeSlots);
		 			array_splice($timeSlots, 0, $index);

		 			$possibleTimeBlocks = array();

		 			foreach ($timeSlots as $keyTS => $timeSlot) {

		 							// $choices['already_booked'][] = $timeSlot;

									$startTime 			= explode(' ', $timeSlot)[0]; // start time range part of timeSlots
									$timeSlottimestamp  = strtotime($startTime);

									// $choices['test_startTime'][] = $startTime;
									// $choices['test_timeSlottimestamp'][] = $timeSlottimestamp;

									if( $newBookingtimestamp >  $timeSlottimestamp ) {

										$possibleTimeBlocks[] = $timeSlot;

									}
					}

					// $choices['test_data'][] = $timeSlots;

					$choices['test_possibleTimeBlocks'] = $possibleTimeBlocks;
					

					$wontFulfilled = false;

					foreach ( $possibleTimeBlocks as $key => $PTB ) {
						if( in_array($PTB, $booked) ) {

							$wontFulfilled = true;
							
						}
					}

					if( !$wontFulfilled ) { 
						$choices['time_slot'][] = $slot; // available slots
					}

					$timeSlots = $originaltimeSlots;
					
				}
			}

		} else {

			$timeSlots = $choices['time_list'] = $availabilityData['time'];
			$labour = (int) $_POST['totalmin'];
			$choices['scheduled_zipcode'][] = (int) $_POST['zipcode'];

			$choices['labour'] = $labour;

			$availableTimeBlock = array();

			$shiftEnds 						= explode(' ', '19:00 pm - 21:00 pm')[3]; //  shift ends @ 21:00 pm
			$minutesBeforeShiftEnds 		= strtotime( '-' . $labour . " minutes", strtotime($shiftEnds));

			// $choices['test_data'] = date('H:i:s', $minutesBeforeShiftEnds);

			foreach ($timeSlots as $key => $timeSlot ) {

				$startTime 			= explode(' ', $timeSlot)[0]; // start time range part of timeSlots
				$timeSlottimestamp  = strtotime($startTime);

				if( $minutesBeforeShiftEnds >=  $timeSlottimestamp ) {

					$availableTimeBlock[] = $timeSlot;

				}
				
			}

			$choices['time_slot'] = $availableTimeBlock; 
		
		}


		if(!empty($choices)) {
			echo json_encode($choices);
		} else {
			echo '';
		}

		die();

	}

}

// Search filter 
// REF - https://www.wpbeginner.com/wp-tutorials/how-to-limit-search-results-for-specific-post-types-in-wordpress/
function handyman_searchfilter($query) {
 
    if ($query->is_search && !is_admin() ) {
        $query->set('post_type', array('post','services'));
    }
 
return $query;
}
 
add_filter('pre_get_posts','handyman_searchfilter');


// REF - https://support.advancedcustomfields.com/forums/topic/add-html-to-acf-meta-box/
function action_function_name( $field ) {

    if ($field['key'] == "field_5c8785157489a"){

    	global $post;
		global $wpdb;

		$bookingHndID = $wpdb->get_row( $wpdb->prepare( "SELECT handyman_id FROM hxp_handyman_booking WHERE booking_id = %d", array( $post->ID ) ), 'ARRAY_A');

		$ProOffDates = get_field('pro_schedule_off_dates', $bookingHndID['handyman_id']);


		if ($ProOffDates) {
			foreach ($ProOffDates as $key => $ProOffDate ) {
				// var_dump($ProOffDate);
				$timepp = strtotime($ProOffDate['pro_schedule_off_date']);
				$newformatpp[] = date('Y-m-d', $timepp);
			}
		} else {
			$newformatpp[] = '0000-00-00';
		}

		

		$off_saturday 	= get_field('pro_show_saturday_as_available', $bookingHndID['handyman_id']);
		$off_sunday 	= get_field('pro_show_sunday_as_available', $bookingHndID['handyman_id']);

		$weekend = Array();

		$weekend[0] = ( $off_saturday === false ) ? '' : '6';
		$weekend[1] = ( $off_sunday  === false  ) ? '' : '0';

		// var_dump($weekend);
		// var_dump($off_sunday);
		// exit;

		echo '<div id="xchandyman-off-dates" name="handyman-off-dates" style="display:none;">' . json_encode($newformatpp) . '</div>';
		echo '<div id="xchandyman-weekends" name="xchandyman-weekends" style="display:none;">' . json_encode($weekend) . '</div>';
        echo '<div id="handyman-full-calendar" name="handyman-full-calendar"></div>';
    }

}

add_action( 'acf/render_field', 'action_function_name', 10, 1 );


/* Ajax call response for avaiable dates in front-end */
add_action('wp_ajax_load_hnd_booking_details', 'handyman_pro_load_hnd_booking_details');
add_action('wp_ajax_nopriv_load_hnd_booking_details', 'handyman_pro_load_hnd_booking_details');

if ( ! function_exists( 'handyman_pro_load_hnd_booking_details' ) ) {  // PENDING - CONTINUE FROM HERE

	function handyman_pro_load_hnd_booking_details() {

		check_admin_referer( 'deadpool-2', 'prosecure' );

		global $wpdb;

		$proID = (int) $_POST['proID'];

		$proSDate = strtotime($_POST['proSDate']);
		// $newformatbooking = date('m/d/Y', $proSDate);
		$newformatbooking = date('Y-m-d', $proSDate);

		$bookingDetails = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM hxp_handyman_booking WHERE handyman_id = %s AND ( booking_status = 'new' OR booking_status = 'received' )", array( $proID ) ), 'ARRAY_A');

		// print_r($bookingDetails);
		// exit;

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


		$ProOffDates = get_field('pro_schedule_off_dates', $proID);

		if ($ProOffDates) {
			foreach ($ProOffDates as $key => $ProOffDate ) {
				// var_dump($ProOffDate);
				$timepp = strtotime($ProOffDate['pro_schedule_off_date']);
				$newformatpp[] = date('Y-m-d', $timepp);
			}

			$bookingData[0]['pro_off_dates'] = $newformatpp;
		} else {
			$bookingData[0]['pro_off_dates'] = array('0000-00-00');
		}

		

		$off_saturday 	= get_field('pro_show_saturday_as_available', $proID);
		$off_sunday 	= get_field('pro_show_sunday_as_available', $proID);

		$weekend = Array();

		$weekend[0] = ( $off_saturday === false ) ? '' : '6';
		$weekend[1] = ( $off_sunday  === false  ) ? '' : '0';

		$bookingData[0]['pro_weekends'] = $weekend;

		// print_r($bookingData);
		// unset($bookingDetails['selected_product']);

		// print_r(unserialize(base64_decode($bookingDetail['selected_service'])));
		// print_r($time_duration);

		// print_r($bookingData); // CHECK THE ISSUE - PENDING

		echo json_encode($bookingData);
		exit();

	}

}


/* custom metabox for pros */
function handyman_add_custom_box_calendar() {

    $screens = ['pros'];

    foreach ($screens as $screen) {
        add_meta_box(
            'handyman__box_id',       // Unique ID
            'Calendar',  				// Box title
            'handyman_custom_box_calendar_markup',  // Content callback, must be of type callable
            $screen                   // Post type
        );
    }
}

// add_action('add_meta_boxes', 'handyman_add_custom_box_calendar'); // REF - https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/

function handyman_custom_box_calendar_markup($post) { 

		global $wpdb;

		$proID = $post->ID;

		// $proSDate = strtotime($_POST['proSDate']);
		// $newformatbooking = date('m/d/Y', $proSDate);

		$bookingDetails = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM hxp_handyman_booking WHERE handyman_id = %s AND ( booking_status = 'new' OR booking_status = 'received' )", array( $proID ) ), 'ARRAY_A');

		// print_r($bookingDetails);
		// exit;

		$bookingData = array();

		foreach ( $bookingDetails as $keyo => $bookingDetail ) {

			if (unserialize(base64_decode($bookingDetail['selected_service']))) {
				
			foreach ( unserialize(base64_decode($bookingDetail['selected_service'])) as $keyi => $selected_service ) {

				$bookingData[$keyo]['service_name'][] = $selected_service['handymn_service_name'] . ' - ' . get_field('handyman_type_of_service', $selected_service['handymn_service_id']);



									$hnd_options = unserialize(base64_decode($bookingDetail['hnd_options']));
									$hnd_suboptions = unserialize(base64_decode($bookingDetail['hnd_suboptions']));
									$all_service_setup = unserialize(base64_decode($bookingDetail['configured_setup']));
									$hnd_suboptions_values = unserialize(base64_decode($bookingDetail['hnd_suboptions_values']));

									// print_r($selected_service);
									// exit;

									$handyman_total_time = 0;  
									$handyman_total_time = $selected_service['handymn_service_time'];

									if (  isset( $hnd_options[$keyi] ) 
												&& isset( $hnd_suboptions[$keyi] ) 
												&& isset( $all_service_setup[$keyi] )
												&& isset( $selected_service )
												&& isset( $hnd_suboptions_values[$keyi] )
											) :

																				
									foreach ( $hnd_options[$keyi] as $elkey => $option_data ) : 

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

												$indivisual_sub_elem = explode('|', $hnd_suboptions[$keyi][$keyo] );
												$__S = $indivisual_sub_elem[3]; // Choosen SubOption Index

												if (isset($indivisual_sub_elem[4])) {
														$__SO_Delete = $indivisual_sub_elem[4]; // If deleted.
												} else {
													$__SO_Delete = null;
												}

											}
									

											if ( $opt_type === 'handyman_sub_option_quantity' ) {

												if ( !isset($__O_Delete) ) {

													$selected_option_labour_minutes = (int) $all_service_setup[$keyi][$__Q]->handyman_addon_options[$__O]->labour_minutes;

												} else {
													$selected_option_labour_minutes = 0;
												}


												if (!isset($__SO_Delete)) {

												
													$entered_suboption_quanity = (int) explode( '|', $hnd_suboptions_values[$keyi][$elkey] )[2];	

													$selected_suboption_labour_minutes = (int) $all_service_setup[$keyi][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_quantity_labour_minutes * $entered_suboption_quanity;	

													
												} else {

													$selected_suboption_labour_minutes = 0;

												}

											
											} elseif( $opt_type === 'handyman_sub_option_yesno' ) {


												if ( !isset($__O_Delete) ) {

													$selected_option_labour_minutes = (int) $all_service_setup[$keyi][$__Q]->handyman_addon_options[$__O]->labour_minutes;

												} else {

													$selected_option_labour_minutes = 0;
												}


												if (!isset($__SO_Delete)) {

														if ( (int) $__S ===  0 ) { // IF YES

															$selected_suboption_labour_minutes = (int) $all_service_setup[$keyi][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_yesno_labour_minutes;

														} else { // IF NO

															$selected_suboption_labour_minutes = 0;

														}

												} else {
															$selected_suboption_labour_minutes = 0;
												}


											} elseif( $opt_type === 'handyman_sub_option_list' ) {


												if ( !isset($__O_Delete) ) {

													$selected_option_labour_minutes = (int) $all_service_setup[$keyi][$__Q]->handyman_addon_options[$__O]->labour_minutes;

												} else {

													$selected_option_labour_minutes = 0;
												}


												if (!isset($__SO_Delete)) {

													$selected_suboption_labour_minutes = (int) $all_service_setup[$keyi][$__Q]->handyman_addon_options[$__O]->handyman_sub_option_groups[0]->handyman_so_list_options[$__S]->handyman_so_list_options_labour_minutes;

												} else {

															$selected_suboption_labour_minutes = 0;
												}


												
											} elseif( $opt_type === 'undefined' ) {

												// $_SESSION['all_service_setup'][$key][$__Q]->handyman_addon_options[$__O];

												if ( !isset($__O_Delete) ) {

													$selected_option_labour_minutes = (int) $all_service_setup[$keyi][$__Q]->handyman_addon_options[$__O]->labour_minutes;

												} else {
													$selected_option_labour_minutes = 0;
												}

												$selected_suboption_labour_minutes = 0;

											}


												$handyman_total_time += $selected_option_labour_minutes + $selected_suboption_labour_minutes;

											
										endforeach;											
											
										endif;


										// print_r($handyman_total_time);
										// print_r('__');

										$bookingData[$keyo]['total_time'][] = timeConvertMintoHR($handyman_total_time);



			} // ForEach: Selected Service

			}  // IF: Selected Service


			if (unserialize(base64_decode($bookingDetail['selected_product']))) {		

			foreach ( unserialize(base64_decode($bookingDetail['selected_product'])) as $keyi => $selected_product ) {

				// print_r($selected_product);

				$asso_labour_mins 	= unserialize(base64_decode($bookingDetail['asso_labour_min']));

				$bookingData[$keyo]['service_name'][] = get_the_title( $selected_product['handymn_product_id'] ) . ' - ' . get_the_title( $selected_product['handymn_asso_service_id'] ) . ' - ' . get_field('handyman_type_of_service', $selected_product['handymn_asso_service_id']);


				$product_quantity 			= (int) $selected_product['handymn_prod_quantity'];

				$bookingData[$keyo]['total_time'][] = timeConvertMintoHR($asso_labour_mins[$keyi] * $product_quantity);

				
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
			
			$bookingData[$keyo]['_start'] 	= date('Y-m-d', $scheduled_date) . 'T' . $_start . ':00';
			// $bookingData[$keyo]['arrival_duration']	= $time_duration; // 19-July-20
			$bookingData[$keyo]['arrival_duration']	= 0; 
			$bookingData[$keyo]['booking_id']	= $bookingDetail['booking_id'];
			// $bookingData[$keyo]['start'] 	= date('Y-m-d', $scheduled_date) . 'T' . $_start . ':00';


		} // foreach loop


		$ProOffDates = get_field('pro_schedule_off_dates', $proID);

		if ($ProOffDates) {
			foreach ($ProOffDates as $key => $ProOffDate ) {
				// var_dump($ProOffDate);
				$timepp = strtotime($ProOffDate['pro_schedule_off_date']);
				$newformatpp[] = date('Y-m-d', $timepp);
			}

			$bookingData[0]['pro_off_dates'] = $newformatpp;
		} else {
			$bookingData[0]['pro_off_dates'] = array('0000-00-00');
		}

		

		$off_saturday 	= get_field('pro_show_saturday_as_available', $proID);
		$off_sunday 	= get_field('pro_show_sunday_as_available', $proID);

		$weekend = Array();

		$weekend[0] = ( $off_saturday === false ) ? '' : '6';
		$weekend[1] = ( $off_sunday  === false  ) ? '' : '0';

		$bookingData[0]['pro_weekends'] = $weekend;

		// print_r($bookingData);
		// unset($bookingDetails['selected_product']);

		// print_r(unserialize(base64_decode($bookingDetail['selected_service'])));
		// print_r($time_duration);


		// print_r($bookingData); // CHECK THE ISSUE - PENDING

		echo '<div id="pro_handyman_fll_calendar_data" style="display:none;">' . json_encode($bookingData) . '</div>';
		
?>
    
    <div id="pro_handyman_fll_calendar"></div>

<?php }


// Populate Pros on Booking Screen
add_filter('acf/load_field/name=hnd_schedule_handyman', 'handyman_pro_load_hnd__handyman_choices');

if ( ! function_exists( 'handyman_pro_load_hnd__handyman_choices' ) ) {

	function handyman_pro_load_hnd__handyman_choices( $field ) {
	    
	    // reset choices
	    $field['choices'] = array();

	    $the_query = new WP_Query(array(

			'post_type' => 'pros',
			'posts_per_page' => -1,
			'post_status' => 'publish'

		));

		foreach ( $the_query->get_posts() as $key => $indivisual_pro ) {
			$field['choices'][ $indivisual_pro->ID ] = $indivisual_pro->post_title;
		}
	   
	    // return the field
	    return $field;
	    
	}

}


/* Custom Field on Service Group Page */
// REF - https://sabramedia.com/blog/how-to-add-custom-fields-to-custom-taxonomies
// REF - https://developer.wordpress.org/reference/hooks/taxonomy_edit_form_fields/
// REF - http://hookr.io/actions/taxonomy_edit_form_fields/
add_action( 'service_group_edit_form_fields', 'service_group_taxonomy_custom_fields', 10, 2 ); 

// A callback function to add a custom field to our "presenters" taxonomy  
function service_group_taxonomy_custom_fields($tag) {  
   // Check for existing taxonomy meta for the term you're editing  
    $t_id = $tag->term_id; // Get the ID of the term you're editing  
?>  

<style>.link-wrap { margin-bottom: 5px;  }</style>
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="presenter_id"><?php _e('Services'); ?></label>  
    </th>  
    <td>

    	<?php 

    			global $post; 
				$args = array(
					        'posts_per_page' => -1,
					        'post_type' => 'services',
					        'tax_query' => array(
					            array (

					                'taxonomy' => 'service_group',
					                'field' => 'term_id',
					                'terms' => $t_id,
					            ),
					        )
				);
		
				$the_query = new WP_Query( $args );
			
		?>
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    	<div class="link-wrap">
			<span class="link-title"></span>
			<a class="link-url" href="<?php echo get_permalink($post->ID); ?>" target="_blank"><?php echo $post->post_title . ' - ' . get_field('handyman_type_of_service', $post->ID); ?></a>
			<i class="acf-icon -link-ext acf-js-tooltip" title="Opens in a new window/tab"></i>
			<a class="acf-icon -pencil -clear acf-js-tooltip" data-name="edit" href="<?php echo home_url('/wp-admin/') . 'post.php?post=' . $post->ID . '&action=edit'; ?>" title="Edit" target="_blank"></a>		
		</div>
		<?php endwhile; endif; wp_reset_postdata(); ?>

    </td>  
</tr>  
  
<?php  
}


if (is_admin()) {
	add_filter('acf/load_field/name=hnd_featured_service', 'handyman_hnd_featured_service');
}

if ( !function_exists( 'handyman_hnd_featured_service' ) ) {

	function handyman_hnd_featured_service( $field ) {

	   global $current_screen;

	   if ($current_screen->id == 'post' && $current_screen->post_id == 3691) { // HOME EDIT PAGE 
	    
			   // Reset choices
			   $field['choices'] = array();

			   $service_groups = get_terms( array( 

					'taxonomy' => 'service_group',
					'hide_empty' => false, // Remove Comment to Display all categories

			   ) );

			   foreach ( $service_groups as $key => $service_group ) {

			   		  	$argsx = array(

					        'posts_per_page' => -1,
					        'post_type' => 'services',
					        'post_status' => 'publish',
					        'tax_query' => array(

					            array (

					                'taxonomy' => 'service_group',
					                'field' => 'term_id',
					                'terms' => $service_group->term_id,
					            ),

					        ),
					        'orderby' => 'meta_value',
					        'meta_key' => 'handyman_type_of_service',
					        'order' => 'DESC'
						);

			   		  	$service_groups_arrs = new WP_Query( $argsx );

			   		  	$service_groups_arr  = $service_groups_arrs->get_posts();

			   		  	if (!empty($service_groups_arr)) {
			   		  		
			   		  		// var_dump($service_groups_arr[0]->ID);
				  	
				   		  	$service_categories = get_the_terms( $service_groups_arr[0]->ID, 'service_categories' );
				   		  	
				   		  	foreach ( $service_categories as $key => $service_category ) {
				   		  		
				   		  		// if ($service_category->parent == 0) {

				   		  			if (get_field('handyman_product_discount', $service_groups_arr[0]->ID) != '' && get_field('handyman_product_discount', $service_groups_arr[0]->ID) != 0 ) {
				   		  				
				   		  				$discount = ' - ' . get_field('handyman_product_discount', $service_groups_arr[0]->ID) . '% Discount';
				   		  			} else {
				   		  				$discount = '';
				   		  			}

				   		  			$optGroup = $service_category->name . ' ID:' . $service_category->term_id;

				   		  			if (isset($service_groups_arr[1]->ID)) {

				   		  				$field['choices'][$optGroup][$service_group->term_id] = $service_group->name . ' (' . ucfirst(get_field('handyman_type_of_service', $service_groups_arr[0]->ID)) . '/' . ucfirst(get_field('handyman_type_of_service', $service_groups_arr[1]->ID)) . ')' . $discount;

				   		  			} else {

				   		  				$field['choices'][$optGroup][$service_group->term_id] = $service_group->name . ' (' . ucfirst(get_field('handyman_type_of_service', $service_groups_arr[0]->ID)) . ')' . $discount;
				   		  			}
				   		  			
				   		  			
				   		  		// }


				   		  	}

			   		  	}
			   		  	

			    }

			   

			   }

	   // return the field
       return $field;
	    
	}

}

/* add_filter('acf/load_field/name=hnd_featured_service', 'handyman_hnd_featured_service'); // Note: Minor Issue - This is creating layout problem on ACF congiguration page - so comment it out while working and uncomment it when work is done. 

if ( !function_exists( 'handyman_hnd_featured_service' ) ) {

	function handyman_hnd_featured_service( $field ) {
	    
	   // Reset choices
	   $field['choices'] = array();


		$service_categories = get_terms( array( 

			'taxonomy' => 'service_categories',
			'hide_empty' => false, // Remove Comment to Display all categories

		) );

		$child_service_categories = array();

	   foreach ( $service_categories as $key => $service_categor ) {

	   		// if($service_categor->parent !== 0 ) {

	   		  	// $child_service_categories[$key]['term_id']  = $service_categor->term_id;
	   		  	// $child_service_categories[$key]['name'] 	= $service_categor->name;

	   		  	$argsx = array(

			        'posts_per_page' => -1,
			        'post_type' => 'services',
			        'post_status' => 'publish',
			        'tax_query' => array(

			            array (

			                'taxonomy' => 'service_categories',
			                'field' => 'term_id',
			                'terms' => $service_categor->term_id,
			            ),

			        )
				);

	   		  	$the_query = new WP_Query( $argsx );

	   		  	foreach ($the_query->posts as $key => $servc_item ) {

	   		  		if (get_field('handyman_est_time', $servc_item->ID) > 0) {
	   		  			$field['choices'][ $service_categor->name . ' - [ID: ' . $service_categor->term_id . ']'][ $servc_item->ID ] = $servc_item->post_title . ' [ID: ' . $servc_item->ID . '] ' . ' - ' . get_field('handyman_type_of_service', $servc_item->ID) . ' ( ' . get_field('handyman_product_discount', $servc_item->ID ) . '% Discount )';
	   		  		} else {
	   		  			$field['choices'][ $service_categor->name . ' - [ID: ' . $service_categor->term_id . ']'][ $servc_item->ID ] = $servc_item->post_title . ' [ID: ' . $servc_item->ID . '] ' . ' - ' . get_field('handyman_type_of_service', $servc_item->ID) . ' ( ' . get_field('handyman_product_discount', $servc_item->ID ) . '% Discount ) - (0)';
	   		  		}


	   		  		
	   		  	}



	   		//  } // if($service_categor->parent !== 0 )
	   }



	   // return the field
       return $field;
	    
	}

} */

/* add_filter('acf/load_field/name=hnd_featured_service_2', 'handyman_hnd_featured_service'); // Note: Minor Issue - This is creating layout problem on ACF congiguration page - so comment it out while working and uncomment it when work is done. 

if ( !function_exists( 'handyman_hnd_featured_service' ) ) {

	function handyman_hnd_featured_service( $field ) {
	    
	   // Reset choices
	   $field['choices'] = array();


		$service_categories = get_terms( array( 

			'taxonomy' => 'service_categories',
			'hide_empty' => false, // Remove Comment to Display all categories

		) );

		$child_service_categories = array();

	   foreach ( $service_categories as $key => $service_categor ) {

	   		// if($service_categor->parent !== 0 ) {

	   		  	// $child_service_categories[$key]['term_id']  = $service_categor->term_id;
	   		  	// $child_service_categories[$key]['name'] 	= $service_categor->name;

	   		  	$argsx = array(

			        'posts_per_page' => -1,
			        'post_type' => 'services',
			        'post_status' => 'publish',
			        'tax_query' => array(

			            array (

			                'taxonomy' => 'service_categories',
			                'field' => 'term_id',
			                'terms' => $service_categor->term_id,
			            ),

			        )
				);

	   		  	$the_query = new WP_Query( $argsx );

	   		  	foreach ($the_query->posts as $key => $servc_item ) {
	   		  		
	   		  		if (get_field('handyman_est_time', $servc_item->ID) > 0) {
	   		  			$field['choices'][ $service_categor->name . ' - [ID: ' . $service_categor->term_id . ']' ][ $servc_item->ID ] = $servc_item->post_title . ' [ID: ' . $servc_item->ID . '] ' . ' - ' . get_field('handyman_type_of_service', $servc_item->ID) . ' ( ' . get_field('handyman_product_discount', $servc_item->ID ) . '% Discount )';
	   		  		} else {
	   		  			$field['choices'][ $service_categor->name . ' - [ID: ' . $service_categor->term_id . ']'][ $servc_item->ID ] = $servc_item->post_title . ' [ID: ' . $servc_item->ID . '] ' . ' - ' . get_field('handyman_type_of_service', $servc_item->ID) . ' ( ' . get_field('handyman_product_discount', $servc_item->ID ) . '% Discount ) - (0)';
	   		  		}
	   		  	}



	   		//  } // if($service_categor->parent !== 0 )
	   }



	   // return the field
       return $field;
	    
	}

} */


add_filter('acf/load_field/name=featured_listing_product', 'handyman_featured_listing_product'); // Note: Minor Issue - This is creating layout problem on ACF congiguration page - so comment it out while working and uncomment it when work is done. 

if ( !function_exists( 'handyman_featured_listing_product' ) ) {

	function handyman_featured_listing_product( $field ) {
	    
	   // Reset choices
	   $field['choices'] = array();

	   $fetchProds = new WP_Query(array(
	   	'post_type' => 'products',
	   	'post_status' => 'publish',
	   	'posts_per_page' => -1
	   ));


	   $discountb = 0;
		

	   foreach ( $fetchProds->get_posts() as $key => $fetchProd ) {

	   		if( have_rows('handyman_product_link_to_services', $fetchProd->ID ) ):

		 	// loop through the rows of data
		    while ( have_rows('handyman_product_link_to_services', $fetchProd->ID ) ) : the_row();

		        
		        $serviceIDb = get_sub_field('handyman_product_link_to_service', $fetchProd->ID ); // Service ID that comes last in the loop. Attention may require in future. Assuming the discount value is same in both installation and replacement.

		        $discountb = get_field('handyman_product_discount', $serviceIDb);

			    endwhile;

			endif;

	   		$field['choices'][$fetchProd->ID] = $fetchProd->post_title . ' - ' . $discountb . '% Discount';

	   }

	   // return the field
       return $field;
	    
	}

}


function pricing_markup_func($per_min_cost, $id) {

			$pricing_markup = '';
			$servicePrice = $per_min_cost * get_field('handyman_est_time', $id);

			if ( get_field('handyman_est_time', $id) != 0 ): ?> 

							<?php if (get_field('handyman_product_discount', $id) > 0): ?>		

								<?php 

									$pricing_markup .= ucfirst(get_field('handyman_type_of_service', $id )) . ': <del>';

									if (get_field('handyman_product_premium', $id)) {
										
										$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $id))/100;

									} else {
										
										$handyman_premium = 0;
									}

									$servicePrice = $servicePrice + $handyman_premium;

									// IF Discount is set
									if(get_field('handyman_product_discount', $id)) {

										$discount = get_field('handyman_product_discount', $id);

										$afterDiscount = ( $servicePrice * $discount ) / 100;

									} else {

										$afterDiscount = 0;
									}

									$pricing_markup .= '$' . round($servicePrice, 2) . '</del> <span>' . '$' . round($servicePrice - $afterDiscount, 2) . '</span>'; ?>

							<?php else: ?>

								<?php 

								if (get_field('handyman_product_premium', $id)) {
										
									$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $id))/100;

								} else {
									
									$handyman_premium = 0;
								}

								$servicePrice = $servicePrice + $handyman_premium;

								$pricing_markup .= ucfirst(get_field('handyman_type_of_service', $id )) . ': '; ?>

								<?php $afterDiscount = 0; ?>
								<?php $pricing_markup .= '<span>' . '$' . round($servicePrice - $afterDiscount, 2) . '</span>'; ?>
								
							<?php endif;

					else: 

						$pricing_markup .= ucfirst(get_field('handyman_type_of_service', $id )) . ': ';

						if (get_field('handyman_est_time', $id) == 0 && get_field('handyman_add_on_services', $id)) {


							$LabourMinz = array();
							$LabourSubMinz = array();

							  foreach (get_field('handyman_add_on_services', $id)[0]['handyman_addon_options'] as $key91 => $handyman_addon_options) {

							    if ( (int) $handyman_addon_options['labour_minutes'] !== 0 ) {

							        $LabourMinz[] = (int) $handyman_addon_options['labour_minutes'];
							    }

							    
							     if ($handyman_addon_options['handyman_addon_sub_option_check']) {

							          foreach ($handyman_addon_options['handyman_sub_option_groups'] as $key92 => $handyman_sub_option_groups) {

							              if ($handyman_sub_option_groups['acf_fc_layout'] == 'handyman_sub_option_quantity') {
							                
							                    $LabourSubMinz[] = (int) $handyman_sub_option_groups['handyman_so_quantity_labour_minutes'];
							              }

							              if ($handyman_sub_option_groups['acf_fc_layout'] == 'handyman_sub_option_yesno') {

							                $LabourSubMinz[] = (int) $handyman_sub_option_groups['handyman_so_yesno_labour_minutes'];
							               
							              }

							              if ($handyman_sub_option_groups['acf_fc_layout'] == 'handyman_sub_option_list') {

							                    foreach ($handyman_sub_option_groups['handyman_so_list_options'] as $key93 => $handyman_so_list_options) {

							                      $LabourSubMinz[] = (int) $handyman_so_list_options['handyman_so_list_options_labour_minutes'];

							                    }
							               
							              }
							             

							          }
							    } 

							   
							  
							  }

							if (empty($LabourMinz)) {
	                            $LabourMinz = array_filter($LabourSubMinz);
	                        }

	                        sort($LabourMinz);

	                        $optFirstLabourMin = $LabourMinz[0];

	                        $servicePrice = $per_min_cost * (int) $optFirstLabourMin;

	                        if (get_field('handyman_product_premium', $id)) {
	                          
	                          $handyman_premium = ($servicePrice * get_field('handyman_product_premium', $id))/100;

	                        } else {
	                          
	                          $handyman_premium = 0;
	                        }

	                        $servicePrice = $servicePrice + $handyman_premium;

	                        // IF Discount is set
	                        if (get_field('handyman_product_discount', $id) > 0) {

	                            $discount = get_field('handyman_product_discount', $id);
	                            $afterDiscount = ( $servicePrice * $discount ) / 100;

	                            $pricing_markup .= '<del>$' . round($servicePrice, 2) . '</del> <span>' . '$' . round($servicePrice - $afterDiscount, 2) . ' and Up</span>';

	                        } else {

	                          $afterDiscount = 0; 

	                          $pricing_markup .= '<span>' . '$' . round($servicePrice - $afterDiscount, 2) . ' and Up</span>';

	                        }

						} else {

							$pricing_markup .= '<span class="gq">Get a Quote</span>'; 

						}
			endif;

			return $pricing_markup;

} // pricing_markup_func($id)

add_action('wp_ajax_auto_complete_search', 'handyman_pro_autocomplete_search');
add_action('wp_ajax_nopriv_auto_complete_search', 'handyman_pro_autocomplete_search');

// Auto Complete //
if ( ! function_exists( 'handyman_pro_autocomplete_search' ) ) { 

	function handyman_pro_autocomplete_search() {

		check_admin_referer( 'avengers-end-game', 'autosecurity' );

		$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
		$per_min_cost = $fetch_hour_price/60;

		$search = trim(strtolower($_POST['search']));

		$sTerms = array();

		$addedSevices = array();

		$sTerms[] = $search;

		if (substr($search, -1) != 's') {
			$search = $search;
		} else {
			$search = substr_replace($search, '', -1);
			$sTerms[] = $search;

			$searches = implode(' ', $sTerms);
		}

		$searches = explode(' ', $search);


		$results_2 = get_terms(array(
				 'taxonomy' => 'service_group',
				 'name__like' => $search,
		));



		$results_0 = get_terms(array(
				'taxonomy' => 'service_group',
				// 'name__like' => $search,
			    // // 'compare'   => 'REGEXP'
			    'meta_query' => array(
			    'relation' => 'OR',
			    	/* array(
			    	'field' => 'name',
			    	'terms' => $search,
			    	'operator' => 'LIKE'
			    	), */
			    	array(
			    	'key' => 'hnd_search_keyword',
			    	'value' => $search,
			    	'compare' => 'LIKE'
			    	)
			   	)
		));

		// print_r($results_0);

		$metaQbuilder = array();

		foreach ( $searches as $key => $sch ) {

			$results_1 = get_terms(array(
				'taxonomy' => 'service_group',
			    'name__like' => $sch,
			    // 'compare'   => 'REGEXP'
			));

			$metaQbuilder[] = array(
    				'key'     => 'hnd_search_keyword',
    				'value'   => $sch,
    				'type'    => 'CHAR',
    				'compare' => 'LIKE',
    			);
		
		}

		/* $filtered_arr = array_filter($results_1, function($obj){ 
		      return $obj->name === $search;
		}); */

		$results = array_merge($results_2, $results_0, $results_1);

		$results = array_unique($results, SORT_REGULAR);

		

		// echo json_encode($results);
		// die();

		$titles = array();

		foreach ($results as $key => $r) {

					$keyword_field = get_field('hnd_search_keyword', 'service_group_' . $r->term_id);

					$rx = false;

					foreach ( $searches as $keyu => $sch ) {

						// print_r($keyword_field);
						// print_r($results);
						// print_r(strpos($keyword_field, $search) !== false);

						foreach (explode(' ', $r->name) as $keyp => $n) { // Bar or prep faucet
							if (str_starts_with(strtolower($n), $sch) || strpos($keyword_field, $search) !== false ) {
								$rx = true;
							}
						}
					}

					// print_r($rx);

					if ($rx) {
											$titles[$key]['name'] = $r->name;
											$titles[$key]['group'] = get_term_link($r->term_id);

									        $fetchServices = new WP_Query(array(
																'post_type' => 'services',
																'tax_query' => array(
																					array(
																							'taxonomy'         => 'service_group',
																							'field'            => 'id',
																							'terms'            => $r->term_id
																					)
																),
																'orderby' => 'meta_value',
														        'meta_key' => 'handyman_type_of_service',
														        'order' => 'DESC'
															));

									        foreach ( $fetchServices->get_posts() as $key1 => $serv_post ) : 

									        	$addedSevices[] = $serv_post->ID;
												
												$titles[$key]['type'][$key1]['markup'] = pricing_markup_func($per_min_cost, $serv_post->ID);
												$titles[$key]['type'][$key1]['permalink'] = get_permalink( $serv_post->ID );
											
											endforeach;
					}


					

		}

		// echo json_encode($titles);
		// die();

		$fetchServicesKeyword = new WP_Query(array(
				'post_type' => 'services',
				'meta_query'     => array(
								'relation' => 'OR',
			        			$metaQbuilder
			    ),
			    'posts_per_page' => -1
		));

		
		if (!empty($fetchServicesKeyword->get_posts())) {
					
					foreach ($fetchServicesKeyword->get_posts() as $key => $fetchsKeyword ) {

						// Checking if service group already added for jeyword search
						if (!in_array($fetchsKeyword->ID, $addedSevices)) {

							$titles1[$key]['name'] = $fetchsKeyword->post_title;
							$titles1[$key]['group'] = '';
							$titles1[$key]['type'][0]['markup'] = pricing_markup_func($per_min_cost, $fetchsKeyword->ID);
							$titles1[$key]['type'][0]['permalink'] = get_permalink( $fetchsKeyword->ID );	
							
						} else {
							$titles1 = array();
						}

								
					}

					$titles = array_merge($titles, $titles1);
		}
		
		echo json_encode($titles);
		die();
	}
}


/* 20-Aug-2019 */

add_action('wp_ajax_available_pro_profile', 'handyman_pro__available_pro_profile');
add_action('wp_ajax_nopriv_available_pro_profile', 'handyman_pro__available_pro_profile');

if ( ! function_exists( 'handyman_pro__available_pro_profile' ) ) { 

	function handyman_pro__available_pro_profile() {

		check_admin_referer( 'deadpool-2', 'security' );

		$prosData = array();

		$imagepath=site_url()."/wp-content/themes/handyman_pro/assets/images/handyman-img01.jpg";
		$prosData['first_name'] =        get_field('pros_first_name', $_POST['proID']);
		$prosData['last_name'] =         get_field('pros_last_name', $_POST['proID']);
		$prosData['emailid'] =           substr(get_field('pro_email', $_POST['proID']), 0, 3) . '.....@...com';
		$prosData['homephone'] =         '(' . substr( get_field('pro_cell_phone',$_POST['proID']), 0, 3) . ')' .  '(---)(--' . substr( get_field('pro_cell_phone',$_POST['proID']), 8, 10) . ')';

		$prosData['fax'] =               get_field('pro_fax', $_POST['proID']);
		$prosData['yearsofexperience'] = get_field('pro_years_of_experience', $_POST['proID']);
		$prosData['address'] =           get_field('pro_address_group', $_POST['proID']);
		$prosData['bio'] =               get_field('pro_bio_about', $_POST['proID']);
		$thumbnail_id    =               get_post_thumbnail_id($_POST['proID']);
		$alt =                           get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);


		$prosData['pro_is_certified'] =               get_field('pro_is_certified', $_POST['proID']);
		$prosData['pro_has_insurance'] =               get_field('pro_has_insurance', $_POST['proID']);


		if (get_the_post_thumbnail_url($_POST['proID'])){
			$prosData['imgsrc'] =            get_the_post_thumbnail_url($_POST['proID']);
		} else  {
		   	$prosData['imgsrc']  =  $imagepath;
		}	   

		$prosData['imgalt'] = $alt;

		echo json_encode($prosData);
		exit;
	}
}


add_action('wp_ajax_available_pro_review', 'handyman_pro__available_pro_review');
add_action('wp_ajax_nopriv_available_pro_review', 'handyman_pro__available_pro_review');

if ( ! function_exists( 'handyman_pro__available_pro_review' ) ) { 

	function handyman_pro__available_pro_review() {

		ob_start();

		global $wpdb;

		check_admin_referer( 'deadpool-2', 'security' );

		$proID = (int) $_POST['proID'];

		if (isset($_POST['sort'])) {

			if ($_POST['sort'] == 'low') {
				
				$positive_reviews = $wpdb->get_results( "SELECT * FROM hxp_richreviews WHERE post_id = $proID AND review_status='1' AND review_rating < 4 order by review_rating ASC");

			} else if($_POST['sort'] == 'high') {

				$positive_reviews = $wpdb->get_results( "SELECT * FROM hxp_richreviews WHERE post_id = $proID AND review_status='1' AND review_rating > 4 order by review_rating DESC");

			} else {

				$positive_reviews = $wpdb->get_results( "SELECT * FROM hxp_richreviews WHERE post_id = $proID AND review_status='1' order by id DESC");
			}

		} else {
			$positive_reviews = $wpdb->get_results( "SELECT * FROM hxp_richreviews WHERE post_id = $proID AND review_status='1' order by id DESC");
		}

		echo "<div class='positive-reviews-wrapper' data-positive='" . $proID . "'>";

		foreach ($positive_reviews as $key => $review) : 

			$booking_id = $review->booking_id;

			$booking_info = $wpdb->get_row( $wpdb->prepare( "SELECT total_labour_mins, scheduled_date FROM hxp_handyman_booking WHERE booking_id = %d", array( $booking_id ) ), 'ARRAY_A');


			$dateTime = new DateTime($booking_info['scheduled_date']);
			$formattedDate = $dateTime->format('d M Y');

			$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
			$per_min_cost = $fetch_hour_price/60;

			$final_price = round($per_min_cost * $booking_info['total_labour_mins'], 2);
			?>

				<div class="testimonial_group">
					<div class="testimonial">
						<div class="row">
							<div class="col-md-8 col-sm-12 testi-new">
								<div class="review-box2">
									<h3><?php echo $review->reviewer_name; ?> <span>Job Date: <?php echo $formattedDate; ?></span></h3>

										<?php if (!isset($review->solitary_ratings)): ?>
											<div class="rating old-reviews">
												<?php $i = 0; while($i < 5) :
												if( $i <  $review->review_rating ): ?>
													<i aria-hidden="true" class="fa fa-star"></i> 
												<?php else: ?>
													<i aria-hidden="true" class="fa fa-star-o"></i>
												<?php endif; $i++; endwhile; ?>
											</div>
										<?php endif; ?>

										<?php if (isset($booking_info)): 
												$hnd_permalink = get_permalink( $booking_id );
											?>
											<p><span>Job: $<?php echo $final_price; ?></span> <a data-toggle="modal" href="#reviewdetails" class="preview-booking" data-url="<?php echo $hnd_permalink; ?>">See Details&gt;&gt;</a></p>
										<?php endif; ?>

										<div class="rr_review_text">
											<span class="drop_cap"></span><span itemprop="reviewBody"><?php echo $review->review_text; ?></span><!-- <a class="read_more" href="#">Read More</a> -->
										</div>

								</div>

								<?php if (isset($review->company_response) && $review->company_response != ''): ?>

									<div class="services-provider">
										<h3>Services Provider Response</h3>
										<div class="rr_review_text">
											<span class="drop_cap"></span><span itemprop="reviewBody"><?php echo $review->company_response; ?></span> <!-- <a class="read_more" href="#">Read More</a> -->
										</div>
									</div>
									
								<?php endif; ?>

								
							</div>

							<?php if (isset($review->solitary_ratings)): 

									// echo "<pre>"; var_dump(json_decode($review->solitary_ratings, true));
									$ratings = json_decode($review->solitary_ratings, true);

								?>

								<div class="col-md-4 col-sm-12">
									<div class="over-box">
										<table class="table">
											<thead>
												<tr>
													<th scope="col">OVERALL</th>
													<th scope="col">
														<?php $i = 0; while($i < 5) :
														if( $i <  $review->review_rating ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
														<!-- <i aria-hidden="true" class="fa fa-star-half-o"></i> -->
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">Price</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['price'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
												<tr>
													<th scope="row">Quality</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['quality'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
												<tr>
													<th scope="row">Cleanliness</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['cleanliness'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
												<tr>
													<th scope="row">Responsiveness</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['responsiveness'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
												<tr>
													<th scope="row">Punctuality</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['punctuality'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
												<tr>
													<th scope="row">Professonalism</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['professonalism'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							<?php endif; ?>

						</div>
					</div>
				</div>

		<?php endforeach;

		echo "</div>";

		/* if (isset($_POST['sort'])) {
			// Pending
		} else {
			$negative_reviews = $wpdb->get_results( "SELECT * FROM hxp_richreviews WHERE post_id = $proID AND review_status='1' AND review_rating < 4  order by id DESC");
		} */

		/* $negative_reviews = $wpdb->get_results( "SELECT * FROM hxp_richreviews WHERE post_id = $proID AND review_status='1' AND review_rating < 4  order by id DESC");

		echo "<div class='negative-reviews-wrapper' data-negative='" . $proID . "'>";

		foreach ($negative_reviews as $key => $review) : 

			$booking_id = $review->booking_id;

			$booking_info = $wpdb->get_row( $wpdb->prepare( "SELECT total_labour_mins, scheduled_date FROM hxp_handyman_booking WHERE booking_id = %d", array( $booking_id ) ), 'ARRAY_A');


			$dateTime = new DateTime($booking_info['scheduled_date']);
			$formattedDate = $dateTime->format('d M Y');

			$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
			$per_min_cost = $fetch_hour_price/60;

			$final_price = round($per_min_cost * $booking_info['total_labour_mins'], 2);
			?>

				<div class="testimonial_group">
					<div class="testimonial">
						<div class="row">
							<div class="col-md-8 col-sm-12 testi-new">
								<div class="review-box2">
									<h3><?php echo $review->reviewer_name; ?> <span>Job Date: <?php echo $formattedDate; ?></span></h3>

										<?php if (!isset($review->solitary_ratings)): ?>
											<div class="rating old-reviews">
												<?php $i = 0; while($i < 5) :
												if( $i <  $review->review_rating ): ?>
													<i aria-hidden="true" class="fa fa-star"></i> 
												<?php else: ?>
													<i aria-hidden="true" class="fa fa-star-o"></i>
												<?php endif; $i++; endwhile; ?>
											</div>
										<?php endif; ?>

										<?php if (isset($booking_info)): ?>
											<p><span>Job: $<?php echo $final_price; ?></span> <a data-toggle="modal" href="#reviewdetails">See Details&gt;&gt;</a></p>
										<?php endif; ?>

										<div class="rr_review_text">
											<span class="drop_cap"></span><span itemprop="reviewBody"><?php echo $review->review_text; ?></span><!-- <a class="read_more" href="#">Read More</a> -->
										</div>

								</div>

								<?php if (isset($review->company_response) && $review->company_response != ''): ?>

									<div class="services-provider">
										<h3>Services Provider Response</h3>
										<div class="rr_review_text">
											<span class="drop_cap"></span><span itemprop="reviewBody"><?php echo $review->company_response; ?></span> <!-- <a class="read_more" href="#">Read More</a> -->
										</div>
									</div>
									
								<?php endif; ?>

								
							</div>

							<?php if (isset($review->solitary_ratings)): 

									// echo "<pre>"; var_dump(json_decode($review->solitary_ratings, true));
									$ratings = json_decode($review->solitary_ratings, true);

								?>

								<div class="col-md-4 col-sm-12">
									<div class="over-box">
										<table class="table">
											<thead>
												<tr>
													<th scope="col">OVERALL</th>
													<th scope="col">
														<?php $i = 0; while($i < 5) :
														if( $i <  $review->review_rating ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
														<!-- <i aria-hidden="true" class="fa fa-star-half-o"></i> -->
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">Price</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['price'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
												<tr>
													<th scope="row">Quality</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['quality'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
												<tr>
													<th scope="row">Cleanliness</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['cleanliness'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
												<tr>
													<th scope="row">Responsiveness</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['responsiveness'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
												<tr>
													<th scope="row">Punctuality</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['punctuality'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
												<tr>
													<th scope="row">Professonalism</th>
													<td>
														<?php $i = 0; while($i < 5) :
														if( $i <  $ratings['professonalism'] ): ?>
															<i aria-hidden="true" class="fa fa-star"></i> 
														<?php else: ?>
															<i aria-hidden="true" class="fa fa-star-o"></i>
														<?php endif; $i++; endwhile; ?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							<?php endif; ?>

						</div>
					</div>
				</div>

		<?php endforeach;

		echo "</div>"; */
		die();

		// echo ob_get_clean();
		
		/* $links = $wpdb->get_results( "SELECT * FROM hxp_richreviews WHERE post_id = '$_POST[proID]' AND review_status='1' order by id DESC");

		
		foreach($links as $key => $row){

			if ($row->review_rating == '5' || $row ->review_rating=='4') {
				
				if($row->review_rating=='5') {
					$ratingvalue=★★★★★;
				} elseif($row ->review_rating=='4') {	
					$ratingvalue=★★★★☆;
				}

				$prosData['positive'][$key]['reviewername'] = $row->reviewer_name;
				$prosData['positive'][$key]['review_text'] = $row->review_text;
				$prosData['positive'][$key]['review_rating'] = $ratingvalue;

			} else {

				if($row ->review_rating=='3') {
					$ratingvalue=★★★☆☆;
				} elseif($row ->review_rating=='2') {
					$ratingvalue=★★☆☆☆;
				} elseif($row ->review_rating=='1') {
					$ratingvalue=★☆☆☆☆;
				}


				$prosData['disputed'][$key]['reviewername'] = $row->reviewer_name;
				$prosData['disputed'][$key]['review_text'] = $row->review_text;
				$prosData['disputed'][$key]['review_rating'] = $ratingvalue;


			}
			

		}

		echo json_encode($prosData);
		exit; */

	}
}

add_filter('acf/validate_value/name=handyman_option_label', 'handyman_op_label_validate_value', 10, 4);
function handyman_op_label_validate_value( $valid, $value, $field, $input ){
	
	if( !$valid ) { return $valid; }
	if (strpos($value, '"') !== false ) { $valid = 'Text must not contain any symbol'; }
	if (strpos($value, "'") !== false ) { $valid = 'Text must not contain any symbol'; }	
	return $valid;
}

add_filter('acf/validate_value/name=handyman_so_quantity_label', 'handyman_so_qt_label_validate', 10, 4);
function handyman_so_qt_label_validate( $valid, $value, $field, $input ){
	
	if( !$valid ) { return $valid; }
	if (strpos($value, '"') !== false ) { $valid = 'Text must not contain any symbol'; }
	if (strpos($value, "'") !== false ) { $valid = 'Text must not contain any symbol'; }	
	return $valid;
}

add_filter('acf/validate_value/name=handyman_so_yesno_label', 'handyman_so_yn_label_validate', 10, 4);
function handyman_so_yn_label_validate( $valid, $value, $field, $input ){
	
	if( !$valid ) { return $valid; }
	if (strpos($value, '"') !== false ) { $valid = 'Text must not contain any symbol'; }
	if (strpos($value, "'") !== false ) { $valid = 'Text must not contain any symbol'; }	
	return $valid;
}

add_filter('acf/validate_value/name=handyman_so_list_question', 'handyman_list_qst_lbl_validate', 10, 4);
function handyman_list_qst_lbl_validate( $valid, $value, $field, $input ){
	
	if( !$valid ) { return $valid; }
	if (strpos($value, '"') !== false ) { $valid = 'Text must not contain any symbol'; }
	if (strpos($value, "'") !== false ) { $valid = 'Text must not contain any symbol'; }	
	return $valid;
}

add_filter('acf/validate_value/name=handyman_so_list_options_label', 'handyman_so_list_options_label_validate', 10, 4);
function handyman_so_list_options_label_validate( $valid, $value, $field, $input ){
	
	if( !$valid ) { return $valid; }
	if (strpos($value, '"') !== false ) { $valid = 'Text must not contain any symbol'; }
	if (strpos($value, "'") !== false ) { $valid = 'Text must not contain any symbol'; }	
	return $valid;
}


add_action('wp_ajax_handyman_fetch_serv_desc', 'handyman_pro__handyman_fetch_serv_desc');
add_action('wp_ajax_nopriv_handyman_fetch_serv_desc', 'handyman_pro__handyman_fetch_serv_desc');

if ( ! function_exists( 'handyman_pro__handyman_fetch_serv_desc' ) ) { 

	function handyman_pro__handyman_fetch_serv_desc() { // PENDING

		check_admin_referer( 'deadpool-2', 'security' ); // CONTINUE FROM HERE

		$servID = $_POST['servid'];

		$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
		$per_min_cost = $fetch_hour_price/60;

		$servicePrice = $per_min_cost * get_field('handyman_est_time', $servID);

		if (get_field('handyman_product_premium', $servID)) {
										
			$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $servID))/100;

		} else {
			
			$handyman_premium = 0;
		}

		$servicePrice = $servicePrice + $handyman_premium;

		if(get_field('handyman_product_discount', $servID)) {

			$discount = get_field('handyman_product_discount', $servID);

			$afterDiscount = ( $servicePrice * $discount ) / 100;

		} else {

			$afterDiscount = 0;
		}

		$servicePrice = round($servicePrice - $afterDiscount, 2);

		$serviceDesc = '<b>Price: </b>$' . $servicePrice . '<br><br>' . get_field('handyman_prod_services_description', $servID);

		echo $serviceDesc;
		exit;

	}
}


add_action('wp_ajax_handyman_chk_if_srvgoup_selected', 'handyman_chk_if_srvgoup_selected');
add_action('wp_ajax_nopriv_handyman_chk_if_srvgoup_selected', 'handyman_chk_if_srvgoup_selected');

if ( ! function_exists( 'handyman_chk_if_srvgoup_selected' ) ) { 

	function handyman_chk_if_srvgoup_selected() { // PENDING

		check_admin_referer( 'deadpool-2', 'security' ); // CONTINUE FROM HERE

		$servIDs = $_POST['servid'];

		foreach ($servIDs as $key => $servID) {
			if ( get_the_terms( $servID , 'service_group' ) ) {
				unset($servIDs[$key]);
			}
		} 
		
		echo json_encode($servIDs);
		exit;

	}
}

// REF - https://premium.wpmudev.org/blog/creating-wordpress-admin-pages/
add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'Pro Reviews', 'Pro Reviews', 'manage_options', 'handyman-pro-reviews', 'handyman_pro_reviews_admin', '
dashicons-admin-comments', 27  );
}

function handyman_pro_reviews_admin() { 

	global $wpdb;

	if (!isset($_GET['paged'])) {
		$reviews_paged = 1;
	} else {
		$reviews_paged = (int) $_GET['paged'];
	}

	$_count = $wpdb->get_row( "SELECT count(*) AS total FROM hxp_richreviews");

	$last = round($_count->total/10);

	if ($reviews_paged <= 1) {
		
		$next = $reviews_paged + 1;
		$prev = 1;

		$nextClass = '';
		$prevClass = 'disabled';

		$reviews_paged = 1;

	} elseif($reviews_paged >= $last) {

		$next = $last;
		$prev = $reviews_paged - 1;

		$nextClass = 'disabled';
		$prevClass = '';

		$reviews_paged = $last;

	} else {

		$next = $reviews_paged + 1;
		$prev = $reviews_paged - 1;

		$nextClass = '';
		$prevClass = '';
	}

	$offset = ($reviews_paged - 1) * 10;

	$_reviews = $wpdb->get_results( "SELECT * FROM hxp_richreviews order by id DESC LIMIT 10 OFFSET " . $offset);

	?>
	
	<div class="wrap">

	<?php add_thickbox(); ?>

 	

	<h2>Pro Reviews</h2>

	<table id="hnd-reviews-admin">
	  
	  <tr>
	    <th>ID</th>
	    <th>Reviewer Name</th>
	    <th>Reviewer Email</th>
	    <th>Title</th>
	    <th>Rating</th>
	    <th>Review Text</th>
	    <th>Pro Name</th>
	    <th>Status</th>
	    <th>Action</th>
	  </tr>
	  
	  <?php foreach ($_reviews as $key => $_review): 

	  	if($_review->review_rating=='5')
		{
			$ratingvalue='★★★★★';
		} elseif($_review ->review_rating=='4')
		{	
			$ratingvalue='★★★★☆';
		} elseif($_review ->review_rating=='3')
		{
			$ratingvalue='★★★☆☆';
		} elseif($_review ->review_rating=='2')
		{
			$ratingvalue='★★☆☆☆';
		}
		elseif($_review ->review_rating=='1')
		{
			$ratingvalue='★☆☆☆☆';
		}

	  ?>

	  <div id="review-<?php echo $_review->id; ?>" style="display:none;">
 	    <div class="reply-box">
 	    	<div class="reply-loader"><img src="https://www.handymanproservices.com/wp-content/themes/handyman_pro/assets/images/datepicker-loader.gif" alt=""></div>
 	    	<div class="table" style="margin-bottom: 0px;">
 	    						 	     								    
			    <div class="row header">
			      <div class="cell">ID</div>
			      <div class="cell">Name</div>
			      <div class="cell">Rating</div>
			      <div class="cell">Review</div>
			      <div class="cell">Handyman Name</div>
			      <!-- <div class="cell">Job Details</div> -->
			    </div>
			    
			    <div class="row">
			      <div class="cell" data-title="ID"><?php echo $_review->id; ?></div>
			      <div class="cell" data-title="Name"><?php echo $_review->reviewer_name; ?></div>
			      <div class="cell" data-title="Rating"><?php echo $ratingvalue; ?></div>
			      <div class="cell" data-title="Review"><?php echo $_review->review_text; ?></div>
			      <div class="cell" data-title="Handyman Name"><?php echo get_the_title($_review->post_id); ?></div>
			      <!-- <div class="cell" data-title="Job Details"><a href="#">Job Details</a></div> -->
			      <!-- <div class="cell" data-title="Scheduled Date"></div>
			      <div class="cell" data-title="Scheduled Time"></div> -->
			    </div>
			    
			</div>

			<?php if (isset($_review->company_response)): ?>

				<div class="reply-area">
					<textarea name="hnd_reply_message" class="hnd_reply_message" id="" cols="30" rows="4" placeholder="Add a comment..."><?php echo esc_html($_review->company_response); ?></textarea>
					<a class="hnd_review_reply_btn" data-review="<?php echo $_review->id; ?>">Update</a>
				</div>

			<?php else: ?>

				<div class="reply-area">
	 	    		<textarea name="hnd_reply_message" class="hnd_reply_message" id="" cols="30" rows="4" placeholder="Add a comment..."></textarea>
	 	    		<a class="hnd_review_reply_btn" data-review="<?php echo $_review->id; ?>">Post</a>
	 	    	</div>
				
			<?php endif; ?>

 	    	
 	    </div>
 	  </div>

	  <tr>
	    <td><?php echo $_review->id; ?></td>
	    <td><?php echo $_review->reviewer_name; ?></td>
	    <td><?php echo $_review->reviewer_email; ?></td>
	    <td><?php echo $_review->review_title; ?></td>
	    <td><?php echo $ratingvalue; ?></td>
	    <td><?php echo $_review->review_text; ?></td>
	    <td><?php echo get_the_title($_review->post_id); ?></td>
	    <td>
	    	
	    	<label class="handyman-pro-switch switch">
			  <input type="checkbox" <?php echo ($_review->review_status == 1) ? 'checked' : ''; ?>>
			  <span class="slider round" data-review='<?php echo $_review->id; ?>'></span>
			</label>

	    </td>

	    <?php if (isset($_review->company_response)): ?>
	    	<td><a href="#TB_inline?&width=auto&height=550&inlineId=review-<?php echo $_review->id; ?>" class="thickbox">Edit</a></td>
	    <?php else: ?>
	    	<td><a href="#TB_inline?&width=auto&height=550&inlineId=review-<?php echo $_review->id; ?>" class="thickbox">Reply</a></td>
	    <?php endif; ?>
	    
	  </tr>
	  	
	  <?php endforeach; ?>
	 
	</table>

	<div class="tablenav bottom">

		<div class="tablenav-pages">

		<span class="displaying-num"><?php echo $_count->total; ?> items</span>
		
		<span class="pagination-links">

			<a class="first-page button <?php echo $prevClass; ?>" href="<?php echo home_url('/wp-admin/') . 'admin.php?page=handyman-pro-reviews&paged=1'; ?>"><span class="screen-reader-text">First page</span><span aria-hidden="true">«</span></a>
			
			<a class="prev-page button <?php echo $prevClass; ?>" href="<?php echo home_url('/wp-admin/') . 'admin.php?page=handyman-pro-reviews&paged=' . $prev; ?>"><span class="screen-reader-text">Previous page</span><span aria-hidden="true">‹</span></a>

			<span class="screen-reader-text">Current Page</span>
			
			<span id="table-paging" class="paging-input">
					<span class="tablenav-paging-text"><?php echo $reviews_paged; ?> of <span class="total-pages"><?php echo $last; ?></span>
				</span>
			</span>

			<a class="next-page button <?php echo $nextClass; ?>" href="<?php echo home_url('/wp-admin/') . 'admin.php?page=handyman-pro-reviews&paged=' . $next; ?>"><span class="screen-reader-text">Next page</span><span aria-hidden="true">›</span></a>

			<a class="last-page button <?php echo $nextClass; ?>" href="<?php echo home_url('/wp-admin/') . 'admin.php?page=handyman-pro-reviews&paged=' . $last; ?>"><span class="screen-reader-text">Last page</span><span aria-hidden="true">»</span></a>
		

		</div>

	</div>

<?php }




add_action('wp_ajax_change_review_status', 'handyman_change_review_status');
add_action('wp_ajax_nopriv_change_review_status', 'handyman_change_review_status');

if ( ! function_exists( 'handyman_change_review_status' ) ) {

	function handyman_change_review_status() { 

		global $wpdb;

		check_admin_referer( 'deadpool-2', 'prosecure' ); 

		$reviewID = (int) $_POST['reviewID'];

		$review_status = $wpdb->get_row( "SELECT review_status FROM hxp_richreviews WHERE id =" . $reviewID );

		if ($review_status->review_status == 0) {
			$wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_richreviews set review_status = '%d' WHERE 	id = '%d'",
			    array(
			        1,
			        $reviewID
			    )
			));
		} else {
			$wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_richreviews set review_status = '%d' WHERE 	id = '%d'",
			    array(
			        0,
			        $reviewID
			    )
			));
		}
		
		echo 'success';
		exit;

	}
}


// REF - https://developer.wordpress.org/reference/hooks/terms_clauses/
// REF - https://gist.github.com/ontiuk/73280a0493aebb3bb21803ebb1a92592
/* function wpse_178511_get_terms_fields( $clauses, $taxonomies, $args ) {
    return $clauses;
}

add_filter( 'terms_clauses', 'wpse_178511_get_terms_fields', 10, 3 ); */

add_filter('acf/load_field/name=hnd_carousel_service', 'handyman_hnd_carousel_service'); // Note: Minor Issue - This is creating layout problem on ACF congiguration page - so comment it out while working and uncomment it when work is done. 

if ( !function_exists( 'handyman_hnd_carousel_service' ) ) {

	function handyman_hnd_carousel_service( $field ) {

		global $current_screen;

		if ($current_screen->taxonomy === 'service_categories') {

			$categoryType = 'service_categories';

			$taxonomy  = 'service_group';
			$post_type = 'services';
			$meta_key  = 'handyman_type_of_service';

		}

		if ($current_screen->taxonomy === 'product_categories') {

			$categoryType = 'product_categories';

			$taxonomy = 'product_group';
			$post_type = 'products';
			$meta_key  = 'handyman_prod_price';
		}

		// echo '<pre>';
		// var_dump($current_screen->taxonomy);
		// exit;
	    
	   // Reset choices
	   $field['choices'] = array();

	   $service_groups = get_terms( array( 

			'taxonomy' => $taxonomy,
			'hide_empty' => false, // Remove Comment to Display all categories

	   ) );

	   foreach ( $service_groups as $key => $service_group ) {

	   		  	$argsx = array(

			        'posts_per_page' => -1,
			        'post_type' => $post_type,
			        'post_status' => 'publish',
			        'tax_query' => array(

			            array (

			                'taxonomy' => $taxonomy,
			                'field' => 'term_id',
			                'terms' => $service_group->term_id,
			            ),

			        ),
			        'orderby' => 'meta_value',
			        'meta_key' => $meta_key,
			        'order' => 'DESC'
				);


	   		  	$service_groups_arrs = new WP_Query( $argsx );

	   		  	$service_groups_arr  = $service_groups_arrs->get_posts();

	   		  	if (!empty($service_groups_arr)) {
	   		  		
	   		  		// var_dump($service_groups_arr[0]->ID);
		  	
		   		  	$service_categories = get_the_terms( $service_groups_arr[0]->ID, $categoryType );
		   		  	
		   		  	foreach ( $service_categories as $key => $service_category ) {
		   		  		
		   		  		// if ($service_category->parent == 0) {

		   		  			if ($current_screen->taxonomy === 'service_categories') {
		   		  				
		   		  				if (get_field('handyman_product_discount', $service_groups_arr[0]->ID) != '' && get_field('handyman_product_discount', $service_groups_arr[0]->ID) != 0 ) {
		   		  				
			   		  				$discount = ' - ' . get_field('handyman_product_discount', $service_groups_arr[0]->ID) . '% Discount';
			   		  			
			   		  			} else {
			   		  				$discount = '';
			   		  			}

			   		  			$optGroup = $service_category->name . ' ID:' . $service_category->term_id;

			   		  			if (isset($service_groups_arr[1]->ID)) {

			   		  				$field['choices'][$optGroup][$service_group->term_id] = $service_group->name . ' (' . ucfirst(get_field('handyman_type_of_service', $service_groups_arr[0]->ID)) . '/' . ucfirst(get_field('handyman_type_of_service', $service_groups_arr[1]->ID)) . ')' . $discount;

			   		  			} else {

			   		  				$field['choices'][$optGroup][$service_group->term_id] = $service_group->name . ' (' . ucfirst(get_field('handyman_type_of_service', $service_groups_arr[0]->ID)) . ')' . $discount;
			   		  			}

		   		  			}

		   		  			if ($current_screen->taxonomy === 'product_categories') {
		   		  				

			   		  			$optGroup = $service_category->name;

			   		  			$field['choices'][$optGroup][$service_group->term_id] = $service_group->name;

		   		  			}
		   		  			

		   		  			
		   		  			
		   		  			
		   		  		// }


		   		  	}

	   		  	}
	   		  	

	    }

	   // return the field
       return $field;
	    
	}

}

/* add_filter( 'manage_edit-products_columns', 'addis__products_columns' );
add_action( 'manage_products_posts_custom_column', 'addis__products_columns_data', 2, 99 );

if ( ! function_exists( 'addis__properties_columns' ) ) {

		function addis__properties_columns($columns) {
			$columns = array(
				'cb' 					=> '<input type="checkbox">',
				'title' 				=> __('Property Name', 'addis_agents'),
				'xid' 					=> __('Property ID', 'addis_agents'),
				'ximage'				=> __('Property Image', 'addis_agents'),
				'date'					=> __('Date', 'addis_agents'),
			);

			return $columns;
		}
}

if ( ! function_exists( 'addis__properties_columns_data' ) ) {

		function addis__properties_columns_data($column, $post_id) {

			$image = '<img src="' . get_field('addis_property_images', $post_id)[0]['sizes']['thumbnail'] . '" />';

			$id = get_field('addis_property_id', $post_id);

			switch ($column) {
				case 'ximage':
					$output .= $image;
					break;
				case 'xid':
					$output .= $id;
					break;
			}

			echo $output;
		}
} */

		

// Populate Products that has addon-options
add_filter('acf/load_field/name=hnd_use_product_options_of', 'handyman_product_options_of', 9999);

if ( ! function_exists( 'handyman_product_options_of' ) ) {

	function handyman_product_options_of( $field ) {

		global $post_id;
	    
	    // reset choices
	    $field['choices'] = array();

	    $the_query = new WP_Query(array(

			'post_type' => 'products',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'meta_key' => 'handyman_add_on_services',
			'meta_value' => array(''),
			'meta_compare' => 'NOT IN'

		));

		 foreach ( $the_query->get_posts() as $key => $product ) {
		 	if ($post_id !== $product->ID) {

		 		$productIDs = json_decode(get_field('hndserviceids', $product->ID));

		 		$type = '';

		 		foreach ( $productIDs as $key => $p ) {
		 			if (isset($p->options) && $p->options === 'yes') {
		 				$id = (int) $p->serviceid;
		 				$type .= get_field('handyman_type_of_service', $id) . '/ ';
		 			}
		 		}

		 		$type = trim($type, '/ ');

		 		$field['choices'][ $product->ID ] = $product->post_title . ' [ ' . ucfirst($type) . ' ]' . ' [ ID: ' . $product->ID . ' ]';
		 	}
		} 
	   
	    // return the field
	    return $field;
	    
	}

}	



function handyman_update_hndserviceids( $post_ID, $post, $update ) {

  if ( $post->post_type !== 'products' ) return;

  // remove_action( 'save_post', 'handyman_update_hndserviceids', 99999, 3 );
  
  if ($update) {

  	$serviceIDs = array();

	$index = 0;

  	// Check rows exists.
	if( have_rows('handyman_product_link_to_services') ):

	    // Loop through rows.
	    while( have_rows('handyman_product_link_to_services') ) : the_row();

	        // Load sub field value.
	        $serviceIDs[$index]['serviceid'] = get_sub_field('handyman_product_link_to_service');
	        $serviceIDs[$index]['options'] = get_sub_field('handyman_show_addons');
	        // Do something...

	        $index++;

	    // End loop.
	    endwhile;

	endif;

	if (!empty($serviceIDs)) {
		update_field('hndserviceids', json_encode($serviceIDs), $post_ID);
	}	

  }

  // add_action( 'save_post', 'handyman_update_hndserviceids', 99999, 3 );

}

add_action( 'save_post', 'handyman_update_hndserviceids', 99999, 3 );

function handyman_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}

add_filter('posts_join', 'handyman_search_join' );

function handyman_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}

add_filter( 'posts_where', 'handyman_search_where' );

function handyman_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}

add_filter( 'posts_distinct', 'handyman_search_distinct' );


add_action('wp_ajax_available_pro_megamenu', 'handyman_pro__available_pro_megamenu');
add_action('wp_ajax_nopriv_available_pro_megamenu', 'handyman_pro__available_pro_megamenu');

if ( ! function_exists( 'handyman_pro__available_pro_megamenu' ) ) { 
    
    function handyman_pro__available_pro_megamenu() {
        
        check_admin_referer( 'avengers-end-game', 'autosecurity' );
        
        $catID = (int) $_POST['catID'];
        $gvals = array();
        
        $indivisual_categories = get_terms( array( 
        'taxonomy' => 'service_categories',
        'hide_empty' => false,
        'parent' => $catID
        ) );
        
        if (!empty($indivisual_categories))  {
            foreach ($indivisual_categories as $key => $indivisual_category ){
               // print_r($indivisual_category);
                
                
                $gvals[$key]['prod_name'] = $indivisual_category->name;
                $gvals[$key]['prod_url'] = get_category_link( $indivisual_category->term_id );
                
                
            }
        }

        echo json_encode($gvals);
        exit;
    }

}

add_action('wp_ajax_reveal_services_by_cat', 'handyman_pro_reveal_services');
add_action('wp_ajax_nopriv_reveal_services_by_cat', 'handyman_pro_reveal_services');


// Auto Complete //
if ( ! function_exists( 'handyman_pro_reveal_services' ) ) { 

	function handyman_pro_reveal_services() {

		check_admin_referer( 'avengers-end-game', 'autosecurity' );

		$termID = trim($_POST['search']);
	
		$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
		$per_min_cost = $fetch_hour_price/60;

		$args_group = array(
					        'posts_per_page' => -1,
					        'post_type' => 'services',
					        'tax_query' => array(
					            array (

					                'taxonomy' => 'service_categories',
					                'field' => 'term_id',
					                'terms' => $termID,
					            ),
					        ),
					        'orderby' => 'title',
					        'order' => 'ASC'
		);
		
		$the_query_group = new WP_Query( $args_group );

		if ( $the_query_group->have_posts() ) : while ( $the_query_group->have_posts() ) : $the_query_group->the_post(); 
			
					if(get_the_terms( $post->ID, 'service_group' )) { // IN NOT NULL
						$service_group_ids[] = get_the_terms( $post->ID, 'service_group' )[0]->term_id;
					}
			
		endwhile; endif; wp_reset_postdata();

		if(isset($service_group_ids)) :

			$service_group_unique_ids = array_unique($service_group_ids);			

			$titles = array();
			
			foreach ($service_group_unique_ids as $key => $service_group_id) : 

				$titles[$key]['name'] = get_term( $service_group_id )->name;;
				$titles[$key]['group'] = get_term_link($service_group_id);

				$servicePosta = null; // Resting
				$service_group = get_term($service_group_id);



				$fetchServices = array(
							        'posts_per_page' => -1,
							        'post_type' => 'services',
							        'tax_query' => array(
							            array (

							                'taxonomy' => 'service_group',
							                'field' => 'term_id',
							                'terms' => $service_group->term_id,
							            ),
							        ),
					        'orderby' => 'meta_value',
					        'meta_key' => 'handyman_type_of_service',
					        'order' => 'DESC'
				);


				$fetchServices_posts = new WP_Query( $fetchServices );


				if ( $fetchServices_posts->have_posts() ) : 

					$key1 = 0;

					while ( $fetchServices_posts->have_posts() ) : $fetchServices_posts->the_post(); 
					
					$titles[$key]['type'][$key1]['markup'] = pricing_markup_func($per_min_cost, $post->ID);
					$titles[$key]['type'][$key1]['permalink'] = get_permalink( $post->ID );
				
				$key1++; endwhile; endif; wp_reset_postdata();
				
			endforeach;

		endif;


		echo json_encode($titles);
		die();

	}

}

add_action('wp_ajax_hnd_reply_review_msg', 'hnd_reply_review_msg');

if ( ! function_exists( 'hnd_reply_review_msg' ) ) {

	function hnd_reply_review_msg() { 

		global $wpdb;

		check_admin_referer( 'deadpool-2', 'prosecure' ); 

		$reviewID = (int) $_POST['reviewID'];

		if (isset($_POST['reply']) && $_POST['reply'] != '') {
			
			$reply = sanitize_text_field($_POST['reply']);

			$wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_richreviews set company_response = '%s' WHERE 	id = '%d'",
			    array(
			        $reply,
			        $reviewID
			    )
			));

		} else {

			$wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_richreviews set company_response = NULL WHERE id = '%d'", $reviewID
			));
		}
		
		echo 'success';
		exit;

	}
}


// 


function generateUniqueToken() {
    $token = uniqid();

    $token .= md5(uniqid(rand(), true));

    $token = base64_encode($token);

    $token = preg_replace('/[^A-Za-z0-9]/', '', $token);

    return $token;
}


add_action( 'acf/save_post', 'hnd_booking_status_update', 30, 3 );

function hnd_booking_status_update( $post_id ) {

	global $wpdb;

	$current_posttype = get_post_type ( $post_id );
	$current_status   = get_post_status ( $post_id );

	if ( $current_posttype !== 'bookings' ) return;

	if ( $current_status == 'publish' ) { 

			$fetchBooking = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM hxp_handyman_booking WHERE booking_id = %s", array( $post_id ) ), 'ARRAY_A');

			$booking_status = get_field('hnd_booking_status', $post_id);

			// Update DB
			 $wpdb->query( $wpdb->prepare(
			    "UPDATE hxp_handyman_booking set booking_status = '%s' WHERE booking_id = '%d'",
			    array(
			        $booking_status,
			        $post_id
			    )
			));

			if ($fetchBooking['booking_status'] != $booking_status && $booking_status == 'completed') {


				$review_status = $wpdb->get_row( $wpdb->prepare( "SELECT booking_id FROM hxp_richreviews WHERE booking_id = %d", array( $fetchBooking['booking_id'] ) ), 'ARRAY_A');


					$unserialized_scheduled_address = unserialize(base64_decode($fetchBooking['scheduled_address']));


					if (!isset($review_status)) {

								// var_dump($unserialized_scheduled_address);
								// exit;

								$uniqueToken = generateUniqueToken();

								// $xdate_time = date('Y-m-d H:i:s');
								$xreviewer_name = $unserialized_scheduled_address['hnd_customer_name'];
								$xreviewer_email = $fetchBooking['customer_email'];
								$xreview_status = 0;
								$xhandyman_id = $fetchBooking['handyman_id'];
								$xbooking_id = $fetchBooking['booking_id'];
								
								// Insert Data to the Review table.
								$wpdb->query( $wpdb->prepare(
						                            "INSERT ignore INTO hxp_richreviews ( reviewer_name, reviewer_email, review_status, post_id, booking_id, token ) VALUES ( %s, %s, %d, %d, %d, %s )",
						                            array(
						                                    $xreviewer_name,
						                                    $xreviewer_email,
						                                    $xreview_status,
						                                    $xhandyman_id,
						                                    $xbooking_id,
						                                    $uniqueToken
						                            )
						                    ) );
					}
				

				// var_dump($xreviewer_name, $xreviewer_email, $xhandyman_id, $xbooking_id);
				// exit;

				$contactname = "Handyman";
				$customer_name = $unserialized_scheduled_address['hnd_customer_name'];
				$customer_email = $fetchBooking['customer_email'];

				$subject = "Feedback Form";

				$review_link = home_url('/write-a-review/');

				$review_link .= '?token=' . $uniqueToken . '&booking=' . $xbooking_id . '&handyman=' . $xhandyman_id;

				$email_body = $review_link;
			
				$mj = new \Mailjet\Client('6d82e174bf1cb383c2db46d759983e2b','eb3c1c3fc1eda3cc563edafca794fa17',true,['version' => 'v3.1']);

				try {

				    $body = [
				      'Messages' => [
				        [
				          'From' => [
				            'Email' => "noreply@handymanproservices.com",
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

				} catch (Exception $e) {
				    echo "Message could not be sent. Mailer Error: {$mailU->ErrorInfo}";
				}


			}

	}



}

