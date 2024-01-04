$(function(){

      let opVal = Array();
      let suVal = Array();

      // Addon-Services 
      $('.ques-group-container > .ques-group > .ques > .ptag > input').click(function(){

              $self = $(this);

              let classes = $self.parent().parent().attr('class').split(' ');
              let classType = classes[2];
              let okey = $self.data('key');

              $self.parent().parent().parent().find('.has_sub_option .ptag .sub-options').css('display', 'none');
              $self.parent().parent().find('.sub-options input').removeAttr('checked');

              opVal[okey] = classType + '|' + $(this).attr('id');
              suVal[okey] = '';

              // opVal[okey] = opVal[okey].split('+').filter(Boolean);

              $('[name="handymn_service_opt"]').val(JSON.stringify(opVal));
              $('[name="handymn_service_sub"]').val(JSON.stringify(suVal));

              if( $(this).parent().parent().hasClass('has_sub_option') ) {
                      $(this).siblings('.sub-options').css('display', 'block');
              } else {     

              }

      });

      $('.has_sub_option .sub-options input').click( function(){

          let skey = $(this).parents('.has_sub_option').find('.ptag > input').data('key');
          suVal[skey] = $(this).attr('id');
          // console.log(suVal);
          $('[name="handymn_service_sub"]').val(JSON.stringify(suVal));
          
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


});