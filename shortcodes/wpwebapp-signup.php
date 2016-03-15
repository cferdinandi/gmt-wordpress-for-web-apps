<?php

/**
 * Create an account
 */


	// Sign up form shortcode
	function wpwebapp_signup_form() {

		if ( is_user_logged_in() ) {
			$form = '<p>' . __( 'You\'re already logged in.', 'wpwebapp' ) . '</p>';
		} else {

			// Variables
			$options = wpwebapp_get_theme_options();
			$error = wpwebapp_get_session( 'wpwebapp_signup_error', true );
			$credentials = wpwebapp_get_session( 'wpwebapp_signup_credentials', true );
			if ( empty( $credentials ) || !is_object( $credentials ) ) {
				$credentials = array(
					'username' => '',
					'email' => '',
				);
			}

			$form =
				( empty( $error ) ? '' : '<div class="' . esc_attr( $options['alert_error_class'] ) . '">' . $error . '</div>' ) .

				'<form class="wpwebapp-form" id="wpwebapp_signup" name="wpwebapp_signup" action="" method="post">' .

					'<label class="wpwebapp-form-label" for="wpwebapp_signup_username">' . $options['signup_username_label'] . '</label>' .
					'<input type="text" class="wpwebapp-form-input" id="wpwebapp_signup_username" name="wpwebapp_signup_username"  value="' . esc_attr( $credentials['username'] ) . '" required>' .

					'<label class="wpwebapp-form-label" for="wpwebapp_signup_email">' . $options['signup_email_label'] . '</label>' .
					'<input type="email" class="wpwebapp-form-input" id="wpwebapp_signup_email" name="wpwebapp_signup_email"  value="' . esc_attr( $credentials['email'] ) . '" required>' .

					'<label class="wpwebapp-form-label" for="wpwebapp_signup_password">' . $options['signup_password_label'] . '</label>' .
					'<input type="password" class="wpwebapp-form-input wpwebapp-form-password" id="wpwebapp_signup_password" name="wpwebapp_signup_password"  value="" required>' .

					'<button class="wpwebapp-form-button ' . esc_attr( $options['signup_submit_class'] ) . '">' . $options['signup_submit_text'] . '</button>' .

					wp_nonce_field( 'wpwebapp_signup_nonce', 'wpwebapp_signup_process' ) .

				'</form>';

		}

		return $form;

	}
	add_shortcode( 'wpwa_signup', 'wpwebapp_signup_form' );

	// Send notification email to admin when new account created
	function wpwebapp_send_user_notification_email( $login, $email ) {

		// Check if admin wants to receive emails
		$options = wpwebapp_get_theme_options();
		if ( $options['signup_receive_notifications'] === 'off' ) return;

		// Variables
		$site_name = get_bloginfo('name');
		$domain = wpwebapp_get_site_domain();
		$headers = 'From: ' . $site_name . ' <donotreply@' . $domain . '>' . "\r\n";
		$subject = $site_name . ': New User Registration';
		$message  =
			sprintf( __( 'New user registration for %s:', 'wpwebapp' ), get_option('blogname') ) . "\r\n\r\n" .
			sprintf( __( 'Username: %s', 'wpwebapp' ), esc_attr( $login ) ) . "\r\n\r\n" .
			sprintf( __( 'Email: %s', 'wpwebapp' ), sanitize_email( $email ) ) . "\r\n";

		// Send email
		@wp_mail( get_option('admin_email'), $subject, $message, $headers );

	}

	// Send notification email to member when new account created
	function wpwebapp_send_user_welcome_email( $login, $email ) {

		// Check if user should receive emails
		$options = wpwebapp_get_theme_options();
		if ( $options['signup_receive_notifications'] === 'off' ) return;

		// Variables
		$site_name = get_bloginfo('name');
		$domain = wpwebapp_get_site_domain();
		$headers = 'From: ' . $site_name . ' <donotreply@' . $domain . '>' . "\r\n";
		$subject = 'Welcome to ' . $site_name;
		$message  =
			sprintf( __( 'Welcome to %s. ', 'wpwebapp' ), $site_name ) .
			sprintf( __( 'Your username is %s. ', 'wpwebapp' ), esc_attr( $login ) ) .
			sprintf( __( 'Login at %s.', 'wpwebapp' ), site_url() ) . "\r\n";

		// Send email
		@wp_mail( sanitize_email( $email ), $subject, $message, $headers );

	}

	// @todo Create new user account
	function wpwebapp_create_new_user() {
		// @todo include an option to select the type of user role to assign member to (allows for custom roles)

		// Verify data came from form
		if ( !isset( $_POST['wpwebapp_signup_process'] ) || !wp_verify_nonce( $_POST['wpwebapp_signup_process'], 'wpwebapp_signup_nonce' ) ) return;

		// Variables
		$options = wpwebapp_get_theme_options();
		$referer = esc_url_raw( wpwebapp_get_url() );
		$credentials = array(
			'username' => $_POST['wpwebapp_signup_username'],
			'email' => $_POST['wpwebapp_signup_email'],
		);

		// Check that username is supplied
		if ( empty( $_POST['wpwebapp_signup_username'] ) ) {
			wpwebapp_set_session( 'wpwebapp_signup_error', $options['signup_username_field_empty_error'] );
			wpwebapp_set_session( 'wpwebapp_signup_credentials', $credentials );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Check that email is supplied
		if ( empty( $_POST['wpwebapp_signup_email'] ) ) {
			wpwebapp_set_session( 'wpwebapp_signup_error', $options['signup_email_field_empty_error'] );
			wpwebapp_set_session( 'wpwebapp_signup_credentials', $credentials );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Check that password is supplied
		if ( empty( $_POST['wpwebapp_signup_password'] ) ) {
			wpwebapp_set_session( 'wpwebapp_signup_error', $options['signup_password_field_empty_error'] );
			wpwebapp_set_session( 'wpwebapp_signup_credentials', $credentials );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Check that username is valid
		if ( !validate_username( $_POST['wpwebapp_signup_username'] ) ) {
			wpwebapp_set_session( 'wpwebapp_signup_error', $options['signup_username_invalid_error'] );
			wpwebapp_set_session( 'wpwebapp_signup_credentials', $credentials );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Check that username isn't already taken
		if ( username_exists( $_POST['wpwebapp_signup_username'] ) ) {
			wpwebapp_set_session( 'wpwebapp_signup_error', $options['signup_username_exists_error'] );
			wpwebapp_set_session( 'wpwebapp_signup_credentials', $credentials );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Check that email address is valid
		if ( !is_email( $_POST['wpwebapp_signup_email'] ) ) {
			wpwebapp_set_session( 'wpwebapp_signup_error', $options['signup_email_invalid_error'] );
			wpwebapp_set_session( 'wpwebapp_signup_credentials', $credentials );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Check that email isn't already taken
		if ( email_exists( $_POST['wpwebapp_signup_email'] ) ) {
			wpwebapp_set_session( 'wpwebapp_signup_error', $options['signup_email_exists_error'] );
			wpwebapp_set_session( 'wpwebapp_signup_credentials', $credentials );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Enforce password requirements
		if ( !wpwebapp_test_password_requirements( $_POST['wpwebapp_signup_password'] ) ) {
			$message = wpwebapp_password_requirements_message();
			wpwebapp_set_session( 'wpwebapp_signup_error', $message );
			wpwebapp_set_session( 'wpwebapp_signup_credentials', $credentials );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// If no errors exist, create an account and send notification emails
		wp_create_user( $_POST['wpwebapp_signup_username'], $_POST['wpwebapp_signup_password'], sanitize_email( $_POST['wpwebapp_signup_email'] ) );
		wpwebapp_send_user_notification_email( $_POST['wpwebapp_signup_username'], $_POST['wpwebapp_signup_email'] );
		wpwebapp_send_user_welcome_email( $_POST['wpwebapp_signup_username'], $_POST['wpwebapp_signup_email'] );

		// Run custom WordPress action
		do_action( 'wpwebapp_after_signup', $_POST['wpwebapp_signup_username'], sanitize_email( $_POST['wpwebapp_signup_email'] ) );

		// Log user in
		$credentials = array(
			'user_login' => $_POST['wpwebapp_signup_username'],
			'user_password' => $_POST['wpwebapp_signup_password'],
			'remember' => true,
		);
		$login = wp_signon( $credentials );

		// If errors
		if ( is_wp_error( $login ) ) {
			wpwebapp_set_session( 'wpwebapp_signup_error', $options['signup_login_failed_error'] );
			wpwebapp_set_session( 'wpwebapp_signup_credentials', $credentials );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Redirect after login
		$redirect = isset( $_GET['referrer'] ) && !empty( $_GET['referrer'] ) ? esc_url_raw( $_GET['referrer'] ) : $options['login_redirect'];
		wp_safe_redirect( $redirect, 302 );
		exit;

	}
	add_action( 'init', 'wpwebapp_create_new_user' );

	// Disable default new user admin notifications
	if ( !function_exists( 'wp_new_user_notification' ) ) {
		function wp_new_user_notification() {}
	}