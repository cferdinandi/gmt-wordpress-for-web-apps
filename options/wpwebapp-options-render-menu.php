<?php

/* ======================================================================

    WordPress for Web App Options
    Adjust plugin settings from the admin dashboard.

    Forked from code by Michael Fields.
    https://gist.github.com/mfields/4678999

 * ====================================================================== */


// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page() {
    ?>
    <div class="wrap">
        <?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
        <h2><?php _e( 'WordPress for Web App Options', 'wpwebapp' ); ?></h2>
        <?php settings_errors(); ?>

        <?php _e( '<p>All fields are optional except for "Forgot Password URL" under the "Buttons &amp; Links" section.</p>', 'wpwebapp' ) ?>

        <form method="post" action="options.php">
            <?php
                settings_fields( 'wpwebapp_options' );
                do_settings_sections( 'plugin_options' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init() {

    // Register a setting and its sanitization callback
    register_setting( 'wpwebapp_options', 'wpwebapp_plugin_options', 'wpwebapp_plugin_options_validate' );


    // Security
    add_settings_section( 'security', __( 'Security', 'wpwebapp' ),  '__return_false', 'plugin_options' );
    add_settings_field( 'minimum_password_length', __( 'Minimum Password Length', 'wpwebapp' ) . '<div class="description">' . __( 'Must be a whole number', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_minimum_password_length', 'plugin_options', 'security' );
    add_settings_field( 'password_requirements_letters', __( 'Password Requirements', 'wpwebapp' ) . '<div class="description">' . __( 'Required password characters', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_password_requirements', 'plugin_options', 'security' );
    add_settings_field( 'restrict_pw_reset', __( 'Restrict Password Reset', 'wpwebapp' ) . '<div class="description">' . __( 'Highest role that can use the password reset form (lower is more secure)', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_restrict_pw_reset', 'plugin_options', 'security' );
    add_settings_field( 'pw_reset_time_valid', __( 'Password Reset Time', 'wpwebapp' ) . '<div class="description">' . __( 'Number of hours password reset URL is valid for (must be a whole number)', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_pw_reset_time_valid', 'plugin_options', 'security' );


    // User Access
    add_settings_section( 'access', __( 'User Access', 'wpwebapp' ),  '__return_false', 'plugin_options' );
    add_settings_field( 'block_wp_backend_access', __( 'Block Backend Access', 'wpwebapp' ) . '<div class="description">' . __( 'Minimum role that can access the WordPress backend and see the admin bar (higher is more secure)', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_block_wp_backend_access', 'plugin_options', 'access' );
    add_settings_field( 'redirect_logged_out', __( 'Logged-Out Redirect', 'wpwebapp' ) . '<div class="description">' . __( 'Where to redirect logged-our users', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_redirect_logged_out', 'plugin_options', 'access' );
    add_settings_field( 'redirect_logged_in', __( 'Logged-In Redirect', 'wpwebapp' ) . '<div class="description">' . __( 'Where to redirect logged-in users', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_redirect_logged_in', 'plugin_options', 'access' );
    add_settings_field( 'blog_posts_require_login', __( 'Blog Post Access', 'wpwebapp' ), 'wpwebapp_settings_field_blog_posts_require_login', 'plugin_options', 'access' );


    // Forms
    add_settings_section( 'forms', __( 'Forms', 'wpwebapp' ),  '__return_false', 'plugin_options' );
    add_settings_field( 'button_class', __( 'Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to form submit buttons.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_class', 'plugin_options', 'forms' );
    add_settings_field( 'delete_button_class', __( 'Delete Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to the "delete account" button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_delete_button_class', 'plugin_options', 'forms' );
    add_settings_field( 'button_text_login', __( 'Login Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the login button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_login', 'plugin_options', 'forms' );
    add_settings_field( 'button_text_signup', __( 'Signup Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the signup button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_signup', 'plugin_options', 'forms' );
    add_settings_field( 'button_text_pw_change', __( 'Change Password Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the change password button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_pw_change', 'plugin_options', 'forms' );
    add_settings_field( 'button_text_pw_forgot', __( 'Forgot Password Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the button to send a password reset email.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_pw_forgot', 'plugin_options', 'forms' );
    add_settings_field( 'button_text_pw_reset', __( 'Password Reset Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the button to change a password after a reset.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_pw_reset', 'plugin_options', 'forms' );
    add_settings_field( 'forgot_pw_url', __( 'Forgot Password URL', 'wpwebapp' ) . '<div class="description">' . __( 'A link to the "forgot password" page.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_forgot_pw_url', 'plugin_options', 'forms' );
    add_settings_field( 'forgot_pw_url_text', __( 'Forgot Password URL Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the "forgot password" URL (only shown if URL is set).', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_forgot_pw_url_text', 'plugin_options', 'forms' );
    add_settings_field( 'pw_requirement_text', __( 'Password Requirement Text', 'wpwebapp' ) . '<div class="description">' . __( 'Signup, Password Change, and Password Reset Forms', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_pw_requirement_text', 'plugin_options', 'forms' );
    add_settings_field( 'delete_account_text', __( 'Delete Account Text', 'wpwebapp' ) . '<div class="description">' . __( 'Delete Account Form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_delete_account_text', 'plugin_options', 'forms' );
    add_settings_field( 'delete_account_url', __( 'Delete Account Redirect URL', 'wpwebapp' ) . '<div class="description">' . __( 'Delete Account Form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_delete_account_url', 'plugin_options', 'forms' );


    // Alerts
    add_settings_section( 'alerts', __( 'Alerts', 'wpwebapp' ),  '__return_false', 'plugin_options' );
    add_settings_field( 'alert_empty_fields', __( 'Empty Fields', 'wpwebapp' ) . '<div class="description">' . __( 'Signup, Password Change, and Password Reset Forms', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_empty_fields', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_requirements', __( 'Password Requirements', 'wpwebapp' ) . '<div class="description">' . __( 'Signup, Password Change and Password Reset forms', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_requirements', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_no_match', __( 'Passwords Don\'t Match', 'wpwebapp' ) . '<div class="description">' . __( 'Password Change and Password Reset forms', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_no_match', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_incorrect_login', __( 'Incorrect Login', 'wpwebapp' ) . '<div class="description">' . __( 'Login and Forgot Password forms', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_incorrect_login', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_username_invalid', __( 'Username Taken', 'wpwebapp' ) . '<div class="description">' . __( 'Signup form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_username_invalid', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_username_taken', __( 'Username Taken', 'wpwebapp' ) . '<div class="description">' . __( 'Signup form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_username_taken', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_email_invalid', __( 'Invalid Email', 'wpwebapp' ) . '<div class="description">' . __( 'Signup form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_email_invalid', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_email_taken', __( 'Email Taken', 'wpwebapp' ) . '<div class="description">' . __( 'Signup form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_email_taken', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_incorrect', __( 'Incorrect Password', 'wpwebapp' ) . '<div class="description">' . __( 'Password change form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_incorrect', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_change_success', __( 'Password Change Success', 'wpwebapp' ) . '<div class="description">' . __( 'Password Change form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_change_success', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_login_does_not_exist', __( 'Login Doesn\'t Exist', 'wpwebapp' ) . '<div class="description">' . __( 'Forgot Password form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_login_does_not_exist', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_reset_not_allowed', __( 'Password Reset Not Allowed', 'wpwebapp' ) . '<div class="description">' . __( 'Forgot Password form (no resets for admins)', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_reset_not_allowed', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_reset_email_sent', __( 'Password Reset Email Sent', 'wpwebapp' ) . '<div class="description">' . __( 'Forgot Password form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_reset_email_sent', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_reset_email_failed', __( 'Password Reset Email Failed', 'wpwebapp' ) . '<div class="description">' . __( 'Forgot Password form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_reset_email_failed', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_reset_url_invalid', __( 'Password Reset URL Expired', 'wpwebapp' ) . '<div class="description">' . __( 'Password Reset form', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_alert_pw_reset_url_invalid', 'plugin_options', 'alerts' );


    // Emails
    add_settings_section( 'emails', __( 'Emails', 'wpwebapp' ),  '__return_false', 'plugin_options' );
    add_settings_field( 'email_disable_new_user_default', __( 'New User Default', 'wpwebapp' ), 'wpwebapp_settings_field_email_disable_new_user_default', 'plugin_options', 'emails' );
    add_settings_field( 'email_disable_pw_reset', __( 'Password Change', 'wpwebapp' ), 'wpwebapp_settings_field_email_disable_pw_reset', 'plugin_options', 'emails' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page() {
    $theme_page = add_menu_page( __( 'Web App Options', 'wpwebapp' ), __( 'Web App Options', 'wpwebapp' ), 'edit_theme_options', 'plugin_options', 'wpwebapp_plugin_options_render_page' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability( $capability ) {
    return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options', 'wpwebapp_option_page_capability' );

?>