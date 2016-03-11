<?php

/**
 * Security
 */


	// Test whether or not password meets security requirements
	function wpwebapp_test_password_requirements( $password ) {

		// Variables
		$options = wpwebapp_get_theme_options();

		// Test the password
		if ( strlen( $password ) < $options['password_minimum_length'] ) return false;
		if ( $options['password_requires_letters'] === 'on' && !wpwebapp_has_letters( $password ) ) return false;
		if ( $options['password_requires_numbers'] === 'on' && !wpwebapp_has_numbers( $password ) ) return false;
		if ( $options['password_requires_special_characters'] === 'on' && !wpwebapp_has_special_chars( $password ) ) return false;
		return true;

	}

	// Create password requirements string
	function wpwebapp_password_requirements_message() {

		// Variables
		$options = wpwebapp_get_theme_options();

		// Message
		if ( $options['password_requires_letters'] === 'on' && $options['password_requires_numbers'] === 'on' && $options['password_requires_special_characters'] === 'on' ) {
			$message = 'Password must contain at least 1 letter, 1 number, and 1 special character, and be at least ' . $options['password_minimum_length'] . ' characters long.';
		} else if ( $options['password_requires_letters'] === 'on' && $options['password_requires_numbers'] === 'on' ) {
			$message = 'Password must contain at least 1 letter and 1 number, and be at least ' . $options['password_minimum_length'] . ' characters long.';
		} else if ( $options['password_requires_numbers'] === 'on' && $options['password_requires_special_characters'] === 'on' ) {
			$message = 'Password must contain at least 1 number and 1 special character, and be at least ' . $options['password_minimum_length'] . ' characters long.';
		} else if ( $options['password_requires_letters'] === 'on' && $options['password_requires_special_characters'] === 'on' ) {
			$message = 'Password must contain at least 1 letter and 1 special character, and be at least ' . $options['password_minimum_length'] . ' characters long.';
		} else if ( $options['password_requires_letters'] === 'on' ) {
			$message = 'Password must contain at least 1 letter and be at least ' . $options['password_minimum_length'] . ' characters long.';
		} else if ( $options['password_requires_numbers'] === 'on' ) {
			$message = 'Password must contain at least 1 number and be at least ' . $options['password_minimum_length'] . ' characters long.';
		} else if ( $options['password_requires_special_characters'] === 'on' ) {
			$message = 'Password must contain at least 1 special character and be at least ' . $options['password_minimum_length'] . ' characters long.';
		} else {
			$message = 'Password must be at least ' . $options['password_minimum_length'] . ' characters long.';
		}

		return $message;

	}