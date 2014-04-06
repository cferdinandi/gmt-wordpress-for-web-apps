<?php

/* ======================================================================

    WordPress for Web App Options
    Adjust plugin settings from the admin dashboard.

    Forked from code by Michael Fields.
    https://gist.github.com/mfields/4678999

 * ====================================================================== */


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

    if ( isset( $input['delete_button_class'] ) && ! empty( $input['delete_button_class'] ) )
        $output['delete_button_class'] = wp_filter_nohtml_kses( $input['delete_button_class'] );

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

    if ( isset( $input['delete_account_text'] ) && ! empty( $input['delete_account_text'] ) )
        $output['delete_account_text'] = wp_filter_post_kses( $input['delete_account_text'] );

    if ( isset( $input['delete_account_url'] ) && ! empty( $input['delete_account_url'] ) )
        $output['delete_account_url'] = wp_filter_post_kses( $input['delete_account_url'] );


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

?>