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
function wpwebapp_plugin_options_render_page_logout_links() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Logout Links', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'WordPress provides a built-in logout link function:', 'wpwebapp' ) ?>: <code>&lt;?php echo wp_logout_url(); ?&gt;</code>. <?php _e( 'Simply add that as the href value to any link to log a user out and redirect them to the homepage.', 'wpwebapp' ) ?></p>

		<p><?php _e( 'You can\'t use PHP scripts in the WordPress content editor, though. If you\'d like to add a logout link that way, WordPress for Web Apps includes a shortcode you can use instead', 'wpwebapp' ) ?>: <code>[wpwa_logout_url]</code>.</p>

		<p><?php _e( 'While you normally can\'t use shortcodes to add navigation menu links, WordPress for Web Apps let you use the logout shortcode.', 'wpwebapp' ) ?></p>

		<p><img title="Screenshot of how to add a logout link to the navigation menu" src="<?php echo plugins_url( '../screenshots/logout-shortcode.png' , __FILE__ ); ?>"></p>

	</div>
	<?php
}

// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_logout_links() {
	add_submenu_page( 'wpwa_options', __( 'Logout Links', 'wpwebapp' ), __( 'Logout Links', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_logout_links', 'wpwebapp_plugin_options_render_page_logout_links' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_logout_links' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_logout_links( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_logout_links', 'wpwebapp_option_page_capability_logout_links' );

?>