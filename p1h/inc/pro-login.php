<?php 

$hnx_login_error = '';

function process_form_login() {

		global $wpdb;
		if ( !isset( $_POST['pro_login'] ) || !wp_verify_nonce( $_POST['handyman_pro_nonce'], 'avengers_infinity_war' ) ) {

			   die( 'Failed security check' );

		} else { // process data

			$pro_username				=  sanitize_text_field($_POST['pro_username']);
			$pro_password				=  sanitize_text_field($_POST['pro_password']);

			$login_data = $wpdb->get_row( $wpdb->prepare( "SELECT id, proid, password FROM hxp_pros WHERE username = %s AND status = 'publish'", array( $pro_username ) ), 'ARRAY_A');

				// var_dump($login_data['password']);
				// exit();

			if( $login_data['password'] !== $pro_password ) {

							global $hnx_login_error;

							$hnx_login_error = 'Your account or password is incorrect. If you don\'t remember your password, reset it now.';

							// wp_redirect( home_url('/pro-login/') , 302 );
							// exit();


			} else {


					if( !session_id() ) {

							session_start();

							$_SESSION['prologin'] = true;
							$_SESSION['proid'] = (int) $login_data['id'];
							$_SESSION['posttype_pro_id'] = (int) $login_data['proid'];

							wp_redirect( home_url('/pro-dashboard/') , 302 );
							exit();


					}


			} // $login_data['password'] !== $pro_password



		} // !isset( $_POST['pro_login'] )


} // process_form_login()


if( $_POST && isset($_POST['pro_login']) ) {
		process_form_login();

		global $hnx_login_error;
}


if( !session_id() ) {

	session_start();

	// If logged in redirect to pro dashboard.
	if( isset($_SESSION['prologin']) && isset( $_SESSION['proid']) && $_SESSION['prologin'] === true ) { // Bail
		wp_redirect( home_url('/pro-dashboard/') , 302 );
		exit;
	}

}