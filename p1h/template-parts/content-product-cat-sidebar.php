<?php 

global $service_category_object, $current_service_categories, $fetch_hour_price, $per_min_cost; 

?>

<style type="text/css">
	div#toggle-cat-widget h2 {
    float: left;
    width: 100%;
    font-size: 18px;
    color: #fff;
    background: #424242;
    padding: 11px 40px 11px 20px;
    font-family: 'Lato', sans-serif;
    cursor: pointer;
    margin-bottom: 10px;
    position: relative;
}
#toggle-cat-widget h2::before {
    position: absolute;
    font-family: lineawesome;
    content: "\f121";
    font-size: 20px;
    color: #fff;
    top: 50%;
    right: 20px;
    margin-top: -12px;
}
#toggle-cat-widget h2.active::before {
    -webkit-transform: rotate(
90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    transform: rotate(
90deg);
}
</style>



<div class="col-lg-3 lg column">

		<div class="experties1" id="toggle-cat-widget">



			<?php // var_dump($current_service_categories) ?>

				

			<?php foreach ( $current_service_categories as $key => $current_service_category ): ?>



				<?php // var_dump($current_service_category->term_id); ?>



				<div>

					<h2 class=""><?php echo $current_service_category->name; ?></h2>

					<div class="content">



						<?php 



								global $checkIFhasChildCAT;



								$checkIFhasChildCAT = get_terms( array( 

									'taxonomy' => 'product_categories',

									'hide_empty' => false, // Remove Comment to Display all categories

									'parent' => $current_service_category->term_id

								) ); // Showing sub-sub-categories of sub-categories here.



								if (!empty($checkIFhasChildCAT)) : 

									

									foreach ($checkIFhasChildCAT as $key => $childCAT) : ?>



										<div class="subcategory">

												<div class="name">

													<a href="<?php echo get_term_link( $childCAT->term_id ); ?>"><?php echo $childCAT->name; ?></a>

												</div>



										</div>						



									<?php endforeach; ?>

								

							<?php else: 



									$args = array(



										        'posts_per_page' => -1,

										        'post_type' => 'products',

										        'tax_query' => array(



										            array (



										                'taxonomy' => 'product_categories',

										                'field' => 'term_id',

										                'terms' => $current_service_category->term_id,

										            ),



										        )

									);

							

									$the_query = new WP_Query( $args );

								

									?>



									<?php if ( $the_query->have_posts() ) : 



										$prodgroupChk = array();





										while ( $the_query->have_posts() ) : $the_query->the_post(); ?>





											<?php 



												if(get_the_terms( $post->ID, 'product_group' )) { // IN NOT NULL



													$service_group_id_sidebar = get_the_terms( $post->ID, 'product_group' )[0];



												}





												$args1 = array(



													        'posts_per_page' => -1,

													        'post_type' => 'products',

													        'tax_query' => array(



													            array (



													                'taxonomy' => 'product_group',

													                'field' => 'term_id',

													                'terms' => $service_group_id_sidebar->term_id,

													            ),



													        )

												);

										

												$the_query1 = new WP_Query( $args1 );



												// echo '<pre>';

												// var_dump($the_query1->post_count);

												// exit;



												



											?>



											<?php if (!in_array($service_group_id_sidebar->term_id, $prodgroupChk)): 

												$prodgroupChk[] = $service_group_id_sidebar->term_id; ?>



												<div class="subcategory"> <!-- these are services/ products -->

												<div class="name">

													<a href="<?php echo get_term_link($service_group_id_sidebar->term_id, 'product_group'); ?>"><?php echo $service_group_id_sidebar->name; ?></a>

												</div>

												<div class="type">



													<?php /* $typeofservices = ''; ?>



													<?php foreach (get_field('handyman_type_of_service', $post->ID) as $key => $handyman_type_of_service): ?>



														<?php $typeofservices .= $handyman_type_of_service['label'] . ' | '; ?>

														

													<?php endforeach; ?>



													<?php echo trim( $typeofservices, ' | ' ); */ ?>



													<?php // echo get_field('handyman_type_of_service', $post->ID); ?>



													<?php



													if ($the_query1->post_count > 1) {



														$typeofservices = '';



														foreach ($the_query1->get_posts() as $key => $prod) {

															

															// check if the repeater field has rows of data

															if( have_rows('handyman_product_link_to_services', $prod->ID) ):



															 	// loop through the rows of data

															    while ( have_rows('handyman_product_link_to_services', $prod->ID) ) : the_row();



															    $getServiceID = get_sub_field('handyman_product_link_to_service'); 



															    $typeofservices .= ucfirst(get_field('handyman_type_of_service', $getServiceID)) . '/ ';



															    endwhile;



															endif;





														}





													} else {



														// check if the repeater field has rows of data

														if( have_rows('handyman_product_link_to_services', $post->ID) ):



															$typeofservices = '';



														 	// loop through the rows of data

														    while ( have_rows('handyman_product_link_to_services', $post->ID) ) : the_row(); 



														    $getServiceID = get_sub_field('handyman_product_link_to_service'); 



														    $typeofservices .= ucfirst(get_field('handyman_type_of_service', $getServiceID)) . '/ ';



														    endwhile;



														endif;



													}



													?>



													<span class=""><?php echo trim( $typeofservices, '/ ' ); ?></span>

													

												</div>

											</div>

												

											<?php endif; ?>



										<?php endwhile; ?>



									<?php else: ?>



										<p style="border: 1px solid #ddd; padding: 10px; font-size: 0.7rem; text-align: center;">No Products Found.</p>



									<?php endif; wp_reset_postdata(); ?>





							<?php endif; ?>

												



					</div>

				</div>

				

			<?php endforeach; ?>



		

		</div>











</div>