<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

function wpwebapp_settings_field_delete_button_class() {
	$options = wpwebapp_get_plugin_options_delete_account();
	?>
	<input type="text" name="wpwebapp_plugin_options_delete_account[delete_button_class]" id="delete-button-class" value="<?php echo esc_attr( $options['delete_button_class'] ); ?>" /><br>
	<label class="description" for="delete-button-class"><?php _e( 'Example: <code>btn btn-red</code>. Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_delete_account_text() {
	$options = wpwebapp_get_plugin_options_delete_account();
	?>
	<input type="text" name="wpwebapp_plugin_options_delete_account[delete_account_text]" id="delete-account-text" value="<?php echo esc_attr( $options['delete_account_text'] ); ?>" /><br>
	<label class="description" for="delete-account-text"><?php _e( 'Default: <code>Delete Account</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_delete_account_url() {
	$options = wpwebapp_get_plugin_options_delete_account();
	?>
	<input type="text" name="wpwebapp_plugin_options_delete_account[delete_account_url]" id="delete-account-text" value="<?php echo esc_url_raw( $options['delete_account_url'] ); ?>" /><br>
	<label class="description" for="delete-account-url"><?php _e( 'Default: Logged-Out Redirect', 'wpwebapp' ); ?></label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_delete_account() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_delete_account' );
	$defaults = array(
		'delete_button_class' => '',
		'delete_account_text' => '',
		'delete_account_url' => '',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_delete_account', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_delete_account( $input ) {

	$output = array();

	if ( isset( $input['delete_button_class'] ) && ! empty( $input['delete_button_class'] ) )
		$output['delete_button_class'] = wp_filter_nohtml_kses( $input['delete_button_class'] );

	if ( isset( $input['delete_account_text'] ) && ! empty( $input['delete_account_text'] ) )
		$output['delete_account_text'] = wp_filter_post_kses( $input['delete_account_text'] );

	if ( isset( $input['delete_account_url'] ) && ! empty( $input['delete_account_url'] ) )
		$output['delete_account_url'] = wp_filter_post_kses( $input['delete_account_url'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_delete_account', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_delete_account() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Delete Account', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Control delete account settings.', 'wpwebapp' ) ?></p>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_delete_account' );
				do_settings_sections( 'wpwebapp_plugin_options_delete_account' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_delete_account() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_delete_account', 'wpwebapp_plugin_options_delete_account', 'wpwebapp_plugin_options_validate_delete_account' );

	// Fields
	add_settings_section( 'forms', '',  '__return_false', 'wpwebapp_plugin_options_delete_account' );
	add_settings_field( 'delete_button_class', __( 'Delete Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to the "delete account" button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_delete_button_class', 'wpwebapp_plugin_options_delete_account', 'forms' );
	add_settings_field( 'delete_account_text', __( 'Delete Account Text', 'wpwebapp' ) . '<div class="description">' . __( 'Delete Account Form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_delete_account_text', 'wpwebapp_plugin_options_delete_account', 'forms' );
	add_settings_field( 'delete_account_url', __( 'Delete Account Redirect URL', 'wpwebapp' ) . '<div class="description">' . __( 'Delete Account Form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_delete_account_url', 'wpwebapp_plugin_options_delete_account', 'forms' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_delete_account' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_delete_account() {
	add_submenu_page( 'wpwa_options', __( 'Delete Account', 'wpwebapp' ), __( 'Delete Account', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_delete_account', 'wpwebapp_plugin_options_render_page_delete_account' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_delete_account' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_delete_account( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_delete_account', 'wpwebapp_option_page_capability_delete_account' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get class for delete account button
function wpwebapp_get_delete_account_button_class() {
	$options = wpwebapp_get_plugin_options_delete_account();
	if ( $options['delete_button_class'] === '' ) {
		return '';
	} else {
		return $options['delete_button_class'];
	}
}

// Get text for delete account button
function wpwebapp_get_delete_account_text() {
	$options = wpwebapp_get_plugin_options_delete_account();
	if ( $options['delete_account_text'] === '' ) {
		return __( 'Delete Account', 'wpwebapp' );
	} else {
		return $options['delete_account_text'];
	}
}

// Get redirect URL for delete account button
function wpwebapp_get_delete_account_url() {
	$options = wpwebapp_get_plugin_options_delete_account();
	if ( $options['delete_account_url'] === '' ) {
		return wpwebapp_get_redirect_url_logged_out();
	} else {
		return $options['delete_account_url'];
	}
}

?>