<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

function wpwebapp_settings_field_user_profile_fields() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	?>
	<div class="layout">
		<label class="description" for="user-profile-fields-gravatar">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profiles[user_profile_fields_gravatar]" id="user-profile-fields-gravatar" <?php checked( 'on', $options['user_profile_fields_gravatar'] ); ?> />
			<?php _e( 'Gravatar', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-name">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profiles[user_profile_fields_name]" id="user-profile-fields-name" <?php checked( 'on', $options['user_profile_fields_name'] ); ?> />
			<?php _e( 'Name', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-about">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profiles[user_profile_fields_about]" id="user-profile-fields-about" <?php checked( 'on', $options['user_profile_fields_about'] ); ?> />
			<?php _e( 'About', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-location">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profiles[user_profile_fields_location]" id="user-profile-fields-location" <?php checked( 'on', $options['user_profile_fields_location'] ); ?> />
			<?php _e( 'Location', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-website">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profiles[user_profile_fields_website]" id="user-profile-fields-website" <?php checked( 'on', $options['user_profile_fields_website'] ); ?> />
			<?php _e( 'Website', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-twitter">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profiles[user_profile_fields_twitter]" id="user-profile-fields-twitter" <?php checked( 'on', $options['user_profile_fields_twitter'] ); ?> />
			<?php _e( 'Twitter', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-facebook">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profiles[user_profile_fields_facebook]" id="user-profile-fields-facebook" <?php checked( 'on', $options['user_profile_fields_facebook'] ); ?> />
			<?php _e( 'Facebook', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-linkedin">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profiles[user_profile_fields_linkedin]" id="user-profile-fields-linkedin" <?php checked( 'on', $options['user_profile_fields_linkedin'] ); ?> />
			<?php _e( 'LinkedIn', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-other">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profiles[user_profile_fields_other]" id="user-profile-fields-other" <?php checked( 'on', $options['user_profile_fields_other'] ); ?> />
			<?php _e( 'Other', 'wpwebapp' ); ?>
		</label>
	</div>
	<?php
}

function wpwebapp_settings_field_gravatar_size() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	?>
	<input type="text" name="wpwebapp_plugin_options_user_profiles[gravatar_size]" id="gravatar-size" value="<?php echo esc_attr( $options['gravatar_size'] ); ?>" /><br>
	<label class="description" for="gravatar-size"><?php _e( 'Default: <code>96</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_class_user_profiles() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	?>
	<input type="text" name="wpwebapp_plugin_options_user_profiles[button_class]" id="button-class" value="<?php echo esc_attr( $options['button_class'] ); ?>" /><br>
	<label class="description" for="button-class"><?php _e( 'Example: <code>btn btn-blue</code>. Default: None.', 'wpwebapp' ); ?></label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_user_profiles() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_user_profiles' );
	$defaults = array(
		'user_profile_fields_gravatar' => 'off',
		'user_profile_fields_name' => 'off',
		'user_profile_fields_about' => 'off',
		'user_profile_fields_location' => 'off',
		'user_profile_fields_website' => 'off',
		'user_profile_fields_twitter' => 'off',
		'user_profile_fields_facebook' => 'off',
		'user_profile_fields_linkedin' => 'off',
		'user_profile_fields_other' => 'off',
		'gravatar_size' => '',
		'button_class' => '',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_user_profiles', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_user_profiles( $input ) {

	$output = array();

	if ( isset( $input['user_profile_fields_gravatar'] ) )
		$output['user_profile_fields_gravatar'] = 'on';

	if ( isset( $input['user_profile_fields_name'] ) )
		$output['user_profile_fields_name'] = 'on';

	if ( isset( $input['user_profile_fields_about'] ) )
		$output['user_profile_fields_about'] = 'on';

	if ( isset( $input['user_profile_fields_location'] ) )
		$output['user_profile_fields_location'] = 'on';

	if ( isset( $input['user_profile_fields_website'] ) )
		$output['user_profile_fields_website'] = 'on';

	if ( isset( $input['user_profile_fields_twitter'] ) )
		$output['user_profile_fields_twitter'] = 'on';

	if ( isset( $input['user_profile_fields_facebook'] ) )
		$output['user_profile_fields_facebook'] = 'on';

	if ( isset( $input['user_profile_fields_linkedin'] ) )
		$output['user_profile_fields_linkedin'] = 'on';

	if ( isset( $input['user_profile_fields_other'] ) )
		$output['user_profile_fields_other'] = 'on';

	if ( isset( $input['gravatar_size'] ) && ! empty( $input['gravatar_size'] ) && is_numeric( $input['gravatar_size'] ) && ( $input['gravatar_size'] > 0 ) )
		$output['gravatar_size'] = wp_filter_nohtml_kses( $input['gravatar_size'] );

	if ( isset( $input['button_class'] ) && ! empty( $input['button_class'] ) )
		$output['button_class'] = wp_filter_nohtml_kses( $input['button_class'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_user_profiles', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_user_profiles() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'User Profiles', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Control user profile settings.', 'wpwebapp' ) ?></p>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_user_profiles' );
				do_settings_sections( 'wpwebapp_plugin_options_user_profiles' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_user_profiles() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_user_profiles', 'wpwebapp_plugin_options_user_profiles', 'wpwebapp_plugin_options_validate_user_profiles' );

	// Fields
	add_settings_section( 'user_profiles', '',  '__return_false', 'wpwebapp_plugin_options_user_profiles' );
	add_settings_field( 'user_profile_fields', __( 'User Profile Fields', 'wpwebapp' ) . '<div class="description">' . __( 'Fields to display in user profile.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_user_profile_fields', 'wpwebapp_plugin_options_user_profiles', 'user_profiles' );
	add_settings_field( 'gravatar_size', __( 'Gravatar Size', 'wpwebapp' ) . '<div class="description">' . __( 'Default size for gravatar profile images.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_gravatar_size', 'wpwebapp_plugin_options_user_profiles', 'user_profiles' );
	add_settings_field( 'button_class', __( 'Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to form submit buttons.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_class_user_profiles', 'wpwebapp_plugin_options_user_profiles', 'user_profiles' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_user_profiles' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_user_profiles() {
	add_submenu_page( 'wpwa_options', __( 'User Profiles', 'wpwebapp' ), __( 'User Profiles', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_user_profiles', 'wpwebapp_plugin_options_render_page_user_profiles' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_user_profiles' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_user_profiles( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_user_profiles', 'wpwebapp_option_page_capability_user_profiles' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

function wpwebapp_get_user_profile_field_gravatar() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['user_profile_fields_gravatar'];
	return $setting;
}

function wpwebapp_get_user_profile_field_name() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['user_profile_fields_name'];
	return $setting;
}

function wpwebapp_get_user_profile_field_about() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['user_profile_fields_about'];
	return $setting;
}

function wpwebapp_get_user_profile_field_location() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['user_profile_fields_locationt'];
	return $setting;
}

function wpwebapp_get_user_profile_field_website() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['user_profile_fields_website'];
	return $setting;
}

function wpwebapp_get_user_profile_field_twitter() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['user_profile_fields_twitter'];
	return $setting;
}

function wpwebapp_get_user_profile_field_facebook() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['user_profile_fields_facebook'];
	return $setting;
}

function wpwebapp_get_user_profile_field_linkedin() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['user_profile_fields_linkedin'];
	return $setting;
}

function wpwebapp_get_user_profile_field_other() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['user_profile_fields_other'];
	return $setting;
}

// Get class for form submit buttons
function wpwebapp_get_gravatar_size() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['gravatar_size'];
	if ( $setting === '' ) {
		return '96';
	} else {
		return $setting;
	}
}

// Get class for form submit buttons
function wpwebapp_get_form_button_class_user_profile() {
	$options = wpwebapp_get_plugin_options_user_profiles();
	$setting = $options['button_class'];
	return $setting;
}

?>