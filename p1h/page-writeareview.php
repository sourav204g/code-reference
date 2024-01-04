<?php
/**
 * Template Name: Write a review
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package handyman_pro
 */

$token = $_GET['token'];
$booking_id = $_GET['booking'];

if (isset($token) && isset($booking_id)) {
	global $wpdb;

	$review = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM hxp_richreviews WHERE booking_id = %d", array( $booking_id ) ), 'ARRAY_A');

	if ($review['token'] == $token) {		
		// $handyman_id = $_GET['handyman'];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			if ( !isset( $_POST['hnd_pro_review_nonce'] ) && !wp_verify_nonce( $_POST['hnd_pro_review_nonce'], 'spiderman_noway_home' ) ) {
					die( 'Failed security check' );
			} else {

					if (!isset($review['solitary_ratings'])) {

						$review = sanitize_text_field($_POST['feedback_message']);
						$review_status = 1;

						unset($_POST['hnd_pro_review_nonce']);
						unset($_POST['_wp_http_referer']);
						unset($_POST['feedback_message']);

						$sum = 0;

						foreach ($_POST as $key => $value) {
							$sum += (int) $value;
						}

						$review_rating = round($sum / 6, 2);
						$solitary_ratings = json_encode($_POST);

						// echo "<pre>";
						// var_dump($_POST);
						// var_dump($sum);
						// var_dump($review_rating);
						// exit;

						// review_rating
						// review_text
						// review_status
						// solitary_ratings
						
						 $wpdb->query( $wpdb->prepare(
						    "UPDATE hxp_richreviews set solitary_ratings = '%s', review_rating = '%d', review_status = '%d', review_text = '%s' WHERE booking_id = '%d'",
						    array(
						        $solitary_ratings,
						        $review_rating,
						        $review_status,
						        $review,
						        $booking_id
						    )
						));

						wp_redirect('/thank-you-2/');
						// echo "<script> window.location.href = '/write-a-review/?success1=true'; </script>";
						die();

					} else {
						// wp_redirect('/write-a-review/?error=true');
						echo "<script> window.location.href = '/write-a-review/?error=true'; </script>";
						die();
					}

					// echo "<pre>";
					// var_dump($review['review_text']);
					
					
			}
		}


	} else {
		echo "Invalid Token!";
		die();
	}



} else {
	wp_redirect('/write-a-review/?error=true');
	die();
}


get_header(); ?>

	<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>

<style>
 .pf-title { margin-bottom: 0px; } 


.star-rating {
  display:flex;
  flex-direction: row-reverse;
  font-size:1.5em;
  justify-content:space-around;
  padding:0 .2em;
  text-align:center;
  width:8em;
  float: left;
}

.star-rating input {
  display:none;
}

.star-rating label {
  color:#ccc;
  cursor:pointer;
}

.star-rating :checked ~ label {
  color:#f90;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
  color:#fc0;
}
.star-rating label::before, .star-rating label::after {
    position: absolute;
    top: 0;
    left: 0;
    display:none;
    width: 20px !important;
    height: 20px !important;
}
.star-rating label{
   padding-left:5px;
}

.table th, .table td {
    padding: 8px;
    vertical-align: top;
    border-top: 1px solid #eceeef;
    vertical-align: middle;
}

.table th{
    width:250px;
}

.inner-title2{
	text-align: center;
}

.writeareview{
	border: 1px solid #cae0e7;
    background: #fff;
/*    border-bottom: 4px solid #cae0e7 !important;*/
    padding: 20px !important;
    width: 100% !important;
    margin-bottom: 30px;
    position: relative;
}

.text-area textarea{
	border: 1px solid #cae0e7;
    background: #fff;
    border-bottom: 4px solid #cae0e7 !important;
    padding: 20px !important;
    width: 100% !important;
    margin-bottom: 30px;
    position: relative;
}

.roubox {
    border: 1px solid #cae0e7;
    width: 40px;
    height: 40px;
    border-radius: 25px;
    text-align: center;
    vertical-align: middle;
    padding-top: 8px;
    float: left;
    cursor: pointer;
}

.hidden-fields {
	display: none;
}

</style>

<section>
<div class="block">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 column">
			</div>
			<div class="col-lg-6 column">


				<?php /* if (isset($_GET['success'])): ?>

					<p >Your feedback has been successfully submitted!</p>
					
				<?php endif; */ ?>


				<div class="writeareview">
					<h3><strong><?php echo get_the_title($_GET['handyman']); ?></strong></h3>
					<p> Please rate your techinician</p>

					<form action="" method="POST">

						<?php wp_nonce_field('spiderman_noway_home', 'hnd_pro_review_nonce'); ?>
					
						<table class="table">
						  <tbody>
						    <tr>
						      <th scope="row">Price</th>
						      <td>
						      	<div class="star-rating price">
								  <input type="radio" id="price-5-stars" name="price" value="5" />
								  <label for="price-5-stars" class="star">&#9733;</label>
								  <input type="radio" id="price-4-stars" name="price" value="4" />
								  <label for="price-4-stars" class="star">&#9733;</label>
								  <input type="radio" id="price-3-stars" name="price" value="3" />
								  <label for="price-3-stars" class="star">&#9733;</label>
								  <input type="radio" id="price-2-stars" name="price" value="2" />
								  <label for="price-2-stars" class="star">&#9733;</label>
								  <input type="radio" id="price-1-star" name="price" value="1" />
								  <label for="price-1-star" class="star">&#9733;</label>
								  <div class="hidden-fields">
								  	<input type="radio" id="price-0-star" name="price" value="0" />
								  	<label for="price-0-star" class="star">&#9733;</label>
								  </div>
								</div>
								<div class="roubox" data-na="price">NA</div>
						      </td>
						      
						    </tr>
						    <tr>
						      <th scope="row">Quality</th>
						      <td><div class="star-rating quality">
								  <input type="radio" id="quality-5-stars" name="quality" value="5" />
								  <label for="quality-5-stars" class="star">&#9733;</label>
								  <input type="radio" id="quality-4-stars" name="quality" value="4" />
								  <label for="quality-4-stars" class="star">&#9733;</label>
								  <input type="radio" id="quality-3-stars" name="quality" value="3" />
								  <label for="quality-3-stars" class="star">&#9733;</label>
								  <input type="radio" id="quality-2-stars" name="quality" value="2" />
								  <label for="quality-2-stars" class="star">&#9733;</label>
								  <input type="radio" id="quality-1-star" name="quality" value="1" />
								  <label for="quality-1-star" class="star">&#9733;</label>
								  <div class="hidden-fields">
								  	<input type="radio" id="quality-0-star" name="quality" value="0" />
								  	<label for="quality-0-star" class="star">&#9733;</label>
								  </div>
								</div>
								<div class="roubox" data-na="quality">NA</div>
							</td>
						    </tr>
						    <tr>
						      <th scope="row">Cleanliness</th>
						      <td><div class="star-rating cleanliness">
								  <input type="radio" id="cleanliness-5-stars" name="cleanliness" value="5" />
								  <label for="cleanliness-5-stars" class="star">&#9733;</label>
								  <input type="radio" id="cleanliness-4-stars" name="cleanliness" value="4" />
								  <label for="cleanliness-4-stars" class="star">&#9733;</label>
								  <input type="radio" id="cleanliness-3-stars" name="cleanliness" value="3" />
								  <label for="cleanliness-3-stars" class="star">&#9733;</label>
								  <input type="radio" id="cleanliness-2-stars" name="cleanliness" value="2" />
								  <label for="cleanliness-2-stars" class="star">&#9733;</label>
								  <input type="radio" id="cleanliness-1-star" name="cleanliness" value="1" />
								  <label for="cleanliness-1-star" class="star">&#9733;</label>
								  <div class="hidden-fields">
								  	<input type="radio" id="cleanliness-0-star" name="cleanliness" value="0" />
								  	<label for="cleanliness-0-star" class="star">&#9733;</label>
								  </div>
								</div>
								<div class="roubox" data-na="cleanliness">NA</div>
							</td>
						    </tr>
						    <tr>
						      <th scope="row">Responsiveness</th>
						      <td><div class="star-rating responsiveness">
								  <input type="radio" id="responsiveness-5-stars" name="responsiveness" value="5" />
								  <label for="responsiveness-5-stars" class="star">&#9733;</label>
								  <input type="radio" id="responsiveness-4-stars" name="responsiveness" value="4" />
								  <label for="responsiveness-4-stars" class="star">&#9733;</label>
								  <input type="radio" id="responsiveness-3-stars" name="responsiveness" value="3" />
								  <label for="responsiveness-3-stars" class="star">&#9733;</label>
								  <input type="radio" id="responsiveness-2-stars" name="responsiveness" value="2" />
								  <label for="responsiveness-2-stars" class="star">&#9733;</label>
								  <input type="radio" id="responsiveness-1-star" name="responsiveness" value="1" />
								  <label for="responsiveness-1-star" class="star">&#9733;</label>
								  <div class="hidden-fields">
								  	<input type="radio" id="responsiveness-0-star" name="responsiveness" value="0" />
								  	<label for="responsiveness-0-star" class="star">&#9733;</label>
								  </div>
								</div>
								<div class="roubox" data-na="responsiveness">NA</div>
							</td>
						    </tr>
						    <tr>
						      <th scope="row">Punctuality</th>
						      <td><div class="star-rating punctuality">
								  <input type="radio" id="punctuality-5-stars" name="punctuality" value="5" />
								  <label for="punctuality-5-stars" class="star">&#9733;</label>
								  <input type="radio" id="punctuality-4-stars" name="punctuality" value="4" />
								  <label for="punctuality-4-stars" class="star">&#9733;</label>
								  <input type="radio" id="punctuality-3-stars" name="punctuality" value="3" />
								  <label for="punctuality-3-stars" class="star">&#9733;</label>
								  <input type="radio" id="punctuality-2-stars" name="punctuality" value="2" />
								  <label for="punctuality-2-stars" class="star">&#9733;</label>
								  <input type="radio" id="punctuality-1-star" name="punctuality" value="1" />
								  <label for="punctuality-1-star" class="star">&#9733;</label>
								  <div class="hidden-fields">
								  	<input type="radio" id="punctuality-0-star" name="punctuality" value="0" />
								  	<label for="punctuality-0-star" class="star">&#9733;</label>
								  </div>
								</div>
								<div class="roubox" data-na="punctuality">NA</div>
							</td>
						    </tr>
						     <tr>
						      <th scope="row">Professonalism</th>
						      <td><div class="star-rating professonalism">
								  <input type="radio" id="professonalism-5-stars" name="professonalism" value="5" />
								  <label for="professonalism-5-stars" class="star">&#9733;</label>
								  <input type="radio" id="professonalism-4-stars" name="professonalism" value="4" />
								  <label for="professonalism-4-stars" class="star">&#9733;</label>
								  <input type="radio" id="professonalism-3-stars" name="professonalism" value="3" />
								  <label for="professonalism-3-stars" class="star">&#9733;</label>
								  <input type="radio" id="professonalism-2-stars" name="professonalism" value="2" />
								  <label for="professonalism-2-stars" class="star">&#9733;</label>
								  <input type="radio" id="professonalism-1-star" name="professonalism" value="1" />
								  <label for="professonalism-1-star" class="star">&#9733;</label>
								  <div class="hidden-fields">
								  	<input type="radio" id="professonalism-0-star" name="professonalism" value="0" />
								  	<label for="professonalism-0-star" class="star">&#9733;</label>
								  </div>
								</div>
								<div class="roubox" data-na="professonalism">NA</div>
							</td>
						    </tr>
						   
						  </tbody>
						</table>

						<div class="text-area">
							<textarea name="feedback_message" cols="40" rows="10" class="textarea" aria-required="true" aria-invalid="false" placeholder="Share details of your own experience at this place." spellcheck="false" data-ms-editor="true" required></textarea>
						</div>
						<button type="submit" id="submit_review">Send</button>

					</form>


					<div class="clearfix"></div>

				</div>

			</div>
			<div class="col-lg-3 column">
			</div>
		</div>
	</div>
</div>
</section>

<?php
get_footer(); ?>

<script>
	
	$(function(){
		$('.roubox').click(function(){
			let na = $(this).data('na');
			$(this).prev().find('input').removeAttr('checked');
			$(this).prev().find('#' + na + '-0-star').attr('checked', 'checked');
		});

		$('.star-rating').click(function(){
			$(this).find('.hidden-fields input').removeAttr('checked');
		});

	});	
</script>