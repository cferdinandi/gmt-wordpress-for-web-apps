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
	<input type="text" name="wpwebapp_plugin_options_forms_signup[button_class]" id="button-class" value="<?php echo esc_attr( $options['button_class'] ); ?>" /><br>
	<label class="description" for="button-class"><?php _e( 'Example: <code>btn btn-blue</code>. Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_signup() {
	$options = wpwebapp_get_plugin_options_forms_signup();
	?>
	<input type="text" name="wpwebapp_plugin_options_forms_signup[button_text_signup]" id="button-text-signup" value="<?php echo esc_attr( $options['button_text_signup'] ); ?>" /><br>
	<label class="description" for="button-text-signup"><?php _e( 'Default: <code>Signup</code>', 'wpwebapp' ); ?></label>
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
	add_settings_field( 'button_text_signup', __( 'Signup Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the signup button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_signup', 'wpwebapp_plugin_options_forms_signup', 'forms' );

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

?>