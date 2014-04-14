<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

function wpwebapp_settings_field_button_class_signup() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	?>
	<input type="text" name="wpwebapp_plugin_options_forms_signup[button_class]" id="button-class" value="<?php echo esc_attr( $options['button_class'] ); ?>"><br>
	<label class="description" for="button-class"><?php _e( 'Example: <code>btn btn-blue</code>. Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_signup() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	?>
	<input type="text" name="wpwebapp_plugin_options_forms_signup[button_text_signup]" id="button-text-signup" value="<?php echo esc_attr( $options['button_text_signup'] ); ?>"><br>
	<label class="description" for="button-text-signup"><?php _e( 'Default: <code>Signup</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_custom_layout_signup() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_forms_signup[custom_layout]" id="custom-layout" cols="50" rows="10"><?php echo esc_textarea( $options['custom_layout'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Use the following variables to add fields to the layout:', 'wpwebapp' ); ?><br>
		<?php _e( 'Alert', 'wpwebapp' ); ?> - <code>%alert</code><br>
		<?php _e( 'Username', 'wpwebapp' ); ?> - <code>%username</code><br>
		<?php _e( 'Email', 'wpwebapp' ); ?> - <code>%email</code><br>
		<?php _e( 'Password', 'wpwebapp' ); ?> - <code>%password</code><br>
		<?php _e( 'Submit Button', 'wpwebapp' ); ?> - <code>%submit</code>
	</label>
	<?php
}

function wpwebapp_settings_field_send_new_user_email_admin() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	?>
	<label for="send-new-user-email-admin">
		<input type="checkbox" name="wpwebapp_plugin_options_forms_signup[send_new_user_email_admin]" id="send-new-user-email-admin" <?php checked( 'on', $options['send_new_user_email_admin'] ); ?>>
		<?php _e( 'Receive an email whenever a new user signs up', 'wpwebapp' ); ?>
	</label>
	<?php
}

function wpwebapp_settings_field_send_new_user_email_user() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	?>
	<label for="send-new-user-email-user">
		<input type="checkbox" name="wpwebapp_plugin_options_forms_signup[send_new_user_email_user]" id="send-new-user-email-user" <?php checked( 'on', $options['send_new_user_email_user'] ); ?>>
		<?php _e( 'Send new users an email when they sign up', 'wpwebapp' ); ?>
	</label>
	<?php
}

function wpwebapp_settings_field_new_user_email_from() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	?>
	<input type="text" name="wpwebapp_plugin_options_forms_signup[new_user_email_from]" id="new-user-email-from" value="<?php echo esc_attr( $options['new_user_email_from'] ); ?>"><br>
	<label class="description" for="new-user-email-from"><?php _e( '<code>name</code>, not: <code>name@domain.com</code>. Default: <code>welcome</code>.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_new_user_email_subject() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	?>
	<input type="text" name="wpwebapp_plugin_options_forms_signup[new_user_email_subject]" id="new-user-email-subject" value="<?php echo esc_attr( $options['new_user_email_subject'] ); ?>"><br>
	<label class="description" for="new-user-email-subject"><?php _e( 'Welcome to [App Name]', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_new_user_email_message() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_forms_signup[new_user_email_message]" id="new-user-email-message" cols="50" rows="10"><?php echo esc_textarea( $options['new_user_email_message'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Use the following variables to add content to the email:', 'wpwebapp' ); ?><br>
		<?php _e( 'Username', 'wpwebapp' ); ?> - <code>%username</code><br>
		<?php _e( 'User Email', 'wpwebapp' ); ?> - <code>%email</code><br>
		<?php _e( 'Default', 'wpwebapp' ); ?>: <code><?php _e( 'Welcome to [App Name].Your username is [username]. Login at [app URL].', 'wpwebapp' ); ?></code><br>
	</label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_forms_signup() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_forms_signup' );
	$defaults = array(
		'button_class' => '',
		'button_text_signup' => '',
		'custom_layout' => '',
		'send_new_user_email_admin' => 'off',
		'send_new_user_email_user' => 'off',
		'new_user_email_from' => '',
		'new_user_email_subject' => '',
		'new_user_email_message' => ''
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_forms_signup', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_forms_signup( $input ) {

	$output = array();

	if ( isset( $input['button_class'] ) && ! empty( $input['button_class'] ) )
		$output['button_class'] = wp_filter_nohtml_kses( $input['button_class'] );

	if ( isset( $input['button_text_signup'] ) && ! empty( $input['button_text_signup'] ) )
		$output['button_text_signup'] = wp_filter_nohtml_kses( $input['button_text_signup'] );

	if ( isset( $input['custom_layout'] ) && ! empty( $input['custom_layout'] ) )
		$output['custom_layout'] = wp_filter_post_kses( $input['custom_layout'] );

	if ( isset( $input['send_new_user_email_admin'] ) )
		$output['send_new_user_email_admin'] = 'on';

	if ( isset( $input['send_new_user_email_user'] ) )
		$output['send_new_user_email_user'] = 'on';

	if ( isset( $input['new_user_email_from'] ) && ! empty( $input['new_user_email_from'] ) )
		$output['new_user_email_from'] = wp_filter_nohtml_kses( $input['new_user_email_from'] );

	if ( isset( $input['new_user_email_subject'] ) && ! empty( $input['new_user_email_subject'] ) )
		$output['new_user_email_subject'] = wp_filter_nohtml_kses( $input['new_user_email_subject'] );

	if ( isset( $input['new_user_email_message'] ) && ! empty( $input['new_user_email_message'] ) )
		$output['new_user_email_message'] = wp_filter_nohtml_kses( $input['new_user_email_message'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_forms_signup', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_forms_signup() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Signup Form', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Update signup form settings.', 'wpwebapp' ) ?></p>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_forms_signup' );
				do_settings_sections( 'wpwebapp_plugin_options_forms_signup' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_forms_signup() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_forms_signup', 'wpwebapp_plugin_options_forms_signup', 'wpwebapp_plugin_options_validate_forms_signup' );

	// Fields
	add_settings_section( 'forms', '',  '__return_false', 'wpwebapp_plugin_options_forms_signup' );
	add_settings_field( 'button_class', __( 'Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to form submit buttons.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_class_signup', 'wpwebapp_plugin_options_forms_signup', 'forms' );
	add_settings_field( 'button_text_signup', __( 'Button Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the signup button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_signup', 'wpwebapp_plugin_options_forms_signup', 'forms' );
	add_settings_field( 'custom_layout', __( 'Custom Layout', 'wpwebapp' ) . '<div class="description">' . __( 'Customize the layout of the form with your own markup.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_custom_layout_signup', 'wpwebapp_plugin_options_forms_signup', 'forms' );
	add_settings_field( 'send_new_user_email_admin', __( 'Send Admin Notification', 'wpwebapp' ), 'wpwebapp_settings_field_send_new_user_email_admin', 'wpwebapp_plugin_options_forms_signup', 'forms' );
	add_settings_field( 'send_new_user_email_user', __( 'Send Welcome Email', 'wpwebapp' ), 'wpwebapp_settings_field_send_new_user_email_user', 'wpwebapp_plugin_options_forms_signup', 'forms' );
	add_settings_field( 'new_user_email_from', __( 'Welcome Email From Address', 'wpwebapp' ) . '<div class="description">' . __( 'Email account to send welcome email to the user from.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_new_user_email_from', 'wpwebapp_plugin_options_forms_signup', 'forms' );
	add_settings_field( 'new_user_email_subject', __( 'Welcome Email Subject', 'wpwebapp' ) . '<div class="description">' . __( 'Subject of welcome email sent to the new user.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_new_user_email_subject', 'wpwebapp_plugin_options_forms_signup', 'forms' );
	add_settings_field( 'new_user_email_message', __( 'Welcome Email Content', 'wpwebapp' ), 'wpwebapp_settings_field_new_user_email_message', 'wpwebapp_plugin_options_forms_signup', 'forms' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_forms_signup' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_forms_signup() {
	add_submenu_page( 'wpwa_options', __( 'Signup Form', 'wpwebapp' ), __( 'Signup Form', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_forms_signup', 'wpwebapp_plugin_options_render_page_forms_signup' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_forms_signup' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_forms_signup( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_forms_signup', 'wpwebapp_option_page_capability_forms_signup' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get class for form submit buttons
function wpwebapp_get_form_button_class_signup() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	return $options['button_class'];
}

// Get text for signup submit button
function wpwebapp_get_form_signup_text() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	if ( $options['button_text_signup'] === '' ) {
		return __( 'Signup', 'wpwebapp' );
	} else {
		return $options['button_text_signup'];
	}
}

// Get custom layout
function wpwebapp_get_form_signup_custom_layout() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	return $options['custom_layout'];
}

// Get setting for Admin notifications for new user signups
function wpwebapp_get_send_new_user_email_admin() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	return $options['send_new_user_email_admin'];
}

// Get setting for sending email to new user
function wpwebapp_get_send_new_user_email_user() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	return $options['send_new_user_email_user'];
}

// Get welcome email from address
function wpwebapp_get_new_user_email_from() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	if ( $options['new_user_email_from'] === '' ) {
		return 'welcome';
	} else {
		return $options['new_user_email_from'];
	}
}

// Get welcome email subject
function wpwebapp_get_new_user_email_subject( $site_name ) {
	$options = wpwebapp_get_plugin_options_forms_signup();
	if ( $options['new_user_email_subject'] === '' ) {
		return 'Welcome to ' . $site_name;
	} else {
		return $options['new_user_email_subject'];
	}
}

// Get welcome email content
function wpwebapp_get_send_new_user_email_message() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	return $options['new_user_email_message'];
}

?>