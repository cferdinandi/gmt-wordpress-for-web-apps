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
	$options = wpwebapp_get_plugin_options_user_profile();
	?>
	<div class="layout">
		<label class="description" for="user-profile-fields-gravatar">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profile[user_profile_fields_gravatar]" id="user-profile-fields-gravatar" <?php checked( 'on', $options['user_profile_fields_gravatar'] ); ?> />
			<?php _e( 'Gravatar', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-name">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profile[user_profile_fields_name]" id="user-profile-fields-name" <?php checked( 'on', $options['user_profile_fields_name'] ); ?> />
			<?php _e( 'Name', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-about">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profile[user_profile_fields_about]" id="user-profile-fields-about" <?php checked( 'on', $options['user_profile_fields_about'] ); ?> />
			<?php _e( 'About', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-location">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profile[user_profile_fields_location]" id="user-profile-fields-location" <?php checked( 'on', $options['user_profile_fields_location'] ); ?> />
			<?php _e( 'Location', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-email">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profile[user_profile_fields_email]" id="user-profile-fields-email" <?php checked( 'on', $options['user_profile_fields_email'] ); ?> />
			<?php _e( 'Email', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-website">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profile[user_profile_fields_website]" id="user-profile-fields-website" <?php checked( 'on', $options['user_profile_fields_website'] ); ?> />
			<?php _e( 'Website', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-twitter">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profile[user_profile_fields_twitter]" id="user-profile-fields-twitter" <?php checked( 'on', $options['user_profile_fields_twitter'] ); ?> />
			<?php _e( 'Twitter', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-facebook">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profile[user_profile_fields_facebook]" id="user-profile-fields-facebook" <?php checked( 'on', $options['user_profile_fields_facebook'] ); ?> />
			<?php _e( 'Facebook', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="user-profile-fields-linkedin">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profile[user_profile_fields_linkedin]" id="user-profile-fields-linkedin" <?php checked( 'on', $options['user_profile_fields_linkedin'] ); ?> />
			<?php _e( 'LinkedIn', 'wpwebapp' ); ?>
		</label>
	</div>
	<?php
}

function wpwebapp_settings_field_gravatar_size() {
	$options = wpwebapp_get_plugin_options_user_profile();
	?>
	<input type="text" name="wpwebapp_plugin_options_user_profile[gravatar_size]" id="gravatar-size" value="<?php echo esc_attr( $options['gravatar_size'] ); ?>" /><br>
	<label class="description" for="gravatar-size"><?php _e( 'Default: <code>96</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_gravatar_text() {
	$options = wpwebapp_get_plugin_options_user_profile();
	?>
	<input type="text" name="wpwebapp_plugin_options_user_profile[gravatar_text]" id="gravatar-text" value="<?php echo esc_attr( $options['gravatar_text'] ); ?>" /><br>
	<label class="description" for="gravatar-text"><?php _e( 'Default: <code>&lt;p&gt;Update your profile photo at &lt;a href="https://en.gravatar.com/"&gt;Gravatar.com&lt;/a&gt;.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_contact_info_label() {
	$options = wpwebapp_get_plugin_options_user_profile();
	?>
	<input type="text" name="wpwebapp_plugin_options_user_profile[contact_info]" id="contact-info" value="<?php echo esc_attr( $options['contact_info'] ); ?>" /><br>
	<label class="description" for="contact-info"><?php _e( 'Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_class_user_profile() {
	$options = wpwebapp_get_plugin_options_user_profile();
	?>
	<input type="text" name="wpwebapp_plugin_options_user_profile[button_class]" id="button-class" value="<?php echo esc_attr( $options['button_class'] ); ?>" /><br>
	<label class="description" for="button-class"><?php _e( 'Example: <code>btn btn-blue</code>. Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_user_profile() {
	$options = wpwebapp_get_plugin_options_user_profile();
	?>
	<input type="text" name="wpwebapp_plugin_options_user_profile[button_text]" id="button-text" value="<?php echo esc_attr( $options['button_text'] ); ?>" /><br>
	<label class="description" for="button-text"><?php _e( 'Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_custom_layout_user_profile() {
	$options = wpwebapp_get_plugin_options_user_profile();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_user_profile[custom_layout]" id="custom-layout" cols="50" rows="10" /><?php echo esc_textarea( $options['custom_layout'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Use the following variables to add fields to the layout:', 'wpwebapp' ); ?><br />
		<?php _e( 'Alert', 'wpwebapp' ); ?> - <code>%alert</code><br />
		<?php _e( 'Gravatar', 'wpwebapp' ); ?> - <code>%gravatar</code><br />
		<?php _e( 'Name', 'wpwebapp' ); ?> - <code>%name</code><br />
		<?php _e( 'About', 'wpwebapp' ); ?> - <code>%about</code><br />
		<?php _e( 'Location', 'wpwebapp' ); ?> - <code>%location</code><br />
		<?php _e( 'Email', 'wpwebapp' ); ?> - <code>%email</code><br />
		<?php _e( 'Website', 'wpwebapp' ); ?> - <code>%website</code><br />
		<?php _e( 'Twitter', 'wpwebapp' ); ?> - <code>%twitter</code><br />
		<?php _e( 'Facebook', 'wpwebapp' ); ?> - <code>%facebook</code><br />
		<?php _e( 'LinkedIn', 'wpwebapp' ); ?> - <code>%linkedin</code><br />
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
function wpwebapp_get_plugin_options_user_profile() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_user_profile' );
	$defaults = array(
		'user_profile_fields_gravatar' => 'off',
		'user_profile_fields_name' => 'off',
		'user_profile_fields_about' => 'off',
		'user_profile_fields_location' => 'off',
		'user_profile_fields_email' => 'off',
		'user_profile_fields_website' => 'off',
		'user_profile_fields_twitter' => 'off',
		'user_profile_fields_facebook' => 'off',
		'user_profile_fields_linkedin' => 'off',
		'gravatar_size' => '',
		'gravatar_text' => '',
		'contact_info' => '',
		'button_class' => '',
		'button_text' => '',
		'custom_layout' => '',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_user_profile', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_user_profile( $input ) {

	$output = array();

	if ( isset( $input['user_profile_fields_gravatar'] ) )
		$output['user_profile_fields_gravatar'] = 'on';

	if ( isset( $input['user_profile_fields_name'] ) )
		$output['user_profile_fields_name'] = 'on';

	if ( isset( $input['user_profile_fields_about'] ) )
		$output['user_profile_fields_about'] = 'on';

	if ( isset( $input['user_profile_fields_location'] ) )
		$output['user_profile_fields_location'] = 'on';

	if ( isset( $input['user_profile_fields_email'] ) )
		$output['user_profile_fields_email'] = 'on';

	if ( isset( $input['user_profile_fields_website'] ) )
		$output['user_profile_fields_website'] = 'on';

	if ( isset( $input['user_profile_fields_twitter'] ) )
		$output['user_profile_fields_twitter'] = 'on';

	if ( isset( $input['user_profile_fields_facebook'] ) )
		$output['user_profile_fields_facebook'] = 'on';

	if ( isset( $input['user_profile_fields_linkedin'] ) )
		$output['user_profile_fields_linkedin'] = 'on';

	if ( isset( $input['gravatar_size'] ) && ! empty( $input['gravatar_size'] ) && is_numeric( $input['gravatar_size'] ) && ( $input['gravatar_size'] > 0 ) )
		$output['gravatar_size'] = wp_filter_nohtml_kses( $input['gravatar_size'] );

	if ( isset( $input['gravatar_text'] ) && ! empty( $input['gravatar_text'] ) )
		$output['gravatar_text'] = wp_filter_post_kses( $input['gravatar_text'] );

	if ( isset( $input['contact_info'] ) && ! empty( $input['contact_info'] ) )
		$output['contact_info'] = wp_filter_nohtml_kses( $input['contact_info'] );

	if ( isset( $input['button_class'] ) && ! empty( $input['button_class'] ) )
		$output['button_class'] = wp_filter_nohtml_kses( $input['button_class'] );

	if ( isset( $input['button_text'] ) && ! empty( $input['button_text'] ) )
		$output['button_text'] = wp_filter_nohtml_kses( $input['button_text'] );

	if ( isset( $input['custom_layout'] ) && ! empty( $input['custom_layout'] ) )
		$output['custom_layout'] = wp_filter_post_kses( $input['custom_layout'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_user_profile', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_user_profile() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'User Profiles', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Control user profile settings.', 'wpwebapp' ) ?></p>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_user_profile' );
				do_settings_sections( 'wpwebapp_plugin_options_user_profile' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_user_profile() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_user_profile', 'wpwebapp_plugin_options_user_profile', 'wpwebapp_plugin_options_validate_user_profile' );

	// Fields
	add_settings_section( 'user_profile', '',  '__return_false', 'wpwebapp_plugin_options_user_profile' );
	add_settings_field( 'user_profile_fields', __( 'User Profile Fields', 'wpwebapp' ) . '<div class="description">' . __( 'Fields to display in user profile.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_user_profile_fields', 'wpwebapp_plugin_options_user_profile', 'user_profile' );
	add_settings_field( 'gravatar_size', __( 'Gravatar Size', 'wpwebapp' ) . '<div class="description">' . __( 'Default size for gravatar profile images.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_gravatar_size', 'wpwebapp_plugin_options_user_profile', 'user_profile' );
	add_settings_field( 'gravatar_text', __( 'Gravatar Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text displayed below gravatar image.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_gravatar_text', 'wpwebapp_plugin_options_user_profile', 'user_profile' );
	add_settings_field( 'contact_info', __( 'Contact Info Label', 'wpwebapp' ) . '<div class="description">' . __( 'Label to display above contact info section.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_contact_info_label', 'wpwebapp_plugin_options_user_profile', 'user_profile' );
	add_settings_field( 'button_class', __( 'Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to form submit buttons.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_class_user_profile', 'wpwebapp_plugin_options_user_profile', 'user_profile' );
	add_settings_field( 'button_text', __( 'Update Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text to display for the update profile button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_user_profile', 'wpwebapp_plugin_options_user_profile', 'user_profile' );
	add_settings_field( 'custom_layout', __( 'Custom Layout', 'wpwebapp' ) . '<div class="description">' . __( 'Customize the layout of the form with your own markup.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_custom_layout_user_profile', 'wpwebapp_plugin_options_user_profile', 'user_profile' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_user_profile' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_user_profile() {
	add_submenu_page( 'wpwa_options', __( 'User Profiles', 'wpwebapp' ), __( 'User Profiles', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_user_profile', 'wpwebapp_plugin_options_render_page_user_profile' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_user_profile' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_user_profile( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_user_profile', 'wpwebapp_option_page_capability_user_profile' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get an array of profile field types to display
function wpwebapp_get_user_profile_field_types() {
	$options = wpwebapp_get_plugin_options_user_profile();
	return array(
		'gravatar' => $options['user_profile_fields_gravatar'],
		'name' => $options['user_profile_fields_name'],
		'about' => $options['user_profile_fields_about'],
		'location' => $options['user_profile_fields_location'],
		'email' => $options['user_profile_fields_email'],
		'website' => $options['user_profile_fields_website'],
		'twitter' => $options['user_profile_fields_twitter'],
		'facebook' => $options['user_profile_fields_facebook'],
		'linkedin' => $options['user_profile_fields_linkedin'],
	);
}

// Get default gravatar size
function wpwebapp_get_gravatar_size() {
	$options = wpwebapp_get_plugin_options_user_profile();
	$setting = $options['gravatar_size'];
	if ( $setting === '' ) {
		return '96';
	} else {
		return $setting;
	}
}

// Get gravatar caption text
function wpwebapp_get_gravatar_text() {
	$options = wpwebapp_get_plugin_options_user_profile();
	return $options['gravatar_text'];
}

// Get contact info label
function wpwebapp_get_contact_info_label() {
	$options = wpwebapp_get_plugin_options_user_profile();
	return $options['contact_info'];
}

// Get class for form submit buttons
function wpwebapp_get_form_button_class_user_profile() {
	$options = wpwebapp_get_plugin_options_user_profile();
	return $options['button_class'];
}

// Get text for form submit buttons
function wpwebapp_get_user_profile_text() {
	$options = wpwebapp_get_plugin_options_user_profile();
	if ( $options['button_text'] === '' ) {
		return __( 'Update Profile', 'wpwebapp' );
	} else {
		return $options['button_text'];
	}
}

// Get custom layout
function wpwebapp_get_user_profile_custom_layout() {
	$options = wpwebapp_get_plugin_options_user_profile();
	return $options['custom_layout'];
}

?>