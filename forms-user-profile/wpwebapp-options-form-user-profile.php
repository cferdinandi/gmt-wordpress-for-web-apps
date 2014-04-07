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
	<div class="layout">
		<label class="description" for="user-profile-fields-other">
			<input type="checkbox" name="wpwebapp_plugin_options_user_profile[user_profile_fields_other]" id="user-profile-fields-other" <?php checked( 'on', $options['user_profile_fields_other'] ); ?> />
			<?php _e( 'Other', 'wpwebapp' ); ?>
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
		'user_profile_fields_other' => 'off',
		'gravatar_size' => '',
		'contact_info' => '',
		'button_class' => '',
		'button_text' => '',
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

	if ( isset( $input['user_profile_fields_other'] ) )
		$output['user_profile_fields_other'] = 'on';

	if ( isset( $input['gravatar_size'] ) && ! empty( $input['gravatar_size'] ) && is_numeric( $input['gravatar_size'] ) && ( $input['gravatar_size'] > 0 ) )
		$output['gravatar_size'] = wp_filter_nohtml_kses( $input['gravatar_size'] );

	if ( isset( $input['contact_info'] ) && ! empty( $input['contact_info'] ) )
		$output['contact_info'] = wp_filter_nohtml_kses( $input['contact_info'] );

	if ( isset( $input['button_class'] ) && ! empty( $input['button_class'] ) )
		$output['button_class'] = wp_filter_nohtml_kses( $input['button_class'] );

	if ( isset( $input['button_text'] ) && ! empty( $input['button_text'] ) )
		$output['button_text'] = wp_filter_nohtml_kses( $input['button_text'] );

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
	add_settings_field( 'contact_info', __( 'Contact Info Label', 'wpwebapp' ) . '<div class="description">' . __( 'Label to display above contact info section.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_contact_info_label', 'wpwebapp_plugin_options_user_profile', 'user_profile' );
	add_settings_field( 'button_class', __( 'Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to form submit buttons.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_class_user_profile', 'wpwebapp_plugin_options_user_profile', 'user_profile' );
	add_settings_field( 'button_text', __( 'Update Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text to display for the update profile button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_user_profile', 'wpwebapp_plugin_options_user_profile', 'user_profile' );

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

// function wpwebapp_get_user_profile_field_gravatar() {
// 	$options = wpwebapp_get_plugin_options_user_profile();
// 	$setting = $options['user_profile_fields_gravatar'];
// 	return $setting;
// }

// function wpwebapp_get_user_profile_field_name() {
// 	$options = wpwebapp_get_plugin_options_user_profile();
// 	$setting = $options['user_profile_fields_name'];
// 	return $setting;
// }

// function wpwebapp_get_user_profile_field_about() {
// 	$options = wpwebapp_get_plugin_options_user_profile();
// 	$setting = $options['user_profile_fields_about'];
// 	return $setting;
// }

// function wpwebapp_get_user_profile_field_location() {
// 	$options = wpwebapp_get_plugin_options_user_profile();
// 	$setting = $options['user_profile_fields_locationt'];
// 	return $setting;
// }

// function wpwebapp_get_user_profile_field_website() {
// 	$options = wpwebapp_get_plugin_options_user_profile();
// 	$setting = $options['user_profile_fields_website'];
// 	return $setting;
// }

// function wpwebapp_get_user_profile_field_twitter() {
// 	$options = wpwebapp_get_plugin_options_user_profile();
// 	$setting = $options['user_profile_fields_twitter'];
// 	return $setting;
// }

// function wpwebapp_get_user_profile_field_facebook() {
// 	$options = wpwebapp_get_plugin_options_user_profile();
// 	$setting = $options['user_profile_fields_facebook'];
// 	return $setting;
// }

// function wpwebapp_get_user_profile_field_linkedin() {
// 	$options = wpwebapp_get_plugin_options_user_profile();
// 	$setting = $options['user_profile_fields_linkedin'];
// 	return $setting;
// }

// function wpwebapp_get_user_profile_field_other() {
// 	$options = wpwebapp_get_plugin_options_user_profile();
// 	$setting = $options['user_profile_fields_other'];
// 	return $setting;
// }

// Get an array of profile field types to display
function wpwebapp_get_user_profile_field_types() {
	$options = wpwebapp_get_plugin_options_user_profile();
	$setting = array(
		'gravatar' => $options['user_profile_fields_gravatar'],
		'name' => $options['user_profile_fields_name'],
		'about' => $options['user_profile_fields_about'],
		'location' => $options['user_profile_fields_location'],
		'email' => $options['user_profile_fields_email'],
		'website' => $options['user_profile_fields_website'],
		'twitter' => $options['user_profile_fields_twitter'],
		'facebook' => $options['user_profile_fields_facebook'],
		'linkedin' => $options['user_profile_fields_linkedin'],
		'other' => $options['user_profile_fields_other'],
	);
	return $setting;
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

// Get contact info label
function wpwebapp_get_contact_info_label() {
	$options = wpwebapp_get_plugin_options_user_profile();
	return $options['contact_info'];
}

// Get class for form submit buttons
function wpwebapp_get_form_button_class_user_profile() {
	$options = wpwebapp_get_plugin_options_user_profile();
	$setting = $options['button_class'];
	return $setting;
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

?>