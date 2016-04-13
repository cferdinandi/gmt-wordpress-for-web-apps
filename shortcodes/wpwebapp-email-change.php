<?php

/**
 * Change email
 */


	// Change email form shortcode
	function wpwebapp_email_change_form() {

		// Prevent this content from caching
		define('DONOTCACHEPAGE', TRUE);

		if ( is_user_logged_in() ) {

			// Variables
			$current_user = wp_get_current_user();
			$options = wpwebapp_get_theme_options();
			$error = wpwebapp_get_session( 'wpwebapp_email_change_error', true );
			$success = wpwebapp_get_session( 'wpwebapp_email_change_success', true );

			$form =
				( empty( $error ) ? '' : '<div class="' . esc_attr( $options['alert_error_class'] ) . '">' . $error . '</div>' ) .
				( empty( $success ) ? '' : '<div class="' . esc_attr( $options['alert_success_class'] ) . '">' . $success . '</div>' ) .

				'<form class="wpwebapp-form" id="wpwebapp_email_change" name="wpwebapp_email_change" action="" method="post">' .

					'<label class="wpwebapp-form-label" for="wpwebapp_email_change_current_email">' . stripslashes( $options['email_change_current_email_label'] ) . '</label>' .
					'<input type="email" class="wpwebapp-form-input" id="wpwebapp_email_change_current_email" name="wpwebapp_email_change_current_email"  value="' . esc_attr( $current_user->user_email ) . '" required>' .

					'<label class="wpwebapp-form-label" for="wpwebapp_email_change_password">' . stripslashes( $options['email_change_password_label'] ) . '</label>' .
					'<input type="password" class="wpwebapp-form-input wpwebapp-form-password" id="wpwebapp_email_change_password" name="wpwebapp_email_change_password"  value="" required>' .

					'<button class="wpwebapp-form-button ' . esc_attr( $options['email_change_submit_class'] ) . '">' . $options['email_change_submit_text'] . '</button>' .

					wp_nonce_field( 'wpwebapp_email_change_nonce', 'wpwebapp_email_change_process', true, false ) .

				'</form>';

		} else {
			$form = '<p>' . __( 'You need to be logged in to change your email address.', 'wpwebapp' ) . '</p>';
		}

		return $form;

	}
	add_shortcode( 'wpwa_change_email', 'wpwebapp_email_change_form' );

	// Process email change
	function wpwebapp_process_email_change() {

		// Verify data came from form
		if ( !isset( $_POST['wpwebapp_email_change_process'] ) || !wp_verify_nonce( $_POST['wpwebapp_email_change_process'], 'wpwebapp_email_change_nonce' ) ) return;

		// Variables
		$current_user = wp_get_current_user();
		$options = wpwebapp_get_theme_options();
		$referer = esc_url_raw( wpwebapp_get_url() );

		// Check that email is supplied
		if ( empty( $_POST['wpwebapp_email_change_current_email'] ) ) {
			wpwebapp_set_session( 'wpwebapp_email_change_error', $options['email_change_email_field_empty_error'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Check that password is provided
		if ( empty( $_POST['wpwebapp_email_change_password'] ) ) {
			wpwebapp_set_session( 'wpwebapp_email_change_error', $options['email_change_password_field_empty_error'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Validate and authenticate password
		if ( !wp_check_password( $_POST['wpwebapp_email_change_password'], $current_user->user_pass, $current_user->ID ) ) {
			wpwebapp_set_session( 'wpwebapp_email_change_error', $options['email_change_password_error'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// If no errors exist, change the email address
		wp_update_user( array( 'ID' => $current_user->ID, 'user_email' => $_POST['wpwebapp_email_change_current_email'] ) );
		wpwebapp_set_session( 'wpwebapp_email_change_success', $options['email_change_success'] );

		// Run custom WordPress action
		do_action( 'wpwebapp_after_email_change', $current_user->ID, $current_user->user_email );

		// Redirect
		wp_safe_redirect( $referer, 302 );
		exit;

	}
	add_action( 'init', 'wpwebapp_process_email_change' );