<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TravelTographer
 */


?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('stylesheet_directory'); ?>/assets/images/favicons/favicon-32x32.png">
	<link rel="manifest" href="<?php bloginfo('stylesheet_directory'); ?>/assets/images/favicons/site.html">

	<!-- Fonts-->
	<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap"
	    rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Sacramento&amp;display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:wght@300;400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">

	<!-- Css-->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/animate.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/magnific-popup.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/swiper.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/bootstrap-select.min.css">

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/vegas.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/nouislider.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/nouislider.pips.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/ziston-icon.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/ziston-new-icons.css">
	<!-- Template styles -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/responsive.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="page-wrapper">

        <div class="site-header__header-one-wrap header_three_wrap clearfix">

            <?php if (get_field('promotion_bar_content', 'option')): ?>

                <div class="header_top_one">
                    <div class="header_top_one_container">
                        <div class="header_top_one_inner clearfix text-center">

                         <?php echo get_field('promotion_bar_content', 'option'); ?>
                        
                        </div>
                    </div>
                </div>
                
            <?php endif; ?>

            <header class="main-nav__header-one">
                <nav class="header-navigation three stricky">
                    <div class="container-box clearfix">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="main-nav__left main-nav__left_one float-left">
                            <div class="logo_one">
                                <a href="<?php echo home_url( '/' ); ?>" class="main-nav__logo">
                                    <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/resources/logo.png" class="main-logo" alt="Awesome Image">
                                </a>
                            </div>
                            <a href="#" class="side-menu__toggler">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>

                        <div class="main-nav__main-navigation three float-left">

                            <?php 

                                wp_nav_menu( array(
                                    'theme_location'  => 'menu-1',
                                    'menu'            => 'ul',
                                    'menu_class'      => 'main-nav__navigation-box'
                                ) );

                            ?>

                        </div><!-- /.navbar-collapse -->

                        <?php if (!is_user_logged_in()): ?>

                            <div class="main-nav__right main-nav__right_one float-right">

                                <div class="header_btn_1">
                                    <a href="<?php echo home_url( '/sign-in/' ); ?>"><i class="fas fa-user"></i> Sign In/Sign Up</a>
                                </div>
                                
                            </div>

                        <?php else: ?>  

                            <div class="main-nav__right main-nav__right_one float-right">

                                <div class="header_btn_1">
                                    <a href="<?php echo home_url( '/sign-in/' ); ?>"><i class="fas fa-user"></i> User Account</a>
                                </div>
                                
                            </div>
                            
                        <?php endif; ?>

                        

                    </div>
                </nav>
            </header>
        </div>
