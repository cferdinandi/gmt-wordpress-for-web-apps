<?php


	/**
	 * Test whether or not password meets security requirements
	 * @param  string $password Password to test
	 * @return boolen           Returns true if it meets te requirements
	 */
	function wpwebapp_test_password_requirements( $password ) {

		// Variables
		$options = wpwebapp_get_theme_options_security();

		// Test the password
		if ( strlen( $password ) < $options['password_minimum_length'] ) return false;
		if ( $options['password_requires_letters'] === 'on' && !wpwebapp_has_letters( $password ) ) return false;
		if ( $options['password_requires_numbers'] === 'on' && !wpwebapp_has_numbers( $password ) ) return false;
		if ( $options['password_requires_special_characters'] === 'on' && !wpwebapp_has_special_chars( $password ) ) return false;
		if ( $options['password_requires_mixed_case'] === 'on' && !wpwebapp_has_mixed_case( $password ) ) return false;
		return true;

	}


	/**
	 * Create password requirements string
	 * @return string  The password requirements
	 */
	function wpwebapp_password_requirements_message() {

		// Variables
		$options = wpwebapp_get_theme_options_security();
		$length = $options['password_requires_mixed_case'] === 'on' && intval( $options['password_minimum_length'] ) < 2 ? 2 : $options['password_minimum_length'];

		// Message
		if ( $options['password_requires_mixed_case'] === 'on' && $options['password_requires_numbers'] === 'on' && $options['password_requires_special_characters'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character, and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_mixed_case'] === 'on' && $options['password_requires_numbers'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 uppercase letter, 1 lowercase letter, and 1 number, and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_mixed_case'] === 'on' && $options['password_requires_special_characters'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 uppercase letter, 1 lowercase letter, and 1 special character, and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_letters'] === 'on' && $options['password_requires_numbers'] === 'on' && $options['password_requires_special_characters'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 letter, 1 number, and 1 special character, and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_mixed_case'] === 'on' && $options['password_requires_numbers'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 uppercase letter, 1 lowercase letter, and 1 number, and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_mixed_case'] === 'on' && $options['password_requires_special_characters'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 uppercase letter, 1 lowercase letter, and 1 special character, and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_letters'] === 'on' && $options['password_requires_numbers'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 letter and 1 number, and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_letters'] === 'on' && $options['password_requires_special_characters'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 letter and 1 special character, and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_numbers'] === 'on' && $options['password_requires_special_characters'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 number and 1 special character, and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_mixed_case'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 uppercase letter and 1 lowercase letter, and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_letters'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 letter and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_numbers'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 number and be at least $s characters long.' , 'wpwebapp') , $length);
		} elseif ( $options['password_requires_special_characters'] === 'on' ) {
			$message = sprintf( __( 'Password must contain at least 1 special character and be at least $s characters long.' , 'wpwebapp') , $length);
		} else {
			$message = sprintf( __( 'Password must be at least $s characters long.' , 'wpwebapp') , $length);
		}

		return $message;

	}


	/**
	 * Create custom user profile fields to force password reset
	 * @param  object $user The user
	 */
	function wpwebapp_security_add_user_fields( $user ) {

		// Don't load for admins
		if ( user_can( $user, 'edit_themes' ) ) return;

		// Get user's forced password reset status
		$force_reset = empty($user) || !is_object( $user ) ? null : get_the_author_meta( 'wpwebapp_force_password_reset', $user->ID );

		// Get options
		$options = wpwebapp_get_theme_options_redirects();

		?>

		<h3><?php _e( 'Security', 'wpwebapp' ); ?></h3>

		<table class="form-table">

			<tr>
				<th><?php _e( 'Force Password Reset', 'wpwebapp' ); ?></th>

				<td>
					<?php if ( empty( $options['password_reset_redirect'] ) ) : ?>
						<div class="error notice">
							<p>You have not specified a <a href="options-general.php?page=wpwebapp_plugin_options">forced password reset redirect URL</a> yet. The "Force Password Reset" feature will not work unless you do.</p>
						</div>
					<?php endif; ?>
					<label>
						<input type="checkbox" name="wpwebapp_force_password_reset" id="wpwebapp_force_password_reset" value="on" <?php checked( $force_reset, 'on' ); ?>>
						<?php _e( 'Force user to reset their password at next login', 'wpwebapp' ); ?>
					</label>
				</td>
			</tr>

		</table>

		<?php
	}
	add_action( 'show_user_profile', 'wpwebapp_security_add_user_fields' );
	add_action( 'edit_user_profile', 'wpwebapp_security_add_user_fields' );
	add_action( 'user_new_form', 'wpwebapp_security_add_user_fields' );



	/**
	 * Save custom user field
	 * @param  integer $user_id The user ID
	 */
	function wpwebapp_security_save_user_fields( $user_id ) {

		// Security check
		if ( !current_user_can( 'edit_user', $user_id ) ) return false;

		// Update force reset status
		if ( isset( $_POST['wpwebapp_force_password_reset'] ) )  {
			update_user_meta( $user_id, 'wpwebapp_force_password_reset', 'on' );
		} else {
			update_user_meta( $user_id, 'wpwebapp_force_password_reset', 'off' );
		}

	}
	add_action( 'personal_options_update', 'wpwebapp_security_save_user_fields' );
	add_action( 'edit_user_profile_update', 'wpwebapp_security_save_user_fields' );
	add_action( 'user_register', 'wpwebapp_security_save_user_fields' );


	/**
	 * Force password reset when user logs in
	 */
	function wpwebapp_force_password_reset_on_login() {

		// Don't run for logged-out users or admin
		if ( !is_user_logged_in() || current_user_can( 'edit_themes' ) ) return;

		// Get user forced password reset status
		$current_user = wp_get_current_user();
		$force_reset = get_user_meta( $current_user->ID, 'wpwebapp_force_password_reset', true );

		// Don't run if password reset isn't required
		if ( $force_reset !== 'on' ) return;

		// Check that current page isn't the change password page
		$options = wpwebapp_get_theme_options_redirects();
		if ( empty( $options['password_reset_redirect'] ) || is_page( $options['password_reset_redirect'] ) ) return;

		// Redirect to change password
		wp_safe_redirect( wpwebapp_get_redirect_url( $options['password_reset_redirect'], $options['add_redirect_referrer'] ), 302 );
		exit;

	}
	add_action( 'wp', 'wpwebapp_force_password_reset_on_login' );