<?php

/* ======================================================================

    WordPress for Web Apps Forms
    Functions to create and process the plugin forms.

 * ====================================================================== */


/* ======================================================================
    FORM FIELDS
    Structure for the form fields.
 * ====================================================================== */

// Text Input
function wpwebapp_form_field_text_input( $type, $id, $label, $value, $tabindex = '', $autofocus = '' ) {
    $form_field =
        '<div>
            <label for="' . $id . '">' .
                $label .
            '</label>
            <input
                type="' . $type . '"
                id="' . $id . '"
                name="' . $id . '"
                value="' . $value . '"
                tabindex="' . $tabindex . '" ' .
                $autofocus .
            '>
        </div>';
    return $form_field;
}


// Checkbox
function wpwebapp_form_field_checkbox( $id, $label, $value, $tabindex, $checked = '' ) {
    $form_field =
        '<div>
            <label for="' . $id . '">' .
                '<input type="checkbox"
                    id="' . $id . '"
                    name="' . $id . '"
                    value="' . $value . '"
                    tabindex="' . $tabindex . '" ' .
                    $checked .
                '>' .
                $label .
            '</label>
        </div>';
    return $form_field;
}


// Submit
function wpwebapp_form_field_submit( $id, $class, $label, $action, $nonce_field, $tabindex ) {
    $form_field =
        '<div>' .
            wp_nonce_field( $action, $nonce_field) .
            '<button type="submit" class="' . $class . '" id="' . $id . '" name="' . $id . '" tabindex="' . $tabindex . '">' . $label . '</button>
        </div>';
    return $form_field;
}






/* ======================================================================
    CREATE & DISPLAY FORMS
    Create the forms and shortcodes.
 * ====================================================================== */

// Create & Display Login Form
function wpwebapp_form_login() {

    // Variables
    $alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_login' ) );
    $username = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username' ) );
    $forgot_pw_url = esc_url_raw( wpwebapp_get_pw_forgot_url() );
    $forgot_pw_text = stripslashes( wpwebapp_get_pw_forgot_url_text() );
    $submit_text = stripslashes( wpwebapp_get_form_login_text() );
    $submit_class = esc_attr( wpwebapp_get_form_button_class() );

    if ( $forgot_pw_url == '' ) {
        $forgot_pw = '';
    } else {
        $forgot_pw = '<a href="' . $forgot_pw_url . '">' . $forgot_pw_text . '</a>';
    }

    $form =
        $alert .
        '<form class="form-wpwebapp" id="wpwebapp-form-login" name="wpwebapp-form-login" action="" method="post">' .
            wpwebapp_form_field_text_input( 'text', 'wpwebapp-username', __( 'Username or Email', 'wpwebapp' ), $username, '1', 'autofocus' ) .
            wpwebapp_form_field_text_input( 'password', 'wpwebapp-password', __( 'Password ', 'wpwebapp' ) . $forgot_pw, '', '2' ) .
            wpwebapp_form_field_checkbox( 'wpwebapp-rememberme', __( 'Remember Me', 'wpwebapp' ), 'rememberme', '3', 'checked' ) .
            wpwebapp_form_field_submit( 'wpwebapp-login-submit', $submit_class, $submit_text, 'wpwebapp-login-process-nonce', 'wpwebapp-login-process', '4' ) .
        '</form>';

    return $form;

}
add_shortcode( 'wpwa_login_form', 'wpwebapp_form_login' );


// Create & Display Signup Form
function wpwebapp_form_signup() {

    // Variables
    $alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup' ) );
    $username = esc_attr( wpwebapp_get_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username' ) );
    $email = esc_attr( wpwebapp_get_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email' ) );
    $submit_text = stripslashes( wpwebapp_get_form_signup_text() );
    $submit_class = esc_attr( wpwebapp_get_form_button_class() );
    $pw_requirements = stripslashes( wpwebapp_get_pw_requirements_text() );

    $form =
        $alert .
        '<form class="form-wpwebapp" id="wpwebapp-form-signup" name="wpwebapp-form-signup" action="" method="post">' .
            wpwebapp_form_field_text_input( 'text', 'wpwebapp-signup-username', __( 'Username', 'wpwebapp' ), $username, '1', 'autofocus' ) .
            wpwebapp_form_field_text_input( 'email', 'wpwebapp-signup-email', __( 'Email', 'wpwebapp' ), $email, '2' ) .
            wpwebapp_form_field_text_input( 'password', 'wpwebapp-signup-password', __( 'Password' . $pw_requirements, 'wpwebapp' ), '', '3' ) .
            wpwebapp_form_field_submit( 'wpwebapp-signup-submit', $submit_class, $submit_text, 'wpwebapp-signup-process-nonce', 'wpwebapp-signup-process', '4' ) .
        '</form>';

    return $form;

}
add_shortcode( 'wpwa_signup_form', 'wpwebapp_form_signup' );


// Create & Display Change Password Form
function wpwebapp_form_pw_change() {

    // Variables
    $alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change' ) );
    $submit_text = stripslashes( wpwebapp_get_pw_change_text() );
    $submit_class = esc_attr( wpwebapp_get_form_button_class() );
    $pw_requirements = stripslashes( wpwebapp_get_pw_requirements_text() );

    $form =
        $alert .
        '<form class="form-wpwebapp" id="wpwebapp-form-pw-change" name="wpwebapp-form-pw-change" action="" method="post">' .
            wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw-current', __( 'Current Password', 'wpwebapp' ), '', '1', 'autofocus' ) .
            wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw-new-1', __( 'New Password' . $pw_requirements, 'wpwebapp' ), '', '2' ) .
            wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw-new-2', __( 'Confirm New Password', 'wpwebapp' ), '', '3' ) .
            wpwebapp_form_field_submit( 'wpwebapp-change-pw-submit', $submit_class, $submit_text, 'wpwebapp-change-pw-process-nonce', 'wpwebapp-change-pw-process', '4' ) .
        '</form>';

    return $form;

}
add_shortcode( 'wpwa_pw_change_form', 'wpwebapp_form_pw_change' );


// Create Forgot Password Form
// Displayed in `wpwebapp_form_pw_forgot_reset()`
function wpwebapp_form_pw_forgot() {

    // Variables
    $alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot' ) );
    $submit_text = stripslashes( wpwebapp_get_pw_forgot_text() );
    $submit_class = esc_attr( wpwebapp_get_form_button_class() );

    $form =
        $alert .
        '<form class="form-wpwebapp" id="wpwebapp-form-pw-forgot" name="wpwebapp-form-pw-forgot" action="" method="post">' .
            wpwebapp_form_field_text_input( 'text', 'wpwebapp-username-email', __( 'Username or Email', 'wpwebapp' ), '', '1', 'autofocus' ) .
            wpwebapp_form_field_submit( 'wpwebapp-forgot-pw-submit', $submit_class, $submit_text, 'wpwebapp-forgot-pw-process-nonce', 'wpwebapp-forgot-pw-process', '2' ) .
        '</form>';

    return $form;

}


// Create Reset Password Form
// Displayed in `wpwebapp_form_pw_forgot_reset()`
function wpwebapp_form_pw_reset() {

    // Variables
    $alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot' ) );
    $user_id = esc_attr( $_GET['id'] );
    $submit_text = stripslashes( wpwebapp_get_pw_reset_text() );
    $submit_class = esc_attr( wpwebapp_get_form_button_class() );
    $pw_requirements = stripslashes( wpwebapp_get_pw_requirements_text() );

    $form =
        $alert .
        '<form class="form-wpwebapp" id="wpwebapp-form-pw-reset" name="wpwebapp-form-pw-reset" action="" method="post">' .
            wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw-reset-new-1', __( 'New Password' . $pw_requirements, 'wpwebapp' ), '', '1', 'autofocus' ) .
            wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw-reset-new-2', __( 'Confirm New Password', 'wpwebapp' ), '', '2' ) .
            wpwebapp_form_field_text_input( 'hidden', 'wpwebapp-pw-reset-id', '', $user_id ) .
            wpwebapp_form_field_submit( 'wpwebapp-reset-pw-submit', $submit_class, $submit_text, 'wpwebapp-reset-pw-process-nonce', 'wpwebapp-reset-pw-process', '3' ) .
        '</form>';

    return $form;

}


// Display Forgot & Reset Password Forms
function wpwebapp_form_pw_forgot_and_reset() {

    // Get forgot password alert message
    $status = wpwebapp_get_alert_message( 'wpwebapp_status', 'wpwebapp_status_pw_reset' );

    // If this is password reset URL with a valid key
    if ( $_GET['action'] === 'reset-pw' && $status == 'reset-key-valid' ) {
        $form = wpwebapp_form_pw_reset();
    } else {
        $form = wpwebapp_form_pw_forgot();
    }

    return $form;

}
add_shortcode( 'wpwa_forgot_pw_form', 'wpwebapp_form_pw_forgot_and_reset' );





/* ======================================================================
    PROCESS FORMS
    Process form content on submit.
 * ====================================================================== */

// Process Login Form
function wpwebapp_process_login() {
    if ( isset( $_POST['wpwebapp-login-process'] ) ) {
        if ( wp_verify_nonce( $_POST['wpwebapp-login-process'], 'wpwebapp-login-process-nonce' ) ) {

            // Login variables
            $referer = esc_url_raw( wpwebapp_get_url() );
            $front_page = esc_url_raw( wpwebapp_get_redirect_url_logged_in() );
            $alert_login = stripslashes( wpwebapp_get_alert_login_incorrect() );
            $username = sanitize_user( $_POST['wpwebapp-username'] );
            $password = wp_filter_nohtml_kses( $_POST['wpwebapp-password'] );
            if ( isset( $_POST['wpwebapp-rememberme'] ) ) {
                $rememberme = true;
            } else {
                $rememberme = false;
            }

            // If login is an email, get username
            if ( is_email( $username ) ) {
                $user = get_user_by( 'email', $username );
                $user_id = $user->ID;
                $user_data = get_userdata( $user_id );
                $username = $user_data->user_login;
            }

            // Authenticate User
            $credentials = array();
            $credentials['user_login'] = $username;
            $credentials['user_password'] = $password;
            $credentials['remember'] = $rememberme;
            $login = wp_signon( $credentials);

            // If errors
            if ( is_wp_error( $login ) ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_login', $alert_login );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else {
                wp_safe_redirect( $front_page, 302 );
                exit;
            }

        } else {
            die( 'Security check' );
        }
    }
}
add_action('init', 'wpwebapp_process_login');


// Process Signup Form
function wpwebapp_process_signup() {
    if ( isset( $_POST['wpwebapp-signup-process'] ) ) {
        if ( wp_verify_nonce( $_POST['wpwebapp-signup-process'], 'wpwebapp-signup-process-nonce' ) ) {

            // Signup variables
            $referer = esc_url_raw( wpwebapp_get_url() );
            $front_page = esc_url_raw( wpwebapp_get_redirect_url_logged_in() );
            $username = sanitize_user( $_POST['wpwebapp-signup-username'] );
            $email = sanitize_email( $_POST['wpwebapp-signup-email'] );
            $password = wp_filter_nohtml_kses( $_POST['wpwebapp-signup-password'] );
            $pw_test = wpwebapp_password_meets_requirements( $password );

            // Alert Text
            $alert_empty_fields = wpwebapp_get_alert_empty_fields();
            $alert_username_invalid = wpwebapp_get_alert_username_invalid();
            $alert_username_taken = wpwebapp_get_alert_username_taken();
            $alert_invalid_email = wpwebapp_get_alert_email_invalid();
            $alert_email_taken = wpwebapp_get_alert_email_taken();
            $alert_pw_requirements = wpwebapp_get_alert_pw_requirements();

            // Validate username, email, and password
            if ( $username == '' || $email == '' || $password == '' ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_empty_fields );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else if ( !validate_username( $username ) ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_username_invalid ); // TODO: get from options
                wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else if ( username_exists( $username ) ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_username_taken );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else if ( !is_email( $email ) ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_invalid_email );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else if ( email_exists( $email ) ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_email_taken );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else if ( !$pw_test ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_signup', $alert_pw_requirements );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_username', 'wpwebapp_username', $username );
                wpwebapp_set_alert_message( 'wpwebapp_credentials_email', 'wpwebapp_email', $email );
                wp_safe_redirect( $referer, 302 );
                exit;
            }

            // If no errors exist, create an account
            wp_create_user( $username, $password, sanitize_email( $email ) );

            // Log new user in
            $credentials = array();
            $credentials['user_login'] = $username;
            $credentials['user_password'] = $password;
            $credentials['remember'] = true;
            $login = wp_signon( $credentials);
            wp_safe_redirect( $front_page, 302 );
            exit;

        } else {
            die( 'Security check' );
        }
    }
}
add_action('init', 'wpwebapp_process_signup');


// Process Change Password Form
function wpwebapp_process_pw_change() {
    if ( isset( $_POST['wpwebapp-change-pw-process'] ) ) {
        if ( wp_verify_nonce( $_POST['wpwebapp-change-pw-process'], 'wpwebapp-change-pw-process-nonce' ) ) {

            // Password change variables
            global $current_user;
            get_currentuserinfo();
            $referer = esc_url_raw( wpwebapp_get_url() );
            $user_id = $current_user->ID;
            $user_pw = $current_user->user_pass;
            $pw_current = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-current'] );
            $pw_new_1 = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-new-1'] );
            $pw_new_2 = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-new-2'] );
            $pw_test = wpwebapp_password_meets_requirements( $pw_new_1 );

            // Alert Messages
            $alert_empty_fields = wpwebapp_get_alert_empty_fields();
            $alert_pw_incorrect = wpwebapp_get_alert_pw_incorrect();
            $alert_pw_match = wpwebapp_get_alert_pw_match();
            $alert_pw_requirements = wpwebapp_get_alert_pw_requirements();
            $alert_pw_change_success = wpwebapp_get_alert_pw_change_success();

            // Validate and authenticate passwords
            if ( $pw_current == '' || $pw_new_1 == '' || $pw_new_2 == '' ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_empty_fields );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else if ( !wp_check_password( $pw_current, $user_pw, $user_id ) ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_pw_incorrect );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else if ( $pw_new_1 != $pw_new_2 ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_pw_match );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else if ( !$pw_test ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_pw_requirements );
                wp_safe_redirect( $referer, 302 );
                exit;
            }

            // If no errors exist, change the password
            wp_update_user( array( 'ID' => $user_id, 'user_pass' => $pw_new_1 ) );
            wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_pw_change_success );
            wp_safe_redirect( $referer, 302 );
            exit;

        } else {
            die( 'Security check' );
        }
    }
}
add_action('init', 'wpwebapp_process_pw_change');


// Process Forgot Password Form
function wpwebapp_process_pw_forgot() {
    if ( isset( $_POST['wpwebapp-forgot-pw-process'] ) ) {
        if ( wp_verify_nonce( $_POST['wpwebapp-forgot-pw-process'], 'wpwebapp-forgot-pw-process-nonce' ) ) {

            // Forgot Password Variables
            $referer = esc_url_raw( wpwebapp_get_url() );
            $username_email = $_POST['wpwebapp-username-email'];

            // Alert Messages
            $alert_empty_fields = wpwebapp_get_alert_empty_fields();
            $alert_login_does_not_exist = wpwebapp_get_alert_login_does_not_exist();
            $alert_pw_resets_not_allowed = wpwebapp_get_alert_pw_reset_not_allowed();
            $alert_pw_reset_email_success = wpwebapp_get_alert_pw_reset_email_sent();
            $alert_pw_reset_email_failed = wpwebapp_get_alert_pw_reset_email_failed();

            // Check that form is not empty
            if ( $_POST['wpwebapp-username-email'] == '' ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_empty_fields );
                wp_safe_redirect( $referer, 302 );
                exit;
            }

            // Get user
            if ( is_email( $username_email ) ) {
                $user = get_user_by( 'email', $username_email );
            } else {
                $user = get_user_by( 'login', $username_email );
            }

            // Verify that user exists
            if ( !$user ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_login_does_not_exist );
                wp_safe_redirect( $referer, 302 );
                exit;
            }

            // Get user ID
            $user_id = $user->ID;

            // Verify that user is not admin
            $role_requirements = wpwebapp_get_pw_reset_restriction();
            if ( user_can( $user_id, $role_requirements ) ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_pw_resets_not_allowed );
                wp_safe_redirect( $referer, 302 );
                exit;
            }

            // Get user data
            $user_data = get_userdata( $user_id );
            $user_login = $user_data->user_login;
            $user_email = $user_data->user_email;
            $key = wp_generate_password( 24, false );

            // Add a secret, temporary key to the database
            $expiration = wpwebapp_get_pw_reset_time_valid();
            $transient = 'wpwebapp_forgot_pw_key_' . $user_id;
            if ( get_transient( $transient ) ) {
                $value = get_transient( $transient );
            } else {
                $value = array();
            }
            $value[] = $key;
            set_transient( $transient, $value, 60*60*$expiration );

            // Send Password Reset Email
            $reset_url = wpwebapp_prepare_url( $referer ) . 'action=reset-pw&id=' . $user_id . '&key=' . $key;
            $send_email = wpwebapp_email_pw_reset( $user_email, $user_login, $reset_url );

            // If email was sent successfully
            if ( $send_email ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_pw_reset_email_success );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_pw_reset_email_failed );
                wp_safe_redirect( $referer, 302 );
                exit;
            }

        } else {
            die( 'Security check' );
        }
    }
}
add_action('init', 'wpwebapp_process_pw_forgot');


// Process Password Reset URL
function wpwebapp_process_pw_reset_url() {

    // Check for password reset URL
    if ( $_GET['action'] === 'reset-pw' ) {

        // Get and sanitize current URL
        $referer = esc_url_raw( wpwebapp_get_url() );
        $referer = wpwebapp_clean_url( 'action', $referer );
        $referer = wpwebapp_clean_url( 'id', $referer );
        $referer = wpwebapp_clean_url( 'key', $referer );

        // Password Reset Variables
        $user_id = $_GET['id'];
        $user_key = $_GET['key'];
        $db_keys = get_transient( 'wpwebapp_forgot_pw_key_' . $user_id );

        // Alert Messages
        $alert_pw_reset_url_expired = wpwebapp_get_alert_pw_reset_url_expired();

        // Check if reset key is still active
        if ( !$db_keys || !in_array( $user_key, $db_keys ) ) {
            wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_forgot', $alert_pw_reset_url_expired );
            wp_safe_redirect( $referer, 302 );
            exit;
        } else {
            wpwebapp_set_alert_message( 'wpwebapp_status', 'wpwebapp_status_pw_reset', 'reset-key-valid' );
            return;
        }

    }
}
add_action('init', 'wpwebapp_process_pw_reset_url');


// Process Password Reset Form
function wpwebapp_process_pw_reset() {
    if ( isset( $_POST['wpwebapp-reset-pw-process'] ) ) {
        if ( wp_verify_nonce( $_POST['wpwebapp-reset-pw-process'], 'wpwebapp-reset-pw-process-nonce' ) ) {

            // Password reset variables
            $referer = esc_url_raw( wpwebapp_get_url() );
            $front_page = esc_url_raw( wpwebapp_get_redirect_url_logged_in() );
            $user_id = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-reset-id'] );
            $user = get_userdata( $user_id );
            $username = $user->user_login;
            $pw_new_1 = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-reset-new-1'] );
            $pw_new_2 = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-reset-new-2'] );
            $pw_test = wpwebapp_password_meets_requirements( $pw_new_1 );

            // Alert Messages
            $alert_empty_fields = wpwebapp_get_alert_empty_fields();
            $alert_pw_match = wpwebapp_get_alert_pw_match();
            $alert_pw_requirements = wpwebapp_get_alert_pw_requirements();

            // Validate and authenticate passwords
            if ( $pw_new_1 == '' || $pw_new_2 == '' ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_reset', $alert_empty_fields );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else if ( $pw_new_1 != $pw_new_2 ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_reset', $alert_pw_match );
                wp_safe_redirect( $referer, 302 );
                exit;
            } else if ( !$pw_test ) {
                wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_reset', $alert_pw_requirements );
                wp_safe_redirect( $referer, 302 );
                exit;
            }

            // If no errors exist, change the password and delete key
            wp_update_user( array( 'ID' => $user_id, 'user_pass' => $pw_new_1 ) );
            delete_transient( 'wpwebapp_forgot_pw_key_' . $user_id );

            // Log the user in
            $credentials = array();
            $credentials['user_login'] = $username;
            $credentials['user_password'] = $pw_new_1;
            $credentials['remember'] = true;
            $login = wp_signon( $credentials);
            wp_safe_redirect( $front_page, 302 );
            exit;

        } else {
            die( 'Security check' );
        }
    }
}
add_action('init', 'wpwebapp_process_pw_reset');

?>