<?php 

    if (isset($servicePosta)) { // for search.php
      $servicePost = $servicePosta;
    }   

    if (get_field('handyman_est_time', $servicePost->ID) == 0 && get_field('handyman_add_on_services', $servicePost->ID)): ?>


    <?php 

      $LabourMinz = array();

      foreach (get_field('handyman_add_on_services', $servicePost->ID)[0]['handyman_addon_options'] as $key => $handyman_add_on_services ) {

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

      if (get_field('handyman_product_premium', $servicePost->ID)) {
        
        $handyman_premium = ($servicePrice * get_field('handyman_product_premium', $servicePost->ID))/100;

      } else {
        
        $handyman_premium = 0;
      }

      $servicePrice = $servicePrice + $handyman_premium;

      // IF Discount is set
      if (get_field('handyman_product_discount', $servicePost->ID) > 0) : ?>

        <del><?php 
          
          $discount = get_field('handyman_product_discount', $servicePost->ID);
          $afterDiscount = ( $servicePrice * $discount ) / 100;


         echo '$' . round($servicePrice); ?></del> <span><?php echo '$' . round($servicePrice - $afterDiscount); ?></span> <span>and Up</span></h4>

      <?php else: ?>

        <?php $afterDiscount = 0; ?>
        <span class="no-discount"><?php echo '$' . round($servicePrice - $afterDiscount); ?> and Up</span>
        <span style="text-transform: lowercase;"></span></h4>
        
      <?php endif; ?>

      <p></p>

<?php else: ?>

  <a href="<?php echo get_permalink($servicePost->ID); ?>" style="color: #2e45c3;font-weight: bold;">Get a Quote</a>
  <p></p>
    
<?php endif; wp_reset_postdata(); $servicePosta = null; // Resting ?>