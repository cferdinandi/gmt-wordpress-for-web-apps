<?php

/* ======================================================================

    Logout Link Shortcode v1.0
    A PHP script and shortcode for the WordPress logout link.

    Add a logout link in the WordPress content editor with the [logout_link] shortcode.
    
 * ====================================================================== */

// LOGOUT SHORTCODE

function wpwebapp_logout() {

    $logout = wp_logout_url( home_url() );

	// Display the form
	return $logout;
}
add_shortcode( 'logout_link', 'wpwebapp_logout' );

?>
