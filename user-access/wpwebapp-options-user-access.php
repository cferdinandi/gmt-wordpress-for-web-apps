<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

// Used in wpwebapp_settings_field_block_wp_backend_access()
function wpwebapp_settings_field_block_wp_backend_access_choices() {
	$block_wp_backend_access = array(
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

	return apply_filters( 'wpwebapp_settings_field_block_wp_backend_access_choices', $block_wp_backend_access );
}

function wpwebapp_settings_field_block_wp_backend_access() {
	$options = wpwebapp_get_plugin_options_user_access();
	foreach ( wpwebapp_settings_field_block_wp_backend_access_choices() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="wpwebapp_plugin_options_user_access[block_wp_backend_access]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['block_wp_backend_access'], $button['value'] ); ?>>
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}

function wpwebapp_settings_field_redirect_logged_out() {
	$options = wpwebapp_get_plugin_options_user_access();
	?>
	<input type="text" name="wpwebapp_plugin_options_user_access[redirect_logged_out]" id="redirect-logged-out" value="<?php echo esc_url( $options['redirect_logged_out'] ); ?>"><br>
	<label class="description" for="redirect-logged-out"><?php _e( 'Default: Home Page', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_redirect_logged_in() {
	$options = wpwebapp_get_plugin_options_user_access();
	?>
	<input type="text" name="wpwebapp_plugin_options_user_access[redirect_logged_in]" id="redirect-logged-in" value="<?php echo esc_url( $options['redirect_logged_in'] ); ?>"><br>
	<label class="description" for="redirect-logged-in"><?php _e( 'Default: Home Page', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_blog_posts_require_login() {
	$options = wpwebapp_get_plugin_options_user_access();
	?>
	<label for="blog-posts-require-login">
		<input type="checkbox" name="wpwebapp_plugin_options_user_access[blog_posts_require_login]" id="blog-posts-require-login" <?php checked( 'on', $options['blog_posts_require_login'] ); ?>>
		<?php _e( 'Require user login to view blog posts', 'wpwebapp' ); ?>
	</label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_user_access() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_user_access' );
	$defaults = array(
		'block_wp_backend_access' => 'admin',
		'redirect_logged_in' => '',
		'redirect_logged_out' => '',
		'blog_posts_require_login' => 'off',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_user_access', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_user_access( $input ) {

	$output = array();

	if ( isset( $input['block_wp_backend_access'] ) && array_key_exists( $input['block_wp_backend_access'], wpwebapp_settings_field_block_wp_backend_access_choices() ) )
		$output['block_wp_backend_access'] = $input['block_wp_backend_access'];

	if ( isset( $input['redirect_logged_out'] ) && ! empty( $input['redirect_logged_out'] ) )
		$output['redirect_logged_out'] = wp_filter_nohtml_kses( $input['redirect_logged_out'] );

	if ( isset( $input['redirect_logged_in'] ) && ! empty( $input['redirect_logged_in'] ) )
		$output['redirect_logged_in'] = wp_filter_nohtml_kses( $input['redirect_logged_in'] );

	if ( isset( $input['blog_posts_require_login'] ) )
		$output['blog_posts_require_login'] = 'on';

	return apply_filters( 'wpwebapp_plugin_options_validate_user_access', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_user_access() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'User Access', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Control user access to content.', 'wpwebapp' ) ?></p>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_user_access' );
				do_settings_sections( 'wpwebapp_plugin_options_user_access' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_user_access() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_user_access', 'wpwebapp_plugin_options_user_access', 'wpwebapp_plugin_options_validate_user_access' );

	// Fields
	add_settings_section( 'access', '',  '__return_false', 'wpwebapp_plugin_options_user_access' );
	add_settings_field( 'block_wp_backend_access', __( 'Block Backend Access', 'wpwebapp' ) . '<div class="description">' . __( 'Minimum role required to access the WordPress backend and see the admin bar (higher is more secure)', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_block_wp_backend_access', 'wpwebapp_plugin_options_user_access', 'access' );
	add_settings_field( 'redirect_logged_out', __( 'Logged-Out Redirect', 'wpwebapp' ) . '<div class="description">' . __( 'Where to redirect logged-our users', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_redirect_logged_out', 'wpwebapp_plugin_options_user_access', 'access' );
	add_settings_field( 'redirect_logged_in', __( 'Logged-In Redirect', 'wpwebapp' ) . '<div class="description">' . __( 'Where to redirect logged-in users', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_redirect_logged_in', 'wpwebapp_plugin_options_user_access', 'access' );
	add_settings_field( 'blog_posts_require_login', __( 'Blog Post Access', 'wpwebapp' ), 'wpwebapp_settings_field_blog_posts_require_login', 'wpwebapp_plugin_options_user_access', 'access' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_user_access' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_user_access() {
	add_submenu_page( 'wpwa_options', __( 'User Access', 'wpwebapp' ), __( 'User Access', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_user_access', 'wpwebapp_plugin_options_render_page_user_access' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_user_access' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_user_access( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_user_access', 'wpwebapp_option_page_capability_user_access' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get role restrictions for WordPress backend access
function wpwebapp_get_block_admin_access() {

	// Get user info and plugin settings
	global $current_user;
	get_currentuserinfo();
	$user_id = $current_user->ID;
	$options = wpwebapp_get_plugin_options_user_access();

	// Determine minimum required capability for backend access
	if ( $options['block_wp_backend_access'] == 'admin' ) {
		$capability = 'edit_themes';
	} else if ( $options['block_wp_backend_access'] == 'editor' ) {
		$capability = 'edit_pages';
	} else if ( $options['block_wp_backend_access'] == 'author' ) {
		$capability = 'publish_posts';
	}  else if ( $options['block_wp_backend_access'] == 'contributor' ) {
		$capability = 'edit_posts';
	} else {
		$capability = 'read';
	}

	// Determine if user has required capability for access
	if ( user_can( $user_id, $capability ) ) {
		return 'show';
	} else {
		return 'hide';
	}

}

// Get logged-in redirect URL
function wpwebapp_get_redirect_url_logged_in() {
	$options = wpwebapp_get_plugin_options_user_access();
	if ( $options['redirect_logged_in'] === '' ) {
		return site_url();
	} else {
		return $options['redirect_logged_in'];
	}
}

// Get logged-out redirect URL
function wpwebapp_get_redirect_url_logged_out() {
	$options = wpwebapp_get_plugin_options_user_access();
	if ( $options['redirect_logged_out'] === '' ) {
		return site_url();
	} else {
		return $options['redirect_logged_out'];
	}
}

// Get blog post access settings
function wpwebapp_get_blog_post_access() {
	$options = wpwebapp_get_plugin_options_user_access();
	return $options['blog_posts_require_login'];
}

?>