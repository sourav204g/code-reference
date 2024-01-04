<?php
/**
 * Template Name: Booking
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TravelTographer
 */

get_header();
?>

			<!--Page Header Start-->
	        <section class="page-header" style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/main-slider/slide_v1_9.jpg); background-position: center;">
	            <div class="container">
	                <h2>Book Traveltographer</h2>
	                <ul class="thm-breadcrumb list-unstyled">
	                    
	                    <li><span>Become part of our amazing community of worldwide photographers</span></li>
	                </ul>
	            </div>
	        </section>

	  		<!--Contact One single-->
	        <section class="contact-one join-our-team">
	            <div class="container">
	                <div class="row">
	                    <div class="col-xl-12">
	                        <div class="contact_one_left">
	                            <div class="block-title text-center">
	                                <h4>Book Now</h4>
	                                <h2>Book Traveltographer</h2>
	                            </div>
	                            
	                        </div>
	                    </div>

	                    <div class="col-xl-12">
	                        
	                        <div class="contact-one__form__wrap">
	                            <form action="" class="contact-one__form">
	                                <div class="row">
	                                    <div class="col-md-12">
	                                        <div class="linebg">
	                                            <h3>Personal Informationn</h3>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>First Name *</label>
	                                            <input type="text" name="name" placeholder="Enter Your First Name *">
	                                        </div>
	                                    </div>
	                                      <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Last Name *</label>
	                                            <input type="text" name="name" placeholder="Enter Your Last Name *">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-12">
	                                        <div class="input-group">
	                                            <label>Email Address *</label>
	                                            <input type="email" name="name" placeholder="Email address">
	                                        </div>
	                                    </div>

	            <div class="col-md-6">
	                <div class="input-group">
	                    <label>Country Code *</label>
	                    <select>
	                      <option value="1" data-select2-id="2">+1 United States of America</option>
	                      <option value="93" data-select2-id="11">+93 Afghanistan</option>
	                      <option value="358" data-select2-id="12">+358 Åland Islands</option>
	                      <option value="355" data-select2-id="13">+355 Albania</option>
	                      <option value="213" data-select2-id="14">+213 Algeria</option>
	                      <option value="1684" data-select2-id="15">+1684 American Samoa</option>
	                      <option value="376" data-select2-id="16">+376 Andorra</option>
	                      <option value="244" data-select2-id="17">+244 Angola</option>
	                      <option value="1264" data-select2-id="18">+1264 Anguilla</option>
	                      <option value="672" data-select2-id="19">+672 Antarctica</option>
	                      <option value="1268" data-select2-id="20">+1268 Antigua and Barbuda</option>
	                      <option value="54" data-select2-id="21">+54 Argentina</option>
	                     
	                  </select>
	            </div>
	        </div>
	                                    
	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Phone number *</label>
	                                            <input type="text" name="phone" placeholder="Enter Your Phone number">
	                                        </div>
	                                    </div>

	                                     <div class="col-md-12">
	                                        <div class="linebg">
	                                            <h3>Booking Informationn</h3>
	                                        </div>
	                                    </div>

	                                    

	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Choose Your Category*</label>
	                                            <select>
	                                                   <option>Travel</option>
	                                                    <option>Portrait</option>
	                                                    <option>Fashion</option>
	                                                    <option>Events</option>
	                                                    <option>Surprise Proposal</option>
	                                              </select>
	                                        </div>
	                                    </div>
	                                     <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Choose Your Destination Name*</label>
	                                            <select>
	                                              <option>UAE</option>
	                                              <option>India</option>
	                                              <option>Pakistan</option>
	                                            </select>
	                                        </div>
	                                    </div>

	                                    <div class="col-md-6">
	                                         <div class="input-group">
	                                        <label>Select Booking Date *</label></div>
	                                        <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
	                                                
	                                                <input class="form-control" type="text" readonly />
	                                                <span class="input-group-addon"><i class="fa fa-calendar-alt" aria-hidden="true"></i></span>
	                                            </div>
	                                    </div>

	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Select Booking Time *</label>
	                                            <select>
	                                            <option selected="selected">Enter Time</option>
	                                            <option>07.00 AM</option>
	                                            <option>08.00 AM</option>
	                                            <option>09.00 AM</option>
	                                            <option>10.00 AM</option>
	                                            <option>11.00 AM</option>
	                                            <option>12.00 PM</option>
	                                            <option>01.00 PM</option>
	                                            <option>02.00 PM</option>
	                                            <option>03.00 PM</option>
	                                            <option>04.00 PM</option>
	                                            <option>05.00 PM</option>
	                                            <option>06.00 PM</option>
	                                            <option>07.00 PM</option>
	                                        </select>
	                                        </div>
	                                    </div>
	                                   
	                                    

	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Choose the package that best matches your needs*</label>
	                                            <select>
	                                            <option selected="selected">Choose the Package</option>
	                                            <option>1 Hour $250</option>
	                                            <option>2 Hour $350</option>
	                                            <option>3 Hour $450</option>
	                                            <option>4 Hour $550</option>
	                                            <option>5 Hour $650</option>
	                                            <option>6 Hour $750</option>
	                                            <option>7 Hour $950</option>
	                                            <option>8 Hour $1150</option>
	                                            <option>9 Hour $1650</option>
	                                            
	                                        </select>
	                                        </div>
	                                    </div>

	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Tell us about the guests will be joining you for your photoshot*</label>
	                                            <select>
	                                            <option>01</option>
	                                            <option>02</option>
	                                            <option>03</option>
	                                            <option>04</option>
	                                            <option>05</option>
	                                            <option>06</option>
	                                            <option>07</option>
	                                            <option>08</option>
	                                            <option>09</option>
	                                            
	                                        </select>
	                                        </div>
	                                    </div>
	                                     <div class="col-md-12">
	                                        <label>How did you hear about us *</label>
	                                        <div class="row">
	                                          
	                                            <div class="col-md-4">
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Google</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Referral</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Word of Mouth</label>
	                                                </div>
	                                                
	                                            </div>
	                                            <div class="col-md-4">
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Facebook</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Twitter</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Ad</label>
	                                                </div>
	                                                
	                                            </div>
	                                            <div class="col-md-4">
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Instagram</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Our Website</label>
	                                                </div>
	                                                <div class="input-group">
	                                                    <input type="radio">
	                                                    <label>Other</label>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>


	                                    <div class="col-md-12">
	                                        <div class="input-group contact__btn">
	                                            <button type="submit" class="thm-btn contact-one__btn">SUBMIT</button>
	                                        </div>
	                                    </div>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </section>
	      

			<?php get_template_part( 'template-parts/content', 'book-photoshoot' ); ?>

<?php
// get_sidebar();
get_footer(); ?>

<script type="text/javascript">
	
    $(function () {

		  $("#datepicker").datepicker({
		        format:'dd/mm/yyyy', 
		        autoclose: true, 
		        todayHighlight: true
		  }).datepicker('update', new Date());

	});

</script>
