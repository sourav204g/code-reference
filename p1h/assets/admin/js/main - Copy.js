var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();

if (dd < 10) {
  dd = '0' + dd;
}

if (mm < 10) {
  mm = '0' + mm;
}

today = yyyy + '-' + mm + '-' + dd; // Today's Date


// https://stackoverflow.com/questions/29991291/jquery-on-does-not-work-in-wordpress-admin-panel
(function($){

				
				// on/off toggle for pros reviews
				$('.handyman-pro-switch > span').click(function(){
							$.ajax({

			                    url: handymanx.root + '/wp-admin/admin-ajax.php', // Change path
			                    type: 'POST',
			                    data: {
			                    	
			                        action: 'change_review_status',
			                        reviewID: $(this).data('review'),
			                        prosecure: handymanx.nonce
			                    },

			                    success: function(response) {
			                    	console.log(response);

			                    },

			                    error: function(error) {
			                        console.log(error);
			                    }

			                });
				});



				// Disable Autofill
				// Explanation: autocomplete continues work in <input>, autocomplete="off" does not work, but you can change off to a random string, like nope.
				$('[type="text"]').attr('autocomplete', 'nope');


				// Hide page loader icon after page load.
				$(window).on('load', function() { $('.loader_container').hide(); });

				// Rearrange saved Options on page load. - County Page
				$('[data-name="handyman_manage_county"] .acf-table tbody tr.acf-row').each(function(){

					let $self = $(this);

					let mng_cnty_cntry_selected = $self.find('[data-name="handyman_select_country"] .acf-input select').val();

					if( mng_cnty_cntry_selected !== '') {

						$self.find('[data-name="handyman_select_state"] .acf-input select option').each(function(){

							// console.log($(this).text().split(' | ')[0]);

							if( $(this).text().split(' | ')[0] !== '- Select -' ) {

								if( $(this).text().split(' | ')[0] === mng_cnty_cntry_selected ) {

									$(this).text($(this).text().split(' | ')[1]);

								} else {

									$(this).remove();

								}

							}

						});
					}

				});


				// Rearrange saved Options on page load. - State - County Page
				$('[data-name="handyman_manage_city"] .acf-table tbody tr.acf-row').each(function(){

					let $self = $(this);

					let mng_city_cntry_selected = $self.find('[data-name="handyman_select_country"] .acf-input select').val();

					if( mng_city_cntry_selected !== '') {

						$self.find('[data-name="handyman_select_state__city"] .acf-input select option').each(function(){

							// console.log($(this).text().split(' | ')[0]);

							if( $(this).text().split(' | ')[0] !== '- Select -' ) {

								if( $(this).text().split(' | ')[0] === mng_city_cntry_selected ) {

									$(this).text($(this).text().split(' | ')[1]);

								} else {

									$(this).remove();

								}

							}

						});
					}

				});


				// Rearrange saved Options on page load. - State - Zipcode Page
				$('[data-name="handyman_manage_zipcode"] .acf-table tbody tr.acf-row').each(function(){

					let $self = $(this);

					let mng_city_cntry_selected = $self.find('[data-name="handyman_select_country"] .acf-input select').val();

					if( mng_city_cntry_selected !== '') {

						$self.find('[data-name="handyman_select_state__city"] .acf-input select option').each(function(){

							// console.log($(this).text().split(' | ')[0]);

							if( $(this).text().split(' | ')[0] !== '- Select -' ) {

								if( $(this).text().split(' | ')[0] === mng_city_cntry_selected ) {

									$(this).text($(this).text().split(' | ')[1]);

								} else {

									$(this).remove();

								}

							}

						});
					}

				});

				// Rearrange saved Options on page load. - County - City Page
				$('[data-name="handyman_manage_city"] .acf-table tbody tr.acf-row').each(function(){

					let $self = $(this);

					let mng_city_cnty_selected = $self.find('[data-name="handyman_select_state__city"] .acf-input select').val();

					if( mng_city_cnty_selected !== '') {

						$self.find('[data-name="handyman_select_county__city"] .acf-input select option').each(function(){

							// console.log($(this).text().split(' | ')[0]);

							if( $(this).text().split(' | ')[0] !== '- Select -' ) {

								if( $(this).text().split(' | ')[0] === mng_city_cnty_selected ) {

									$(this).text($(this).text().split(' | ')[1]);

								} else {

									$(this).remove();

								}

							}

						});
					}

				});


				// Rearrange saved Options on page load. - County - Zipcode Page
				$('[data-name="handyman_manage_zipcode"] .acf-table tbody tr.acf-row').each(function(){

					let $self = $(this);

					let mng_city_cnty_selected = $self.find('[data-name="handyman_select_state__city"] .acf-input select').val();

					if( mng_city_cnty_selected !== '') {

						$self.find('[data-name="handyman_select_county__zipcode"] .acf-input select option').each(function(){

							// console.log($(this).text().split(' | ')[0]);

							if( $(this).text().split(' | ')[0] !== '- Select -' ) {

								if( $(this).text().split(' | ')[0] === mng_city_cnty_selected ) {

									$(this).text($(this).text().split(' | ')[1]);

								} else {

									$(this).remove();

								}

							}

						});
					}

				});


				// Rearrange saved Options on page load. - City - Zipcode Page
				$('[data-name="handyman_manage_zipcode"] .acf-table tbody tr.acf-row').each(function(){

					let $self = $(this);

					let mng_city_cnty_selected = $self.find('[data-name="handyman_select_county__zipcode"] .acf-input select').val();

					if( mng_city_cnty_selected !== '') {

						$self.find('[data-name="handyman_zip_city__zipcode"] .acf-input select option').each(function(){

							// console.log($(this).text().split(' | ')[0]);

							if( $(this).text().split(' | ')[0] !== '- Select -' ) {

								if( $(this).text().split(' | ')[0] === mng_city_cnty_selected ) {

									$(this).text($(this).text().split(' | ')[1]);

								} else {

									$(this).remove();

								}

							}

						});
					}

				});

				
				// Remove State Options to new items since the Country is not selected yet. - County Page
				$('body').on('click', '[data-name="handyman_manage_county"] a.acf-button.button.button-primary', function(){

					let mng_cnty_row_count = $('[data-name="handyman_manage_county"] .acf-table tbody tr.acf-row').length;

					$('[data-name="handyman_manage_county"] .acf-table tbody tr.acf-row:nth-child('+ mng_cnty_row_count +') [data-name="handyman_select_state"] .acf-input select').html('<option value="">- Select -</option>');

				});


				// Remove State Options to new items since the Country is not selected yet. - City Page
				$('body').on('click', '[data-name="handyman_manage_city"] a.acf-button.button.button-primary', function(){

					let mng_city_row_count = $('[data-name="handyman_manage_city"] .acf-table tbody tr.acf-row').length;

					$('[data-name="handyman_manage_city"] .acf-table tbody tr.acf-row:nth-child('+ mng_city_row_count +') [data-name="handyman_select_state__city"] .acf-input select').html('<option value="">- Select -</option>');
					$('[data-name="handyman_manage_city"] .acf-table tbody tr.acf-row:nth-child('+ mng_city_row_count +') [data-name="handyman_select_county__city"] .acf-input select').html('<option value="">- Select -</option>');

				});


				// Remove State Options to new items since the Country is not selected yet. - Zipcode Page
				$('body').on('click', '[data-name="handyman_manage_zipcode"] a.acf-button.button.button-primary', function(){

					let mng_city_row_count = $('[data-name="handyman_manage_zipcode"] .acf-table tbody tr.acf-row').length;

					$('[data-name="handyman_manage_zipcode"] .acf-table tbody tr.acf-row:nth-child('+ mng_city_row_count +') [data-name="handyman_select_state__city"] .acf-input select').html('<option value="">- Select -</option>');
					$('[data-name="handyman_manage_zipcode"] .acf-table tbody tr.acf-row:nth-child('+ mng_city_row_count +') [data-name="handyman_select_county__zipcode"] .acf-input select').html('<option value="">- Select -</option>');
					$('[data-name="handyman_manage_zipcode"] .acf-table tbody tr.acf-row:nth-child('+ mng_city_row_count +') [data-name="handyman_zip_city__zipcode"] .acf-input select').html('<option value="">- Select -</option>');

				});


				// Ajax call for loading State Dynamically 
                $('body').on('change', '[data-name="handyman_select_country"] select', function(){

                	let $self = $(this);

                	$.ajax({

	                    url: handymanx.root + '/wp-admin/admin-ajax.php', // Change path
	                    type: 'POST',
	                    data: {
	                        action: 'handyman_load_state',
	                        country: $self.val(),
	                        prosecure: handymanx.nonce
	                    },

	                    success: function(response) {

	                    	if(response !== '') {

	                    		$self.parent().parent().next().find('select').html('');
	                    		$self.parent().parent().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');

	                    		$self.parent().parent().next().next().find('select').html('');
	                			$self.parent().parent().next().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');

	                			$self.parent().parent().next().next().next().find('select').html('');
	                			$self.parent().parent().next().next().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');

	                    		let res = $.parseJSON(response);

	                    		res.forEach(function(item, index){

	                    			$self.parent().parent().next().find('select').append('<option value="' + item + '">' + item + '</option>');

	                    		});

	                    	} else {

	                    		$self.parent().parent().next().find('select').html('');
	                    		$self.parent().parent().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');

	                    		$self.parent().parent().next().next().find('select').html('');
	                			$self.parent().parent().next().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');

	                			$self.parent().parent().next().next().next().find('select').html('');
	                			$self.parent().parent().next().next().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');
	                    	}

	                    },

	                    error: function(error) {
	                        console.log(error);
	                    }

	                });

                });


                //

                // Ajax call for loading County Dynamically 
                $('body').on('change', '[data-name="handyman_select_state__city"] select', function(){

                	let $self = $(this);

                	$.ajax({

	                    url: handymanx.root + '/wp-admin/admin-ajax.php', // Change path
	                    type: 'POST',
	                    data: {
	                        action: 'handyman_load_county',
	                        country: $self.parent().parent().prev().find('.acf-input select').val(),
	                        state: $self.val(),
	                        prosecure: handymanx.nonce
	                    },

	                    success: function(response) {

	                    	if(response !== '') {

	                    		$self.parent().parent().next().find('select').html('');
	                    		$self.parent().parent().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');

	                    		$self.parent().parent().next().next().find('select').html('');
	                    		$self.parent().parent().next().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');

	                    		let res = $.parseJSON(response);

	                    		res.forEach(function(item, index){

	                    			$self.parent().parent().next().find('select').append('<option value="' + item + '">' + item + '</option>');

	                    		});

	                    	} else {

	                    		$self.parent().parent().next().find('select').html('');
	                    		$self.parent().parent().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');

	                    		$self.parent().parent().next().next().find('select').html('');
	                    		$self.parent().parent().next().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');
	                    	}

	                    },

	                    error: function(error) {
	                        console.log(error);
	                    }

	                });

                });


                // Ajax call for loading City Dynamically 
                $('body').on('change', '[data-name="handyman_select_county__zipcode"] select', function(){

                	let $self = $(this);

                	$.ajax({

	                    url: handymanx.root + '/wp-admin/admin-ajax.php', // Change path
	                    type: 'POST',
	                    data: {
	                    	
	                        action: 'handyman_load_city',
	                        country: $self.parent().parent().prev().prev().find('.acf-input select').val(),
	                        state: $self.parent().parent().prev().find('.acf-input select').val(),
	                        county: $self.val(),
	                        prosecure: handymanx.nonce
	                    },

	                    success: function(response) {

	                    	if(response !== '') {

	                    		$self.parent().parent().next().find('select').html('');
	                    		$self.parent().parent().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');

	                    		let res = $.parseJSON(response);

	                    		res.forEach(function(item, index){

	                    			$self.parent().parent().next().find('select').append('<option value="' + item + '">' + item + '</option>');

	                    		});

	                    	} else {

	                    		$self.parent().parent().next().find('select').html('');
	                    		$self.parent().parent().next().find('select').append('<option value="" selected="selected" data-i="0" class="">- Select -</option>');
	                    	}

	                    },

	                    error: function(error) {
	                        console.log(error);
	                    }

	                });

                });




               /* $( '#acf-field_5c5ecb8d8d419 + .hasDatepicker' ).datepicker({
						    format: 'mm/dd/yyyy',
						    // multidate : true,
						    startDate : '0d',
						    datesDisabled : ['20/07/2018'], // RFE - https://bootstrap-datepicker.readthedocs.io/en/stable/options.html#datesdisabled
						    // daysOfWeekDisabled : weekends
						    
				}); */






}(jQuery));

// Full Calendar - Post_Type: Pros
jQuery( document ).ready( function( $ ) {

		if ($('body').hasClass('post-type-pros')) {

			res = $.parseJSON($('#pro_handyman_fll_calendar_data').text());

			let data = new Array();

				if (res[0].service_name) {
		                    	
		        	res.forEach(function(items, indexo){

		        		items.service_name.forEach(function(item, indexi){

		        			let item_end = parseFloat(items.total_time[indexi]);

		        			item_end = parseFloat(item_end.toFixed(2)) + items.arrival_duration;

		        			let itemEndspilt = item_end.toString().split('.'); // split of hh.mm

		        			// console.log(item_end); // CHECK - PENDING 
		        			// console.log(parseInt(itemEndspilt[1]) >= 10); // CHECK - PENDING

		        			let itemEndspiltMin = '00';

		        			if (itemEndspilt[1]) {
		        				itemEndspiltMin = ( parseInt(itemEndspilt[1]) >= 10 ) ? itemEndspilt[1] : '0' + itemEndspilt[1];
		        			}                   			

		        			// console.log(itemEndspiltMin);

		        			let $_endDate = items._start.split('T')[0];
		        			let $_endTime = items._start.split('T')[1];

		        			let $_endTimeSplit = parseInt($_endTime.split(':')[0]); // Arrival time first digit.

		        			let $endTime = $_endTimeSplit + parseInt(itemEndspilt[0]);

		        			// console.log($_endTimeSplit + '-');
		        			// console.log(itemEndspilt[0] + '-');
		        			// console.log($endTime);

		        			let endTime;

		        			if ($endTime <= 23) {

		        				endTime = ($endTime >= 10 ) ? $endTime : '0' + $endTime; //  + ':' + itemEndspilt[1] + ':00'
		        				endTime = endTime  + ':' + itemEndspiltMin + ':00';

		        				data.push(
		                				{
								          title: item,
								          start: items._start,
								          end: $_endDate + 'T' + endTime,
								          url: handymanx.root + '/wp-admin/post.php?post=' + items.booking_id + '&action=edit',
								        }
		                		);


		        			} else {

		        				endTime = '23:00:00';

		        				let displayHR = parseInt(item_end) - parseInt(items.arrival_duration);
		        				// console.log(displayHR);
		        				// console.log(items.arrival_duration);

		        				// console.log(itemEndspiltMin);

		        				data.push(
		                				{
								          title: item + ' ( Total Time: ' + displayHR + ' Hours ' + itemEndspiltMin + ' Minutes )',
								          start: items._start,
								          end: $_endDate + 'T' + endTime,
								          url: handymanx.root + '/wp-admin/post.php?post=' + items.booking_id + '&action=edit',
								        }
		                		);

		        			}


		        			// console.log(endTime);


		        		});


		        	});

		        }



			// $('#pro_handyman_fll_calendar').fullCalendar('destroy'); // REF - https://fullcalendar.io/docs/destroy
        	$('#pro_handyman_fll_calendar').fullCalendar({
				      header: {
				        left: 'prev,next today',
				        center: 'title',
				        right: 'month,agendaWeek,agendaDay,listWeek'
				      },
				      defaultDate: today,
				      defaultView: 'agendaWeek',
				      navLinks: true, // can click day/week names to navigate views
				      editable: false,
				      eventLimit: true, // allow "more" link when too many events
				      events: data,
				      timeFormat: 'H(:mm)',
				      // defaultView: 'agendaWeek',
				      // eventColor: '#6e096f',
				      eventClick: function(event) { // REF - https://stackoverflow.com/questions/22128825/in-fullcalendar-when-clicking-on-an-event-with-an-associated-url
						    if (event.url) {
						        window.open(event.url, "_blank");
						        return false;
						    }
					  },
		});

        } // if post-type-pros

} );





// Pro Datepicker - Post_Type: Booking
jQuery( document ).ready( function( $ ) {

	var array = $('#xchandyman-off-dates').text(); // REF - https://stackoverflow.com/questions/15400775/jquery-ui-datepicker-disable-array-of-dates
	// console.log(array);

	let weekendsx = $.parseJSON($('#xchandyman-weekends').text());
	// console.log(weekendsx);

	let $datepicker = $( '#acf-field_5c5ecb8d8d419 + .hasDatepicker' );
	// $datepicker.datepicker('remove');
	$datepicker.datepicker( 'option', {
		minDate : new Date(), // REF - https://support.advancedcustomfields.com/forums/topic/datepicker-disable-selecting-future-dates/
		 beforeShowDay: function(date){
		 	// console.log(date);
	        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
	        // console.log(string);
	        var day = date.getDay(); // REF - https://stackoverflow.com/questions/44236542/disable-friday-and-saturday-in-datepicker
	        // REF - https://stackoverflow.com/questions/4376987/disable-all-sundays-in-jquery-ui-calendar
	        if ( weekendsx.indexOf('6') != -1 && weekendsx.indexOf('0') != -1 ) {
	        	// console.log('0 6');
	        	return [ array.indexOf(string) == -1 ];
	        }

	        if (weekendsx.indexOf('0') != -1) {
	        	// console.log('0');
	        	return [ array.indexOf(string) == -1 && day != 6 ];
	        }

	        if (weekendsx.indexOf('6') != -1) {
	        	// console.log('6');
	        	return [ array.indexOf(string) == -1 && day != 0 ];
	        }

	        return [ array.indexOf(string) == -1 && (day != 0 && day != 6 ) ];
	       
	    }, 
	} ).on('onchange', function(ev){ // http://dkconnects.com/demo01/handymanpro/handyman-pros/ 

			// console.log('asd');

		});

	
} );



function calling_hnd_bookings_func(data) {

			// console.log('sourav');

 			$('#handyman-full-calendar').fullCalendar('destroy'); // REF - https://fullcalendar.io/docs/destroy
        	$('#handyman-full-calendar').fullCalendar({
				      header: {
				        left: 'prev,next today',
				        center: 'title',
				        right: 'month,agendaWeek,agendaDay,listWeek'
				      },
				      defaultDate: today,
				      navLinks: true, // can click day/week names to navigate views
				      editable: false,
				      eventLimit: true, // allow "more" link when too many events
				      events: data,
				      timeFormat: 'H(:mm)',
				      // defaultView: 'agendaWeek',
				      // eventColor: '#6e096f',
				      eventClick: function(event) { // REF - https://stackoverflow.com/questions/22128825/in-fullcalendar-when-clicking-on-an-event-with-an-associated-url
						    if (event.url) {
						        window.open(event.url, "_blank");
						        return false;
						    }
					  },
		});


 }


 jQuery( document ).ready( function( $ ) {

		// Ajax call for loading State Dynamically 
        $('body').on('change', '[data-name="hnd_schedule_handyman"] select', function(){

        			// console.log('dashboard-handyman-list');

        			$( '#acf-field_5c5ecb8d8d419 + .hasDatepicker' ).css({
		        		'opacity' : '0.5',
		        		'pointer-events' : 'none',
		        		
		        	});

        			$.ajax({

	                    url: handymanx.root + '/wp-admin/admin-ajax.php', // Change path
	                    type: 'POST',
	                    data: {
	                    	
	                        action: 'load_hnd_booking_details',
	                        proID: $(this).val(),
	                        prosecure: handymanx.nonce
	                    },

	                    success: function(response) {

	                    	// console.log(response);
	                    	
	                    	let res = $.parseJSON(response);

	                    	// console.log(res);



	                    	// console.log(res[0].pro_off_dates);
	                    	$('#xchandyman-off-dates').text(JSON.stringify(res[0].pro_off_dates));
	                    	$('#xchandyman-weekends').text(JSON.stringify(res[0].pro_weekends));

	                    	let data = new Array();

	                    	if (res[0].service_name) {
	                    	
		                    	res.forEach(function(items, indexo){

		                    		items.service_name.forEach(function(item, indexi){

		                    			let item_end = parseFloat(items.total_time[indexi]);

		                    			item_end = parseFloat(item_end.toFixed(2)) + items.arrival_duration;

		                    			let itemEndspilt = item_end.toString().split('.'); // split of hh.mm

		                    			let itemEndspiltMin = '00';

		                    			if (itemEndspilt[1]) {
		                    				itemEndspiltMin = ( parseInt(itemEndspilt[1]) >= 10 ) ? itemEndspilt[1] : '0' + itemEndspilt[1];
		                    			}                   			

		                    			// console.log(itemEndspiltMin);

		                    			let $_endDate = items._start.split('T')[0];
		                    			let $_endTime = items._start.split('T')[1];

		                    			let $_endTimeSplit = parseInt($_endTime.split(':')[0]); // Arrival time first digit.

		                    			let $endTime = $_endTimeSplit + parseInt(itemEndspilt[0]);

		                    			// console.log($_endTimeSplit + '-');
		                    			// console.log(itemEndspilt[0] + '-');
		                    			// console.log($endTime);

		                    			let endTime;

		                    			if ($endTime <= 23) {

		                    				endTime = ($endTime >= 10 ) ? $endTime : '0' + $endTime; //  + ':' + itemEndspilt[1] + ':00'
		                    				endTime = endTime  + ':' + itemEndspiltMin + ':00';

		                    				data.push(
				                    				{
											          title: item,
											          start: items._start,
											          end: $_endDate + 'T' + endTime,
											          url: handymanx.root + '/wp-admin/post.php?post=' + items.booking_id + '&action=edit',
											        }
				                    		);


		                    			} else {

		                    				endTime = '23:00:00';

		                    				let displayHR = item_end - parseInt(items.arrival_duration);
		                    				// console.log(displayHR);

		                    				data.push(
				                    				{
											          title: item + ' ( Total Time: ' + displayHR + ' Hours ' + itemEndspiltMin + ' Minutes )',
											          start: items._start,
											          end: $_endDate + 'T' + endTime,
											          url: handymanx.root + '/wp-admin/post.php?post=' + items.booking_id + '&action=edit',
											        }
				                    		);

		                    			}


		                    			// console.log(endTime);


		                    		});


		                    	});

	                    	} // if res[0].service_name


	                 		// console.log(data);

	                    	calling_hnd_bookings_func(data);

	                    },

	                    error: function(error) {
	                        console.log(error);
	                    }

	                });

        	

        	$( '#acf-field_5c5ecb8d8d419 + .hasDatepicker' ).val('');
        	$( '#acf-field_5c5ecb8d8d419' ).val('');
        	$( '#acf-field_5c5ecb8d8d419' ).attr('value', '');
        	$( '#acf-field_5c5ecb8d8d419 + .hasDatepicker' ).attr('value', '');


        	setTimeout(function() {
			  // console.log($('#xchandyman-off-dates').text());
	        	var array = $('#xchandyman-off-dates').text(); // REF - https://stackoverflow.com/questions/15400775/jquery-ui-datepicker-disable-array-of-dates

	        	let weekendsx = $.parseJSON($('#xchandyman-weekends').text());

				let $datepicker = $( '#acf-field_5c5ecb8d8d419 + .hasDatepicker' );
				// $datepicker.datepicker('remove');
				$datepicker.datepicker( 'option', {
					minDate : new Date(), // REF - https://support.advancedcustomfields.com/forums/topic/datepicker-disable-selecting-future-dates/
					beforeShowDay: function(date){
						console.log(date);
				        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);

				        var day = date.getDay(); // REF - https://stackoverflow.com/questions/44236542/disable-friday-and-saturday-in-datepicker
				        // REF - https://stackoverflow.com/questions/4376987/disable-all-sundays-in-jquery-ui-calendar
				        if ( weekendsx.indexOf('6') != -1 && weekendsx.indexOf('0') != -1 ) {
				        	// console.log('0 6');
				        	return [ array.indexOf(string) == -1 ];
				        }

				        if (weekendsx.indexOf('0') != -1) {
				        	// console.log('0');
				        	return [ array.indexOf(string) == -1 && day != 6 ];
				        }

				        if (weekendsx.indexOf('6') != -1) {
				        	// console.log('6');
				        	return [ array.indexOf(string) == -1 && day != 0 ];
				        }

				        return [ array.indexOf(string) == -1 && (day != 0 && day != 6 ) ];
				        
				    }, 
				} );

				$( '#acf-field_5c5ecb8d8d419 + .hasDatepicker' ).removeProp('style');

			}, 1000);

        	
        	

        	


        	/* $('#handyman-full-calendar').fullCalendar('destroy'); // REF - https://fullcalendar.io/docs/destroy
        	$('#handyman-full-calendar').fullCalendar({
				      header: {
				        left: 'prev,next today',
				        center: 'title',
				        right: 'month,agendaWeek,agendaDay,listWeek'
				      },
				      defaultDate: today,
				      navLinks: true, // can click day/week names to navigate views
				      editable: true,
				      eventLimit: true, // allow "more" link when too many events
				      events: data
			}); */


        });

        let stringAvaDates = $('.availability-data').text(); // The whole section is not needed now.
		let stringAvaDatesArray = Object.values($.parseJSON(stringAvaDates)); // REF - https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_objects/Object/values

		// console.log(stringAvaDatesArray);

		stringAvaDatesArray.forEach(function(item, index){
				$('#acf-field_5c5ecbcc8d41a').find('[value="' + item + '"]').attr('disabled', 'disabled');
		});

});


 // REF - https://www.advancedcustomfields.com/resources/javascript-api/
 // REF - https://support.advancedcustomfields.com/forums/topic/how-to-trigger-on-close-datepicker-event/
 var start_date_key = 'field_5c5ecb8d8d419';
 acf.add_action('date_picker_init', function( $input, args, field ){
    	
    	$input.datepicker().on('change', function (e) {

    		let $self = $(this);

    		let bProID = $('#acf-field_5c5ecafa36252').val();

             $.ajax({

                url: handymanx.root + '/wp-admin/admin-ajax.php', // Change path
                type: 'POST',
                data: {
                    action: 'handyman_load_date_time',
                    proID: bProID,
                    proSDate: $self.val(),
                    prosecure: handymanx.nonce
                },

                success: function(response) {              	

                	let res = $.parseJSON(response);

                	$('#acf-field_5c5ecbcc8d41a').find('option').removeAttr('disabled');

                	res.forEach(function(item, index){ $('#acf-field_5c5ecbcc8d41a').find('[value="' + item + '"]').attr('disabled', 'disabled'); });

                },

                error: function(error) {
                    console.log(error);
                }

            }); 


        });

 });