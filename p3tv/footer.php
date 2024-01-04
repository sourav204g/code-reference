<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TravelTographer
 */

?>

	    <footer class="site-footer">
	        <div class="site_footer_shape-1" style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/resources/footer-shape-1.png)">
	        </div>
	        <div class="site_footer_map" style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/resources/footer-map.png)"></div>
	        <div class="container">
	            <div class="row">
	                <div class="col-xl-4 col-lg-4 col-md-6">
	                    <div class="footer-widget__column footer-widget__about wow fadeInUp" data-wow-delay="100ms">
	                        <div class="footer-widget__logo">
	                            <a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/resources/footer-logo.png" alt=""></a>
	                        </div>
	                        <div class="footer-widget_about_text">
	                            <p>Lorem ipsum dolor sit amet, consect etur adi pisicing elit sed do eiusmod tempor
	                                incididunt ut labore.</p>
	                        </div>
	                        <!-- <div class="footer_contact_info">
	                            <div class="footer_contact_icon">
	                                <span class="icon-calling"></span>
	                            </div>
	                            <div class="footer_contact_number">
	                                <p>Phone</p>
	                                <h4><a href="tel:+123456789">666 888 0000</a></h4>
	                            </div>
	                        </div> -->
	                    </div>
	                </div>
	                <div class="col-xl-2 col-lg-2 col-md-6 col-6">
	                    <div class="footer-widget__column footer-widget__explore wow fadeInUp" data-wow-delay="200ms">
	                        <div class="footer-widget__title">
	                            <h3>Our Company</h3>
	                        </div>

	                        <?php 

	                            wp_nav_menu( array(
	                                'theme_location'  => 'menu-2',
	                                'menu'            => 'ul',
	                                'menu_class'      => 'footer-widget__explore-list list-unstyled'
	                            ) );

	                        ?>
	                  
	                    </div>
	                </div>
	                <div class="col-xl-2 col-lg-2 col-md-6 col-6">
	                    <div class="footer-widget__column footer-widget__categories wow fadeInUp"
	                        data-wow-delay="300ms">
	                        <div class="footer-widget__title">
	                            <h3>Capture Memories</h3>
	                        </div>

	                        <?php 

	                            wp_nav_menu( array(
	                                'theme_location'  => 'menu-3',
	                                'menu'            => 'ul',
	                                'menu_class'      => 'footer-widget__categories_list list-unstyled'
	                            ) );

	                        ?>

	                    </div>
	                </div>
	                <div class="col-xl-4 col-lg-4 col-md-6">
	                    
	                    <div class="footer-widget__column footer-widget__newsletter wow fadeInUp"
	                        data-wow-delay="400ms">
	                        
	                        <div class="footer-widget__title">
	                            <h3>Newsletter</h3>
	                        </div>
	                        
	                        <ul class="footer-widget_newsletter_address list-unstyled">
	                            <li><?php echo get_field('traveltographer_address', 22); ?></li>
	                            <li><a href="mailto:<?php echo get_field('traveltographer_email_id', 22); ?>"><?php echo get_field('traveltographer_email_id', 22); ?></a></li>
	                        </ul>

	                        <div class="site-footer__social">

	                        	<?php 

	                        		$facebook 	= ( get_field('travelt_facebook', 22) ) ? get_field('travelt_facebook', 22) : '#';
	                        		$twitter  	= ( get_field('travelt_twitter', 22) ) ? get_field('travelt_twitter', 22) : '#';
	                        		$instagram  = ( get_field('travelt_instagram', 22) ) ? get_field('travelt_instagram', 22) : '#';



	                        	?>

	                            <a href="<?php echo $facebook; ?>"><i class="fab fa-twitter"></i></a>
	                            <a href="<?php echo $twitter; ?>"><i class="fab fa-facebook-square"></i></a>
	                            <a href="<?php echo $instagram; ?>"><i class="fab fa-instagram"></i></a>


	                        </div>
	                        <!-- <form>
	                            <div class="footer_input-box">
	                                <input type="Email" placeholder="Enter email address">
	                                <button type="submit" class="button"><i
	                                        class="fas fa-paper-plane"></i>Subscribe</button>
	                            </div>
	                        </form> -->
	                    </div>
	                </div>
	            </div>
	        </div>
	    </footer>

	    <div class="site-footer_bottom">
	        <div class="container">
	            <div class="site-footer_bottom_copyright">
	                <p>&copy; Copyright <?php echo date('Y'); ?> by <a href="<?php echo home_url(); ?>">Traveltographer.com</a></p>
	            </div>
	            <!-- <div class="site-footer__social">
	                <a href="#"><i class="fab fa-twitter"></i></a>
	                <a href="#"><i class="fab fa-facebook-square"></i></a>
	                <a href="#"><i class="fab fa-dribbble"></i></a>
	                <a href="#"><i class="fab fa-instagram"></i></a>
	            </div> -->
	        </div>
	    </div>





	</div><!-- /.page-wrapper -->

	<a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>

	<div class="side-menu__block">
	    <div class="side-menu__block-overlay custom-cursor__overlay">
	        <div class="cursor"></div>
	        <div class="cursor-follower"></div>
	    </div><!-- /.side-menu__block-overlay -->
	    <div class="side-menu__block-inner ">
	        <div class="side-menu__top justify-content-end">
	            <a href="#" class="side-menu__toggler side-menu__close-btn"><img
	                    src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/shapes/close-1-1.png" alt=""></a>
	        </div><!-- /.side-menu__top -->

	        <nav class="mobile-nav__container">
	            <!-- content is loading via js -->
	        </nav>

	        <div class="side-menu__sep"></div><!-- /.side-menu__sep -->

	        <div class="side-menu__content">
	            <p><a href="mailto:info@traveltographer.com">info@traveltographer.com</a> <br> <a href="tel:888-999-0000">888 999
	                    0000</a></p>
	            <div class="side-menu__social">
	                <a href="#"><i class="fab fa-facebook-square"></i></a>
	                <a href="#"><i class="fab fa-twitter"></i></a>
	                <a href="#"><i class="fab fa-instagram"></i></a>
	                <a href="#"><i class="fab fa-pinterest-p"></i></a>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="search-popup">
	    <div class="search-popup__overlay custom-cursor__overlay">
	        <div class="cursor"></div>
	        <div class="cursor-follower"></div>
	    </div><!-- /.search-popup__overlay -->
	    <div class="search-popup__inner">
	        <form action="#" class="search-popup__form">
	            <input type="text" name="search" placeholder="Type here to Search....">
	            <button type="submit"><i class="fa fa-search"></i></button>
	        </form>
	    </div>
	</div>


	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <?php echo do_shortcode('[contact-form-7 id="964" title="Photography Package"]'); ?>
	      </div>
	      <!-- <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div> -->
	    </div>
	  </div>
	</div>

<?php wp_footer(); ?>

	<script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/jquery.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/waypoints.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/jquery.counterup.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/TweenMax.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/wow.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/swiper.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/typed-2.0.11.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/vegas.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/jquery.validate.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/bootstrap-select.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/countdown.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/nouislider.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/isotope.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/appear.js"></script>

    <!-- template scripts -->
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/theme.js"></script>

    <script>
    	    	$('.destination-input').change(function(){ 

    	    			let country = $(this).val();

    					$.ajax({

    	                    url: travelt.root + '/wp-admin/admin-ajax.php', // Change path
    	                    type: 'POST',
    	                    data: {
    	                    	
    	                        action: 'load_cities_data',
    	                        id: country,
    	                        nonce: travelt.nonce
    	                    },

    	                    success: function(response) {

    	                    	console.log(response);

    	                    	let data = '';
    	                    	
    	                    	let res = $.parseJSON(response);

    	                    	res.forEach(function(item, index) {

    	                    		data += '<option value="' + item.toLowerCase() + '" >' + item + '</option>';

    	                    	});


	    	                    $('.city-input').html('');
	    	    				$('.city-input').html('<option value="">Enter Your City Name</option>');
	    	    				$('.city-input').append(data);

    	                    },

    	                    error: function(error) {
    	                        console.log(error);
    	                    }

    	                });
    	    		
    	    	});


    	    	$('#exampleModal').on('show.bs.modal', function (event) {
    	    	  var button = $(event.relatedTarget) // Button that triggered the modal
    	    	  var package = button.data('package');
    	    	  console.log(package);

    	    	  var modal = $(this)
    	    	  modal.find('.modal-title').text(package);
    	    	  $('[name="your-package"]').val(package);
    	    	  // modal.find('.modal-body input').val(recipient)
    	    	})
    </script>

</body>
</html>
