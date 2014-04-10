<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

function wpwebapp_settings_field_button_class_pw_reset() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[button_class]" id="button-class" value="<?php echo esc_attr( $options['button_class'] ); ?>" /><br>
	<label class="description" for="button-class"><?php _e( 'Example: <code>btn btn-blue</code>. Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_pw_forgot() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[button_text_pw_forgot]" id="button-text-pw-forgot" value="<?php echo esc_attr( $options['button_text_pw_forgot'] ); ?>" /><br>
	<label class="description" for="button-text-pw-forgot"><?php _e( 'Default: <code>Reset Password</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_pw_reset() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[button_text_pw_reset]" id="button-text-pw-reset" value="<?php echo esc_attr( $options['button_text_pw_reset'] ); ?>" /><br>
	<label class="description" for="button-text-pw-reset"><?php _e( 'Default: <code>Set New Password</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_forgot_pw_url() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[forgot_pw_url]" id="forgot-pw-url" value="<?php echo esc_url( $options['forgot_pw_url'] ); ?>" /><br>
	<label class="description" for="forgot-pw-url"><?php _e( 'Default: None', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_forgot_pw_url_text() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[forgot_pw_url_text]" id="forgot-pw-url-text" value="<?php echo esc_attr( $options['forgot_pw_url_text'] ); ?>" /><br>
	<label class="description" for="forgot-pw-url-text"><?php _e( 'Default: <code>forgot password</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_custom_layout_pw_forgot() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_pw_reset[custom_layout_pw_forgot]" id="custom-layout" cols="50" rows="10" /><?php echo esc_textarea( $options['custom_layout_pw_forgot'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Use the following variables to add fields to the layout:', 'wpwebapp' ); ?><br />
		<?php _e( 'Alert', 'wpwebapp' ); ?> - <code>%alert</code><br />
		<?php _e( 'Username', 'wpwebapp' ); ?> - <code>%username</code><br />
		<?php _e( 'Submit Button', 'wpwebapp' ); ?> - <code>%submit</code>
	</label>
	<?php
}

function wpwebapp_settings_field_custom_layout_pw_reset() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_pw_reset[custom_layout_pw_reset]" id="custom-layout" cols="50" rows="10" /><?php echo esc_textarea( $options['custom_layout_pw_reset'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Use the following variables to add fields to the layout:', 'wpwebapp' ); ?><br />
		<?php _e( 'Alert', 'wpwebapp' ); ?> - <code>%alert</code><br />
		<?php _e( 'Password', 'wpwebapp' ); ?> - <code>%password</code><br />
		<?php _e( 'Password Confirm', 'wpwebapp' ); ?> - <code>%password-confirm</code><br />
		<?php _e( 'Submit Button', 'wpwebapp' ); ?> - <code>%submit</code>
	</label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_pw_reset() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_pw_reset' );
	$defaults = array(
		'button_class' => '',
		'button_text_pw_forgot' => '',
		'button_text_pw_reset' => '',
		'forgot_pw_url' => '',
		'forgot_pw_url_text' => '',
		'custom_layout_pw_forgot' => '',
		'custom_layout_pw_reset' => '',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_pw_reset', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_pw_reset( $input ) {

	$output = array();

	if ( isset( $input['button_class'] ) && ! empty( $input['button_class'] ) )
		$output['button_class'] = wp_filter_nohtml_kses( $input['button_class'] );

	if ( isset( $input['button_text_pw_forgot'] ) && ! empty( $input['button_text_pw_forgot'] ) )
		$output['button_text_pw_forgot'] = wp_filter_nohtml_kses( $input['button_text_pw_forgot'] );

	if ( isset( $input['button_text_pw_reset'] ) && ! empty( $input['button_text_pw_reset'] ) )
		$output['button_text_pw_reset'] = wp_filter_nohtml_kses( $input['button_text_pw_reset'] );

	if ( isset( $input['forgot_pw_url'] ) && ! empty( $input['forgot_pw_url'] ) )
		$output['forgot_pw_url'] = wp_filter_nohtml_kses( $input['forgot_pw_url'] );

	if ( isset( $input['forgot_pw_url_text'] ) && ! empty( $input['forgot_pw_url_text'] ) )
		$output['forgot_pw_url_text'] = wp_filter_post_kses( $input['forgot_pw_url_text'] );

	if ( isset( $input['custom_layout_pw_forgot'] ) && ! empty( $input['custom_layout_pw_forgot'] ) )
		$output['custom_layout_pw_forgot'] = wp_filter_post_kses( $input['custom_layout_pw_forgot'] );

	if ( isset( $input['custom_layout_pw_reset'] ) && ! empty( $input['custom_layout_pw_reset'] ) )
		$output['custom_layout_pw_reset'] = wp_filter_post_kses( $input['custom_layout_pw_reset'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_pw_reset', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_pw_reset() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Reset Password Form', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Control the password reset form.', 'wpwebapp' ) ?></p>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_pw_reset' );
				do_settings_sections( 'wpwebapp_plugin_options_pw_reset' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_pw_reset() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_pw_reset', 'wpwebapp_plugin_options_pw_reset', 'wpwebapp_plugin_options_validate_pw_reset' );

	// Fields
	add_settings_section( 'forms', '',  '__return_false', 'wpwebapp_plugin_options_pw_reset' );
	add_settings_field( 'button_class', __( 'Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to form submit buttons.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_class_pw_reset', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'button_text_pw_forgot', __( 'Forgot Password Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the button to send a password reset email.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_pw_forgot', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'button_text_pw_reset', __( 'Password Reset Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the button to change a password after a reset.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_pw_reset', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'forgot_pw_url', __( 'Forgot Password URL', 'wpwebapp' ) . '<div class="description">' . __( 'A link to the "forgot password" page.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_forgot_pw_url', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'forgot_pw_url_text', __( 'Forgot Password URL Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the "forgot password" URL (only shown if URL is set).', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_forgot_pw_url_text', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'custom_layout_pw_forgot', __( 'Custom Layout PW Forgot', 'wpwebapp' ) . '<div class="description">' . __( 'Customize the layout of the forgot password form with your own markup.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_custom_layout_pw_forgot', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'custom_layout_pw_reset', __( 'Custom Layout PW Reset', 'wpwebapp' ) . '<div class="description">' . __( 'Customize the layout of the password reset form with your own markup.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_custom_layout_pw_reset', 'wpwebapp_plugin_options_pw_reset', 'forms' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_pw_reset' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_pw_reset() {
	add_submenu_page( 'wpwa_options', __( 'Reset Password Form', 'wpwebapp' ), __( 'Reset Password Form', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_pw_reset', 'wpwebapp_plugin_options_render_page_pw_reset' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_pw_reset' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_pw_reset( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_pw_reset', 'wpwebapp_option_page_capability_pw_reset' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get class for form submit buttons
function wpwebapp_get_form_button_class_pw_reset() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	return $options['button_class'];
}

// Get text for forgot password submit button
function wpwebapp_get_pw_forgot_text() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	if ( $options['button_text_pw_forgot'] === '' ) {
		return __( 'Reset Password', 'wpwebapp' );
	} else {
		return $options['button_text_pw_forgot'];
	}
}

// Get text for password reset submit button
function wpwebapp_get_pw_reset_text() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	if ( $options['button_text_pw_reset'] === '' ) {
		return __( 'Set New Password', 'wpwebapp' );
	} else {
		return $options['button_text_pw_reset'];
	}
}

// Get URL of forgot password form
function wpwebapp_get_pw_forgot_url() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	return $options['forgot_pw_url'];
}

// Get text for forgot password link on login form
function wpwebapp_get_pw_forgot_url_text() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	if ( $options['forgot_pw_url_text'] === '' ) {
		return __( 'forgot password', 'wpwebapp' );
	} else {
		return $options['forgot_pw_url_text'];
	}
}

// Get custom layout pw forgot
function wpwebapp_get_form_signup_custom_layout_pw_forgot() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	return $options['custom_layout_pw_forgot'];
}

// Get custom layout pw reset
function wpwebapp_get_form_signup_custom_layout_pw_reset() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	return $options['custom_layout_pw_reset'];
}

?>