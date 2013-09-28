<?php

/* ======================================================================

    WordPress for Web App User Navigation
    Functions to customize the navigation menu.

    Dynamic navigation menus forked from Cozmos Labs.
    http://www.cozmoslabs.com/11911-wordpress-plugin-for-dynamic-menus-based-on-logged-in-status/

    Navigation menu shortcodes forked from Nick Ciske.
    https://gist.github.com/nciske/5681384

 * ====================================================================== */


/* ======================================================================
    DYNAMIC NAVIGATION MENUS
    Display different navigation menus for logged-in and logged-out users.
 * ====================================================================== */

// Clone existing navigation menus and create logged out versions
function wpwebapp_register_loggedout_menus() {
    $default_menus = get_registered_nav_menus();
    $loggedin_menus = array();

    foreach ( $default_menus as $slug => $name ) {
        $loggedin_menus[$slug . '_wpwebapp_logged-out'] = $name . ' - Logged Out';
    }

    register_nav_menus( $loggedin_menus );
}
add_action( 'init', 'wpwebapp_register_loggedout_menus' );


// Dynamically serve the menu based on whether or not the user is logged in
function wpwebapp_serve_dynamic_menus( $content ) {

    $loggedin_theme_location = $content['theme_location'] . '_wpwebapp_logged-out';
    $active_menu_locations = get_nav_menu_locations();

    if ( is_user_logged_in() && !empty($content['theme_location']) && $active_menu_locations[$loggedin_theme_location] != 0 && array_key_exists($loggedin_theme_location, $active_menu_locations) ) {
        return $content;
    } else {
        $content['theme_location'] = $content['theme_location'] . '_wpwebapp_logged-out';
        return $content;
    }
}
add_filter('wp_nav_menu_args', 'wpwebapp_serve_dynamic_menus');





/* ======================================================================
    LOGOUT LINK
    Create a shortcode for the WordPress logout link.
 * ====================================================================== */

// Logout Link Shortcode
function wpwebapp_get_logout_url() {
    $front_page = esc_url_raw( wpwebapp_get_redirect_url_logged_out() );
    $logout = wp_logout_url( $front_page );
    return $logout;
}
add_shortcode( 'wpwebapp_logout_url', 'wpwebapp_get_logout_url' );


// Logout Link Navigation Menu
// Let's you use the logout shortcode with `wp_nav_menu()`
function wpwebapp_menu_logout_url( $menu ){
	return str_replace( 'wpwebapp_logout_url', preg_replace( '~^(?:f|ht)tps?://~i', '', wp_logout_url( home_url() ) ), do_shortcode( $menu ) );
}
add_filter('wp_nav_menu', 'wpwebapp_menu_logout_url');





/* ======================================================================
    DISPLAY USERNAME
    Create a shortcode to display a user's username.
 * ====================================================================== */

// Username Shortcode
function wpwebapp_display_username() {
    $current_user = wp_get_current_user();
    $username = $current_user->user_login;
    return $username;
}
add_shortcode( 'wpwebapp_display_username', 'wpwebapp_display_username' );


// Username Navigation Menu
// Let's you use the username shortcode with `wp_nav_menu()`
function wpwebapp_menu_display_username( $menu ){
	$username = wpwebapp_display_username();
	return str_replace( '[wpwebapp_display_username]', $username, do_shortcode( $menu ) );
}
add_filter('wp_nav_menu', 'wpwebapp_menu_display_username');


?>