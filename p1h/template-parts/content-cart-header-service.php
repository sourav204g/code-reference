<?php if (isset($_SESSION['hnd_post_values'])): ?>

			<strong>Services:</strong>
			
			<?php foreach ( $_SESSION['hnd_post_values'] as $key => $hnd_post_value ): ?>

				<?php // echo '<pre>'; var_dump($hnd_post_value); ?>

				<li>
					<div class="job-listingtop">
						<div class="job-title-sec">
							
							<div class="c-logo">

								<?php if(!empty($hnd_post_value['handymn_insert_image'])) { ?>
									
									<img alt="<?php the_title(); ?>" src="<?php echo $hnd_post_value['handymn_show_image'][0]; ?>" style="border: 1px solid #ddd;width: 100%;">

								<?php } elseif (get_the_post_thumbnail_url($hnd_post_value['handymn_service_id'])) { ?>

									<img alt="" src="<?php echo get_the_post_thumbnail_url($hnd_post_value['handymn_service_id']); ?>">

								<?php } else { ?>

									<img alt="" src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png" style="border: 1px solid #eaeaea;">

								<?php } ?>

							</div>
							<div>
								<h3><a href="<?php echo get_permalink( $hnd_post_value['handymn_service_id'] ); ?>" title=""><?php echo $hnd_post_value['handymn_service_name']; ?></a></h3>
								<span>
									<?php 

										if ($hnd_post_value['handymn_service_id'] !== 'custom') {
											echo ucfirst(get_field('handyman_type_of_service', $hnd_post_value['handymn_service_id'])); 
										} else {
											echo 'Custom request';
										}
									
										

									?>

								: $<?php /* var_dump($_SESSION['cart_item_total']); */ echo $_SESSION['cart_item_total'][$key]; ?></span>
							</div>

						</div>
					</div><!-- Job -->
				</li>
				
			<?php endforeach; ?>

<?php endif; ?>