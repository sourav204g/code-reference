

  <!-- Modal -->
  <div class="modal" id="customize-it">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="customize-itLabel">Customize Your Service</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">

            <form method="post" enctype="multipart/form-data" name="handyman_popup_form">
              <div class="row">
                <div class="col-md-6">
                  
                  
                      <?php wp_nonce_field('waiting_for_avengers_4_trailer', 'handyman_pro_nonce'); ?>

                      <input type="hidden" name="handymn_hasno_option_values" value=''>
                      <input type="hidden" name="handymn_service_id" value="custom">
                      
                      <input type="hidden" name="handymn_service_featured_img" value="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png">
                      
                      <textarea class="form-control custom-description" name="handymn_service_comments" placeholder="If you couldn't find the service you are looking for, you can custom describe it here and name a fair price that you think is worth to pay for this service." style="min-height:115px; background: #e1e1e1; " required></textarea>

                      <div class="input-group showanswer">
                             <span class="mob-input-text">Enter the $ amount you want to pay</span>   
                          <span class="mob-dollar-txt">$</span><input type="number" placeholder="Enter the $ amount you want to pay" name="handymn_custom_price" required class="form-control border-right-0"><span class="mob-mat-txt"> + Mat</span>
                          <a data-target="#showquestion" data-toggle="modal" href="#"><span><i class="fa fa-question-circle"></i></span></a>

                      </div>


                      <div class="clearfix"></div>
                      <div style="margin-top: 18px;">
                  

                            <div style="width: 100%">

                             <h3><b>Upload Pictures </b><span style="font-size: 18px;"> (Optional)</span></h3>
                              <hr/>
                                <div class="clearfix"></div>

                                <div class="add-ph">

                                <label for="add19" style="padding-left:0px !important;">
                                <input id="add19" name="filename[]" type='file' onchange="readURL(this);" style="display:none;" />
                                  <img id="add-photo91" src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/add-photo.jpg" alt="Add a Photo" style="width: 100%;  border-radius:4px; " />
                                 <span class="popupcloseimg" style="display:none;"><i class="fa fa-trash-o" aria-hidden="true"></i></span> 
                                </label>
                                </div>
                                 <div class="add-ph">
                                <label for="add29" style="padding-left:0px !important;">
                                  <input id="add29" name="filename[]" type='file' onchange="readURL2(this);" style="display:none;" />
                                  <img id="add-photo92" src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/add-photo.jpg" alt="Add a Photo" style="width: 100%;  border-radius:4px; " />
                                  <span class="popupcloseimg2" style="display:none;"><i class="fa fa-trash-o" aria-hidden="true"></i></span> 
                                </label></div>

                                <div class="add-ph" style="margin-right:0px;">
                                <label for="add39" style="padding-left:0px !important;">
                                  <input id="add39" name="filename[]" type='file' onchange="readURL3(this);" style="display: none;" />
                                  <img id="add-photo93" src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/add-photo.jpg" alt="Add a Photo" style="width: 100%; border-radius:4px; " />
                                  <span class="popupcloseimg3" style="display:none;"><i class="fa fa-trash-o" aria-hidden="true"></i></span> 
                                </label>
                                </div>
                                  
                              </div>
                              <div class="clearfix"></div>
                              <div class="row close-btn-row">
                                <div class="col-md-6 col-6" style="padding-left: 0; padding-right: 0;">
                                    <button aria-label="Close" class="close customize-it-footer-close" data-dismiss="modal" type="button">Cancel<span aria-hidden="true">&times;</span></button>
                                </div>
                            
                                <div class="col-md-6 col-6" style="padding-left: 0; padding-right: 0;">
                            <button class="add-to-cart" type="submit" name="submit_for_scheduling" id="submit_for_scheduling_" style="font-family: 'Lato', sans-serif; font-size:21px !important; padding: 12px 20px; width: 100%; ">SUBMIT</span></button>
                            </div>
                            </div>

                    </div>

                </div>
                <div class="col-md-6 customize-popup-img-sec">
                  <img src="https://handymanproservices.com/wp-content/themes/handyman_pro/assets/images/customservice.png" style="width: 100%;" />
                </div>
              </div>

              <!-- <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancel</button>
            <button class="btn btn-secondary" type="submit" name="submit_for_scheduling" id="submit_for_scheduling_">Done</button>
          </div> -->
            </form>
        </div>
        


      </div>
    </div>
  </div><!-- Modal -->
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

  .cus89 input {
    padding: 18px 16px !important;
}

  .modal-body h3{
    font-size: 19px !important;
  }

</style>   
  <script type="text/javascript">
  function readURL(input) {
            if (input.files && input.files[0]) {
                 console.log(input.files);
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#add-photo91')
                        .attr('src', e.target.result);
                        $(".popupcloseimg").show();
                };
                reader.readAsDataURL(input.files[0]);
            }
            $(".popupcloseimg").click(function(e){
                e.preventDefault();
                $('#add-photo91').attr('src', '<?php bloginfo('template_directory'); ?>/assets/images/add-photo.jpg');
                $('#add19').val('');
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
                    $('#add-photo92')
                        .attr('src', e.target.result);
                        $(".popupcloseimg2").show();
                };

                reader.readAsDataURL(input.files[0]);
            }
            $(".popupcloseimg2").click(function(e){
                e.preventDefault();
                $('#add-photo92').attr('src', '<?php bloginfo('template_directory'); ?>/assets/images/add-photo.jpg');
                $('#add29').val('');
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
                    $('#add-photo93')
                        .attr('src', e.target.result);
                        $(".popupcloseimg3").show();
                };

                reader.readAsDataURL(input.files[0]);
            }
            $(".popupcloseimg3").click(function(e){
                e.preventDefault();
                $('#add-photo93').attr('src', '<?php bloginfo('template_directory'); ?>/assets/images/add-photo.jpg');
                $('#add39').val('');
                $(".popupcloseimg3").hide();
                return true;
            }); 
        }
</script> 