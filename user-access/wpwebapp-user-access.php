<?php

/* ======================================================================

	WordPress for Web App User Access
	Set and manage user access to pages.

	Forked from code by Voodoo Press.
	http://voodoopress.com/expanding-our-back-end-post-meta-boxes-with-dropdowns/

 * ====================================================================== */


/* ======================================================================
	CREATE USER ACCESS SETTING OPTIONS
	Creates a metabox for admin to define who can access content.
 * ====================================================================== */

// Create a metabox
function wpwebapp_user_access_settings() {
	add_meta_box('wpwebapp_user_access_settings', 'User Access', 'wpwebapp_user_access_fields', 'page', 'side', 'default');
}
add_action('add_meta_boxes', 'wpwebapp_user_access_settings');


// Add user access setting fields to metabox
function wpwebapp_user_access_fields() {
	global $post;
	$user_access_setting = get_post_meta( $post->ID, 'wpwebapp_user_access_setting', true );
	if ( !$user_access_setting || $user_access_setting == '' ) {
		$user_access_setting = 'all';
	}
	?>
	<?php wp_nonce_field( 'wpwebapp-user-access-fields-nonce', 'wpwebapp-user-access-fields' ); ?>
	<input type="radio" name="wpwebapp-user-access-setting" id="wpwebapp-user-access-all" value="all" <?php checked( 'all', $user_access_setting ); ?> >
	<label for="wpwebapp-user-access-all">
		<?php _e( 'All Users', 'wpwebapp' ); ?>
	</label>
	<br>
	<input type="radio" name="wpwebapp-user-access-setting" id="wpwebapp-user-access-loggedin" value="loggedin" <?php checked( 'loggedin', $user_access_setting ); ?> >
	<label for="wpwebapp-user-access-loggedin">
		<?php _e( 'Logged In Only', 'wpwebapp' ); ?>
	</label>
	<br>
	<input type="radio" name="wpwebapp-user-access-setting" id="wpwebapp-user-access-loggedout" value="loggedout" <?php checked( 'loggedout', $user_access_setting ); ?> >
	<label for="wpwebapp-user-access-loggedout">
		<?php _e( 'Logged Out Only', 'wpwebapp' ); ?>
	</label>

	<?php
}


// Save user access settings
function wpwebapp_save_user_access_settings( $post_id, $post ) {

	// Verify data came from edit screen and user has permission to edit post
	if ( isset( $_POST['wpwebapp-user-access-fields'] ) && wp_verify_nonce( $_POST['wpwebapp-user-access-fields'], 'wpwebapp-user-access-fields-nonce' ) && current_user_can( 'edit_post', $post->ID ) ) {

		// Save setting to the database
		$user_access_setting = $_POST['wpwebapp-user-access-setting'];
		update_post_meta( $post->ID, 'wpwebapp_user_access_setting', $user_access_setting );

	} else {
		return $post->ID;
	}

}
add_action('save_post', 'wpwebapp_save_user_access_settings', 1, 2);





/* ======================================================================
	PROCESS USER ACCESS SETTINGS
	Redirect users who don't match access requirements.
 * ====================================================================== */

// Page Access
function wpwebapp_process_user_access_page_settings() {

	// Variables
	global $post;
	$user_access_setting = get_post_meta( $post->ID, 'wpwebapp_user_access_setting', true );
	$redirect_logged_in = esc_url_raw( wpwebapp_get_redirect_url_logged_in() );
	$redirect_logged_out = esc_url_raw( wpwebapp_get_redirect_url_logged_out() );

	// If user doesn't meet required criteria, redirect them
	if ( $user_access_setting == 'loggedin' && !is_user_logged_in() ) {
		wp_safe_redirect( $redirect_logged_out, 302 );
		exit;
	} else if ( $user_access_setting == 'loggedout' && is_user_logged_in() && !is_admin() ) {
		wp_safe_redirect( $redirect_logged_in, 302 );
		exit;
	}

}
add_action('wp', 'wpwebapp_process_user_access_page_settings');


// Blog Post Access
function wpwebapp_process_user_access_post_settings() {

	// Variables
	global $post;
	$user_access_setting = wpwebapp_get_blog_post_access();
	$redirect_logged_out = esc_url_raw( wpwebapp_get_redirect_url_logged_out() );

	// If user doesn't meet required criteria, redirect them
	if ( $user_access_setting == 'on' && !is_user_logged_in() && ( is_home() || is_single() ) && $redirect_logged_out != ( is_home() || is_single() ) ) {
		wp_safe_redirect( $redirect_logged_out, 302 );
		exit;
	}

}
add_action('wp', 'wpwebapp_process_user_access_post_settings');

?>
