<?php

/* ======================================================================

	WordPress for Web Apps Password Change Form
	Functions to create and process the password reset form.

 * ====================================================================== */


// Create & Display Change Password Form
function wpwebapp_form_pw_change() {

	if ( is_user_logged_in() ) {

		// Variables
		$alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change' ) );
		$submit_text = stripslashes( wpwebapp_get_pw_change_text() );
		$submit_class = esc_attr( wpwebapp_get_form_button_class_pw_change() );
		$pw_requirements = stripslashes( wpwebapp_get_pw_requirements_text() );
		$custom_layout = stripslashes( wpwebapp_get_pw_change_custom_layout() );

		if ( wpwebapp_get_disable_pw_confirm_field() === 'off' ) {
			$field_pw_confirm = wpwebapp_form_field_text_input_plus( 'password', 'wpwebapp-pw-new-2', __( 'Confirm New Password', 'wpwebapp' ) );
		} else {
			$field_pw_confirm = '';
		}

		if ( $custom_layout === '' ) {
			$form =
				$alert .
				'<form class="form-wpwebapp" id="wpwebapp-form-pw-change" name="wpwebapp-form-pw-change" action="" method="post">' .
					wpwebapp_form_field_text_input_plus( 'password', 'wpwebapp-pw-current', __( 'Current Password', 'wpwebapp' ) ) .
					wpwebapp_form_field_text_input_plus( 'password', 'wpwebapp-pw-new-1', sprintf( __( 'New Password %s', 'wpwebapp' ), $pw_requirements ) ) .
					$field_pw_confirm .
					wpwebapp_form_field_submit_plus( 'wpwebapp-change-pw-submit', $submit_class, $submit_text, 'wpwebapp-change-pw-process-nonce', 'wpwebapp-change-pw-process' ) .
				'</form>';
		} else {
			$add_fields = array(
				'%alert' => $alert,
				'%pw-current' => wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw-current', __( 'Current Password', 'wpwebapp' ) ),
				'%pw-new' => wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw-new-1', sprintf( __( 'New Password %s', 'wpwebapp' ), $pw_requirements ) ),
				'%pw-confirm' => wpwebapp_form_field_text_input( 'password', 'wpwebapp-pw-new-2', __( 'Confirm New Password', 'wpwebapp' ) ),
				'%submit' => wpwebapp_form_field_submit( 'wpwebapp-change-pw-submit', $submit_class, $submit_text, 'wpwebapp-change-pw-process-nonce', 'wpwebapp-change-pw-process' ),
			);
			$custom_layout = strtr( $custom_layout, $add_fields );
			$form =
				'<form class="form-wpwebapp" id="wpwebapp-form-pw-change" name="wpwebapp-form-pw-change" action="" method="post">' .
					$custom_layout .
				'</form>';
		}

	} else {
		$form = '<p>' . __( 'You must be logged in to change a password.', 'wpwebapp' ) . '</p>';
	}

	return $form;

}
add_shortcode( 'wpwa_pw_change_form', 'wpwebapp_form_pw_change' );


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
			$disable_pw_confirm = wpwebapp_get_disable_pw_confirm_field();
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
			if ( $pw_current === '' || $pw_new_1 === '' || ( $disable_pw_confirm === 'off' && $pw_new_2 === '' ) ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_empty_fields );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( !wp_check_password( $pw_current, $user_pw, $user_id ) ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_pw_incorrect );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( $disable_pw_confirm === 'off' && $pw_new_1 !== $pw_new_2 ) {
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

?>