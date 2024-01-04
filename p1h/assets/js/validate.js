		jQuery("form#edit_profile_change_psw").validate({

			 rules: {

				"edit_pro_old_password" :  {
                    required: true,
                },

                "edit_pro_new_password" :  {
                    required: true,
                    minlength: 6
                },

                "edit_pro_confirm_password" :  {
                    required: true,
                    minlength: 6
                },

			 }

		 });


		jQuery("form#pro-manage-skills").validate({

			 rules: {
				"pro_skills[]" :  {
                    required: true,
                    number: true
                },


			 }

		 });


		$('form#pro-manage-schedule').on('submit', function(event) {
			
		let validate = $(this).validate({

			 rules: {

				"edit_pro_schedule_time" :  {
                    required: true,
                },

                "edit_pro_off_dates" : {
                	required: true,
                }

			 }

		 }).form();

		//alert(validate);

		 if(!validate) { // If False - Validation Failed.
		 	event.preventDefault();
		 }

		});


		jQuery("#pro-manage-zipcodes").validate({

			 rules: {

				select_state : "required",
				select_county : "required",
				select_city : "required",
				"prozip[]" :  {
                    required: true,
                    number: true
                },


			 }

		 });


		jQuery("#editprofile").validate({

			 rules: {

			 	edit_pro_first_name : {
                    required: true,
                    minlength: 3,
                },         
				edit_pro_last_name : {
                    required: true,
                    minlength: 3,
                },         
				edit_pro_cell_phone : {
                    required: true,
                    number: true
                },
				edit_pro_home_phone : {
                    required: true,
                    number: true
                },
				edit_pro_years_of_experience : {
                    required: true,
                    number: true
                },
				edit_pro_cirtified : "required",
				edit_pro_insured : "required",
				edit_pro_street : "required",
				edit_pro_city : "required",
				edit_pro_county : "required",
				edit_pro_state : "required",
				edit_pro_zip_code : {
                    required: true,
                    number: true
                },
				edit_pro_bio : "required",     

			 }

		 });

		jQuery("#handyman-rsg").validate({
            rules: {

                pro_username: {
                    required: true,
                    minlength: 3,
                },         
				pro_first_name : "required",
				pro_last_name : "required",
				pro_email: {
                    required: true,
                    email: true
                },
                pro_password : {
                    required: true,
                    minlength: 6,
                },
                pro_confirm_password : {
                    required: true,
                    minlength: 6,
                },
				pro_street : "required",
				pro_city : "required",
				pro_county : "required",
				pro_state : "required",
				pro_country : "required",
				pro_zipcode : {
                    required: true,
                    number: true
                },
				pro_home_phone : {
                    required: true,
                    number: true
                },
				pro_cell_phone : {
                    required: true,
                    number: true
                },
				pro_legally_eligible : "required",
				pro_convicted_crime : "required",
				pro_year_of_experience : {
                    required: true,
                    number: true
                },
				pro_skill_rating_carpentry : {
                    required: true,
                    number: true
                },
				pro_skill_rating_painting : {
                    required: true,
                    number: true
                },
				pro_skill_rating_tiling : {
                    required: true,
                    number: true
                },
				pro_skill_rating_plumbing : {
                    required: true,
                    number: true
                },
				pro_skill_rating_electrical : {
                    required: true,
                    number: true
                },
				pro_certified : "required",
				pro_insured : "required",
				pro_evenning : "required",
				pro_saturday : "required",
				pro_sunday : "required",

				pro_high_school : "required",
				pro_college : "required",
				pro_training : "required",

				// pro_high_school_year  : "required",
				// pro_college_year  : "required",
				// pro_training_year  : "required",

				pro_employer1 : "required",
				pro_position1 : "required",
				pro_how_long1 : {
                    required: true,
                    number: true
                },
				pro_date_left1 : "required",
				pro_reason_left1 : "required",
				pro_employer2 : "required",
				pro_position2 : "required",
				pro_how_long2 : {
                    required: true,
                    number: true
                },
				pro_date_left2 : "required",
				pro_reason_left2 : "required",
				pro_employer3 : "required",
				pro_position3 : "required",
				pro_how_long3 : {
                    required: true,
                    number: true
                },
				pro_date_left3 : "required",
				pro_reason_left3 : "required",
				pro_employer4 : "required",
				pro_position4 : "required",
				pro_how_long4 : {
                    required: true,
                    number: true
                },
				pro_date_left4 : "required",
				pro_reason_left4 : "required",
				pro_year : {
                    required: true,
                    // number: true
                },
				pro_make : "required",
				pro_model : "required",
				pro_comments_questions : "required",

	            "pro_skills[]" : "required",
	            "pro_tools[]" : "required",

            }

        });