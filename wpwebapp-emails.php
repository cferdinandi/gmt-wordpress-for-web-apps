<?php

/* ======================================================================

    WordPress for Web Apps Emails
    Functions to create custom emails.

 * ====================================================================== */


/* ======================================================================
    DISABLE NEW USER EMAILS
    Prevent WordPress from sending out default new-user emails.
 * ====================================================================== */

if ( !function_exists( 'wp_new_user_notification' ) && wpwebapp_get_email_disable_new_user() == 'on' ) {
    function wp_new_user_notification() { }
}





/* ======================================================================
    DISABLE CHANGED PASSWORD EMAILS
    Prevent WordPress from notifying you when users change their passwords.
 * ====================================================================== */

if ( !function_exists( 'wp_password_change_notification' ) && wpwebapp_get_email_disable_password_change() == 'on' ) {
    function wp_password_change_notification() { }
}





/* ======================================================================
    PASSWORD RESET
    Sent to users when their password is successfully reset.
 * ====================================================================== */

function wpwebapp_email_pw_reset( $to, $user_login, $reset_url ) {

    $from = 'passwordreset'; // TODO: Get custom from name from options
    $site_name = get_bloginfo('name');
    $domain = wpwebapp_get_site_domain();
    $headers = 'From: ' . $site_name . ' <' . $from . '@' . $domain . '>' . "\r\n";
    $subject = 'Password reset for ' . $site_name;
    $message =
        'We received a request to reset the password for your ' . $site_name . ' account (' . $user_login . ').' . "\r\n\r\n" .
        'To reset your password, click on the link below (or copy and paste the URL into your browser): ' . $reset_url . "\r\n\r\n" .
        'If this was a mistake, just ignore this email.'  . "\r\n";

    return wp_mail( $to, $subject, $message, $headers );

}

?>