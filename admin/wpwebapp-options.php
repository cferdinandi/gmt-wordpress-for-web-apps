<?php

/* ======================================================================

	Create Plugin Options Menu

 * ====================================================================== */


// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_main_page() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'WordPress for Web Apps', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<?php _e(
			'<p>WordPress for Web Apps provides the essential components you need to power your web app with WordPress. <a target="_blank" href="https://github.com/cferdinandi/web-app-starter-kit">Learn more.</a></p>' .
			'<p><strong>Documentation and Settings</strong></p>' .
			'<ul>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_security">Security</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_user_access">User Access</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_navigation">Navigation</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_alerts">Alerts</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_forms_login">Login Form</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_forms_signup">Signup Form</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_forms_pw_reset">Reset Password Form</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_forms_user_profile">User Profile Form</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_forms_pw_change">Change Password Form</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_forms_email_change">Change Email Form</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_forms_delete_account">Delete Account Button</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_logout_links">Logout Links</a></li>' .
				'<li><a href="admin.php?page=wpwebapp_plugin_options_usernames">Usernames</a></li>' .
			'</ul>',
		'wpwebapp' ) ?>

	</div>
	<?php
}



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_main_page() {
	$theme_page = add_menu_page( __( 'WP Web Apps', 'wpwebapp' ), __( 'WP Web Apps', 'wpwebapp' ), 'edit_theme_options', 'wpwa_options', 'wpwebapp_plugin_options_render_main_page' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_main_page' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options', 'wpwebapp_option_page_capability' );

?>