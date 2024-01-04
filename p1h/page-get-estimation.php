<?php
/**
 * Template Name: Get Estimation
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

get_header(); ?>

<style type="text/css">

  .add-ph label::before {
    border: none !important;
  }

  i.fa.fa-question-circle {
      font-size: 35px;
      position: absolute;
      top: 15px;
      right: 5px;
      z-index: 9999;
  }

/*--22-4-21--*/

.mob-desc{display: none;}
.free-quote-form-sec{
  margin: 50px 0;
}
.estimate-upload-wrapper{
  margin-top:30px;
}

@media (max-width: 520px){

.cstm-breadcrumb-wrapper .inner-title2 {
    padding: 6px 0 0;
}
.mob-desc{
  display: block;
}
/* .desktop-desc{
  display: none;
} */
h2.desktop-head{
  display: none;
}
.free-quote-form-sec{
  margin: 0px 0 10px;
}
.estimate-input-wrapper {
    padding: 13px 0 3px;
}
.estimate-input-wrapper input[type="number"] {
    max-width: 100%!important;
    padding: 19px 6px!important;
}
.estimate-input-wrapper input[type="number"]::placeholder{
  opacity:1!important;
}
.estimate-input-wrapper a{
    width: 30px;
    height: 48px;
    position: relative;
}
.estimate-input-wrapper i.fa.fa-question-circle {
    left: 50%;
    transform: translate(-50%, -50%)!important;
    right: unset;
}
.estimate-upload-wrapper{
  margin-top: 15px;
}
}


</style>
<div class="cstm-breadcrumb-wrapper">

<?php // get_template_part( 'template-parts/content', 'breadcrumb' ); ?>

<section class="overlape">
    <div class="block no-padding">
      <div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php echo get_field('handyman_pro_pages_hero_banner')['url']; ?>) repeat scroll 50% 422.28px transparent;"></div><!-- PARALLAX BACKGROUND IMAGE -->
      <div class="container fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="inner-header">
              <h3>GET A FREE ESTIMATE</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>



<section class="free-quote-form-sec">
  <div class="block no-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          
          <form method="post" enctype="multipart/form-data" name="handyman_popup_form">
            <div class="row">
              <div class="col-md-6">
                <h2 class="desktop-head"><b>Tell us about your project</b></h2>

                <h2 class="mobile-head"><b>Set Your Own Price</b></h2>
                
                    <?php wp_nonce_field('waiting_for_avengers_4_trailer', 'handyman_pro_nonce'); ?>

                    <input type="hidden" name="handymn_hasno_option_values" value=''>
                    <input type="hidden" name="handymn_service_id" value="custom">
                    
                    <input type="hidden" name="handymn_service_featured_img" value="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png">
                    
                    <textarea class="form-control custom-description desktop-desc" name="handymn_service_comments" placeholder="Please type in and itemize a list of your to do list tasks and enter the $ amount you are budgeting for this project below." style="min-height:120px; background: #e1e1e1; " required></textarea> 

                    <!-- <textarea class="form-control custom-description mob-desc" name="handymn_service_comments" placeholder="Custom describe and itemize a list of service/s you need done and name the price you want to pay below." style="min-height:100px; background: #e1e1e1; " required></textarea> -->

                    <div class="input-group showanswer estimate-input-wrapper">
                              
                        <input type="number" placeholder="Enter the $ amount you want to pay" name="handymn_custom_price" required class="form-control border-right-0">
                        <a data-target="#showquestion" data-toggle="modal" href="#"><span><i class="fa fa-question-circle"></i></span></a>

                    </div>


                    <div class="clearfix"></div>
                    <div class="estimate-upload-wrapper">
                

                          <div style="width: 100%">

                           <h3><b>Take Some Photos of Your Project</b><span style="font-size: 18px;"> (Optional)</span></h3>
                            <hr/>
                              <div class="clearfix"></div>

                              <div class="add-ph">
                              <label for="add1" style="padding-left:0px !important;">
                              <input id="add1" name="filename[]" type='file' onchange="readURL(this);" style="display:none;" />
                                <img id="add-photo" src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/add-photo.jpg" alt="Add a Photo" style="width: 100%;  border-radius:4px; " />
                                <span class="popupcloseimg" style="display:none;"><i class="fa fa-trash-o" aria-hidden="true"></i></span> 
                              </label>
                              </div>
                               <div class="add-ph">
                              <label for="add2" style="padding-left:0px !important;">
                                <input id="add2" name="filename[]" type='file' onchange="readURL2(this);" style="display:none;" />
                                <img id="add-photo2" src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/add-photo.jpg" alt="Add a Photo" style="width: 100%;  border-radius:4px; " />
                                <span class="popupcloseimg2" style="display:none;"><i class="fa fa-trash-o" aria-hidden="true"></i></span> 
                              </label></div>

                              <div class="add-ph" style="margin-right:0px;">
                              <label for="add3" style="padding-left:0px !important;">
                                <input id="add3" name="filename[]" type='file' onchange="readURL3(this);" style="display: none;" />
                                <img id="add-photo3" src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/add-photo.jpg" alt="Add a Photo" style="width: 100%; border-radius:4px; " />
                                <span class="popupcloseimg3" style="display:none;"><i class="fa fa-trash-o" aria-hidden="true"></i></span> 
                              </label>
                              </div>
                                
                            </div>

                              <div class="col-md-12" style="padding-left: 0; padding-right: 0;">
                          <button class="add-to-cart" type="submit" name="submit_for_scheduling" id="submit_for_scheduling" style="font-family: 'Lato', sans-serif; font-size:21px !important; padding: 12px 20px; width: 100%; margin-top: 22px;">SUBMIT</span></button>
                          </div>

                  </div>

              </div>
              <div class="col-md-6">
                <img src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/estimate-img01.jpg" style="width: 100%;" />
              </div>
            </div>
          </form>

          
                </div>
            </div>
        </div>
    </div>
</section>




<?php get_footer(); ?>


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


<script type="text/javascript">
  
jQuery(document).ready(function($) {
  var alterClass = function() {
    var ww = document.body.clientWidth;
    if (ww < 600) {
      $('textarea.desktop-desc').removeAttr('required');
      $('textarea.mob-desc').attr('required');
    } else if (ww >= 601) {
      $('textarea.desktop-desc').attr('required');
      $('textarea.mob-desc').removeAttr('required');
    };
  };
  $(window).resize(function(){
    alterClass();
  });
  //Fire it when the page first loads:
  alterClass();
});
</script>