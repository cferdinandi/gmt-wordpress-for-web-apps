<?php

/* ======================================================================

    WordPress for Web App Security
    Functions to manage and process security settings.

 * ====================================================================== */


/* ======================================================================
    TEST PASSWORD REQUIREMENTS
    Compare user password against requirements.
    Returns true/false.
 * ====================================================================== */

function wpwebapp_password_meets_requirements( $password ) {

    // Get User Settings
    $pw_min_length = wpwebapp_get_minimum_pw_length();
    $requires_letters = wpwebapp_get_pw_requirement_letters();
    $requires_numbers = wpwebapp_get_pw_requirement_numbers();
    $requires_special_chars = wpwebapp_get_pw_requirement_special_chars();

    // Test the password
    if ( strlen( $password ) < $pw_min_length ) {
        return false;
    } else if ( $requires_letters == 'on' && !wpwebapp_has_letters( $password ) ) {
        return false;
    } else if ( $requires_numbers == 'on' && !wpwebapp_has_numbers( $password ) ) {
        return false;
    } else if ( $requires_special_chars == 'on' && !wpwebapp_has_special_chars( $password ) ) {
        return false;
    } else {
        return true;
    }

}


/* ======================================================================
    BLOCK BACK-END ACCESS
    Prevent non-admin users from accessing WordPress backend.
 * ====================================================================== */

// Redirect unauthorized users away from wp-admin
function wpwebapp_block_backend() {
    $block_backend = wpwebapp_get_block_admin_access();
    if ( is_user_logged_in() ) {
        $front_page = esc_url_raw( wpwebapp_get_redirect_url_logged_in() );
    } else {
        $front_page = esc_url_raw( wpwebapp_get_redirect_url_logged_out() );
    }

    if ( is_admin() && $block_backend == 'hide' ) {
        wp_safe_redirect( $front_page );
        exit;
    }
}
add_action( 'init', 'wpwebapp_block_backend' );


// Redirect users away from wp-login.php after logout
function wpwebapp_logout_redirect() {
    $redirect_url = esc_url_raw( wpwebapp_get_redirect_url_logged_out() );
    wp_redirect( $redirect_url );
    exit();
}
add_action( 'wp_logout', 'wpwebapp_logout_redirect' );





/* ======================================================================
    DISABLE ADMIN BAR
    Disable WordPress admin bar for all users.
 * ====================================================================== */

function wpwebapp_disable_admin_bar() {
    $disable_admin_bar = wpwebapp_get_block_admin_access();
    if ( $disable_admin_bar == 'hide' ) {
        show_admin_bar( false );
    }
}
add_filter( 'init' , 'wpwebapp_disable_admin_bar');

?>