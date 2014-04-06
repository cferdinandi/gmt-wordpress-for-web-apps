<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

function wpwebapp_settings_field_alert_empty_fields() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_empty_fields]" id="alert-empty-fields" value="<?php echo esc_html( $options['alert_empty_fields'] ); ?>" /><br>
	<label class="description" for="alert-empty-fields"><?php _e( 'Default: <code>&lt;p&gt;Please complete all fields.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_requirements() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_pw_requirements]" id="alert-pw-requirements" value="<?php echo esc_html( $options['alert_pw_requirements'] ); ?>" /><br>
	<label class="description" for="alert-pw-requirements"><?php _e( 'Default: <code>&lt;p&gt;Please use a password that\'s at least %n characters long.&lt;/p&gt;</code><br />Use the variable <code>%n</code> to dynamically display the minimum character number from your settings.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_no_match() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_pw_no_match]" id="alert-pw-no-match" value="<?php echo esc_html( $options['alert_pw_no_match'] ); ?>" /><br>
	<label class="description" for="alert-pw-no-match"><?php _e( 'Default: <code>&lt;p&gt;The new passwords your entered didn\'t match.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_incorrect_login() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_incorrect_login]" id="alert-incorrect-login" value="<?php echo esc_html( $options['alert_incorrect_login'] ); ?>" /><br>
	<label class="description" for="alert-incorrect-login"><?php _e( 'Default: <code>&lt;p&gt;Incorrect username or password.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_username_invalid() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_username_invalid]" id="alert-username-invalid" value="<?php echo esc_html( $options['alert_username_invalid'] ); ?>" /><br>
	<label class="description" for="alert-username-invalid"><?php _e( 'Default: <code>&lt;p&gt;Usernames can only contain letters, numbers, and these special characters: _, space, ., -, *, and @.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_username_taken() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_username_taken]" id="alert-username-taken" value="<?php echo esc_html( $options['alert_username_taken'] ); ?>" /><br>
	<label class="description" for="alert-username-taken"><?php _e( 'Default: <code>&lt;p&gt;Username already exists.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_email_invalid() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_email_invalid]" id="alert-email-invalid" value="<?php echo esc_html( $options['alert_email_invalid'] ); ?>" /><br>
	<label class="description" for="alert-email-invalid"><?php _e( 'Default: <code>&lt;p&gt;Please use a valid email address.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_email_taken() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_email_taken]" id="alert-email-taken" value="<?php echo esc_html( $options['alert_email_taken'] ); ?>" /><br>
	<label class="description" for="alert-email-taken"><?php _e( 'Default: <code>&lt;p&gt;An account with this email address already exists.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_incorrect() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_pw_incorrect]" id="alert-pw-incorrect" value="<?php echo esc_html( $options['alert_pw_incorrect'] ); ?>" /><br>
	<label class="description" for="alert-pw-incorrect"><?php _e( 'Default: <code>&lt;p&gt;The password you entered does not match your current password.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_change_success() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_pw_change_success]" id="alert-pw-change-success" value="<?php echo esc_html( $options['alert_pw_change_success'] ); ?>" /><br>
	<label class="description" for="alert-pw-change-success"><?php _e( 'Default: <code>&lt;p&gt;Your password has been updated.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_login_does_not_exist() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_login_does_not_exist]" id="alert-login-does-not-exist" value="<?php echo esc_html( $options['alert_login_does_not_exist'] ); ?>" /><br>
	<label class="description" for="alert-login-does-not-exist"><?php _e( 'Default: <code>&lt;p&gt;Username or email doesn\'t exist.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_reset_not_allowed() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_pw_reset_not_allowed]" id="alert-pw-reset-not-allowed" value="<?php echo esc_html( $options['alert_pw_reset_not_allowed'] ); ?>" /><br>
	<label class="description" for="alert-pw-reset-not-allowed"><?php _e( 'Default: <code>&lt;p&gt;Password resets are not allowed for this user.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_reset_email_sent() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_pw_reset_email_sent]" id="alert-pw-reset-email-sent" value="<?php echo esc_html( $options['alert_pw_reset_email_sent'] ); ?>" /><br>
	<label class="description" for="alert-pw-reset-email-sent"><?php _e( 'Default: <code>&lt;p&gt;We\'ve sent you an email with a temporary link that will allow you to reset your password for the next %t hours. Please check your spam folder if the email doesn’t appear within a few minutes.&lt;/p&gt;</code><br />Use the variable <code>%t</code> to dynamically display the number of hours from your settings.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_reset_email_failed() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_pw_reset_email_failed]" id="alert-pw-reset-email-failed" value="<?php echo esc_html( $options['alert_pw_reset_email_failed'] ); ?>" /><br>
	<label class="description" for="alert-pw-reset-email-failed"><?php _e( 'Default: <code>&lt;p&gt;Oops, something went wrong on our end. Please try again.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_reset_url_invalid() {
	$options = wpwebapp_get_plugin_options_alerts();
	?>
	<input type="text" name="wpwebapp_plugin_options_alerts[alert_pw_reset_url_invalid]" id="alert-pw-reset-url-invalid" value="<?php echo esc_html( $options['alert_pw_reset_url_invalid'] ); ?>" /><br>
	<label class="description" for="alert-pw-reset-url-invalid"><?php _e( 'Default: <code>&lt;p&gt;This password reset request is no longer valid.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_alerts() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_alerts' );
	$defaults = array(
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
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_alerts', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_alerts( $input ) {

	$output = array();

	if ( isset( $input['alert_empty_fields'] ) && ! empty( $input['alert_empty_fields'] ) )
		$output['alert_empty_fields'] = wp_filter_post_kses( $input['alert_empty_fields'] );

	if ( isset( $input['alert_pw_requirements'] ) && ! empty( $input['alert_pw_requirements'] ) )
		$output['alert_pw_requirements'] = wp_filter_post_kses( $input['alert_pw_requirements'] );

	if ( isset( $input['alert_pw_no_match'] ) && ! empty( $input['alert_pw_no_match'] ) )
		$output['alert_pw_no_match'] = wp_filter_post_kses( $input['alert_pw_no_match'] );

	if ( isset( $input['alert_incorrect_login'] ) && ! empty( $input['alert_incorrect_login'] ) )
		$output['alert_incorrect_login'] = wp_filter_post_kses( $input['alert_incorrect_login'] );

	if ( isset( $input['alert_username_invalid'] ) && ! empty( $input['alert_username_invalid'] ) )
		$output['alert_username_invalid'] = wp_filter_post_kses( $input['alert_username_invalid'] );

	if ( isset( $input['alert_username_taken'] ) && ! empty( $input['alert_username_taken'] ) )
		$output['alert_username_taken'] = wp_filter_post_kses( $input['alert_username_taken'] );

	if ( isset( $input['alert_email_invalid'] ) && ! empty( $input['alert_email_invalid'] ) )
		$output['alert_email_invalid'] = wp_filter_post_kses( $input['alert_email_invalid'] );

	if ( isset( $input['alert_email_taken'] ) && ! empty( $input['alert_email_taken'] ) )
		$output['alert_email_taken'] = wp_filter_post_kses( $input['alert_email_taken'] );

	if ( isset( $input['alert_pw_incorrect'] ) && ! empty( $input['alert_pw_incorrect'] ) )
		$output['alert_pw_incorrect'] = wp_filter_post_kses( $input['alert_pw_incorrect'] );

	if ( isset( $input['alert_pw_change_success'] ) && ! empty( $input['alert_pw_change_success'] ) )
		$output['alert_pw_change_success'] = wp_filter_post_kses( $input['alert_pw_change_success'] );

	if ( isset( $input['alert_login_does_not_exist'] ) && ! empty( $input['alert_login_does_not_exist'] ) )
		$output['alert_login_does_not_exist'] = wp_filter_post_kses( $input['alert_login_does_not_exist'] );

	if ( isset( $input['alert_pw_reset_not_allowed'] ) && ! empty( $input['alert_pw_reset_not_allowed'] ) )
		$output['alert_pw_reset_not_allowed'] = wp_filter_post_kses( $input['alert_pw_reset_not_allowed'] );

	if ( isset( $input['alert_pw_reset_email_sent'] ) && ! empty( $input['alert_pw_reset_email_sent'] ) )
		$output['alert_pw_reset_email_sent'] = wp_filter_post_kses( $input['alert_pw_reset_email_sent'] );

	if ( isset( $input['alert_pw_reset_email_failed'] ) && ! empty( $input['alert_pw_reset_email_failed'] ) )
		$output['alert_pw_reset_email_failed'] = wp_filter_post_kses( $input['alert_pw_reset_email_failed'] );

	if ( isset( $input['alert_pw_reset_url_invalid'] ) && ! empty( $input['alert_pw_reset_url_invalid'] ) )
		$output['alert_pw_reset_url_invalid'] = wp_filter_post_kses( $input['alert_pw_reset_url_invalid'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_alerts', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_alerts() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Alerts', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Control alerts, warnings, and confirmations.', 'wpwebapp' ) ?></p>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_alerts' );
				do_settings_sections( 'wpwebapp_plugin_options_alerts' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_alerts() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_alerts', 'wpwebapp_plugin_options_alerts', 'wpwebapp_plugin_options_validate_alerts' );

	// Fields
	add_settings_section( 'alerts', '',  '__return_false', 'wpwebapp_plugin_options_alerts' );
	add_settings_field( 'alert_empty_fields', __( 'Empty Fields', 'wpwebapp' ) . '<div class="description">' . __( 'Signup, Password Change, and Password Reset Forms', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_empty_fields', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_pw_requirements', __( 'Password Requirements', 'wpwebapp' ) . '<div class="description">' . __( 'Signup, Password Change and Password Reset forms', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_requirements', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_pw_no_match', __( 'Passwords Don\'t Match', 'wpwebapp' ) . '<div class="description">' . __( 'Password Change and Password Reset forms', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_no_match', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_incorrect_login', __( 'Incorrect Login', 'wpwebapp' ) . '<div class="description">' . __( 'Login and Forgot Password forms', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_incorrect_login', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_username_invalid', __( 'Username Taken', 'wpwebapp' ) . '<div class="description">' . __( 'Signup form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_username_invalid', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_username_taken', __( 'Username Taken', 'wpwebapp' ) . '<div class="description">' . __( 'Signup form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_username_taken', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_email_invalid', __( 'Invalid Email', 'wpwebapp' ) . '<div class="description">' . __( 'Signup form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_email_invalid', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_email_taken', __( 'Email Taken', 'wpwebapp' ) . '<div class="description">' . __( 'Signup form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_email_taken', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_pw_incorrect', __( 'Incorrect Password', 'wpwebapp' ) . '<div class="description">' . __( 'Password change form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_incorrect', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_pw_change_success', __( 'Password Change Success', 'wpwebapp' ) . '<div class="description">' . __( 'Password Change form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_change_success', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_login_does_not_exist', __( 'Login Doesn\'t Exist', 'wpwebapp' ) . '<div class="description">' . __( 'Forgot Password form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_login_does_not_exist', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_pw_reset_not_allowed', __( 'Password Reset Not Allowed', 'wpwebapp' ) . '<div class="description">' . __( 'Forgot Password form (no resets for admins)', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_reset_not_allowed', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_pw_reset_email_sent', __( 'Password Reset Email Sent', 'wpwebapp' ) . '<div class="description">' . __( 'Forgot Password form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_reset_email_sent', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_pw_reset_email_failed', __( 'Password Reset Email Failed', 'wpwebapp' ) . '<div class="description">' . __( 'Forgot Password form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_reset_email_failed', 'wpwebapp_plugin_options_alerts', 'alerts' );
	add_settings_field( 'alert_pw_reset_url_invalid', __( 'Password Reset URL Expired', 'wpwebapp' ) . '<div class="description">' . __( 'Password Reset form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_reset_url_invalid', 'wpwebapp_plugin_options_alerts', 'alerts' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_alerts' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_alerts() {
	add_submenu_page( 'wpwa_options', __( 'Alerts', 'wpwebapp' ), __( 'Alerts', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_alerts', 'wpwebapp_plugin_options_render_page_alerts' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_alerts' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_alerts( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_alerts', 'wpwebapp_option_page_capability_alerts' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get alert for empty form fields
function wpwebapp_get_alert_empty_fields() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_empty_fields'] === '' ) {
		$setting = '<p>' . __( 'Please complete all fields.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_empty_fields'];
	}
	return $setting;
}

// Get alert for not meeting password requirements
function wpwebapp_get_alert_pw_requirements() {
	$options = wpwebapp_get_plugin_options_alerts();
	$pw_min_length = wpwebapp_get_minimum_pw_length();
	$requires_letters = wpwebapp_get_pw_requirement_letters();
	$requires_numbers = wpwebapp_get_pw_requirement_numbers();
	$requires_special_chars = wpwebapp_get_pw_requirement_special_chars();

	if ( $options['alert_pw_requirements'] === '' ) {
		if ( $requires_letters == 'on' && $requires_numbers == 'on' && $requires_special_chars == 'on' ) {
			$setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one letter, one number, one special character, and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
		} else if ( $requires_letters == 'on' && $requires_numbers == 'on' ) {
			$setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one letter, one number, and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
		} else if ( $requires_letters == 'on' && $requires_special_chars == 'on' ) {
			$setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one letter, one special character, and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
		} else if ( $requires_numbers == 'on' && $requires_special_chars == 'on' ) {
			$setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one number, one special character, and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
		} else if ( $requires_letters == 'on' ) {
			$setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one letter and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
		} else if ( $requires_numbers == 'on' ) {
			$setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one number and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
		} else if ( $requires_special_chars == 'on' ) {
			$setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one special character and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
		} else if ( $pw_min_length > 1 ) {
			$setting = '<p>' . sprintf( __( 'Please choose a password that contains at least %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
		} else {
			$setting = '';
		}
	} else {
		$setting = $options['alert_pw_requirements'];
		$scrubber = array( '%n' => $pw_min_length );
		$setting = strtr( $setting, $scrubber );
	}

	return $setting;
}

// Get alert for when new and confirmation password don't match
function wpwebapp_get_alert_pw_match() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_pw_no_match'] === '' ) {
		$setting = '<p>' . __( 'The new passwords your entered didn\'t match.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_pw_no_match'];
	}
	return $setting;
}

// Get alert for incorrect login credentials
function wpwebapp_get_alert_login_incorrect() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_incorrect_login'] === '' ) {
		$setting = '<p>' . __( 'Incorrect username or password.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_incorrect_login'];
	}
	return $setting;
}

// Get alert for invalid username at signup
function wpwebapp_get_alert_username_invalid() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_username_invalid'] === '' ) {
		$setting = '<p>' . __( 'Usernames can only contain letters, numbers, and these special characters: _, space, ., -, *, and @.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_username_taken'];
	}
	return $setting;
}

// Get alert for existing username at signup
function wpwebapp_get_alert_username_taken() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_username_taken'] === '' ) {
		$setting = '<p>' . __( 'Username already exists.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_username_taken'];
	}
	return $setting;
}

// Get when content of email field isn't a valid email address
function wpwebapp_get_alert_email_invalid() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_email_invalid'] === '' ) {
		$setting = '<p>' . __( 'Please use a valid email address.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_email_invalid'];
	}
	return $setting;
}

// Get alert for when email address already exists
function wpwebapp_get_alert_email_taken() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_email_taken'] === '' ) {
		$setting = '<p>' . __( 'An account with this email address already exists.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_email_taken'];
	}
	return $setting;
}

// Get alert for when current password is incorrect
function wpwebapp_get_alert_pw_incorrect() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_pw_incorrect'] === '' ) {
		$setting = '<p>' . __( 'The password you entered does not match your current password.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_pw_incorrect'];
	}
	return $setting;
}

// Get alert for when password successfully changed
function wpwebapp_get_alert_pw_change_success() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_pw_change_success'] === '' ) {
		$setting = '<p>' . __( 'Your password has been updated.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_pw_change_success'];
	}
	return $setting;
}

// Get alert for when username or email is not an existing user
function wpwebapp_get_alert_login_does_not_exist() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_login_does_not_exist'] === '' ) {
		$setting = '<p>' . __( 'Username or email doesn\'t exist.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_login_does_not_exist'];
	}
	return $setting;
}

// Get alert for when password resets are not allowed for this user
function wpwebapp_get_alert_pw_reset_not_allowed() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_pw_reset_not_allowed'] === '' ) {
		$setting = '<p>' . __( 'Password resets are not allowed for this user.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_pw_reset_not_allowed'];
	}
	return $setting;
}

// Get alert for when the password reset email is successfully sent
function wpwebapp_get_alert_pw_reset_email_sent() {
	$options = wpwebapp_get_plugin_options_alerts();
	$reset_length = wpwebapp_get_pw_reset_time_valid();
	if ( $options['alert_pw_reset_email_sent'] === '' ) {
		$setting = '<p>' . sprintf( __( 'We\'ve sent you an email with a temporary link that will allow you to reset your password for the next %d hours. Please check your spam folder if the email doesn’t appear within a few minutes.', 'wpwebapp' ), $reset_length ) . '</p>';
	} else {
		$setting = $options['alert_pw_reset_email_sent'];
		$scrubber = array( '%t' => $pw_min_length );
		$setting = strtr( $setting, $scrubber );
	}
	return $setting;
}

// Get alert for when the password reset email fails to send
function wpwebapp_get_alert_pw_reset_email_failed() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_pw_reset_email_failed'] === '' ) {
		$setting = '<p>' . __( 'Oops, something went wrong on our end. Please try again.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_pw_reset_email_failed'];
	}
	return $setting;
}

// Get alert for when the password reset URL has expired
function wpwebapp_get_alert_pw_reset_url_expired() {
	$options = wpwebapp_get_plugin_options_alerts();
	if ( $options['alert_pw_reset_url_invalid'] === '' ) {
		$setting = '<p>' . __( 'This password reset request is no longer valid.', 'wpwebapp' ) . '</p>';
	} else {
		$setting = $options['alert_pw_reset_url_invalid'];
	}
	return $setting;
}

?>