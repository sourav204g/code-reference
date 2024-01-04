<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TravelTographer
 */

if (isset($_POST['travelt_booking_submit'])) {
	process_booking_form($_POST);
}

function process_booking_form($data) {

	if ( !isset( $data['traveltographer_nonce'] ) || !wp_verify_nonce( $data['traveltographer_nonce'], 'loki_season_1' ) ) {

		   die( 'Failed security check' );

	} else {

		global $wpdb;

		// : server side validation - not implemented.

		$new = wp_insert_post( array (
				    'post_type' => 'bookings',
				    'post_title' => '',
				    'post_content' => '',
				    'post_status' => 'pending',
				    'comment_status' => 'closed',
				    'ping_status' => 'closed',
		));

		$update_booking = array(
		    'ID'         => $new,
		    'post_title' => 'Booking No: ' . $new
		);

		wp_update_post( $update_booking );

		$dateTime = new DateTime();

		// var_dump($dateTime);

		$dateTime->setTimezone(new DateTimeZone('Asia/Dubai'));
		
		// var_dump($dateTime->format('m/d/Y g:i A'));
		// exit;

		$status = $wpdb->query( $wpdb->prepare(
		    "INSERT ignore INTO tvl_travelt_booking (booking_id, booking_details, booking_date) VALUES ( %d, %s, %s )",
		    array(
		        $new,
		        json_encode($data),
		        $dateTime->format('m/d/Y g:i A')
		    )
		) );


		wp_redirect( home_url( '/response/?new=' . $new . '&payment=make&amt=' . $data['travelt_cost'] ) );
		die();

		// wp_redirect( home_url( '/response/?bid=' . $new . '&booking=success' ) );
		// die(); // COMMENTED 


	}

}





$categories = get_the_terms($post->ID, 'photography_types');

get_header();
?><?php /* 

		while ( have_posts() ) :
			the_post();

			// echo '<pre>';
			// var_dump(get_previous_post());
			// exit;


			get_template_part( 'template-parts/content', get_post_type() );

		endwhile; */ // End of the loop.
		?>

		<style>
		.review_two_box_form__title { margin-top: initial; }

		.selectpicker1 {
				height: 45px;
			    width: 100%;
			    border: none;
			    background: #ffffff;
			    padding: 0 20px;
			    margin-bottom: 10px;
			    outline: none;
			    font-size: 16px;
			    color: var(--thm-gray);
			    border-radius: 4px;
			    text-align: left;
			    -webkit-appearance: none;
			    -moz-appearance: none;
			    /* background: transparent; */
			    background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
			    background-repeat: no-repeat;
			    background-position-x: 97%;
			    background-position-y: 9px;
			    border-radius: 2px;
			    margin-right: 2rem;
			    /* padding: 1rem; */
			    padding-right: 2rem;
		}

		.booking-form { position: relative; }
		.booking-overlay { 
			position: absolute; 
			left: 0px;
			right: 0px;
			top: 0px;
			bottom: 0px;
			z-index: 99;
			background: rgb(240 248 255 / 78%);
		    display: flex;
		    justify-content: center;
		    flex-direction: column;
		    text-align: center;
		}

		.booking-overlay a {
			text-decoration: underline;
		}

		</style>



		<!-- Listings Details Main Image Box Start-->
		<section class="listings_details_main_image_box">
		    <div class="container-full-width">
		        <div class="photo_carousel owl-carousel owl-theme">

		        	<?php 
		        	
		        	$images = get_field('traveltographer_gallery');
		        	
		        	if( $images ): ?>
		        
		        	        <?php foreach( $images as $image ): ?>
		        	            <div class="item">
		        	               <img src="<?php echo $image['url']; ?>" alt="">
		        	            </div>
		        	        <?php endforeach; ?>
		        
		        	<?php endif; ?>
		            
		           
		        </div>
		    </div>
		</section>

		<!--Main Bottom Start-->
		<section class="main_bottom">
		    <div class="container">
		        <div class="row">
		            <div class="col-xl-6 col-lg-6">
		                <div class="main_bottom_left">
		                    <div class="main_bottom_content">
		                        <div class="author_image">

		                        	<?php if (get_the_post_thumbnail_url($post->ID)): ?>
		                        		<img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="profile picture">
		                        	<?php else: ?>
		                        		<img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/team/blank-profile-picture.webp" alt="profile picture">
		                        	<?php endif; ?>

		                        </div>
		                        <div class="icon">
		                            <span class="fas fa-camera"></span>
		                        </div>
		                         <div class="main_bottom_left_title">
		                        <h3><?php the_title(); ?></h3>
		                    </div>
		                    </div>
		                   
		                    
		                </div>
		            </div>
		            <div class="col-xl-6 col-lg-6">
		                <div class="main_bottom_right">
		                    <div class="main_bottom_right_Buttons">
		                        <a href="#"><i class="fas fa-share"></i>share</a>
		                        <a href="#"><i class="fas fa-bookmark"></i>Save</a>
		                        
		                    </div>
		                   
		                </div>
		            </div>
		        </div>
		    </div>
		</section>

		<!--Listings Details Start-->
		<section class="listings_details">
		    <div class="container">
		        <div class="row">
		            <div class="col-xl-8">
		                
		                <div class="listings_details_left">

		                	<?php if (get_the_content()): ?>

		                		<div class="listings_details_features_title">
		                		   <h2><i class="fas fa-user"></i> About Me</h2>
		                		</div>
		                		<hr/>
		                		<div class="listings_details_text">
		                		    <p class="first_text"><?php the_content(); ?></p>
		                		</div>
		                		
		                	<?php endif; ?>

		                    <div class="listings_details_features_title">
		                       <h2><i class="fas fa-map-marker-alt"></i> Locations</h2>
		                    </div>
		                    <hr/>
		                    <div class="listings_details_text">
		                        <p class="first_text"><?php echo get_field('traveltographer_address'); ?></p>
		                    </div>
		                   
		                    <div class="listings_details_tag">
		                        <div class="listings_details_features_title">
		                       <h2><i class="fas fa-sliders-h"></i> Categories</h2>
		                    </div>
		                    <hr/>
		                        <div class="listings_details__tags-list">
		                        	<?php foreach ($categories as $key => $cat): ?>
		                        		<a href="#"><?php echo $cat->name; ?></a>
		                        	<?php endforeach; ?>
		                        </div>
		                    </div>

		                    <div class="listings_details_tag">
		                        <div class="listings_details_features_title">
		                       <h2><i class="fas fa-globe"></i> Languages</h2>
		                    </div>
		                    <hr/>
		                        <div class="listings_details__tags-list">
		                        	<?php foreach (explode(',', get_field('traveltographer_languages')) as $key => $lang): ?>
		                        		<a href="#"><?php echo $lang; ?></a>
		                        	<?php endforeach; ?>
		                        </div>
		                    </div>


		                    <!--Review Two Box-->
		                    <?php /* <div class="review_two_box" style="margin-top:30px;">

		                        <div class="listings_details_features_title">
		                           <h2><i class="fas fa-star"></i> What They Say</h2>
		                        </div>
		                        <hr/>
		                        
		                        <div class="review_two_box__single">
		                            <div class="review_two_box__image">
		                                <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/resources/review-2-img-1.png" alt="">
		                            </div>
		                            <div class="review_two_box__content">
		                                <h3>Kevin Martin</h3>
		                                
		                                <p>It has survived not only five centuries, but also the leap into electronic
		                                    typesetting unchanged. It was popularised in the sheets containing lorem
		                                    ipsum is simply free text available in the martket to use now.</p>
		                            </div>
		                        </div>
		                        <!--Review Two Box Single-->
		                        <div class="review_two_box__single">
		                            <div class="review_two_box__image">
		                                <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/resources/review-2-img-2.png" alt="">
		                            </div>
		                            <div class="review_two_box__content">
		                                <h3>Sarah Albert</h3>
		                                
		                                <p>It has survived not only five centuries, but also the leap into electronic
		                                    typesetting unchanged. It was popularised in the sheets containing lorem
		                                    ipsum is simply free text available in the martket to use now.</p>
		                            </div>
		                        </div>
		                       
		                    </div> */ ?>


		                    <div class="review_two_box_form">
		                    	<div class="review_two__form">
		                        <!-- <h3 class="review_two_box_form__title"><i class="fas fa-edit"></i> Write a Review</h3> -->

			                        <?php if ( comments_open() || get_comments_number() ) :
											comments_template();
										  endif; 
									?>
							    </div>
		                       
		                        <!-- <form action="#" class="review_two__form">
		                            <div class="row">
		                                <div class="col-xl-12">
		                                    <div class="review_two_input_box">
		                                        <input type="text" placeholder="Your review title" name="Review Title">
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="row">
		                                <div class="col-xl-12">
		                                    <div class="review_two_input_box">
		                                        <textarea name="message" placeholder="Write message"></textarea>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="row">
		                                <div class="col-xl-6">
		                                    <div class="review_two_input_box">
		                                        <input type="text" placeholder="Full name" name="name">
		                                    </div>
		                                </div>
		                                <div class="col-xl-6">
		                                    <div class="review_two_input_box">
		                                        <input type="email" placeholder="Email address" name="email">
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="row">
		                                <div class="col-xl-12">
		                                    <button type="submit" class="thm-btn review_from__btn">Send Message</button>
		                                </div>
		                            </div>
		                        </form> -->


		                    </div>
		                </div>
		            </div>
		            <div class="col-xl-4">

		            	


		                <div class="listings_details_sidebar booking-form">

		                	<?php if (!is_user_logged_in()): ?>

		            		<div class="booking-overlay">
		            			<p><a href="<?php echo home_url('/sign-in/'); ?>">Sign In</a> to Book a Photographer.</p>
		            		</div>
		            		
		            		<?php endif; ?>

		                    <div class="listings_details_sidebar__single contact_business text-center">
		                        <h3 class="listings_details_sidebar__title">Book Traveltographer</h3>
		                        <p>Select a date and time and we will do our best to accommodate your request.</p>
		                        <div class="contact_business_details">

		                        	<?php 


		                        	$countryID = get_the_terms( get_the_ID() , 'locations' )[0]->term_id;

		                        	$cityName  = get_field('traveltographer_city');

		                        	$pricing = array_filter(get_field('travelt_pricing_model', 'locations_' . $countryID), function ($data) {

		                        		global $cityName;                
		                        	
		                        	    return ( $data['travelt_select_city'] == $cityName );
		                        	});                        	

		                        	$pricing = array_values($pricing); 
	                        	
		                        	// reseting index ?>

		                        	<form action="" name="travelt_booking"  method="POST">

		                        	<?php wp_nonce_field('loki_season_1', 'traveltographer_nonce'); ?>

		                        	<input type="hidden" name="travelt_photographer_id" value="<?php echo $post->ID; ?>" >

		                        	<input type="hidden" name="travelt_cost" value="">
		                            
		                            <input type="text" placeholder="Your Name" name="travelt_name" required>
		                            <input type="email" placeholder="Email Address" name="travelt_email" required>
		                            <input type="text" placeholder="Phone Number" name="travelt_phone" required>

		                            <select class="selectpicker1" data-width="100%"  name="travelt_phtype" required>
		                                    
		                                    <option selected="selected" value="">Select Type</option>

		                                    <?php $terms = get_the_terms( get_the_ID() , 'photography_types' );

		                                    // echo "<pre>";
		                                    // var_dump($terms);
		                                    // exit;


		                                     ?>

		                                    <?php foreach ($terms as $key => $term): 

		                                    	$index = array_search($term->term_id, array_column($pricing, 'travelt_select_type')); 

		                                    	if ($index !== false) :  ?>

		                                    	<option value="<?php echo $term->term_id; ?>" data-price="<?php echo $pricing[$index]['travelt_cost']; ?>"><?php echo $term->name; ?></option>
		                                    	
		                                    <?php endif; endforeach; ?>
		                                    
		                            </select>
		                            
		                            <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
		                                    <input class="form-control" name="travelt_date" type="text" readonly required/>
		                                    <span class="input-group-addon"><i class="fa fa-calendar-alt" aria-hidden="true"></i></span>
		                            </div>

		                            <select class="selectpicker1" data-width="100%"  name="travelt_time" required>
		                                    <option selected="selected" value="">Select Time</option>
		                                    <option value="12:00 AM">12:00 AM</option>
		                                    <option value="01:00 AM">01:00 AM</option>
		                                    <option value="02:00 AM">02:00 AM</option>
		                                    <option value="03:00 AM">03:00 AM</option>
		                                    <option value="04:00 AM">04:00 AM</option>
		                                    <option value="05:00 AM">05:00 AM</option>
		                                    <option value="06:00 AM">06:00 AM</option>
		                                    <option value="07:00 AM">07:00 AM</option>
		                                    <option value="08:00 AM">08:00 AM</option>
		                                    <option value="09:00 AM">09:00 AM</option>
		                                    <option value="10:00 AM">10:00 AM</option>
		                                    <option value="11:00 AM">11:00 AM</option>
		                                    <option value="12:00 PM">12:00 PM</option>
		                                    <option value="01:00 PM">01:00 PM</option>
		                                    <option value="02:00 PM">02:00 PM</option>
		                                    <option value="03:00 PM">03:00 PM</option>
		                                    <option value="04:00 PM">04:00 PM</option>
		                                    <option value="05:00 PM">05:00 PM</option>
		                                    <option value="06:00 PM">06:00 PM</option>
		                                    <option value="07:00 PM">07:00 PM</option>
		                                    <option value="08:00 PM">08:00 PM</option>
		                                    <option value="09:00 PM">09:00 PM</option>
		                                    <option value="10:00 PM">10:00 PM</option>
		                                    <option value="11:00 PM">11:00 PM</option>
		                            </select>
		                            <!-- <textarea placeholder="Write Message"></textarea> -->

		                            <input type="submit" name="travelt_booking_submit" class="thm-btn contact_business_btn" value="Book Now">

		                            </form>

		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>


<?php
// get_sidebar();
get_footer(); ?>

<script type="text/javascript">
    $(function () {

    	$('[name="travelt_phtype"]').change(function(){

    		let price = $(this).find('option[value="' + $(this).val() + '"]').data('price');

    		if (price) {
    			$('[name="travelt_cost"]').val(price);
    		} else {
    			$('[name="travelt_cost"]').val('');
    		}

    	});



    	$('#respond').prepend('<h3 class="review_two_box_form__title"><i class="fas fa-edit"></i> Write a Review</h3>');
    	$('#reply-title').remove();

    	if ( $('.comment-list').length ) {
    		$('#comments').prepend('<div class="listings_details_features_title"> <h2><i class="fas fa-star"></i> What They Say</h2> </div><hr>');
    	}

    	$('#comments .comments-title').remove();
    	
	  	$("#datepicker").datepicker({
	        format:'dd/mm/yyyy', 
	        autoclose: true, 
	        todayHighlight: true,
	        startDate: new Date()
	  	}).datepicker('update', new Date());

});
</script>
