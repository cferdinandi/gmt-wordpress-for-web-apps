<?php

/* ======================================================================

	WordPress for Web Apps Password Change Form
	Functions to create and process the password reset form.

 * ====================================================================== */


// Create & Display Change Password Form
function wpwebapp_form_email_change() {

	if ( is_user_logged_in() ) {

		// Variables
		global $current_user;
		get_currentuserinfo();
		$user_id = $current_user->ID;
		$user_data = get_userdata( $user_id );
		$alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_email_change' ) );
		$submit_text = stripslashes( wpwebapp_get_email_change_text() );
		$submit_class = esc_attr( wpwebapp_get_form_button_class_email_change() );
		$email =  $user_data->user_email;
		$custom_layout = stripslashes( wpwebapp_get_email_change_custom_layout() );

		if ( $custom_layout === '' ) {
			$form =
				$alert .
				'<form class="form-wpwebapp" id="wpwebapp-form-email-change" name="wpwebapp-form-email-change" action="" method="post">' .
					wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-email', __( 'Email', 'wpwebapp' ), $email ) .
					wpwebapp_form_field_text_input_plus( 'password', 'wpwebapp-pw', __( 'Password', 'wpwebapp' ) ) .
					wpwebapp_form_field_submit_plus( 'wpwebapp-change-email-submit', $submit_class, $submit_text, 'wpwebapp-change-email-process-nonce', 'wpwebapp-change-email-process' ) .
				'</form>';
		} else {
			$add_fields = array(
				'%alert' => $alert,
				'%email' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-email', __( 'Email', 'wpwebapp' ), $email ),
				'%password' => wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw', __( 'Password', 'wpwebapp' ) ),
				'%submit' => wpwebapp_form_field_submit( 'wpwebapp-change-email-submit', $submit_class, $submit_text, 'wpwebapp-change-email-process-nonce', 'wpwebapp-change-email-process' ),
			);
			$custom_layout = strtr( $custom_layout, $add_fields );
			$form =
				'<form class="form-wpwebapp" id="wpwebapp-form-email-change" name="wpwebapp-form-email-change" action="" method="post">' .
					$custom_layout .
				'</form>';
		}


	} else {
		$form = '<p>' . __( 'You must be logged in to change your email.', 'wpwebapp' ) . '</p>';
	}

	return $form;

}
add_shortcode( 'wpwa_email_change_form', 'wpwebapp_form_email_change' );


// Process Change Password Form
function wpwebapp_process_email_change() {
	if ( isset( $_POST['wpwebapp-change-email-process'] ) ) {
		if ( wp_verify_nonce( $_POST['wpwebapp-change-email-process'], 'wpwebapp-change-email-process-nonce' ) ) {

			// Password change variables
			global $current_user;
			get_currentuserinfo();
			$referer = esc_url_raw( wpwebapp_get_url() );
			$user_id = $current_user->ID;
			$user_pw = $current_user->user_pass;
			$email = sanitize_email( $_POST['wpwebapp-email'] );
			$pw = wp_filter_nohtml_kses( $_POST['wpwebapp-pw'] );

			// Alert Messages
			$alert_all_fields = wpwebapp_get_alert_empty_fields();
			$alert_incorrect_pw = wpwebapp_get_alert_pw_incorrect();
			$alert_email_success = wpwebapp_get_alert_email_change_success();

			// Validate and authenticate passwords
			if ( $email === '' || $pw === '' ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_email_change', $alert_all_fields );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( !wp_check_password( $pw, $user_pw, $user_id ) ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_email_change', $alert_incorrect_pw );
				wp_safe_redirect( $referer, 302 );
				exit;
			}

			// If no errors exist, change the password
			wp_update_user( array( 'ID' => $user_id, 'user_email' => $email ) );
			wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_email_change', $alert_email_success );
			wp_safe_redirect( $referer, 302 );
			exit;

		} else {
			die( 'Security check' );
		}
	}
}
add_action('init', 'wpwebapp_process_email_change');

?>