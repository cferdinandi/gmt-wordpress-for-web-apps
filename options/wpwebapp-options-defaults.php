<?php

/* ======================================================================

	WordPress for Web App Options Defaults
	Used to create the settings menu.

 * ====================================================================== */


// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options() {
	$saved = (array) get_option( 'wpwebapp_plugin_options' );
	$defaults = array(
		// Security
		'minimum_password_length' => '',
		'password_requirements_letters' => 'off',
		'password_requirements_numbers' => 'off',
		'password_requirements_special_chars' => 'off',
		'restrict_pw_reset' => 'subscriber',
		'pw_reset_time_valid' => '',

		// User Access
		'block_wp_backend_access' => 'admin',
		'redirect_logged_in' => '',
		'redirect_logged_out' => '',
		'blog_posts_require_login' => 'off',

		// Forms
		'button_class' => '',
		'delete_button_class' => '',
		'button_text_login' => '',
		'button_text_signup' => '',
		'button_text_pw_change' => '',
		'button_text_pw_forgot' => '',
		'button_text_pw_reset' => '',
		'forgot_pw_url' => '',
		'forgot_pw_url_text' => '',
		'pw_requirement_text' => '',
		'delete_account_text' => '',
		'delete_account_url' => '',

		// Alerts
		'alert_empty_fields' => '',
		'alert_pw_requirements' => '',
		'alert_pw_no_match' => '',
		'alert_incorrect_login' => '',
		'alert_username_invalid' => '',
		'alert_username_taken' => '',
		'alert_email_invalid' => '',
		'alert_email_taken' => '',
		'alert_pw_incorrect' => '',
		'alert_pw_change_success' => '',
		'alert_login_does_not_exist' => '',
		'alert_pw_reset_not_allowed' => '',
		'alert_pw_reset_email_sent' => '',
		'alert_pw_reset_email_failed' => '',
		'alert_pw_reset_url_invalid' => '',

		// Emails
		'email_disable_new_user_default' => 'on',
		'email_disable_pw_reset' => 'on',

	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

?>