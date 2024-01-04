<?php 

    if ( get_field('handyman_est_time', $post->ID) != 0 ): ?>:

    <?php 

      if (get_field('handyman_product_premium', $post->ID)) {
        
        $handyman_premium = ($servicePrice * get_field('handyman_product_premium', $post->ID))/100;

      } else {
        
        $handyman_premium = 0;
      }

      $servicePrice = $servicePrice + $handyman_premium;


    ?>

    <?php if (get_field('handyman_product_discount', $post->ID) > 0): ?>

      <del><?php 

        $discount = get_field('handyman_product_discount', $post->ID);
        $afterDiscount = ( $servicePrice * $discount ) / 100;

        echo '$' . round($servicePrice, 2); ?></del> <span><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span></h4>

    <?php else: ?>

      <?php $afterDiscount = 0; ?>
      <span><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span></h4>
      
    <?php endif; ?>
  

<?php endif; ?>