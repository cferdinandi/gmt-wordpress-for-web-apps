<?php

/* ======================================================================

    WordPress for Web App Options
    Adjust plugin settings from the admin dashboard.

    Forked from code by Michael Fields.
    https://gist.github.com/mfields/4678999

 * ====================================================================== */


/* ======================================================================
    OPTION FIELDS
    Create the plugin option fields.
 * ====================================================================== */

// Security
function wpwebapp_settings_field_minimum_password_length() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[minimum_password_length]" id="minimum-password-length" value="<?php echo esc_attr( $options['minimum_password_length'] ); ?>" /><br>
    <label class="description" for="minimum-password-length"><?php _e( 'Default: <code>8</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_password_requirements() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <div class="layout">
        <label class="description" for="password-requirements-letters">
            <input type="checkbox" name="wpwebapp_plugin_options[password_requirements_letters]" id="password-requirements-letters" <?php checked( 'on', $options['password_requirements_letters'] ); ?> />
            <?php _e( 'Letters', 'wpwebapp' ); ?>
        </label>
    </div>
    <div class="layout">
        <label class="description" for="password-requirements-numbers">
            <input type="checkbox" name="wpwebapp_plugin_options[password_requirements_numbers]" id="password-requirements-numbers" <?php checked( 'on', $options['password_requirements_numbers'] ); ?> />
            <?php _e( 'Numbers', 'wpwebapp' ); ?>
        </label>
    </div>
    <div class="layout">
        <label class="description" for="password-requirements-special-chars">
            <input type="checkbox" name="wpwebapp_plugin_options[password_requirements_special_chars]" id="password-requirements-special-chars" <?php checked( 'on', $options['password_requirements_special_chars'] ); ?> />
            <?php _e( 'Special Characters', 'wpwebapp' ); ?>
        </label>
    </div>
    <?php
}

// Used in wpwebapp_settings_field_restrict_pw_reset()
function wpwebapp_settings_field_restrict_pw_reset_choices() {
    $restrict_pw_reset = array(
        'admin' => array(
            'value' => 'admin',
            'label' => __( 'Admin', 'wpwebapp' )
        ),
        'editor' => array(
            'value' => 'editor',
            'label' => __( 'Editor', 'wpwebapp' )
        ),
        'author' => array(
            'value' => 'author',
            'label' => __( 'Author', 'wpwebapp' )
        ),
        'contributor' => array(
            'value' => 'contributor',
            'label' => __( 'Contributor', 'wpwebapp' )
        ),
        'subscriber' => array(
            'value' => 'subscriber',
            'label' => __( 'Subscriber', 'wpwebapp' )
        )
    );

    return apply_filters( 'wpwebapp_settings_field_restrict_pw_reset_choices', $restrict_pw_reset );
}

function wpwebapp_settings_field_restrict_pw_reset() {
    $options = wpwebapp_get_plugin_options();
    foreach ( wpwebapp_settings_field_restrict_pw_reset_choices() as $button ) {
    ?>
    <div class="layout">
        <label class="description">
            <input type="radio" name="wpwebapp_plugin_options[restrict_pw_reset]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['restrict_pw_reset'], $button['value'] ); ?> />
            <?php echo $button['label']; ?>
        </label>
    </div>
    <?php
    }
}

function wpwebapp_settings_field_pw_reset_time_valid() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[pw_reset_time_valid]" id="pw-reset-time-valid" value="<?php echo esc_attr( $options['pw_reset_time_valid'] ); ?>" /><br>
    <label class="description" for="pw-reset-time-valid"><?php _e( 'Default: <code>24</code>', 'wpwebapp' ); ?></label>
    <?php
}


// User Access
// Used in wpwebapp_settings_field_block_wp_backend_access()
function wpwebapp_settings_field_block_wp_backend_access_choices() {
    $block_wp_backend_access = array(
        'admin' => array(
            'value' => 'admin',
            'label' => __( 'Admin', 'wpwebapp' )
        ),
        'editor' => array(
            'value' => 'editor',
            'label' => __( 'Editor', 'wpwebapp' )
        ),
        'author' => array(
            'value' => 'author',
            'label' => __( 'Author', 'wpwebapp' )
        ),
        'contributor' => array(
            'value' => 'contributor',
            'label' => __( 'Contributor', 'wpwebapp' )
        ),
        'subscriber' => array(
            'value' => 'subscriber',
            'label' => __( 'Subscriber', 'wpwebapp' )
        )
    );

    return apply_filters( 'wpwebapp_settings_field_block_wp_backend_access_choices', $block_wp_backend_access );
}

function wpwebapp_settings_field_block_wp_backend_access() {
    $options = wpwebapp_get_plugin_options();
    foreach ( wpwebapp_settings_field_block_wp_backend_access_choices() as $button ) {
    ?>
    <div class="layout">
        <label class="description">
            <input type="radio" name="wpwebapp_plugin_options[block_wp_backend_access]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['block_wp_backend_access'], $button['value'] ); ?> />
            <?php echo $button['label']; ?>
        </label>
    </div>
    <?php
    }
}

function wpwebapp_settings_field_redirect_logged_out() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[redirect_logged_out]" id="redirect-logged-out" value="<?php echo esc_url( $options['redirect_logged_out'] ); ?>" /><br>
    <label class="description" for="redirect-logged-out"><?php _e( 'Default: Home Page', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_redirect_logged_in() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[redirect_logged_in]" id="redirect-logged-in" value="<?php echo esc_url( $options['redirect_logged_in'] ); ?>" /><br>
    <label class="description" for="redirect-logged-in"><?php _e( 'Default: Home Page', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_blog_posts_require_login() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <label for="blog-posts-require-login">
        <input type="checkbox" name="wpwebapp_plugin_options[blog_posts_require_login]" id="blog-posts-require-login" <?php checked( 'on', $options['blog_posts_require_login'] ); ?> />
        <?php _e( 'Require user login to view blog posts', 'wpwebapp' ); ?>
    </label>
    <?php
}


// Forms
function wpwebapp_settings_field_button_class() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[button_class]" id="button-class" value="<?php echo esc_attr( $options['button_class'] ); ?>" /><br>
    <label class="description" for="button-class"><?php _e( 'Example: <code>btn btn-blue</code>. Default: None.', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_button_text_login() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[button_text_login]" id="button-text-login" value="<?php echo esc_attr( $options['button_text_login'] ); ?>" /><br>
    <label class="description" for="button-text-login"><?php _e( 'Default: <code>Login</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_button_text_signup() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[button_text_signup]" id="button-text-signup" value="<?php echo esc_attr( $options['button_text_signup'] ); ?>" /><br>
    <label class="description" for="button-text-signup"><?php _e( 'Default: <code>Signup</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_button_text_pw_change() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[button_text_pw_change]" id="button-text-pw-change" value="<?php echo esc_attr( $options['button_text_pw_change'] ); ?>" /><br>
    <label class="description" for="button-text-pw-change"><?php _e( 'Default: <code>Change Password</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_button_text_pw_forgot() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[button_text_pw_forgot]" id="button-text-pw-forgot" value="<?php echo esc_attr( $options['button_text_pw_forgot'] ); ?>" /><br>
    <label class="description" for="button-text-pw-forgot"><?php _e( 'Default: <code>Reset Password</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_button_text_pw_reset() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[button_text_pw_reset]" id="button-text-pw-reset" value="<?php echo esc_attr( $options['button_text_pw_reset'] ); ?>" /><br>
    <label class="description" for="button-text-pw-reset"><?php _e( 'Default: <code>Set New Password</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_forgot_pw_url() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[forgot_pw_url]" id="forgot-pw-url" value="<?php echo esc_url( $options['forgot_pw_url'] ); ?>" /><br>
    <label class="description" for="forgot-pw-url"><?php _e( 'Default: None', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_forgot_pw_url_text() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[forgot_pw_url_text]" id="forgot-pw-url-text" value="<?php echo esc_attr( $options['forgot_pw_url_text'] ); ?>" /><br>
    <label class="description" for="forgot-pw-url-text"><?php _e( 'Default: <code>forgot password</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_pw_requirement_text() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[pw_requirement_text]" id="pw-requirement-text" value="<?php echo esc_attr( $options['pw_requirement_text'] ); ?>" /><br>
    <label class="description" for="pw-requirement-text"><?php _e( 'Default: Varies based on your password requirements under "Security"<br />Use the variable <code>%n</code> to dynamically display the minimum character number from your settings.', 'wpwebapp' ); ?></label>
    <?php
}


// Alerts
function wpwebapp_settings_field_alert_empty_fields() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_empty_fields]" id="alert-empty-fields" value="<?php echo esc_html( $options['alert_empty_fields'] ); ?>" /><br>
    <label class="description" for="alert-empty-fields"><?php _e( 'Default: <code>&lt;p&gt;Please complete all fields.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_pw_requirements() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_pw_requirements]" id="alert-pw-requirements" value="<?php echo esc_html( $options['alert_pw_requirements'] ); ?>" /><br>
    <label class="description" for="alert-pw-requirements"><?php _e( 'Default: <code>&lt;p&gt;Please use a password that\'s at least %n characters long.&lt;/p&gt;</code><br />Use the variable <code>%n</code> to dynamically display the minimum character number from your settings.', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_pw_no_match() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_pw_no_match]" id="alert-pw-no-match" value="<?php echo esc_html( $options['alert_pw_no_match'] ); ?>" /><br>
    <label class="description" for="alert-pw-no-match"><?php _e( 'Default: <code>&lt;p&gt;The new passwords your entered didn\'t match.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_incorrect_login() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_incorrect_login]" id="alert-incorrect-login" value="<?php echo esc_html( $options['alert_incorrect_login'] ); ?>" /><br>
    <label class="description" for="alert-incorrect-login"><?php _e( 'Default: <code>&lt;p&gt;Incorrect username or password.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_username_invalid() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_username_invalid]" id="alert-username-invalid" value="<?php echo esc_html( $options['alert_username_invalid'] ); ?>" /><br>
    <label class="description" for="alert-username-invalid"><?php _e( 'Default: <code>&lt;p&gt;Usernames can only contain letters, numbers, and these special characters: _, space, ., -, *, and @.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_username_taken() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_username_taken]" id="alert-username-taken" value="<?php echo esc_html( $options['alert_username_taken'] ); ?>" /><br>
    <label class="description" for="alert-username-taken"><?php _e( 'Default: <code>&lt;p&gt;Username already exists.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_email_invalid() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_email_invalid]" id="alert-email-invalid" value="<?php echo esc_html( $options['alert_email_invalid'] ); ?>" /><br>
    <label class="description" for="alert-email-invalid"><?php _e( 'Default: <code>&lt;p&gt;Please use a valid email address.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_email_taken() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_email_taken]" id="alert-email-taken" value="<?php echo esc_html( $options['alert_email_taken'] ); ?>" /><br>
    <label class="description" for="alert-email-taken"><?php _e( 'Default: <code>&lt;p&gt;An account with this email address already exists.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_pw_incorrect() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_pw_incorrect]" id="alert-pw-incorrect" value="<?php echo esc_html( $options['alert_pw_incorrect'] ); ?>" /><br>
    <label class="description" for="alert-pw-incorrect"><?php _e( 'Default: <code>&lt;p&gt;The password you entered does not match your current password.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_pw_change_success() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_pw_change_success]" id="alert-pw-change-success" value="<?php echo esc_html( $options['alert_pw_change_success'] ); ?>" /><br>
    <label class="description" for="alert-pw-change-success"><?php _e( 'Default: <code>&lt;p&gt;Your password has been updated.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_login_does_not_exist() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_login_does_not_exist]" id="alert-login-does-not-exist" value="<?php echo esc_html( $options['alert_login_does_not_exist'] ); ?>" /><br>
    <label class="description" for="alert-login-does-not-exist"><?php _e( 'Default: <code>&lt;p&gt;Username or email doesn\'t exist.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_pw_reset_not_allowed() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_pw_reset_not_allowed]" id="alert-pw-reset-not-allowed" value="<?php echo esc_html( $options['alert_pw_reset_not_allowed'] ); ?>" /><br>
    <label class="description" for="alert-pw-reset-not-allowed"><?php _e( 'Default: <code>&lt;p&gt;Password resets are not allowed for this user.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_pw_reset_email_sent() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_pw_reset_email_sent]" id="alert-pw-reset-email-sent" value="<?php echo esc_html( $options['alert_pw_reset_email_sent'] ); ?>" /><br>
    <label class="description" for="alert-pw-reset-email-sent"><?php _e( 'Default: <code>&lt;p&gt;We\'ve sent you an email with a temporary link that will allow you to reset your password for the next %t hours. Please check your spam folder if the email doesn’t appear within a few minutes.&lt;/p&gt;</code><br />Use the variable <code>%t</code> to dynamically display the number of hours from your settings.', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_pw_reset_email_failed() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_pw_reset_email_failed]" id="alert-pw-reset-email-failed" value="<?php echo esc_html( $options['alert_pw_reset_email_failed'] ); ?>" /><br>
    <label class="description" for="alert-pw-reset-email-failed"><?php _e( 'Default: <code>&lt;p&gt;Oops, something went wrong on our end. Please try again.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}

function wpwebapp_settings_field_alert_pw_reset_url_invalid() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <input type="text" name="wpwebapp_plugin_options[alert_pw_reset_url_invalid]" id="alert-pw-reset-url-invalid" value="<?php echo esc_html( $options['alert_pw_reset_url_invalid'] ); ?>" /><br>
    <label class="description" for="alert-pw-reset-url-invalid"><?php _e( 'Default: <code>&lt;p&gt;This password reset request is no longer valid.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
    <?php
}


// Emails
function wpwebapp_settings_field_email_disable_new_user_default() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <label for="email-disable-new-user-default">
        <input type="checkbox" name="wpwebapp_plugin_options[email_disable_new_user_default]" id="email-disable-new-user-default" <?php checked( 'on', $options['email_disable_new_user_default'] ); ?> />
        <?php _e( 'Disable the default new user email that WordPress sends', 'wpwebapp' ); ?>
    </label>
    <?php
}

function wpwebapp_settings_field_email_disable_pw_reset() {
    $options = wpwebapp_get_plugin_options();
    ?>
    <label for="email-disable-pw-reset">
        <input type="checkbox" name="wpwebapp_plugin_options[email_disable_pw_reset]" id="email-disable-pw-reset" <?php checked( 'on', $options['email_disable_pw_reset'] ); ?> />
        <?php _e( 'Disable the email WordPress sends whenever a user changes their password', 'wpwebapp' ); ?>
    </label>
    <?php
}





/* ======================================================================
    OPTION DEFAULTS & SANITIZATION
    The defaults and sanitization methods for the plugin options.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options() {
    $saved = (array) get_option( 'wpwebapp_plugin_options' );
    $defaults = array(
        // Security
        'minimum_password_length' => '',
        'password_requirements_letters' => 'off',
        'password_requirements_numbers' => 'off',
        'password_requirements_special_chars' => 'off',
        'restrict_pw_reset' => 'subscriber',
        'pw_reset_time_valid' => '',

        // User Access
        'block_wp_backend_access' => 'admin',
        'redirect_logged_in' => '',
        'redirect_logged_out' => '',

        // Forms
        'button_class' => '',
        'button_text_login' => '',
        'button_text_signup' => '',
        'button_text_pw_change' => '',
        'button_text_pw_forgot' => '',
        'button_text_pw_reset' => '',
        'forgot_pw_url' => '',
        'forgot_pw_url_text' => '',
        'pw_requirement_text' => '',
        'blog_posts_require_login' => 'off',

        // Alerts
        'alert_empty_fields' => '',
        'alert_pw_requirements' => '',
        'alert_pw_no_match' => '',
        'alert_incorrect_login' => '',
        'alert_username_invalid' => '',
        'alert_username_taken' => '',
        'alert_email_invalid' => '',
        'alert_email_taken' => '',
        'alert_pw_incorrect' => '',
        'alert_pw_change_success' => '',
        'alert_login_does_not_exist' => '',
        'alert_pw_reset_not_allowed' => '',
        'alert_pw_reset_email_sent' => '',
        'alert_pw_reset_email_failed' => '',
        'alert_pw_reset_url_invalid' => '',

        // Emails
        'email_disable_new_user_default' => 'on',
        'email_disable_pw_reset' => 'on',

    );

    $defaults = apply_filters( 'wpwebapp_default_plugin_options', $defaults );

    $options = wp_parse_args( $saved, $defaults );
    $options = array_intersect_key( $options, $defaults );

    return $options;
}



// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate( $input ) {
    $output = array();


    // Security
    if ( isset( $input['minimum_password_length'] ) && ! empty( $input['minimum_password_length'] ) && is_numeric( $input['minimum_password_length'] ) && ( $input['minimum_password_length'] > 0 ) )
        $output['minimum_password_length'] = wp_filter_nohtml_kses( $input['minimum_password_length'] );

    if ( isset( $input['password_requirements_letters'] ) )
        $output['password_requirements_letters'] = 'on';

    if ( isset( $input['password_requirements_numbers'] ) )
        $output['password_requirements_numbers'] = 'on';

    if ( isset( $input['password_requirements_special_chars'] ) )
        $output['password_requirements_special_chars'] = 'on';

    if ( isset( $input['restrict_pw_reset'] ) && array_key_exists( $input['restrict_pw_reset'], wpwebapp_settings_field_restrict_pw_reset_choices() ) )
        $output['restrict_pw_reset'] = $input['restrict_pw_reset'];

    if ( isset( $input['pw_reset_time_valid'] ) && ! empty( $input['pw_reset_time_valid'] ) && is_numeric( $input['minimum_password_length'] ) && ( $input['minimum_password_length'] > 0 ) )
        $output['pw_reset_time_valid'] = wp_filter_nohtml_kses( $input['pw_reset_time_valid'] );


    // User Access
    if ( isset( $input['block_wp_backend_access'] ) && array_key_exists( $input['block_wp_backend_access'], wpwebapp_settings_field_block_wp_backend_access_choices() ) )
        $output['block_wp_backend_access'] = $input['block_wp_backend_access'];

    if ( isset( $input['redirect_logged_out'] ) && ! empty( $input['redirect_logged_out'] ) )
        $output['redirect_logged_out'] = wp_filter_nohtml_kses( $input['redirect_logged_out'] );

    if ( isset( $input['redirect_logged_in'] ) && ! empty( $input['redirect_logged_in'] ) )
        $output['redirect_logged_in'] = wp_filter_nohtml_kses( $input['redirect_logged_in'] );

    if ( isset( $input['blog_posts_require_login'] ) )
        $output['blog_posts_require_login'] = 'on';


    // Forms
    if ( isset( $input['button_class'] ) && ! empty( $input['button_class'] ) )
        $output['button_class'] = wp_filter_nohtml_kses( $input['button_class'] );

    if ( isset( $input['button_text_login'] ) && ! empty( $input['button_text_login'] ) )
        $output['button_text_login'] = wp_filter_nohtml_kses( $input['button_text_login'] );

    if ( isset( $input['button_text_signup'] ) && ! empty( $input['button_text_signup'] ) )
        $output['button_text_signup'] = wp_filter_nohtml_kses( $input['button_text_signup'] );

    if ( isset( $input['button_text_pw_change'] ) && ! empty( $input['button_text_pw_change'] ) )
        $output['button_text_pw_change'] = wp_filter_nohtml_kses( $input['button_text_pw_change'] );

    if ( isset( $input['button_text_pw_forgot'] ) && ! empty( $input['button_text_pw_forgot'] ) )
        $output['button_text_pw_forgot'] = wp_filter_nohtml_kses( $input['button_text_pw_forgot'] );

    if ( isset( $input['button_text_pw_reset'] ) && ! empty( $input['button_text_pw_reset'] ) )
        $output['button_text_pw_reset'] = wp_filter_nohtml_kses( $input['button_text_pw_reset'] );

    if ( isset( $input['forgot_pw_url'] ) && ! empty( $input['forgot_pw_url'] ) )
        $output['forgot_pw_url'] = wp_filter_nohtml_kses( $input['forgot_pw_url'] );

    if ( isset( $input['forgot_pw_url_text'] ) && ! empty( $input['forgot_pw_url_text'] ) )
        $output['forgot_pw_url_text'] = wp_filter_post_kses( $input['forgot_pw_url_text'] );

    if ( isset( $input['pw_requirement_text'] ) && ! empty( $input['pw_requirement_text'] ) )
        $output['pw_requirement_text'] = wp_filter_post_kses( $input['pw_requirement_text'] );


    // Alerts
    if ( isset( $input['alert_empty_fields'] ) && ! empty( $input['alert_empty_fields'] ) )
        $output['alert_empty_fields'] = wp_filter_post_kses( $input['alert_empty_fields'] );

    if ( isset( $input['alert_pw_requirements'] ) && ! empty( $input['alert_pw_requirements'] ) )
        $output['alert_pw_requirements'] = wp_filter_post_kses( $input['alert_pw_requirements'] );

    if ( isset( $input['alert_pw_no_match'] ) && ! empty( $input['alert_pw_no_match'] ) )
        $output['alert_pw_no_match'] = wp_filter_post_kses( $input['alert_pw_no_match'] );

    if ( isset( $input['alert_incorrect_login'] ) && ! empty( $input['alert_incorrect_login'] ) )
        $output['alert_incorrect_login'] = wp_filter_post_kses( $input['alert_incorrect_login'] );

    if ( isset( $input['alert_username_invalid'] ) && ! empty( $input['alert_username_invalid'] ) )
        $output['alert_username_invalid'] = wp_filter_post_kses( $input['alert_username_invalid'] );

    if ( isset( $input['alert_username_taken'] ) && ! empty( $input['alert_username_taken'] ) )
        $output['alert_username_taken'] = wp_filter_post_kses( $input['alert_username_taken'] );

    if ( isset( $input['alert_email_invalid'] ) && ! empty( $input['alert_email_invalid'] ) )
        $output['alert_email_invalid'] = wp_filter_post_kses( $input['alert_email_invalid'] );

    if ( isset( $input['alert_email_taken'] ) && ! empty( $input['alert_email_taken'] ) )
        $output['alert_email_taken'] = wp_filter_post_kses( $input['alert_email_taken'] );

    if ( isset( $input['alert_pw_incorrect'] ) && ! empty( $input['alert_pw_incorrect'] ) )
        $output['alert_pw_incorrect'] = wp_filter_post_kses( $input['alert_pw_incorrect'] );

    if ( isset( $input['alert_pw_change_success'] ) && ! empty( $input['alert_pw_change_success'] ) )
        $output['alert_pw_change_success'] = wp_filter_post_kses( $input['alert_pw_change_success'] );

    if ( isset( $input['alert_login_does_not_exist'] ) && ! empty( $input['alert_login_does_not_exist'] ) )
        $output['alert_login_does_not_exist'] = wp_filter_post_kses( $input['alert_login_does_not_exist'] );

    if ( isset( $input['alert_pw_reset_not_allowed'] ) && ! empty( $input['alert_pw_reset_not_allowed'] ) )
        $output['alert_pw_reset_not_allowed'] = wp_filter_post_kses( $input['alert_pw_reset_not_allowed'] );

    if ( isset( $input['alert_pw_reset_email_sent'] ) && ! empty( $input['alert_pw_reset_email_sent'] ) )
        $output['alert_pw_reset_email_sent'] = wp_filter_post_kses( $input['alert_pw_reset_email_sent'] );

    if ( isset( $input['alert_pw_reset_email_failed'] ) && ! empty( $input['alert_pw_reset_email_failed'] ) )
        $output['alert_pw_reset_email_failed'] = wp_filter_post_kses( $input['alert_pw_reset_email_failed'] );

    if ( isset( $input['alert_pw_reset_url_invalid'] ) && ! empty( $input['alert_pw_reset_url_invalid'] ) )
        $output['alert_pw_reset_url_invalid'] = wp_filter_post_kses( $input['alert_pw_reset_url_invalid'] );


    // Emails
    if ( !isset( $input['email_disable_new_user_default'] ) )
        $output['email_disable_new_user_default'] = 'off';

    if ( !isset( $input['email_disable_pw_reset'] ) )
        $output['email_disable_pw_reset'] = 'off';


    return apply_filters( 'wpwebapp_plugin_options_validate', $output, $input );
}





/* ======================================================================
    OPTIONS MENU
    Create the plugin options menu.
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
    add_settings_field( 'minimum_password_length', __( 'Minimum Password Length<div class="description">Must be a whole number</div>', 'wpwebapp' ), 'wpwebapp_settings_field_minimum_password_length', 'plugin_options', 'security' );
    add_settings_field( 'password_requirements_letters', __( 'Password Requirements<div class="description">Required password characters</div>', 'wpwebapp' ), 'wpwebapp_settings_field_password_requirements', 'plugin_options', 'security' );
    add_settings_field( 'restrict_pw_reset', __( 'Restrict Password Reset<div class="description">Highest role that can use the password reset form (lower is more secure)</div>', 'wpwebapp' ), 'wpwebapp_settings_field_restrict_pw_reset', 'plugin_options', 'security' );
    add_settings_field( 'pw_reset_time_valid', __( 'Password Reset Time<div class="description">Number of hours password reset URL is valid for (must be a whole number)</div>', 'wpwebapp' ), 'wpwebapp_settings_field_pw_reset_time_valid', 'plugin_options', 'security' );


    // User Access
    add_settings_section( 'access', __( 'User Access', 'wpwebapp' ),  '__return_false', 'plugin_options' );
    add_settings_field( 'block_wp_backend_access', __( 'Block Backend Access<div class="description">Minimum role that can access the WordPress backend and see the admin bar (higher is more secure)</div>', 'wpwebapp' ), 'wpwebapp_settings_field_block_wp_backend_access', 'plugin_options', 'access' );
    add_settings_field( 'redirect_logged_out', __( 'Logged-Out Redirect<div class="description">Where to redirect logged-our users</div>', 'wpwebapp' ), 'wpwebapp_settings_field_redirect_logged_out', 'plugin_options', 'access' );
    add_settings_field( 'redirect_logged_in', __( 'Logged-In Redirect<div class="description">Where to redirect logged-in users</div>', 'wpwebapp' ), 'wpwebapp_settings_field_redirect_logged_in', 'plugin_options', 'access' );
    add_settings_field( 'blog_posts_require_login', __( 'Blog Post Access', 'wpwebapp' ), 'wpwebapp_settings_field_blog_posts_require_login', 'plugin_options', 'access' );


    // Forms
    add_settings_section( 'forms', __( 'Forms', 'wpwebapp' ),  '__return_false', 'plugin_options' );
    add_settings_field( 'button_class', __( 'Button Class<div class="description">Class to apply to form submit buttons.</div>', 'wpwebapp' ), 'wpwebapp_settings_field_button_class', 'plugin_options', 'forms' );
    add_settings_field( 'button_text_login', __( 'Login Text<div class="description">Text for the login button.</div>', 'wpwebapp' ), 'wpwebapp_settings_field_button_text_login', 'plugin_options', 'forms' );
    add_settings_field( 'button_text_signup', __( 'Signup Text<div class="description">Text for the signup button.</div>', 'wpwebapp' ), 'wpwebapp_settings_field_button_text_signup', 'plugin_options', 'forms' );
    add_settings_field( 'button_text_pw_change', __( 'Change Password Text<div class="description">Text for the change password button.</div>', 'wpwebapp' ), 'wpwebapp_settings_field_button_text_pw_change', 'plugin_options', 'forms' );
    add_settings_field( 'button_text_pw_forgot', __( 'Forgot Password Text<div class="description">Text for the button to send a password reset email.</div>', 'wpwebapp' ), 'wpwebapp_settings_field_button_text_pw_forgot', 'plugin_options', 'forms' );
    add_settings_field( 'button_text_pw_reset', __( 'Password Reset Text<div class="description">Text for the button to change a password after a reset.</div>', 'wpwebapp' ), 'wpwebapp_settings_field_button_text_pw_reset', 'plugin_options', 'forms' );
    add_settings_field( 'forgot_pw_url', __( 'Forgot Password URL<div class="description">A link to the "forgot password" page.</div>', 'wpwebapp' ), 'wpwebapp_settings_field_forgot_pw_url', 'plugin_options', 'forms' );
    add_settings_field( 'forgot_pw_url_text', __( 'Forgot Password URL Text<div class="description">Text for the "forgot password" URL (only shown if URL is set).</div>', 'wpwebapp' ), 'wpwebapp_settings_field_forgot_pw_url_text', 'plugin_options', 'forms' );
    add_settings_field( 'pw_requirement_text', __( 'Password Requirement Text<div class="description">Signup, Password Change, and Password Reset Forms</div>', 'wpwebapp' ), 'wpwebapp_settings_field_pw_requirement_text', 'plugin_options', 'forms' );


    // Alerts
    add_settings_section( 'alerts', __( 'Alerts', 'wpwebapp' ),  '__return_false', 'plugin_options' );
    add_settings_field( 'alert_empty_fields', __( 'Empty Fields<div class="description">Signup, Password Change, and Password Reset Forms</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_empty_fields', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_requirements', __( 'Password Requirements<div class="description">Signup, Password Change and Password Reset forms</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_pw_requirements', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_no_match', __( 'Passwords Don\'t Match<div class="description">Password Change and Password Reset forms</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_pw_no_match', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_incorrect_login', __( 'Incorrect Login<div class="description">Login and Forgot Password forms</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_incorrect_login', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_username_invalid', __( 'Username Taken<div class="description">Signup form</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_username_invalid', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_username_taken', __( 'Username Taken<div class="description">Signup form</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_username_taken', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_email_invalid', __( 'Invalid Email<div class="description">Signup form</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_email_invalid', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_email_taken', __( 'Email Taken<div class="description">Signup form</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_email_taken', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_incorrect', __( 'Incorrect Password<div class="description">Password Change form</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_pw_incorrect', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_change_success', __( 'Password Change Success<div class="description">Password Change form</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_pw_change_success', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_login_does_not_exist', __( 'Login Doesn\'t Exist<div class="description">Forgot Password form</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_login_does_not_exist', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_reset_not_allowed', __( 'Password Reset Not Allowed<div class="description">Forgot Password form (no resets for admins)</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_pw_reset_not_allowed', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_reset_email_sent', __( 'Password Reset Email Sent<div class="description">Forgot Password form</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_pw_reset_email_sent', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_reset_email_failed', __( 'Password Reset Email Failed<div class="description">Forgot Password form</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_pw_reset_email_failed', 'plugin_options', 'alerts' );
    add_settings_field( 'alert_pw_reset_url_invalid', __( 'Password Reset URL Expired<div class="description">Password Reset form</div>', 'wpwebapp' ), 'wpwebapp_settings_field_alert_pw_reset_url_invalid', 'plugin_options', 'alerts' );


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