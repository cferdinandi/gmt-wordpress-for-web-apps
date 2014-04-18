<?php

/* ======================================================================

	WordPress for Web Apps Password Reset Forms
	Functions to create and process the password reset forms.

 * ====================================================================== */


// Create Forgot Password Form
// Displayed in `wpwebapp_form_pw_forgot_reset()`
function wpwebapp_form_pw_forgot() {

	if ( is_user_logged_in() ) {
		$form = '<p>' . __( 'You\'re already logged in.', 'wpwebapp' ) . '</p>';
	} else {

		// Variables
		$alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot' ) );
		$submit_text = stripslashes( wpwebapp_get_pw_forgot_text() );
		$submit_class = esc_attr( wpwebapp_get_form_button_class_pw_reset() );
		$custom_layout = stripslashes( wpwebapp_get_form_signup_custom_layout_pw_forgot() );

		if ( $custom_layout === '' ) {
			$form =
				$alert .
				'<form class="form-wpwebapp" id="wpwebapp-form-pw-forgot" name="wpwebapp-form-pw-forgot" action="" method="post">' .
					wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-username-email', __( 'Username or Email', 'wpwebapp' ) ) .
					wpwebapp_form_field_submit_plus( 'wpwebapp-forgot-pw-submit', $submit_class, $submit_text, 'wpwebapp-forgot-pw-process-nonce', 'wpwebapp-forgot-pw-process' ) .
				'</form>';
		} else {
			$add_fields = array(
				'%alert' => $alert,
				'%username' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-username-email', __( 'Username or Email', 'wpwebapp' ) ),
				'%submit' => wpwebapp_form_field_submit( 'wpwebapp-forgot-pw-submit', $submit_class, $submit_text, 'wpwebapp-forgot-pw-process-nonce', 'wpwebapp-forgot-pw-process' ),
			);
			$custom_layout = strtr( $custom_layout, $add_fields );
			$form =
				'<form class="form-wpwebapp" id="wpwebapp-form-pw-forgot" name="wpwebapp-form-pw-forgot" action="" method="post">' .
					$custom_layout .
				'</form>';
		}

	}

	return $form;

}


// Create Reset Password Form
// Displayed in `wpwebapp_form_pw_forgot_reset()`
function wpwebapp_form_pw_reset() {

	if ( is_user_logged_in() ) {
		$form = '<p>' . __( 'You\'re already logged in.', 'wpwebapp' ) . '</p>';
	} else {

		// Variables
		$alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot' ) );
		$user_id = esc_attr( $_GET['id'] );
		$submit_text = stripslashes( wpwebapp_get_pw_reset_text() );
		$submit_class = esc_attr( wpwebapp_get_form_button_class_pw_reset() );
		$pw_requirements = stripslashes( wpwebapp_get_pw_requirements_text() );
		$custom_layout = stripslashes( wpwebapp_get_form_signup_custom_layout_pw_reset() );

		if ( $custom_layout === '' ) {
			$form =
				$alert .
				'<form class="form-wpwebapp" id="wpwebapp-form-pw-reset" name="wpwebapp-form-pw-reset" action="" method="post">' .
					wpwebapp_form_field_text_input_plus( 'password', 'wpwebapp-pw-reset-new-1', sprintf( __( 'New Password %s', 'wpwebapp' ), $pw_requirements ) ) .
					wpwebapp_form_field_text_input_plus( 'password', 'wpwebapp-pw-reset-new-2', __( 'Confirm New Password', 'wpwebapp' ) ) .
					wpwebapp_form_field_text_input( 'hidden', 'wpwebapp-pw-reset-id', '', $user_id ) .
					wpwebapp_form_field_submit_plus( 'wpwebapp-reset-pw-submit', $submit_class, $submit_text, 'wpwebapp-reset-pw-process-nonce', 'wpwebapp-reset-pw-process', '3' ) .
				'</form>';
		} else {
			$add_fields = array(
				'%alert' => $alert,
				'%password' => wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw-reset-new-1', sprintf( __( 'New Password %s', 'wpwebapp' ), $pw_requirements ) ),
				'%password-confirm' => wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw-reset-new-2', __( 'Confirm New Password', 'wpwebapp' ) ),
				'%submit' => wpwebapp_form_field_submit( 'wpwebapp-reset-pw-submit', $submit_class, $submit_text, 'wpwebapp-reset-pw-process-nonce', 'wpwebapp-reset-pw-process' ),
			);
			$custom_layout = strtr( $custom_layout, $add_fields );
			$form =
				'<form class="form-wpwebapp" id="wpwebapp-form-pw-reset" name="wpwebapp-form-pw-reset" action="" method="post">' .
					$custom_layout .
					wpwebapp_form_field_text_input( 'hidden', 'wpwebapp-pw-reset-id', '', $user_id ) .
				'</form>';
		}

	}

	return $form;

}


// Display Forgot & Reset Password Forms
function wpwebapp_form_pw_forgot_and_reset() {

	// Get forgot password alert message
	$status = wpwebapp_get_alert_message( 'wpwebapp_status', 'wpwebapp_status_pw_reset' );

	// If this is password reset URL with a valid key
	if ( $_GET['action'] === 'reset-pw' && $status === 'reset-key-valid' ) {
		$form = wpwebapp_form_pw_reset();
	} else {
		$form = wpwebapp_form_pw_forgot();
	}

	return $form;

}
add_shortcode( 'wpwa_forgot_pw_form', 'wpwebapp_form_pw_forgot_and_reset' );


// Create the email to send to users upon password reset
function wpwebapp_send_pw_reset_email( $to, $user_login, $reset_url ) {

	$from = wpwebapp_get_pw_reset_email_from();
	$site_name = get_bloginfo('name');
	$domain = wpwebapp_get_site_domain();
	$headers = 'From: ' . $site_name . ' <' . $from . '@' . $domain . '>' . "\r\n";
	$subject = wpwebapp_get_pw_reset_email_subject( $site_name );
	$custom_message = wpwebapp_get_pw_reset_email_message();

	if ( $custom_message === '' ) {
		$message =
			sprintf( __( 'We received a request to reset the password for your %1$s account: %2$s.', 'wpwebapp' ), $site_name, $user_login ) . "\r\n\r\n" .
			sprintf( __( 'To reset your password, click on the link below (or copy and paste the URL into your browser): %s', 'wpwebapp' ), $reset_url ) . "\r\n\r\n" .
			__( 'If this was a mistake, just ignore this email.', 'wpwebapp' )  . "\r\n";
	} else {
		$add_content = array(
			'%username' => $user_login,
			'%url' => $reset_url,
		);
		$custom_message = strtr( $custom_message, $add_content );
		$message = $custom_message;
	}

	return wp_mail( $to, $subject, $message, $headers );

}


// Process Forgot Password Form
function wpwebapp_process_pw_forgot() {
	if ( isset( $_POST['wpwebapp-forgot-pw-process'] ) ) {
		if ( wp_verify_nonce( $_POST['wpwebapp-forgot-pw-process'], 'wpwebapp-forgot-pw-process-nonce' ) ) {

			// Forgot Password Variables
			$referer = esc_url_raw( wpwebapp_get_url() );
			$username_email = $_POST['wpwebapp-username-email'];

			// Alert Messages
			$alert_empty_fields = wpwebapp_get_alert_empty_fields();
			$alert_login_does_not_exist = wpwebapp_get_alert_login_does_not_exist();
			$alert_pw_resets_not_allowed = wpwebapp_get_alert_pw_reset_not_allowed();
			$alert_pw_reset_email_success = wpwebapp_get_alert_pw_reset_email_sent();
			$alert_pw_reset_email_failed = wpwebapp_get_alert_pw_reset_email_failed();

			// Check that form is not empty
			if ( $_POST['wpwebapp-username-email'] === '' ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_empty_fields );
				wp_safe_redirect( $referer, 302 );
				exit;
			}

			// Get user
			if ( is_email( $username_email ) ) {
				$user = get_user_by( 'email', $username_email );
			} else {
				$user = get_user_by( 'login', $username_email );
			}

			// Verify that user exists
			if ( !$user ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_login_does_not_exist );
				wp_safe_redirect( $referer, 302 );
				exit;
			}

			// Get user ID
			$user_id = $user->ID;

			// Verify that user is not admin
			$role_requirements = wpwebapp_get_pw_reset_restriction();
			if ( user_can( $user_id, $role_requirements ) ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_pw_resets_not_allowed );
				wp_safe_redirect( $referer, 302 );
				exit;
			}

			// Get user data
			$user_data = get_userdata( $user_id );
			$user_login = $user_data->user_login;
			$user_email = $user_data->user_email;
			$key = wp_generate_password( 24, false );

			// Add a secret, temporary key to the database
			$expiration = wpwebapp_get_pw_reset_time_valid();
			$transient = 'wpwebapp_forgot_pw_key_' . $user_id;
			if ( get_transient( $transient ) ) {
				$value = get_transient( $transient );
			} else {
				$value = array();
			}
			$value[] = $key;
			set_transient( $transient, $value, 60*60*$expiration );

			// Send Password Reset Email
			$reset_url = wpwebapp_prepare_url( $referer ) . 'action=reset-pw&id=' . $user_id . '&key=' . $key;
			$send_email = wpwebapp_send_pw_reset_email( $user_email, $user_login, $reset_url );

			// If email was sent successfully
			if ( $send_email ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_pw_reset_email_success );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_pw_reset_email_failed );
				wp_safe_redirect( $referer, 302 );
				exit;
			}

		} else {
			die( 'Security check' );
		}
	}
}
add_action('init', 'wpwebapp_process_pw_forgot');


// Process Password Reset URL
function wpwebapp_process_pw_reset_url() {

	// Check for password reset URL
	if ( isset( $_GET['action'] ) && $_GET['action'] === 'reset-pw' ) {

		// Get and sanitize current URL
		$referer = esc_url_raw( wpwebapp_get_url() );
		$referer = wpwebapp_clean_url( 'action', $referer );
		$referer = wpwebapp_clean_url( 'id', $referer );
		$referer = wpwebapp_clean_url( 'key', $referer );

		// Password Reset Variables
		$user_id = $_GET['id'];
		$user_key = $_GET['key'];
		$db_keys = get_transient( 'wpwebapp_forgot_pw_key_' . $user_id );

		// Alert Messages
		$alert_pw_reset_url_expired = wpwebapp_get_alert_pw_reset_url_expired();

		// Check if reset key is still active
		if ( !$db_keys || !in_array( $user_key, $db_keys ) ) {
			wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_pw_reset_url_expired );
			wp_safe_redirect( $referer, 302 );
			exit;
		} else {
			wpwebapp_set_alert_message( 'wpwebapp_status', 'wpwebapp_status_pw_reset', 'reset-key-valid' );
			return;
		}

	}
}
add_action('init', 'wpwebapp_process_pw_reset_url');


// Process Password Reset Form
function wpwebapp_process_pw_reset() {
	if ( isset( $_POST['wpwebapp-reset-pw-process'] ) ) {
		if ( wp_verify_nonce( $_POST['wpwebapp-reset-pw-process'], 'wpwebapp-reset-pw-process-nonce' ) ) {

			// Password reset variables
			$referer = esc_url_raw( wpwebapp_get_url() );
			$front_page = esc_url_raw( wpwebapp_get_redirect_url_logged_in() );
			$user_id = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-reset-id'] );
			$user = get_userdata( $user_id );
			$username = $user->user_login;
			$pw_new_1 = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-reset-new-1'] );
			$pw_new_2 = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-reset-new-2'] );
			$pw_test = wpwebapp_password_meets_requirements( $pw_new_1 );

			// Alert Messages
			$alert_empty_fields = wpwebapp_get_alert_empty_fields();
			$alert_pw_match = wpwebapp_get_alert_pw_match();
			$alert_pw_requirements = wpwebapp_get_alert_pw_requirements();

			// Validate and authenticate passwords
			if ( $pw_new_1 === '' || $pw_new_2 === '' ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_reset', $alert_empty_fields );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( $pw_new_1 !== $pw_new_2 ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_reset', $alert_pw_match );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( !$pw_test ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_reset', $alert_pw_requirements );
				wp_safe_redirect( $referer, 302 );
				exit;
			}

			// If no errors exist, change the password and delete key
			wp_update_user( array( 'ID' => $user_id, 'user_pass' => $pw_new_1 ) );
			delete_transient( 'wpwebapp_forgot_pw_key_' . $user_id );

			// Log the user in
			$credentials = array();
			$credentials['user_login'] = $username;
			$credentials['user_password'] = $pw_new_1;
			$credentials['remember'] = true;
			$login = wp_signon( $credentials);
			wp_safe_redirect( $front_page, 302 );
			exit;

		} else {
			die( 'Security check' );
		}
	}
}
add_action('init', 'wpwebapp_process_pw_reset');


// Disable Admin notification when user resets password
if ( !function_exists( 'wp_password_change_notification' ) && wpwebapp_get_email_disable_password_change() === 'on' ) {
	function wp_password_change_notification() { }
}

?>