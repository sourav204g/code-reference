				document.addEventListener('DOMContentLoaded', function() {

				jQuery.ajax({

                    url: traveltadmin.ajax, // Change path
                    type: 'POST',
                    data: {
                        action: 'load_traveltographer_booking_details',
                        nonce: traveltadmin.nonce
                    },

                    success: function(response) {

                    	console.log(response);
                    	
                    	let booking = jQuery.parseJSON(response);

                    	// console.log(booking);

                    	var calendarEl = document.getElementById('calendar');

                    	var calendar = new FullCalendar.Calendar(calendarEl, {
                    	  initialView: 'dayGridMonth',
                    	  initialDate: '2022-11-07',
                    	  headerToolbar: {
                    	    left: 'prev,next today',
                    	    center: 'title',
                    	    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    	  },
                    	  events: booking
                    	});

                    	calendar.render();

                    },

                    error: function(error) {
                        console.log(error);
                    }

                });
			    
			  
			  });

			  jQuery('#wpbody-content .wrap h1').after(jQuery('#travelt_dashboard_calendar'));