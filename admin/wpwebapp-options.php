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

		<?php _e( '<p>Some words and instructions here.</p>', 'wpwebapp' ) ?>

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