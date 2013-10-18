<?php

/* ======================================================================

    WordPress for Web Apps Option Defaults
    Get and process default settings from the options page.

 * ====================================================================== */


/* ======================================================================
    SECURITY SETTINGS
    Set defaults and get security settings from options page.
 * ====================================================================== */

// Get minimum password length
function wpwebapp_get_minimum_pw_length() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['minimum_password_length'] == '' ) {
        $setting = '8';
    } else {
        $setting = $options['minimum_password_length'];
    }
    return $setting;
}

// Get password requirement for letters
function wpwebapp_get_pw_requirement_letters() {
    $options = wpwebapp_get_plugin_options();
    $setting = $options['password_requirements_letters'];
    return $setting;
}

// Get password requirement for numbers
function wpwebapp_get_pw_requirement_numbers() {
    $options = wpwebapp_get_plugin_options();
    $setting = $options['password_requirements_numbers'];
    return $setting;
}

// Get password requirement for special characters
function wpwebapp_get_pw_requirement_special_chars() {
    $options = wpwebapp_get_plugin_options();
    $setting = $options['password_requirements_special_chars'];
    return $setting;
}

// Get role restrictions for password resets
function wpwebapp_get_pw_reset_restriction() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['restrict_pw_reset'] == 'subscriber' ) {
        $setting = 'edit_posts';
    } else if ( $options['restrict_pw_reset'] == 'contributor' ) {
        $setting = 'publish_posts';
    } else if ( $options['restrict_pw_reset'] == 'author' ) {
        $setting = 'edit_pages';
    } else if ( $options['restrict_pw_reset'] == 'editor' ) {
        $setting = 'edit_themes';
    } else {
        $setting = '';
    }
    return $setting;
}

// Get number of hours a password reset URL is valid for
function wpwebapp_get_pw_reset_time_valid() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['pw_reset_time_valid'] == '' ) {
        $setting = '24';
    } else {
        $setting = $options['pw_reset_time_valid'];
    }
    return $setting;
}





/* ======================================================================
    USER ACCESS SETTINGS
    Set defaults and get user access settings from options page.
 * ====================================================================== */

// Get role restrictions for WordPress backend access
function wpwebapp_get_block_admin_access() {

    // Get user info and plugin settings
    global $current_user;
    get_currentuserinfo();
    $user_id = $current_user->ID;
    $options = wpwebapp_get_plugin_options();

    // Determine minimum required capability for backend access
    if ( $options['block_wp_backend_access'] == 'admin' ) {
        $capability = 'edit_themes';
    } else if ( $options['block_wp_backend_access'] == 'editor' ) {
        $capability = 'edit_pages';
    } else if ( $options['block_wp_backend_access'] == 'author' ) {
        $capability = 'publish_posts';
    }  else if ( $options['block_wp_backend_access'] == 'contributor' ) {
        $capability = 'edit_posts';
    } else {
        $capability = 'read';
    }

    // Determine if user has required capability for access
    if ( user_can( $user_id, $capability ) ) {
        $setting = 'show';
    } else {
        $setting = 'hide';
    }

    return $setting;
}

// Get logged-in redirect URL
function wpwebapp_get_redirect_url_logged_in() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['redirect_logged_in'] == '' ) {
        $setting = site_url();
    } else {
        $setting = $options['redirect_logged_in'];
    }
    return $setting;
}

// Get logged-out redirect URL
function wpwebapp_get_redirect_url_logged_out() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['redirect_logged_out'] == '' ) {
        $setting = site_url();
    } else {
        $setting = $options['redirect_logged_out'];
    }
    return $setting;
}

// Get blog post access settings
function wpwebapp_get_blog_post_access() {
    $options = wpwebapp_get_plugin_options();
    $setting = $options['blog_posts_require_login'];
    return $setting;
}





/* ======================================================================
    FORM SETTINGS
    Set defaults and get form settings from options page.
 * ====================================================================== */

// Get class for form submit buttons
function wpwebapp_get_form_button_class() {
    $options = wpwebapp_get_plugin_options();
    $setting = $options['button_class'];
    return $setting;
}

// Get text for login submit button
function wpwebapp_get_form_login_text() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['button_text_login'] == '' ) {
        $setting = __( 'Login', 'wpwebapp' );
    } else {
        $setting = $options['button_text_login'];
    }
    return $setting;
}

// Get text for signup submit button
function wpwebapp_get_form_signup_text() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['button_text_signup'] == '' ) {
        $setting = __( 'Signup', 'wpwebapp' );
    } else {
        $setting = $options['button_text_signup'];
    }
    return $setting;
}

// Get text for password change submit button
function wpwebapp_get_pw_change_text() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['button_text_pw_change'] == '' ) {
        $setting = __( 'Change Password', 'wpwebapp' );
    } else {
        $setting = $options['button_text_pw_change'];
    }
    return $setting;
}

// Get text for forgot password submit button
function wpwebapp_get_pw_forgot_text() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['button_text_pw_forgot'] == '' ) {
        $setting = __( 'Reset Password', 'wpwebapp' );
    } else {
        $setting = $options['button_text_pw_forgot'];
    }
    return $setting;
}

// Get text for password reset submit button
function wpwebapp_get_pw_reset_text() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['button_text_pw_reset'] == '' ) {
        $setting = __( 'Set New Password', 'wpwebapp' );
    } else {
        $setting = $options['button_text_pw_reset'];
    }
    return $setting;
}

// Get URL of forgot password form
function wpwebapp_get_pw_forgot_url() {
    $options = wpwebapp_get_plugin_options();
    $setting = $options['forgot_pw_url'];
    return $setting;
}

// Get text for forgot password link on login form
function wpwebapp_get_pw_forgot_url_text() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['forgot_pw_url_text'] == '' ) {
        $setting = __( 'forgot password', 'wpwebapp' );
    } else {
        $setting = $options['forgot_pw_url_text'];
    }
    return $setting;
}

// Get text for password requirements description
function wpwebapp_get_pw_requirements_text() {
    $options = wpwebapp_get_plugin_options();
    $pw_min_length = wpwebapp_get_minimum_pw_length();
    $requires_letters = wpwebapp_get_pw_requirement_letters();
    $requires_numbers = wpwebapp_get_pw_requirement_numbers();
    $requires_special_chars = wpwebapp_get_pw_requirement_special_chars();

    if ( $options['pw_requirement_text'] == '' ) {
        if ( $requires_letters == 'on' && $requires_numbers == 'on' && $requires_special_chars == 'on' ) {
                $setting = '<div>' . sprintf( __( 'Use at least one letter, one number, one special character, and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
            } else if ( $requires_letters == 'on' && $requires_numbers == 'on' ) {
                $setting = '<div>' . sprintf( __( 'Use at least one letter, one number, and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
            } else if ( $requires_letters == 'on' && $requires_special_chars == 'on' ) {
                $setting = '<div>' . sprintf( __( 'Use at least one letter, one special character, and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
            } else if ( $requires_numbers == 'on' && $requires_special_chars == 'on' ) {
                $setting = '<div>' . sprintf( __( 'Use at least one number, one special character, and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
            } else if ( $requires_letters == 'on' ) {
                $setting = '<div>' . sprintf( __( 'Use at least one letter and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
            } else if ( $requires_numbers == 'on' ) {
                $setting = '<div>' . sprintf( __( 'Use at least one number and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
            } else if ( $requires_special_chars == 'on' ) {
                $setting = '<div>' . sprintf( __( 'Use at least one special character and %d characters', 'kraken' ), $pw_min_length ) . '</div>';
            } else if ( $pw_min_length > 1 ) {
                $setting = '<div>' . sprintf( __( 'Use at least %d characters', 'kraken' ), $pw_min_length ) . '</div>';
            } else {
                $setting = '';
            }
    } else {
        $setting = $options['pw_requirement_text'];
        $scrubber = array( '%n' => $pw_min_length );
        $setting = strtr( $setting, $scrubber );
    }

    return $setting;
}





/* ======================================================================
    ALERT SETTINGS
    Set defaults and get alert settings from options page.
 * ====================================================================== */

// Get alert for empty form fields
function wpwebapp_get_alert_empty_fields() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_empty_fields'] == '' ) {
        $setting = '<p>' . __( 'Please complete all fields.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_empty_fields'];
    }
    return $setting;
}

// Get alert for not meeting password requirements
function wpwebapp_get_alert_pw_requirements() {
    $options = wpwebapp_get_plugin_options();
    $pw_min_length = wpwebapp_get_minimum_pw_length();
    $requires_letters = wpwebapp_get_pw_requirement_letters();
    $requires_numbers = wpwebapp_get_pw_requirement_numbers();
    $requires_special_chars = wpwebapp_get_pw_requirement_special_chars();

    if ( $options['alert_pw_requirements'] == '' ) {
        if ( $requires_letters == 'on' && $requires_numbers == 'on' && $requires_special_chars == 'on' ) {
            $setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one letter, one number, one special character, and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
        } else if ( $requires_letters == 'on' && $requires_numbers == 'on' ) {
            $setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one letter, one number, and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
        } else if ( $requires_letters == 'on' && $requires_special_chars == 'on' ) {
            $setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one letter, one special character, and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
        } else if ( $requires_numbers == 'on' && $requires_special_chars == 'on' ) {
            $setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one number, one special character, and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
        } else if ( $requires_letters == 'on' ) {
            $setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one letter and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
        } else if ( $requires_numbers == 'on' ) {
            $setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one number and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
        } else if ( $requires_special_chars == 'on' ) {
            $setting = '<p>' . sprintf( __( 'Please choose a password that contains at least one special character and %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
        } else if ( $pw_min_length > 1 ) {
            $setting = '<p>' . sprintf( __( 'Please choose a password that contains at least %d characters', 'wpwebapp' ), $pw_min_length ) . '</p>';
        } else {
            $setting = '';
        }
    } else {
        $setting = $options['alert_pw_requirements'];
        $scrubber = array( '%n' => $pw_min_length );
        $setting = strtr( $setting, $scrubber );
    }

    return $setting;
}

// Get alert for when new and confirmation password don't match
function wpwebapp_get_alert_pw_match() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_pw_no_match'] == '' ) {
        $setting = '<p>' . __( 'The new passwords your entered didn\'t match.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_pw_no_match'];
    }
    return $setting;
}

// Get alert for incorrect login credentials
function wpwebapp_get_alert_login_incorrect() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_incorrect_login'] == '' ) {
        $setting = '<p>' . __( 'Incorrect username or password.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_incorrect_login'];
    }
    return $setting;
}

// Get alert for invalid username at signup
function wpwebapp_get_alert_username_invalid() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_username_invalid'] == '' ) {
        $setting = '<p>' . __( 'Usernames can only contain letters, numbers, and these special characters: _, space, ., -, *, and @.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_username_taken'];
    }
    return $setting;
}

// Get alert for existing username at signup
function wpwebapp_get_alert_username_taken() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_username_taken'] == '' ) {
        $setting = '<p>' . __( 'Username already exists.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_username_taken'];
    }
    return $setting;
}

// Get when content of email field isn't a valid email address
function wpwebapp_get_alert_email_invalid() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_email_invalid'] == '' ) {
        $setting = '<p>' . __( 'Please use a valid email address.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_email_invalid'];
    }
    return $setting;
}

// Get alert for when email address already exists
function wpwebapp_get_alert_email_taken() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_email_taken'] == '' ) {
        $setting = '<p>' . __( 'An account with this email address already exists.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_email_taken'];
    }
    return $setting;
}

// Get alert for when current password is incorrect
function wpwebapp_get_alert_pw_incorrect() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_pw_incorrect'] == '' ) {
        $setting = '<p>' . __( 'The password you entered does not match your current password.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_pw_incorrect'];
    }
    return $setting;
}

// Get alert for when password successfully changed
function wpwebapp_get_alert_pw_change_success() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_pw_change_success'] == '' ) {
        $setting = '<p>' . __( 'Your password has been updated.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_pw_change_success'];
    }
    return $setting;
}

// Get alert for when username or email is not an existing user
function wpwebapp_get_alert_login_does_not_exist() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_login_does_not_exist'] == '' ) {
        $setting = '<p>' . __( 'Username or email doesn\'t exist.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_login_does_not_exist'];
    }
    return $setting;
}

// Get alert for when password resets are not allowed for this user
function wpwebapp_get_alert_pw_reset_not_allowed() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_pw_reset_not_allowed'] == '' ) {
        $setting = '<p>' . __( 'Password resets are not allowed for this user.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_pw_reset_not_allowed'];
    }
    return $setting;
}

// Get alert for when the password reset email is successfully sent
function wpwebapp_get_alert_pw_reset_email_sent() {
    $options = wpwebapp_get_plugin_options();
    $reset_length = wpwebapp_get_pw_reset_time_valid();
    if ( $options['alert_pw_reset_email_sent'] == '' ) {
        $setting = '<p>' . sprintf( __( 'We\'ve sent you an email with a temporary link that will allow you to reset your password for the next %d hours. Please check your spam folder if the email doesn’t appear within a few minutes.', 'wpwebapp' ), $reset_length ) . '</p>';
    } else {
        $setting = $options['alert_pw_reset_email_sent'];
        $scrubber = array( '%t' => $pw_min_length );
        $setting = strtr( $setting, $scrubber );
    }
    return $setting;
}

// Get alert for when the password reset email fails to send
function wpwebapp_get_alert_pw_reset_email_failed() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_pw_reset_email_failed'] == '' ) {
        $setting = '<p>' . __( 'Oops, something went wrong on our end. Please try again.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_pw_reset_email_failed'];
    }
    return $setting;
}

// Get alert for when the password reset URL has expired
function wpwebapp_get_alert_pw_reset_url_expired() {
    $options = wpwebapp_get_plugin_options();
    if ( $options['alert_pw_reset_url_invalid'] == '' ) {
        $setting = '<p>' . __( 'This password reset request is no longer valid.', 'wpwebapp' ) . '</p>';
    } else {
        $setting = $options['alert_pw_reset_url_invalid'];
    }
    return $setting;
}





/* ======================================================================
    EMAIL SETTINGS
    Set defaults and get email settings from options page.
 * ====================================================================== */

// Get setting for disabling the default new user email (yes/no)
function wpwebapp_get_email_disable_new_user() {
    $options = wpwebapp_get_plugin_options();
    $setting = $options['email_disable_new_user_default'];
    return $setting;
}

// Get setting for disabling password change notification emails (yes/no)
function wpwebapp_get_email_disable_password_change() {
    $options = wpwebapp_get_plugin_options();
    $setting = $options['email_disable_pw_reset'];
    return $setting;
}

?>