<?php 

    if (get_field('handyman_est_time', $post->ID) == 0 && get_field('handyman_add_on_services', $post->ID)): ?>:

    <?php 

      $LabourMinz = array();

      foreach (get_field('handyman_add_on_services', $post->ID)[0]['handyman_addon_options'] as $key => $handyman_add_on_services ) {

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

        echo '<del>$' . round($servicePrice, 2); ?></del> <span><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span> <span>and Up</span></h4>

     <?php } else {
        
        $afterDiscount = 0; ?>

       <span><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span> <span>and Up</span></h4>


    <?php  } ?>

      
    
<?php endif; ?>