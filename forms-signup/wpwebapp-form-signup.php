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
					wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-signup-username', __( 'Username', 'wpwebapp' ), $username ) .
					wpwebapp_form_field_text_input_plus( 'email', 'wpwebapp-signup-email', __( 'Email', 'wpwebapp' ), $email ) .
					wpwebapp_form_field_text_input_plus( 'password', 'wpwebapp-signup-password', sprintf( __( 'Password %s', 'wpwebapp' ), $pw_requirements ) ) .
					wpwebapp_form_field_submit_plus( 'wpwebapp-signup-submit', $submit_class, $submit_text, 'wpwebapp-signup-process-nonce', 'wpwebapp-signup-process' ) .
				'</form>';
		} else {
			$add_fields = array(
				'%alert' => $alert,
				'%username' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-signup-username', __( 'Username', 'wpwebapp' ), $username ),
				'%email' => wpwebapp_form_field_text_input( 'email', 'wpwebapp-signup-email', __( 'Email', 'wpwebapp' ), $email ),
				'%password' => wpwebapp_form_field_text_input( 'password', 'wpwebapp-signup-password', sprintf( __( 'Password %s', 'wpwebapp' ), $pw_requirements ) ),
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



// Create the notification email to send to admin when new user signs up
function wpwebapp_send_new_user_admin_notification_email( $user_login, $user_email ) {
	if ( wpwebapp_get_send_new_user_email_admin() === 'on' ) {
		$message  =
			sprintf( __( 'New user registration on %s:', 'wpwebapp' ), get_option('blogname') ) . "\r\n\r\n" .
			sprintf( __( 'Username: %s', 'wpwebapp' ), $user_login ) . "\r\n\r\n" .
			sprintf( __( 'E-mail: %s', 'wpwebapp' ), $user_email ) . "\r\n";
		@wp_mail( get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname') ), $message );
	}
}



// Create the welcome email to send to new users
function wpwebapp_send_new_user_welcome_email( $user_login, $user_email ) {

	if ( wpwebapp_get_send_new_user_email_user() === 'on' ) {

		// Email Info
		$from = wpwebapp_get_new_user_email_from();
		$site_name = get_bloginfo('name');
		$domain = wpwebapp_get_site_domain();
		$headers = 'From: ' . $site_name . ' <' . $from . '@' . $domain . '>' . "\r\n";
		$subject = wpwebapp_get_new_user_email_subject( $site_name );
		$custom_message = wpwebapp_get_send_new_user_email_message();

		if ( $custom_message === '' ) {
			$message  =
				sprintf( __( 'Welcome to %s. ', 'wpwebapp' ), get_option('blogname') ) .
				sprintf( __( 'Your username is %s. ', 'wpwebapp' ), $user_login ) .
				sprintf( __( 'Login at %s.', 'wpwebapp' ), site_url() );
		} else {
			$add_content = array(
				'%username' => $user_login,
				'%email' => $user_email,
			);
			$custom_message = strtr( $custom_message, $add_content );
			$message = $custom_message;
		}

		wp_mail( $user_email, $subject, $message, $headers );

	}

}



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
			if ( $username === '' || $email === '' || $password === '' ) {
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

			// If no errors exist, create an account and send notification emails
			wp_create_user( $username, $password, sanitize_email( $email ) );
			wpwebapp_send_new_user_admin_notification_email( $username, $email );
			wpwebapp_send_new_user_welcome_email( $username, $email );

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


// Disable default new user admin notifications
if ( !function_exists( 'wp_new_user_notification' ) ) {
	function wp_new_user_notification() {}
}

?>