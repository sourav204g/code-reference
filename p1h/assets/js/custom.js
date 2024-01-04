$(function(){

      let opVal = Array();
      let suVal = Array();

      let opValval = Array();
      let suValval = Array();

      let opVis = Array();

      // var allOptInput = $('.ques-group-container > .ques-group > .ques > .ptag > input');

      // Addon-Services 
      $('.ques-group-container > .ques-group > .ques > .ptag > input').click(function(){

                // PENDING --- 

              /*  let chkoptVal = $('[name="handymn_service_opt"]').val();

                if (chkoptVal !== '') {
                  chkoptVal = JSON.parse(chkoptVal);
                  console.log(chkoptVal);
                } */


                $self = $(this);

                let classes = $self.parent().parent().attr('class').split(' ');
                let classType = classes[2];
                let okey = $self.data('key');


                // console.log('CLICKED');
                // console.log(okey);

                let visibility = $self.data('visibility') || 'show';

                $self.parent().parent().parent().find('.has_sub_option .ptag .sub-options').css('display', 'none');
                $self.parent().parent().find('.sub-options input').removeAttr('checked');
                $self.parent().parent().find('.sub-options [data-ty="hnd_qty"]').val('0');

                
                opVis[okey] = visibility;

                opVal[okey] = classType + '|' + $(this).attr('id');
                suVal[okey] = '';

                // console.log(opVal);

                if( $self.data('multiply') == true ) { // 3-Oct-2019
                  opValval[okey] = $(this).val() + '|m';
                } else {
                  opValval[okey] = $(this).val();
                }              

                
                suValval[okey] = '';

                // opVal[okey] = opVal[okey].split('+').filter(Boolean); // DELETE THIS COMMENTED LINE.

                $('[name="handymn_service_opt_visibility"]').val(JSON.stringify(opVis));

                $('[name="handymn_service_opt"]').val(JSON.stringify(opVal));
                $('[name="handymn_service_sub"]').val(JSON.stringify(suVal));


                $('[name="handymn_service_opt_val"]').val(JSON.stringify(opValval));
                $('[name="handymn_service_sub_val"]').val(JSON.stringify(suValval));


                if( $(this).parent().parent().hasClass('has_sub_option') ) {
                        $(this).siblings('.sub-options').css('display', 'block');
                } else {     
                    //do nothing.
                }

      });

      // Addon-Sub-Services 
      $('.has_sub_option .sub-options input').on('click keyup focus', function(){

                /* let chkoptVal = $('[name="handymn_service_opt"]').val();

                if (chkoptVal !== '') {
                  chkoptVal = JSON.parse(chkoptVal);
                  console.log(chkoptVal);
                } */

                let skey = $(this).parents('.has_sub_option').find('.ptag > input').data('key');
                suVal[skey] = $(this).attr('id');

                if( typeof $(this).data('ty') !== undefined ) {

                      if( $(this).data('ty') === 'hnd_qty') {
                          suValval[skey] = $(this).data('ty') + '|' + $.trim($(this).data('cap').replace(/[\t\n]+/g,' ')) + '|' + $(this).val() + '|' + $(this).data('min') + '|' + $(this).data('material');
                      } else {

                          if ($(this).data('ty') === 'hnd_yesno') {
                            suValval[skey] = $(this).data('ty') + '|' + $.trim($(this).data('cap').replace(/[\t\n]+/g,' ')) + '|' + $(this).val();
                          } else {
                            suValval[skey] = $(this).data('ty') + '|' + $.trim($(this).parents('.ptagq').find('span.subtext').text().replace(/[\t\n]+/g,' ')) + '|' + $(this).val();
                          }
                          
                      }

                } else {
                    suValval[skey] = $.trim($(this).parents('.ptagq').find('span.subtext').text().replace(/[\t\n]+/g,' ')) + '|' + $(this).val();
                }

                $('[name="handymn_service_sub"]').val(JSON.stringify(suVal));
                $('[name="handymn_service_sub_val"]').val(JSON.stringify(suValval));

      });


      // quantity text field.
      $('[data-ty="hnd_qty"]').on('keyup change', function(){


          let adon_original_price = $(this).parents('.ptag').find('label [data-prc]').data('prc');
          let adon_labour_minute = $(this).data('min');

          let hndyx_per_min_cost = parseFloat( $('[name="handymn_per_min_cost"]').val() );

          let OPTqtyCost = hndyx_per_min_cost * parseInt($(this).val()) * adon_labour_minute;

          let premium = 0;
          let premiumCost = 0;

          if ($(this).data('premium')) {
            premium = parseInt($(this).data('premium'));
            premiumCost = OPTqtyCost * premium / 100;
          }

          OPTqtyCost = OPTqtyCost + premiumCost;

          let discount = 0;
          let discountCost = 0;

          if ($(this).data('discount')) {
            discount = parseInt($(this).data('discount'));
            discountCost = OPTqtyCost * discount / 100;
          }

          OPTqtyCost = OPTqtyCost - discountCost;


          let adon_qty_material  = $(this).data('material') * parseInt($(this).val());

          // console.log(adon_labour_minute, hndyx_per_min_cost);

          if( $(this).val() !== 0 && $(this).val() !== '' ) {



            let calulated_min_cost = adon_original_price +  OPTqtyCost  + adon_qty_material;
            $(this).parents('.ptag').find('label [data-prc]').text(calulated_min_cost.toFixed(2));      

          } else {

             $(this).parents('.ptag').find('label [data-prc]').text(adon_original_price);

          }

      });


      // yes radio button
      $('[data-yes="yes"]').on('click', function(){

          let adon_original_price = $(this).parents('.ptag').find('label [data-prc]').data('prc');
          let adon_labour_minute = $(this).attr('value');
          let hndyx_per_min_cost = parseFloat( $('[name="handymn_per_min_cost"]').val() );

          let OPTYesCost = hndyx_per_min_cost * parseInt(adon_labour_minute.split('|')[0]);

          let premium = 0;
          let premiumCost = 0;

          if ($(this).data('premium')) {
            premium = parseInt($(this).data('premium'));
            premiumCost = OPTYesCost * premium / 100;
          }

          OPTYesCost = OPTYesCost + premiumCost;

          let discount = 0;
          let discountCost = 0;

          if ($(this).data('discount')) {
            discount = parseInt($(this).data('discount'));
            discountCost = OPTYesCost * discount / 100;
          }

          OPTYesCost = OPTYesCost - discountCost;

          let calulated_min_cost = adon_original_price + OPTYesCost + parseFloat(adon_labour_minute.split('|')[1]);
          $(this).parents('.ptag').find('label [data-prc]').text(calulated_min_cost.toFixed(2));




      });

      // no radio button
      $('[data-yes="no"]').on('click', function(){

          let adon_original_price = $(this).parents('.ptag').find('label [data-prc]').data('prc');
          let adon_labour_minute = $(this).attr('value');
          let hndyx_per_min_cost = parseFloat( $('[name="handymn_per_min_cost"]').val() );

          $(this).parents('.ptag').find('label [data-prc]').text(adon_original_price);

      });


      function minTommss(minutes) {
       var sign = minutes < 0 ? "-" : "";
       var min = Math.floor(Math.abs(minutes));
       var sec = Math.floor((Math.abs(minutes) * 60) % 60);
       return sign + (min < 10 ? "0" : "") + min + ":" + (sec < 10 ? "0" : "") + sec;
      }

      const convertMinsToHrsMins = (mins) => {
        let h = Math.floor(mins / 60);
        let m = mins % 60;
        h = h < 10 ? '0' + h : h; // (or alternatively) h = String(h).padStart(2, '0')
        m = m < 10 ? '0' + m : m; // (or alternatively) m = String(m).padStart(2, '0')
        return `${h}:${m}`;
      }

      var opArr = Array();
      var sopArr = Array();

      // Remove Items
      $(document).on('click', '.ybs-list--condensed i.fa.fa-trash-o', function(){

          let h_regex = /[+-]?\d+(\.\d+)?/g;

          let total_p = $('.hndy_total_price').text().trim();
          total_p = parseFloat(total_p.match(h_regex)[0]);

          let price = $(this).prev().text().trim();

          price = parseFloat(price.match(h_regex)[0]);

          total_p = total_p - price; // 

          // console.log(total_p);
          // console.log(price);

          let op = $(this).prev().data('op');
          let sop = $(this).prev().data('sop');

          let length = $('.ybs-list--condensed > li').length;

          let time = $('.hn_service_com_time').text().split(' ')[0];

          console.log(time);

          if (time.includes('.')) {
            time = minTommss(time);
          }

          console.log(time);

          let tl_min = moment.duration(time).asMinutes();

          console.log(tl_min);

          let de_min = 0;

          if (op) {

            let option = $('[name="handymn_service_opt"]').val();

            option = JSON.parse(option);

            let index = option.indexOf(op);

            if( index !== -1 ) {
              opArr[index] = op;
            }

            $('[name="handymn_service_opt_deleted"]').val(JSON.stringify(opArr));

            // option = option.replace(op, op + '|deleted');
            // $('[name="handymn_service_opt"]').val(option);

            if ($('.ybs-list--condensed > li').length < 4) {
              $(this).parents('li.ybs-list-item').fadeOut('slow', function(){ $(this).remove(); });
              $('.opt-cap').remove();
            } else {
              $(this).parents('li.ybs-list-item').fadeOut('slow', function(){ $(this).remove(); });
            }

          }

          if (sop) {

            let sub_option = $('[name="handymn_service_sub"]').val();

            sub_option = JSON.parse(sub_option);

            let index = sub_option.indexOf(sop);

            if( index !== -1 ) {
              sopArr[index] = sop;
            }

            $('[name="handymn_service_sub_deleted"]').val(JSON.stringify(sopArr));
            

            if ($('.ybs-list--condensed > li').length < 4) {
                $(this).parents('li.hnd-child').fadeOut('slow', function(){ $(this).remove(); });
                $('.opt-cap').remove();
            } else {
                 $(this).parents('li.hnd-child').fadeOut('slow', function(){ $(this).remove(); });
            }

            
          }

          de_min = parseInt($(this).prev().data('omin')) || 0;

          tl_min = tl_min - de_min;

          tl_min = convertMinsToHrsMins(tl_min);

          $('.hn_service_com_time').text(tl_min + ' Hours');

          $('.hndy_total_price').text('$' + total_p.toFixed(2) + ' USD');

          // console.log(op, sop);

          /* const mutationObserver = new MutationObserver( entries => {
              console.log(entries);
            
          });

          const courses = document.querySelector('.ybs-list--condensed');

          mutationObserver.observe(courses, {childList: true, subtree: true});

          setTimeout(() => {
            console.log("Delayed for 1 second.");
            // mutationObserver.disconnect();
          }, "1000"); */

          

      });


  // Delete Schedule Time
  $('.timeRemove').click( function() { 

    if(confirm("Confirm your action!")) {

      $(this).parent().remove();

      let tlength = $('.pro_schedule_time_ul li').length;

      if(tlength === 0) {
          $('[name="edit_pro_schedule_time"]').val('');
      }

            $.ajax({

                      url: zipobg.root + '/wp-admin/admin-ajax.php', // Change path
                      type: 'POST',
                      data: {
                          action: 'deletetimeschedule',
                          data: { 'index' : $(this).parent().data('timeindex'), 'value' : $(this).prev().text() },
                          security: zipobg.nonce,
                      },
                      success: function(response) {
                          alert(response); // needed.
                          console.log(response);
                      },
                      error: function(error) {
                          console.log(error);
                      }

            });


    }
    
  });

  // Add Schedule Time
  $('body').on('click', '.btplus.time-schedule', function(){

          let from = $('[name="edit_pro_from"]').val();
          let to = $('[name="edit_pro_to"]').val();

          if(from !== '' && to !== '') {

                // console.log(zipobg.root);
                // console.log(zipobg.nonce);

                $.ajax({

                    url: zipobg.root + '/wp-admin/admin-ajax.php', // Change path
                    type: 'POST',
                    data: {
                        action: 'addtimeschedule',
                        data: from + '-' + to,
                        security: zipobg.nonce,
                    },
                    success: function(response) {
                        console.log(typeof response);
                        if(response !== '0') {
                          let time = JSON.parse(response);
                          $('.pro_schedule_time_ul').append('<li class="addedTag" data-time="' + time.pro_schedule_time_from + '-' + time.pro_schedule_time_to + '">' + time.pro_schedule_time_from + '-' + time.pro_schedule_time_to + ' <span class="tagRemove timeRemove">x</span></li>');
                          $('[name="edit_pro_schedule_time"]').val(time.pro_schedule_time_from + '-' + time.pro_schedule_time_to);
                          //location.reload(); 
                        } else {
                          alert('Error: The time is Overlapping. Please try again.');
                          $('.time-row .timepicker-f').val('');
                        }
                        
                        
                    },
                    error: function(error) {
                        console.log(error);
                    }

                });

          } else {
            alert('Enter Schedule Time!');
          }

   
  });

  let QRstring = new URLSearchParams(window.location.search);

  if(QRstring.get('status') === 'success') {
    setInterval(function(){ $('p.success').hide(); }, 1000);
  }


	$('.zipRemove').click( function() { 

		if(confirm("Confirm your action!")) {

			$(this).parent().remove();

			      $.ajax({

                      url: zipobg.root + '/wp-admin/admin-ajax.php', // Change path
                      type: 'POST',
                      data: {
                          action: 'deletezipcode',
                          data: $(this).parent().data('zip'),
                          security: zipobg.nonce,
                      },
                      success: function(response) {
                          alert(response); // needed.
                          console.log(response);
                          // window.location = domainPath.root + '/thank-you/?' + jQuery.param( returnObj );
                      },
                      error: function(error) {
                          console.log(error);
                      }

            });



		}
		
	});


  $('.sub-options label').on('click', function(){
      $('.sub-options label.check').removeClass('check');
      $(this).addClass('check');
  });


  // Mobile Navigation
  if ($('.nav-menu').length) {
    var $mobile_nav = $('.nav-menu').clone().prop({
      class: 'mobile-nav d-lg-none'
    });
    $('.mob-menu-area').append($mobile_nav);
    $('.mob-menu-area').prepend('<button type="button" class="mobile-nav-toggle d-lg-none"><i class="fa fa-bars"></i></button>');
    $('.mob-menu-area').append('<div class="mobile-nav-overly"></div>');

    $(document).on('click', '.mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('.mobile-nav-toggle i').toggleClass('menu-close');
      $('.mobile-nav-overly').toggle();
    });

    $(document).on('click', '.mobile-nav .menu-item-has-children > a', function(e) {
      e.preventDefault();
      $(this).next().slideToggle(300);
      $(this).parent().toggleClass('active');
    });

    $(document).click(function(e) {
      var container = $(".mobile-nav, .mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('.mobile-nav-toggle i').toggleClass('menu-close');
          $('.mobile-nav-overly').fadeOut();
        }
      }
    });
  } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
    $(".mobile-nav, .mobile-nav-toggle").hide();
  }


});