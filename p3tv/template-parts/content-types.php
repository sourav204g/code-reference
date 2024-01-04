 <!--Explore Categories Start-->
<section class="explore_categories">
    <div class="container">
        <div class="block-title text-center">
            <h4>Explore Our categories</h4>
            <h2><?php echo get_field('traveltographer_photo_shooting_occasions_title'); ?></h2>
            <p><?php echo get_field('traveltographer_photo_shooting_occasions_sub_title'); ?></p>
        </div>
    </div>
    <div class="container-full-width">
        <div class="row">

            <?php 

            $photography_types = get_terms( array( 
                  'taxonomy' => 'photography_types',
                  'hide_empty' => false,
            ) );

            ?>

            <?php foreach ($photography_types as $key => $type): ?>

               <div class="col-xl-2 col-lg-4 col-md-6 col-6">
                   <!--Explore Categories Single-->
                   <div class="explore_categories_single wow fadeInUp" data-wow-delay="0ms"
                       data-wow-duration="1200ms">
                       <div class="explore_categories_image">
                           <img src="<?php echo get_field('traveltographer_destination_image', 'photography_types_' . $type->term_id)['url']; ?>" alt="image">
                       </div>
                       <div class="explore_categories_content">
                           <h3><?php echo $type->name; ?></h3>
                           <a href="<?php echo get_term_link($type->term_id); ?>" class="explore_categories_arrow">
                               <span class="icon-right-arrow"></span>
                           </a>
                       </div>
                   </div>
               </div>
                        
            <?php endforeach; ?>


            
            
        </div>
        <div class="grow_business_btn22">
           <a href="<?php echo home_url( '/categories/' ); ?>" class="thm-btn">View All Categories</a>
         </div>
    </div>
</section>