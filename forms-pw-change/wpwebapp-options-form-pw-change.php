<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

function wpwebapp_settings_field_button_class_pw_change() {
	$options = wpwebapp_get_plugin_options_pw_change();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_change[button_class]" id="button-class" value="<?php echo esc_attr( $options['button_class'] ); ?>" /><br>
	<label class="description" for="button-class"><?php _e( 'Example: <code>btn btn-blue</code>. Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_pw_change() {
	$options = wpwebapp_get_plugin_options_pw_change();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_change[button_text_pw_change]" id="button-text-pw-change" value="<?php echo esc_attr( $options['button_text_pw_change'] ); ?>" /><br>
	<label class="description" for="button-text-pw-change"><?php _e( 'Default: <code>Change Password</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_disable_pw_confirm_field() {
	$options = wpwebapp_get_plugin_options_pw_change();
	?>
	<label for="disable-pw-confirm-field">
		<input type="checkbox" name="wpwebapp_plugin_options_pw_change[disable_pw_confirm_field]" id="disable-pw-confirm-field" <?php checked( 'on', $options['disable_pw_confirm_field'] ); ?> />
		<?php _e( 'Disable the new password confirmation field', 'wpwebapp' ); ?>
	</label>
	<?php
}

function wpwebapp_settings_field_custom_layout_pw_change() {
	$options = wpwebapp_get_plugin_options_pw_change();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_pw_change[custom_layout]" id="custom-layout" cols="50" rows="10" /><?php echo esc_textarea( $options['custom_layout'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Use the following variables to add fields to the layout:', 'wpwebapp' ); ?><br />
		<?php _e( 'Alert', 'wpwebapp' ); ?> - <code>%alert</code><br />
		<?php _e( 'Current Password', 'wpwebapp' ); ?> - <code>%pw-current</code><br />
		<?php _e( 'New Password', 'wpwebapp' ); ?> - <code>%pw-new</code><br />
		<?php _e( 'Confirm Password', 'wpwebapp' ); ?> - <code>%pw-confirm</code><br />
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
function wpwebapp_get_plugin_options_pw_change() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_pw_change' );
	$defaults = array(
		'button_class' => '',
		'button_text_pw_change' => '',
		'disable_pw_confirm_field' => 'off',
		'custom_layout' => '',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_pw_change', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_pw_change( $input ) {

	$output = array();

	if ( isset( $input['button_class'] ) && ! empty( $input['button_class'] ) )
		$output['button_class'] = wp_filter_nohtml_kses( $input['button_class'] );

	if ( isset( $input['button_text_pw_change'] ) && ! empty( $input['button_text_pw_change'] ) )
		$output['button_text_pw_change'] = wp_filter_nohtml_kses( $input['button_text_pw_change'] );

	if ( isset( $input['disable_pw_confirm_field'] ) )
		$output['disable_pw_confirm_field'] = 'on';

	if ( isset( $input['custom_layout'] ) && ! empty( $input['custom_layout'] ) )
		$output['custom_layout'] = wp_filter_post_kses( $input['custom_layout'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_pw_change', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_pw_change() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Change Password Form', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Control the change password form settings.', 'wpwebapp' ) ?></p>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_pw_change' );
				do_settings_sections( 'wpwebapp_plugin_options_pw_change' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_pw_change() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_pw_change', 'wpwebapp_plugin_options_pw_change', 'wpwebapp_plugin_options_validate_pw_change' );

	// Fields
	add_settings_section( 'forms', '',  '__return_false', 'wpwebapp_plugin_options_pw_change' );
	add_settings_field( 'button_class', __( 'Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to form submit buttons.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_class_pw_change', 'wpwebapp_plugin_options_pw_change', 'forms' );
	add_settings_field( 'button_text_pw_change', __( 'Change Password Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the change password button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_pw_change', 'wpwebapp_plugin_options_pw_change', 'forms' );
	add_settings_field( 'disable_pw_confirm_field', __( 'Disable Password Confirmation', 'wpwebapp' ), 'wpwebapp_settings_field_disable_pw_confirm_field', 'wpwebapp_plugin_options_pw_change', 'forms' );
	add_settings_field( 'custom_layout', __( 'Custom Layout', 'wpwebapp' ) . '<div class="description">' . __( 'Customize the layout of the form with your own markup.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_custom_layout_pw_change', 'wpwebapp_plugin_options_pw_change', 'forms' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_pw_change' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_pw_change() {
	add_submenu_page( 'wpwa_options', __( 'Change Password Form', 'wpwebapp' ), __( 'Change Password Form', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_pw_change', 'wpwebapp_plugin_options_render_page_pw_change' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_pw_change' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_pw_change( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_pw_change', 'wpwebapp_option_page_capability_pw_change' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get class for form submit buttons
function wpwebapp_get_form_button_class_pw_change() {
	$options = wpwebapp_get_plugin_options_pw_change();
	return $options['button_class'];
}

// Get text for password change submit button
function wpwebapp_get_pw_change_text() {
	$options = wpwebapp_get_plugin_options_pw_change();
	if ( $options['button_text_pw_change'] === '' ) {
		return __( 'Change Password', 'wpwebapp' );
	} else {
		return $options['button_text_pw_change'];
	}
}

// Get disable password confirm field
function wpwebapp_get_disable_pw_confirm_field() {
	$options = wpwebapp_get_plugin_options_pw_change();
	return $options['disable_pw_confirm_field'];
}

// Get custom layout
function wpwebapp_get_pw_change_custom_layout() {
	$options = wpwebapp_get_plugin_options_pw_change();
	return $options['custom_layout'];
}

?>