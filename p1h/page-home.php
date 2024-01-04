<?php

/**
 * Template Name: Home Page #2
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package handyman_pro
 */

$homePageID = get_the_ID();
$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;


// GENERAL WORK BY HOUR
$generalWork_premium  = get_field('handyman_product_premium', 2159);
$generalWork_discount = get_field('handyman_product_discount', 2159);

$generalWork_option  = get_field('handyman_add_on_services', 2159)[0]['handyman_addon_options'][0]['labour_minutes'];


$general_cost          = $per_min_cost * $generalWork_option;
$general_premium_cost  = $general_cost + ( $general_cost * $generalWork_premium / 100 );
$general_discount_cost = $general_premium_cost - ( $general_premium_cost * $generalWork_discount / 100 );

$general_cost = round($general_premium_cost - $general_discount_cost, 2);


get_header(); ?>

<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/css/home.css">

<style>

    .hnd-click-here {
        color: blue;
        background: none !important;
        padding: 0px !important;
    }

    .handy-pro-but03:hover .hnd-click-here {
      color: pink;
    }

    .servicce-hvr-type{
        margin: 0.5rem 0 0 0;
    }
    .exp-inner-brd-heading{
        margin-bottom: -3px!important;
    }
   p.prd-tax-txt {
    margin-bottom: 10px;
    color: #ad6635;
    font-size: 13px;
}

/*6-4-21*/
div#howworks{
    padding-right:0px!important;
}

a.howworks {
    color: #232323!important;
    font-size: 17px;
    padding-left: 20px;
    font-family: 'Lato', sans-serif;
    font-weight: 500;
    letter-spacing: 0;
}

a.howworks:hover {
    color: #f2ae00!important;
}

.home-banner-section .fix-wrap { overflow: hidden; }

i.fa.fa-question-circle.customq {
    position: relative;
    top: 4px;
    left: 0px;
}

@media screen and (max-width: 576px) {
    a.howworks {
    display: block;
    padding-left: 0;
    margin-top: 5px;
    }
}

/*26-3-22*/

section.estimate-divider-wrapper {
    padding: 45px 0;
    background: #f2ae00;
}
section.estimate-divider-wrapper .row {
    align-items: center;
}
section.estimate-divider-wrapper h2 {
    font-family: 'Lato', sans-serif;
    font-weight: 600;
    color: white;
    font-size: 40px;
    letter-spacing: 0.5px;
}

section.estimate-divider-wrapper a {
    background: #086ca0;
    color: white;
    padding: 16px 22px;
    font-size: 21px;
    font-weight: 400;
    font-family: 'Lato', sans-serif;
    border-radius: 6px;
    border: solid 1px white;
    transition: 0.3s ease;
    width: 100%;
    display: block;
    text-align: center;
}

section.estimate-divider-wrapper a:hover {
    box-shadow: 0px 6px 12px 0px rgb(14 19 22 / 19%);
}

@media screen and (min-width: 768px) {
  section.estimate-divider-wrapper h2 { margin-bottom: 0px; }
}

/*14-10-22*/

.toggle-panel {
    border: solid 2px rgb(213 154 4 / 48%);
    padding: 1.1rem;
    max-height: 320px;
    height: 100vh;
    position: relative;
    overflow: hidden;
    background: #ecf0f9;
    margin-bottom: 30px;
}
.toggle-head-row {
    display: flex;
    align-items: center;
}
.toggle-panel h4 {
    font-weight: 600;
    font-size: 20px;
    border: solid 1px #ddd;
    border-radius: 6px;
    padding: 14px 10px;
    margin: 0;
    background: white;
}
.toggle-panel h4 span {
    font-weight: 400;
    font-size: 18px;
    margin-left: 8px;
}
.toggle-panel .handyman-price-btn-wrapper {
    padding: 0;
    border: none;
}
.toggle-panel .handyman-price-btn-wrapper a {
    margin: 0;
    font-size: 19px;
    background: #fff;
    border: solid 1px #ddd;
    color: #555;
    letter-spacing: 0.6px;
    padding-left: 35px;
    padding-right: 35px;
}
.handyman-price-btn-wrapper a:hover {
    box-shadow: none;
}
.toggle-panel button.toggle-close {
    position: absolute;
    right: 25px;
    border: solid 1px #ddd;
    border-radius: 6px;
    padding: 16px 15px;
    background: white;
    color: #555555;
    font-size: 16px!important;
}

.list-row {
    max-height: 200px;
    height: 100vh;
    overflow: auto;
    margin-top: 1.5rem;
}
.row.list-row span {
    color: #323232;
    margin-bottom: 6px;
    display: inline-block;
    font-size: 19px;
    letter-spacing: -0.5px;
}
.reveal-prd-wrapper a del {
    color: #064db9;
}
.reveal-prd-wrapper a span {
    color: red!important;
    font-size: 16px!important;
}

.loading .col-lg-3 > div {
    margin-top: 10px;
}
.mob-sec {
    display: none;
}

@media screen and (max-width: 560px) {
.toggle-panel {
    padding: 1rem 1rem;
    max-height: 500px;
}
.desk-sec {
    display: none;
}
.mob-sec {
    display: block;
}
.toggle-panel button.toggle-close {
    right: 14px;
    padding: 11px 10px;
    top: 16px;
}
.list-row {
    max-height: 260px;
    margin-top: 0;
    margin-bottom: 1.7rem;
}
.toggle-panel .handyman-price-btn-wrapper a {
    font-size: 18px;
    background: #086ca0;
    color: white;
    padding-left: 20px;
    padding-right: 20px;
}
.toggle-panel h4 {
    font-size: 18px;
    padding: 10px 10px;
    color: #f2ae00;
}
.toggle-panel h4 span {
    display: none;
}

}


.handypro-box.current {
    border-bottom: solid 4px #f2ae00;
}
.handypro-box.current:after {
    content: "";
    position: absolute;
    bottom: -31px;
    z-index: 9;
    right: 19px;
    border-top: 5px solid rgb(213 154 4 / 78%);
    border-left: 18px solid rgb(213 154 4 / 78%);
    border-right: 19px solid rgb(213 154 4 / 78%);
    border-bottom: 24px solid #ecf0f9;
    width: 6px;
    clip-path: polygon(49% 3%, -4% 99%, 103% 93%);
}
.handypro-box.current .exp-tech-hover {
    opacity: 1!important;
    background: white;
}
.handypro-box.current .exp-inner-main ul li a {
    color: #323232;
}

/*9-11-22*/

.exp-tech-hover:hover .exp-inner-main {
    background: rgb(255 255 255);
}
.exp-tech-hover:hover .exp-inner-main ul li a {
    color: #323232;
}
.exp-inner-main ul li {
    margin: 4px 0 10px 0px;
}
.exp-inner-main ul li a span {
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: -0.1px;
    line-height: 15px;
}
.exp-tech-hover a.learn-more {
    padding: 0;
    font-size: 14px;
    border: none;
    font-weight: 600;
    color: #555555;
}

.exp-inner-main { background: none; }

</style>

<?php get_template_part( 'template-parts/content', 'slider' ); ?>

<!-- <section class="home-exp-sec" id="expertise">
      <div class="fix-wrap shell">
        <div class="xtitle-btn">
                  <div class="row heading-pro">
                    
                    <div class="col-md-10 hand-auto">

                          <div class="handy-pro-but02">
                             <a class="btn" href="https://handymanclick.com/all-services/"><span><img class="hdy-img" src="https://handymanclick.com/wp-content/themes/handyman_pro/assets/images/budget-btn011.png" /></span> <span>Browser All Services</span></a>
                            </div>
                      
                          <div class="handy-pro-but01">
                             <a class="btn" href="https://handymanclick.com/services/general-handyman-work/"><span><img class="hdy-img" src="https://handymanclick.com/wp-content/themes/handyman_pro/assets/images/calendar-btn-03.png" /></span><span>Book a Handyman From <?php // echo '$' . $general_cost . ' USD' ; ?></span></a>
                            </div>                         
                        
                          <div class="handy-pro-but03">
                             <a class="btn" href="https://handymanclick.com/get-a-free-estimate/"><span><img class="hdy-img" src="https://handymanclick.com/wp-content/themes/handyman_pro/assets/images/hammer-btn02.png" /></span><span>Get A Free Estimate</span></a>
                            </div>
                    </div>
                    
            </div>
        </div>
      </div>
</section> -->

<section class="home-exp-sec whbg2 services">
    <div class="fix-wrap shell">
      <div class="xtitle-btn">
        
        <div class="row heading-pro2">
          <div class="col-md-9 col-8">
            <h2 id="shop-more">Popular Home Services <span>Instantly schedule from over 600 pre- priced services</span> <span class="see-but"><a style="float: none;" href="<?php echo home_url( '/all-services/' ); ?>">SEE ALL &gt;&gt;</a></span></h2><!-- <p>Instantly schedule services with our real time live online Ischwdular.</p> -->
          </div>
          <div class="col-md-3 col-4">
            <div class="rqq" style="text-align: right;"><a class="btn btn-danger" href="<?php echo home_url( '/get-a-free-estimate/' ); ?>">Can't Find it? Set Price Book Now</a></div>
          </div>
        </div>

        <div class="row">

          <?php get_template_part( 'template-parts/content', 'home-services-t2' ); ?>

        </div>

        <!-- <div class="row">
            <div class="col-lg-12">
              <div class="toggle-panel">
                <div class="row toggle-head-row">
                  <div class="col-md-4">
                    <h4>Electrical <span>29 Services Available</span></h4>
                  </div>
                  <div class="col-md-8">
                    <div class="handyman-price-btn-wrapper">
                      <a href="https://handymanproservices.com/services/general-handyman-work/">$79 for 2 Hours Handyman General Electrical Work Special</a>
                    </div>
                  </div><button class="toggle-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="row list-row">
                  <div class="col-lg-3">
                   <a href="https://www.handymanclick.com/service-group/ceiling-fan-electrical/"><span>Ceiling fan</span><br>
                        Replacement: <del>$247.53</del> $123.77<br>
                        New install: <del>$513.5</del> $256.75<br></a>
                  </div>
                  <div class="col-lg-3">
                    <ul>
                      <li>
                        <a href="https://www.handymanclick.com/service-group/ceiling-fan-electrical/"><span>Ceiling fan</span><br>
                        Replacement: <del>$247.53</del> $123.77<br>
                        New install: <del>$513.5</del> $256.75<br></a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3">
                    <ul>
                      <li>
                        <a href="https://www.handymanclick.com/service-group/ceiling-fan-electrical/"><span>Ceiling fan</span><br>
                        Replacement: <del>$247.53</del> $123.77<br>
                        New install: <del>$513.5</del> $256.75<br></a>
                      </li>
                      <li>
                        <a href="https://www.handymanclick.com/service-group/recessed-lighting/"><span>Recessed lighting</span><br>
                        Replacement: <del>$59.25</del> $56.29<br>
                        New install: <del>$158</del> $150.1<br></a>
                      </li>
                      <li>
                        <a href="https://www.handymanclick.com/service-group/outdoor-wall-lights/"><span>Outdoor wall lights</span><br>
                        Replacement: <del>$39.5</del> $39.5<br>
                        New install: : <span><em>Get a Quote</em></span><br></a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3">
                    <ul>
                      <li>
                        <a href="https://www.handymanclick.com/service-group/ceiling-fan-electrical/"><span>Ceiling fan</span><br>
                        Replacement: <del>$247.53</del> $123.77<br>
                        New install: <del>$513.5</del> $256.75<br></a>
                      </li>
                      <li>
                        <a href="https://www.handymanclick.com/service-group/recessed-lighting/"><span>Recessed lighting</span><br>
                        Replacement: <del>$59.25</del> $56.29<br>
                        New install: <del>$158</del> $150.1<br></a>
                      </li>
                      <li>
                        <a href="https://www.handymanclick.com/service-group/outdoor-wall-lights/"><span>Outdoor wall lights</span><br>
                        Replacement: <del>$39.5</del> $39.5<br>
                        New install: : <span><em>Get a Quote</em></span><br></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        </div> -->

      </div>
    </div>
  </section>






  <secction class="home-exp-sec" id="expertise" style="padding-top: 0px; ">
      <div class="fix-wrap shell">
        <div class="xtitle-btn">
                  <div class="row heading-pro">

                    
<!--                     <div class="col-md-10 hand-auto">                      
                        
                          <div class="handy-pro-but03">
                             <a class="btn" href="https://handymanclick.com/get-a-free-estimate/"><span><img class="hdy-img" src="https://handymanclick.com/wp-content/themes/handyman_pro/assets/images/hammer-btn02.png" /></span>
                              <span style="position: relative;">Rather Give Us Your To-Do List In Your Own Words. 
                                <span class="hnd-click-here">Click Here.</span> 
                                <span><i class="fa fa-question-circle customq"></i></span>
                              </span></a>
                            </div>
                    </div> -->
                    
            </div>
        </div>
      </div>
</section>

  <section>
    <div class="fix-wrap shell">
      <div class="row">
          
        <?php 
        $image = get_field('pro_service_image');
        if( !empty( $image ) ): ?>
        
            <div class="col-xl-12">
                <a href="<?php the_field('pro_service_url'); ?>">
                <div class="handyman-ad-banner-sec" style="background-image:url('<?php echo esc_url($image['url']); ?>');">
                    <div class="inner-header"><h3><?php the_field('pro_service_title'); ?></h3></div>
                </div></a>
                <div class="handyman-price-btn-wrapper">
                    <a href="<?php the_field('pro_service_url'); ?>"><?php the_field('pro_service_content'); ?></a>
                </div> 
            </div>
           
        <?php endif; ?>

      </div>
    </div>
  </section>

  <!-- Services Section 2 -->
  <section class="home-exp-sec gray services">
    <div class="fix-wrap shell">
      <div class="xtitle-btn">
                <div class="row heading-pro2">
                  <div class="col-md-10 col-8">
            <h2>Home Improvement Projects <span>Improve your home value with our affordable remodeling projects.</span></h2>
            <!-- <p></p> -->
          </div>

          <div class="col-md-2 see-but col-4">
            <a href="<?php echo home_url( '/all-services/' ); ?>">SEE ALL >></a>
          </div>
          </div>

          <div class="row">

            <?php get_template_part( 'template-parts/content', 'home-improvement-t2' ); ?>

          </div>

      </div>
    </div>
  </section>


  <section class="estimate-divider-wrapper" style="background: transparent;">
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <a href="https://www.handymanproservices.com/get-a-free-estimate/" style="background: #de3549;">Can't Find it? Set Price Book Now >></a>
      </div>
    </div>
  </div>
</section>

  <!-- <section class="estimate-divider-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <h2>Free Project Consultations & Estimates!</h2>
      </div>
      <div class="col-md-3">
        <a href="https://handymanclick.com/get-a-free-estimate/">Get a Free Estimate</a>
      </div>
    </div>
  </div>
</section> -->


  <!-- Product Section 3 -->
  <section class="home-exp-sec whbg2">
      
      <div class="fix-wrap shell">
        <div class="xtitle-btn">
          
          <div class="row heading-pro2">
            <div class="col-md-10 col-8">
              <h2>Remodeling Products <span style="font-size: 15px">All products include taxes, delivery to your home and professional installation.</span><a class="howworks" data-target="#howworks" data-toggle="modal" href="#"> How it works </a></h2><!-- <p>End shopping and installer searching frustration and wasted time, hereyou can purchase apre-priced essential remodeling product including expert installation that the technician delivers and installs at the date and time you specify on his/hers online live scheduler.</p> -->
            </div>
            <div class="col-md-2 see-but col-4">
              <a href="<?php echo home_url( '/products/' ); ?>">SEE ALL &gt;&gt;</a>
            </div>
          </div>

          <div class="row" id="team-carousel">


            <?php // Product

              // check if the repeater field has rows of data
              if( have_rows('featured_product_listingsx') ):

                // loop through the rows of data
                  while ( have_rows('featured_product_listingsx') ) : the_row(); ?>

                  <div class="col-12 col-md-3">
                  <div class="handypro-box2">
                  <h3><?php echo get_sub_field('featured_listing_heading_product'); ?></h3>


                    <article class="wow" style="background: url(<?php echo get_sub_field('featured_listing_image_product')['url']; ?>);">

                    <div class="exp-tech-hover">
                      <img alt="Discovery Background Image" src="images/ser-img01.jpg" title="Discovery Background Image">
                      <div class="for-mob"></div>
                      <div class="exp-inner-main remodeling">
                        <div class="exp-inner-brd">
                          <h4 class="exp-inner-brd-heading"><?php echo get_sub_field('featured_listing_heading_product'); ?></h4>
                            <p class="prd-tax-txt">Price Include Product Taxes & Installtion</p>
                          <?php if (get_sub_field('featured_listing_discount_product')): ?>
                            <h5>Today's Discount <?php echo get_sub_field('featured_listing_discount_product'); ?>% OFF</h5>
                          <?php else: ?>
                          <?php endif; ?>

                          <ul>

                            <?php

                                // check if the repeater field has rows of data
                                if( have_rows('featured_listing_products') ):

                                  // loop through the rows of data
                                    while ( have_rows('featured_listing_products') ) : the_row(); ?>

                                
                                  <?php $pdid = get_sub_field('featured_listing_product'); 


                                  if(get_the_terms( $pdid, 'product_group' )) { // IN NOT NULL

                                      $product_groupID = get_the_terms( $pdid, 'product_group' )[0]->term_id;

                                      $args1 = array(

                                                'posts_per_page' => -1,
                                                'post_type' => 'products',
                                                'post__not_in' => array(),
                                                'tax_query' => array(

                                                    array (
               
                                                        'taxonomy' => 'product_group',
                                                        'field' => 'term_id',
                                                        'terms' => $product_groupID,
                                                    ),

                                                )
                                      );
                                  
                                      $the_query1 = new WP_Query( $args1 );

                                     // echo "<pre>";
                                     // var_dump($the_query1->get_posts());

                                  }


                                  ?>

                                  <li>
                                    <span style="text-transform: uppercase;font-size: 13.2px;"><?php echo substr(get_the_title($pdid),0,45)." ..."; ?></span>
                                    <div class="service-type servicce-hvr-type" style="margin:0;">

                                      <?php if ($the_query1->post_count > 1) : 


                                       $typeofservices = '';

                                       foreach ($the_query1->get_posts() as $key => $prod) {

                                       
                                          // check if the repeater field has rows of data
                                          if( have_rows('handyman_product_link_to_services', $prod->ID) ):

                                            // loop through the rows of data
                                              while ( have_rows('handyman_product_link_to_services', $prod->ID) ) : the_row(); 

                                              $getServiceID = get_sub_field('handyman_product_link_to_service'); ?>

                                              <a href="<?php echo get_permalink($prod->ID) . '?service-id=' . $getServiceID; ?>"><span class="" style="text-transform: capitalize;"><?php echo ucfirst(get_field('handyman_type_of_service', $getServiceID)); ?>

                                            <strike><?php 

                                                $servicePrice = $per_min_cost * get_field('handyman_est_time', $getServiceID);

                                                if (get_field('handyman_product_premium', $getServiceID)) {
                                                  
                                                  $handyman_premium = ($servicePrice * get_field('handyman_product_premium', $getServiceID))/100;

                                                } else {
                                                  
                                                  $handyman_premium = 0;
                                                }

                                                $servicePrice = $servicePrice + $handyman_premium;

                                                // IF Discount is set
                                                if(get_field('handyman_product_discount', $getServiceID)) {

                                                  $discount = get_field('handyman_product_discount', $getServiceID);

                                                  $afterDiscount = ( $servicePrice * $discount ) / 100;

                                                } else {

                                                  $afterDiscount = 0;
                                                }

                                                echo '$<span>'; 
                                                echo (float) get_field('handyman_prod_price', $prod->ID) + round($servicePrice, 2); echo '</span>'; ?></strike>
                                                
                                                <span>$<?php echo '<span>'; ?><?php echo (float) get_field('handyman_prod_price', $prod->ID) + round($servicePrice - $afterDiscount, 2); ?><?php echo '</span>'; ?></span> 
                                                 
                                            </span></a><br>

                                          <?php    

                                          endwhile;

                                          endif;


                                       } ?>


                                      <?php else: ?>

                                        <?php

                                          // check if the repeater field has rows of data
                                          if( have_rows('handyman_product_link_to_services', $pdid) ):

                                            // loop through the rows of data
                                              while ( have_rows('handyman_product_link_to_services', $pdid) ) : the_row(); ?>


                                                <?php  $sid = (int) get_sub_field('handyman_product_link_to_service', $pdid); ?>


                                                <a href="<?php echo get_permalink($pdid) . '?service-id=' . $sid; ?>">
                                                      <span><?php echo ucfirst(get_field('handyman_type_of_service', $sid)); ?>: 


                                                        <del><?php 

                                                          $servicePrice = $per_min_cost * get_field('handyman_est_time', $sid);

                                                          if (get_field('handyman_product_premium', $sid)) {
                                                            
                                                            $handyman_premium = ($servicePrice * get_field('handyman_product_premium', $sid))/100;

                                                          } else {
                                                            
                                                            $handyman_premium = 0;
                                                          }

                                                          $servicePrice = $servicePrice + $handyman_premium;

                                                          // IF Discount is set
                                                          if(get_field('handyman_product_discount', $sid)) {

                                                            $discount = get_field('handyman_product_discount', $sid);

                                                            $afterDiscount = ( $servicePrice * $discount ) / 100;

                                                          } else {

                                                            $afterDiscount = 0;
                                                          }

                                                          echo '$<span>'; 
                                                          echo (float) get_field('handyman_prod_price', $pdid) + round($servicePrice, 2); echo '</span>'; ?></del>
                                                          
                                                          <span>$<?php echo '<span>'; ?><?php echo (float) get_field('handyman_prod_price', $pdid) + round($servicePrice - $afterDiscount, 2); ?><?php echo '</span>'; ?></span> 




                                                        </span>
                                                    </a><br>

                                                

                                        <?php
                                                 

                                              endwhile;

                                          endif;

                                        ?>
                                        
                                      <?php endif; ?>

                                      
                                      
                                    </div>
                                  </li>



                              
                              <?php
                                    endwhile;

                                endif;

                            ?><?php 

                              // echo "<pre>";

                              // PENDING - 4 JAN 2021
                              $pcatID = (int) get_sub_field('featured_listing_category_id_product');

                              // var_dump($pcatID);
                              // var_dump(get_the_terms( 419, 'product_categories' ));

                              // var_dump(get_term( 432, 'service_categories' )->count);
                              //exit();



                              // var_dump($dddd);



                            ?>
                            
                          </ul>

                          <?php if (get_term( $pcatID, 'product_categories' )): ?>

                            <a class="learn-more" href="<?php echo get_sub_field('featured_listing_link_product'); ?>">View all (<?php echo get_term( $pcatID, 'product_categories' )->count; ?>) Products</a>

                          <?php else: ?>

                            <a class="learn-more" href="<?php echo get_sub_field('featured_listing_link_product'); ?>">View all Products</a>
                            
                          <?php endif; ?>

                          
                        </div>
                      </div>
                    </div>
                  </article>

                  <div class="clearfix"></div>
                  </div>
                  </div>

            
            <?php
                  endwhile;

              endif;

            ?>
            


            <!-- <div class="col-12 col-md-3">
              <div class="handypro-box2">
                <h3>Garbage Disposals</h3>
                <article class="wow">
                  <img alt="" src="https://handymanclick.com/wp-content/themes/handyman_pro/assets/images/hnd-pro-img01.jpg" style="width: 100%;">
                  <div class="exp-tech-hover">
                    <div class="for-mob" style="display: block;"></div>
                    <div class="exp-inner-main">
                      <div class="exp-inner-brd">
                        <h4>Garbage Disposals</h4>
                        <h5>Today's discount <b>27 - 52% OFF</b><br>
                        Includes product and installation</h5>
                        <ul>
                          <li>
                            <a href="https://handymanclick.com/services/ceramic-tiling-3/"><span>Kitchen aid 1/2 HP garbage disposal with sound insulation</span><br>
                            Replacement <del>$221.67</del> - $117.48<br>
                            New Installation <del>$221.67</del> - $117.48<br></a>
                          </li>
                          <li>
                            <a href="https://handymanclick.com/services/hardwood-flooring/"><span>GE 1/2 HP garbage disposal with sound insulation</span><br>
                            Replacement <del>$221.67</del> - $117.48<br>
                            New Installation <del>$221.67</del> - $117.48<br></a>
                          </li>
                        </ul><a class="learn-more" href="https://handymanclick.com/service-categories/flooring-tiling/">View all (20) Products</a>
                      </div>
                    </div>
                  </div>
                </article>
                <div class="clearfix"></div>
              </div>
            </div> -->

            


          </div>
        </div>
      </div>
    </section>


  <section class="gray" id="scroll-here">

    <div class="block">

      <div class="container">

        <div class="row">

          <div class="col-lg-12">

            <div class="heading">

              <h2>How <a class="hyd-work">Handyman Click</a> Works <!-- <a data-target="#exampleModal" data-toggle="modal" href="#"><img alt="" src="<?php // bloginfo('template_directory'); ?>/assets/images/video-icon.png" style="width:60px; margin-bottom: -15px; margin-left: 12px;"></a> --></h2>

            </div><!-- Heading -->

            <div class="cat-sec mb2589">

              <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-6">

                  <div class="p-category">

                    <a href="#" title=""><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/settings1.png" style="width: 128px;">

                    <h4>Select Services</h4>

                    <p>Select a service(s) from our 650+ pre-priced handyman services list for you home repairs and remodeling.</p></a>

                  </div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">

                  <div class="p-category">

                    <a href="#" title=""><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/settings2.png" style="width: 128px;">

                    <h4>Live Scheduling</h4>

                    <p>Review handyman ratings and schedule your favorite from their live online calendar by selecting a date and time that you want your project done.</p></a>

                  </div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">

                  <div class="p-category">

                    <a href="#" title=""><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/settings3.png" style="width: 128px;">

                    <h4>Remodeling Products</h4>

                    <p>Imagine! Instead of playing phone tag with handymen and fighting crowds at home improvement stores, here you select a remodeling product such as garbage disposal, faucet, ceiling fan, sump pump etc. that the handyman delivers and installs at the time and date you specify</p></a>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>



  <section class="hidden-xs">

    <div class="block no-padding">

      <div class="parallax scrolly-invisible" data-velocity="-.2" style="background: transparent url(<?php bloginfo('template_directory'); ?>/assets/images/resource/parallax7.jpg) repeat scroll 50% -45.0067px;"></div><!-- PARALLAX BACKGROUND IMAGE -->

      <div class="container">

        <div class="row">

          <div class="col-lg-12">

            <div class="download-sec">

              <div class="download-text">

                <h3>Download &amp; Enjoy</h3>

                <p>Search, find and apply for jobs directly on your mobile device or desktop Manage all of the jobs you have applied to from a convenience secure dashboard.</p>

                <ul>

                  <li class="app">

                    <a href="#" title=""><i class="la la-apple"></i> <span>App Store</span>

                    <p>Available now on the</p></a>

                  </li>

                  <li>

                    <a href="#" title=""><i class="la la-android"></i> <span>Google Play</span>

                    <p>Get in on</p></a>

                  </li>

                </ul>

              </div>

              <div class="download-img"><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/resource/mockup3.png"></div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

  

  <section class="pagebg1 hidden-xs">

    <div class="block">

      <!-- PARALLAX BACKGROUND IMAGE -->

      <div class="container">

        <div class="row">

          <div class="col-lg-12">

            <div class="heading light" style="margin-bottom: 30px;">

              <h2 style="color: #323232;">What our customers say</h2><!-- <span style="color: #323232;">Some of the companies we've helped recruit excellent applicants over the years.</span> -->

            </div><!-- Heading -->

            <div class="reviews-sec" id="reviews-carousel">







              <?php // CONTINUE FROM HERE - PENDING



                global $wpdb;



                $prosReviews = array();



                $args = array( 'posts_per_page' => -1, 'post_type' => 'pros', 'post_status' => 'publish' );

            

                $the_query = new WP_Query( $args );



                if($the_query->have_posts()) : while($the_query->have_posts()) : $the_query->the_post();



                  $prosReviews[] = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM hxp_richreviews WHERE post_id = %d AND review_rating =%d AND review_status = %d ORDER BY id DESC", array( $post->ID, 5, 1 ) ), 'ARRAY_A');



                endwhile; endif; wp_reset_postdata();



                $prosReviews = array_filter($prosReviews); // REF - https://stackoverflow.com/questions/48002454/remove-null-values-in-php-array



                // echo '<pre>';

                // print_r($prosReviews);

                // exit;



              ?>

              

              <?php  foreach ( $prosReviews as $key => $prosReview ): ?>



                <div class="col-lg-6">

                  <div class="reviews">

                    <?php if (get_the_post_thumbnail_url($prosReview['post_id'])): ?>



                      <img alt="" src="<?php echo get_the_post_thumbnail_url($prosReview['post_id']); ?>">



                    <?php else: ?>



                      <img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/handyman-img0101.jpg">

                      

                    <?php endif; ?>

                    

                    <!-- <div class="revh">

                      510 <span>A</span> Reviews // PENDING

                    </div> -->

                    <h3><?php echo get_field('pros_first_name', $prosReview['post_id']) . ' ' . get_field('pros_last_name', $prosReview['post_id'])[0]; ?><?php // echo get_the_title( $prosReview['post_id'] ); ?></h3>

                    <p><strong>Customer Name:</strong> <?php echo esc_html($prosReview['reviewer_name']); ?></p>

                    <p><?php echo esc_html($prosReview['review_text']); ?></p>

                  </div><!-- Reviews -->

                </div>



              

              <?php endforeach;  ?>



            </div>

          </div>

        </div>

      </div>

    </div>

  </section>



  <section>

    <div class="block gray">

      <div class="container">

        <div class="row">

          <div class="col-lg-12">

            <div class="job-grid-sec">

              <div class="row">

                

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                  <div class="job-grid">

                    <div class="job-title-sec">

                      <div class="c-logo"><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/resource/jg1.png"></div>

                      <h2 style="font-size:24px;"><a href="#" title="">Testimonial</a></h2>

                      <p style="margin-bottom: 10px;">Some of the companies we've helped recruit excellent applicants over the years.</p>

                      <div class="row">

                        <div class="col-md-6 bbb-hidde">

                          <a href="#" target="_blank"><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/bbb-business.png"></a>

                        </div>

                        <?php if (get_field('hnd_award')): ?>

                          <div class="col-md-6">

                            <a href="#">
                              <img alt="" src="<?php echo get_field('hnd_award')['url']; ?>">
                            </a>

                          </div>
                          
                        <?php endif; ?>

                        

                        <div class="col-md-6">

                          <a href="#"><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/angieslist-review.png"></a>

                        </div>

                      </div><span class="fav-job"><i class="la la-heart-o"></i></span>

                    </div><a href="#" title="">SEE ALL OF OUR PROS REVIEWS</a>

                  </div><!-- JOB Grid -->

                </div>

                

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                  <div class="job-grid">

                    <div class="job-title-sec">

                      <div class="c-logo"><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/resource/jg2.png"></div>

                      <h2 style="font-size:24px;"><a href="<?php echo home_url('/blog/'); ?>" title="">Articles Blog</a></h2>

                      <p>We have composed some helpful articles here in our blog. Please come back often for more articles as we update them frequently.</p><img alt="." src="<?php bloginfo('template_directory'); ?>/assets/images/blog1.png"> <span class="fav-job"><i class="la la-heart-o"></i></span>

                    </div><a href="<?php echo home_url('/blog/'); ?>" title="">SEE OUR ARTICLES BLOG</a>

                  </div><!-- JOB Grid -->

                </div>



                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                  <div class="job-grid">

                    <div class="job-title-sec">

                      <div class="c-logo"><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/resource/jg3.png"></div>

                      <h2 style="font-size:24px;"><a href="<?php echo home_url('/about/'); ?>" title="">About Us</a></h2>

                      <p>We are working hard to make your experience with us very positive. Please see our full story and our compelling history.</p><a href="#" target="_blank"><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/bbb-business.png"></a>

                      <div class="row">

                        <div class="col-md-6 bbb-hidde">

                          <a href="#"><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/SuperServiceAward.png"></a>

                        </div>

                        <div class="col-md-6 bbb-hidde">

                          <a href="#"><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/angieslist-review.png"></a>

                        </div>

                      </div><span class="fav-job"><i class="la la-heart-o"></i></span>

                    </div><a href="<?php echo home_url('/about/'); ?>" title="">SEE HOW WE DO IT.</a>

                  </div><!-- JOB Grid -->

                </div>



              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>


    <!-- Five Star Pro -->
  <section>
    <div class="block" style="padding-top: 15px; padding-bottom: 0;">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="handy-star-pro">
              <h3>Are You a Five Star Pro?</h3>
              <p class="handy-star-pro-mainhead">Technicians make More Money with Your own interactive website that sells for you 24/7 while you are at work or with your family</p> <br><p>Don't spend your valuable time driving around quoting on 
                jobs that may never happen<br> Homeowners purchase and schedule pre-priced services and products live right off your website<br>
                Get more jobs and make money with less work on your part from a system that sells your services and remodeling products.</p>
              <div><a href="#" target="_blank">Details & Demo</a></div>
              </div>
          </div>
          <div class="col-lg-6">
            <img src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/handy-pro-img101.png" class="handy-star-img">
          </div>
        </div>
      </div>
    </div>
  </section>

  

<?php

get_footer(); ?>

<script src="<?php bloginfo('template_directory'); ?>/assets/js/reveal.js" type="text/javascript"></script>

