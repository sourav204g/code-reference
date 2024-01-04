<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TravelTographer
 */

			$locations = get_terms( array( 
			      'taxonomy' => 'locations',
			      'hide_empty' => false,
			) );

			$photography_types = get_terms( array( 
			      'taxonomy' => 'photography_types',
			      'hide_empty' => false,
			) );

?>

			<section class="listings_three_content">
			            <div class="container">
			                <div class="row">
			                    <div class="col-xl-12">
			                        <form method="GET" action="<?php echo home_url('/photographers/'); ?>" class="listings_one_content_left_form">
			                            <div class="row">
			                                <div class="col-xl-2 col-lg-2">
			                                   <h3>Filter by:</h3>
			                                </div>
			                                <div class="col-xl-3 col-lg-3 pl-2 pr-2">
			                                    <div class="input_box">
			                                        <select class="destination-input" name="loc" data-width="100%" required>
				                                            <option value="">Enter Your Destination Name</option>

							                                    <?php foreach ($locations as $key => $location): ?>

							                                    	<?php if ( $location->term_id == (int) $_GET['loc'] ): ?>
							                                    		
							                                    		<option value="<?php echo $location->term_id; ?>" selected><?php echo $location->name; ?></option>

							                                    	<?php else: ?>

							                                    		<option value="<?php echo $location->term_id; ?>"><?php echo $location->name; ?></option>
							                                    		
							                                    	<?php endif; ?>

							                                    	
							                                    	
							                                    <?php endforeach; ?>
				                                    </select>
			                                    </div>
			                                </div>
			                                <div class="col-xl-3 col-lg-3 pl-2 pr-2">
			                                    <div class="input_box city-box">
			                                        <select class="city-input" name="city" data-width="100%" required>
				                                        <option value="">Enter Your City Name</option>

				                                        <?php if (isset($_GET['loc'])): ?>

				                                        	

				                                        	<?php $taxnow = 'locations';

															$country = (int) $_GET['loc'];


															if ($country) {
																if( have_rows('travelt_cities', $taxnow . '_' . $country ) ):

																    // Loop through rows.
																    while( have_rows('travelt_cities', $taxnow . '_' . $country ) ) : the_row();

																        // Load sub field value.
																        $city = get_sub_field('travelt_city_q', $country ); ?>
																      

																        <option value=<?php echo strtolower($city); ?>><?php echo $city; ?></option>

													<?php		    // End loop.
																    endwhile;

																endif;
															} ?>
				                                        	
				                                        <?php endif ?>
							                   </select>  
			                                    </div>
			                                </div>
			                                <div class="col-xl-3 col-lg-3 pl-2 pr-2">
			                                    <div class="input_box">
			                                        <select class="type-input" name="type" data-width="100%" required>
			                                            <option value="">All Categories</option>
			                                            <?php foreach ($photography_types as $key => $type): ?>

							                                <option value="<?php echo $type->term_id; ?>"><?php echo $type->name; ?></option>
							                                    	
							                            <?php endforeach; ?>
			                                        </select>
			                                    </div>
			                                </div>
			                                <div class="col-xl-1 col-lg-1">
			                                    <div class="listings_btn">
			                                      <button type="submit" class="thm-btn"><span class="icon-magnifying-glass"></span>Search</button>
			                                </div>
			                                </div>
			                               
			                            </div>
			                        </form>
			                    </div>
			                </div>

			            </div>
			</section>
