<?php

/**
 * Migrate settings from v7.x to v8.x
 */


	/**
	 * Migrate old settings from v7.x or lower to the new v8.x+ format
	 * @return [type] [description]
	 */
	function wpwebapp_migrate_settings() {

		// Get the old settings from v7.x and older
		$saved = get_option( 'wpwebapp_theme_options' );
		if ( empty( $saved ) ) return;

		/**
		 * Migrate the old settings to the new settings
		 */
		update_option('wpwebapp_theme_options_signup', array(
			'signup_username_label' => $saved['signup_username_label'],
			'signup_email_label' => $saved['signup_email_label'],
			'signup_password_label' => $saved['signup_password_label'],
			'signup_submit_text' => $saved['signup_submit_text'],
			'signup_show_requirements' => ( array_key_exists('signup_show_requirements', $saved) ? $saved['signup_show_requirements'] : 'off' ),
			'signup_username_field_empty_error' => $saved['signup_username_field_empty_error'],
			'signup_email_field_empty_error' => $saved['signup_email_field_empty_error'],
			'signup_password_field_empty_error' => $saved['signup_password_field_empty_error'],
			'signup_username_invalid_error' => $saved['signup_username_invalid_error'],
			'signup_username_exists_error' => $saved['signup_username_exists_error'],
			'signup_email_invalid_error' => $saved['signup_email_invalid_error'],
			'signup_email_exists_error' => $saved['signup_email_exists_error'],
			'signup_login_failed_error' => $saved['signup_login_failed_error'],
			'signup_receive_notifications' => ( array_key_exists('signup_receive_notifications', $saved) ? $saved['signup_receive_notifications'] : 'off' ),
			'signup_notification_to_admin' => $saved['signup_notification_to_admin'],
			'signup_send_notifications' => ( array_key_exists('signup_send_notifications', $saved) ? $saved['signup_send_notifications'] : 'off' ),
			'signup_notification_to_user' => $saved['signup_notification_to_user'],
			'create_user_password_time_valid' => $saved['create_user_password_time_valid'],
			'create_user_send_notifications' => ( array_key_exists('create_user_send_notifications', $saved) ? $saved['create_user_send_notifications'] : 'off' ),
			'create_user_notification' => $saved['create_user_notification'],
		));

		update_option('wpwebapp_theme_options_login', array(
			'login_username_label' => $saved['login_username_label'],
			'login_password_label' => $saved['login_password_label'],
			'login_rememberme_label' => $saved['login_rememberme_label'],
			'login_submit_text' =>  $saved['login_submit_text'],
			'login_username_field_empty_error' => $saved['login_username_field_empty_error'],
			'login_password_field_empty_error' => $saved['login_password_field_empty_error'],
			'login_failed_error' => $saved['login_failed_error'],
		));

		update_option('wpwebapp_theme_options_redirects', array(
			'login_redirect' => $saved['login_redirect'],
			'logout_redirect' => $saved['logout_redirect'],
			'password_reset_redirect' => $saved['password_reset_redirect'],
			'add_redirect_referrer' => ( array_key_exists('add_redirect_referrer', $saved) ? $saved['add_redirect_referrer'] : 'off' ),
		));

		update_option('wpwebapp_theme_options_change_email', array(
			'email_change_current_email_label' => $saved['email_change_current_email_label'],
			'email_change_password_label' => $saved['email_change_password_label'],
			'email_change_submit_text' =>  $saved['email_change_submit_text'],
			'email_change_email_field_empty_error' => $saved['email_change_email_field_empty_error'],
			'email_change_password_field_empty_error' => $saved['email_change_password_field_empty_error'],
			'email_change_password_error' => $saved['email_change_password_error'],
			'email_change_success' => $saved['email_change_success'],
		));

		update_option('wpwebapp_theme_options_change_password', array(
			'password_change_current_password_label' => $saved['password_change_current_password_label'],
			'password_change_new_password_label' => $saved['password_change_new_password_label'],
			'password_change_submit_text' => $saved['password_change_submit_text'],
			'password_change_show_requirements' => ( array_key_exists('password_change_show_requirements', $saved) ? $saved['password_change_show_requirements'] : 'off' ),
			'password_change_forced_reset_error' => $saved['password_change_forced_reset_error'],
			'password_change_current_password_field_empty_error' => $saved['password_change_current_password_field_empty_error'],
			'password_change_new_password_field_empty_error' => $saved['password_change_new_password_field_empty_error'],
			'password_change_password_error' => $saved['password_change_password_error'],
			'password_change_success' => $saved['password_change_success'],
			'password_change_receive_notifications' => ( array_key_exists('password_change_receive_notifications', $saved) ? $saved['password_change_receive_notifications'] : 'off' ),
			'password_change_notification_to_admin' => $saved['password_change_notification_to_admin'],
			'password_change_send_notifications' => ( array_key_exists('password_change_send_notifications', $saved) ? $saved['password_change_send_notifications'] : 'off' ),
			'password_change_notification_to_user' => $saved['password_change_notification_to_user'],
		));

		update_option('wpwebapp_theme_options_forgot_password', array(
			'password_reset_url' => $saved['password_reset_url'],
			'password_forgot_label' => $saved['password_forgot_label'],
			'password_forgot_submit_text' => $saved['password_forgot_submit_text'],
			'password_reset_label' => $saved['password_reset_label'],
			'password_reset_submit_text' => $saved['password_reset_submit_text'],
			'password_reset_show_requirements' => ( array_key_exists('password_reset_show_requirements', $saved) ? $saved['password_reset_show_requirements'] : 'off' ),
			'password_forgot_password_field_empty_error' => $saved['password_forgot_password_field_empty_error'],
			'password_forgot_password_invalid_user_error' => $saved['password_forgot_password_invalid_user_error'],
			'password_forgot_password_is_admin_error' => $saved['password_forgot_password_is_admin_error'],
			'password_forgot_password_email_error' => $saved['password_forgot_password_email_error'],
			'password_forgot_password_reset_key_expired_error' => $saved['password_forgot_password_reset_key_expired_error'],
			'password_forgot_password_success' => $saved['password_forgot_password_success'],
			'password_reset_password_field_empty_error' => $saved['password_reset_password_field_empty_error'],
			'password_reset_time_valid' => $saved['password_reset_time_valid'],
			'password_reset_notification_email' => $saved['password_reset_notification_email'],
		));

		update_option('wpwebapp_theme_options_delete_account', array(
			'delete_account_password_label' => $saved['delete_account_password_label'],
			'delete_account_submit_text' =>  $saved['delete_account_submit_text'],
			'delete_account_password_error' => $saved['delete_account_password_error'],
			'delete_account_redirect' => $saved['delete_account_redirect'],
		));

		update_option('wpwebapp_theme_options_security', array(
			'password_minimum_length' => $saved['password_minimum_length'],
			'password_requires_letters' => ( array_key_exists('password_requires_letters', $saved) ? $saved['password_requires_letters'] : 'off' ),
			'password_requires_numbers' => ( array_key_exists('password_requires_numbers', $saved) ? $saved['password_requires_numbers'] : 'off' ),
			'password_requires_special_characters' => ( array_key_exists('password_requires_special_characters', $saved) ? $saved['password_requires_special_characters'] : 'off' ),
			'password_requires_mixed_case' => ( array_key_exists('password_requires_mixed_case', $saved) ? $saved['password_requires_mixed_case'] : 'off' ),
			'show_admin_bar' => ( array_key_exists('show_admin_bar', $saved) ? $saved['show_admin_bar'] : 'off' ),
		));

		// Remove the old settings
		delete_option( 'wpwebapp_theme_options' );

	}
	add_action( 'plugins_loaded', 'wpwebapp_migrate_settings' );