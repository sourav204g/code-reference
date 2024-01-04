<?php 

    if (get_field('handyman_est_time', $services_ID[$key3]) == 0 && get_field('handyman_add_on_services', $services_ID[$key3])): ?>


    <?php 

      $LabourMinz = array();
      $LabourSubMinz = array();

      foreach (get_field('handyman_add_on_services', $services_ID[$key3]) as $key => $handyman_add_on_services ) {

        foreach ($handyman_add_on_services['handyman_addon_options'] as $key => $handyman_addon_options) {

          if ( (int) $handyman_addon_options['labour_minutes'] !== 0 ) {
              $LabourMinz[] = (int) $handyman_addon_options['labour_minutes'];
          }

          if ($handyman_addon_options['handyman_addon_sub_option_check']) {
                foreach ($handyman_addon_options['handyman_sub_option_groups'] as $key => $handyman_sub_option_groups) {
                  
                    if ($handyman_sub_option_groups['acf_fc_layout'] === 'handyman_sub_option_quantity') {
                      
                          $LabourSubMinz[] = (int) $handyman_sub_option_groups['handyman_so_quantity_labour_minutes'];
                    }

                    if ($handyman_sub_option_groups['acf_fc_layout'] === 'handyman_sub_option_yesno') {

                      $LabourSubMinz[] = (int) $handyman_sub_option_groups['handyman_so_yesno_labour_minutes'];
                     
                    }

                    if ($handyman_sub_option_groups['acf_fc_layout'] === 'handyman_sub_option_list') {

                          foreach ($handyman_sub_option_groups['handyman_so_list_options'] as $key => $handyman_so_list_options) {

                            $LabourSubMinz[] = (int) $handyman_so_list_options['handyman_so_list_options_labour_minutes'];

                          }
                     
                    }
                   

                }
          }

         
        
        }

      }


      if (empty($LabourMinz)) {
          $LabourMinz = array_filter($LabourSubMinz);
      } else {
        $LabourMinz = array_merge($LabourMinz,$LabourSubMinz); // 9-Jan-2019
      }

      $LabourMinz = array_filter($LabourMinz);

      sort($LabourMinz);

    ?>


    <?php $optFirstLabourMin = $LabourMinz[0]; ?>

    <?php $servicePrice = $per_min_cost * (int) $optFirstLabourMin; ?>

    <?php 

      // var_dump($servicePrice);
      // var_dump(round($per_min_cost,2));
      // exit();

      if (get_field('handyman_product_premium', $services_ID[$key3])) {
        
        $handyman_premium = ($servicePrice * get_field('handyman_product_premium', $services_ID[$key3]))/100;

      } else {
        
        $handyman_premium = 0;
      }

      $servicePrice = $servicePrice + $handyman_premium;

      // IF Discount is set
      if (get_field('handyman_product_discount', $services_ID[$key3]) > 0) : ?>

        <del><?php 
          
          $discount = get_field('handyman_product_discount', $services_ID[$key3]);
          $afterDiscount = ( $servicePrice * $discount ) / 100;


         echo '$' . round($servicePrice, 2); ?></del> <span><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?></span> <span>and Up</span></a></h4>

      <?php else: ?>

        <?php $afterDiscount = 0; ?>
        <span class="no-discount"><?php echo '$' . round($servicePrice - $afterDiscount, 2); ?> and Up</span>
        <span style="text-transform: lowercase;"></span></a></h4>
        
      <?php endif; ?>

      <p></p>

<?php else: ?>

  <span>Get a Quote</span></a></h4>

<?php endif; wp_reset_postdata(); ?>