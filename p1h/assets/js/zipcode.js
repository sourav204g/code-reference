	let zipcode;

	zipcode = JSON.parse(zipobg.zipcode);

	// console.log(zipcode);

	function onlyUnique(value, index, self) { 
	    return self.indexOf(value) === index;
	}

	document.addEventListener("DOMContentLoaded", function(event) { 

		document.querySelector('.select-state').onchange = changeEventHandlerState;
		document.getElementById('select-county').onchange = changeEventHandlerCounty;
		document.getElementById('select-city').onchange = changeEventHandlerCity;



		let elChildCounty;
		let elChildCity;

		let elCounty = document.getElementById('select-county');
		let elCity = document.getElementById('select-city');
		let zip = document.getElementById('zipcodes');


		function changeEventHandlerCity(event) {

			let $self = this;

			zipcode.forEach(function(element, index){	

				// console.log(element);

				if( element.handyman_zip_city__zipcode === $self.value ) {

					zip.innerHTML += '<span><input id="f' + index + '" name="prozip[]"  value="' + element.handyman_add_zipcode__zipcode + '" type="checkbox"><label for="f' + index + '" style="padding: 0 2em 2em 2em;">' + element.handyman_add_zipcode__zipcode + '</label></span>';		  
		  
				}

			});


		} // changeEventHandlerCity

		function changeEventHandlerCounty(event) {
			
			let $self = this;

			zip.innerHTML = '';

			// console.log($self.value);

			elCity.innerHTML = '';
			elCity.innerHTML = '<option value="">Select City</option>';

			let cityArr = Array();

			zipcode.forEach(function(element){	

				if( element.handyman_select_county__zipcode === $self.value ) {

					  cityArr.push(element.handyman_zip_city__zipcode);					  
		  
				}

			});


			// console.log(cityArr);

			let unique = cityArr.filter( onlyUnique );

			unique.forEach(function(ele){	

	 			elChildCity = document.createElement('option');
				elChildCity.text = ele;
				elChildCity.value = ele;
				elCity.appendChild(elChildCity);

            });


		} // changeEventHandlerCounty

		function changeEventHandlerState(event) {

			let $self = this;

			zip.innerHTML = '';

			let elCity = document.getElementById('select-city');
			elCity.innerHTML = '';
			elCity.innerHTML = '<option value="">Select City</option>';

			elCounty.innerHTML = '';
			elCounty.innerHTML = '<option value="">Select County</option>';

			let countyArr = Array();

			zipcode.forEach(function(element){	

				if( element.handyman_select_state__city === $self.value ) {

					  countyArr.push(element.handyman_select_county__zipcode);					  
		  
				}

			});

			let unique = countyArr.filter( onlyUnique );

			unique.forEach(function(ele){	

	 			elChildCounty = document.createElement('option');
				elChildCounty.text = ele;
				elChildCounty.value = ele;
				elCounty.appendChild(elChildCounty);

            });

		} // changeEventHandlerState


	}); // DOMContentLoaded