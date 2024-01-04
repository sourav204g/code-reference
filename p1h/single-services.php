<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package handyman_pro
 */

$fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
$per_min_cost = $fetch_hour_price/60;

get_header(); ?>

  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/single-services.css">

  <style>

   .ybs-list--condensed i.fa.fa-trash-o {
        position: relative;
        top: 4px;
        margin-left: 8px;
        color: brown;
        cursor: pointer;
    }

   li.hnd-child { margin-bottom: 0px; } 

   .showanswer a { padding: 15px 40px 0px 12px !important; }

   i.fa.fa-question-circle {
      right: 12px !important;
   }
  
  /*2-4-2021*/
  
@media (max-width:576px) {
    .single-service-input-sec input[type="number"] {
        max-width: 100%!important;
        margin:0;
} 
.single-service-input-sec input[type="number"]:focus{
    outline:none!important;
    box-shadow:none!important;
}
.single-service-input-sec input[type="number"]::placeholder {
    opacity: 1!important;
}
.single-service-input-sec a {
    position: relative;
    border: 2px solid #cdcdcd;
    border-left: none!important;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 5px!important;
}
.single-service-input-sec a i.fa-question-circle {
    position: relative!important;
    top: 0!important;
    transform: none!important;
    right: 0!important;
}
  /*5-04-21*/
  
  .job-single-head {
    padding-bottom: 0px;
    border-bottom: none;
}
.grid-info-custom{
    padding-top:0;
}
.serv-cart-wrapper{
    margin-top:-7px!important;
}
.grid-info-custom .grid-info-box {
    padding-top: 0px;
}
  }
  
/*13-4-22*/
.price-bg-ser {
    margin-bottom: 10px;
}

</style>

  <section>

    <div class="block less-top">
      <div class="container">
        <div class="row hnd-re-arrange">

        <?php if ( get_field('hnd_product_url_g') ): // Product link Button ?>

          <div class="col-lg-12" style="margin-bottom: 30px;">
                   <div class="browse-all-cat b22 ">

                    <?php if (get_field('hnd_popup_content_g')): ?>

                        <a class="style2 noradius blackbg" href="<?php echo get_field('hnd_product_url_g'); ?>" title="" data-toggle="modal" data-target="#blk-btn-popup1"><?php echo get_field('hnd_product_question_g'); ?></a>

                    <?php else: ?>

                        <a class="style2 noradius blackbg removeq" href="<?php echo get_field('hnd_product_url_g'); ?>" title=""><?php echo get_field('hnd_product_question_g'); ?></a>
                      
                    <?php endif; ?>
                    
                    </div>
              </div>
          
        <?php endif; ?>

          <div class="col-lg-8 col-md-8 column">
            <div class="job-single-sec">
              <div class="job-single-head">
                <div class="row">
                  <div class="col-md-5">
                    <div class="ma5slidera anim-horizontal horizontal-dots horizontal-navs center-dots inside-dots autoplay" style="overflow: hidden;">
                      
                      <div class="slides">

                          <?php if (get_the_post_thumbnail_url($post->ID)): ?>
                            <img style="width: 100%"  alt="<?php the_title(); ?>" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>">
                          <?php else: ?>
                            <img style="width: 100%" alt="<?php the_title(); ?>" src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png" style="border: 1px solid #ddd;">
                          <?php endif; ?>

                          <?php /*

                          // check if the repeater field has rows of data
                          if( have_rows('handyman_prod_services_images') ):

                            $count = 1;

                            // loop through the rows of data
                              while ( have_rows('handyman_prod_services_images') ) : the_row(); ?>

                                <a href="#slide-<?php echo $count; ?>"><img alt="<?php echo get_sub_field('handyman_image')['alt']; ?>" src="<?php echo get_sub_field('handyman_image')['url']; ?>"></a> 

                          <?php     

                            $count++;                           

                              endwhile;

                          endif; */

                          ?>
                  
                        
                      </div>

                        <?php if (get_field('handyman_product_discount', $post->ID)): ?>

                          <div class="off50">
                            <?php echo get_field('handyman_product_discount', $post->ID); ?>% Off
                          </div>
                          
                        <?php endif; ?>

                    </div>

                  </div> <!-- col-md-6 -->

                  <div class="col-md-7 emply-list-info" style="margin-top: 1px; ">
                    
                    <h2 style="margin-bottom: 6px; margin-top:0px; line-height: 20px;"><strong class="ft26 col88"><?php the_title(); ?></strong></h2>           
                      
                    <h4 class="hnd-price-h4" style="margin-bottom: 6px; margin-top:4px;">
                      
                      <?php echo ucfirst(get_field('handyman_type_of_service', $post->ID)); ?>

                      <?php $servicePrice = $per_min_cost * get_field('handyman_est_time', $post->ID); ?>

                      <?php include('inc/has-base-price.php'); ?>
                      <?php include('inc/has-nobase-has-options.php'); ?>            

                      <?php if (get_field('handyman_prod_services_show_quantity', $post->ID) && get_field('handyman_est_time', $post->ID) > 0): ?>

                        <?php 

                          $chkQForcedtoZero = get_field('handyman_prod_quantity_to_0', $post->ID); // true/ false

                          $sqtyValue = $chkQForcedtoZero ? 0 : 1;

                          // var_dump($sqtyValue);
                          // exit;

                        ?>

                        <div class="form-group2 show-quantity">
                            <div class="row">
                              <div class="col-md-6 shq-left">
                                <em class="">
                                  <?php echo get_field('handyman_prod_services_show_quantity', $post->ID); ?>
                                </em>
                              </div>
                              <div class="col-md-6 shq-right">
                                <div class="input-group" style="margin-top: 12px;">
                                  <div class="input-group-btn">
                                    <button class="btn btn-default" id="down" onclick=" down('1')">
                                      <i class="fa fa-minus"></i><span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                  </div><input class="form-control input-number mynu" id="myNumber" name="hnd_showquantity" placeholder="Quantity" type="number" value="<?php echo $sqtyValue; ?>" > <!-- readonly -->
                                  <div class="input-group-btn">
                                    <button class="btn btn-default" id="up" onclick="up('1000')"><i class="fa fa-plus"></i></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div><!-- new R -->        
                        
                      <?php endif; ?>


                      <div class="social-share-sec">
                          <h6>Share This Deal : </h6>
                        <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/facebook.png" class="img-fluid" alt="facebook"></a>
                        <a href="http://twitter.com/share?url=<?php echo get_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/twitter.png" class="img-fluid" alt="twitter" target="_blank"></a>
                        <a href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo get_the_title() . ' '; ?><?php echo get_permalink(); ?>" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/mail.png" class="img-fluid" alt="mail"></a>

                      </div>


                  </div>
                </div>
                <!-- Next QS -->


                <div class="row op-finish-show" style="display: none;">
                  <div class="col-md-12">
                    <div class="job-details desktop" style="padding-top: 1px;"> 
                      <?php if (get_field('handyman_prod_services_description', $post->ID)): ?>
                        <h3 style="font-size: 18px;">Includes:</h3>
                        <!-- <div class="handyman-service-description"> -->
                          <?php echo get_field('handyman_prod_services_description', $post->ID); ?>
                        <!-- </div> -->
                      <?php endif; ?>
                    </div>
                  </div>
                </div>


  <?php if (get_field('handyman_add_on_services')): ?>

  <div class="col-md-12">

    <h4 class="ft28 op-finish-hide">Options:</h4>
    <hr class="op-finish-hide" style="border: 1px solid #f2ae00;">

    <form action="" id="service_questionnaire_form" method="post">
    
      <input type="hidden" name="handymn_service_id" value="<?php echo $post->ID; ?>">
      <input type="hidden" name="handymn_service_name" value="<?php the_title(); ?>">
      <input type="hidden" name="handymn_showquantity" value="1" />
      <input type="hidden" name="handymn_service_comments" id="hnd_comm_hidden">

      <?php if (get_the_post_thumbnail_url($post->ID)): ?>
        <input type="hidden" name="handymn_service_featured_img" value="<?php echo get_the_post_thumbnail_url($post->ID); ?>">
      <?php else: ?>
        <input type="hidden" name="handymn_service_featured_img" value="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png">
      <?php endif; ?>

      <?php 

        $fetch_hour_price = get_field('handyman_master_config_per_hour_price' , 'option');
        $per_min_cost = $fetch_hour_price/60;

        $servicePrice = $per_min_cost * get_field('handyman_est_time', $post->ID);

        if (get_field('handyman_product_premium', $post->ID)) {
          
          $handyman_premium = ($servicePrice * get_field('handyman_product_premium', $post->ID))/100;

        } else {
          
          $handyman_premium = 0;
        }

        $servicePrice = $servicePrice + $handyman_premium;

        // If discount is set
        if(get_field('handyman_product_discount', $post->ID)) {

          $discount = get_field('handyman_product_discount', $post->ID);

          $afterDiscount = ( $servicePrice * $discount ) / 100;

        } else {

          $afterDiscount = 0;
        }

        
        ?>

        <?php wp_nonce_field('waiting_for_avengers_4_trailer', 'handyman_pro_nonce'); ?>

        <!-- // REF - http://php.net/manual/en/json.constants.php -->
        <input type="hidden" name="handymn_sl_addon_services" value='<?php echo json_encode(get_field('handyman_add_on_services'), JSON_HEX_APOS); ?>'>

        <input type="hidden" name="handymn_service_time" value="<?php echo get_field('handyman_est_time', $post->ID); ?>">
        <input type="hidden" name="handymn_per_min_cost" value="<?php echo $per_min_cost; ?>">
        <input type="hidden" name="handymn_service_price" value="<?php echo $servicePrice - $afterDiscount; ?>">
        <input type="hidden" name="handymn_premium" value="<?php echo $handyman_premium; ?>">
        <input type="hidden" name="handymn_after_discount" value="<?php echo $afterDiscount; ?>">
        <input type="hidden" name="handymn_original_price" value="<?php echo $servicePrice; ?>">
        <!-- <input type="hidden" name="handymn_service_time" value="<?php // echo get_field('handyman_est_time', $post->ID); ?>"> -->

        <!-- <input type="hidden" name="handymn_service_description" value="<?php // echo strip_tags(get_field('handyman_prod_services_description', $post->ID)); ?>">   -->

        <?php if (get_field('handyman_prod_shopping_cart_description', $post->ID)): ?>

          <input type="hidden" name="handymn_service_description" value="<?php echo get_field('handyman_prod_shopping_cart_description', $post->ID); ?>">  
          
        <?php else: ?>

          <input type="hidden" name="handymn_service_description" value="<?php echo get_field('handyman_prod_services_description', $post->ID); ?>">  
          
        <?php endif; ?>

        
        
        
        <input type="hidden" name="handymn_service_customer_to_supply" value="<?php echo get_field('handyman_prod_services_customer_to_supply', $post->ID); ?>">

        <input type="hidden" name="handymn_service_opt" value="">
        <input type="hidden" name="handymn_service_sub" value="">
        <input type="hidden" name="handymn_service_opt_val" value="">
        <input type="hidden" name="handymn_service_opt_visibility" value="">
        <input type="hidden" name="handymn_service_sub_val" value="">
        <input type="hidden" name="handymn_service_opt_deleted" value="">
        <input type="hidden" name="handymn_service_sub_deleted" value="">
        <input type="hidden" name="handymn_current_tab" value="">

        <input type="hidden" data-spremium="<?php echo get_field('handyman_product_premium', $post->ID); ?>" value="">
        <input type="hidden" data-sdiscount="<?php echo get_field('handyman_product_discount', $post->ID); ?>" value="">

      
      <div class="hnd-opttab-container">
        <?php foreach (get_field('handyman_add_on_services') as $outerKey => $handyman_add_on_services) : 
            
            $handyman_addon_options = $handyman_add_on_services['handyman_addon_options']; ?>

            <div class="tab transition-item-enter transition-item-enter-active <?php echo 'addon_service_' . $outerKey; ?><?php echo $outerKey === 0 ? ' active' : ''; ?>" style="<?php $outerKey === 0 ? 'display: block' : ''; ?>">
              <!-- <h3>What Is The Walls Height?</h3> -->
              <div class="ques-group-container">

                <div class="ques-group"><h3><?php echo $handyman_add_on_services['handyman_addon_question']; ?></h3>

                <?php foreach ( $handyman_addon_options as $innerKey => $handyman_addon_options_item ): ?>

                  <?php // var_dump($handyman_addon_options_item); ?>

                  <div class="ques <?php echo ($handyman_addon_options_item['handyman_sub_option_groups'][0]['acf_fc_layout']) ? 'has_sub_option ' . $handyman_addon_options_item['handyman_sub_option_groups'][0]['acf_fc_layout'] : ''; ?>">

                    <div class="ptag" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>">


                      <?php                          

                            if ( $handyman_addon_options_item['handyman_material_price'] != 0 && $handyman_addon_options_item['handyman_material_price'] != "" ) {
                              $optionMaterialCost1 = $handyman_addon_options_item['handyman_material_price'];
                            } else {
                               $optionMaterialCost1 = 0;
                            }


                      ?>

                      <?php if ( $handyman_addon_options_item['handyman_shopping_cart_caption_opt'] ): // Show Cart caption if avaiable. ?>

                        <?php if ( $handyman_addon_options_item['handyman_addon_sub_option_customer_supply'] ): ?>

                            <input id="<?php echo $outerKey . '|' . $innerKey; ?>" 
                          name="<?php echo 'addon_service_' . $outerKey; ?>"
                          type="radio" 
                          data-key="<?php echo $outerKey; ?>" 
                          value="<?php echo esc_attr($handyman_addon_options_item['handyman_shopping_cart_caption_opt']) . '~' . $handyman_addon_options_item['handyman_addon_sub_option_customer_supply'] . '|' . $handyman_addon_options_item['labour_minutes'] . '|' . $optionMaterialCost1; ?>" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>" data-premium="<?php echo get_field('handyman_product_premium', $post->ID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $post->ID); ?>">

                        <?php else: ?>

                          <input id="<?php echo $outerKey . '|' . $innerKey; ?>" 
                          name="<?php echo 'addon_service_' . $outerKey; ?>"
                          type="radio" 
                          data-key="<?php echo $outerKey; ?>" 
                          value="<?php echo esc_attr($handyman_addon_options_item['handyman_shopping_cart_caption_opt']) . '|' . $handyman_addon_options_item['labour_minutes'] . '|' . $optionMaterialCost1; ?>" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>" data-premium="<?php echo get_field('handyman_product_premium', $post->ID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $post->ID); ?>">
                          
                        <?php endif; ?>

                      <?php else: ?>

                        <?php if ( $handyman_addon_options_item['handyman_addon_sub_option_customer_supply'] ): ?>

                          <input id="<?php echo $outerKey . '|' . $innerKey; ?>" 
                        name="<?php echo 'addon_service_' . $outerKey; ?>"
                        type="radio" 
                        data-key="<?php echo $outerKey; ?>" 
                        value="<?php echo esc_attr($handyman_addon_options_item['handyman_option_label']) . '~' . $handyman_addon_options_item['handyman_addon_sub_option_customer_supply'] . '|' . $handyman_addon_options_item['labour_minutes'] . '|' . $optionMaterialCost1; ?>" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>" data-cts="<?php echo $handyman_addon_options_item['handyman_addon_sub_option_customer_supply']; ?>" data-premium="<?php echo get_field('handyman_product_premium', $post->ID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $post->ID); ?>">

                        <?php else: ?>

                          <?php 

                              // echo '<pre>';
                              // var_dump($handyman_addon_options_item);

                              if ( $handyman_addon_options_item['labour_minutes'] !== '0' || 
                                  $optionMaterialCost1 !== 0 || 
                                  $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] !== false || ($handyman_addon_options_item['handyman_addon_sub_option_check'] !== true &&
                                    $handyman_addon_options_item['handyman_sub_option_groups'] !== true)

                                ) {

                                $hnd_visibility = 'show';
                              
                              } else {

                                $hnd_visibility = 'hide';
                              }

                          ?>

                          <input id="<?php echo $outerKey . '|' . $innerKey; ?>" 
                        name="<?php echo 'addon_service_' . $outerKey; ?>"
                        type="radio" 
                        data-key="<?php echo $outerKey; ?>" 
                        value="<?php echo esc_attr($handyman_addon_options_item['handyman_option_label']) . '|' . $handyman_addon_options_item['labour_minutes'] . '|' . $optionMaterialCost1; ?>" data-multiply="<?php echo ( $handyman_addon_options_item['handyman_multiply_by_parent_quantity'] ) ? 'true' : 'false'; ?>" data-cts="<?php echo $handyman_addon_options_item['handyman_addon_sub_option_customer_supply']; ?>" data-visibility="<?php echo $hnd_visibility; ?>" data-premium="<?php echo get_field('handyman_product_premium', $post->ID); ?>" data-discount="<?php echo get_field('handyman_product_discount', $post->ID); ?>">

                        <?php endif; ?>                       
                        
                      <?php endif; ?>

                      

                      <label for="<?php echo $outerKey . '|' . $innerKey; ?>">
                        <?php 

                          $optionsacx = '';
                          $optionsacx .= $handyman_addon_options_item['handyman_option_label'];


                          $optCost = $per_min_cost * $handyman_addon_options_item['labour_minutes'];



                          // Premium
                          if (get_field('handyman_product_premium', $post->ID)) {
                          
                            $OPpremium = ( $optCost * get_field('handyman_product_premium', $post->ID))/100;

                          } else {
                            
                            $OPpremium = 0;
                          }

                          $optCost = $optCost + $OPpremium;



                          // Discount
                          if (get_field('handyman_product_discount', $post->ID)) {
        
                            $OPdiscount = ($optCost * get_field('handyman_product_discount', $post->ID))/100;

                          } else {
                            
                            $OPdiscount = 0;

                          }

                          $optCost = $optCost - $OPdiscount;


                          $optionMaterialCost = 0;

                          if ( $handyman_addon_options_item['handyman_material_price'] != '0' ) {
                            $optionMaterialCost = $handyman_addon_options_item['handyman_material_price'];
                          }


                          $optCost = $optCost + $optionMaterialCost;
                          

                          if ( $handyman_addon_options_item['labour_minutes'] != '0' ) {

                            $optionsacx .= ' - Add $ <em data-prc="' . $optCost . '">' .  round($optCost, 2) . '</em>';

                          } else {

                            if ($optionMaterialCost != 0) {
                                $optionsacx .= '<em data-prc="' . $optCost . '">  - Add $ ' . $optCost . '</em>';
                            } else {
                                $optionsacx .= '<em data-prc="' . $optCost . '"></em>';
                            }

                            

                          }

                          echo $optionsacx;

                        ?>
                      </label>


                      <?php if ($handyman_addon_options_item['handyman_addon_sub_option_check'] && $handyman_addon_options_item['handyman_sub_option_groups']): // checking if sub-option option is checked ?>


                        <?php foreach ($handyman_addon_options_item['handyman_sub_option_groups'] as $subkey => $handyman_sub_option_group ): // Sub-Options ?>

                          <?php include('template-parts/content-quantity.php'); ?>
                          <?php include('template-parts/content-yesno.php'); ?>
                          <?php include('template-parts/content-list.php'); ?>
          
                        <?php endforeach; ?>

                        
                      <?php endif; ?>


                    </div>

                  </div>
                  
                <?php endforeach; ?>

                </div> <!-- ques ques-group --> 

              </div>
             </div>

        <?php endforeach; ?>
      </div>


      

      <div class="row" style="margin-top: 25px;">
        <div class="col-md-8">
          <div class="pro-bar op-finish-hide">
                  <div class="progress">
                        <div id="progress-bar"></div>
                    </div>
                  </div>
              </div>
              <div class="col-md-4">
                <div id="backnext" >
                  <div style="overflow:auto;">
              <div id="backnext">
                <button id="nextBtn" onclick="nextPrev(1)" style="float:right;" type="button">Next</button>
                <button id="prevBtn" onclick="nextPrev(-1)" style="float:right; display: none; margin-right:10px;" type="button">Back</button> 
              </div>
                  </div>
              </div>
      


          <div style="clear: both;"></div>
          <div style="text-align:center; display: none; padding-top:30px; padding-bottom:30px; margin-top:20px; width: 120px; margin-bottom: 20px; clear: both; margin: 0 auto;" id="stepss">

            <?php for ($i=0; $i < count(get_field('handyman_add_on_services')) ; $i++) : ?>
              <span class="step"></span>
            <?php endfor; ?>

          </div>
          </div>
      </div>
      

    <!-- </form> -->

  </div>

  

  <div class="col-md-12">
    <div class="row final_statement_desktop no-margin mtt30" style="display: none">

      <div class="col-md-12">
        <!-- <h2>We can match you with pros for this job</h2>
        <h5>Let us introduce you to some great pros we know</h5>
        <div class="row fixtext mtt70">
          <div class="col-md-3">
            <img src="<?php // bloginfo('template_directory'); ?>/assets/images/fix-icon101.png"><span>Fixed<br>
            Hourly Rates</span>
          </div>
          <div class="col-md-3">
            <img src="<?php // bloginfo('template_directory'); ?>/assets/images/fix-icon102.png"><span>Live Online<br>
            Scheduling</span>
          </div>
          <div class="col-md-5">
            <img src="<?php // bloginfo('template_directory'); ?>/assets/images/fix-icon103.png"><span>100%<br>
            Satisfaction Guarantee</span>
          </div>
        </div> -->
        <div class="mtt50">
          <button style="margin-right: 15px;display: none;" type="submit" name="submit_for_scheduling" id="submit_for_scheduling">Add to Cart</button>
        </div>
      </div>
    </div>
      </form>

    

  </div>

  <?php endif; ?>

                </div>

                          
            <div class="row op-finish-hide">
              <div class="col-md-12">
                <div class="job-details desktop" style="padding-top: 1px;"> 
                  <?php if (get_field('handyman_prod_services_description', $post->ID)): ?>
                    <h3 style="font-size: 18px;">Includes:</h3>
                    <!-- <div class="handyman-service-description"> -->
                      <?php echo get_field('handyman_prod_services_description', $post->ID); ?>
                    <!-- </div> -->
                  <?php endif; ?>
                </div>
              </div>
            </div>

              
            <div class="job-details mobile">
                                          
              <?php if (get_field('handyman_prod_services_description', $post->ID)): ?>

                <h3>Includes:</h3>

                <!-- <div class="handyman-service-description"> -->
                  <?php echo get_field('handyman_prod_services_description', $post->ID); ?>
                <!-- </div> -->
                
              <?php endif; ?>                          

            </div>

            </div>
          </div>
          
          <div class="col-lg-4 col-md-4 column serv-cart-wrapper">

                    <!-- Right Price Bar -->
                    <div class="cart-page2-container clearfix">
                    <div class="cart-page2">      

                        <div class="cart-head22">

                                <?php if (!isset($afterDiscount)): $afterDiscount = 0; endif; ?>
                            
                                <!-- <h3>Selected Items ( <span class="hnd-item-count">1</span> )  -->
                                <h3>Total Price: 
                                  <span class="cart-head-span hndy_total_price"><?php echo '$<span>' . round($servicePrice - $afterDiscount, 2) . '</span>'; ?> USD</span>
                                </h3>

                                <h4 class="completion-time">Approximate Completion Time: <span class="hn_service_com_time" data-comt="<?php echo get_field('handyman_est_time', $post->ID); ?>"><?php echo timeConvert(get_field('handyman_est_time', $post->ID)); ?></span></h4>
                             
                        </div>
            
                       <div class="clearfix"></div>
                    </div>

                    <div class="price-bg-ser">
                      
                      <ul class="ybs-list ybs-list--condensed">

                          <?php if (get_field('handyman_est_time', $post->ID) > 0): ?>

                                <li class="ybs-list-item price-section transition-item-enter transition-item-enter-active">
                                  
                                  <div class="ybs-title ybs8">

                                  <?php $cart_caption_main = get_field('handyman_prod_shopping_cart_caption_main'); 

                                        $show_quantityl = get_field('handyman_prod_services_show_quantity');

                                  if ($cart_caption_main != '' && $show_quantityl != ''): ?>

                                        <?php if ( strpos($cart_caption_main, '{qt}') !== false ) : ?>

                                          <h6 class="subheader">
                                            <?php echo str_replace('{qt}', '<span class="quan">1</span>', $cart_caption_main); ?> <!-- (<?php // echo get_field('handyman_type_of_service'); ?>) -->

                                            <?php if (get_field('handyman_prod_services_customer_to_supply', $post->ID)): ?>

                                                        <small class="subheader-small">
                                                          <b>Customer to Supply: </b><?php echo get_field('handyman_prod_services_customer_to_supply', $post->ID); ?>
                                                        </small>
                                                        
                                            <?php endif; ?> 
                                            
                                          </h6>

                                        <?php else: ?>

                                          <h6 class="subheader">
                                            <?php echo $cart_caption_main . ' - <span class="quan">1</span> qty'; ?> 
                                            <!-- (<?php // echo get_field('handyman_type_of_service'); ?>) -->
                                            <?php if (get_field('handyman_prod_services_customer_to_supply', $post->ID)): ?>

                                                        <small class="subheader-small">
                                                          <b>Customer to Supply: </b><?php echo get_field('handyman_prod_services_customer_to_supply', $post->ID); ?>
                                                        </small>
                                                        
                                            <?php endif; ?> 
                                          </h6>
                                          
                                        <?php endif; ?>

                                  <?php else: ?>

                                        <?php if ($show_quantityl != ''): ?>

                                          <h6 class="subheader">
                                            <?php the_title(); ?>
                                            <?php if (get_field('handyman_prod_services_customer_to_supply', $post->ID)): ?>

                                                        <small class="subheader-small">
                                                          <b>Customer to Supply: </b><?php echo get_field('handyman_prod_services_customer_to_supply', $post->ID); ?>
                                                        </small>
                                                        
                                            <?php endif; ?> 
                                          </h6>

                                        <?php else: ?>

                                          <?php if ($cart_caption_main != ''): ?>

                                            <h6 class="subheader">
                                              <?php echo $cart_caption_main; ?> <!-- (<?php // echo get_field('handyman_type_of_service'); ?>) -->
                                              <?php if (get_field('handyman_prod_services_customer_to_supply', $post->ID)): ?>

                                                          <small class="subheader-small">
                                                            <b>Customer to Supply: </b><?php echo get_field('handyman_prod_services_customer_to_supply', $post->ID); ?>
                                                          </small>
                                                          
                                              <?php endif; ?>
                                            </h6>

                                          <?php else: ?>

                                            <h6 class="subheader">
                                            <?php the_title(); ?> (<?php echo ucfirst(get_field('handyman_type_of_service')); ?>)
                                            <?php if (get_field('handyman_prod_services_customer_to_supply', $post->ID)): ?>

                                                        <small class="subheader-small">
                                                          <b>Customer to Supply: </b><?php echo get_field('handyman_prod_services_customer_to_supply', $post->ID); ?>
                                                        </small>
                                                        
                                            <?php endif; ?>
                                          </h6>
                                            
                                          <?php endif; ?>

                                          
                                          
                                        <?php endif; ?>                                 
                                      
                                  <?php endif; ?> 

                                    
                                  </div>

                                  <div class="ybs-value"> $<span class="quanc" data-op="<?php echo round($servicePrice - $afterDiscount, 2); ?>"><?php echo round($servicePrice - $afterDiscount, 2); ?></span> USD </div>

                                </li>
                            
                          <?php endif; ?>

                                <li class="opt-cap ybs-list-item price-section transition-item-enter transition-item-enter-active" style="color: #FF5722; font-weight: bold;display: none;">Selected Options</li>

                      </ul>
                     
                      <!-- <div class="price-section">
                        <h4>
                          Small size trampoline - Add $ 140
                        </h4>
                      </div>
                      <div class="price-section">
                        <h4>
                          Yes - Trampoline enclosure needs to be installed
                        </h4>
                      </div>
                      <div class="price-section">
                        <h4>
                          Small size trampoline - Add $ 140
                        </h4>
                      </div> -->
                    </div>
                    <div class="customer-popup-sec">

                        <?php if (get_field('handyman_prod_services_customer_to_supply', $post->ID)): ?>
                            <p>Customer To Supply:<span data-toggle="modal" data-target="#customer-supply">Read More</span></p>
                        <?php else: ?>
                            <p>Technical Materials:<span data-toggle="modal" data-target="#technical-materials">Read More</span></p>                                                
                        <?php endif; ?> 

                    </div>
                    </div>
                    <!-- End Right Price Bar -->

            <!-- <?php //get_template_part( 'template-parts/content', 'quick-contact' ); ?> -->
            <?php /* if (get_field('handyman_prod_services_customer_to_supply', $post->ID)): ?>

                        <!-- <div class="customers-to-supply"> -->
                          <h3 style="font-size: 18px;">Customer To Supply:</h3>
                          <?php echo get_field('handyman_prod_services_customer_to_supply', $post->ID); ?>
                        <!-- </div> -->
                        
            <?php endif; */ ?> 

            <?php // 4-July-2019 ?>
                    <?php if (get_field('handyman_est_time', $post->ID) > 0): ?>

                      <div class="grid-info-box" style="margin-bottom: 0px;padding-bottom: 0px;">
                        <textarea id="hnd_comm_text" name="handymn_service_comments" placeholder="Add Comments (Optional)" rows="3" style="padding: 10px 12px !important;"></textarea>
                      </div>
                         <div class="clearfix"></div><br/>
            <?php endif; ?>


            


                       <div class="grid-info-box account-btns grid-info-custom">

                      <?php if (get_field('handyman_add_on_services')): ?>

                      <!-- <div class="questions-popup">
                        <span class="add-to-cart"><i aria-hidden="true" class="fa fa-cart-plus"></i> Add To Cart</span>
                      </div> -->

                              <?php // 3-Dec-2019 ?>
                              <?php if (get_field('handyman_est_time', $post->ID) == 0): ?>

                                <div class="grid-info-box" style="margin-bottom: 0px;padding-bottom: 0px;">
                                  <textarea id="hnd_comm_text" name="handymn_service_comments" placeholder="Add Comments (Optional)" rows="3" style="padding: 10px 12px !important;"></textarea>
                                </div>
                                   <div class="clearfix"></div><br/>
                              <?php endif; ?>

                      <?php else: ?>

                        <form method="post" enctype="multipart/form-data" name="test_form" id="imgval">

                          <?php wp_nonce_field('waiting_for_avengers_4_trailer', 'handyman_pro_nonce'); ?>
                          
                          <input type="hidden" name="handymn_service_id" value="<?php echo $post->ID; ?>">
                          
                          <input type="hidden" name="handymn_hasno_option_values" value=''>

                          <input type="hidden" name="handymn_service_comments" id="hnd_comm_hidden1">

                          <input type="hidden" name="handymn_service_time" value="<?php echo get_field('handyman_est_time', $post->ID); ?>">

                          <input type="hidden" name="handymn_per_min_cost" value="<?php echo $per_min_cost; ?>">

                          <input type="hidden" name="handymn_premium" value="<?php echo $handyman_premium; ?>">
                          <input type="hidden" name="handymn_after_discount" value="<?php echo $afterDiscount; ?>">

                          <input type="hidden" name="handymn_showquantity" value="1" />

                          <input type="hidden" name="handymn_original_price" value="<?php echo $servicePrice; ?>">

                          <?php if (get_the_post_thumbnail_url($post->ID)): ?>
                            <input type="hidden" name="handymn_service_featured_img" value="<?php echo get_the_post_thumbnail_url($post->ID); ?>">
                          <?php else: ?>
                            <input type="hidden" name="handymn_service_featured_img" value="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png">
                          <?php endif; ?>


                          <?php // 4-July-2019 ?>
                          <?php if (get_field('handyman_est_time', $post->ID) == 0): ?>

                            <div class="grid-info-box" style="margin-bottom: 0px;padding-bottom: 0px;">
                                
                              <textarea id="hnd_comm_text" name="handymn_service_comments" placeholder="We have no price for this service. Please type in a description and name the price you want to pay below." rows="4" required></textarea>

                               <div class="input-group showanswer single-service-input-sec">
                              
                              <input type="number" placeholder="Enter the $ amount you want to pay" name="handymn_custom_price" required class="form-control border-right-0">

                                                            <a data-target="#showquestion" data-toggle="modal" href="#"><span><i class="fa fa-question-circle"></i></span></a>

                              </div>
                                                        

                            </div>


                            <div class="clearfix"></div>

                              

                            <div class="input-group filelabels box">
                                
                            <!--   <input class="fileUpload" name="filename[]" id="file-6" accept="image/jpeg, image/jpg" type="file" value="Choose a file" multiple>  

                              <label for="file-6">
                                <figure><i class="fa fa-camera"></i></figure>
                              </label> -->

                              <!-- <div class="upload-demo col-lg-12">
                                
                              </div> -->

                              <div style="width: 100%">

                              <strong style="display: block;margin-bottom: 14px;color: rgba(68, 68, 68, 0.85);">Upload Pictures (Optional)</strong>

                              <div class="clearfix"></div>

                              <div class="add-ph">
                              <label for="add1" style="padding-left:0px !important;">
                              <input id="add1" name="filename[]" type='file' onchange="readURL(this);" style="display:none;" />
                                <img id="add-photo" src="https://www.handymanproservices.com/wp-content/themes/handyman_pro/assets/images/add-photo.jpg" alt="Add a Photo" style="width: 100%;  border-radius:4px; " />
                                <span class="popupcloseimg" style="display:none;"><i class="fa fa-trash-o" aria-hidden="true"></i></span> 
                              </label>
                              </div>
                               <div class="add-ph">
                              <label for="add2" style="padding-left:0px !important;">
                                <input id="add2" name="filename[]" type='file' onchange="readURL2(this);" style="display:none;" />
                                <img id="add-photo2" src="https://www.handymanproservices.com/wp-content/themes/handyman_pro/assets/images/add-photo.jpg" alt="Add a Photo" style="width: 100%;  border-radius:4px; " />
                                <span class="popupcloseimg2" style="display:none;"><i class="fa fa-trash-o" aria-hidden="true"></i></span> 
                              </label></div>

                              <div class="add-ph" style="margin-right:0px;">
                              <label for="add3" style="padding-left:0px !important;">
                                <input id="add3" name="filename[]" type='file' onchange="readURL3(this);" style="display: none;" />
                                <img id="add-photo3" src="https://www.handymanproservices.com/wp-content/themes/handyman_pro/assets/images/add-photo.jpg" alt="Add a Photo" style="width: 100%; border-radius:4px; " />
                                <span class="popupcloseimg3" style="display:none;"><i class="fa fa-trash-o" aria-hidden="true"></i></span> 
                              </label>
                              </div>
                                
                              </div>



                               

                                

                              <div class="clearfix"></div>

                            </div>

                          <?php endif; ?>
                          
                          <!-- custom quote add-to-cart -->
                          
                          <div class="col-md-12" style="padding-left: 0; padding-right: 0;">
                          <button class="add-to-cart" type="submit" name="submit_for_scheduling" id="submit_for_scheduling" style="font-family: 'Lato', sans-serif;font-size: 14px !important;margin-top: 22px;"><i aria-hidden="true" class="fa fa-cart-plus"></i> Add To Cart</span></button>
                          </div>
                          
                        </form>

                      
                        <?php 

                        // Upload validation
                        /* if (isset($_GET['m']) && $_GET['m'] === 'required'): ?>

                          <small class="upload-error">No files selected!</small>
                          
                        <?php endif; */ ?>

                      <?php endif; ?>

                      <span class="add-comment" style="" title=""><i aria-hidden="true" class="fa fa-comments-o"></i> Add Comment</span>
                      
                      <div class="row final_statement_btn no-margin" style="display: none">
                        <button style="margin-right: 15px;" id="submit_for_scheduling_imi">Add to Cart</button>
                      </div>
                                         
                    </div>

                    <div class="clearfix"></div>

                    <div class="final_statement_mobile no-margin" style="display: none">
                        <div class="">
                          <h2>We can match you with pros for this job</h2>
                          <h5>Let us introduce you to some great pros we know</h5>
                          <div class="row fixtext mtt70">
                            <div class="col-md-3">
                              <img src="<?php bloginfo('template_directory'); ?>/assets/images/fix-icon101.png"><span>Fixed<br>
                              Hourly Rates</span>
                            </div>
                            <div class="col-md-3">
                              <img src="<?php bloginfo('template_directory'); ?>/assets/images/fix-icon102.png"><span>Live Online<br>
                              Scheduling</span>
                            </div>
                            <div class="col-md-5">
                              <img src="<?php bloginfo('template_directory'); ?>/assets/images/fix-icon103.png"><span>100%<br>
                              Satisfaction Guarantee</span>
                            </div>
                          </div>
                        </div>
                  </div>

                    


          </div>

        </div>
      </div>
    </div>
  </section><!--Questions popup Box Start-->

   <?php /*
  <?php if (get_field('handyman_add_on_services')): ?>

  <div class="account-popup-area questions-popup-box">
    <div class="account-popup mtt50">
      <div class="container pro-questions">
        <div class="row">
          <div class="col-md-12">
            <div class="res-logo">
              <a href="<?php echo home_url('/'); ?>" title=""><img alt="" src="<?php bloginfo('template_directory'); ?>/assets/images/resource/logo1.png"></a>
            </div><span class="close-popup"><i class="la la-close"></i></span>
          </div>
        </div>
        <div class="row" id="qsset">

          <!-- <div class="col-md-12 mtt70">
            <h2>Great! Few more questions to get more info on the "New Installation" for your "Two Rooms Painting package"</h2>
          </div>
          <div class="col-md-12 mtt50">
            <button id="nextqs" type="button">Next</button>
          </div> -->


          <?php get_template_part( 'template-parts/content', 'nextqs' ); ?>


        </div> <!-- qsset -->
      </div>
    </div>
  </div>

  <?php endif; ?> */?>

<?php get_footer(); ?>

<script src="<?php bloginfo('template_directory'); ?>/assets/js/service.js"></script>

<!-- Modal -->
<div class="modal" id="showquestion">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customize-itLabel">Custom Services</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body cus89">      
        <div class="row">
          <div class="col-md-12">
            <p>
            Customer name the price custom described projects are accepted on a fairly price based offer and skill level requests. We will let you know  if there are any discrepancies after submitting your project within 24 hours.
            </p>
          </div>                                    
        </div>
      </div>
      
    </div>
  </div>
</div><!-- Modal -->




<script type="text/javascript">
  function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#add-photo')
                        .attr('src', e.target.result);
                        $(".popupcloseimg").show();
                };

                reader.readAsDataURL(input.files[0]);
            }
            $(".popupcloseimg").click(function(e){
                e.preventDefault();
                $('#add-photo').attr('src', '<?php bloginfo('template_directory'); ?>/assets/images/add-photo.jpg');
                $('#add1').val('');
                $(".popupcloseimg").hide();
                return true;
            }); 
        }
</script>

<script type="text/javascript">
  function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#add-photo2')
                        .attr('src', e.target.result);
                        $(".popupcloseimg2").show();
                };

                reader.readAsDataURL(input.files[0]);
            }
            $(".popupcloseimg2").click(function(e){
                e.preventDefault();
                $('#add-photo2').attr('src', '<?php bloginfo('template_directory'); ?>/assets/images/add-photo.jpg');
                $('#add2').val('');
                $(".popupcloseimg2").hide();
                return true;
            }); 
        }
</script>

<script type="text/javascript">
  function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#add-photo3')
                        .attr('src', e.target.result);
                        $(".popupcloseimg3").show();
                };

                reader.readAsDataURL(input.files[0]);
            }
             $(".popupcloseimg3").click(function(e){
                e.preventDefault();
                $('#add-photo3').attr('src', '<?php bloginfo('template_directory'); ?>/assets/images/add-photo.jpg');
                $('#add3').val('');
                $(".popupcloseimg3").hide();
                return true;
            }); 
        }
</script>