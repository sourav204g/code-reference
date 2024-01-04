<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package handyman_pro
 */

// var_dump(get_the_ID());
// var_dump( get_field('handyman_prod_services_images', get_the_ID())[0]['handyman_image']['url'] );

$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;

?>


		<div class="col-md-4">

			<div class="emply-list" style="border: 1px solid #ddd; padding: 30px; box-shadow: 2px 2px 4px 0px #0000002b;margin-bottom: 30px;">
				<div class="dvimag">
					<a href="<?php echo get_permalink(); ?>" title="">
						<?php if (get_field('handyman_prod_services_images')): ?>
								<img alt="" src="<?php echo get_field('handyman_prod_services_images', get_the_ID())[0]['handyman_image']['url']; ?>" style="width: 100%;">
						<?php else: ?>
								<img alt="" src="<?php echo bloginfo('stylesheet_directory') ?>/assets/images/default-png.png" style="width: 100%;">
						<?php endif; ?>
						
					</a>
					<?php if (get_field('handyman_product_discount')): ?>
						<div class="off50">
							<?php echo get_field('handyman_product_discount') . '% Off'; ?>
						</div>
					<?php endif; ?>
					
				</div>
				<div class="emply-list-info">
					<h3 style="margin-bottom: 0px;"><a href="<?php echo get_permalink(); ?>" title=""><?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?></a></h3>
					<p><?php echo get_field('handyman_type_of_service'); ?></p>
					<h4>
											<?php echo get_field('handyman_type_of_service', $post->ID); ?>: <del><?php 

													$servicePrice = $per_min_cost * get_field('handyman_est_time', $post->ID);

													// var_dump($servicePrice);
													// var_dump(round($per_min_cost,2));
													// exit();

													if (get_field('handyman_product_premium', $post->ID)) {
														
														$handyman_premium = ($servicePrice * get_field('handyman_product_premium', $post->ID))/100;

													} else {
														
														$handyman_premium = 0;
													}

													$servicePrice = $servicePrice + $handyman_premium;

													// IF Discount is set
													if(get_field('handyman_product_discount', $post->ID)) {

														$discount = get_field('handyman_product_discount', $post->ID);

														$afterDiscount = ( $servicePrice * $discount ) / 100;

													} else {

														$afterDiscount = 0;
													}

													echo '$' . round($servicePrice, 2); ?></del> <?php echo '$' . round($servicePrice - $afterDiscount, 2); ?> </h4>
				</div>
			</div>
			
		</div>
