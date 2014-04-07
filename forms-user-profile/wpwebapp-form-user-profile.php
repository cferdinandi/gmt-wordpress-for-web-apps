<?php

/* ======================================================================

	WordPress for Web Apps Password Change Form
	Functions to create and process the password reset form.

 * ====================================================================== */

// Display user gravatar
function wpwebapp_display_gravatar( $atts ) {
	extract(shortcode_atts(array(
		'size' => wpwebapp_get_gravatar_size(),
	), $atts));
	global $current_user;
	$user_id = $current_user->ID;
	return get_avatar( $user_id, $size );
}
add_shortcode( 'wpwa_display_gravatar', 'wpwebapp_display_gravatar' );


// Create & Display Change Password Form
function wpwebapp_form_user_profile() {

	// Variables
	$alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_user_profile' ) );
	$submit_text = stripslashes( wpwebapp_get_user_profile_text() );
	$submit_class = esc_attr( wpwebapp_get_form_button_class_user_profile() );
	$profile_fields = wpwebapp_get_user_profile_field_types();
	$contact_label = esc_attr( wpwebapp_get_contact_info_label() );

	$form =
		$alert .
		'<form class="form-wpwebapp" id="wpwebapp-form-user-profile" name="wpwebapp-form-user-profile" action="" method="post">' .
			// fields
			wpwebapp_form_field_submit( 'wpwebapp-update-profile-submit', $submit_class, $submit_text, 'wpwebapp-update-profile-process-nonce', 'wpwebapp-update-profile-process', '4' ) .
		'</form>';

	return $form;

}
add_shortcode( 'wpwa_user_profile_form', 'wpwebapp_form_user_profile' );


// // Process Change Password Form
// function wpwebapp_process_update_profile() {
// 	if ( isset( $_POST['wpwebapp-update-profile-process'] ) ) {
// 		if ( wp_verify_nonce( $_POST['wpwebapp-update-profile-process'], 'wpwebapp-update-profile-process-nonce' ) ) {

// 			// Password change variables
// 			global $current_user;
// 			get_currentuserinfo();
// 			$referer = esc_url_raw( wpwebapp_get_url() );
// 			$user_id = $current_user->ID;
// 			$user_pw = $current_user->user_pass;
// 			$pw_current = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-current'] );
// 			$pw_new_1 = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-new-1'] );
// 			$pw_new_2 = wp_filter_nohtml_kses( $_POST['wpwebapp-pw-new-2'] );
// 			$pw_test = wpwebapp_password_meets_requirements( $pw_new_1 );

// 			// Alert Messages
// 			$alert_empty_fields = wpwebapp_get_alert_empty_fields();
// 			$alert_pw_incorrect = wpwebapp_get_alert_pw_incorrect();
// 			$alert_pw_match = wpwebapp_get_alert_pw_match();
// 			$alert_pw_requirements = wpwebapp_get_alert_pw_requirements();
// 			$alert_pw_change_success = wpwebapp_get_alert_pw_change_success();

// 			// Validate and authenticate passwords
// 			if ( $pw_current == '' || $pw_new_1 == '' || $pw_new_2 == '' ) {
// 				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_empty_fields );
// 				wp_safe_redirect( $referer, 302 );
// 				exit;
// 			} else if ( !wp_check_password( $pw_current, $user_pw, $user_id ) ) {
// 				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_pw_incorrect );
// 				wp_safe_redirect( $referer, 302 );
// 				exit;
// 			} else if ( $pw_new_1 != $pw_new_2 ) {
// 				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_pw_match );
// 				wp_safe_redirect( $referer, 302 );
// 				exit;
// 			} else if ( !$pw_test ) {
// 				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_pw_requirements );
// 				wp_safe_redirect( $referer, 302 );
// 				exit;
// 			}

// 			// If no errors exist, change the password
// 			wp_update_user( array( 'ID' => $user_id, 'user_pass' => $pw_new_1 ) );
// 			wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_pw_change', $alert_pw_change_success );
// 			wp_safe_redirect( $referer, 302 );
// 			exit;

// 		} else {
// 			die( 'Security check' );
// 		}
// 	}
// }
// add_action('init', 'wpwebapp_process_pw_change');

?>