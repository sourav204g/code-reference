jQuery(function($) {
	$(document).on('click', '.email-confirmation-resend', function() {

						let urlParams = new URLSearchParams(window.location.search);

						let post = urlParams.get('post');

						let self = $(this);

						$.ajax({

		                    url: travelt.root + '/wp-admin/admin-ajax.php', // Change path
		                    type: 'POST',
		                    data: {
		                    	
		                        action: 'resend_confirmation_email',
		                        id: post,
		                        nonce: travelt.nonce
		                    },

		                    success: function(response) {
									if (response == 1) {

										self.parent().append("<em class='rcm-status'>Email Sent.</em>");
										self.remove();

									}	                    	

		                    },

		                    error: function(error) {
		                        console.log(error);
		                    }

		                });
		
	});

	$('#locationschecklist li').each(function(){
			
				$('#locationschecklist li').find('input[type="checkbox"]').not('input:checked').parents('li').css({ 'pointer-events' : 'none', 'opacity' : '0.2' });
				
	});


	$(document).on('change', '#locationschecklist input[type="checkbox"]', function() {

		if ($(this).is(':checked')) {

			let id = $(this).val();

				$.ajax({

                    url: travelt.root + '/wp-admin/admin-ajax.php', // Change path
                    type: 'POST',
                    data: {
                    	
                        action: 'load_cities_by_country',
                        id: id,
                        nonce: travelt.nonce
                    },

                    success: function(response) {
                    	// console.log(JSON.parse(response));
						$('#acf-field_635a9806377ad').html();
						$('#acf-field_635a9806377ad').html(response);
                    },

                    error: function(error) {
                        console.log(error);
                    }

                });

			$('#locationschecklist li').each(function(){
			
				$('#locationschecklist li').find('input[type="checkbox"]').not('input:checked').parents('li').css({ 'pointer-events' : 'none', 'opacity' : '0.2' });
				
			});

		} else {

			$('#locationschecklist li').removeAttr('style');
		}

		/* let checked = false;

		$('#locationschecklist li').each(function(){
			
			if ($(this).find('input[type="checkbox"]').is(':checked') == true) {

				checked = true;

				$('#locationschecklist li').find('input[type="checkbox"]').not('input:checked').parents('li').css({ 'pointer-events' : 'none', 'opacity' : '0.2' });
			}
			
		});

		if (checked) {

		} */
		
	});




});