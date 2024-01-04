<?php



global $per_min_cost;



// check if the repeater field has rows of data

if( have_rows('hnd_featured_service_listings') ):



 	// loop through the rows of data

    while ( have_rows('hnd_featured_service_listings') ) : the_row(); ?>



    	<div class="col-lg-3 col-md-6">

            <div class="handypro-box">

              <article class="wow" style="background: url(<?php echo get_sub_field('hnd_featured_category_image')['url']; ?>);">



                <div class="exp-icon"><img alt="." src="<?php echo get_sub_field('hnd_featured_listing_icon')['url']; ?>" title="Handyman"></div>



                <div class="exp-head">

    				<h3><?php echo get_sub_field('hnd_featured_listing'); ?></h3>

    			</div><span class="exp-serv2"><a href="#">Explore Services &gt;&gt;</a></span>



                <div class="exp-tech-hover">

                  

                  <div class="for-mob" style="display: block;"></div>

                  

                  <div class="exp-inner-main">

                    

	    					<div class="exp-inner-brd">

	    						<h4><?php echo get_sub_field('hnd_featured_listing'); ?><span class="homediscount">

	    						    

	    						    <?php if (get_sub_field('hnd_todays_discount')): ?>

									<h5> <?php echo get_sub_field('hnd_todays_discount'); ?>% OFF</h5>

								<?php else: ?>

								<?php endif; ?>

	    						</span></h4>

	    						

	    						



	    						<ul>



	    							<?php if (get_sub_field('hnd_featured_services')): ?>



	    							<?php foreach ( get_sub_field('hnd_featured_services') as $key => $hnd_featured_service ): ?>



	    								<?php // $hnd_featured_service['hnd_featured_service']



									   		  	$argsx = array(



											        'posts_per_page' => -1,

											        'post_type' => 'services',

											        'post_status' => 'publish',

											        'tax_query' => array(



											            array (



											                'taxonomy' => 'service_group',

											                'field' => 'term_id',

											                'terms' => $hnd_featured_service['hnd_featured_service'],

											            ),



											        ),

											        'orderby' => 'meta_value',

											        'meta_key' => 'handyman_type_of_service',

											        'order' => 'DESC'

												);



									   		  	$service_groups_wp = new WP_Query( $argsx );



	    										$service_groups_arrs  = $service_groups_wp->get_posts();



	    										$permalink_link = get_term_link($hnd_featured_service['hnd_featured_service'], 'service_group');

	    										

	    										$termID = (int) $hnd_featured_service['hnd_featured_service'];



	    										if ( count($service_groups_arrs) > 1) {

	    											$permalink_link = get_term_link($termID, 'service_group');

	    										} else {

	    											$permalink_link = get_permalink($service_groups_arrs[0]->ID);

	    										}



	    										$groupObj = get_term_by('id', $termID, 'service_group');



	    										$groupName = $groupObj->name;



	    								?>

	    							

			    							<li>

			    								<a href="<?php echo $permalink_link; ?>"><span><?php echo $groupName; ?></span> <br/>

			    									

			    									<?php foreach ( $service_groups_arrs as $service_groups_arr ): ?>



			    											<?php echo ucfirst(get_field('handyman_type_of_service', $service_groups_arr->ID)) . ': '; 



			    											$servicePrice = $per_min_cost * get_field('handyman_est_time', $service_groups_arr->ID);



			    											if ($servicePrice > 0) : ?>



				    											<del><?php 



				    												





				    												if (get_field('handyman_product_premium', $service_groups_arr->ID)) {

				    													

				    													$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $service_groups_arr->ID))/100;



				    												} else {

				    													

				    													$handyman_premium = 0;

				    												}



				    												$servicePrice = $servicePrice + $handyman_premium;



				    												// IF Discount is set

				    												if(get_field('handyman_product_discount', $service_groups_arr->ID)) {



				    													$discount = get_field('handyman_product_discount', $service_groups_arr->ID);



				    													$afterDiscount = ( $servicePrice * $discount ) / 100;



				    												} else {



				    													$afterDiscount = 0;

				    												}



				    												echo '$' . round($servicePrice, 2); ?></del> <?php echo '$' . round($servicePrice - $afterDiscount, 2); ?>

				    											</span><br/>



			    											<?php else: ?>



			    												<?php 



			    												    if (get_field('handyman_est_time', $service_groups_arr->ID) == 0 && get_field('handyman_add_on_services', $service_groups_arr->ID)): ?>:



			    												    <?php 



			    												      $LabourMinz = array();



			    												      foreach (get_field('handyman_add_on_services', $service_groups_arr->ID)[0]['handyman_addon_options'] as $key => $handyman_add_on_services ) {



			    												        if ( (int) $handyman_add_on_services['labour_minutes'] !== 0 ) {

			    												              $LabourMinz[] = (int) $handyman_add_on_services['labour_minutes'];

			    												        }



			    												      }



			    												      sort($LabourMinz);



			    												    ?>





			    												    <?php $optFirstLabourMin = $LabourMinz[0]; ?>



			    												    <?php $servicePrice = $per_min_cost * (int) $optFirstLabourMin; ?>



			    												    <?php 



			    												      // var_dump($servicePrice);

			    												      // var_dump(round($per_min_cost,2));

			    												      // exit();



			    												      if (get_field('handyman_product_premium', $service_groups_arr->ID)) {

			    												        

			    												        $handyman_premium = ($servicePrice * get_field('handyman_product_premium', $service_groups_arr->ID))/100;



			    												      } else {

			    												        

			    												        $handyman_premium = 0;

			    												      }



			    												      $servicePrice = $servicePrice + $handyman_premium;



			    												      // IF Discount is set

			    												      if(get_field('handyman_product_discount', $service_groups_arr->ID)) {



			    												        $discount = get_field('handyman_product_discount', $service_groups_arr->ID);



			    												        $afterDiscount = ( $servicePrice * $discount ) / 100;



			    												        echo '<del>$' . round($servicePrice, 2); ?></del> <span><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span> <span>and Up</span></h4>



			    												     <?php } else {

			    												        

			    												        $afterDiscount = 0; ?>



			    												       <span><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span> <span>and Up</span></h4>





			    												    <?php  } ?>

			    												    

			    												<?php endif; // --- ?>



																<?php if (!get_field('handyman_add_on_services', $service_groups_arr->ID)): ?>



															      : <span><em>Get a Quote</em></span><br/>

															      

															    <?php endif; ?>  



			    												



			    											<?php endif; ?>



			    									<?php endforeach; ?>

													

												</a>

			    							</li>



	    								<?php endforeach; ?>



	    								<?php endif; ?>

	    							

	    						</ul>



	    						<?php $cath = get_term( get_sub_field('hnd_featured_listing_id'), 'service_categories' ); ?>



	    						<?php if (get_sub_field('hnd_featured_listing_id')): ?>



	    							<a class="learn-more" href="<?php echo get_sub_field('hnd_featured_cat_link') ?>">View all (<?php echo $cath->count; ?>) <?php // echo get_sub_field('hnd_featured_listing'); ?> Services <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>



	    						<?php else: ?>



	    							<a class="learn-more" href="<?php echo get_sub_field('hnd_featured_cat_link') ?>">View all <?php // echo get_sub_field('hnd_featured_listing'); ?> Services <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>

	    							

	    						<?php endif; ?>

	    						



	    					</div>



                  </div>

                </div>



              </article>

              <div class="clearfix"></div>

            </div>

          </div>



<?php   // display a sub field value

        // get_sub_field('sub_field_name');



endwhile; endif; ?>