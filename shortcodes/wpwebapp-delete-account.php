<?php

/**
 * Delete user account
 */


	// Delete account form shortcode
	function wpwebapp_delete_account_form() {

		// Prevent this content from caching
		define('DONOTCACHEPAGE', TRUE);

		if ( is_user_logged_in() ) {

			// Variables
			$options = wpwebapp_get_theme_options();
			$error = wpwebapp_get_session( 'wpwebapp_delete_account_error', true );

			$form =
				( empty( $error ) ? '' : '<div class="' . esc_attr( $options['alert_error_class'] ) . '">' . $error . '</div>' ) .
				'<form class="wpwebapp-form" id="wpwebapp_delete_account" name="wpwebapp_delete_account" action="" method="post">' .
					'<label class="wpwebapp-form-label" for="wpwebapp_delete_account_password">' . stripslashes( $options['delete_account_password_label'] ) . '</label>' .
					'<input type="password" class="wpwebapp-form-input wpwebapp-form-password" id="wpwebapp_delete_account_password" name="wpwebapp_delete_account_password"  value="" required>' .
					'<button class="wpwebapp-form-button ' . esc_attr( $options['delete_account_submit_class'] ) . '">' . $options['delete_account_submit_text'] . '</button>' .
					wp_nonce_field( 'wpwebapp_delete_account_nonce', 'wpwebapp_delete_account_process', true, false ) .
				'</form>';

		} else {
			$form = '<p>' . __( 'You need to be logged in to delete your account.', 'wpwebapp' ) . '</p>';
		}

		return $form;

	}
	add_shortcode( 'wpwa_delete_account', 'wpwebapp_delete_account_form' );

	// Process account deletion
	function wpwebapp_process_delete_account() {

		// Verify data came from form
		if ( !isset( $_POST['wpwebapp_delete_account_process'] ) || !wp_verify_nonce( $_POST['wpwebapp_delete_account_process'], 'wpwebapp_delete_account_nonce' ) ) return;

		// Require user.php
		require_once( ABSPATH . 'wp-admin/includes/user.php' );

		// Variables
		$current_user = wp_get_current_user();
		$options = wpwebapp_get_theme_options();
		$referer = esc_url_raw( wpwebapp_get_url() );
		$redirect = esc_url_raw( $options['delete_account_redirect'] );

		// Verify that password matches
		if ( !isset( $_POST['wpwebapp_delete_account_password'] ) || !wp_check_password( $_POST['wpwebapp_delete_account_password'], $current_user->user_pass, $current_user->ID ) ) {
			wpwebapp_set_session( 'wpwebapp_delete_account_error', $options['delete_account_password_error'] );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Verify that user is NOT an admin
		if ( current_user_can( 'edit_theme_options' ) ) {
			wpwebapp_set_session( 'wpwebapp_delete_account_error', __( 'This account cannot be deleted.', 'wpwebapp' ) );
			wp_safe_redirect( $referer, 302 );
			exit;
		}

		// Delete current user's account
		wp_delete_user( $current_user->ID );

		// Run custom WordPress action
		do_action( 'wpwebapp_after_delete_user',  $current_user->user_login, $current_user->user_email );

		// Redirect
		wp_safe_redirect( $redirect, 302 );
		exit;

	}
	add_action( 'init', 'wpwebapp_process_delete_account' );