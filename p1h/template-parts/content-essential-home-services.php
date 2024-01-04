<style>
  span.ess-sub {
      color: black;
      font-size: 20px;
      position: relative;
      top: -2px;
      left: 5px;
  }
</style>

<section class="">
  <div class="container service-pro2 essential-home-services" style="margin-top: 40px;">

    <div class="row">
            <div class="col-md-12 service-pro2">
              <h2>Essential Home Services <span class="ess-sub">Let the pros tacle your to-do list done right the first time!</span></h2>

            </div>
    </div>  

    <div class="row service-pro3">

      <?php 

            $EssentialHomeServices = array();
            $EssentialHomeServices = get_terms( array( 

                  'taxonomy' => 'service_categories',
                  'hide_empty' => false,
                  'parent' => 1180 // Essential Home Services

            ) ); 

            $order = array(422, 421, 423, 424, 428, 426, 427);

            // var_dump(array_search(423, $order));

            // echo "<pre>";
            // var_dump($EssentialHomeServices);
            // exit;

      ?>

            <?php foreach ( $EssentialHomeServices as $key => $EssentialHomeService ): ?>

                <div class="col-lg-3 col-md-4" style="order: <?php echo array_search($EssentialHomeService->term_id, $order); ?>">
                  <div class="handyman-servbox">
                    <h3><?php echo $EssentialHomeService->name; ?></h3>
                    <!-- <img src="https://handymanproservices.com/demo/wp-content/uploads/2019/06/Circuit-Breakers.jpg" class="img-fluid"> -->
                    
                    <ul>


                      <?php 

                      $children = get_terms( array( 

                                    'taxonomy' => 'service_categories',
                                    'hide_empty' => false,
                                    'parent' => $EssentialHomeService->term_id

                              ) );

                      foreach ($children as $key => $child): ?>

                        <li>

                          <?php 

                              $subchildren = get_terms( array( 

                                    'taxonomy' => 'service_categories',
                                    'hide_empty' => false,
                                    'parent' => $child->term_id

                              ) );

                          if (!empty($subchildren)) : ?>

                                <a href="<?php echo get_category_link( $child->term_id ); ?>">
                                <strong><?php echo $child->name; ?></strong></a>

                                <ul class="sub-cat-srv-list">

                                    <?php

                                    foreach ($subchildren as $key => $subchild): ?>
                                                                
                                    <li><a href="<?php echo get_category_link( $subchild->term_id ); ?>"><?php echo $subchild->name; ?></a></li>

                                    <?php endforeach; ?>

                                </ul>

                          <?php else: ?>

                            <a href="<?php echo get_category_link( $child->term_id ); ?>"><?php echo $child->name; ?></a>

                          <?php endif; ?>

                        </li>
                        
                      <?php endforeach; ?>

                      
                    </ul>
                  <a class="sev-but" href="<?php echo get_category_link( $EssentialHomeService->term_id ); ?>">View All <i class="fa fa-long-arrow-right" ></i></a>
                  </div>
                </div>

            <?php endforeach; ?>

      

    </div>
  </div>
</section>	