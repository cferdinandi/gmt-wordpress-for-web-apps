<?php

/* ======================================================================

	Security Options

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

function wpwebapp_settings_field_minimum_password_length() {
	$options = wpwebapp_get_plugin_options_security();
	?>
	<input type="text" name="wpwebapp_plugin_options_security[minimum_password_length]" id="minimum-password-length" value="<?php echo esc_attr( $options['minimum_password_length'] ); ?>" /><br>
	<label class="description" for="minimum-password-length"><?php _e( 'Default: <code>8</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_password_requirements() {
	$options = wpwebapp_get_plugin_options_security();
	?>
	<div class="layout">
		<label class="description" for="password-requirements-letters">
			<input type="checkbox" name="wpwebapp_plugin_options_security[password_requirements_letters]" id="password-requirements-letters" <?php checked( 'on', $options['password_requirements_letters'] ); ?> />
			<?php _e( 'Letters', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="password-requirements-numbers">
			<input type="checkbox" name="wpwebapp_plugin_options_security[password_requirements_numbers]" id="password-requirements-numbers" <?php checked( 'on', $options['password_requirements_numbers'] ); ?> />
			<?php _e( 'Numbers', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="password-requirements-special-chars">
			<input type="checkbox" name="wpwebapp_plugin_options_security[password_requirements_special_chars]" id="password-requirements-special-chars" <?php checked( 'on', $options['password_requirements_special_chars'] ); ?> />
			<?php _e( 'Special Characters', 'wpwebapp' ); ?>
		</label>
	</div>
	<?php
}

// Used in wpwebapp_settings_field_restrict_pw_reset()
function wpwebapp_settings_field_restrict_pw_reset_choices() {
	$restrict_pw_reset = array(
		'admin' => array(
			'value' => 'admin',
			'label' => __( 'Admin', 'wpwebapp' )
		),
		'editor' => array(
			'value' => 'editor',
			'label' => __( 'Editor', 'wpwebapp' )
		),
		'author' => array(
			'value' => 'author',
			'label' => __( 'Author', 'wpwebapp' )
		),
		'contributor' => array(
			'value' => 'contributor',
			'label' => __( 'Contributor', 'wpwebapp' )
		),
		'subscriber' => array(
			'value' => 'subscriber',
			'label' => __( 'Subscriber', 'wpwebapp' )
		)
	);

	return apply_filters( 'wpwebapp_settings_field_restrict_pw_reset_choices', $restrict_pw_reset );
}

function wpwebapp_settings_field_restrict_pw_reset() {
	$options = wpwebapp_get_plugin_options_security();
	foreach ( wpwebapp_settings_field_restrict_pw_reset_choices() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="wpwebapp_plugin_options_security[restrict_pw_reset]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['restrict_pw_reset'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}

function wpwebapp_settings_field_pw_reset_time_valid() {
	$options = wpwebapp_get_plugin_options_security();
	?>
	<input type="text" name="wpwebapp_plugin_options_security[pw_reset_time_valid]" id="pw-reset-time-valid" value="<?php echo esc_attr( $options['pw_reset_time_valid'] ); ?>" /><br>
	<label class="description" for="pw-reset-time-valid"><?php _e( 'Default: <code>24</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_pw_requirement_text() {
	$options = wpwebapp_get_plugin_options_security();
	?>
	<input type="text" name="wpwebapp_plugin_options_security[pw_requirement_text]" id="pw-requirement-text" value="<?php echo esc_attr( $options['pw_requirement_text'] ); ?>" /><br>
	<label class="description" for="pw-requirement-text"><?php _e( 'Default: Varies based on your password requirements under "Security"<br />Use the variable <code>%n</code> to dynamically display the minimum character number from your settings.', 'wpwebapp' ); ?></label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_security() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_security' );
	$defaults = array(
		'minimum_password_length' => '',
		'password_requirements_letters' => 'off',
		'password_requirements_numbers' => 'off',
		'password_requirements_special_chars' => 'off',
		'restrict_pw_reset' => 'subscriber',
		'pw_reset_time_valid' => '',
		'pw_requirement_text' => '',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_security', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_security( $input ) {

	$output = array();

	if ( isset( $input['minimum_password_length'] ) && ! empty( $input['minimum_password_length'] ) && is_numeric( $input['minimum_password_length'] ) && ( $input['minimum_password_length'] > 0 ) )
		$output['minimum_password_length'] = wp_filter_nohtml_kses( $input['minimum_password_length'] );

	if ( isset( $input['password_requirements_letters'] ) )
		$output['password_requirements_letters'] = 'on';

	if ( isset( $input['password_requirements_numbers'] ) )
		$output['password_requirements_numbers'] = 'on';

	if ( isset( $input['password_requirements_special_chars'] ) )
		$output['password_requirements_special_chars'] = 'on';

	if ( isset( $input['restrict_pw_reset'] ) && array_key_exists( $input['restrict_pw_reset'], wpwebapp_settings_field_restrict_pw_reset_choices() ) )
		$output['restrict_pw_reset'] = $input['restrict_pw_reset'];

	if ( isset( $input['pw_reset_time_valid'] ) && ! empty( $input['pw_reset_time_valid'] ) && is_numeric( $input['minimum_password_length'] ) && ( $input['minimum_password_length'] > 0 ) )
		$output['pw_reset_time_valid'] = wp_filter_nohtml_kses( $input['pw_reset_time_valid'] );

	if ( isset( $input['pw_requirement_text'] ) && ! empty( $input['pw_requirement_text'] ) )
		$output['pw_requirement_text'] = wp_filter_post_kses( $input['pw_requirement_text'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_security', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_security() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Security', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Edit web app security settings.', 'wpwebapp' ) ?></p>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_security' );
				do_settings_sections( 'wpwebapp_plugin_options_security' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_security() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_security', 'wpwebapp_plugin_options_security', 'wpwebapp_plugin_options_validate_security' );

	// Fields
	add_settings_section( 'security', '',  '__return_false', 'wpwebapp_plugin_options_security' );
	add_settings_field( 'minimum_password_length', __( 'Minimum Password Length', 'wpwebapp' ) . '<div class="description">' . __( 'Must be a whole number', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_minimum_password_length', 'wpwebapp_plugin_options_security', 'security' );
	add_settings_field( 'password_requirements_letters', __( 'Password Requirements', 'wpwebapp' ) . '<div class="description">' . __( 'Required password characters', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_password_requirements', 'wpwebapp_plugin_options_security', 'security' );
	add_settings_field( 'restrict_pw_reset', __( 'Restrict Password Reset', 'wpwebapp' ) . '<div class="description">' . __( 'Highest role that can use the password reset form (lower is more secure)', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_restrict_pw_reset', 'wpwebapp_plugin_options_security', 'security' );
	add_settings_field( 'pw_reset_time_valid', __( 'Password Reset Time', 'wpwebapp' ) . '<div class="description">' . __( 'Number of hours password reset URL is valid for (must be a whole number)', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_pw_reset_time_valid', 'wpwebapp_plugin_options_security', 'security' );
	add_settings_field( 'pw_requirement_text', __( 'Password Requirement Text', 'wpwebapp' ) . '<div class="description">' . __( 'Signup, Password Change, and Password Reset Forms', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_pw_requirement_text', 'wpwebapp_plugin_options_security', 'security' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_security' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_security() {
	add_submenu_page( 'wpwa_options', __( 'Security', 'wpwebapp' ), __( 'Security', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_security', 'wpwebapp_plugin_options_render_page_security' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_security' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_security( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_security', 'wpwebapp_option_page_capability_security' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get minimum password length
function wpwebapp_get_minimum_pw_length() {
	$options = wpwebapp_get_plugin_options_security();
	if ( $options['minimum_password_length'] === '' ) {
		$setting = '8';
	} else {
		$setting = $options['minimum_password_length'];
	}
	return $setting;
}

// Get password requirement for letters
function wpwebapp_get_pw_requirement_letters() {
	$options = wpwebapp_get_plugin_options_security();
	$setting = $options['password_requirements_letters'];
	return $setting;
}

// Get password requirement for numbers
function wpwebapp_get_pw_requirement_numbers() {
	$options = wpwebapp_get_plugin_options_security();
	$setting = $options['password_requirements_numbers'];
	return $setting;
}

// Get password requirement for special characters
function wpwebapp_get_pw_requirement_special_chars() {
	$options = wpwebapp_get_plugin_options_security();
	$setting = $options['password_requirements_special_chars'];
	return $setting;
}

// Get role restrictions for password resets
function wpwebapp_get_pw_reset_restriction() {
	$options = wpwebapp_get_plugin_options_security();
	if ( $options['restrict_pw_reset'] == 'subscriber' ) {
		$setting = 'edit_posts';
	} else if ( $options['restrict_pw_reset'] == 'contributor' ) {
		$setting = 'publish_posts';
	} else if ( $options['restrict_pw_reset'] == 'author' ) {
		$setting = 'edit_pages';
	} else if ( $options['restrict_pw_reset'] == 'editor' ) {
		$setting = 'edit_themes';
	} else {
		$setting = '';
	}
	return $setting;
}

// Get number of hours a password reset URL is valid for
function wpwebapp_get_pw_reset_time_valid() {
	$options = wpwebapp_get_plugin_options_security();
	if ( $options['pw_reset_time_valid'] === '' ) {
		$setting = '24';
	} else {
		$setting = $options['pw_reset_time_valid'];
	}
	return $setting;
}

// Get text for password requirements description
function wpwebapp_get_pw_requirements_text() {
	$options = wpwebapp_get_plugin_options_security();
	$pw_min_length = wpwebapp_get_minimum_pw_length();
	$requires_letters = wpwebapp_get_pw_requirement_letters();
	$requires_numbers = wpwebapp_get_pw_requirement_numbers();
	$requires_special_chars = wpwebapp_get_pw_requirement_special_chars();

	if ( $options['pw_requirement_text'] === '' ) {
		if ( $requires_letters == 'on' && $requires_numbers == 'on' && $requires_special_chars == 'on' ) {
				$setting = '<div>' . sprintf( __( 'Use at least one letter, one number, one special character, and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
			} else if ( $requires_letters == 'on' && $requires_numbers == 'on' ) {
				$setting = '<div>' . sprintf( __( 'Use at least one letter, one number, and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
			} else if ( $requires_letters == 'on' && $requires_special_chars == 'on' ) {
				$setting = '<div>' . sprintf( __( 'Use at least one letter, one special character, and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
			} else if ( $requires_numbers == 'on' && $requires_special_chars == 'on' ) {
				$setting = '<div>' . sprintf( __( 'Use at least one number, one special character, and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
			} else if ( $requires_letters == 'on' ) {
				$setting = '<div>' . sprintf( __( 'Use at least one letter and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
			} else if ( $requires_numbers == 'on' ) {
				$setting = '<div>' . sprintf( __( 'Use at least one number and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
			} else if ( $requires_special_chars == 'on' ) {
				$setting = '<div>' . sprintf( __( 'Use at least one special character and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
			} else if ( $pw_min_length > 1 ) {
				$setting = '<div>' . sprintf( __( 'Use at least %d characters', 'kraken' ), $pw_min_length ) . '</div>';
			} else {
				$setting = '';
			}
	} else {
		$setting = $options['pw_requirement_text'];
		$scrubber = array( '%n' => $pw_min_length );
		$setting = strtr( $setting, $scrubber );
	}

	return $setting;
}

?>