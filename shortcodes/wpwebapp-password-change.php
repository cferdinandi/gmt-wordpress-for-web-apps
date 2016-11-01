<?php

/**
 * Change password
 */


	// Password change form shortcode
	function wpwebapp_password_change_form() {

		// Prevent this content from caching
		define('DONOTCACHEPAGE', TRUE);

		if ( is_user_logged_in() ) {

			// Variables
			$options = wpwebapp_get_theme_options();
			$error = wpwebapp_get_session( 'wpwebapp_password_change_error', true );
			$success = wpwebapp_get_session( 'wpwebapp_password_change_success', true );

			// Check if forced reset is required
			$current_user = wp_get_current_user();
			$force_reset = get_user_meta( $current_user->ID, 'wpwebapp_force_password_reset', true );

			$form =
				( $force_reset === 'on' ? '<div class="' . esc_attr( $options['alert_error_class'] ) . '">' . stripslashes( $options['password_change_forced_reset_error'] ) . '</div>' : '' ) .
				( empty( $error ) ? '' : '<div class="' . esc_attr( $options['alert_error_class'] ) . '">' . stripslashes( $error ) . '</div>' ) .
				( empty( $success ) ? '' : '<div class="' . esc_attr( $options['alert_success_class'] ) . '">' . stripslashes( $success ) . '</div>' ) .

				'<form class="wpwebapp-form" id="wpwebapp_password_change" name="wpwebapp_password_change" action="" method="post">' .

					'<label class="wpwebapp-form-label" for="wpwebapp_password_change_current_password">' . stripslashes( $options['password_change_current_password_label'] ) . '</label>' .
					'<input type="password" class="wpwebapp-form-input wpwebapp-form-password" id="wpwebapp_password_change_current_password" name="wpwebapp_password_change_current_password"  value="" required>' .

					'<label class="wpwebapp-form-label" for="wpwebapp_password_change_new_password">' . stripslashes( $options['password_change_new_password_label'] ) . '</label>' .
					'<input type="password" class="wpwebapp-form-input wpwebapp-form-password" id="wpwebapp_password_change_new_password" name="wpwebapp_password_change_new_password"  value="" required>' .

					'<button class="wpwebapp-form-button ' . esc_attr( $options['password_change_submit_class'] ) . '">' . $options['password_change_submit_text'] . '</button>' .

					wp_nonce_field( 'wpwebapp_password_change_nonce', 'wpwebapp_password_change_process', true, false ) .

				'</form>';

		} else {
			$form = '<p>' . __( 'You need to be logged in to change your password.', 'wpwebapp' ) . '</p>';
		}

		return $form;

	}
	add_shortcode( 'wpwa_change_password', 'wpwebapp_password_change_form' );


	// Send password change email to the admin
	function wpwebapp_send_password_change_email_to_admin( $login, $email ) {

		// Check if admin wants to receive emails
		$options = wpwebapp_get_theme_options();
		if ( $options['password_change_receive_notifications'] === 'off' ) return;

		// Variables
		$site_name = get_bloginfo('name');
		$domain = wpwebapp_get_site_domain();
		$headers = 'From: ' . $site_name . ' <donotreply@' . $domain . '>' . "\r\n";
		$subject = $site_name . ': User Password Change';
		$message  = str_replace( '[email]', sanitize_email( $email ), str_replace( '[username]', esc_attr( $login ), stripslashes( $options['password_change_notification_to_admin'] ) ) );

		// Send email
		@wp_mail( get_option('admin_email'), $subject, $message, $headers );

	}


	// Send password change email to the user
	function wpwebapp_send_password_change_email_to_user( $login, $email ) {

		// Check if user should receive email
		$options = wpwebapp_get_theme_options();
		if ( $options['password_change_send_notifications'] === 'off' ) return;

		// Variables
		$site_name = get_bloginfo('name');
		$domain = wpwebapp_get_site_domain();
		$headers = 'From: ' . $site_name . ' <donotreply@' . $domain . '>' . "\r\n";
		$subject = $site_name . ': Your Password Was Changed';
		$message  = str_replace( '[username]', esc_attr( $login ), stripslashes( $options['password_change_notification_to_user'] ) );

		// Send email
		@wp_mail( sanitize_email( $email ), $subject, $message, $headers );

	}


	// Process password change
	function wpwebapp_process_password_change() {

		// Verify data came from form
		if ( !isset( $_POST['wpwebapp_password_change_process'] ) || !wp_verify_nonce( $_POST['wpwebapp_password_change_process'], 'wpwebapp_password_change_nonce' ) ) return;

		// Variables
		$current_user = wp_get_current_user();
		$force_reset = get_user_meta( $current_user->ID, 'wpwebapp_force_password_reset', true );
		$options = wpwebapp_get_theme_options();
		$referer = esc_url_raw( wpwebapp_get_url() );

		// Check that current password is supplied
		if ( empty( $_POST['wpwebapp_password_change_current_password'] ) ) {
			wpwebapp_set_session( 'wpwebapp_password_change_error', $options['password_change_current_password_field_empty_error'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Check that new password is provided
		if ( empty( $_POST['wpwebapp_password_change_new_password'] ) ) {
			wpwebapp_set_session( 'wpwebapp_password_change_error', $options['password_change_new_password_field_empty_error'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Validate and authenticate current password
		if ( !wp_check_password( $_POST['wpwebapp_password_change_current_password'], $current_user->user_pass, $current_user->ID ) ) {
			wpwebapp_set_session( 'wpwebapp_password_change_error', $options['password_change_password_error'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Enforce password requirements
		if ( !wpwebapp_test_password_requirements( $_POST['wpwebapp_password_change_new_password'] ) ) {
			$message = wpwebapp_password_requirements_message();
			wpwebapp_set_session( 'wpwebapp_password_change_error', $message );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Enforce different password on forced password reset
		if ( $force_reset === 'on' && $_POST['wpwebapp_password_change_current_password'] === $_POST['wpwebapp_password_change_new_password'] ) {
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// If no errors exist, change the password
		wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => $_POST['wpwebapp_password_change_new_password'] ) );
		wpwebapp_set_session( 'wpwebapp_password_change_success', $options['password_change_success'] );

		// Send password change emails
		wpwebapp_send_password_change_email_to_admin( $current_user->user_login, $current_user->user_email );
		wpwebapp_send_password_change_email_to_user( $current_user->user_login, $current_user->user_email );

		// Remove forced password reset if one was set
		update_user_meta( $current_user->ID, 'wpwebapp_force_password_reset', 'off' );

		// Run custom WordPress action
		do_action( 'wpwebapp_after_password_change', $current_user->ID );

		// Redirect
		$redirect = $force_reset === 'on' && isset( $_GET['referrer'] ) && !empty( $_GET['referrer'] ) ? esc_url_raw( $_GET['referrer'] ) : $referer;
		wp_safe_redirect( $redirect, 302 );
		exit;

	}
	add_action( 'init', 'wpwebapp_process_password_change' );


	// Send password change emails when the password is changed from the dashboard or some other method
	function wpwebapp_send_dashboard_password_change_emails( $user ) {

		// Don't run if password change happens via a shortcode form
		if ( isset( $_POST['wpwebapp_password_change_process'] ) || isset( $_POST['wpwebapp_password_reset_process'] ) ) return;

		// Send password change emails
		wpwebapp_send_password_change_email_to_admin( $user->user_login, $user->user_email );
		wpwebapp_send_password_change_email_to_user( $user->user_login, $user->user_email );

	}
	add_action( 'after_password_reset', 'wpwebapp_send_dashboard_password_change_emails' );