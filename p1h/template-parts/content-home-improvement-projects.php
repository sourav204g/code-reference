<section class="">
  <div class="container service-pro2 home-improvement-projects" style="margin-top: 40px;">

    <div class="row">
      <div class="col-md-12 service-pro2 ">
        <h2>Home Improvement Projects</h2>
      </div>
    </div>

    <div class="row service-pro3">

      

      <?php 

            $EssentialHomeServices = array();
            $EssentialHomeServices = get_terms( array( 

                  'taxonomy' => 'service_categories',
                  'hide_empty' => false,
                  'parent' => 1195 // Home Improvement Projects

            ) ); 

            $order = array('', 487, 430, 431, 429);


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