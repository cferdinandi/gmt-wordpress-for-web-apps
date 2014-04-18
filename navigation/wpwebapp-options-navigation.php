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
function wpwebapp_plugin_options_render_page_navigation() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Navigation', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'You may want to show different navigation elements to users who are logged in versus those who are not.', 'wpwebapp' ) ?></p>

		<p><?php _e( 'WordPress for Web Apps creates <code>* - Logged Out</code> versions of any navigation menus that are registered in your theme. Just use the drag-and-drop menu tool in the admin dashboard, and assign your navigation to the appropriate menu.', 'wpwebapp' ) ?></p>

		<p><img title="Screenshot of the menu interface in the admin dashboard" src="<?php echo plugins_url( '../screenshots/navigation-menu.png' , __FILE__ ); ?>"></p>

		<p><?php _e( 'Menus without the <code>- Logged Out</code> suffix are only shown to logged-in users. If you don\'t assign logged-out menus, they show all pages by default.', 'wpwebapp' ) ?></p>

	</div>
	<?php
}

// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_navigation() {
	add_submenu_page( 'wpwa_options', __( 'Navigation', 'wpwebapp' ), __( 'Navigation', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_navigation', 'wpwebapp_plugin_options_render_page_navigation' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_navigation' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_navigation( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_navigation', 'wpwebapp_option_page_capability_navigation' );

?>