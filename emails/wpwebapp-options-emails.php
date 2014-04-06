<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

function wpwebapp_settings_field_email_disable_new_user_default() {
	$options = wpwebapp_get_plugin_options_emails();
	?>
	<label for="email-disable-new-user-default">
		<input type="checkbox" name="wpwebapp_plugin_options_emails[email_disable_new_user_default]" id="email-disable-new-user-default" <?php checked( 'on', $options['email_disable_new_user_default'] ); ?> />
		<?php _e( 'Disable the default new user email that WordPress sends', 'wpwebapp' ); ?>
	</label>
	<?php
}

function wpwebapp_settings_field_email_disable_pw_reset() {
	$options = wpwebapp_get_plugin_options_emails();
	?>
	<label for="email-disable-pw-reset">
		<input type="checkbox" name="wpwebapp_plugin_options_emails[email_disable_pw_reset]" id="email-disable-pw-reset" <?php checked( 'on', $options['email_disable_pw_reset'] ); ?> />
		<?php _e( 'Disable the email WordPress sends whenever a user changes their password', 'wpwebapp' ); ?>
	</label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_emails() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_emails' );
	$defaults = array(
		'email_disable_new_user_default' => 'on',
		'email_disable_pw_reset' => 'on',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_emails', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_emails( $input ) {

	$output = array();

	if ( !isset( $input['email_disable_new_user_default'] ) )
		$output['email_disable_new_user_default'] = 'off';

	if ( !isset( $input['email_disable_pw_reset'] ) )
		$output['email_disable_pw_reset'] = 'off';

	return apply_filters( 'wpwebapp_plugin_options_validate_emails', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_emails() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Emails', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Override the default WordPress email behaviors.', 'wpwebapp' ) ?></p>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_emails' );
				do_settings_sections( 'wpwebapp_plugin_options_emails' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_emails() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_emails', 'wpwebapp_plugin_options_emails', 'wpwebapp_plugin_options_validate_emails' );

	// Fields
	add_settings_section( 'emails', '',  '__return_false', 'wpwebapp_plugin_options_emails' );
	add_settings_field( 'email_disable_new_user_default', __( 'New User Default', 'wpwebapp' ), 'wpwebapp_settings_field_email_disable_new_user_default', 'wpwebapp_plugin_options_emails', 'emails' );
	add_settings_field( 'email_disable_pw_reset', __( 'Password Change', 'wpwebapp' ), 'wpwebapp_settings_field_email_disable_pw_reset', 'wpwebapp_plugin_options_emails', 'emails' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_emails' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_emails() {
	add_submenu_page( 'wpwa_options', __( 'Emails', 'wpwebapp' ), __( 'Emails', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_emails', 'wpwebapp_plugin_options_render_page_emails' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_emails' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_emails( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_emails', 'wpwebapp_option_page_capability_emails' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get setting for disabling the default new user email (yes/no)
function wpwebapp_get_email_disable_new_user() {
	$options = wpwebapp_get_plugin_options_emails();
	$setting = $options['email_disable_new_user_default'];
	return $setting;
}

// Get setting for disabling password change notification emails (yes/no)
function wpwebapp_get_email_disable_password_change() {
	$options = wpwebapp_get_plugin_options_emails();
	$setting = $options['email_disable_pw_reset'];
	return $setting;
}

?>