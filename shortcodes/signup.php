<?php

/**
 * Create an account
 */


	// Sign up form shortcode
	function wpwebapp_signup_form() {

		// Prevent this content from caching
		define('DONOTCACHEPAGE', TRUE);

		if ( is_user_logged_in() ) {
			$form = '<p>' . __( 'You\'re already logged in.', 'wpwebapp' ) . '</p>';
		} else {

			// Variables
			$options = wpwebapp_get_theme_options_signup();
			$error = wpwebapp_get_session( 'wpwebapp_signup_error', true );
			$credentials = wpwebapp_get_session( 'wpwebapp_signup_credentials', true );
			$pw_requirements = $options['signup_show_requirements'] === 'on' ? '<div class="wpwebapp-form-label-description">' . wpwebapp_password_requirements_message() . '</div>' : null;
			if ( empty( $credentials ) || !is_object( $credentials ) ) {
				$credentials = array(
					'username' => '',
					'email' => '',
				);
			}

			$form =
				( empty( $error ) ? '' : '<div class="wpwebapp_alert wpwebapp_alert_error">' . stripslashes( $error ) . '</div>' ) .

				'<form class="wpwebapp-form" id="wpwebapp_signup" name="wpwebapp_signup" action="" method="post">' .

					'<label class="wpwebapp-form-label" for="wpwebapp_signup_username">' . stripslashes( $options['signup_username_label'] ) . '</label>' .
					'<input type="text" class="wpwebapp-form-input" id="wpwebapp_signup_username" name="wpwebapp_signup_username"  value="' . esc_attr( $credentials['username'] ) . '" required>' .

					'<label class="wpwebapp-form-label" for="wpwebapp_signup_email">' . stripslashes( $options['signup_email_label'] ) . '</label>' .
					'<input type="email" class="wpwebapp-form-input" id="wpwebapp_signup_email" name="wpwebapp_signup_email"  value="' . esc_attr( $credentials['email'] ) . '" required>' .

					'<label class="wpwebapp-form-label" for="wpwebapp_signup_password">' . stripslashes( $options['signup_password_label'] ) . '</label>' .
					'<input type="password" class="wpwebapp-form-input wpwebapp-form-password ' . ( empty( $pw_requirements ) ? '' : 'wpwebapp-form-input-has-description' ) . '" id="wpwebapp_signup_password" name="wpwebapp_signup_password"  value="" required>' .
					$pw_requirements .

					'<label class="wpwebapp-form-label wpwebapp-form-label-tarpit" for="wpwebapp_signup_password_confirm">' . __( 'If you are human, leave this blank', 'beacon' ) . '</label>' .
					'<input type="text" class="wpwebapp-form-input wpwebapp-form-password wpwebapp-form-input-tarpit" id="wpwebapp_signup_password_confirm" name="wpwebapp_signup_password_confirm"  value="">' .

					'<button class="wpwebapp-form-button wpwebapp-form-button-signup">' . $options['signup_submit_text'] . '</button>' .

					'<input type="hidden" id="wpwebapp_signup_tarpit_time" name="wpwebapp_signup_tarpit_time" value="' . current_time( 'timestamp' ) . '">' .

					wp_nonce_field( 'wpwebapp_signup_nonce', 'wpwebapp_signup_process', true, false ) .

				'</form>';

		}

		return $form;

	}
	add_shortcode( 'wpwa_signup', 'wpwebapp_signup_form' );

	// Send notification email to admin when new account created
	function wpwebapp_send_user_notification_email( $login, $email ) {

		// Check if admin wants to receive emails
		$options = wpwebapp_get_theme_options_signup();
		if ( $options['signup_receive_notifications'] === 'off' ) return;

		// Variables
		$site_name = get_bloginfo('name');
		$domain = wpwebapp_get_site_domain();
		$headers = 'From: ' . $site_name . ' <donotreply@' . $domain . '>' . "\r\n";
		$subject = $site_name . ': New User Registration';
		$message  = str_replace( '[email]', sanitize_email( $email ), str_replace( '[username]', esc_attr( $login ), stripslashes( $options['signup_notification_to_admin'] ) ) );

		// Send email
		@wp_mail( get_option('admin_email'), $subject, $message, $headers );

	}

	// Send notification email to member when new account created
	function wpwebapp_send_user_welcome_email( $login, $email ) {

		// Check if user should receive emails
		$options = wpwebapp_get_theme_options();
		$redirects = wpwebapp_get_theme_options_redirects();
		if ( $options['signup_send_notifications'] === 'off' ) return;

		// Variables
		$site_name = get_bloginfo('name');
		$domain = wpwebapp_get_site_domain();
		$headers = 'From: ' . $site_name . ' <donotreply@' . $domain . '>' . "\r\n";
		$subject = 'Welcome to ' . $site_name;
		$message  = str_replace( '[login]', $redirects['logout_redirect'], str_replace( '[username]', esc_attr( $login ), stripslashes( $options['signup_notification_to_user'] ) ) );

		// Send email
		$email = @wp_mail( sanitize_email( $email ), $subject, $message, $headers );

	}

	// Create new user account
	function wpwebapp_create_new_user() {
		// @todo include an option to select the type of user role to assign member to (allows for custom roles)

		// Verify data came from form
		if ( !isset( $_POST['wpwebapp_signup_process'] ) || !wp_verify_nonce( $_POST['wpwebapp_signup_process'], 'wpwebapp_signup_nonce' ) ) return;

		// Variables
		$options = wpwebapp_get_theme_options_signups();
		$redirects = wpwebapp_get_theme_options_redirects();
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

		// Honeypots
		if ( !empty( $_POST['wpwebapp_signup_password_confirm'] ) || !isset( $_POST['wpwebapp_signup_tarpit_time'] ) || current_time( 'timestamp' ) - $_POST['wpwebapp_signup_tarpit_time'] < 2 ) {
			$message = __( 'We are unable to create your account. Sorry.', 'beacon' );
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
		$redirect = isset( $_GET['referrer'] ) && !empty( $_GET['referrer'] ) ? esc_url_raw( $_GET['referrer'] ) : wpwebapp_get_redirect_url( $redirects['login_redirect'] );
		wp_safe_redirect( $redirect, 302 );
		exit;

	}
	add_action( 'init', 'wpwebapp_create_new_user' );

	// Add honeypot classes to the header
	function beacon_load_honeypot_styles() {
		?>
			<style>
				.wpwebapp-form-label-tarpit,
				.wpwebapp-form-input-tarpit {
					display: none;
					visibility: hidden;
				}
			</style>
		<?php
	}
	add_action('wp_head', 'beacon_load_honeypot_styles', 30);

	// Disable default new user admin notifications
	if ( !function_exists( 'wp_new_user_notification' ) ) {
		function wp_new_user_notification() {}
	}

	// Send notification when user is manually created via the Dashboard
	function wpwebapp_create_user_notification_email( $user_id ) {

		// Don't run user was created via the front-end
		if ( isset( $_POST['wpwebapp_signup_process'] ) ) return;

		// Check if users should receive emails
		$options = wpwebapp_get_theme_options();
		$redirects = wpwebapp_get_theme_options_redirects();
		$pw_reset = wpwebapp_get_theme_options_forgot_password();
		if ( $options['create_user_send_notifications'] === 'off' ) return;

		// Variables
		$site_name = get_bloginfo('name');
		$domain = wpwebapp_get_site_domain();
		$pw = empty( $pw_reset['password_reset_url'] ) ? null : wpwebapp_get_redirect_url( $pw_reset['password_reset_url'] );
		$pw_reset = empty( $pw ) ? '' : wpwebapp_set_reset_key( $user_id, $pw, $options['create_user_password_time_valid'] );
		$headers = 'From: ' . $site_name . ' <donotreply@' . $domain . '>' . "\r\n";
		$subject = 'Welcome to ' . $site_name;
		$message  = str_replace( '[expires]', $options['create_user_password_time_valid'], str_replace( '[pw_reset]', $pw_reset, str_replace( '[username]', esc_attr( $_POST['user_login'] ), stripslashes( $options['create_user_notification'] ) ) ) );

		// Send email
		@wp_mail( get_option('admin_email'), $subject, $message, $headers );

	}
	add_action( 'user_register', 'wpwebapp_create_user_notification_email', 10, 1 );