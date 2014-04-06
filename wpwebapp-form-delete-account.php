<?php

/* ======================================================================

    WordPress for Web Apps Forms
    Functions to create and process the plugin forms.

 * ====================================================================== */


// Create & Display Delete Account Form
function wpwebapp_form_delete_account() {

    // Variables
    $submit_text = stripslashes( wpwebapp_get_delete_account_text() );
    $submit_class = esc_attr( wpwebapp_get_delete_account_button_class() );

    $form =
        $alert .
        '<form class="form-wpwebapp" id="wpwebapp-form-delete-account" name="wpwebapp-form-delete-account" action="" method="post">' .
            wpwebapp_form_field_submit( 'wpwebapp-delete-account-submit', $submit_class, $submit_text, 'wpwebapp-delete-account-process-nonce', 'wpwebapp-delete-account-process' ) .
        '</form>';

    return $form;

}
add_shortcode( 'wpwa_delete_account_form', 'wpwebapp_form_delete_account' );



// Process Delete Account Form
function wpwebapp_process_delete_account() {
    if ( isset( $_POST['wpwebapp-delete-account-process'] ) ) {
        if ( wp_verify_nonce( $_POST['wpwebapp-delete-account-process'], 'wpwebapp-delete-account-process-nonce' ) ) {

            // Delete account variables
            require_once(ABSPATH.'wp-admin/includes/user.php' );
            $current_user = wp_get_current_user();
            $redirect = esc_url_raw( wpwebapp_get_delete_account_url() );

            // Delete current user's account
            wp_delete_user( $current_user->ID );
            wp_safe_redirect( $redirect, 302 );
            exit;

        } else {
            die( 'Security check' );
        }
    }
}
add_action('init', 'wpwebapp_process_delete_account');

?>