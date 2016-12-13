<?php

/**
 * Navigation menu and link shortcodes
 */


	// Create logout link shortcode
	function wpwebapp_get_logout_url() {
		$options = wpwebapp_get_theme_options();
		$redirect = wpwebapp_get_redirect_url( $options['logout_redirect'] );
		return wp_logout_url( $redirect );
	}
	add_shortcode( 'wpwa_logout', 'wpwebapp_get_logout_url' );

	// Use the logout shortcode with `wp_nav_menu()`
	function wpwebapp_menu_logout_url( $menu ) {
		$logout = wpwebapp_get_logout_url();
		return str_replace( '[wpwa_logout]', preg_replace( '~^(?:f|ht)tps?://~i', '', $logout ), $menu );

	}
	add_filter( 'wp_nav_menu', 'wpwebapp_menu_logout_url' );

	// Create username shortcode
	function wpwebapp_get_username() {
		$current_user = wp_get_current_user();
		return $current_user->user_login;
	}
	add_shortcode( 'wpwa_username', 'wpwebapp_get_username' );


	// Use the username shortcode with `wp_nav_menu()`
	function wpwebapp_menu_username( $menu ) {
		$username = wpwebapp_get_username();
		return str_replace( '[wpwa_username]', $username, $menu );
	}
	add_filter('wp_nav_menu', 'wpwebapp_menu_username');


	// Create referrer URL shortcode
	function wpwebapp_get_referrer() {
		return 'referrer=' . esc_url_raw( wpwebapp_get_url() );
	}
	add_shortcode( 'wpwa_referrer', 'wpwebapp_get_referrer' );


	// Use the referrer shortcode with `wp_nav_menu()`
	function wpwebapp_menu_referrer( $menu ) {
		$referrer = wpwebapp_get_referrer();
		return str_replace( 'wpwa_referrer', $referrer, $menu );
	}
	add_filter('wp_nav_menu', 'wpwebapp_menu_referrer');