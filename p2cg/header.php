<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage My_Classic
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
<meta name="google-site-verification" content="M5dact0CMRy9hkuP33A5OrKAn_noka3U-vTx9RdWj7c" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- wrapper start -->
	
	<div class="mainContent">
	<!-- || Header Section || -->
		                       
            <section class="headerSection sections">			
				               
				<div class="container transparnt flag-wrapper desktoponly">
					    <div class="col-md-7">
							<a href="https://www.classic-garden-elements.de/" class="flag-de alignleft"></a>
							<a href="https://www.classic-garden-elements.co.uk/" class="flag-uk alignleft"></a>
							<a href="https://www.classic-garden-elements.co.uk/classic-garden-elements-in-the-united-states-of-america/" class="flag-us alignleft"></a>
							<a href="https://www.classic-garden-elements.co.uk/france/" class="flag-fr alignleft"></a>
					    </div>
                        <div class="col-md-3 serchrb-top" style="padding-right: 0;">

							<form role="search" method="get" class="woocommerce-product-search" action="<?php echo home_url( '/' ); ?>">
								<label class="screen-reader-text" for="woocommerce-product-search-field-1">Suche nach:</label>
								<input type="search" id="woocommerce-product-search-field-1" class="search-field" placeholder="Produkte suchen" value="" name="s">
								<!-- <input type="submit" value="Suchen"> -->
								<button type="submit" class="wpr_submit"><i class="wpr-icon-search"></i></button>
								<input type="hidden" name="post_type" value="product">
							</form>
					    
					     </div>

                          <div class="col-md-2" style="padding-left: 2;">
								<a href="/cart/" class="cart alignright">Ihr Warenkorb <i class="fas fa-cart-plus"></i></a>
					    	</div>
				</div>

				<div class="mobileonly mobilecart2">
							<a href="https://www.classic-garden-elements.co.uk/france/" class="flag-fr alignright"></a>
							<a href="https://www.classic-garden-elements.co.uk/classic-garden-elements-in-the-united-states-of-america/" class="flag-us alignright"></a>
							<a href="https://www.classic-garden-elements.co.uk/" class="flag-uk alignright"></a>
							<a href="https://www.classic-garden-elements.de/" class="flag-de alignright"></a>
				</div>
				
				
				<div class="mobileonly mobilecart">
					
									<a href="/cart/" class="cart alignright mobileonly"><i class="fas fa-cart-plus mobileonly"></i></a>
								</div>
				
				
								<div class="container transparnt desktoponly">
                  <div class="row">
										<div class="col-sm-12 col-md-12">
											<a class="gethome" href="<?php echo home_url() ?>">Classic Garden Elements</a>
										</div>
									</div>
								</div>
            </section>
             <section> 
             <div class="container mobileonly">

             <div class="col-md-12 serchrb-top" style="padding-right: 0; padding-left: 0;">


	<form role="search" method="get" class="woocommerce-product-search" action="<?php echo home_url( '/' ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field-1">Suche nach:</label>
	<input type="search" id="woocommerce-product-search-field-1" class="search-field" placeholder="Produkte suchen" value="" name="s">
	<!-- <input type="submit" value="Suchen"> -->
	<button type="submit" class="wpr_submit"><i class="wpr-icon-search"></i></button>
	<input type="hidden" name="post_type" value="product"></form>
									    
									     </div>
             </div>
             </section>
            <div class="container paddingNone">
                <!-- || Nav Section || -->	
                <section class="navSection sections">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="collapse navbar-collapse paddingNone" id="bs-example-navbar-collapse-1">
                                <div class="navInner nav navbar-nav">
                                    <?php
                                        wp_nav_menu( array(
                                                'theme_location' => 'primary',
                                                'menu_class'     => 'primary-menu',
                                         ) );
                                    ?>
									
									
                                </div>
								
                            </div>
                        </div>
                    </div>
                </section>       
                <!-- || Nav Section End || -->