jQuery(document).ready(function($) {
				
				$('#wpbody-content .wrap h1').after($('#handymanx_dashboard_calendar'));
				$('#wpbody-content .wrap h1').after($('#handymanx_dashboard_clear'));
				$('#wpbody-content .wrap h1').after($('#handymanx_dashboard_select'));

				res = $.parseJSON($('#dashboard__calendar_data').text());

				// console.log(res);

				let data = new Array();

				res.forEach(function(items, indexo){

					// let temp = items._start.split('T')[1];

					// console.log(items);

					if (items.total_time) {

						let _temp = moment(items._start).add(items.total_time[0], 'hours').format('HH:mm:ss');

						let _end = items._start.replace(items._start.split('T')[1], _temp); 

						// console.log(_end);

						data.push({
						          // title: item + ' ( Total Time: ' + displayHR + ' Hours ' + itemEndspiltMin + ' Minutes )',
						          // title: items.handyman_name + ' | Booking ID ( ' + items.booking_id + ' )',
						          title: 'Booking for ( ' + items.handyman_name + ' )',
						          start: items._start,
						          end: _end,
						          url: handymanx.root + '/wp-admin/post.php?post=' + items.booking_id + '&action=edit',
						});

					}

					
				
				});

		        // console.log(data);

				$('#handymanx_dashboard_calendar').fullCalendar({
						      header: {
						        left: 'prev,next today',
						        center: 'title',
						        right: 'month,agendaWeek,agendaDay,listWeek'
						      },
						      defaultDate: today,
						      // defaultView: 'agendaWeek',
						      navLinks: true, // can click day/week names to navigate views
						      editable: false,
						      eventLimit: true, // allow "more" link when too many events
						      events: data,
						      timeFormat: 'H(:mm)',
						      height: 460,
						      //aspectRatio: 1,
						      // defaultView: 'agendaWeek',
						      // eventColor: '#6e096f',
						      eventClick: function(event) { // REF - https://stackoverflow.com/questions/22128825/in-fullcalendar-when-clicking-on-an-event-with-an-associated-url
								    if (event.url) {
								        window.open(event.url, "_blank");
								        return false;
								    }
							  },
						   
				});

});