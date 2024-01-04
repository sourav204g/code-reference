<?php 

$service_category_object = get_queried_object();

$current_service_categories = get_terms( array( 
	'taxonomy' => 'service_categories',
	// 'hide_empty' => false, // Remove Comment to Display all categories
	'parent' => $service_category_object->term_id
) );

/* if (empty($current_service_categories)) {
	$current_service_categories[] = $service_category_object;
	// echo 'hello';
} */

$current_service_categories[] = $service_category_object;

// $__current_service_categories = array_merge(array_splice($current_service_categories, -1), $current_service_categories); // Moving last element to first

$__current_service_categories = $current_service_categories;

?>

<div class="col-lg-3 col-md-3 col-sm-3 col-md-pull-9">

	<!-- <h3 class="sidebar-heading-catd" style="margin-bottom: 30px;font-weight: bold;letter-spacing: 1px;text-transform: uppercase;"><?php // echo $service_category_object->name; ?></h3> -->
	
	<div class="experties1" id="toggle-widget">		
	<?php foreach ( $__current_service_categories as $key => $current_service_category ): ?>
	
			<?php 
				
				$service_groupn_data = array();
			?>

			<div>
				
				<h2 class="active"><?php echo $current_service_category->name; ?></h2>
				<div class="content">

				<?php 

						$checkIFhasChildCAT = get_terms( array( 
							'taxonomy' => 'service_categories',
							// 'hide_empty' => false, // Remove Comment to Display all categories
							'parent' => $current_service_category->term_id
						) ); // Showing sub-sub-categories of sub-categories here.

						if (!empty($checkIFhasChildCAT)) : 
							
							foreach ($checkIFhasChildCAT as $key => $childCAT) : ?>

								<div class="subcategory">
										<div class="name">
											<a href="<?php echo get_term_link( $childCAT->term_id ); ?>"><?php echo $childCAT->name; ?></a>
										</div>

								</div>						

							<?php endforeach;
						
						endif;

				?>
				
				<?php 
						
						$args = array(
							        'posts_per_page' => -1,
							        'post_type' => 'services',
							        'tax_query' => array(
							            array (
							                'taxonomy' => 'service_categories',
							                'field' => 'term_id',
							                'terms' => $current_service_category->term_id,
							            ),
							        ),
								        'orderby' => 'meta_value',
								        'meta_key' => 'handyman_type_of_service',
								        'order' => 'DESC'
						);
				
						$the_query = new WP_Query( $args );
					
				?>

				<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>		
					
					<?php 

					// var_dump(get_the_terms($post->ID, 'service_group'));
						
					$service_groupn = get_the_terms($post->ID, 'service_group');
					// var_dump($service_groupn);

					if ($service_groupn) { // Checking if Service Group is selected. Note: Service won't show if service group is not selected.

						$service_groupn_data[$service_groupn[0]->term_id]['termID'] = $service_groupn[0]->term_id;
														
						$service_groupn_data[$service_groupn[0]->term_id]['name'] = $service_groupn[0]->name;
						
						if (!isset($service_groupn_data[$service_groupn[0]->term_id]['type'])) {
							$service_groupn_data[$service_groupn[0]->term_id]['type'] = '';
						}
						
						$service_groupn_data[$service_groupn[0]->term_id]['type'] .= ucfirst(get_field('handyman_type_of_service', $post->ID)) . '/ ';

						$service_groupn_data[$service_groupn[0]->term_id]['post_id'][] = $post->ID;

					}

					?>
			
					<?php endwhile; ?>

					<?php 



					// REF - https://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
					
					$sortByName = array_column($service_groupn_data, 'name');
					array_multisort($sortByName, SORT_ASC, $service_groupn_data);

					// echo '<pre>'; var_dump($service_groupn_data); ?>

					<?php foreach ( $service_groupn_data as $key => $sgd ): ?>

						<?php // echo '<pre>'; var_dump($sgd['post_id'][0]); ?>
			
						<div class="subcategory">

							<?php if (explode('/', $sgd['type'])[1] !== ' '): ?>

								<div class="name">
									<a href="<?php echo get_term_link( $sgd['termID'], 'service_group'); ?>"><?php echo $sgd['name']; ?></a>
								</div>
								<div class="type">
									<?php echo rtrim($sgd['type'], '/ '); ?>
								</div>

							<?php else: ?>

								<div class="name">
									<a href="<?php echo get_permalink( $sgd['post_id'][0] ); ?>"><?php echo $sgd['name']; ?></a>
								</div>
								<div class="type">
									<?php echo rtrim($sgd['type'], '/ '); ?>
								</div>
								
							<?php endif; ?>

						</div>
					
					<?php endforeach; ?>

				<?php else: ?>

					<p style="border: 1px solid #ddd; padding: 10px; font-size: 0.7rem; text-align: center;">No Services Found.</p>

				<?php endif; wp_reset_postdata(); ?>

			</div>
		</div>	
		<?php endforeach; ?>
	</div>

	<div class="mobile-sidebar">
		<?php get_template_part( 'template-parts/content', 'customize-button' ); ?>
	</div>


</div>