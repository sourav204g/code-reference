if ($(document).outerWidth() <= 769) {
	$('#imgval').parents('.row.hnd-re-arrange').addClass('imgval-sec');
	$('.imgval-sec > .col-lg-4.col-md-4.column:last-child').css({'display': 'flex', 'flex-direction': 'column', 'margin-top': '0px'});
	$('.imgval-sec > .col-lg-4.col-md-4.column:last-child > .cart-page2-container').css('order', '1');
	$('.imgval-sec > .col-lg-4.col-md-4.column:last-child > .grid-info-box.account-btns').css('order', '0');	
}

var baseT = parseInt( $('[name="handymn_service_time"]').val() );
var hndy_pmc = $('[name="handymn_per_min_cost"]').val();

var basefare = baseT * hndy_pmc;
var basefare_prem = basefare + parseFloat( $('[name="handymn_premium"]').val() ); // deltotal

var afterDst = parseFloat($('[name="handymn_after_discount"]').val()); // actprctotal

var finalp = basefare_prem - afterDst;

var rOption, rSubOption;

// File Upload Preview
$('body').on('change', '#file-6', function () {

		var length = this.files.length;
	    
	    if (this.files) {

	    	for (i = 0; i < length; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo('.upload-demo');
                }

                reader.readAsDataURL(this.files[i]);
            }

	        $('.upload-demo').html('');
		    $('.upload-demo').append('<button type="button" class="delbtnmrg26 removebtn" value="remove"><i class="fa fa-times" aria-hidden="true">Remove</i></button>');
		    $('.upload-demo').css('display', 'block');

	    }

	    
});

$('body').on('click', '.delbtnmrg26.removebtn', function () {
	$('input#file-6').val('');
	$('.upload-demo').html('');
});


// Custom Comment.
$('body').on('click change keyup', '#hnd_comm_text', function(){
	$('#hnd_comm_hidden').val($(this).val());
	$('#hnd_comm_hidden1').val($(this).val());
});

// add-to-cart
$('#submit_for_scheduling_imi').click(function(){
	$('#service_questionnaire_form').submit();
});

var currentTab = 0; // Current tab is set to be the first tab (0)

if (document.getElementById('service_questionnaire_form')) {
	showTab(currentTab);
} else {
	console.log('none');
}

 // Display the crurrent tab

const timeConvert = (mins) => {
        let h = Math.floor(mins / 60);
        let m = mins % 60;
        h = h < 10 ? '0' + h : h; // (or alternatively) h = String(h).padStart(2, '0')
        m = m < 10 ? '0' + m : m; // (or alternatively) m = String(m).padStart(2, '0')
        return `${h}:${m}  Hours`;
}

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");

  if (n > 0) {
  		$('.emply-list-info .form-group2.show-quantity').css({ 'opacity' : '0.5', 'pointer-events' : 'none' });
  } else {
  		$('.emply-list-info .form-group2.show-quantity').css({ 'opacity' : '1', 'pointer-events' : 'initial' });
  }

  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length /* - 1 */ )) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

let progItem = 100 / $('#service_questionnaire_form .tab').length;
// console.log(totalOptions);


var hndy_total_price = 0.00;
var total_work_min = 0;

var counter = 0;

var serv_adnminute = Array();
var serv_adnprice  = Array();

var serv_init_min = 0, serv_init_price  = 0;

function nextPrev(n) {  	

  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");

  // var fcQ = parseInt($('#hnd_isset2_zero').data('qnt'));
  var cqval = parseInt($('#myNumber').val());

  if (n == 1 && cqval < 1) {

  	$('#min-qty-value').find('.modal-body').html('');
  	$('#min-qty-value').find('.modal-body').append("Please select quantity before you continue!");
  	
  	$('#min-qty-value').modal('show');

  	// alert("Minimum quantity of " + minQ + " is required for this service.");
  	return;
  }

  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;

  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;

  //  console.log(currentTab);

  if (currentTab > 0) {
  	$('.opt-cap').css('display', 'block');
  } else {
  	$('.opt-cap').css('display', 'none');
  }

  $('#progress-bar').css('width', progItem * currentTab + '%');

  // if you have reached the end of the form...
  // if (currentTab >= x.length) {

	 // $("#service_questionnaire_form").hide(); // checking

	  /* $('#backnext').remove();
	  $('#stepss').remove();
	  $('.form-group2.show-quantity').css('display', 'none');

	  $('.ybs-list--condensed').append(selectedOptions);
	  $(".final_statement").show();

	  // document.getElementById("service_questionnaire_form").submit(); // checking
	  return false; */

  // } else {

  		  // console.log(currentTab);
  		  // console.log('sourab');

  		   if (n < 0) {
  		   	  
  		   	  // console.log(currentTab);

  		   	  // $('[name="handymn_current_tab"]').val(currentTab);

  		   	  let opt_deleted = $('[name="handymn_service_opt_deleted"]').val() || null;
  		   	  let sopt_deleted = $('[name="handymn_service_sub_deleted"]').val() || null;

  		   	  if (opt_deleted) {

  		   	  	opt_deleted  = JSON.parse(opt_deleted);
  		   	  	sopt_deleted = JSON.parse(sopt_deleted);

  		   	  	opt_deleted[currentTab] = null;
  		   	  	sopt_deleted[currentTab] = null;

  		   	  	$('[name="handymn_service_opt_deleted"]').val(JSON.stringify(opt_deleted));
  		   	  	$('[name="handymn_service_sub_deleted"]').val(JSON.stringify(sopt_deleted));

  		   	  }

  		   	  

  		   	  if ($('.ybs-list--condensed li:last-child').hasClass('hnd-child')) {
  		   	  	$('.ybs-list--condensed > li:last-child').prev().fadeOut('slow', function(){ $(this).remove(); });
  		   	  	$('.ybs-list--condensed > li:last-child').fadeOut('slow', function(){ $(this).remove(); });
  		   	  } else {
  		   	  	$('.ybs-list--condensed > li:last-child').fadeOut('slow', function(){ $(this).remove(); });
  		   	  }
  		   }


  		  // custom
  		  let hnd_opt = $('[name="handymn_service_opt_val"]').val();
  		  let hnd_sub = $('[name="handymn_service_sub_val"]').val(); 		  
  		  let hnd_vis = $('[name="handymn_service_opt_visibility"]').val(); 	

  		  let subOpts = JSON.parse(hnd_sub);

  		  let hndy_per_min_cost = $('[name="handymn_per_min_cost"]').val();

  		  	if (counter == 0) {

	  		  	if ($('[name="hnd_showquantity"]').val()) {

	  			  total_work_min   += parseInt( $('[name="handymn_service_time"]').val() ) * $('[name="hnd_showquantity"]').val(); // Main Service Labour Minutes

	  			} else {

	  				total_work_min   += parseInt( $('[name="handymn_service_time"]').val() ); // Main Service Labour Minutes
	  			}


	  			hndy_total_price += parseInt( $('[name="handymn_service_time"]').val() ) * hndy_per_min_cost;

	  			if ($('[name="hnd_showquantity"]').val()) {
	  			  	
	  				hndy_total_price = (hndy_total_price + parseFloat($('[name="handymn_premium"]').val())) * $('[name="hnd_showquantity"]').val(); // premium

	  				// console.log(hndy_total_price);
	  				// console.log( $('[name="hnd_showquantity"]').val());

	  			} else {

	  				hndy_total_price = hndy_total_price + parseFloat( $('[name="handymn_premium"]').val() ); // premium
	  			  	
	  			}

	  			serv_init_min 	 = total_work_min;
				serv_init_price  = hndy_total_price;

  			}

  			counter++;

  		 /* console.log(hnd_opt);
  		 
  		  var currentTab1 = currentTab - 1;
  		  
  		  if (currentTab1 >= 0) {
  		  	console.log(JSON.parse(hnd_opt)[currentTab1]);
  		  }

  		  if (n > 0) {

  		  	$('.ybs-list--condensed').append('<li class="ybs-list-item price-section transition-item-enter transition-item-enter-active"><div class="ybs-title ybs8"><h6 class="subheader">Deluxe model ceiling fan</h6></div><div class="ybs-value"> $30.00 USD </div></li>');
  		  } else {
  		  	$('.ybs-list--condensed > li:last-child').fadeOut('slow', function(){ $(this).remove(); });
  		  } 

  		  */
  			
  			var currentTab1 = currentTab - 1;

 			var elem = JSON.parse(hnd_opt)[currentTab1];
 			var index = currentTab1;

 			var vis = JSON.parse(hnd_vis)[currentTab1];

 			if (index !== -1 && n !== -1) {

 						console.log(n);

		  		  // JSON.parse(hnd_opt).forEach(function(elem, index){

		  		  		let addon__label = elem.split('|')[0];

		  		  		var materialPrice = 0;
		  		  		var materialSubPrice = 0;

		  		  		if ( elem.split('|')[2] ) {
		  		  			materialPrice = parseFloat(elem.split('|')[2]);
		  		  		}

		  		  		let addon_label = addon__label.split('~')[0];
		  		  		let addon_customer_supply = addon__label.split('~')[1];

		  		  		let addon_min;

		  		  		// console.log(hnd_opt);
		  		  		// console.log( $('[name="hnd_showquantity"]').val() );
		  		  		// console.log( elem.split('|')[2] );

		  		  		if ( $('[name="hnd_showquantity"]').val() && elem.split('|')[3] ) {
		  		  			addon_min = parseInt(elem.split('|')[1]) * parseInt($('[name="hnd_showquantity"]').val());

		  		  			materialPrice = materialPrice * parseInt($('[name="hnd_showquantity"]').val());

		  		  		} else {
		  		  			addon_min = parseInt(elem.split('|')[1]);
		  		  		}

		  		  		let addon_price = hndy_per_min_cost * addon_min;

		  		  		// console.log(addon_min);

		  		  		let premium = 0;
		  		  		let premiumCost = 0;

		  		  		if ($('[data-spremium]').data('spremium')) {
		  		  		  premium = parseInt($('[data-spremium]').data('spremium'));
		  		  		  premiumCost = addon_price * premium / 100;
		  		  		}

		  		  		addon_price = addon_price + premiumCost;

		  		  		let discount = 0;
		  		  		let discountCost = 0;

		  		  		if ($('[data-sdiscount]').data('sdiscount')) {
		  		  		  discount = parseInt($('[data-sdiscount]').data('sdiscount'));
		  		  		  discountCost = addon_price * discount / 100;
		  		  		}

		  		  		addon_price = addon_price - discountCost;

		  		  		addon_price = parseFloat(addon_price + materialPrice);

		  		  		// let addon_price = parseFloat(hndy_per_min_cost * addon_min + materialPrice);

		  		  		total_work_min += addon_min;
		  		  		hndy_total_price += parseFloat(addon_price);

		  		  		let selectedOptions = '';

		  		  		if (addon_customer_supply) {

		  		  			if (vis !== 'hide') {
		  		  				selectedOptions += '<li class="ybs-list-item price-section transition-item-enter transition-item-enter-active"><div class="ybs-title ybs8"><h6 class="subheader">' + addon_label + '<small class="subheader-small"><b>Customer to Supply: </b>' + addon_customer_supply + '</small></h6>';
		  		  			} else {
		  		  				selectedOptions += '<li style="display:none;"></li>';
		  		  			}

		  		  		} else {
		  		  			if (vis !== 'hide') {
		  		  				selectedOptions += '<li class="ybs-list-item price-section transition-item-enter transition-item-enter-active"><div class="ybs-title ybs8"><h6 class="subheader">' + addon_label + '</h6>';
							} else {
								selectedOptions += '<li style="display:none;"></li>';
							}		   		  			
		  		  		}

		  		  		if( subOpts[index] !== '' &&  subOpts[index] !== 'null' ) {

		  		  			if (vis !== 'hide') {
		  		  				selectedOptions += '</div><div class="ybs-value" data-op="' + rOption + '"> $' + addon_price.toFixed(2) + ' USD </div><i class="fa fa-trash-o" aria-hidden="true"></i></li>';
		  		  			}

		  		  			let subKey = subOpts[index].split('|')[0];

		  		  			selectedOptions += '<li class="hnd-child"><ul class="handyman-sub-group price-section-sub transition-item-enter transition-item-enter-active" style="text-align:left;">';

		  		  			if( subKey === 'hnd_qty' ) {

		  		  				// console.log(subOpts);

		  		  				if ( subOpts[index].split('|')[4] ) {
					  		  			materialSubPrice = parseFloat(subOpts[index].split('|')[4]);
					  		  	}

					  		  	if (parseInt(subOpts[index].split('|')[2]) !== 0) {
					  		  		materialSubPrice = materialSubPrice * parseInt(subOpts[index].split('|')[2]);
					  		  	}

		  		  				var work_min = parseInt(subOpts[index].split('|')[2]) * parseInt(subOpts[index].split('|')[3]);
		  		  				total_work_min += work_min;
		  		  				

		  		  				let qtycost = work_min * hndy_per_min_cost;

		  		  				premium = 0; // because alreay declared above.
		  		  				premiumCost = 0; // because alreay declared above.

		  		  				if ($('[data-spremium]').data('spremium')) {
		  		  				  premium = parseInt($('[data-spremium]').data('spremium'));
		  		  				  premiumCost = qtycost * premium / 100;
		  		  				}

		  		  				qtycost = qtycost + premiumCost;

		  		  				discount = 0; // because alreay declared above.
		  		  				discountCost = 0; // because alreay declared above.

		  		  				if ($('[data-sdiscount]').data('sdiscount')) {
		  		  				  discount = parseInt($('[data-sdiscount]').data('sdiscount'));
		  		  				  discountCost = qtycost * discount / 100;
		  		  				}

		  		  				qtycost = qtycost - discountCost;

		  		  				// console.log(' sourav - ' + premium);

		  		  				qtycost = (qtycost + materialSubPrice).toFixed(2);
		  		  				hndy_total_price += qtycost + materialSubPrice;

		  		  				// console.log(qtycost);

		  		  				if (subOpts[index].split('|')[1].match(/{qt}/g)) {
		  		  					if (subOpts[index].split('|')[1].split('~')[1]) {

		  		  						var _qt = subOpts[index].split('|')[1].split('~')[0].replace('{qt}', parseInt(subOpts[index].split('|')[2])) + ' <small class="subheader-small"><b>Customer to Supply: </b>' + subOpts[index].split('|')[1].split('~')[1] + '</small>';

		  		  					} else {
		  		  						var _qt = subOpts[index].split('|')[1].split('~')[0].replace('{qt}', parseInt(subOpts[index].split('|')[2]));
		  		  					}
		  		  					
		  		  				} else {

		  		  					if (subOpts[index].split('|')[1].split('~')[1]) {

		  		  						var _qt = subOpts[index].split('|')[1].split('~')[0] + ' <small class="subheader-small"><b>Customer to Supply: </b>' + subOpts[index].split('|')[1].split('~')[1] + '</small>';

		  		  					} else {
		  		  						var _qt = subOpts[index].split('|')[1];
		  		  					}

		  		  					
		  		  				}		 

		  		  				// console.log('hnd_qty ' + work_min);
		  		  				// console.log('hndy_per_min_cost ' + hndy_per_min_cost);
		  		  				// console.log('qtycost ' + qtycost);

		  		  				// selectedOptions += '<li class="ybs-list-item price-section"><div class="ybs-title ybs8"><h6 class="subheader">' + subOpts[index].split('|')[1] + '</h6></div><div class="ybs-value">' + subOpts[index].split('|')[2] + 'X $' + subOpts[index].split('|')[3] + ' = ' + qtycost + '</div></li>';

		  		  				selectedOptions += '<li class="ybs-list-item price-section transition-item-enter transition-item-enter-active"><div class="ybs-title ybs8"><h6 class="subheader">' + _qt + '</h6></div><div class="ybs-value" data-sop="' + rSubOption + '">$' + qtycost + '</div><i class="fa fa-trash-o" aria-hidden="true"></i></li>';

		  		  			} else if( subKey === 'hnd_yesno' ) {

		  		  				if( subOpts[index].split('|')[2] !== 'no' ) { // IF yes

		  		  					if ( subOpts[index].split('|')[3] ) {
					  		  			materialSubPrice = parseFloat(subOpts[index].split('|')[3]);
					  		  		}

		  		  					var work_min = parseInt(subOpts[index].split('|')[2]);
		  		  					total_work_min += work_min;
		  		  					

		  		  					// console.log(work_min);  					

		  		  					if (subOpts[index].split('|')[1].split('~')[1]) {
		  		  						var yesnoL = subOpts[index].split('|')[1].split('~')[0] + ' <small class="subheader-small"><b>Customer to Supply: </b>' + subOpts[index].split('|')[1].split('~')[1] +'</small>';
		  		  					} else {
		  		  						var yesnoL = subOpts[index].split('|')[1].split('~')[0];
		  		  					}

		  		  					let yes = hndy_per_min_cost * subOpts[index].split('|')[2];

		  		  					premium = 0; // because alreay declared above.
		  		  					premiumCost = 0; // because alreay declared above.

		  		  					if ($('[data-spremium]').data('spremium')) {
		  		  					  premium = parseInt($('[data-spremium]').data('spremium'));
		  		  					  premiumCost = yes * premium / 100;
		  		  					}

		  		  					yes = yes + premiumCost;

		  		  					discount = 0; // because alreay declared above.
		  		  					discountCost = 0; // because alreay declared above.

		  		  					if ($('[data-sdiscount]').data('sdiscount')) {
		  		  					  discount = parseInt($('[data-sdiscount]').data('sdiscount'));
		  		  					  discountCost = yes * discount / 100;
		  		  					}

		  		  					yes = yes - discountCost;

		  		  					yes = yes + materialSubPrice;
		  		  					hndy_total_price += yes + materialSubPrice;

		  		  					selectedOptions += '<li class="ybs-list-item price-section transition-item-enter transition-item-enter-active"><div class="ybs-title ybs8"><h6 class="subheader">' + yesnoL + '</h6></div><div class="ybs-value" data-sop="' + rSubOption + '"><em style="font-style: italic;">(YES)</em> - $' + yes.toFixed(2) + ' USD</div><i class="fa fa-trash-o" aria-hidden="true"></i></li>';

		  		  				} else { // IF no

		  		  					/* remove button is not available. */

		  		  					selectedOptions += '<li class="ybs-list-item price-section transition-item-enter transition-item-enter-active"><div class="ybs-title ybs8"><h6 class="subheader">' + subOpts[index].split('|')[1] + '</h6></div><div class="ybs-value" data-sop="' + rSubOption + '"><em>(NO)</em style="font-style: italic;"> - $0 USD</div></li>';

		  		  				}

		  		  			} else if( subKey === 'hnd_list' ) {

				  		  		if ( subOpts[index].split('|')[4] ) {
				  		  			materialSubPrice = parseFloat(subOpts[index].split('|')[4]);
				  		  		}

		  		  				var work_min = parseInt(subOpts[index].split('|')[3]);
		  		  				total_work_min += work_min;
		  		  				

		  		  				// console.log(work_min);

		  		  				let list_min_cst = hndy_per_min_cost * subOpts[index].split('|')[3];

		  		  				premium = 0; // because alreay declared above.
		  		  				premiumCost = 0; // because alreay declared above.

		  		  				if ($('[data-spremium]').data('spremium')) {
		  		  				  premium = parseInt($('[data-spremium]').data('spremium'));
		  		  				  premiumCost = list_min_cst * premium / 100;
		  		  				}

		  		  				list_min_cst = list_min_cst + premiumCost;

		  		  				discount = 0; // because alreay declared above.
		  		  				discountCost = 0; // because alreay declared above.

		  		  				if ($('[data-sdiscount]').data('sdiscount')) {
		  		  				  discount = parseInt($('[data-sdiscount]').data('sdiscount'));
		  		  				  discountCost = list_min_cst * discount / 100;
		  		  				}

		  		  				list_min_cst = list_min_cst - discountCost;

		  		  				list_min_cst = list_min_cst + materialSubPrice;
		  		  				hndy_total_price += list_min_cst + materialSubPrice;

		  		  				let subon_label = subOpts[index].split('|')[2].split('~')[0];
		  		  				let subon_customer_supply = subOpts[index].split('|')[2].split('~')[1];

		  		  				if(subon_customer_supply) {

		  		  					selectedOptions += '<li class="ybs-list-item price-section transition-item-enter transition-item-enter-active"><div class="ybs-title ybs8"><h6 class="subheader">' + subon_label + ' <small class="subheader-small"><b>Customer to Supply: </b>' + subon_customer_supply + '</small></h6></div><div class="ybs-value" data-sop="' + rSubOption + '">$' + list_min_cst.toFixed(2) + ' USD</div><i class="fa fa-trash-o" aria-hidden="true"></i></li>';

		  		  				} else {
		  		  					selectedOptions += '<li class="ybs-list-item price-section transition-item-enter transition-item-enter-active"><div class="ybs-title ybs8"><h6 class="subheader">' + subon_label + '</h6></div><div class="ybs-value" data-sop="' + rSubOption + '">$' + list_min_cst.toFixed(2) + ' USD</div><i class="fa fa-trash-o" aria-hidden="true"></i></li>';
		  		  				}
		  		  				 

		  		  			}

		  		  			selectedOptions += '</ul></li>';

		  		  		} else {

		  		  			if (vis !== 'hide') {		
		  		  				selectedOptions += '</div><div class="ybs-value" data-op="' + rOption + '"> $' + addon_price.toFixed(2) + ' USD </div><i class="fa fa-trash-o" aria-hidden="true"></i></li>';
		  		  			}
		  		  		}

		  		  		// console.log(addon_price);
		  		  		// console.log('addon min - ' + addon_min);

		  		  		if (typeof work_min == 'undefined') {
		  		  			work_min = 0;
		  		  		}

//		  		  		console.log(work_min);
						
						let work_min_cost = hndy_per_min_cost * work_min;

						premium = 0; // because alreay declared above.
						premiumCost = 0; // because alreay declared above.

						if ($('[data-spremium]').data('spremium')) {
						  premium = parseInt($('[data-spremium]').data('spremium'));
						  premiumCost = work_min_cost * premium / 100;
						}

						work_min_cost = work_min_cost + premiumCost;

						discount = 0; // because alreay declared above.
						discountCost = 0; // because alreay declared above.

						if ($('[data-sdiscount]').data('sdiscount')) {
						  discount = parseInt($('[data-sdiscount]').data('sdiscount'));
						  discountCost = work_min_cost * discount / 100;
						}

						work_min_cost = work_min_cost - discountCost;					

		  		  		var temp_min   = addon_min + work_min;
		  		  		var temp_price = addon_price + work_min_cost + materialSubPrice;

		  		  		// console.log(temp_min);

		  		  		console.log('sub - ' + work_min + ' - ' + rSubOption);
		  		  		console.log('op - ' + addon_min + ' - ' + rOption);

		  		  		setTimeout(() => {
		  		  		  
		  		  			if (work_min !== 0) { // if there is no option | there is suboption
		  		  				$('[data-sop="' + rSubOption + '"]').attr('data-omin', work_min);
		  		  			}

		  		  			if (addon_min !== 0) { // if there is no sub option | there is option
		  		  				$('[data-op="' + rOption + '"]').attr('data-omin', addon_min);
		  		  			}

		  		  		}, "1000");		  		  		

		  		  		// console.log(rOption);
		  		  		// console.log(addon_min);

		  		  		// console.log(rSubOption);
		  		  		// console.log(work_min);

		  		  		serv_adnminute[currentTab1] = temp_min;
		  		  		serv_adnprice[currentTab1]  = temp_price;

		  		  		var serv_total_min = 0, serv_total_price = 0;

		  		  		serv_adnminute.forEach(function(item, index){
		  		  			// console.log('souravv');
		  		  			// console.log(item);
		  		  			serv_total_min += item;
		  		  		});

		  		  		serv_adnprice.forEach(function(item, index){
		  		  			// console.log(item);
		  		  			serv_total_price += item;
		  		  		});


		  		  		serv_total_min 	 += serv_init_min;
						serv_total_price += serv_init_price;

						// console.log(serv_init_min);
						// console.log(serv_init_price);



		  		  	  $('.ybs-list--condensed').append(selectedOptions); // append to the widget.
		  		  	  
		  		  	  // console.log(total_work_min);
		  		  	  // console.log(hndy_total_price);

		  		  // });




		  		  // console.log('main serv. min - ' +  $('[name="handymn_service_time"]').val() );
		  		  // CUT FROM HERE

		  		  // console.log('toatl min - ' + total_work_min);
		  		  // console.log(JSON.parse(hnd_opt));
		  		  // console.log(JSON.parse(hnd_sub));

		  		  let afterDiscountx;

		  		  if ($('[name="hnd_showquantity"]').val()) {

		  	  		afterDiscountx = parseFloat($('[name="handymn_after_discount"]').val()) * parseInt( $('[name="hnd_showquantity"]').val() );
		  		  	
		  		  } else {

		  			afterDiscountx = parseFloat($('[name="handymn_after_discount"]').val());

		  		  }

		  		  // console.log(parseInt( $('[name="handymn_service_time"]').val() ) * hndy_per_min_cost);
		  		  // console.log($('[name="handymn_service_time"]').val());
		  		  // console.log(hndy_per_min_cost);
		  		  // // console.log(hndy_total_price);
		  		  // console.log(afterDiscountx);

		  		  if( afterDiscountx != 0 ) {

		  		  	let finalPrice = serv_total_price.toFixed(2) - afterDiscountx.toFixed(2);

		  		  	// console.log(finalPrice);
		  		  	$('.hndy_total_price').text('$' + finalPrice.toFixed(2) + ' USD');
		  		  	// $('.hn_service_price').text('$' + finalPrice.toFixed(2) + ' USD');

		  		  } else {

		  		  	 $('.hndy_total_price').text('$' + serv_total_price.toFixed(2) + ' USD');
		  		  	 // $('.hn_service_price').text('$' + hndy_total_price.toFixed(2) + ' USD');

		  		  }

		  		  // console.log(total_work_min);
		  		  $('.hn_service_com_time').text( timeConvert(serv_total_min) );

  		 	}

  		 	if (currentTab >= x.length) {

  		 		// console.log('hdhdh');
  		 		$('.op-finish-show').css('display', 'block');
  		 		$('.op-finish-hide').css('display', 'none');

  		 		$('.op-mobile-finish-hide').css('display', 'none');
  		 		
  		 		$('#backnext').remove();
				$('#stepss').remove();
				$('.form-group2.show-quantity').css('display', 'none');

				$(".final_statement_btn").show();

				$('.ybs-list--condensed i.fa.fa-trash-o').removeAttr('style');

				if (window.outerWidth > 1024) { // desktop
					$(".final_statement_desktop").show();
				} else { // mobile
					$(".final_statement_mobile").show();
					$('.job-details.mobile').css('display', 'none');
					$('.job-single-head').css('padding-bottom', '0px');
					$('#service_questionnaire_form').css('display', 'none');
				}
				
				// document.getElementById("service_questionnaire_form").submit(); // checking
				return false;
  		 	} else {
  		 		$('.ybs-list--condensed i.fa.fa-trash-o').css({ 'color' : '#ccc', 'pointer-events' : 'none'});
  		 	}
  // }
  
  // Otherwise, display the correct tab:
  showTab(currentTab);

}

function validateForm() {
 
  // This function deals with validation of the form fields
  let optionJ, option, subOptionJ, subOption, valid = true;
  let split;

  optionJ = $('[name="handymn_service_opt"]').val();
 
  if( optionJ === '') {

  	$('#service_questionnaire_form .error').remove();
  	$('#service_questionnaire_form').prepend('<div class="error">Select an option and continue.</div>'); // Show error

  	valid = false; // set validation to false

  } else {

  	$('#service_questionnaire_form .error').remove();
  	option  = JSON.parse(optionJ)[currentTab];

  	rOption = option; // console.log(option);

  	if( typeof option == 'undefined' ) {

  		$('#service_questionnaire_form .error').remove();
  		$('#service_questionnaire_form').prepend('<div class="error">Select an option and continue.</div>'); // Show error

  		valid = false; // set validation to false

  	} else {

  		// console.log('sourav');

  		$('#service_questionnaire_form .error').remove();
  		let optionType = option.split('|')[0];

  		if( optionType !== 'undefined' ) {

  			subOptionJ = $('[name="handymn_service_sub_val"]').val();

  			xsubOptionJ = $('[name="handymn_service_sub"]').val();

  			rSubOption = JSON.parse(xsubOptionJ)[currentTab]; // console.log(xsubOptionJ);

  			subOption = JSON.parse(subOptionJ)[currentTab];

  			subOptionVal = subOption.split('|')[2]; // quantity value

  			if(subOption == '') {

  				// console.log(optionType);

  				if( optionType === 'handyman_sub_option_quantity' ) {

  					$('#service_questionnaire_form .error').remove();
			  		$('#service_questionnaire_form').prepend('<div class="error">Enter Quantity and continue.</div>'); // Show error
			  		
			  		valid = false; // set validation to false

  				} else {

  					$('#service_questionnaire_form .error').remove();
			  		$('#service_questionnaire_form').prepend('<div class="error">Select a suboption and continue.</div>'); // Show error
			  		
			  		valid = false; // set validation to false

  				}
  				

  			} else {

  				if( optionType === 'handyman_sub_option_quantity' ) {
  					if (subOptionVal == 0) {
  						
  							$('#service_questionnaire_form .error').remove();
					  		$('#service_questionnaire_form').prepend('<div class="error">Enter Quantity and continue.</div>'); // Show error
					  		
					  		valid = false; // set validation to false
  					}
  				}

  			}



 			 

  		}
  		

  	}

  	

  }
  

  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }

  return valid; // return the valid status
}


function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}


/* function move() {

  var elem = document.getElementById("progress-bar");   
  var width = 1;

  // var id = setInterval(frame, 1);
  // console.log(width);
  // console.log(id);

  function frame() {
    if (width >= 30) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
    }
  }

} */


$(function(){

	/* 

	// Suravi

	$('#imgval').on('click', '.remove_field', function() {
		$(this).parent().parent().remove();
	});

	function readURL() {
		var $input = $(this);
		var $newinput = $(this).parent().parent().parent().find('.portimg ');
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				reset($newinput.next('.delbtnmrg26'), true);
				$newinput.attr('src', e.target.result).show();
				$newinput.after('<button type="button" class="delbtnmrg26 removebtn" value="remove"><i class="fa fa-times" aria-hidden="true">Remove</i></button>');
			}
			reader.readAsDataURL(this.files[0]);
		}
	}
	
	$("#imgval").on('change', '.fileUpload', readURL);
	
	$("#imgval").on('click', '.delbtnmrg26', function(e) {
		reset($(this));
	});

	function reset(elm, prserveFileName) {
		if (elm && elm.length > 0) {
			var $input = elm;
			$input.prev('.portimg').attr('src', '').hide();
			if (!prserveFileName) {
				$($input).parent().parent().find('input.fileUpload').val("");
				$($input).parent().parent().find('.input-group').find('input#uploadre').val("");
			}
			elm.remove();
		}
	} */

	$('.close-popup').click(function(){ //Reload upon closing the popup.
		location.reload();
	});

});

$('[name="hnd_showquantity"]').on('keyup', function(){

	// console.log('')

	if ($(this).val() !== '' && $(this).val() !== 0) {
		up(1000, true);
	} else {
		// 
		if (window.confirm('Qantity Field cannot be empty')) {
		    document.getElementById("myNumber").value = 1;
		}
	}
});

// console.log(actprctotal);
function up(max, keyup = null) {

	// console.log(keyup);

	var comt = parseInt($('.hn_service_com_time').data('comt'));

	if (!keyup) {
		document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
	}
    
    if (document.getElementById("myNumber").value >= parseInt(max)) {
        document.getElementById("myNumber").value = max;
    }

    var qtyn = $('[name="hnd_showquantity"]').val();

    $('.hnd-item-count').text(qtyn);
    $('.quan').text(qtyn);

    var upPrc = parseFloat($('.quanc').data('op')) * parseInt(qtyn);
    $('.quanc').text(upPrc.toFixed(2));

    $('.hnd-opttab-container .tab').each(function() {
    	$(this).find('.ques-group-container .ques-group .ques').each(function() {
    		if( $(this).find('.ptag').data('multiply') === true ) {

    			let mltp = qtyn * $(this).find('.ptag label > em').data('prc');
    			$(this).find('.ptag label > em').text(mltp.toFixed(2));
    		}
    	});
    });

    $('[name="handymn_showquantity"]').val(qtyn);

    let deltotal = basefare_prem * parseInt(qtyn);
    let actprctotal = finalp * parseInt(qtyn);

    $('.hnd-price-h4 del').text('$' + deltotal.toFixed(2));
    $('.hnd-price-h4 span').text('$' + actprctotal.toFixed(2));

    $('.bestd del').text('$' + deltotal.toFixed(2));
    $('.bestd span').text('$' + actprctotal.toFixed(2));

    $('.hndy_total_price span').text(actprctotal.toFixed(2));

    $('.hn_service_com_time').text( timeConvert(comt * parseInt(qtyn)) );

}

function down(min) {

	var comt = parseInt($('.hn_service_com_time').data('comt'));

    document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;

    if (document.getElementById("myNumber").value <= parseInt(min)) {
        document.getElementById("myNumber").value = min;
    }

    var qtyn = $('[name="hnd_showquantity"]').val();

    $('.hnd-item-count').text(qtyn);
    $('.quan').text(qtyn);

    var upPrc = parseFloat($('.quanc').data('op')) * parseInt(qtyn);
    $('.quanc').text(upPrc.toFixed(2));



    $('.hnd-opttab-container .tab').each(function() {
    	$(this).find('.ques-group-container .ques-group .ques').each(function() {
    		if( $(this).find('.ptag').data('multiply') === true ) {

    			let mltp = qtyn * $(this).find('.ptag label > em').data('prc');
    			$(this).find('.ptag label > em').text(mltp.toFixed(2));
    		}
    	});
    });

    $('[name="handymn_showquantity"]').val(qtyn);

    let deltotal = basefare_prem * parseInt(qtyn);
    let actprctotal = finalp * parseInt(qtyn);

    $('.hnd-price-h4 del').text('$' + deltotal.toFixed(2));
    $('.hnd-price-h4 span').text('$' + actprctotal.toFixed(2));

    $('.bestd del').text('$' + deltotal.toFixed(2));
    $('.bestd span').text('$' + actprctotal.toFixed(2));

    $('.hndy_total_price span').text(actprctotal.toFixed(2));

    $('.hn_service_com_time').text( timeConvert(comt * qtyn) );  


}