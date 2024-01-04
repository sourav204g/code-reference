<?php ob_start();
/**
 * My Classic functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage my_classic
 * @since My Classic 1.0
 */

/**
 * My Classic only works in WordPress 4.4 or later.
 */
/**
 * SVG icons functions and filters.
 */
 
add_filter( 'tc_singular_nav_next_text' , 'my_nav_buttons_text' );
add_filter( 'tc_singular_nav_previous_text' , 'my_nav_buttons_text' );
 
function my_nav_buttons_text() {
  switch ( current_filter() ) {
    case 'tc_singular_nav_previous_text':
      return 'Vorheriger Beitrag'; // <= your custom text here
    case 'tc_singular_nav_next_text':
      return 'N&auml;chster Beitrag'; // <= your custom text here
  }
}
 
 function wpse_excerpt_more( $more ) {
    return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">[...]</a>';
}
add_filter( 'excerpt_more', 'wpse_excerpt_more' );
 
 
require get_parent_theme_file_path( '/inc/icon-functions.php' );
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'myclassic_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own myclassic_setup() function to override in a child theme.
 *
 * @since My Classic 1.0
 */
function myclassic_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/myclassic
	 * If you're building a theme based on My Classic, use a find and replace
	 * to change 'myclassic' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'myclassic' );

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
	 * Enable support for custom logo.
	 *
	 *  @since My Classic 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'myclassic' ),
		'social'  => __( 'Social Links Menu', 'myclassic' ),
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

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', myclassic_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}

endif; // myclassic_setup

/*
 * Declare Woocommerce Support
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'myclassic_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since My Classic 1.0
 */
function myclassic_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'myclassic_content_width', 840 );
}
add_action( 'after_setup_theme', 'myclassic_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since My Classic 1.0
 */
function myclassic_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'myclassic' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'myclassic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Socila Icon', 'myclassic' ),
		'id'            => 'social_icon',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Links', 'myclassic' ),
		'id'            => 'footer_links',
	) );
	register_sidebar( array(
		'name'          => __( 'Copy Right', 'myclassic' ),
		'id'            => 'copy_right',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'myclassic' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'myclassic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
        register_sidebar( array(
		'name'          => __( 'Service Bottom Section', 'myclassic' ),
		'id'            => 'service_bottom_section',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'myclassic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'myclassic' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'myclassic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
        register_sidebar( array(
		'name'          => __( 'Single Porduct Sidebar', 'myclassic' ),
		'id'            => 'single-product-sidebar',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'myclassic' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
        register_sidebar( array(
		'name'          => __( 'Sidebar Template Menu', 'myclassic' ),
		'id'            => 'sidebar-template-menu',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'myclassic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'myclassic_widgets_init' );

if ( ! function_exists( 'myclassic_fonts_url' ) ) :
/**
 * Register Google fonts for My Classic.
 *
 * Create your own myclassic_fonts_url() function to override in a child theme.
 *
 * @since My Classic 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function myclassic_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'myclassic' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'myclassic' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'myclassic' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since My Classic 1.0
 */
function myclassic_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'myclassic_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since My Classic 1.0
 */
function myclassic_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'myclassic-fonts', myclassic_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'myclassic-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'myclassic-ie', get_template_directory_uri() . '/css/ie.css', array( 'myclassic-style' ), '20160816' );
	wp_style_add_data( 'myclassic-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'myclassic-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'myclassic-style' ), '20160816' );
	wp_style_add_data( 'myclassic-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'myclassic-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'myclassic-style' ), '20160816' );
	wp_style_add_data( 'myclassic-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
        
	wp_enqueue_script( 'myclassic-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'myclassic-html5', 'conditional', 'lt IE 9' );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'myclassic-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_localize_script( 'myclassic-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'myclassic' ),
		'collapse' => __( 'collapse child menu', 'myclassic' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'myclassic_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since My Classic 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function myclassic_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'myclassic_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since My Classic 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */


function myclassic_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * 
 * **/
 
 function include_custom_theme_js() {
        wp_enqueue_script('jquery');
	//wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), '1.0.0', true ); 
        wp_enqueue_script( 'pycsfoundadtion', get_template_directory_uri() . '/pycsgallery/foundation.min.js', array(), '1.0.0', true );
        wp_enqueue_script( 'pycslayout', get_template_directory_uri() . '/pycsgallery/pycs-layout.jquery.js', array(), '1.0.0', true );
        wp_enqueue_script( 'fancy-boxjqury', get_template_directory_uri() . '/pycsgallery/fancybox/jquery.fancybox.min.js', array(), '1.0.0', true );
        wp_enqueue_script( 'pycsgallery', get_template_directory_uri() . '/pycsgallery/gallery.js', array(), '1.0.0', true );
	//wp_enqueue_script( 'bootsrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '1.0.0', true );	
}
add_action( 'wp_enqueue_scripts', 'include_custom_theme_js' );
 
add_action( 'wp_enqueue_scripts', 'enqueue_my_styles' );
function enqueue_my_styles() {     
    // Load the main stylesheet
    //wp_enqueue_style( 'pycsgallery.style',get_template_directory_uri()."/pycsgallery/style.css" );
    wp_enqueue_style( 'bootstarp.minn',get_template_directory_uri()."/assets/css/bootstrap.min.css" );
   // wp_enqueue_style( 'bootstarp.min.map',get_template_directory_uri()."/assets/css/bootstrap.min.css.map" );
    wp_enqueue_style( 'style.csss',get_template_directory_uri()."/assets/css/style.css" );
    wp_enqueue_style( 'responsive.csss',get_template_directory_uri()."/assets/css/responsive.css" );
    //wp_enqueue_style( 'font-awsomee',get_template_directory_uri()."/assets/css/font-awesome.min.css" );
    wp_enqueue_style( 'fancy-box',get_template_directory_uri()."/pycsgallery/fancybox/jquery.fancybox.min.css" );
}



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since My Classic 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function myclassic_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'myclassic_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since My Classic 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function myclassic_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'myclassic_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since My Classic 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function myclassic_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'myclassic_widget_tag_cloud_args' );

// Add SVG Support
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

// Hard crop image function
 
add_image_size( 'HomePage-thumbnail', 504, 494, true ); // 220 pixels wide by 180 pixels tall, hard crop mode
add_image_size( 'five-img-colum', 220, 326, true ); // 220 pixels wide by 180 pixels tall, hard crop mode  
add_image_size( 'product_cagegory_image_size', 514, 837, true );
add_image_size( 'homepage-category-image', 394, 386, true );
add_image_size( 'homepage-category-product-image', 218, 321, true );
add_image_size( 'bestsaller-product-image', 287, 426, true );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10, 0 ); 
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10, 0 ); 
add_action('woocommerce_shop_loop_item_title', 'change_product_title');

function change_product_title() {
    echo'<div class="imgContent"><p><a href='.get_permalink().'>'.get_the_title().'</a></p></div>';
}
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

if(!function_exists('woocommerce_template_loop_product_thumbnail')) {
    function woocommerce_template_loop_product_thumbnail() {
        echo '<a href='.get_permalink().'>'.woocommerce_get_product_thumbnail()."</a>";
    } 
}
// Remove "Select options" button from (variable) products on the main WooCommerce shop page.
add_filter( 'woocommerce_loop_add_to_cart_link', function( $product ) {
	global $product;

	if ( is_shop() && 'variable' === $product->get_type() ) { // $product->product_type // 10-apr-2022
		return '';
	} else {
		return '';
	}
} );

//add_filter( 'woocommerce_variable_sale_price_html', 'businessbloomer_remove_prices', 10, 2 );
//add_filter( 'woocommerce_variable_price_html', 'businessbloomer_remove_prices', 10, 2 );
//add_filter( 'woocommerce_get_price_html', 'businessbloomer_remove_prices', 10, 2 );
 
// function businessbloomer_remove_prices( $price, $product ) {
// $price = '';
// return $price;
//}


// Remove the sorting option from WooCommerce
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Remove the result count from WooCommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );

// Remove the breadcrumbs from WooCommerce
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

//function for shortcode to get the logo image on sidebar
function logo_image()
{
    $image = get_template_directory_uri().'/assets/images/productLogo.png';
    return $image;
}
add_shortcode('get_image','logo_image');

//----------------code for remove product tabse in single product page ---------------//
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;

}
//----------------end code for remove product tabse in single product page ---------------//

// Change CheckoutButton
add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 

function woo_custom_order_button_text() {
    return __( 'Jetzt kaufen', 'woocommerce' ); 
}

// Add Variation Settings
add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );
// Save Variation Settings
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );
/**
 * Create new fields for variations
 *
*/
function variation_settings_fields( $loop, $variation_data, $variation ) {
	// Text Field
         
         if( have_rows('variation_labels') ):
         	$i=0;
	    while ( have_rows('variation_labels') ) : the_row();
	    
	    			$field_name = get_sub_field('label',$post_id);
	    			$labe_meta = '_cstm_label_'.$i.'['.$variation->ID.']';
				  woocommerce_wp_text_input( 
						array( 
							'id'          => $labe_meta, 
							'label'       => __( $field_name, 'woocommerce' ), 
							'placeholder' => '',
							'desc_tip'    => 'true',
							'description' => __( 'Enter '.$field_name, 'woocommerce' ),
							'value'       => get_post_meta( $variation->ID, '_cstm_label_'.$i, true )
						)
					);
				  $i++;
	    endwhile;

	endif;	
}
/**
 * Save new fields for variations
 *
*/
function save_variation_settings_fields( $var_id, $i ) {

	$parent_id = wp_get_post_parent_id( $var_id );
	if( have_rows('variation_labels',$parent_id) ):
        $i=0;
	    while ( have_rows('variation_labels',$parent_id) ) : the_row();
	    // update_post_meta( $var_id, '_cstm_label_0', esc_attr( $parent_id ) );
	    $label='_cstm_label_'.$i;
	    			$_text_field_label1 = $_POST[$label][ $var_id ];
					if( ! empty( $_text_field_label1 ) ) {

						update_post_meta( $var_id, $label, esc_attr( $_text_field_label1 ) );
					}
				  $i++;
	    endwhile;

	endif;
}

/**
 * code for bestseller
 *
*/

function getbestseller()
{
  ?>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h2 class="productHeader">Bestseller</h2>
        </div>
    </div>
    <?php if(get_field('best_seller_products',4)): ?>
                
        <div class="Box1 boxFourSection">
            <div class="row">                
                <?php 
                foreach (get_field('best_seller_products',4) as $key => $productbest) {
                    $termbest[] = $productbest['product'];
                    
                }
                foreach ($termbest as $prod_cat) :
                    $product_title= $prod_cat->post_title;
                    $product_ID=$prod_cat->ID;
                    $product_link=get_permalink( $product_ID );
                    ?>
                    <div class="col-sm-3 col-md-3">
                        <div class="boxInner">
                            <a href="<?php echo $product_link; ?>">
                            <?php  
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_ID ), 'bestsaller-product-image' );
                            ?>
                                <img src="<?php  echo $image[0]; ?>" alt="<?php echo $product_title; ?>">
                                <div class="imgContent">
                                    <p><?php echo $product_title; ?></p>
                                </div></a>
                        </div>
                    </div>

                    <?php  endforeach;  ?>
            </div>
        </div>
    <?php endif; ?>
<?php
}
add_shortcode('getshortcodebestseller','getbestseller');
/**
 * end code for bestsaller
 *
*/


//filter to set query parameters to archive page
function fwp_archive_per_page( $query ) {
        $query->set( 'order', 'DESC' );
        $query->set( 'orderby', 'ID' );    
}
add_filter( 'pre_get_posts', 'fwp_archive_per_page' );

//shortcode for page gallery
function page_gallery($atts) {
	$current_page_ID = get_the_ID();
	$show_gallery = get_field('show_gallery',$current_page_ID);
	if($show_gallery == "yes"){ ?>
		<section class="gallerySection">
                <main role="main">
                    <div class="loader-wrapper">
                        <div class="loader"></div>
                    </div>
                    <div class="gallery clearfix">
                        <?php
           
                        if( have_rows('gallery_images',$current_page_ID) ):
						    while ( have_rows('gallery_images',$current_page_ID) ) : the_row();
						        $image_id = get_sub_field('images',$current_page_ID);
                                $image_link = get_sub_field('link',$current_page_ID);
                                                                                                   
						        $image = wp_get_attachment_image_src( $image_id, $size );
						        echo'<a href="' . $image_link. '"><img data-pin="pinIt" class="picture" src="' . $image[0] . '"></a>';

						    endwhile;
						endif;
                        ?>
                    </div>
                </main>
            </section>
<?php
	}
}
add_shortcode('get_page_gallery', 'page_gallery');

function my_custom_sidebar() {
    register_sidebar(
        array (
            'name' => 'Blog-Sidebar',
            'id' => 'blog-side-bar',
            'description' => 'Blog-Sidebar',
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'my_custom_sidebar' );

function woocommerce_email_customer_details( $order ) {

$phone= $order->get_billing_phone();
$email=$order->get_billing_email();
$note=$order->get_customer_note();
?>

 <h2><?php _e( 'Order notes', 'woocommerce' ); ?></h2>
 <span class="text"><?php echo wp_kses_post( $note ); ?></span>

 <h2><?php _e( 'Customer details', 'woocommerce' ); ?></h2>
 <ul>
   <li><strong>E-Mail-Adresse: </strong> <span class="text"><?php echo wp_kses_post( $email ); ?></span></li>
<?php if($phone) { ?>
     <li><strong>Telefon: </strong> <span class="text"><?php echo wp_kses_post( $phone ); ?></span></li>
  <?php } ?>
 </ul>
<?php
};

add_action( 'woocommerce_email_customer_details', 'woocommerce_email_customer_details', 10, 4 );

/* disable automatic updates */
add_filter( 'auto_update_core', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_update_translation', '__return_false' );

/*
 * Work-around for Microsoft Edge bug ( https://developer.microsoft.com/en-us/microsoft-edge/platform/issues/7778808/ )
 */

function custom_edge_browser_fix() {
  global $is_edge;
  if( $is_edge ){
    add_filter('wp_calculate_image_srcset', '__return_false');
  }
}
add_action( 'init', 'custom_edge_browser_fix' );


// load contact form 7 scripts & styles only when needed
function wcs_cf7_scripts_conditional_load() {
  $load_scripts = false;
  if ( is_singular() ) {
    $post = get_post();
    if( has_shortcode( $post->post_content, 'contact-form-7' ) ) {
        $load_scripts = true;
    }
  }
  if ( ! $load_scripts ) {
    wp_dequeue_script( 'contact-form-7' );
    wp_dequeue_style( 'contact-form-7' );
  }
}
add_action( 'wp_enqueue_scripts', 'wcs_cf7_scripts_conditional_load', 99 ); 

// Disable WordPress version reporting as a basic protection against attacks
function remove_generators() {
	return '';
}		

add_filter('the_generator','remove_generators');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Change images alt and title tag
add_filter('wp_get_attachment_image_attributes', 'change_attachement_image_attributes', 20, 2);
function change_attachement_image_attributes($attr, $attachment) {
global $post;
$product = wc_get_product( $post->ID );
if ($post->post_type == 'product') {
    $title = $post->post_title;
    $authortags = strip_tags (wc_get_product_tag_list($post->ID));

    // var_dump($authortags);

    $editor = $product->get_attribute( 'pa_szerkesztette' );

    $attr['title'] = get_post(get_post_thumbnail_id())->post_title;
	//$title .' '. $authortags .' '. $editor;
    }
    return $attr;
}
/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 1000;
  return $cols;
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function filter_widgets_init() {

	register_sidebar( array(
		'name'          => 'Filter Bar',
		'id'            => 'filter_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'filter_widgets_init' );

add_action( 'woocommerce_new_order', 'add_engraving_notes',  1, 99999  );

function add_engraving_notes( $order_id ) {
 $order = wc_get_order(  $order_id );

// The text for the note
$note = __("This is my note's text…");

// Add the note
$order->add_order_note( $note );

// Save the data
$order->save();
}


/**
 * Add the field to the checkout page

add_action('woocommerce_after_order_notes', 'customise_checkout_field');

function customise_checkout_field($checkout)
{
	echo '<div id="customise_checkout_field"><p style="font-size:10px; font-size: 18px; font-weight: 600;">' . __('FARBZUSCHLAG') . '</p>';
	woocommerce_form_field('customised_field_name', array(
		'type' => 'text',
		'class' => array(
			'my-field-class form-row-wide'
		) ,
		'label' => __('Wünschen Sie eine andere Farbe? 
Dann geben Sie bitte hier Ihren Farbwunsch ein.
<a href="https://www.classic-garden-elements.de/produkt/farbzuschlaege/" target="_blank">RAL Farben mit Nummer finden Sie hier.</a></br>
Falls Sie Beratung zu Farben benötigen, schreiben Sie uns hier und wir rufen Sie an.') ,
		'placeholder' => __('Geben Sie hier die Farbe ein. Nennen Sie auch die RAL Farb Nummer falls bekannt. ') ,
		'required' => false,
	) , $checkout->get_value('customised_field_name'));
	echo '</div>';
}


/**
 * Update value of field


add_action('woocommerce_checkout_update_order_meta', 'customise_checkout_field_update_order_meta');

function customise_checkout_field_update_order_meta($order_id)
{
	if (!empty($_POST['customised_field_name'])) {
		update_post_meta($order_id, 'Colorfield', sanitize_text_field($_POST['customised_field_name']));
	}
}



/**
 * Display field value on the order edit page

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Color Code').':</strong> <br/>' . get_post_meta( $order->get_id(), 'Colorfield', true ) . '</p>';
}


/**
 * Add Delivery Date Field to the order emails
 
add_filter( 'woocommerce_email_order_meta_fields', 'custom_woocommerce_email_order_meta_fields', 10, 3 );
function custom_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
    $fields['customised_field_name'] = array(
        'label' => __( 'Color Code Selected by Client:' ),
        'value' => $order->get_meta( 'Colorfield', true ),
    );
    return $fields;
}


add_filter( 'woocommerce_get_order_item_totals', 'bbloomer_add_recurring_row_email', 10, 2 );
 
function bbloomer_add_recurring_row_email( $total_rows, $myorder_obj ) {
 
$total_rows['recurr_not'] = array(
  'label' => __( 'Selected Color Code:' ),
  'value' => $myorder_obj->get_meta( 'Colorfield', true ),
);
 
return $total_rows;
}
*/

/*** show media caption under product thumbnails in the WooCommerce Product Gallery ***/
 add_filter('woocommerce_single_product_image_thumbnail_html', function($html, $attachment_id) {
  $caption = get_post_field('post_excerpt', $attachment_id);

  if(trim($caption)) {
    $html = str_replace('</div>', '<span class="gtnCaps">' . $caption . '</span></div>', $html);
  }

  return $html;
}, 10, 2);

add_filter('woocommerce_single_product_image_thumbnail_html', 'thumb_add_title', 10, 4 );
function thumb_add_title( $html, $id, $parent, $class) {
   $attachment = get_post( $id );
   $img_cap = "<div class=\"img-cap\"><span class=\"cap-text\">{$attachment->post_title}</span></div>$html";
   return $img_cap;
}
/*** show media caption END ***/


/*** Thank you page - Danke Seite nach Bestellung custom design ***/
add_filter( 'the_title', 'woo_title_order_received', 10, 2 );

function woo_title_order_received( $title, $id ) {
	if ( function_exists( 'is_order_received_page' ) && 
	     is_order_received_page() && get_the_ID() === $id ) {
		$title = "Vielen Dank für Ihre Bestellung!";
	}
	return $title;
}
/*** Thank you page - Danke Seite nach Bestellung custom design END ***/


function wsam_deregister_unused_styles() {
    wp_dequeue_style( 'wp-block-library' );
}
 add_action( 'wp_enqueue_scripts', 'wsam_deregister_unused_styles', 11 );

/*** Price format on category-pages - use "from" price insead of price range for normal AND sales price ***/
add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );
function wc_wc20_variation_price_format( $price, $product ) {
  
  // Main Price
  $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
  $price = $prices[0] !== $prices[1] ? sprintf( __( ' ab %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
  
  // Sale Price
  $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ));
  sort( $prices );
  $saleprice = $prices[0] !== $prices[1] ? sprintf( __( ' ab %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
  if ( $price !== $saleprice ) {
    $price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
  }
  
  return $price;
}
/*** Price format on category-pages - use "from" price insead of price range for normal AND sales price END ***/
?>