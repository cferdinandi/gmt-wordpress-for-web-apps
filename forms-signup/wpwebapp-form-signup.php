<?php

/* ======================================================================

	WordPress for Web Apps Signup Form
	Functions to create and process the signup form.

 * ====================================================================== */


// Create & Display Signup Form
function wpwebapp_form_signup() {

	if ( is_user_logged_in() ) {
		$form = '<p>' . __( 'You already have an account.', 'wpwebapp' ) . '</p>';
	} else {

		// Variables
		$alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup' ) );
		$username = esc_attr( wpwebapp_get_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username' ) );
		$email = esc_attr( wpwebapp_get_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email' ) );
		$submit_text = stripslashes( wpwebapp_get_form_signup_text() );
		$submit_class = esc_attr( wpwebapp_get_form_button_class_signup() );
		$pw_requirements = stripslashes( wpwebapp_get_pw_requirements_text() );
		$custom_layout = wpwebapp_get_form_signup_custom_layout();

		if ( $custom_layout === '' ) {
			$form =
				$alert .
				'<form class="form-wpwebapp" id="wpwebapp-form-signup" name="wpwebapp-form-signup" action="" method="post">' .
					wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-signup-username', __( 'Username', 'wpwebapp' ), $username, '1', 'autofocus' ) .
					wpwebapp_form_field_text_input_plus( 'email', 'wpwebapp-signup-email', __( 'Email', 'wpwebapp' ), $email, '2' ) .
					wpwebapp_form_field_text_input_plus( 'password', 'wpwebapp-signup-password', sprintf( __( 'Password %s', 'wpwebapp' ), $pw_requirements ), '', '3' ) .
					wpwebapp_form_field_submit_plus( 'wpwebapp-signup-submit', $submit_class, $submit_text, 'wpwebapp-signup-process-nonce', 'wpwebapp-signup-process', '4' ) .
				'</form>';
		} else {
			$add_fields = array(
				'%alert' => $alert,
				'%username' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-signup-username', __( 'Username', 'wpwebapp' ), $username ),
				'%email' => wpwebapp_form_field_text_input( 'email', 'wpwebapp-signup-email', __( 'Email', 'wpwebapp' ), $email ),
				'%password' => wpwebapp_form_field_text_input( 'password', 'wpwebapp-signup-password', sprintf( __( 'Password %s', 'wpwebapp' ), $pw_requirements ), '' ),
				'%submit' => wpwebapp_form_field_submit( 'wpwebapp-signup-submit', $submit_class, $submit_text, 'wpwebapp-signup-process-nonce', 'wpwebapp-signup-process' ),
			);
			$custom_layout = strtr( $custom_layout, $add_fields );
			$form =
				'<form class="form-wpwebapp" id="wpwebapp-form-signup" name="wpwebapp-form-signup" action="" method="post">' .
					$custom_layout .
				'</form>';
		}

	}

	return $form;

}
add_shortcode( 'wpwa_signup_form', 'wpwebapp_form_signup' );



// Process Signup Form
function wpwebapp_process_signup() {
	if ( isset( $_POST['wpwebapp-signup-process'] ) ) {
		if ( wp_verify_nonce( $_POST['wpwebapp-signup-process'], 'wpwebapp-signup-process-nonce' ) ) {

			// Signup variables
			$referer = esc_url_raw( wpwebapp_get_url() );
			$front_page = esc_url_raw( wpwebapp_get_redirect_url_logged_in() );
			$username = sanitize_user( $_POST['wpwebapp-signup-username'] );
			$email = sanitize_email( $_POST['wpwebapp-signup-email'] );
			$password = wp_filter_nohtml_kses( $_POST['wpwebapp-signup-password'] );
			$pw_test = wpwebapp_password_meets_requirements( $password );

			// Alert Text
			$alert_empty_fields = wpwebapp_get_alert_empty_fields();
			$alert_username_invalid = wpwebapp_get_alert_username_invalid();
			$alert_username_taken = wpwebapp_get_alert_username_taken();
			$alert_invalid_email = wpwebapp_get_alert_email_invalid();
			$alert_email_taken = wpwebapp_get_alert_email_taken();
			$alert_pw_requirements = wpwebapp_get_alert_pw_requirements();

			// Validate username, email, and password
			if ( $username == '' || $email == '' || $password == '' ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_empty_fields );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( !validate_username( $username ) ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_username_invalid ); // TODO: get from options
				wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( username_exists( $username ) ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_username_taken );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( !is_email( $email ) ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_invalid_email );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( email_exists( $email ) ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_email_taken );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( !$pw_test ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_pw_requirements );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
				wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
				wp_safe_redirect( $referer, 302 );
				exit;
			}

			// If no errors exist, create an account
			wp_create_user( $username, $password, sanitize_email( $email ) );

			// Log new user in
			$credentials = array();
			$credentials['user_login'] = $username;
			$credentials['user_password'] = $password;
			$credentials['remember'] = true;
			$login = wp_signon( $credentials);
			wp_safe_redirect( $front_page, 302 );
			exit;

		} else {
			die( 'Security check' );
		}
	}
}
add_action('init', 'wpwebapp_process_signup');

?>