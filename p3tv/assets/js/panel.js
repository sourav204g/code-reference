let cancelled_ph   = jQuery("#acf-field_630a0cf4a06b3");
let booking_status = jQuery("#acf-field_63280c61803c4");

/* if (cancelled_ph.val()) {
	jQuery('#acf-group_63280c4b7f6ac').css({'pointer-events' : 'none', 'opacity' : '0.5'});
} */

if (booking_status.val()) {
	jQuery('#acf-group_630a0cba7208a').css({'pointer-events' : 'none', 'opacity' : '0.5'});
}

booking_status.change(function() {

	// console.log('changed');
	// console.log(jQuery(this).val());

	if ( jQuery(this).val() == '' ) {
		jQuery('#acf-group_630a0cba7208a').removeAttr('style');
	} else {
		jQuery('#acf-group_630a0cba7208a').css({'pointer-events' : 'none', 'opacity' : '0.5'});
	}

});

cancelled_ph.change(function() {

	if ( jQuery(this).val() == '' ) {
		jQuery('#acf-group_63280c4b7f6ac').removeAttr('style');
	} else {
		jQuery('#acf-group_63280c4b7f6ac').css({'pointer-events' : 'none', 'opacity' : '0.5'});
	}

});
