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