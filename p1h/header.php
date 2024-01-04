<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package handyman_pro
 */

// if($_POST) {
// 	echo '<pre>';
// var_dump($_POST);
// exit;
// }

if (isset($_GET) && isset($_GET['s']) && $_GET['s'] === '') {
	wp_redirect( home_url( '/all-services/' ) );
	die();
}

if (get_post_type() !== 'products') {
	require get_template_directory() . '/inc/add-to-cart.php';
} else {
	require get_template_directory() . '/inc/add-to-cart-product.php';
}

$phone = get_field('handyman_contact_phone_no', 'option'); 

$str = array(' ', '+', '(', ')', '-');

foreach ($str as $key => $value) {
	$phone = explode($value, $phone); 
	$phone = implode('', $phone);
}


$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;

if( !session_id() ) {
	session_start();
}

$cart_count = 0;

if ( isset($_SESSION['hnd_post_values']) ) {
	$cart_count += count($_SESSION['hnd_post_values']);
} else {
	$cart_count += 0;
}

if ( isset($_SESSION['hnd_product_post_values']) ) {
	$cart_count += count($_SESSION['hnd_product_post_values']);
} else {
	$cart_count += 0;
}

// var_dump($_SESSION['cart_item_total']);
// exit();

// var_dump(get_field('handyman_prod_services_images', $_SESSION['hnd_post_values'][0]['handymn_service_id'] )[0]['handyman_image']['url']);
// exit();

// $menu_name = 'menu-6';

// $locations = get_nav_menu_locations();

// $menu_items = wp_get_nav_menu_items(  $locations[ $menu_name ] );

// echo "<pre>";
// var_dump($menu_items);
// exit;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">


	<?php if ( get_post_type() == 'services') : ?>

		<meta property="og:type"                   content="og:product" />
	    <meta property="og:title"                  content="<?php echo get_the_title(); ?>" />
	    <meta property="og:image"                  content="<?php echo get_the_post_thumbnail_url($post->ID); ?>" />
	    <meta property="og:description"            content="<?php echo wp_strip_all_tags(get_field('handyman_prod_services_description', $post->ID)); ?>" />
	    <meta property="og:url"                    content="<?php echo get_permalink(); ?>" />
	    <meta property="product:plural_title"      content="<?php echo get_the_title(); ?>" />
		
	<?php endif; ?>

	<?php if ( get_post_type() == 'products') : 

		$ogServiceID = $_GET['service-id'];

		$ogP_img = get_field('handyman_product_images')[0]['handyman_product_image']['url'];
		$ogP_dec = get_field('handyman_prod_services_description', $ogServiceID);

		?>

		<meta property="og:type"                   content="og:product" />
	    <meta property="og:title"                  content="<?php echo get_the_title(); ?>" />
	    <meta property="og:image"                  content="<?php echo $ogP_img; ?>" />
	    <meta property="og:description"            content="<?php echo wp_strip_all_tags($ogP_dec); ?>" />
	    <meta property="og:url"                    content="<?php echo get_permalink() . '?service-id=' . $ogServiceID; ?>" />
	    <meta property="product:plural_title"      content="<?php echo get_the_title(); ?>" />
		
	<?php endif; ?>

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/bootstrap-grid.css"/>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/icons.css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/bootstrap.css" />

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/jquery.auto-complete.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/responsive.css"/>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/chosen.css"/>
	 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/bootstrap-datepicker.css" />

	<!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/bootstrap-datetimepicker.css" /> -->
    
    <link href="<?php bloginfo('template_directory'); ?>/assets/js1/ma5slider.min.css" rel="stylesheet" type="text/css">


    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-LZJB12KNHY"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-LZJB12KNHY');
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


	<style>

		span.close-btn {
			    position: absolute;
			    z-index: 9;
			    margin-left: -26px;
			    top: 45%;
			    cursor: pointer;
			    display: none;
		}

		.custom-autocomplete-suggestions {
		    position: absolute;
		    background: white;
		    width: 200%; /* 100% */
		    box-shadow: 0px 2px 4px 1px rgba(0, 0, 0, 0.25);
		    height: 200px;
		    overflow: overlay;
		}

		.custom-autocomplete-suggestions ul li {
		    margin: 3px;
		}

		.custom-autocomplete-suggestions ul li a {
		    padding: 8px 0px 8px 15px;
		    width: 100%;
		    display: block;
		}

		.custom-autocomplete-suggestions ul li a b {
		    color: #009688;
		    font-weight: bold;
		}

		.custom-autocomplete-suggestions small {
		    font-size: 14px;
		    margin-left: 5px;
		    font-weight: lighter;
		}

		.custom-autocomplete-suggestions small > span {
		    color: #4343ff;
		}

		form.search-form {
		    display: inline-block;
		    background: #eeefed;
		    padding: 0;
		    margin: 0;
		    padding: 8px;
		    border-radius: 3px;
		    margin: 15px 0 0 0;
		    width: 100%;
		    display: flex;
		}

		form.search-form .search-field {
		    height: 40px;
		    padding: 0 10px 0 10px;
		    background-color: #fff;
		    border: 1px solid #fff;
		    border-radius: 0px;
		    color: #aeaeae;
		    font-weight: normal;
		    /* font-size: 18px; */
		    -webkit-transition: all 0.2s linear;
		    -moz-transition: all 0.2s linear;
		    transition: all 0.2s linear;
		    margin-bottom: 0px;
		    width: 256px;
		    font-family: 'Lato', sans-serif;
		    font-size: 16px;
		}

		.search-form label {
			    position: relative;
			    display: inline-block;
			    padding: 0px !important;
			    height: auto;
			    line-height: 1.5;
			    cursor: pointer;
			    letter-spacing: 0.5px;
		}

		.search-form label::before {
			content: '';
			border: 0px solid transparent;
		    -webkit-border-radius: 0px;
		    -moz-border-radius: 0px;
		    -ms-border-radius: 0px;
		    -o-border-radius: 0px;
		    border-radius: 0px;
		    /* background: #fff; */
		    margin-top: 0px;
		}

		.search-form .search-submit {
		    color: #fff;
		    border-color: none !important;
		    border: none !important;
		    background: #f2ae00;
		    border-radius: 0px !important;
		    padding: 7px 20px;
		    cursor: pointer;
		}
		
		

.mobile-nav-toggle {
   z-index: 9998;
    border: 0 !important;
    background: #f2ae00;
    font-size: 21px!important;
    transition: all 0.4s;
    outline: none !important;
    line-height: 1;
    cursor: pointer !important;
    padding: 0.35rem 0.50rem !important;
    border-radius: 1px;
    top: 4px;
    position: relative;
}
.mobile-nav-toggle i {
    color: #fdfdfd;
}
.mobile-nav {
  position: fixed;
  top: 55px;
  right: 15px;
  bottom: 15px;
  left: 15px;
  z-index: 9999;
  overflow-y: auto;
  background: #fff;
  transition: 0.7s ease;
  opacity: 1;
  visibility: hidden;
  border-radius: 10px;
  padding: 10px 0;
  transform: translateY(-120%);
}
.mobile-nav * {
  margin: 0;
  padding: 0;
  list-style: none;
}

.mobile-nav a {
    display: block;
    position: relative;
    color: #333333;
    padding: 10px 20px;
    outline: none;
    font-size: 15px;
    text-transform: uppercase;
    border-bottom: solid 1px #e8e8e8;
}

.mobile-nav a:hover, .mobile-nav .active > a, .mobile-nav li:hover > a {
  color: #e1b759;
  text-decoration: none;
}

.mobile-nav .menu-item-has-children > a:after {
    content: "\F0d7";
    position: absolute;
    right: 15px;
    font-family: "FontAwesome";
   
}
.mobile-nav .active.menu-item-has-children > a:after {
    content: "\F0d8";
}
.mobile-nav .menu-item-has-children > a {
  padding-right: 35px;
}
.mobile-nav .menu-item-has-children ul {
  display: none;
  overflow: hidden;
}
.mobile-nav .menu-item-has-children li {
  padding-left: 20px;
}
.mobile-nav-overly {
  width: 100%;
  height: 100%;
  z-index: 9997;
  top: 0;
  left: 0;
  position: fixed;
  background: rgba(26, 26, 26, 0.6);
  overflow: hidden;
  display: none;
  transition: ease-in-out 0.2s;
}
.mobile-nav-active {
  overflow: hidden;
}
.mobile-nav-active .mobile-nav {
  opacity: 1;
  visibility: visible;
  transform: translateY(0%);
}
.mobile-nav-active .mobile-nav-toggle i {
  color: #fff;
}
.mob-menu-sec{
    display:none!important;
}
@media screen and (max-width: 992px) {
    .mob-menu-sec{
    display:block;
}
    
}
.mob-menu-area button {
    background-color: #f2ae00;
    color: #ffffff;
    border: none;
    padding: 7px 20px;
    font-size: 17px;
    cursor: pointer;
}
.menu-close:before {
    content: "\f00d";
}

/*----21-4-21----*/

.desktop-flex{
	display: flex;
	justify-content: space-between;
	position: relative;
	align-items: center;
}
.nav-center-wrapper {
    display: flex;
    align-items: center;
}
.megamenu-heading-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0 0 1rem;
}
.megamenu-heading-wrapper h6 {
    color: #d0a22f;
    text-transform: uppercase;
    margin: 0;
}
.megamenu-heading-wrapper a {
    margin: 0;
    color:#000;
    font-size: 16px;
    text-decoration: underline;
}
.megamenu-ul-wrapper{
	margin: 24px 0 0 0;
}
ul.list-unstyled.mega-categories-list li a {
    text-transform: uppercase;
    font-size: 14px;
    color: black;
}
ul#menu-header-menu li a {
    padding: 1rem 0.8rem;
}
ul.sub-menu li a {
    padding: 9px 25px!important;
}
ul#menu-header-menu li:nth-child(1) {
    padding-right: 40px;
}
.col-megamenu ul li a {
    color: #323232;
    font-size: 14px;
}
ul#menu-header-menu li .sub-menu {
    border: none;
    border-top: 3px solid #63a0a0;
    border-radius: 0!important;
}

#searchfield{
	position: relative; 
	float:none; 
	margin: 0 20px;
}
.menu-sec nav>ul>li>ul::before{
	display: none;
}
@media all and (max-width: 1366px) {
	#searchfield{
	margin: 0 7px;
}
}

	@media all and (min-width: 992px) {
		.navbar{ padding-top: 0; padding-bottom: 0; }
		.navbar .has-megamenu{position:static!important; margin-bottom: -5px; padding-bottom: 6px;}
		.navbar .megamenu{
            left: 50%; 
            right: 0;
            transform: translateX(-50%); 
            width: 55%; 
            padding: 20px; 
            margin: 0; 
            border-radius: 0; 
            border: none; 
            border-top: 3px solid #63a0a0;
            background: rgb(255 255 255 / 91%);
        }
		.navbar .nav-item .dropdown-menu{ display: none; }
		.navbar .nav-item:hover .dropdown-menu{ display: block; }
		.navbar .nav-link{ padding:1rem 0 1rem 0.5rem;}
	}

	.menu-sec {
	    background: #ffffff;
	    padding-bottom: 1rem;
	}
	section.smoke-screen.active {
	    width: 100%;
	    height: 100vh;
	    background: rgb(48 48 48 / 89%);
	    position: fixed;
	    z-index: 9;
	}



	</style>

	<section class="smoke-screen"></section>
	<div class="theme-layout" id="scrollup">
		<div class="responsive-header">
			<div class="responsive-menubar" style="padding:10px;">
			    
                <nav class="nav-menu d-none d-lg-block mob-menu-sec">
                    <?php wp_nav_menu( array(
                    'menu' => 'Mobile Menu',
                    ) ); ?>
                </nav>
                <div class="mob-menu-area"></div>
                
                
                
				<div class="res-logo">
					<a href="<?php echo home_url( '/' ); ?>" title=""><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/logo_phone.png" style="width: 125px;"></a>
				</div><a href="tel:<?php echo $phone; ?>" style="display:none;">
				<div class="wishlist-dropsec2">
					<span><i class="fa fa-phone"></i></span>
				</div></a>

				<?php // var_dump($cart_count); ?>
				
				<div class="wishlist-dropsec3" data-target="#mobilecart" data-toggle="modal">
					<span><i class="fa fa-cart-plus"></i>
						<?php if ($cart_count > 0): ?>
								<strong><?php echo $cart_count; ?></strong>
							<?php endif; ?>
					</span>
				</div>

				<button class="serchbt serchbt2" data-target="#mobileseach" data-toggle="modal" style="position: absolute;"><i aria-hidden="true" class="fa fa-search"></i></button>
			</div>
		</div>

		<header class="stick-top forsticky">
			<div class="menu-sec">
				<div class="container-fluid desktop-flex">
					<div class="logo">
						<a href="<?php echo home_url('/'); ?>" title=""><img alt="" class="hidesticky" src="<?php bloginfo('template_directory'); ?>/assets/images/resource/logo.png"><img alt="" class="showsticky" src="<?php bloginfo('template_directory'); ?>/assets/images/resource/logo10.png"></a>
					</div><!-- Logo -->

				<div class="nav-center-wrapper">

					<div id="searchfield">

						<?php // get_search_form(); ?>

						<form id="searchform" method="get" action="<?php echo home_url('/'); ?>" class="search-form" autocomplete="off">
						    <input type="text" id="company_works_at" class="search-field" name="s" placeholder="Search Handyman Services..."  value="<?php the_search_query(); ?>">
						    <span class="close-btn hnd-search-close"><i class="fa fa-times"></i></span>
						    <input type="submit" class="search-submit" value="Search">
						</form>

						<div class="custom-autocomplete-suggestions" style="display: none;">
						   <ul></ul>
						</div>

					</div>

					
					<nav>
						<?php wp_nav_menu( array(
							'theme_location'  => 'menu-1',
							'container' => '',
							'menu'            => 'ul',
						) ); ?>
					</nav><!-- Menus -->
				</div>


				<div class="wishlist-wrapper">
					<div class="wishlist-dropsec">

						<span><i class="fa fa-cart-plus"></i>
							<?php if ($cart_count > 0): ?>
								<strong><?php echo $cart_count; ?></strong>
							<?php endif; ?>
						</span>

						<div class="wishlist-dropdown">

							<div class="grid-info-box2">
								<a href="<?php echo home_url('/cart/'); ?>" title=""><i class="fa fa-cart-plus"></i> View Cart</a>
							</div>

							<ul class="scrollbar">
								
								<?php if ($cart_count > 0): ?>

								<?php 

									get_template_part( 'template-parts/content', 'cart-header-service' );
									get_template_part( 'template-parts/content', 'cart-header-product' );

								?>

								<?php else: ?>

									<li style="text-align: center;">The cart is empty.</li>

								<?php endif; ?>


							</ul>

						</div>
					</div>


					<a href="tel:%20+1(847)%20726-1061">
					<div class="wishlist-dropsec2">
						<span><i class="fa fa-phone"></i></span>
					</div></a>
				</div>

				</div>
			</div>




		</header>

		<?php get_template_part( 'template-parts/content', 'category-menu' ); ?>