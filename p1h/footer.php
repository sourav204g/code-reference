<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package handyman_pro
 */

?>

<style>

	.center.slider {
	    padding: 1rem;
	}

	.center.slider .dvimag img {
	    width: auto!important;
	    max-height: 168px;
	    height: 100%!important;
	    margin: auto;
	    object-fit: cover;
	}

/*21-2-23*/

div#blk-btn-popup1 .modal-footer button {
    border: solid 1px rgb(128 128 128 / 28%);
    font-size: 18px!important;
}

</style>

<?php wp_footer(); ?>

	<section>
		<div class="no-padding">
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="simple-text">
							<h3>Subscribe to our Newsletter</h3><span>We're here to help. Check out our FAQs, send us an email or call us at 1 (800) 555-5555</span>
							<div class="clearfix"></div>
							<div align="center" class="signup">
								<div class="input-group" style="margin-top: 20px">
									<input aria-label="E-Mail address" class="input-group-field" name="email" placeholder="E-Mail address" type="text">
									<div class="input-group-button">
										<button class="button11" type="submit">Submit</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<footer>
		<div class="block">
			<div class="container">
				<div class="row">
					
					<div class="col-lg-2 column">
						<div class="widget">
							<h3 class="footer-title">COMPANY</h3>
							<div class="link_widgets">
								<div class="row">

									<?php wp_nav_menu( array(
										'theme_location'  => 'menu-2',
										'container' => '',
										'menu'            => 'ul',
									) ); ?>
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-2 column">
						<div class="widget">
							<h3 class="footer-title">DISCOVER</h3>
							<div class="link_widgets">
								<div class="row">
									<?php wp_nav_menu( array(
										'theme_location'  => 'menu-3',
										'container' => '',
										'menu'            => 'ul',
									) ); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-4 column">
						<div class="widget">
							<h3 class="footer-title">PRO CENTER</h3>
							<div class="link_widgets">
								<div class="row">
									<?php wp_nav_menu( array(
										'theme_location'  => 'menu-4',
										'container' => '',
										'menu'            => 'ul',
									) ); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 column">
						<div class="widget">
							<h3 class="footer-title">Contact Us</h3>
							<div class="about_widget">
								
								<span><?php echo get_field('handyman_contact_address', 'option'); ?></span>
								<div class="contact-link"><span>Phone: <?php echo get_field('handyman_contact_phone_no', 'option'); ?></span><a  href="tel:%20+1(847)%20726-1061"><i class="fa fa-phone"></i></a></div>
								<span>Email: <?php echo get_field('handyman_contact_email', 'option'); ?></span>
								<div class="social">
									
									<?php if (get_field('handyman_facebook', 'option')): ?>
										<a href="<?php echo get_field('handyman_facebook', 'option'); ?>" title="Facebook"><i class="fa fa-facebook"></i></a>
									<?php endif; ?>

									<?php if (get_field('handyman_twitter', 'option')): ?>
										<a href="<?php echo get_field('handyman_twitter', 'option'); ?>" title="Twitter"><i class="fa fa-twitter"></i></a> 
									<?php endif; ?>

									<?php if (get_field('handyman_linkedin', 'option')): ?>
										<a href="<?php echo get_field('handyman_linkedin', 'option'); ?>" title="Linkedin"><i class="fa fa-linkedin"></i></a>
									<?php endif; ?>

									<?php if (get_field('handyman_pinterest', 'option')): ?>
										<a href="<?php echo get_field('handyman_pinterest', 'option'); ?>" title="Pinterest"><i class="fa fa-pinterest"></i></a>
									<?php endif; ?>

									<?php if (get_field('handyman_instagram', 'option')): ?>
										<a href="<?php echo get_field('handyman_instagram', 'option'); ?>" title="Instagram"><i class="fa fa-instagram"></i></a>
									<?php endif; ?>		 
									
								</div>
							</div><!-- About Widget -->
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="bottom-line">
			<span>&copy; <?php echo date('Y'); ?> Handyman Pro Services. All rights reserved. <!-- Design by SEOFIED --></span>
			<a class="scrollup" href="#scrollup" title=""><i class="la la-arrow-up"></i></a>
		</div>
	</footer>

</div>

	<div class="modal" id="min-qty-value">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">WARNING</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-dismiss="modal" type="button">OK</button>
				</div>
			</div>
		</div>
	</div><!-- Modal -->

	

	<div class="modal" id="mobileseach">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">SEARCH</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div id="searchfield" style="position: relative;">
						<form id="searchform_" method="get" action="<?php echo home_url('/'); ?>" class="search-form" autocomplete="off">
						    <input type="text" id="company_works_at1" class="search-field" name="s" placeholder="Search Handyman Services..."  value="<?php the_search_query(); ?>">
						    <span class="close-btn hnd-search-close"><i class="fa fa-times"></i></span>
						    <button type="submit" class="search-submit mb-but" value="Search"><i aria-hidden="true" class="fa fa-search"></i></button>
						</form>

						<div class="custom-autocomplete-suggestions" style="display: none;">
						   <ul></ul>
						</div>
					</div>
					<p class="txt86">Search for: ie Caulk, drywall, grout, paint, shelving, faucet, fan, lighting, etc.</p>
				</div>
				<!-- <div class="modal-footer">
					<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
				</div> -->
			</div>
		</div>
	</div><!-- Modal -->


	<!-- Mobile Cart Modal -->
	<div class="modal" id="mobilecart">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">CART</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">

						<div class="wishlist-dropdown2">

							<div class="grid-info-box2">
								<a href="<?php echo home_url('/cart/'); ?>" title=""><i class="fa fa-cart-plus"></i> View Cart</a>
							</div>

							<ul class="scrollbar">

								<?php 


								$cart_count1 = 0;

								if ( isset($_SESSION['hnd_post_values']) ) {
									$cart_count1 += count($_SESSION['hnd_post_values']);
								} else {
									$cart_count1 += 0;
								}

								if ( isset($_SESSION['hnd_product_post_values']) ) {
									$cart_count1 += count($_SESSION['hnd_product_post_values']);
								} else {
									$cart_count1 += 0;
								}


								?>
								
								<?php if ($cart_count1 > 0): ?>

								<?php if (isset($_SESSION['hnd_post_values'])): ?>

									<strong>Services:</strong>
									
									<?php foreach ( $_SESSION['hnd_post_values'] as $key => $hnd_post_value ): ?>

										<?php // var_dump($hnd_post_value); ?>

										<li>
											<div class="job-listingtop">
												<div class="job-title-sec">
													<div class="c-logo">
														
														<?php if(!empty($hnd_post_value['handymn_insert_image'])) { ?>

														<img alt="<?php the_title(); ?>" src="<?php echo $hnd_post_value['handymn_show_image']; ?>" style="border: 1px solid #ddd;width: 100%;">

														<?php } elseif (get_the_post_thumbnail_url($hnd_post_value['handymn_service_id'])) { ?>

														<img alt="" src="<?php echo get_the_post_thumbnail_url($hnd_post_value['handymn_service_id']); ?>">

														<?php } ?>
														
													</div>
													<div>
														<h3><a href="<?php echo get_permalink( $hnd_post_value['handymn_service_id'] ); ?>" title=""><?php echo $hnd_post_value['handymn_service_name']; ?></a></h3>
														<span><?php echo get_field('handyman_type_of_service', $hnd_post_value['handymn_service_id']); ?>: $<?php /* var_dump($_SESSION['cart_item_total']); */ echo $_SESSION['cart_item_total'][$key]; ?></span>
													</div>
												</div>
											</div><!-- Job -->
										</li>
										
									<?php endforeach; ?>

								<?php endif; ?>

								<?php if (isset($_SESSION['hnd_product_post_values'])): ?>

									<strong>Products:</strong>
									
									<?php foreach ( $_SESSION['hnd_product_post_values'] as $key => $hnd_post_value ): ?>

										<?php // var_dump($hnd_post_value['handymn_asso_service_id']); ?>
										<?php


												
																$servicePrice = $per_min_cost * get_field('handyman_est_time', $hnd_post_value['handymn_asso_service_id']);

																if (get_field('handyman_product_premium', $hnd_post_value['handymn_asso_service_id'])) {
																	
																	$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $hnd_post_value['handymn_asso_service_id']))/100;

																} else {
																	
																	$handyman_premium = 0;
																}

																$servicePrice = $servicePrice + $handyman_premium;

																// IF Discount is set
																if(get_field('handyman_product_discount', $hnd_post_value['handymn_asso_service_id'])) {

																	$discount = get_field('handyman_product_discount', $hnd_post_value['handymn_asso_service_id']);

																	$afterDiscount = ( $servicePrice * $discount ) / 100;

																} else {

																	$afterDiscount = 0;
																}

															
															$product_org_price = (float) get_field('handyman_prod_price', $hnd_post_value['handymn_product_id']) + round($servicePrice, 2); 

															$product_final_price = (float) get_field('handyman_prod_price', $hnd_post_value['handymn_product_id']) + round($servicePrice - $afterDiscount, 2);

									 ?>

										<li>
											<div class="job-listingtop">
												<div class="job-title-sec">
													<div class="c-logo"><img alt="" src="<?php echo get_field('handyman_product_images', $hnd_post_value['handymn_product_id'] )[0]['handyman_product_image']['url']; ?>"></div>
													<div>
														<h3><a href="<?php echo get_permalink( $hnd_post_value['handymn_product_id'] ); ?>" title=""><?php echo get_post($hnd_post_value['handymn_product_id'])->post_title; ?></a></h3>
														<span><?php echo get_field('handyman_type_of_service', $hnd_post_value['handymn_asso_service_id']); ?>: $<?php echo $product_final_price * (int) $hnd_post_value['handymn_prod_quantity']; ?></span>
													</div>
												</div>
											</div><!-- Job -->
										</li>
										
									<?php endforeach; ?>

								<?php endif; ?>

								<?php else: ?>

									<li style="text-align: center;">The cart is empty.</li>

								<?php endif; ?>


							</ul>

						</div>
					

				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
				</div>
			</div>
		</div>
	</div><!-- Modal -->


	<!-- Modal -->
	<div class="modal" id="exampleModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">How Handyman Pros Works</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<video controls="" width="100%"><source src="<?php echo bloginfo( 'stylesheet_directory' ); ?>/assets/video/HandymanHomepage.mp4" type="video/mp4"> <source src="<?php echo bloginfo( 'stylesheet_directory' ); ?>/assets/video/HandymanHomepage.ogg" type="video/ogg"></video>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
				</div>
			</div>
		</div>
	</div><!-- Modal -->
	
	<div class="modal" id="showquestion">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customize-itLabel">Custom Services</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body cus89">      
        <div class="row">
          <div class="col-md-12">
            <p>
            Customer name the price custom described projects are accepted on a fairly price based offer and skill level requests. We will let you know if there are any discrepancies after submitting your project within 24 hours.
            </p>
          </div>                                    
        </div>
      </div>
      
    </div>
  </div>
</div>

<!--6/4/21 how it works popup-->

<div class="modal" id="howworks">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customize-itLabel">Remodeling products - How it works : </h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body cus89">      
        <div class="row">
          <div class="col-md-12">
          	<p style="color:red; letter-spacing: -0.2px; margin: -12px 0 2px 0!important; text-align: left!important;">All Products Include the product, taxes,  delivery to your home and proffesional installation.</p>
            <p style="text-align:left!important;">
            We have compared and picked a limited number of the "Best Budget" and "Best Overall" mainstream products so you don't have to shift through a myriad of products and try deciding what's best, select a product that best fit your need and a rep will consult with you on all other product options before we proceed finalizing your work order.
            
            </p>
          </div>                                    
        </div>
      </div>
      
    </div>
  </div>
</div>

<!--product-category specification-->

<div class="modal" id="specifications">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h5 class="modal-title" id="exampleModalLabel">Features</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

			</div>

			<div class="modal-body">

			</div>

			<div class="modal-footer">

				<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>

			</div>

		</div>
	</div>
</div>

<!--Sercice Customer supply popup-->

<div class="modal" id="customer-supply">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">

				<h5 class="modal-title" id="exampleModalLabel">Customer to supply:</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

			</div>

			<div class="modal-body">
                <p>Custome saves money by supplying as many materials, parts and fixtures as possible for the project per the 
                "Customer to supply" list above. Some additional technical materials may also be needed for your project that 
                we might need to supply. If needed, these materials are charged as follows: store bought materials are charged 
                based on store receipt plus 20% mark up and, depending on distance, a delivery charge. Truck stock items are 
                charged a 20% mark up with no delivery charge.</p>
			</div>

			<div class="modal-footer">

				<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>

			</div>

		</div>
	</div>
</div>

<!--Technical Materials popup-->

<div class="modal" id="technical-materials">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">

				<h5 class="modal-title" id="exampleModalLabel">Technical Materials:</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

			</div>

			<div class="modal-body">
                <p>Some minor technical materials may also be needed for your project that we might need to supply. If needed, these materials are charged as follows: 
                store bought materials are charged base on store receipt plus 20% mark up and, depending on distance, a delivery charge. Truck stock items are charged 
                a 20% mark up with no delivery charge.</p>
			</div>

			<div class="modal-footer">

				<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>

			</div>

		</div>
	</div>
</div>



<?php global $service_group_category_object; if (get_field('hnd_popup_content_g', 'service_group_' . $service_group_category_object->term_id)): ?>


<!--black-install-btn popup-->
<div class="modal" id="blk-btn-popup">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">

				<h5 class="modal-title" id="exampleModalLabel"></h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

			</div>

			<div class="modal-body">
                <?php echo get_field('hnd_popup_content_g', 'service_group_' . $service_group_category_object->term_id); ?>
			</div>

			<div class="modal-footer">

				<button class="btn btn-secondary popup-ex-link" data-link="<?php echo get_field('hnd_product_url_g', 'service_group_' . $service_group_category_object->term_id); ?>" data-dismiss="modal" type="button">OK</button>

				<button class="" data-dismiss="modal" type="button">Cancel</button>

			</div>

		</div>
	</div>
</div>
<?php endif; ?>

<?php global $service_group_category_object; if (get_field('hnd_popup_content_g')): ?>


<!--black-install-btn popup-->
<div class="modal" id="blk-btn-popup1">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">

				<h5 class="modal-title" id="exampleModalLabel"></h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

			</div>

			<div class="modal-body">
                <?php echo get_field('hnd_popup_content_g'); ?>
			</div>

			<div class="modal-footer">

				<button class="btn btn-primary" data-link="<?php echo get_field('hnd_product_url_g'); ?>" data-dismiss="modal" type="button">OK</button>
				<button class="btn btn-light" data-dismiss="modal" type="button">Cancel</button>

			</div>

		</div>
	</div>
</div>
<?php endif; ?>


<!--<div class="modal fade" id="customer-supply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--  <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header">-->
<!--        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        ...-->
<!--      </div>-->
<!--      <div class="modal-footer">-->
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->



	<?php get_template_part( 'template-parts/content', 'customize-popup' ); ?>

	<script src="<?php bloginfo('template_directory'); ?>/assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>

	<script src="<?php bloginfo('template_directory'); ?>/assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

	<!-- DATEPICKER -->
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/moment.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/bootstrap-datetimepicker.min.js"></script>


	<!-- jquery.validate -->
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>

    <!-- <script src="<?php bloginfo('template_directory'); ?>/assets/slick/slick.js" type="text/javascript"></script> -->
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/validate.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/custom.js" type="text/javascript"></script>

	<!-- <script src="<?php // bloginfo('template_directory'); ?>/assets/js/bootstrap.min.js" type="text/javascript"></script> -->
	<script type="text/javascript">
    $(document).on('ready', function() {
      $(".center").slick({
        dots: true,
        arrows: false,
        // infinite: true,
        centerMode: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerPadding: '40px',
       
      });
    });
</script>

	

	<script>

			$(function(){


				$('.home-exp-sec.pop article').click(function(){
						$('.home-exp-sec.pop article').removeAttr('style');
						$('.home-exp-sec.pop article').removeClass('active');
						$(this).addClass('active');
						if ($(this).hasClass('special-link')) {
							$(this).css('height', '440px');
						} else {
							$(this).css('height', '366px');
						}
						
				});


				// popup - for external link
				$('.hnd-external-link').click(function(e){
					e.preventDefault();
					if (confirm( $(this).data('popuptext') )) {
						window.location.href = $(this).data('link');
					}

				})

				$('.exp-tech-hover').hover(function() {
					$self = $(this);
					$('.for-mob').css('display', 'block');
					setTimeout(function(){ $self.find('.for-mob').css('display', 'none'); }, 1000);
				});

				$('#exampleModal').modal({ // Stop video play when Modal is closed.
				    show: false
			    }).on('hidden.bs.modal', function(){
			        $(this).find('video')[0].pause();
			    });
				
				$('.off_dates_datepicker').datepicker({
				    format: 'mm/dd/yyyy',
				    multidate : true,
				    startDate : '0d',
				    
				}).on('changeDate', function(ev){ // http://dkconnects.com/demo01/handymanpro/handyman-pros/ 

					let bookingDates = '';

					ev.dates.forEach(function(elem){

						bookingDates += elem + '|';

					});

					$('[name="hndy_schedule_date"]').val(bookingDates);

				});
				
				$('body').on('keypress keydown keyup', '.datepicker', function(e){
					// e.stopPropagation();
					e.preventDefault();
				});


				$('body').on('focus', '.timepicker-f', function(){
						$(this).datetimepicker({
							format: "HH:mm a",
							icons: {
								up: 'fa fa-angle-up',
								down: 'fa fa-angle-down',
								previous: 'fa fa-angle-left',
								next: 'fa fa-angle-right',
							}
						});
				});

			});



	</script>

	<script src="<?php bloginfo('template_directory'); ?>/assets/js/modernizr.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/script.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/wow.min.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/slick.min.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/parallax.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/select-chosen.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/js1/jquery-ui.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/js1/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/js1/ma5slider.min.js"></script>

    <script>

        $(window).on('load', function () {
           $('.ma5slider').ma5slider();
        });

    </script>

    <script src="<?php bloginfo('template_directory'); ?>/assets/js/jquery.morelines.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/js/loadMoreResults.js"></script>

    <script>
		
	    $(function() {


	    	  $('.popup-ex-link').on('click', function(e){
	    	  		e.preventDefault();
	    	  		$link = $(this).data('link');

	    	  		if ($link.search('handymanproservices.com')) {

	    	  			window.location.href = $link;

	    	  		} else {
	    	  			window.open($link, '_blank');
	    	  		}

	    	  		
	    	  });



		      $('.js-description_readmore').moreLines({
		        linecount: 2, 
		        baseclass: 'b-description',
		        basejsclass: 'js-description',
		        classspecific: '_readmore',    
		        buttontxtmore: "read more",               
		        buttontxtless: "read less",
		        animationspeed: 150 
		      });

			  $('.content .loadMore').loadMoreResults({
					tag: {
						name: 'div',
						'class': 'pro-border'
					},
					displayedItems: 5,
					showItems: 2
			  });
			
	    });


	    $( window ).scroll( function () {
			if ( $( window ).scrollTop() >= 1 ) {
				$( '.responsive-menubar' ).addClass( 'fixed-header' );

			} else {
				$( '.responsive-menubar' ).removeClass( 'fixed-header' );

			}
		} );
	
  </script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/jquery.morelines.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/loadMoreResults.js"></script>

<script>


		$("body").on("click",".header-megamenu", function(){
	           
	           $('.rightsection_hide').hide();
	           
	           var catid = $(this).attr("did");
	           var ctNms = $(this).attr("ctnms");
	           var caturl = $(this).attr("caturl");
	            
	            $(".spinner").addClass("is-active").after('<div class="load-spinner" style="width:100%;text-align: center; "><img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/35771931234507.564a1d2403b3a.gif" style="width:80px;text-align: center;" /></div>');
	            
	           $.ajax({

	               url: handymanx_fnt.root + '/wp-admin/admin-ajax.php', // Change path
	               type: 'POST',
	               data: {
	                   action: 'available_pro_megamenu',
	                   catID: catid,
	                   autosecurity: handymanx_fnt.nonce
	               },
	              
	              	success: function(response) {

	                    $(".spinner").removeClass("is-active"); 
	                   let res = JSON.parse(response);
	                   if (res != "") {
	                       $('.rightsection').html('');
	                       $('.ctsnms').html('');
	                       $(res).each(function(i) {
	                           $('.rightsection').append('	 <div class="col-md-4"><div class="col-megamenu"><ul class="list-unstyled"><li><a href="'+ res[i]['prod_url'] + '">'+ res[i]['prod_name'] + '</a></li></ul></div></div>');
	                             $('.ctsnms').html('<a href=" '+ caturl +' " class="catheading">' + ctNms + '</a>');	
	                           
	                           
	                   });
	                   }
	               },
	               error: function(error) {
	               //	console.log(error);
	               }
	           });
	    
	    });


	$( function () {

		$( '.js-description_readmore' ).moreLines( {

			linecount: 2,

			baseclass: 'b-description',

			basejsclass: 'js-description',

			classspecific: '_readmore',

			buttontxtmore: "read more",

			buttontxtless: "read less",

			animationspeed: 150

		} );

		$( '.content .loadMore' ).loadMoreResults( {

			tag: {

				name: 'div',

				'class': 'pro-border'

			},

			displayedItems: 5,

			showItems: 2

		} );



	} );
</script>

  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/jquery.autocomplete.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/currency-autocomplete.js"></script>

</body>
</html>
