	
	jQuery('body.post-type-services #service_groupchecklist li').each(function(){
		var srID = jQuery(this).find('label > input').prop('value');
		jQuery(this).find('label').append(' - ID:' + srID);
	});

	// Disable sub-sub option if 'Parent by Quantity is checked.'
	jQuery('[data-name="handyman_multiply_by_parent_quantity"] .acf-input .acf-true-false label input:checked').parents('td').next().find('.acf-input .acf-true-false label').css({
				'opacity' : '0.5',
				'pointer-events' : 'none'
	});

	// Disable Parent by Quantity if sub-sub option is checked.'
	jQuery('[data-name="handyman_addon_sub_option_check"] .acf-input .acf-true-false label input:checked').parents('td').prev().find('.acf-input .acf-true-false label').css({
				'opacity' : '0.5',
				'pointer-events' : 'none'
	});

	// Disable sub-sub option if 'Parent by Quantity is checked.'
	jQuery('[data-name="handyman_multiply_by_parent_quantity"] .acf-input .acf-true-false label input').click(function() {
		if(jQuery(this).is(':checked')) {
			jQuery(this).parents('td').next().find('.acf-input .acf-true-false label').css({
				'opacity' : '0.5',
				'pointer-events' : 'none'
			});
		} else {
			jQuery(this).parents('td').next().find('.acf-input .acf-true-false label').css({
				'opacity' : '1',
				'pointer-events' : 'initial'
			});
		}
	});

	// Disable Parent by Quantity if sub-sub option is checked.'
	jQuery('[data-name="handyman_addon_sub_option_check"] .acf-input .acf-true-false label input').click(function() {
		if(jQuery(this).is(':checked')) {
			jQuery(this).parents('td').prev().find('.acf-input .acf-true-false label').css({
				'opacity' : '0.5',
				'pointer-events' : 'none'
			});
		} else {
			jQuery(this).parents('td').prev().find('.acf-input .acf-true-false label').css({
				'opacity' : '1',
				'pointer-events' : 'initial'
			});
		}
	});

	// Highlight services if the service group is not selected in Admin
	var serv_id = new Array();

	jQuery('#the-list tr').each(function(index){
		serv_id.push(jQuery(this).attr('id').split('-')[1]);	    		
	});

	// console.log(serv_id);

	if (jQuery('body').hasClass('post-type-services')) {
		
		jQuery.ajax({

	        url: handymanx.root + '/wp-admin/admin-ajax.php', // Change path
	        type: 'POST',
	        data: {
	            action: 'handyman_chk_if_srvgoup_selected',
	            servid: serv_id,
	            security: handymanx.nonce
	        },

	        success: function(response) {
	        	let res = jQuery.parseJSON(response);
	        	res = Object.values(res);
	        	res.forEach(function(val, index) {
	        		jQuery('#post-' + val).css('background', 'rgba(244, 67, 54, 0.2)');
	        	});
	        },

	        error: function(error) {
	            console.log(error);
	        }

	    });

	}


jQuery(function($){

	$('body').on('change', '[data-name="handyman_product_link_to_service"] .acf-input select', function() {

		// console.log(handymanx);

		var findID = $(this).parents('td').next().find('.acf-input .acf-editor-wrap .wp-editor-container textarea').prop('id');
		
    	$.ajax({

            url: handymanx.root + '/wp-admin/admin-ajax.php', // Change path
            type: 'POST',
            data: {
                action: 'handyman_fetch_serv_desc',
                servid: $(this).val(),
                security: handymanx.nonce
            },

            success: function(response) {

            	var id = 'textarea#' + findID;
            	// $('#acf-editor-5d9e053dcfcd9_ifr').contents().find('body').text().trim().length == 0

    			tinymce.remove();
            	tinymce.init({
				  selector:id,
				  init_instance_callback : function(editor) {
				  	if (editor.getContent() !== '') {
				  		if (confirm('Overwriting the Service Description!')) {
				  			editor.setContent(response);
				  		}
				  	} else {
				  		editor.setContent(response);
				  	}
				    
				  }
				
				});
            	
            },

            error: function(error) {
                console.log(error);
            }

        });

	});


	 // #product_categorieschecklist > li > .children > li > label > input, 
	 $('body').on('click', '#service_categorieschecklist > li .children > li > label > input', function(){
		
			if($(this).is(':checked')) {
				$(this).parents('.children').prev().find('input').prop('checked', true);
			}
	}); 



});

jQuery(function($){

	$('#service_groupchecklist li label input').click(function() {
		let urlParams = new URLSearchParams(window.location.search);

		if (urlParams.get('action') == 'edit') {

			if($(this).prop('checked')) {
				if (confirm('Open Service Group Page On New Tab!')) {
					let link = handymanx.root + '/wp-admin/term.php?taxonomy=service_group&tag_ID=' + $(this).val() + '&post_type=services';
					window.open(link, '_blank');
				}
			}
		}
		
	});

	/* admin-category-tree */
	 $('ul.categorychecklist li').each(function(){

    	if($(this).find('ul').length){
	      $(this).addClass('is-parent');
	      $(this).prepend('<span class="toggler"></span>');
	    }

	    if ($(this).find('ul > li > label > input').is(':checked')) {
	    	$(this).find('ul > li > label > input:checked').parents('.children').prev().find('input').prop('checked', true);
	    }

	 });

	 $('ul.categorychecklist li .toggler').click(function(){
	    $(this).parent().toggleClass('open');
	 });

	/* admin-category-tree */

	/* $('#product_categorieschecklist > li > label > input:checked, #service_categorieschecklist > li > label > input:checked').parent().next().find('li').each(function(){
		if(!$(this).find('label input').is(':checked')) {
			$(this).css({ 'opacity' : '0.7', 'pointer-events' : 'none' });
		}
	}); */

	/* $('body').on('click', '#product_categorieschecklist > li > .children > li > label > input, #service_categorieschecklist > li > .children > li > label > input', function(){

			let child = 0;
			
			if($(this).is(':checked')) {

				$(this).parents('.children').prev().find('input').prop('checked', true);

				$(this).parents('.children').find('li').each(function(){
					if(!$(this).find('label input').is(':checked')) {
						$(this).css({ 'opacity' : '0.7', 'pointer-events' : 'none' });
					}
				});
				
			} else {

				$(this).parents('.children').find('li').each(function(){

					$(this).removeAttr('style');
					
					if($(this).find('label input').is(':checked')) {
						child = 1;
					}
				});

				if(child === 0) {
					$(this).parents('.children').prev().find('input').prop('checked', false);
				}

				// $(".content a").not(this).hide("slow");
			}
	}); */


	// $('#publish, #save-post').click(function(evt){
	// 	alert('Select Service Group');
	// 	evt.preventDefault();
	// });

	/* $( 'body' ).on( 'click', '#acf-field_5b4618cf416bd-product' , function() {
	    if( $( "#acf-field_5b4618cf416bd-product:checked" )  ) {
	    	$('#product_groupdiv').css('display', 'block');
	    	$('#product_categoriesdiv').css('display', 'block');
	    	$('#service_groupdiv').css('display', 'none');
	    	$('#service_categoriesdiv').css('display', 'none');

	    	$('#acf-group_5b7a75ac60124').css('display', 'none');
	    }
	});

	$( 'body' ).on( 'click', '#acf-field_5b4618cf416bd' , function() {
	    if( $( "#acf-field_5b4618cf416bd:checked" )  ) {
	    	$('#service_categoriesdiv').css('display', 'block');
	    	$('#service_groupdiv').css('display', 'block');
	    	$('#product_groupdiv').css('display', 'none');
	    	$('#product_categoriesdiv').css('display', 'none');

	    	$('#acf-group_5b7a75ac60124').css('display', 'block');
	    }
	}); */

});


/* $(function() {

	$('[data-name="handyman_add_on_services"] > .acf-input > .acf-repeater > .acf-table > tbody > tr').each(function() {
		
		$(this).find('td:nth-child(3) .acf-input > .acf-repeater > .acf-table > tbody > tr').each(function(){
			var checkBoxContainer = $(this).find('td:nth-child(7) > .acf-input .acf-flexible-content').not('.-empty').parents('[data-name="handyman_sub_option_groups"]');
			var checkBox = checkBoxContainer.prev().find('.acf-input .acf-true-false label > input');

			if (checkBox.is(':checked')) {
				console.log('checked');
			} else {
				checkBox.prop('checked', true).trigger('change');
				console.log('changed!');
			}

		});

	});

}); */