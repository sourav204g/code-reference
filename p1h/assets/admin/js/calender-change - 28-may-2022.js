jQuery(document).ready(function($) {

	$('body').on('change', '#handymanx_dashboard_select', function(){

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

		                    	console.log(res);

		                    	// console.log(res[0].pro_off_dates);
		                    	$('#xchandyman-off-dates').text(JSON.stringify(res[0].pro_off_dates));
		                    	$('#xchandyman-weekends').text(JSON.stringify(res[0].pro_weekends));

		                    	let data = new Array();

		                    	if (res[0].total_time) {

        		                    	res.forEach(function(items, indexo){

        		                    		let total = 0;

        		                    		items.total_time.forEach(function(it){
        		                    			total += it;
        		                    		});

        									// let temp = items._start.split('T')[1];

        									let _temp = moment(items._start).add(total, 'hours').format('HH:mm:ss');

        									let _end = items._start.replace(items._start.split('T')[1], _temp); 

        									// console.log(_end);

        									data.push({
        									          // title: item + ' ( Total Time: ' + displayHR + ' Hours ' + itemEndspiltMin + ' Minutes )',
        									          // title: items.handyman_name + ' | Booking ID ( ' + items.booking_id + ' )',
        									          title: 'Booking ID ( ' + items.booking_id + ' )',
        									          start: items._start,
        									          end: _end,
        									          url: handymanx.root + '/wp-admin/post.php?post=' + items.booking_id + '&action=edit',
        									        });
        								});

		                    	}

		                 		// console.log(data);

		                    	// calling_hnd_bookings_func_dashboard(data);
		                    	$('#handymanx_dashboard_calendar').fullCalendar('destroy'); // REF - https://fullcalendar.io/docs/destroy
					        	$('#handymanx_dashboard_calendar').fullCalendar({
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
									      height: 460,
									      // eventColor: '#6e096f',
									      eventClick: function(event) { // REF - https://stackoverflow.com/questions/22128825/in-fullcalendar-when-clicking-on-an-event-with-an-associated-url
											    if (event.url) {
											        window.open(event.url, "_blank");
											        return false;
											    }
										  },
								});

		                    },

		                    error: function(error) {
		                        console.log(error);
		                    }

		                });
			 			
	});

});