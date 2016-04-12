<?php

/**
 * Reset Lost Password
 */


	// Forgot password form
	function wpwebapp_password_forgot_form() {

		// Prevent this content from caching
		define('DONOTCACHEPAGE', TRUE);

		if ( is_user_logged_in() ) {
			$form = '<p>' . __( 'You\'re already logged in.', 'wpwebapp' ) . '</p>';
		} else {

			// Variables
			$options = wpwebapp_get_theme_options();
			$error = wpwebapp_get_session( 'wpwebapp_password_reset_error', true );
			$success = wpwebapp_get_session( 'wpwebapp_password_reset_success', true );
			$credentials = wpwebapp_get_session( 'wpwebapp_password_reset_credentials', true );

			// Check if there's an expired reset key
			if ( isset( $_GET['reset_pw'] ) && empty( get_transient( 'wpwebapp_forgot_password_key_' . $_GET['reset_pw'] ) ) ) {
				$error = $options['password_forgot_password_reset_key_expired_error'];
			}

			$form =
				( empty( $error ) ? '' : '<div class="' . esc_attr( $options['alert_error_class'] ) . '">' . $error . '</div>' ) .
				( empty( $success ) ? '' : '<div class="' . esc_attr( $options['alert_success_class'] ) . '">' . $success . '</div>' ) .

				'<form class="wpwebapp-form" id="wpwebapp_password_forgot" name="wpwebapp_password_forgot" action="" method="post">' .

					'<label class="wpwebapp-form-label" for="wpwebapp_password_forgot_username">' . stripslashes( $options['password_forgot_label'] ) . '</label>' .
					'<input type="text" class="wpwebapp-form-input" id="wpwebapp_password_forgot_username" name="wpwebapp_password_forgot_username"  value="' . esc_attr( $credentials ) . '" required>' .

					'<button class="wpwebapp-form-button ' . esc_attr( $options['password_forgot_submit_class'] ) . '">' . $options['password_forgot_submit_text'] . '</button>' .

					wp_nonce_field( 'wpwebapp_password_forgot_nonce', 'wpwebapp_password_forgot_process', true, false ) .

				'</form>';

		}

		return $form;

	}

	// Reset password form
	function wpwebapp_password_reset_form() {

		// Prevent this content from caching
		define('DONOTCACHEPAGE', TRUE);

		if ( is_user_logged_in() ) {
			$form = '<p>' . __( 'You\'re already logged in.', 'wpwebapp' ) . '</p>';
		} else {

			// Variables
			$options = wpwebapp_get_theme_options();
			$error = wpwebapp_get_session( 'wpwebapp_password_reset_error', true );

			$form =
				( empty( $error ) ? '' : '<div class="' . esc_attr( $options['alert_error_class'] ) . '">' . $error . '</div>' ) .

				'<form class="wpwebapp-form" id="wpwebapp_password_reset" name="wpwebapp_password_reset" action="" method="post">' .

					'<label class="wpwebapp-form-label" for="wpwebapp_password_reset_password">' . stripslashes( $options['password_reset_label'] ) . '</label>' .
					'<input type="password" class="wpwebapp-form-input wpwebapp-form-password" id="wpwebapp_password_reset_password" name="wpwebapp_password_reset_password" value="" required>' .

					'<input type="hidden" id="wpwebapp_password_reset_key" name="wpwebapp_password_reset_key"  value="' . $_GET['reset_pw'] . '">' .

					'<button class="wpwebapp-form-button ' . esc_attr( $options['password_reset_submit_class'] ) . '">' . $options['password_reset_submit_text'] . '</button>' .

					wp_nonce_field( 'wpwebapp_password_reset_nonce', 'wpwebapp_password_reset_process', true, false ) .

				'</form>';

		}

		return $form;

	}

	// Display password forgot or reset form
	function wpwebapp_display_password_reset_form() {

		// If this is password reset URL and key is still valid, return reset form
		if ( isset( $_GET['reset_pw'] ) && !empty( get_transient( 'wpwebapp_forgot_password_key_' . $_GET['reset_pw'] ) ) ) {
			return wpwebapp_password_reset_form();
		}

		// Otherwise, return the forgot password form
		return wpwebapp_password_forgot_form();

	}
	add_shortcode( 'wpwa_forgot_password', 'wpwebapp_display_password_reset_form' );

	// Send password reset email
	function wpwebapp_send_password_reset_email( $to, $login, $reset_url ) {

		// Variables
		$site_name = get_bloginfo('name');
		$domain = wpwebapp_get_site_domain();
		$headers = 'From: ' . $site_name . ' <donotreply@' . $domain . '>' . "\r\n";
		$subject = $site_name . ': Password Reset';
		$message =
			sprintf( __( 'We received a request to reset the password for your %1$s account: %2$s.', 'wpwebapp' ), $site_name, esc_attr( $login ) ) . "\r\n\r\n" .
			sprintf( __( 'To reset your password, click on the link below (or copy and paste the URL into your browser): %s', 'wpwebapp' ), esc_url( $reset_url ) ) . "\r\n\r\n" .
			__( 'If this was a mistake, please ignore this email.', 'wpwebapp' )  . "\r\n";

		// Send email
		wp_mail( sanitize_email( $to ), $subject, $message, $headers );

	}

	// Process password forgot
	function wpwebapp_process_password_forgot() {

		// Verify data came from form
		if ( !isset( $_POST['wpwebapp_password_forgot_process'] ) || !wp_verify_nonce( $_POST['wpwebapp_password_forgot_process'], 'wpwebapp_password_forgot_nonce' ) ) return;

		// Variables
		$options = wpwebapp_get_theme_options();
		$referer = esc_url_raw( wpwebapp_clean_url( 'reset_pw', wpwebapp_get_url() ) );

		// Check that a username is supplied
		if ( empty( $_POST['wpwebapp_password_forgot_username'] ) ) {
			wpwebapp_set_session( 'wpwebapp_password_reset_error', $options['password_forgot_password_field_empty_error'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Get user
		$user = is_email( $_POST['wpwebapp_password_forgot_username'] ) ? get_user_by( 'email', $_POST['wpwebapp_password_forgot_username'] ) : get_user_by( 'login', $_POST['wpwebapp_password_forgot_username'] );

		// Verify that user exists
		if ( !$user ) {
			wpwebapp_set_session( 'wpwebapp_password_reset_error', $options['password_forgot_password_invalid_user_error'] );
			wpwebapp_set_session( 'wpwebapp_password_reset_credentials', $_POST['wpwebapp_password_forgot_username'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Verify that user is not admin
		if ( user_can( $user->ID, 'edit_theme_options' ) ) {
			wpwebapp_set_session( 'wpwebapp_password_reset_error', $options['password_forgot_password_is_admin_error'] );
			wpwebapp_set_session( 'wpwebapp_password_reset_credentials', $_POST['wpwebapp_password_forgot_username'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Get user data
		$user_data = get_userdata( $user->ID );
		$key = wp_generate_password( 48, false );

		// Add a secret, temporary key to the database
		set_transient( 'wpwebapp_forgot_password_key_' . $key . $user->ID, $key, 60 * 60 * $options['password_reset_time_valid'] );

		// Send Password Reset Email
		$reset_url = wpwebapp_prepare_url( $referer ) . 'reset_pw=' .$key . $user->ID;
		$send_email = wpwebapp_send_password_reset_email( $user_data->user_email, $user_data->user_login, $reset_url );

		// Run custom WordPress action
		do_action( 'wpwebapp_after_password_forgot_email_sent', $user->ID );

		// Show success message
		wpwebapp_set_session( 'wpwebapp_password_reset_success', $options['password_forgot_password_success'] );
		wp_safe_redirect( $referer, 302 );
		exit;

	}
	add_action( 'init', 'wpwebapp_process_password_forgot' );

	// Process password reset
	function wpwebapp_process_password_reset() {

		// Verify data came from form
		if ( !isset( $_POST['wpwebapp_password_reset_process'] ) || !wp_verify_nonce( $_POST['wpwebapp_password_reset_process'], 'wpwebapp_password_reset_nonce' ) ) return;

		// Variables
		$options = wpwebapp_get_theme_options();
		$referer = esc_url_raw( wpwebapp_get_url() );
		$redirect = wpwebapp_clean_url( 'reset_pw', wpwebapp_get_url() );

		// Check that a password is supplied
		if ( empty( $_POST['wpwebapp_password_reset_password'] ) ) {
			wpwebapp_set_session( 'wpwebapp_password_reset_error', $options['password_reset_password_field_empty_error'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Get user ID
		$user_id = empty( $_POST['wpwebapp_password_reset_key'] ) ? null : substr( $_POST['wpwebapp_password_reset_key'], 48 );
		if ( !$user_id ) {
			wpwebapp_set_session( 'wpwebapp_password_reset_error', $options['password_forgot_password_email_error'] );
			wp_safe_redirect( $redirect, 302 );
			exit;
		}

		// Enforce password requirements
		if ( !wpwebapp_test_password_requirements( $_POST['wpwebapp_password_reset_password'] ) ) {
			$message = wpwebapp_password_requirements_message();
			wpwebapp_set_session( 'wpwebapp_password_reset_error', $message );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Reset the user's password
		wp_update_user( array( 'ID' => $user_id, 'user_pass' => $_POST['wpwebapp_password_reset_password'] ) );
		delete_transient( 'wpwebapp_forgot_pw_key_' . $_POST['wpwebapp_password_reset_key'] );

		// Run custom WordPress action
		do_action( 'wpwebapp_after_password_reset', $user_id );

		// Log the user in
		$user = get_userdata( $user_id );
		$credentials = array(
			'user_login' => $user->user_login,
			'user_password' => $_POST['wpwebapp_password_reset_password'],
			'remember' => true,
		);
		wp_signon( $credentials);

		// Redirect and exit
		wp_safe_redirect( $options['login_redirect'], 302 );
		exit;

	}
	add_action( 'init', 'wpwebapp_process_password_reset' );

	// Disable Admin notification when user resets password
	if ( !function_exists( 'wp_password_change_notification' ) ) {
		$options = wpwebapp_get_theme_options();
		if ( $options['password_reset_notification'] === 'off' ) {
			function wp_password_change_notification() {}
		}
	}