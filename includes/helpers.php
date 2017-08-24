<?php

/**
 * Helper Methods
 */


	/**
	 * WP Session Helpers
	 */

	// Set session data
	function wpwebapp_set_session( $name, $value, $sanitize = null ) {

		// Start session
		$wp_session = WP_Session::get_instance();

		// Sanitize data
		if ( $sanitize === 'post' ) {
			$value = wp_filter_post_kses( $value );
		} elseif ( $sanitize === 'nohtml' ) {
			$value = wp_filter_nohtml_kses( $value );
		}

		// Store session value
		$wp_session[$name] = $value;

	}

	// Get session data
	function wpwebapp_get_session( $name, $unset = false ) {

		// Start session
		$wp_session = WP_Session::get_instance();

		// Store session value
		$value = $wp_session[$name];

		// If value is array, transform it
		if ( is_object( $value ) ) {
			$value->toArray();
		}

		// Unset session value
		if ( $unset ) {
			unset( $wp_session[$name] );
		}

		return $value;

	}

  // Prepare field classes
  function wpwebapp_prepare_field_classes() {

    $field_classes = array(
      "form"                        => "wpwebapp-form",
      "form_alert"                  => "wpwebapp-alert",
      "form_alert_error"            => "wpwebapp-alert-error",
      "form_alert_success"          => "wpwebapp-alert-success",
      "form_submit"                 => "wpwebapp-form-button",
      "form_submit_delete_account"  => "wpwebapp-form-button-delete-account",
      "form_submit_email_change"    => "wpwebapp-form-button-email-change",
      "form_submit_login"           => "wpwebapp-form-button-login",
      "form_submit_password_change" => "wpwebapp-form-button-password-change",
      "form_submit_password_reset"  => "wpwebapp-form-button-password-reset",
      "form_submit_signup"          => "wpwebapp-form-button-signup",
      "form_group"                  => "",
      "field_label"                 => "wpwebapp-form-label",
      "field_label_checkbox"        => "wpwebapp-form-label-checkbox",
      "field_label_honeypot"        => "wpwebapp-form-label-tarpit",
      "field"                       => "wpwebapp-form-input",
      "field_password"              => "wpwebapp-form-password",
      "field_checkbox"              => "wpwebapp-form-checkbox",
      "field_honeypot"              => "wpwebapp-form-input-tarpit",
      "field_required_tag"          => "wpwebapp-form-input-required",
      "field_caption"               => "wpwebapp-form-label-description",
    );

    if ( has_filter('wpwebapp_render_field_classes') ) {
      $new_field_classes = apply_filters( 'wpwebapp_render_field_classes', $field_classes );
      $field_classes = array_replace( $field_classes, $new_field_classes );
    }

    return $field_classes;
  }



	/**
	 * URL Helpers
	 * Get, sanitize, and process URLs.
	 */

	// Get and sanitize the current URL
	function wpwebapp_get_url() {
		$url  = @( $_SERVER['HTTPS'] != 'on' ) ? 'http://' . $_SERVER['SERVER_NAME'] :  'https://' . $_SERVER['SERVER_NAME'];
		$url .= ( $_SERVER['SERVER_PORT'] !== 80 ) ? ":" . $_SERVER['SERVER_PORT'] : '';
		$url .= $_SERVER['REQUEST_URI'];
		return $url;
	}

	// Get the site domain and remove the www.
	function wpwebapp_get_site_domain() {
		$sitename = strtolower( $_SERVER['SERVER_NAME'] );
		if ( substr( $sitename, 0, 4 ) == 'www.' ) {
			$sitename = substr( $sitename, 4 );
		}
		return $sitename;
	}

	// Prepare URL for status string
	function wpwebapp_prepare_url( $url ) {

		// If URL has a '?', add an '&'.
		// Otherwise, add a '?'.
		$url_status = strpos($url, '?');
		if ( $url_status === false ) {
			$concate = '?';
		}
		else {
			$concate = '&';
		}

		return $url . $concate;

	}

	// Remove a $_GET variable from the URL
	function wpwebapp_clean_url( $variable, $url ) {
		$new_url = preg_replace('/(?:&|(\?))' . $variable . '=[^&]*(?(1)&|)?/i', '$1', $url);
		$last_char = substr( $new_url, -1 );
		if ( $last_char == '?' ) {
			$new_url = substr($new_url, 0, -1);
		}
		return $new_url;
	}

	// Get the proper redirect URL
	function wpwebapp_get_redirect_url( $id, $refer = 'off' ) {
		$url = $id === 0 || $id === '0' ? get_home_url() : get_permalink( $id );
		if ( $refer === 'on' ) {
			$url = wpwebapp_prepare_url( $url ) . 'referrer=' . wpwebapp_get_url();
		}
		return esc_url_raw( $url );
	}

	// Set a password reset key
	function wpwebapp_set_reset_key( $user_id, $url, $expires ) {

		// Add a secret, temporary key to the database
		$key = wp_generate_password( 48, false );
		set_transient( 'wpwebapp_forgot_password_key_' . $key . $user_id, $key, 60 * 60 * $expires );

		// Return a URL with the reset key
		return wpwebapp_prepare_url( $url ) . 'reset_pw=' . $key . $user_id;
	}



	/**
	 * String tests
	 * Test strings for letters, numbers, and special characters.
	 * @link http://stackoverflow.com/a/9588010/1293256
	 */

	// Does string contain letter?
	function wpwebapp_has_letters( $string ) {
		return preg_match( '/[a-zA-Z]/', $string );
	}

	// Does string contain numbers?
	function wpwebapp_has_numbers( $string ) {
		return preg_match( '/\d/', $string );
	}

	// Does string contain special characters?
	function wpwebapp_has_special_chars( $string ) {
		return preg_match('/[^a-zA-Z\d]/', $string);
	}

	// Does string contain mixed case?
	function wpwebapp_has_mixed_case( $string ) {
		if ( empty( preg_match('/[a-z]/', $string) ) ) return false;
		if ( empty( preg_match('/[A-Z]/', $string) ) ) return false;
		return true;
	}
