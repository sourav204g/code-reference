// REF - https://goodies.pixabay.com/jquery/auto-complete/demo.html
jQuery(document).ready(function($) {
	// REF - https://schier.co/blog/2014/12/08/wait-for-user-to-stop-typing-using-javascript.html
	// Get the input box 
	var textInput = document.getElementById('company_works_at'); // Desktop Search Field.
	// Init a timeout variable to be used below
	var timeout = null;
	// Listen for keystroke events
	textInput.onkeyup = function (e) {
	    // Clear the timeout if it has already been set.
	    // This will prevent the previous task from executing
	    // if it has been less than <MILLISECONDS>
	    clearTimeout(timeout);
	    // Make a new timeout set to go off in 800ms
	    if (textInput.value != '') {
		    timeout = setTimeout(function () {
		        makeAjaxSearch(textInput.value);
		    }, 500);
	    } else {
	    	$('.custom-autocomplete-suggestions').css('display', 'none');
	    }
	};
	// Mobile 
	// REF - https://schier.co/blog/2014/12/08/wait-for-user-to-stop-typing-using-javascript.html
	// Get the input box 
	var textInput1 = document.getElementById('company_works_at1'); // Mobile search Field.
	// Init a timeout variable to be used below
	var timeout = null;
	// Listen for keystroke events
	textInput1.onkeyup = function (e) {
	    // Clear the timeout if it has already been set.
	    // This will prevent the previous task from executing
	    // if it has been less than <MILLISECONDS>
	    clearTimeout(timeout);
	    // Make a new timeout set to go off in 800ms
	    if (textInput1.value != '') {
		    timeout = setTimeout(function () {
		        makeAjaxSearch(textInput1.value);
		    }, 500);
	    } else {
	    	$('.custom-autocomplete-suggestions').css('display', 'none');
	    }
	};
	function makeAjaxSearch(keyword) {
			
			$.ajax({
					type: 'POST',
					url: handymanx_fnt.root + '/wp-admin/admin-ajax.php', // Change path
					data: {
		                action: 'auto_complete_search',
		                search: keyword,
		                autosecurity: handymanx_fnt.nonce
		            },
					success: function(data) {

						console.log(data);
						
						let res = $.parseJSON(data);

						if ( keyword.substr(keyword.length - 1, keyword.length) == 's' ) {
							keyword = keyword.substr(0, keyword.length - 1);
						}

						console.log(keyword);

						console.log(res);
						
				
						// if (keyword != '') {
							$('.custom-autocomplete-suggestions').css('display', 'block');
							$('.custom-autocomplete-suggestions').css('height', '340px');
							$('.custom-autocomplete-suggestions').find('ul').html('');
							res = Object.values(res);
							// REF - https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_objects/Object/values
							if ( res.length > 0 ) {
				    			
				    			res.forEach(function(item, index){ 
									let re = new RegExp("(" + keyword.split(' ').join('|') + ")", "gi");  
									// console.log(keyword);
									// console.log(item.name);
									let highlight = item.name.replace(re, "<b>$1</b>");
									let markup = '';
									if (item.type.length > 1) {
											markup += '<li><a href="' + item.group + '">' + highlight + '<br/><small>' + item.type[0].markup + '<br/>' + item.type[1].markup +'</small></a></li>';
									} else {
										 	markup += '<li><a href="' + item.type[0].permalink + '">' + highlight + '<br/><small>' + item.type[0].markup +'</small></a></li>';
									}
									
									/* if ($(window).width() < 767) {
										if (item.type.length > 1) {
											markup += '<li><a href="' + item.group + '">' + highlight + '<br/><small>' + item.type[0].markup + '<br/>' + item.type[1].markup +'</small></a></li>';
										} else {
											 	markup += '<li><a href="' + item.type[0].permalink + '">' + highlight + '<br/><small>' + item.type[0].markup +'</small></a></li>';
										}
										
									}
									else
									{
										if (item.type.length > 1) {
												markup += '<li><a href="' + item.group + '">' + highlight + '<small>' + item.type[0].markup + '  ' + item.type[1].markup +'</small></a></li>';
										} else {
											 	markup += '<li><a href="' + item.type[0].permalink + '">' + highlight + '<small>' + item.type[0].markup +'</small></a></li>';
										}
									} */
										
				    				$('.custom-autocomplete-suggestions').find('ul').append(markup);
				    			});

				    			$('.custom-autocomplete-suggestions').find('ul').append('<li style="background: #f2ae00; padding: 3px 15px; color: black; margin-top: 10px !important;"> <a data-target="#customize-it" data-toggle="modal" href="#">Can\'t find it ? <u>See More Options</u></a> </li>');

							} else {
								$('.custom-autocomplete-suggestions').css('height', 'auto');
								$('.custom-autocomplete-suggestions ul').css('margin', '0px');
								$('.custom-autocomplete-suggestions').find('ul').append('<li>Nothing Found.. Try different keyword.</li>');
								$('.custom-autocomplete-suggestions').find('ul li').css({'margin' : '0px', 'color': '#717595', 'font-style': 'italic', 'font-size': '15px'});
							}
		    			// } else {
		    			//	$('.custom-autocomplete-suggestions').css('display', 'none');
		    			// }
		               
					}
			});
	
	} // function ends.
	
	$('body').on('mouseover', '.custom-autocomplete-suggestions ul li:not(:last-child) a', function() {
		$(this).css('background', '#eeefed');
	}).on('mouseleave', '.custom-autocomplete-suggestions ul li a', function() {
		$(this).css('background', 'transparent');
	});
});