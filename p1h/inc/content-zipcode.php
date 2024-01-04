<?php

// Add Tools Inventory
add_filter('acf/load_field/name=pro_tool', 'handyman_pro_load_tools_inventory_choices');

if ( ! function_exists( 'handyman_pro_load_tools_inventory_choices' ) ) {

	function handyman_pro_load_tools_inventory_choices( $field ) {
	    
	    // reset choices
	    $field['choices'] = array();

	    foreach ( get_field('handyman_pro_tools_config', 'option') as $key => $handyman_pro_tools_config ) {
	    		
	    		$choices[] = $handyman_pro_tools_config['handyman_pro_tool'];
	    }

	    // loop through array and add to field 'choices'
	    if( is_array($choices) ) {
	        
	        foreach( $choices as $choice ) {
	            
	            $field['choices'][ $choice ] = $choice;
	            
	        }
	        
	    }
	   
	    // return the field
	    return $field;
	    
	}

}


// Add State Page
add_filter('acf/load_field/name=handyman_select_country', 'handyman_pro_load_country_field_choices');

if ( ! function_exists( 'handyman_pro_load_country_field_choices' ) ) {

	function handyman_pro_load_country_field_choices( $field ) {
	    
	    // reset choices
	    $field['choices'] = array();

	    foreach ( get_field('handyman_manage_country', 'option') as $key => $handyman_manage_country ) {
	    		
	    		$choices[] = $handyman_manage_country['handyman_add_country'];
	    }

	    // loop through array and add to field 'choices'
	    if( is_array($choices) ) {
	        
	        foreach( $choices as $choice ) {
	            
	            $field['choices'][ $choice ] = $choice;
	            
	        }
	        
	    }
	   
	    // return the field
	    return $field;
	    
	}

}


// Add County Page
add_filter('acf/load_field/name=handyman_select_state', 'handyman_pro_load_handyman_select_state_field_choices');
if ( ! function_exists( 'handyman_pro_load_handyman_select_state_field_choices' ) ) {

	function handyman_pro_load_handyman_select_state_field_choices( $field ) {

	   // reset choices
	   $field['choices'] = array();

	   remove_filter('acf/load_field/name=handyman_select_state', 'handyman_pro_load_handyman_select_state_field_choices');

	   // var_dump(get_field('handyman_manage_county', 'option'));

	   if( have_rows('handyman_manage_county', 'option') ):

		 	// loop through the rows of data
		    while ( have_rows('handyman_manage_county', 'option') ) : the_row();


		    	foreach (get_field('handyman_manage_state', 'option') as $key => $handyman_manage_state) {	

					if ($handyman_manage_state['handyman_select_country'] === get_sub_field('handyman_select_country', 'option') ) {

						$handyman_add_state_val = $handyman_manage_state['handyman_add_state'];

						$field['choices'][$handyman_add_state_val] = get_sub_field('handyman_select_country', 'option') . ' | ' . $handyman_add_state_val;
						
					}
				}


		        // display a sub field value
		        //var_dump(get_sub_field('handyman_select_country', 'option'));

		    endwhile;

		else :

		    // no rows found

		endif;

	    add_filter('acf/load_field/name=handyman_select_state', 'handyman_pro_load_handyman_select_state_field_choices');
	   
	    // return the field
	    return $field;
	    
	}

}


// Add City Page
add_filter('acf/load_field/name=handyman_select_state__city', 'handyman_pro_load_handyman_select_state_field_choices__city');
if ( ! function_exists( 'handyman_pro_load_handyman_select_state_field_choices__city' ) ) {

	function handyman_pro_load_handyman_select_state_field_choices__city( $field ) {

	   // reset choices
	   $field['choices'] = array();

	   remove_filter('acf/load_field/name=handyman_select_state__city', 'handyman_pro_load_handyman_select_state_field_choices__city');

	   // var_dump(get_field('handyman_manage_city', 'option'));

	   if( have_rows('handyman_manage_city', 'option') ):

		 	// loop through the rows of data
		    while ( have_rows('handyman_manage_city', 'option') ) : the_row();


		    	foreach (get_field('handyman_manage_state', 'option') as $key => $handyman_manage_state) {	

					if ($handyman_manage_state['handyman_select_country'] === get_sub_field('handyman_select_country', 'option') ) {

						$handyman_add_state_val = $handyman_manage_state['handyman_add_state'];

						$field['choices'][$handyman_add_state_val] = get_sub_field('handyman_select_country', 'option') . ' | ' . $handyman_add_state_val;
						
					}
				}

		        // display a sub field value
		        //var_dump(get_sub_field('handyman_select_country', 'option'));

		    endwhile;

		else :

		    // no rows found

		endif;

	    add_filter('acf/load_field/name=handyman_select_state__city', 'handyman_pro_load_handyman_select_state_field_choices__city');
	   
	    // return the field
	    return $field;
	    
	}

}

add_filter('acf/load_field/name=handyman_select_county__city', 'handyman_pro_load_handyman_select_county_field_choices__city');
if ( ! function_exists( 'handyman_pro_load_handyman_select_county_field_choices__city' ) ) {

	function handyman_pro_load_handyman_select_county_field_choices__city( $field ) {

	   // reset choices
	   $field['choices'] = array();

	   remove_filter('acf/load_field/name=handyman_select_county__city', 'handyman_pro_load_handyman_select_county_field_choices__city');

	   // var_dump(get_field('handyman_manage_city', 'option'));

	   if( have_rows('handyman_manage_city', 'option') ):

		 	// loop through the rows of data
		    while ( have_rows('handyman_manage_city', 'option') ) : the_row();


		    	foreach (get_field('handyman_manage_county', 'option') as $key => $handyman_manage_county) {

					if ($handyman_manage_county['handyman_select_country'] === get_sub_field('handyman_select_country', 'option') && $handyman_manage_county['handyman_select_state'] === get_sub_field('handyman_select_state__city', 'option') ) {

						$handyman_add_county_val = $handyman_manage_county['handyman_add_county'];

						$field['choices'][$handyman_add_county_val] = get_sub_field('handyman_select_state__city', 'option') . ' | ' . $handyman_add_county_val;
						
					}

				}


		        // display a sub field value
		        //var_dump(get_sub_field('handyman_select_country', 'option'));

		    endwhile;

		else :

		    // no rows found

		endif;

	    add_filter('acf/load_field/name=handyman_select_county__city', 'handyman_pro_load_handyman_select_county_field_choices__city');
	   
	    // return the field
	    return $field;
	    
	}

}


// Add Zipcode Page
add_filter('acf/load_field/name=handyman_select_county__zipcode', 'handyman_pro_load_handyman_select_county_field_choices__zipcode');
if ( ! function_exists( 'handyman_pro_load_handyman_select_county_field_choices__zipcode' ) ) {

	function handyman_pro_load_handyman_select_county_field_choices__zipcode( $field ) {

	   // reset choices
	   $field['choices'] = array();

	   remove_filter('acf/load_field/name=handyman_select_county__zipcode', 'handyman_pro_load_handyman_select_county_field_choices__zipcode');

	   // var_dump(get_field('handyman_manage_city', 'option'));

	   if( have_rows('handyman_manage_zipcode', 'option') ):

		 	// loop through the rows of data
		    while ( have_rows('handyman_manage_zipcode', 'option') ) : the_row();


		    	// var_dump(get_field('handyman_manage_city', 'option'));
		    	// var_dump(get_sub_field('handyman_select_country', 'option'));
		    	// var_dump(get_sub_field('handyman_select_state__city', 'option'));
		    	// var_dump(get_sub_field('handyman_select_county__zipcode', 'option'));
		    	// exit();

		    	foreach (get_field('handyman_manage_city', 'option') as $key => $handyman_manage_city) {

					if ( $handyman_manage_city['handyman_select_country'] === get_sub_field('handyman_select_country', 'option') && 
						 $handyman_manage_city['handyman_select_state__city'] === get_sub_field('handyman_select_state__city', 'option') 
						 /* $handyman_manage_city['handyman_select_county__city'] === get_sub_field('handyman_select_county__zipcode', 'option') */ ) {

						$handyman_add_county_val = $handyman_manage_city['handyman_select_county__city'];

						// var_dump($handyman_add_city_val);
						// exit();

						$field['choices'][$handyman_add_county_val] = get_sub_field('handyman_select_state__city', 'option') . ' | ' . $handyman_add_county_val;
						
					}
				}



		        // display a sub field value
		        //var_dump(get_sub_field('handyman_select_country', 'option'));

		    endwhile;

		else :

		    // no rows found

		endif;

	    add_filter('acf/load_field/name=handyman_select_county__zipcode', 'handyman_pro_load_handyman_select_county_field_choices__zipcode');
	   
	    // return the field
	    return $field;
	    
	}

}



add_filter('acf/load_field/name=handyman_zip_city__zipcode', 'handyman_pro_load_handyman_select_city_field_choices__zipcode');
if ( ! function_exists( 'handyman_pro_load_handyman_select_city_field_choices__zipcode' ) ) {

	function handyman_pro_load_handyman_select_city_field_choices__zipcode( $field ) {

	   // reset choices
	   $field['choices'] = array();

	   remove_filter('acf/load_field/name=handyman_zip_city__zipcode', 'handyman_pro_load_handyman_select_city_field_choices__zipcode');

	   // var_dump(get_field('handyman_manage_city', 'option'));

	   if( have_rows('handyman_manage_zipcode', 'option') ):

		 	// loop through the rows of data
		    while ( have_rows('handyman_manage_zipcode', 'option') ) : the_row();

		    	// var_dump(get_field('handyman_manage_city', 'option'));
		    	// var_dump(get_sub_field('handyman_select_country', 'option'));
		    	// var_dump(get_sub_field('handyman_select_state__city', 'option'));
		    	// var_dump(get_sub_field('handyman_select_county__zipcode', 'option'));
		    	// exit();

		    	foreach (get_field('handyman_manage_city', 'option') as $key => $handyman_manage_city) {

					if ( $handyman_manage_city['handyman_select_country'] === get_sub_field('handyman_select_country', 'option') && 
						 $handyman_manage_city['handyman_select_state__city'] === get_sub_field('handyman_select_state__city', 'option') &&
						 $handyman_manage_city['handyman_select_county__city'] === get_sub_field('handyman_select_county__zipcode', 'option')  ) {

						$handyman_add_city_val = $handyman_manage_city['handyman_add_city__city'];

						// var_dump($handyman_add_city_val);
						// exit();

						$field['choices'][$handyman_add_city_val] = get_sub_field('handyman_select_county__zipcode', 'option') . ' | ' . $handyman_add_city_val;
						
					}
				}

		        // display a sub field value
		        //var_dump(get_sub_field('handyman_select_country', 'option'));

		    endwhile;

		else :

		    // no rows found

		endif;

	    add_filter('acf/load_field/name=handyman_zip_city__zipcode', 'handyman_pro_load_handyman_select_city_field_choices__zipcode');
	   
	    // return the field
	    return $field;
	    
	}

}