<?php

/**
 * Theme Options v1.1.0
 * Adjust theme settings from the admin dashboard.
 * Find and replace `YourTheme` with your own namepspacing.
 *
 * Created by Michael Fields.
 * https://gist.github.com/mfields/4678999
 *
 * Forked by Chris Ferdinandi
 * http://gomakethings.com
 *
 * Free to use under the MIT License.
 * http://gomakethings.com/mit/
 */


	/**
	 * Theme Options Fields
	 * Each option field requires its own uniquely named function. Select options and radio buttons also require an additional uniquely named function with an array of option choices.
	 */

	// Create a select menu with all the current pages
	function wpwebapp_settings_create_pages_select_fields( $selected ) {
		$pages = get_pages(
			array(
				'sort_order' => 'asc',
				'sort_column' => 'post_title',
				'post_type' => 'page',
				'post_status' => 'publish'
			)
		);
		?>
			<?php foreach( $pages as $key => $page ) : ?>
				<option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $page->ID, $selected ); ?>><?php echo esc_html( $page->post_title ); ?></option>
			<?php endforeach; ?>
		<?php
	}


	// Alert classes
	function wpwebapp_settings_field_alert_classes() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[alert_success_class]" id="alert_success_class" value="<?php echo esc_attr( $options['alert_success_class'] ); ?>" />
			<label class="description" for="alert_success_class"><?php _e( 'Classe(s) for alert messages when successfully completing tasks (like updating an email or password) [optional]', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[alert_error_class]" id="alert_error_class" value="<?php echo esc_attr( $options['alert_error_class'] ); ?>" />
			<label class="description" for="alert_error_class"><?php _e( 'Classe(s) for alert messages when failing to complete tasks (like updating an email or password) [optional]', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Sign up form labels
	function wpwebapp_settings_field_signup_form_labels() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[signup_username_label]" id="signup_username_label" value="<?php echo stripslashes( esc_attr( $options['signup_username_label'] ) ); ?>" />
			<label class="description" for="signup_username_label"><?php _e( 'Sign up form "Username" field label', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[signup_email_label]" id="signup_email_label" value="<?php echo stripslashes( esc_attr( $options['signup_email_label'] ) ); ?>" />
			<label class="description" for="signup_email_label"><?php _e( 'Sign up form "Email" field label', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[signup_password_label]" id="signup_password_label" value="<?php echo stripslashes( esc_attr( $options['signup_password_label'] ) ); ?>" />
			<label class="description" for="signup_password_label"><?php _e( 'Sign up form "Password" field label', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Sign up form submit button
	function wpwebapp_settings_field_signup_form_submit() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[signup_submit_text]" id="signup_submit_text" value="<?php echo esc_attr( $options['signup_submit_text'] ); ?>" />
			<label class="description" for="signup_submit_text"><?php _e( 'Sign up form "Submit" button text', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[signup_submit_class]" id="signup_submit_class" value="<?php echo esc_attr( $options['signup_submit_class'] ); ?>" />
			<label class="description" for="signup_submit_class"><?php _e( 'Sign up form "Submit" button classes [optional]', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Sign up form error messages
	function wpwebapp_settings_field_signup_form_errors() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[signup_username_field_empty_error]" class="large-text" id="signup_username_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['signup_username_field_empty_error'] ) ); ?>" />
			<label class="description" for="signup_username_field_empty_error"><?php _e( 'Error when no username is provided on the sign up form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[signup_email_field_empty_error]" class="large-text" id="signup_email_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['signup_email_field_empty_error'] ) ); ?>" />
			<label class="description" for="signup_email_field_empty_error"><?php _e( 'Error when no email is provided on the sign up form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[signup_password_field_empty_error]" class="large-text" id="signup_password_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['signup_password_field_empty_error'] ) ); ?>" />
			<label class="description" for="signup_password_field_empty_error"><?php _e( 'Error when no password is provided on the sign up form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[signup_username_invalid_error]" class="large-text" id="signup_username_invalid_error" value="<?php echo stripslashes( esc_attr( $options['signup_username_invalid_error'] ) ); ?>" />
			<label class="description" for="signup_username_invalid_error"><?php _e( 'Error when username provided on the sign up form contains invalid characters', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[signup_username_exists_error]" class="large-text" id="signup_username_exists_error" value="<?php echo stripslashes( esc_attr( $options['signup_username_exists_error'] ) ); ?>" />
			<label class="description" for="signup_username_exists_error"><?php _e( 'Error when username provided on the sign up form already exists', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[signup_email_invalid_error]" class="large-text" id="signup_email_invalid_error" value="<?php echo stripslashes( esc_attr( $options['signup_email_invalid_error'] ) ); ?>" />
			<label class="description" for="signup_email_invalid_error"><?php _e( 'Error when email provided on the sign up form is invalid', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[signup_email_exists_error]" class="large-text" id="signup_email_exists_error" value="<?php echo stripslashes( esc_attr( $options['signup_email_exists_error'] ) ); ?>" />
			<label class="description" for="signup_email_exists_error"><?php _e( 'Error when email provided on the sign up form already exists', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[signup_login_failed_error]" class="large-text" id="signup_login_failed_error" value="<?php echo stripslashes( esc_attr( $options['signup_login_failed_error'] ) ); ?>" />
			<label class="description" for="signup_login_failed_error"><?php _e( 'Error when signup fails', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Sign up form notifications to site admins
	function wpwebapp_settings_field_signup_form_notifications_to_admin() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<label for="signup_receive_notifications">
				<input type="checkbox" name="wpwebapp_theme_options[signup_receive_notifications]" id="signup_receive_notifications" <?php checked( 'on', $options['signup_receive_notifications'] ); ?> />
				<?php _e( 'Send admins a notification when a new user signs up', 'wpwebapp' ); ?>
			</label>
		</div>
		<br>

		<div>
			<textarea name="wpwebapp_theme_options[signup_notification_to_admin]" class="large-text" id="signup_notification_to_admin" cols="50" rows="10"><?php echo stripslashes( esc_textarea( $options['signup_notification_to_admin'] ) ); ?></textarea>
			<label for="signup_notification_to_admin">
				<?php printf( __( 'The email to send to site admins when new users sign up. Use %s to dynamically add their username, and %s to dynamically add their email address.', 'wpwebapp' ), '<code>[username]</code>', '<code>[email]</code>'  ); ?>
			</label>
		</div>
		<?php
	}

	// Sign up form notifications to users
	function wpwebapp_settings_field_signup_form_notifications_to_user() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<label for="signup_send_notifications">
				<input type="checkbox" name="wpwebapp_theme_options[signup_send_notifications]" id="signup_send_notifications" <?php checked( 'on', $options['signup_send_notifications'] ); ?> />
				<?php _e( 'Send new users a welcome email when they sign up', 'wpwebapp' ); ?>
			</label>
		</div>
		<br>

		<div>
			<textarea name="wpwebapp_theme_options[signup_notification_to_user]" class="large-text" id="signup_notification_to_user" cols="50" rows="10"><?php echo stripslashes( esc_textarea( $options['signup_notification_to_user'] ) ); ?></textarea>
			<label for="signup_notification_to_user">
				<?php printf( __( 'The email to send to new users after they sign up. Use %s to dynamically add their username, and %s to dynamically add the log in URL.', 'wpwebapp' ), '<code>[username]</code>', '<code>[login]</code>'  ); ?>
			</label>
		</div>
		<?php
	}

	// Forgot password form time limit
	function wpwebapp_settings_field_create_user_password_time_limit() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="number" min="1" name="wpwebapp_theme_options[create_user_password_time_valid]" class="small-text" id="create_user_password_time_valid" value="<?php echo esc_attr( $options['create_user_password_time_valid'] ); ?>" />
			<label class="description" for="create_user_password_time_valid"><?php _e( 'Time (in hours) that a manually created new user "create a password" link is good for', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Create user notifications to user
	function wpwebapp_settings_field_create_user_notifications_to_user() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<label for="create_user_send_notifications">
				<input type="checkbox" name="wpwebapp_theme_options[create_user_send_notifications]" id="create_user_send_notifications" <?php checked( 'on', $options['create_user_send_notifications'] ); ?> />
				<?php _e( 'Send new users a welcome email when accounts are created manually in the WordPress Dashboard', 'wpwebapp' ); ?>
			</label>
		</div>
		<br>

		<div>
			<textarea name="wpwebapp_theme_options[create_user_notification]" class="large-text" id="create_user_notification" cols="50" rows="10"><?php echo stripslashes( esc_textarea( $options['create_user_notification'] ) ); ?></textarea>
			<label for="create_user_notification">
				<?php printf( __( 'The email to send to users when an account is created for them in the WordPress Dashboard. Use %s to dynamically add their username, and %s to dynamically add a link to your password reset form (only works if a page for this form has been specified). Use %s to include the number of hours their "create a new password" URL is good for.', 'wpwebapp' ), '<code>[username]</code>', '<code>[pw_reset]</code>', '<code>[expires]</code>'  ); ?>
			</label>
		</div>
		<?php
	}

	// Login form labels
	function wpwebapp_settings_field_login_form_labels() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[login_username_label]" id="login_username_label" value="<?php echo stripslashes( esc_attr( $options['login_username_label'] ) ); ?>" />
			<label class="description" for="login_username_label"><?php _e( 'Login form "Username" label', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[login_password_label]" id="login_password_label" value="<?php echo stripslashes( esc_attr( $options['login_password_label'] ) ); ?>" />
			<label class="description" for="login_password_label"><?php _e( 'Login form "Password" label', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[login_rememberme_label]" id="login_rememberme_label" value="<?php echo stripslashes( esc_attr( $options['login_rememberme_label'] ) ); ?>" />
			<label class="description" for="login_rememberme_label"><?php _e( 'Login form "Remember Me" label', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Login form submit button
	function wpwebapp_settings_field_login_form_submit() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[login_submit_text]" id="login_submit_text" value="<?php echo esc_attr( $options['login_submit_text'] ); ?>" />
			<label class="description" for="login_submit_text"><?php _e( 'Login form "Submit" button text', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[login_submit_class]" id="login_submit_class" value="<?php echo esc_attr( $options['login_submit_class'] ); ?>" />
			<label class="description" for="login_submit_class"><?php _e( 'Login form "Submit" button classes [optional]', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Login form error messages
	function wpwebapp_settings_field_login_form_errors() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[login_username_field_empty_error]" class="large-text" id="login_username_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['login_username_field_empty_error'] ) ); ?>" />
			<label class="description" for="login_username_field_empty_error"><?php _e( 'Error when no username is provided on the login form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[login_password_field_empty_error]" class="large-text" id="login_password_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['login_password_field_empty_error'] ) ); ?>" />
			<label class="description" for="login_password_field_empty_error"><?php _e( 'Error when no password is provided on the login form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[login_failed_error]" class="large-text" id="login_failed_error" value="<?php echo stripslashes( esc_attr( $options['login_failed_error'] ) ); ?>" />
			<label class="description" for="login_failed_error"><?php _e( 'Error when login fails', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Login/logout redirect URLs
	function wpwebapp_settings_field_login_logout_redirects() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<label class="description" for="login_redirect"><?php _e( 'URL to redirect users to after they log in:', 'wpwebapp' ); ?></label><br>
			<select name="wpwebapp_theme_options[login_redirect]" id="login_redirect" >
				<option value="0" <?php selected( '0', $options['login_redirect'] ); ?>><?php _e( 'Home', 'wpwebapp' ) ?></option>
				<?php wpwebapp_settings_create_pages_select_fields( $options['login_redirect'] ); ?>
			</select>
		</div>
		<br>

		<div>
			<label class="description" for="logout_redirect"><?php _e( 'URL to redirect users to after they logout:', 'wpwebapp' ); ?></label><br>
			<select name="wpwebapp_theme_options[logout_redirect]" id="logout_redirect" >
				<option value="0" <?php selected( '0', $options['login_redirect'] ); ?>><?php _e( 'Home', 'wpwebapp' ) ?></option>
				<?php wpwebapp_settings_create_pages_select_fields( $options['logout_redirect'] ); ?>
			</select>
		</div>
		<br>

		<div>
			<label class="description" for="password_reset_redirect"><?php _e( 'URL to redirect users to for a forced password reset:', 'wpwebapp' ); ?></label><br>
			<select name="wpwebapp_theme_options[password_reset_redirect]" id="password_reset_redirect">
				<option value="" <?php selected( '', $options['password_reset_redirect'] ); ?>><?php _e( '', 'wpwebapp' ) ?></option>
				<?php wpwebapp_settings_create_pages_select_fields( $options['password_reset_redirect'] ); ?>
			</select>
		</div>
		<br>

		<div>
			<label class="description">
				<input type="checkbox" name="wpwebapp_theme_options[add_redirect_referrer]" id="add_redirect_referrer" value="on" <?php checked( $options['add_redirect_referrer'], 'on' ); ?>>
				<?php _e( 'Add a URL referrer to "Logged Out" and "Forced Password Reset" redirects', 'wpwebapp' ); ?>
			</label>
		</div>

		<?php
	}

	// Change email address form labels
	function wpwebapp_settings_field_email_change_form_labels() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[email_change_current_email_label]" id="email_change_current_email_label" value="<?php echo stripslashes( esc_attr( $options['email_change_current_email_label'] ) ); ?>" />
			<label class="description" for="email_change_current_email_label"><?php _e( 'Change email form "Email" label', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[email_change_password_label]" id="email_change_password_label" value="<?php echo stripslashes( esc_attr( $options['email_change_password_label'] ) ); ?>" />
			<label class="description" for="email_change_password_label"><?php _e( 'Change email form "Password" label', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Change email address form submit button
	function wpwebapp_settings_field_email_change_form_submit() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[email_change_submit_text]" id="email_change_submit_text" value="<?php echo esc_attr( $options['email_change_submit_text'] ); ?>" />
			<label class="description" for="email_change_submit_text"><?php _e( 'Change email form "Submit" button text', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[email_change_submit_class]" id="email_change_submit_class" value="<?php echo esc_attr( $options['email_change_submit_class'] ); ?>" />
			<label class="description" for="email_change_submit_class"><?php _e( 'Change email form "Submit" button classes [optional]', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Change email address form error messages
	function wpwebapp_settings_field_email_change_form_errors() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[email_change_email_field_empty_error]" class="large-text" id="email_change_email_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['email_change_email_field_empty_error'] ) ); ?>" />
			<label class="description" for="email_change_email_field_empty_error"><?php _e( 'Error when no email address is provided on the change email form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[email_change_password_field_empty_error]" class="large-text" id="email_change_password_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['email_change_password_field_empty_error'] ) ); ?>" />
			<label class="description" for="email_change_password_field_empty_error"><?php _e( 'Error when no password is provided on the change email form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[email_change_password_error]" class="large-text" id="email_change_password_error" value="<?php echo stripslashes( esc_attr( $options['email_change_password_error'] ) ); ?>" />
			<label class="description" for="email_change_password_error"><?php _e( 'Error when the password is incorrect on the change email form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[email_change_success]" class="large-text" id="email_change_success" value="<?php echo stripslashes( esc_attr( $options['email_change_success'] ) ); ?>" />
			<label class="description" for="email_change_success"><?php _e( 'Message when the user\'s email address is successfully changed', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Change password form labels
	function wpwebapp_settings_field_password_change_form_labels() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[password_change_current_password_label]" id="password_change_current_password_label" value="<?php echo stripslashes( esc_attr( $options['password_change_current_password_label'] ) ); ?>" />
			<label class="description" for="password_change_current_password_label"><?php _e( 'Change password form "Current Password" label', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_change_new_password_label]" id="password_change_new_password_label" value="<?php echo stripslashes( esc_attr( $options['password_change_new_password_label'] ) ); ?>" />
			<label class="description" for="password_change_new_password_label"><?php _e( 'Change password form "New Password" label', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Change password form submit button
	function wpwebapp_settings_field_password_change_form_submit() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[password_change_submit_text]" id="password_change_submit_text" value="<?php echo esc_attr( $options['password_change_submit_text'] ); ?>" />
			<label class="description" for="password_change_submit_text"><?php _e( 'Change password form "Submit" button text', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_change_submit_class]" id="password_change_submit_class" value="<?php echo esc_attr( $options['password_change_submit_class'] ); ?>" />
			<label class="description" for="password_change_submit_class"><?php _e( 'Change password form "Submit" button classes [optional]', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Change password form error messages
	function wpwebapp_settings_field_password_change_form_errors() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[password_change_forced_reset_error]" class="large-text" id="password_change_forced_reset_error" value="<?php echo stripslashes( esc_attr( $options['password_change_forced_reset_error'] ) ); ?>" />
			<label class="description" for="password_change_forced_reset_error"><?php _e( 'Error when user is forced to reset their password', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_change_current_password_field_empty_error]" class="large-text" id="password_change_current_password_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['password_change_current_password_field_empty_error'] ) ); ?>" />
			<label class="description" for="password_change_current_password_field_empty_error"><?php _e( 'Error when current password is not provided on the change password form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_change_new_password_field_empty_error]" class="large-text" id="password_change_new_password_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['password_change_new_password_field_empty_error'] ) ); ?>" />
			<label class="description" for="password_change_new_password_field_empty_error"><?php _e( 'Error when new password is not provided on the change password form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_change_password_error]" class="large-text" id="password_change_password_error" value="<?php echo stripslashes( esc_attr( $options['password_change_password_error'] ) ); ?>" />
			<label class="description" for="password_change_password_error"><?php _e( 'Error when the current password is incorrect on the change password form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_change_success]" class="large-text" id="password_change_success" value="<?php echo stripslashes( esc_attr( $options['password_change_success'] ) ); ?>" />
			<label class="description" for="password_change_success"><?php _e( 'Message when the user\'s password is successfully changed', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Forgot password page
	function wpwebapp_settings_field_password_reset_url() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<label class="description" for="password_reset_url"><?php _e( 'URL for password resets', 'wpwebapp' ); ?></label><br>
			<select name="wpwebapp_theme_options[password_reset_url]" id="password_reset_url">
				<option value="" <?php selected( '', $options['password_reset_url'] ); ?>><?php _e( '', 'wpwebapp' ) ?></option>
				<?php wpwebapp_settings_create_pages_select_fields( $options['password_reset_url'] ); ?>
			</select>
		</div>
		<?php
	}

	// Forgot password form labels
	function wpwebapp_settings_field_password_reset_form_labels() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[password_forgot_label]" id="password_forgot_label" value="<?php echo stripslashes( esc_attr( $options['password_forgot_label'] ) ); ?>" />
			<label class="description" for="password_forgot_label"><?php _e( 'Forgot password form "Username" label', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_reset_label]" id="password_reset_label" value="<?php echo stripslashes( esc_attr( $options['password_reset_label'] ) ); ?>" />
			<label class="description" for="password_reset_label"><?php _e( 'Reset password form "New Password" label', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Forgot password form submit button
	function wpwebapp_settings_field_password_reset_form_submit() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[password_forgot_submit_text]" id="password_forgot_submit_text" value="<?php echo esc_attr( $options['password_forgot_submit_text'] ); ?>" />
			<label class="description" for="password_forgot_submit_text"><?php _e( 'Forgot password form "Submit" button text', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_forgot_submit_class]" id="password_forgot_submit_class" value="<?php echo esc_attr( $options['password_forgot_submit_class'] ); ?>" />
			<label class="description" for="password_forgot_submit_class"><?php _e( 'Forgot password form "Submit" button classes [optional]', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_reset_submit_text]" id="password_reset_submit_text" value="<?php echo esc_attr( $options['password_reset_submit_text'] ); ?>" />
			<label class="description" for="password_reset_submit_text"><?php _e( 'Reset password form "Submit" button text', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_reset_submit_class]" id="password_reset_submit_class" value="<?php echo esc_attr( $options['password_reset_submit_class'] ); ?>" />
			<label class="description" for="password_reset_submit_class"><?php _e( 'Reset password form "Submit" button classes [optional]', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Forgot password form error messages
	function wpwebapp_settings_field_password_reset_form_errors() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[password_forgot_password_field_empty_error]" class="large-text" id="password_forgot_password_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['password_forgot_password_field_empty_error'] ) ); ?>" />
			<label class="description" for="password_forgot_password_field_empty_error"><?php _e( 'Error when username or email is not provided on the forgot password form', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_forgot_password_invalid_user_error]" class="large-text" id="password_forgot_password_invalid_user_error" value="<?php echo stripslashes( esc_attr( $options['password_forgot_password_invalid_user_error'] ) ); ?>" />
			<label class="description" for="password_forgot_password_invalid_user_error"><?php _e( 'Error when username or email address provided on the forgot password form do not exist', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_forgot_password_is_admin_error]" class="large-text" id="password_forgot_password_is_admin_error" value="<?php echo stripslashes( esc_attr( $options['password_forgot_password_is_admin_error'] ) ); ?>" />
			<label class="description" for="password_forgot_password_is_admin_error"><?php _e( 'Error when the username or email attempting to be reset belongs to an admin', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_forgot_password_email_error]" class="large-text" id="password_forgot_password_email_error" value="<?php echo stripslashes( esc_attr( $options['password_forgot_password_email_error'] ) ); ?>" />
			<label class="description" for="password_forgot_password_email_error"><?php _e( 'Error when the user\'s password reset fails', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_forgot_password_reset_key_expired_error]" class="large-text" id="password_forgot_password_reset_key_expired_error" value="<?php echo stripslashes( esc_attr( $options['password_forgot_password_reset_key_expired_error'] ) ); ?>" />
			<label class="description" for="password_forgot_password_reset_key_expired_error"><?php _e( 'Error when the password reset link has expired', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_forgot_password_success]" class="large-text" id="password_forgot_password_success" value="<?php echo stripslashes( esc_attr( $options['password_forgot_password_success'] ) ); ?>" />
			<label class="description" for="password_forgot_password_success"><?php _e( 'Message when the password reset link has been sent', 'wpwebapp' ); ?></label>
		</div>
		<br>

		<div>
			<input type="text" name="wpwebapp_theme_options[password_reset_password_field_empty_error]" class="large-text" id="password_reset_password_field_empty_error" value="<?php echo stripslashes( esc_attr( $options['password_reset_password_field_empty_error'] ) ); ?>" />
			<label class="description" for="password_reset_password_field_empty_error"><?php _e( 'Error when the new password is left blank on the password reset form', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Forgot password form time limit
	function wpwebapp_settings_field_password_reset_time_limit() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="number" min="1" name="wpwebapp_theme_options[password_reset_time_valid]" class="small-text" id="password_reset_time_valid" value="<?php echo esc_attr( $options['password_reset_time_valid'] ); ?>" />
			<label class="description" for="password_reset_time_valid"><?php _e( 'Time (in hours) that password reset link is valid for', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Email to send to users when they reset their password
	function wpwebapp_settings_field_password_reset_notification_email() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<textarea name="wpwebapp_theme_options[password_reset_notification_email]" class="large-text" id="password_reset_notification_email" cols="50" rows="10"><?php echo stripslashes( esc_textarea( $options['password_reset_notification_email'] ) ); ?></textarea>
			<label for="password_reset_notification_email">
				<?php printf( __( 'The email to send to users when they request a password rest. Use %s to dynamically add their username, and %s to dynamically add their custom reset URL (required). Use %s to include the number of hours their reset URL is good for.', 'wpwebapp' ), '<code>[username]</code>', '<code>[reset]</code>', '<code>[expires]</code>'  ); ?>
			</label>
		</div>
		<?php
	}

	// Delete account form labels
	function wpwebapp_settings_field_delete_account_form_labels() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[delete_account_password_label]" id="delete_account_password_label" value="<?php echo stripslashes( esc_attr( $options['delete_account_password_label'] ) ); ?>" />
			<label class="description" for="delete_account_password_label"><?php _e( 'Delete account form "Password" label', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Delete account form submit button
	function wpwebapp_settings_field_delete_account_form_submit() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[delete_account_submit_text]" id="delete_account_submit_text" value="<?php echo esc_attr( $options['delete_account_submit_text'] ); ?>" />
			<label class="description" for="delete_account_submit_text"><?php _e( 'Delete account form "Submit" button text', 'wpwebapp' ); ?></label>
		</div>

		<div>
			<input type="text" name="wpwebapp_theme_options[delete_account_submit_class]" id="delete_account_submit_class" value="<?php echo esc_attr( $options['delete_account_submit_class'] ); ?>" />
			<label class="description" for="delete_account_submit_class"><?php _e( 'Delete account form "Submit" button classes [optional]', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Delete account form error messages
	function wpwebapp_settings_field_delete_account_form_errors() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="text" name="wpwebapp_theme_options[delete_account_password_error]" class="large-text" id="delete_account_password_error" value="<?php echo stripslashes( esc_attr( $options['delete_account_password_error'] ) ); ?>" />
			<label class="description" for="delete_account_password_error"><?php _e( 'Error when password provided in the delete account form is not correct', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Delete account redirect URL
	function wpwebapp_settings_field_delete_account_form_redirect_url() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<label class="description" for="delete_account_redirect"><?php _e( 'URL to redirect users to after their account is deleted:', 'wpwebapp' ); ?></label><br>
			<select name="wpwebapp_theme_options[delete_account_redirect]" id="delete_account_redirect" >
				<option value="0" <?php selected( '0', $options['delete_account_redirect'] ); ?>><?php _e( 'Home', 'wpwebapp' ) ?></option>
				<?php wpwebapp_settings_create_pages_select_fields( $options['delete_account_redirect'] ); ?>
			</select>
		</div>
		<?php
	}

	// Password length requirements
	function wpwebapp_settings_field_password_length_requirements() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<input type="number" min="2" name="wpwebapp_theme_options[password_minimum_length]" class="small-text" id="password_minimum_length" value="<?php echo esc_attr( $options['password_minimum_length'] ); ?>" />
			<label class="description" for="password_minimum_length"><?php _e( 'Minimum character length for passwords', 'wpwebapp' ); ?></label>
		</div>
		<?php
	}

	// Password characters requirements
	function wpwebapp_settings_field_password_character_requirements() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<label>
				<input type="checkbox" name="wpwebapp_theme_options[password_requires_letters]" id="password_requires_letters" <?php checked( 'on', $options['password_requires_letters'] ); ?> />
				<?php _e( 'Require passwords to contain at least 1 letter', 'wpwebapp' ); ?>
			</label>
		</div>
		<div>
			<label>
				<input type="checkbox" name="wpwebapp_theme_options[password_requires_numbers]" id="password_requires_numbers" <?php checked( 'on', $options['password_requires_numbers'] ); ?> />
				<?php _e( 'Require passwords to contain at least 1 number', 'wpwebapp' ); ?>
			</label>
		</div>
		<div>
			<label>
				<input type="checkbox" name="wpwebapp_theme_options[password_requires_special_characters]" id="password_requires_special_characters" <?php checked( 'on', $options['password_requires_special_characters'] ); ?> />
				<?php _e( 'Require passwords to contain at least 1 special character', 'wpwebapp' ); ?>
			</label>
		</div>
		<?php
	}

	// Show the admin bar
	function wpwebapp_settings_field_show_admin_bar() {
		$options = wpwebapp_get_theme_options();
		?>
		<div>
			<label>
				<input type="checkbox" name="wpwebapp_theme_options[show_admin_bar]" id="show_admin_bar" <?php checked( 'on', $options['show_admin_bar'] ); ?> />
				<?php _e( 'Show the admin bar for non-admin (disabled by default)', 'wpwebapp' ); ?>
			</label>
		</div>
		<?php
	}



	/**
	 * Theme Option Defaults & Sanitization
	 * Each option field requires a default value under wpwebapp_get_theme_options(), and an if statement under wpwebapp_theme_options_validate();
	 */

	// Get the current options from the database.
	// If none are specified, use these defaults.
	function wpwebapp_get_theme_options() {
		$saved = (array) get_option( 'wpwebapp_theme_options' );
		$defaults = array(

			// Alerts
			'alert_success_class' => '',
			'alert_error_class' => '',

			// Sign Up
			'signup_username_label' => 'Username',
			'signup_email_label' => 'Email',
			'signup_password_label' => 'Password',
			'signup_submit_text' => 'Sign Up',
			'signup_submit_class' => '',
			'signup_username_field_empty_error' => 'Please enter a username.',
			'signup_email_field_empty_error' => 'Please enter an email address.',
			'signup_password_field_empty_error' => 'Please enter a password.',
			'signup_username_invalid_error' => 'Usernames can only contain letters, numbers, and these special characters: _, space, ., -, *, and @.',
			'signup_username_exists_error' => 'Your chosen username is already in use. Sorry.',
			'signup_email_invalid_error' => 'Please use a valid email address.',
			'signup_email_exists_error' => 'Your chosen email is already in use. Sorry.',
			'signup_login_failed_error' => 'Your account was created by the system failed to log you in. Please try logging in now.',
			'signup_receive_notifications' => 'off',
			'signup_notification_to_admin' => 'New user registration for ' . get_bloginfo('name') . '.' . "\r\n\r\n" . 'Username: [username]' . "\r\n" . 'Email: [email]' . "\r\n",
			'signup_send_notifications' => 'off',
			'signup_notification_to_user' => 'Welcome to ' . get_bloginfo('name') . '. Your username is [username]. Log in at [login].',
			'create_user_password_time_valid' => 48,
			'create_user_send_notifications' => 'off',
			'create_user_notification' => 'An account for ' . get_bloginfo('name') . ' has been created for you. Your username is [username]. You can create a password for your account at [pw_reset].'. "\r\n\r\n" . 'This link is good for [expires] hours.',

			// Login
			'login_username_label' => 'Username or Email',
			'login_password_label' => 'Password',
			'login_rememberme_label' => 'Remember me',
			'login_submit_text' =>  'Login',
			'login_submit_class' => '',
			'login_username_field_empty_error' => 'Please enter a username or email address.',
			'login_password_field_empty_error' => 'Please enter your password.',
			'login_failed_error' => 'Login failed. Please try again.',

			// Redirect URLs
			'login_redirect' => '0',
			'logout_redirect' => '0',
			'password_reset_redirect' => '',
			'add_redirect_referrer' => 'off',

			// Change email address
			'email_change_current_email_label' => 'Email',
			'email_change_password_label' => 'Password',
			'email_change_submit_text' =>  'Change My Email',
			'email_change_submit_class' => '',
			'email_change_email_field_empty_error' => 'Please enter a new email address.',
			'email_change_password_field_empty_error' => 'Please enter your password.',
			'email_change_password_error' => 'The password you provided is not correct.',
			'email_change_success' => 'Your email address was updated.',

			// Change password
			'password_change_current_password_label' => 'Current Password',
			'password_change_new_password_label' => 'New Password',
			'password_change_submit_text' => 'Change My Password',
			'password_change_submit_class' => '',
			'password_change_forced_reset_error' => 'You must change your password before you can continue.',
			'password_change_current_password_field_empty_error' => 'Please enter your current password.',
			'password_change_new_password_field_empty_error' => 'Please enter a new password.',
			'password_change_password_error' => 'The current password you provided is not correct.',
			'password_change_success' => 'Your password was updated.',

			// Forgot password
			'password_reset_url' => '',
			'password_forgot_label' => 'Username or Email',
			'password_forgot_submit_text' => 'Reset My Password',
			'password_forgot_submit_class' => '',
			'password_reset_label' => 'New Password',
			'password_reset_submit_text' => 'Update My Password',
			'password_reset_submit_class' => '',
			'password_forgot_password_field_empty_error' => 'Please enter your username or email.',
			'password_forgot_password_invalid_user_error' => 'The username or email your entered does not exist.',
			'password_forgot_password_is_admin_error' => 'This user\'s password cannot be reset.',
			'password_forgot_password_email_error' => 'Password reset failed. Please try again.',
			'password_forgot_password_reset_key_expired_error' => 'This link has expired. Please try again.',
			'password_forgot_password_success' => 'An email has been sent to you with a password reset link.',
			'password_reset_password_field_empty_error' => 'Please enter a new password.',
			'password_reset_time_valid' => 24,
			'password_reset_notification_email' => 'We received a request to reset the password for your ' . get_bloginfo('name') . ' account: [username]. To reset your password, click on this link (or copy and paste the URL into your browser): [reset].' . "\r\n\r\n" . 'This link will expire in [expires] hours. If this was a mistake, please ignore this email.',

			// Delete account
			'delete_account_password_label' => 'Confirm Password',
			'delete_account_submit_text' =>  'Delete My Account',
			'delete_account_submit_class' => '',
			'delete_account_password_error' => 'The password you provided is not correct.',
			'delete_account_redirect' => '0',

			// Security
			'password_minimum_length' => 8,
			'password_requires_letters' => 'off',
			'password_requires_numbers' => 'off',
			'password_requires_special_characters' => 'off',
			'show_admin_bar' => 'off',

		);

		$defaults = apply_filters( 'wpwebapp_default_theme_options', $defaults );

		$options = wp_parse_args( $saved, $defaults );
		$options = array_intersect_key( $options, $defaults );

		return $options;
	}

	// Sanitize and validate updated theme options
	function wpwebapp_theme_options_validate( $input ) {
		$output = array();

		// Alerts
		if ( isset( $input['alert_success_class'] ) && ! empty( $input['alert_success_class'] ) )
			$output['alert_success_class'] = wp_filter_nohtml_kses( $input['alert_success_class'] );

		if ( isset( $input['alert_error_class'] ) && ! empty( $input['alert_error_class'] ) )
			$output['alert_error_class'] = wp_filter_nohtml_kses( $input['alert_error_class'] );

		// Sign Up
		if ( isset( $input['signup_username_label'] ) && ! empty( $input['signup_username_label'] ) )
			$output['signup_username_label'] = wp_filter_post_kses( $input['signup_username_label'] );

		if ( isset( $input['signup_email_label'] ) && ! empty( $input['signup_email_label'] ) )
			$output['signup_email_label'] = wp_filter_post_kses( $input['signup_email_label'] );

		if ( isset( $input['signup_password_label'] ) && ! empty( $input['signup_password_label'] ) )
			$output['signup_password_label'] = wp_filter_post_kses( $input['signup_password_label'] );

		if ( isset( $input['signup_submit_text'] ) && ! empty( $input['signup_submit_text'] ) )
			$output['signup_submit_text'] = wp_filter_nohtml_kses( $input['signup_submit_text'] );

		if ( isset( $input['signup_submit_class'] ) && ! empty( $input['signup_submit_class'] ) )
			$output['signup_submit_class'] = wp_filter_nohtml_kses( $input['signup_submit_class'] );

		if ( isset( $input['signup_username_field_empty_error'] ) && ! empty( $input['signup_username_field_empty_error'] ) )
			$output['signup_username_field_empty_error'] = wp_filter_nohtml_kses( $input['signup_username_field_empty_error'] );

		if ( isset( $input['signup_email_field_empty_error'] ) && ! empty( $input['signup_email_field_empty_error'] ) )
			$output['signup_email_field_empty_error'] = wp_filter_nohtml_kses( $input['signup_email_field_empty_error'] );

		if ( isset( $input['signup_password_field_empty_error'] ) && ! empty( $input['signup_password_field_empty_error'] ) )
			$output['signup_password_field_empty_error'] = wp_filter_nohtml_kses( $input['signup_password_field_empty_error'] );

		if ( isset( $input['signup_username_invalid_error'] ) && ! empty( $input['signup_username_invalid_error'] ) )
			$output['signup_username_invalid_error'] = wp_filter_nohtml_kses( $input['signup_username_invalid_error'] );

		if ( isset( $input['signup_username_exists_error'] ) && ! empty( $input['signup_username_exists_error'] ) )
			$output['signup_username_exists_error'] = wp_filter_nohtml_kses( $input['signup_username_exists_error'] );

		if ( isset( $input['signup_email_invalid_error'] ) && ! empty( $input['signup_email_invalid_error'] ) )
			$output['signup_email_invalid_error'] = wp_filter_nohtml_kses( $input['signup_email_invalid_error'] );

		if ( isset( $input['signup_email_exists_error'] ) && ! empty( $input['signup_email_exists_error'] ) )
			$output['signup_email_exists_error'] = wp_filter_nohtml_kses( $input['signup_email_exists_error'] );

		if ( isset( $input['signup_login_failed_error'] ) && ! empty( $input['signup_login_failed_error'] ) )
			$output['signup_login_failed_error'] = wp_filter_nohtml_kses( $input['signup_login_failed_error'] );

		if ( isset( $input['signup_login_failed_error'] ) && ! empty( $input['signup_login_failed_error'] ) )
			$output['signup_login_failed_error'] = wp_filter_nohtml_kses( $input['signup_login_failed_error'] );

		if ( isset( $input['signup_receive_notifications'] ) )
			$output['signup_receive_notifications'] = 'on';

		if ( isset( $input['signup_notification_to_admin'] ) && ! empty( $input['signup_notification_to_admin'] ) )
			$output['signup_notification_to_admin'] = wp_filter_post_kses( $input['signup_notification_to_admin'] );

		if ( isset( $input['signup_send_notifications'] ) )
			$output['signup_send_notifications'] = 'on';

		if ( isset( $input['signup_notification_to_user'] ) && ! empty( $input['signup_notification_to_user'] ) )
			$output['signup_notification_to_user'] = wp_filter_post_kses( $input['signup_notification_to_user'] );

		if ( isset( $input['create_user_password_time_valid'] ) && ! empty( $input['create_user_password_time_valid'] ) && is_numeric( $input['create_user_password_time_valid'] ) && $input['create_user_password_time_valid'] > 0 )
			$output['create_user_password_time_valid'] = wp_filter_nohtml_kses( $input['create_user_password_time_valid'] );

		if ( isset( $input['create_user_send_notifications'] ) )
			$output['create_user_send_notifications'] = 'on';

		if ( isset( $input['create_user_notification'] ) && ! empty( $input['create_user_notification'] ) )
			$output['create_user_notification'] = wp_filter_post_kses( $input['create_user_notification'] );

		// Login
		if ( isset( $input['login_username_label'] ) && ! empty( $input['login_username_label'] ) )
			$output['login_username_label'] = wp_filter_post_kses( $input['login_username_label'] );

		if ( isset( $input['login_password_label'] ) && ! empty( $input['login_password_label'] ) )
			$output['login_password_label'] = wp_filter_post_kses( $input['login_password_label'] );

		if ( isset( $input['login_rememberme_label'] ) && ! empty( $input['login_rememberme_label'] ) )
			$output['login_rememberme_label'] = wp_filter_nohtml_kses( $input['login_rememberme_label'] );

		if ( isset( $input['login_submit_text'] ) && ! empty( $input['login_submit_text'] ) )
			$output['login_submit_text'] = wp_filter_nohtml_kses( $input['login_submit_text'] );

		if ( isset( $input['login_submit_class'] ) && ! empty( $input['login_submit_class'] ) )
			$output['login_submit_class'] = wp_filter_nohtml_kses( $input['login_submit_class'] );

		if ( isset( $input['login_username_field_empty_error'] ) && ! empty( $input['login_username_field_empty_error'] ) )
			$output['login_username_field_empty_error'] = wp_filter_nohtml_kses( $input['login_username_field_empty_error'] );

		if ( isset( $input['login_password_field_empty_error'] ) && ! empty( $input['login_password_field_empty_error'] ) )
			$output['login_password_field_empty_error'] = wp_filter_nohtml_kses( $input['login_password_field_empty_error'] );

		if ( isset( $input['login_failed_error'] ) && ! empty( $input['login_failed_error'] ) )
			$output['login_failed_error'] = wp_filter_nohtml_kses( $input['login_failed_error'] );

		// Redirects
		if ( isset( $input['login_redirect'] ) )
			$output['login_redirect'] = wp_filter_nohtml_kses( $input['login_redirect'] );

		if ( isset( $input['logout_redirect'] ) )
			$output['logout_redirect'] = wp_filter_nohtml_kses( $input['logout_redirect'] );

		if ( isset( $input['password_reset_redirect'] ) )
			$output['password_reset_redirect'] = wp_filter_nohtml_kses( $input['password_reset_redirect'] );

		if ( isset( $input['add_redirect_referrer'] ) )
			$output['add_redirect_referrer'] = 'on';

		// Change email address
		if ( isset( $input['email_change_current_email_label'] ) && ! empty( $input['email_change_current_email_label'] ) )
			$output['email_change_current_email_label'] = wp_filter_post_kses( $input['email_change_current_email_label'] );

		if ( isset( $input['email_change_password_label'] ) && ! empty( $input['email_change_password_label'] ) )
			$output['email_change_password_label'] = wp_filter_post_kses( $input['email_change_password_label'] );

		if ( isset( $input['email_change_submit_text'] ) && ! empty( $input['email_change_submit_text'] ) )
			$output['email_change_submit_text'] = wp_filter_nohtml_kses( $input['email_change_submit_text'] );

		if ( isset( $input['email_change_submit_class'] ) && ! empty( $input['email_change_submit_class'] ) )
			$output['email_change_submit_class'] = wp_filter_nohtml_kses( $input['email_change_submit_class'] );

		if ( isset( $input['email_change_email_field_empty_error'] ) && ! empty( $input['email_change_email_field_empty_error'] ) )
			$output['email_change_email_field_empty_error'] = wp_filter_nohtml_kses( $input['email_change_email_field_empty_error'] );

		if ( isset( $input['email_change_password_field_empty_error'] ) && ! empty( $input['email_change_password_field_empty_error'] ) )
			$output['email_change_password_field_empty_error'] = wp_filter_nohtml_kses( $input['email_change_password_field_empty_error'] );

		if ( isset( $input['email_change_password_error'] ) && ! empty( $input['email_change_password_error'] ) )
			$output['email_change_password_error'] = wp_filter_nohtml_kses( $input['email_change_password_error'] );

		if ( isset( $input['email_change_success'] ) && ! empty( $input['email_change_success'] ) )
			$output['email_change_success'] = wp_filter_nohtml_kses( $input['email_change_success'] );

		// Change password
		if ( isset( $input['password_change_current_password_label'] ) && ! empty( $input['password_change_current_password_label'] ) )
			$output['password_change_current_password_label'] = wp_filter_post_kses( $input['password_change_current_password_label'] );

		if ( isset( $input['password_change_new_password_label'] ) && ! empty( $input['password_change_new_password_label'] ) )
			$output['password_change_new_password_label'] = wp_filter_post_kses( $input['password_change_new_password_label'] );

		if ( isset( $input['password_change_submit_text'] ) && ! empty( $input['password_change_submit_text'] ) )
			$output['password_change_submit_text'] = wp_filter_nohtml_kses( $input['password_change_submit_text'] );

		if ( isset( $input['password_change_submit_class'] ) && ! empty( $input['password_change_submit_class'] ) )
			$output['password_change_submit_class'] = wp_filter_nohtml_kses( $input['password_change_submit_class'] );

		if ( isset( $input['password_change_forced_reset_error'] ) && ! empty( $input['password_change_forced_reset_error'] ) )
			$output['password_change_forced_reset_error'] = wp_filter_nohtml_kses( $input['password_change_forced_reset_error'] );

		if ( isset( $input['password_change_current_password_field_empty_error'] ) && ! empty( $input['password_change_current_password_field_empty_error'] ) )
			$output['password_change_current_password_field_empty_error'] = wp_filter_nohtml_kses( $input['password_change_current_password_field_empty_error'] );

		if ( isset( $input['password_change_new_password_field_empty_error'] ) && ! empty( $input['password_change_new_password_field_empty_error'] ) )
			$output['password_change_new_password_field_empty_error'] = wp_filter_nohtml_kses( $input['password_change_new_password_field_empty_error'] );

		if ( isset( $input['password_change_password_error'] ) && ! empty( $input['password_change_password_error'] ) )
			$output['password_change_password_error'] = wp_filter_nohtml_kses( $input['password_change_password_error'] );

		if ( isset( $input['password_change_success'] ) && ! empty( $input['password_change_success'] ) )
			$output['password_change_success'] = wp_filter_nohtml_kses( $input['password_change_success'] );

		// Forgot password
		if ( isset( $input['password_reset_url'] ) )
			$output['password_reset_url'] = wp_filter_nohtml_kses( $input['password_reset_url'] );

		if ( isset( $input['password_forgot_label'] ) && ! empty( $input['password_forgot_label'] ) )
			$output['password_forgot_label'] = wp_filter_post_kses( $input['password_forgot_label'] );

		if ( isset( $input['password_forgot_submit_text'] ) && ! empty( $input['password_forgot_submit_text'] ) )
			$output['password_forgot_submit_text'] = wp_filter_nohtml_kses( $input['password_forgot_submit_text'] );

		if ( isset( $input['password_forgot_submit_class'] ) && ! empty( $input['password_forgot_submit_class'] ) )
			$output['password_forgot_submit_class'] = wp_filter_nohtml_kses( $input['password_forgot_submit_class'] );

		if ( isset( $input['password_reset_label'] ) && ! empty( $input['password_reset_label'] ) )
			$output['password_reset_label'] = wp_filter_post_kses( $input['password_reset_label'] );

		if ( isset( $input['password_reset_submit_text'] ) && ! empty( $input['password_reset_submit_text'] ) )
			$output['password_reset_submit_text'] = wp_filter_nohtml_kses( $input['password_reset_submit_text'] );

		if ( isset( $input['password_reset_submit_class'] ) && ! empty( $input['password_reset_submit_class'] ) )
			$output['password_reset_submit_class'] = wp_filter_nohtml_kses( $input['password_reset_submit_class'] );

		if ( isset( $input['password_forgot_password_field_empty_error'] ) && ! empty( $input['password_forgot_password_field_empty_error'] ) )
			$output['password_forgot_password_field_empty_error'] = wp_filter_nohtml_kses( $input['password_forgot_password_field_empty_error'] );

		if ( isset( $input['password_forgot_password_invalid_user_error'] ) && ! empty( $input['password_forgot_password_invalid_user_error'] ) )
			$output['password_forgot_password_invalid_user_error'] = wp_filter_nohtml_kses( $input['password_forgot_password_invalid_user_error'] );

		if ( isset( $input['password_forgot_password_is_admin_error'] ) && ! empty( $input['password_forgot_password_is_admin_error'] ) )
			$output['password_forgot_password_is_admin_error'] = wp_filter_nohtml_kses( $input['password_forgot_password_is_admin_error'] );

		if ( isset( $input['password_forgot_password_email_error'] ) && ! empty( $input['password_forgot_password_email_error'] ) )
			$output['password_forgot_password_email_error'] = wp_filter_nohtml_kses( $input['password_forgot_password_email_error'] );

		if ( isset( $input['password_forgot_password_reset_key_expired_error'] ) && ! empty( $input['password_forgot_password_reset_key_expired_error'] ) )
			$output['password_forgot_password_reset_key_expired_error'] = wp_filter_nohtml_kses( $input['password_forgot_password_reset_key_expired_error'] );

		if ( isset( $input['password_forgot_password_success'] ) && ! empty( $input['password_forgot_password_success'] ) )
			$output['password_forgot_password_success'] = wp_filter_nohtml_kses( $input['password_forgot_password_success'] );

		if ( isset( $input['password_reset_password_field_empty_error'] ) && ! empty( $input['password_reset_password_field_empty_error'] ) )
			$output['password_reset_password_field_empty_error'] = wp_filter_nohtml_kses( $input['password_reset_password_field_empty_error'] );

		if ( isset( $input['password_reset_time_valid'] ) && ! empty( $input['password_reset_time_valid'] ) && is_numeric( $input['password_reset_time_valid'] ) && $input['password_reset_time_valid'] > 0 )
			$output['password_reset_time_valid'] = wp_filter_nohtml_kses( $input['password_reset_time_valid'] );

		if ( isset( $input['password_reset_notification_email'] ) && ! empty( $input['password_reset_notification_email'] ) )
			$output['password_reset_notification_email'] = wp_filter_post_kses( $input['password_reset_notification_email'] );

		// Delete account
		if ( isset( $input['delete_account_password_label'] ) && ! empty( $input['delete_account_password_label'] ) )
			$output['delete_account_password_label'] = wp_filter_post_kses( $input['delete_account_password_label'] );

		if ( isset( $input['delete_account_submit_text'] ) && ! empty( $input['delete_account_submit_text'] ) )
			$output['delete_account_submit_text'] = wp_filter_nohtml_kses( $input['delete_account_submit_text'] );

		if ( isset( $input['delete_account_submit_class'] ) && ! empty( $input['delete_account_submit_class'] ) )
			$output['delete_account_submit_class'] = wp_filter_nohtml_kses( $input['delete_account_submit_class'] );

		if ( isset( $input['delete_account_password_error'] ) && ! empty( $input['delete_account_password_error'] ) )
			$output['delete_account_password_error'] = wp_filter_nohtml_kses( $input['delete_account_password_error'] );

		if ( isset( $input['delete_account_redirect'] ) )
			$output['delete_account_redirect'] = wp_filter_nohtml_kses( $input['delete_account_redirect'] );

		// Security
		if ( isset( $input['password_minimum_length'] ) && ! empty( $input['password_minimum_length'] ) && is_numeric( $input['password_minimum_length'] ) && $input['password_minimum_length'] > 2 )
			$output['password_minimum_length'] = wp_filter_nohtml_kses( $input['password_minimum_length'] );

		if ( isset( $input['password_requires_letters'] ) )
			$output['password_requires_letters'] = 'on';

		if ( isset( $input['password_requires_numbers'] ) )
			$output['password_requires_numbers'] = 'on';

		if ( isset( $input['password_requires_special_characters'] ) )
			$output['password_requires_special_characters'] = 'on';

		if ( isset( $input['show_admin_bar'] ) )
			$output['show_admin_bar'] = 'on';


		return apply_filters( 'wpwebapp_theme_options_validate', $output, $input );
	}



	/**
	 * Theme Options Menu
	 * Each option field requires its own add_settings_field function.
	 */

	// Create theme options menu
	// The content that's rendered on the menu page.
	function wpwebapp_theme_options_render_page() {
		?>
		<div class="wrap">
			<h2><?php _e( 'WordPress for Web Apps Options', 'wpwebapp' ); ?></h2>
			<?php // settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'wpwebapp_options' );
					do_settings_sections( 'wpwebapp_plugin_options' );
					submit_button();
				?>
			</form>
		</div>
		<?php
	}

	// Register the theme options page and its fields
	function wpwebapp_theme_options_init() {

		// Register a setting and its sanitization callback
		// register_setting( $option_group, $option_name, $sanitize_callback );
		// $option_group - A settings group name.
		// $option_name - The name of an option to sanitize and save.
		// $sanitize_callback - A callback function that sanitizes the option's value.
		register_setting( 'wpwebapp_options', 'wpwebapp_theme_options', 'wpwebapp_theme_options_validate' );


		// Register our settings field group
		// add_settings_section( $id, $title, $callback, $page );
		// $id - Unique identifier for the settings section
		// $title - Section title
		// $callback - // Section callback (we don't want anything)
		// $page - // Menu slug, used to uniquely identify the page. See wpwebapp_theme_options_add_page().
		add_settings_section( 'alerts', 'Alerts',  '__return_false', 'wpwebapp_plugin_options' );
		add_settings_section( 'signup', 'Sign Up Form',  '__return_false', 'wpwebapp_plugin_options' );
		add_settings_section( 'login', 'Login Form',  '__return_false', 'wpwebapp_plugin_options' );
		add_settings_section( 'redirects', 'Redirects',  '__return_false', 'wpwebapp_plugin_options' );
		add_settings_section( 'email_change', 'Change Email Form',  '__return_false', 'wpwebapp_plugin_options' );
		add_settings_section( 'password_change', 'Change Password Form',  '__return_false', 'wpwebapp_plugin_options' );
		add_settings_section( 'password_forgot', 'Forgot Password Form',  '__return_false', 'wpwebapp_plugin_options' );
		add_settings_section( 'delete_account', 'Delete Account Form',  '__return_false', 'wpwebapp_plugin_options' );
		add_settings_section( 'security', 'Security',  '__return_false', 'wpwebapp_plugin_options' );


		// Register our individual settings fields
		// add_settings_field( $id, $title, $callback, $page, $section );
		// $id - Unique identifier for the field.
		// $title - Setting field title.
		// $callback - Function that creates the field (from the Theme Option Fields section).
		// $page - The menu page on which to display this field.
		// $section - The section of the settings page in which to show the field.

		// Alerts
		add_settings_field( 'alerts', __( 'Alert Classes', 'wpwebapp' ), 'wpwebapp_settings_field_alert_classes', 'wpwebapp_plugin_options', 'alerts' );

		// Sign up form
		add_settings_field( 'signup_labels', __( 'Sign Up Labels', 'wpwebapp' ), 'wpwebapp_settings_field_signup_form_labels', 'wpwebapp_plugin_options', 'signup' );
		add_settings_field( 'signup_submit', __( 'Sign Up Submit Button', 'wpwebapp' ), 'wpwebapp_settings_field_signup_form_submit', 'wpwebapp_plugin_options', 'signup' );
		add_settings_field( 'signup_errors', __( 'Sign Up Errors', 'wpwebapp' ), 'wpwebapp_settings_field_signup_form_errors', 'wpwebapp_plugin_options', 'signup' );
		add_settings_field( 'signup_notifications_to_admin', __( 'Sign Up Admin Notifications', 'wpwebapp' ), 'wpwebapp_settings_field_signup_form_notifications_to_admin', 'wpwebapp_plugin_options', 'signup' );
		add_settings_field( 'signup_notifications_to_user', __( 'Sign Up User Notifications', 'wpwebapp' ), 'wpwebapp_settings_field_signup_form_notifications_to_user', 'wpwebapp_plugin_options', 'signup' );
		add_settings_field( 'create_user_password_time_valid', __( 'User Password Time Limit', 'wpwebapp' ), 'wpwebapp_settings_field_create_user_password_time_limit', 'wpwebapp_plugin_options', 'signup' );
		add_settings_field( 'create_user_notifications', __( 'Create User Notifications', 'wpwebapp' ), 'wpwebapp_settings_field_create_user_notifications_to_user', 'wpwebapp_plugin_options', 'signup' );

		// Login form
		add_settings_field( 'login_labels', __( 'Login Labels', 'wpwebapp' ), 'wpwebapp_settings_field_login_form_labels', 'wpwebapp_plugin_options', 'login' );
		add_settings_field( 'login_submit', __( 'Login Submit Button', 'wpwebapp' ), 'wpwebapp_settings_field_login_form_submit', 'wpwebapp_plugin_options', 'login' );
		add_settings_field( 'login_errors', __( 'Login Errors', 'wpwebapp' ), 'wpwebapp_settings_field_login_form_errors', 'wpwebapp_plugin_options', 'login' );

		// Redirects
		add_settings_field( 'redirects', __( 'Redirect URLs', 'wpwebapp' ), 'wpwebapp_settings_field_login_logout_redirects', 'wpwebapp_plugin_options', 'redirects' );

		// Email change form
		add_settings_field( 'email_change_labels', __( 'Email Change Labels', 'wpwebapp' ), 'wpwebapp_settings_field_email_change_form_labels', 'wpwebapp_plugin_options', 'email_change' );
		add_settings_field( 'email_change_submit', __( 'Email Change Submit Buttons', 'wpwebapp' ), 'wpwebapp_settings_field_email_change_form_submit', 'wpwebapp_plugin_options', 'email_change' );
		add_settings_field( 'email_change_errors', __( 'Email Change Errors', 'wpwebapp' ), 'wpwebapp_settings_field_email_change_form_errors', 'wpwebapp_plugin_options', 'email_change' );

		// Email change form
		add_settings_field( 'password_change_labels', __( 'Change Password Labels', 'wpwebapp' ), 'wpwebapp_settings_field_password_change_form_labels', 'wpwebapp_plugin_options', 'password_change' );
		add_settings_field( 'password_change_submit', __( 'Change Password Submit Buttons', 'wpwebapp' ), 'wpwebapp_settings_field_password_change_form_submit', 'wpwebapp_plugin_options', 'password_change' );
		add_settings_field( 'password_change_errors', __( 'Change Password Errors', 'wpwebapp' ), 'wpwebapp_settings_field_password_change_form_errors', 'wpwebapp_plugin_options', 'password_change' );

		// Forgot password form
		add_settings_field( 'password_reset_url', __( 'Forgot Password URL', 'wpwebapp' ), 'wpwebapp_settings_field_password_reset_url', 'wpwebapp_plugin_options', 'password_forgot' );
		add_settings_field( 'password_forgot_labels', __( 'Forgot Password Labels', 'wpwebapp' ), 'wpwebapp_settings_field_password_reset_form_labels', 'wpwebapp_plugin_options', 'password_forgot' );
		add_settings_field( 'password_forgot_submit', __( 'Forgot Password Submit Buttons', 'wpwebapp' ), 'wpwebapp_settings_field_password_reset_form_submit', 'wpwebapp_plugin_options', 'password_forgot' );
		add_settings_field( 'password_forgot_errors', __( 'Forgot Password Errors', 'wpwebapp' ), 'wpwebapp_settings_field_password_reset_form_errors', 'wpwebapp_plugin_options', 'password_forgot' );
		add_settings_field( 'password_forgot_timelimit', __( 'Forgot Password Time Limit', 'wpwebapp' ), 'wpwebapp_settings_field_password_reset_time_limit', 'wpwebapp_plugin_options', 'password_forgot' );
		add_settings_field( 'password_reset_notification', __( 'Password Reset Notification', 'wpwebapp' ), 'wpwebapp_settings_field_password_reset_notification_email', 'wpwebapp_plugin_options', 'password_forgot' );

		// Delete acccount form
		add_settings_field( 'delete_account_labels', __( 'Delete Account Labels', 'wpwebapp' ), 'wpwebapp_settings_field_delete_account_form_labels', 'wpwebapp_plugin_options', 'delete_account' );
		add_settings_field( 'delete_account_submit', __( 'Delete Account Submit Buttons', 'wpwebapp' ), 'wpwebapp_settings_field_delete_account_form_submit', 'wpwebapp_plugin_options', 'delete_account' );
		add_settings_field( 'delete_account_errors', __( 'Delete Account Errors', 'wpwebapp' ), 'wpwebapp_settings_field_delete_account_form_errors', 'wpwebapp_plugin_options', 'delete_account' );
		add_settings_field( 'delete_account_redirect', __( 'Delete Account Redirect', 'wpwebapp' ), 'wpwebapp_settings_field_delete_account_form_redirect_url', 'wpwebapp_plugin_options', 'delete_account' );

		// Security
		add_settings_field( 'security_password_length', __( 'Password Length', 'wpwebapp' ), 'wpwebapp_settings_field_password_length_requirements', 'wpwebapp_plugin_options', 'security' );
		add_settings_field( 'security_password_characters', __( 'Password Characters', 'wpwebapp' ), 'wpwebapp_settings_field_password_character_requirements', 'wpwebapp_plugin_options', 'security' );
		add_settings_field( 'security_show_admin_bar', __( 'Admin Bar', 'wpwebapp' ), 'wpwebapp_settings_field_show_admin_bar', 'wpwebapp_plugin_options', 'security' );

	}
	add_action( 'admin_init', 'wpwebapp_theme_options_init' );

	// Add the theme options page to the admin menu
	// Use add_theme_page() to add under Appearance tab (default).
	// Use add_menu_page() to add as it's own tab.
	// Use add_submenu_page() to add to another tab.
	function wpwebapp_theme_options_add_page() {

		// add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function );
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function );
		// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		// $page_title - Name of page
		// $menu_title - Label in menu
		// $capability - Capability required
		// $menu_slug - Used to uniquely identify the page
		// $function - Function that renders the options page
		// $theme_page = add_theme_page( __( 'Theme Options', 'wpwebapp' ), __( 'Theme Options', 'wpwebapp' ), 'edit_theme_options', 'theme_options', 'wpwebapp_theme_options_render_page' );

		// $theme_page = add_menu_page( __( 'Theme Options', 'wpwebapp' ), __( 'Theme Options', 'wpwebapp' ), 'edit_theme_options', 'theme_options', 'wpwebapp_theme_options_render_page' );
		$theme_page = add_submenu_page( 'options-general.php', __( 'Web Apps', 'wpwebapp' ), __( 'Web Apps', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options', 'wpwebapp_theme_options_render_page' );
	}
	add_action( 'admin_menu', 'wpwebapp_theme_options_add_page' );



	// Restrict access to the theme options page to admins
	function wpwebapp_option_page_capability( $capability ) {
		return 'edit_theme_options';
	}
	add_filter( 'option_page_capability_wpwebapp_options', 'wpwebapp_option_page_capability' );
