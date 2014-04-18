<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_usernames() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Usernames', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'WordPress also provides a simple way to display a user\'s username in a theme template file', 'wpwebapp' ) ?>:</p>

		<p><code>&lt;?php $current_user = wp_get_current_user(); echo $current_user-&gt;user_login; ?&gt;</code></p>

		<p><?php _e( 'To display a username in the WordPress content editor, use the <code>[wpwa_display_username]</code> shortcode. Like the logout shortcode, you can use the display username shortcode in the navigation menu editor.', 'wpwebapp' ) ?></p>

		<p><img title="Screenshot of how to display a username in the navigation menu" src="<?php echo plugins_url( '../screenshots/username-shortcode.png' , __FILE__ ); ?>"></p>

	</div>
	<?php
}

// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_usernames() {
	add_submenu_page( 'wpwa_options', __( 'Usernames', 'wpwebapp' ), __( 'Usernames', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_usernames', 'wpwebapp_plugin_options_render_page_usernames' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_usernames' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_usernames( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_usernames', 'wpwebapp_option_page_capability_usernames' );

?>