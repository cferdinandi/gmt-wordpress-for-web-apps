<?php

/* ======================================================================

	WordPress for Web App Options Fields
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	SECURITY
 * ====================================================================== */

function wpwebapp_settings_field_minimum_password_length() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[minimum_password_length]" id="minimum-password-length" value="<?php echo esc_attr( $options['minimum_password_length'] ); ?>" /><br>
	<label class="description" for="minimum-password-length"><?php _e( 'Default: <code>8</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_password_requirements() {
	$options = wpwebapp_get_plugin_options();
	?>
	<div class="layout">
		<label class="description" for="password-requirements-letters">
			<input type="checkbox" name="wpwebapp_plugin_options[password_requirements_letters]" id="password-requirements-letters" <?php checked( 'on', $options['password_requirements_letters'] ); ?> />
			<?php _e( 'Letters', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="password-requirements-numbers">
			<input type="checkbox" name="wpwebapp_plugin_options[password_requirements_numbers]" id="password-requirements-numbers" <?php checked( 'on', $options['password_requirements_numbers'] ); ?> />
			<?php _e( 'Numbers', 'wpwebapp' ); ?>
		</label>
	</div>
	<div class="layout">
		<label class="description" for="password-requirements-special-chars">
			<input type="checkbox" name="wpwebapp_plugin_options[password_requirements_special_chars]" id="password-requirements-special-chars" <?php checked( 'on', $options['password_requirements_special_chars'] ); ?> />
			<?php _e( 'Special Characters', 'wpwebapp' ); ?>
		</label>
	</div>
	<?php
}

// Used in wpwebapp_settings_field_restrict_pw_reset()
function wpwebapp_settings_field_restrict_pw_reset_choices() {
	$restrict_pw_reset = array(
		'admin' => array(
			'value' => 'admin',
			'label' => __( 'Admin', 'wpwebapp' )
		),
		'editor' => array(
			'value' => 'editor',
			'label' => __( 'Editor', 'wpwebapp' )
		),
		'author' => array(
			'value' => 'author',
			'label' => __( 'Author', 'wpwebapp' )
		),
		'contributor' => array(
			'value' => 'contributor',
			'label' => __( 'Contributor', 'wpwebapp' )
		),
		'subscriber' => array(
			'value' => 'subscriber',
			'label' => __( 'Subscriber', 'wpwebapp' )
		)
	);

	return apply_filters( 'wpwebapp_settings_field_restrict_pw_reset_choices', $restrict_pw_reset );
}

function wpwebapp_settings_field_restrict_pw_reset() {
	$options = wpwebapp_get_plugin_options();
	foreach ( wpwebapp_settings_field_restrict_pw_reset_choices() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="wpwebapp_plugin_options[restrict_pw_reset]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['restrict_pw_reset'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}

function wpwebapp_settings_field_pw_reset_time_valid() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[pw_reset_time_valid]" id="pw-reset-time-valid" value="<?php echo esc_attr( $options['pw_reset_time_valid'] ); ?>" /><br>
	<label class="description" for="pw-reset-time-valid"><?php _e( 'Default: <code>24</code>', 'wpwebapp' ); ?></label>
	<?php
}


// User Access
// Used in wpwebapp_settings_field_block_wp_backend_access()
function wpwebapp_settings_field_block_wp_backend_access_choices() {
	$block_wp_backend_access = array(
		'admin' => array(
			'value' => 'admin',
			'label' => __( 'Admin', 'wpwebapp' )
		),
		'editor' => array(
			'value' => 'editor',
			'label' => __( 'Editor', 'wpwebapp' )
		),
		'author' => array(
			'value' => 'author',
			'label' => __( 'Author', 'wpwebapp' )
		),
		'contributor' => array(
			'value' => 'contributor',
			'label' => __( 'Contributor', 'wpwebapp' )
		),
		'subscriber' => array(
			'value' => 'subscriber',
			'label' => __( 'Subscriber', 'wpwebapp' )
		)
	);

	return apply_filters( 'wpwebapp_settings_field_block_wp_backend_access_choices', $block_wp_backend_access );
}

function wpwebapp_settings_field_block_wp_backend_access() {
	$options = wpwebapp_get_plugin_options();
	foreach ( wpwebapp_settings_field_block_wp_backend_access_choices() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="wpwebapp_plugin_options[block_wp_backend_access]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['block_wp_backend_access'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}

function wpwebapp_settings_field_redirect_logged_out() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[redirect_logged_out]" id="redirect-logged-out" value="<?php echo esc_url( $options['redirect_logged_out'] ); ?>" /><br>
	<label class="description" for="redirect-logged-out"><?php _e( 'Default: Home Page', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_redirect_logged_in() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[redirect_logged_in]" id="redirect-logged-in" value="<?php echo esc_url( $options['redirect_logged_in'] ); ?>" /><br>
	<label class="description" for="redirect-logged-in"><?php _e( 'Default: Home Page', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_blog_posts_require_login() {
	$options = wpwebapp_get_plugin_options();
	?>
	<label for="blog-posts-require-login">
		<input type="checkbox" name="wpwebapp_plugin_options[blog_posts_require_login]" id="blog-posts-require-login" <?php checked( 'on', $options['blog_posts_require_login'] ); ?> />
		<?php _e( 'Require user login to view blog posts', 'wpwebapp' ); ?>
	</label>
	<?php
}





/* ======================================================================
	FORMS
 * ====================================================================== */

function wpwebapp_settings_field_button_class() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[button_class]" id="button-class" value="<?php echo esc_attr( $options['button_class'] ); ?>" /><br>
	<label class="description" for="button-class"><?php _e( 'Example: <code>btn btn-blue</code>. Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_delete_button_class() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[delete_button_class]" id="delete-button-class" value="<?php echo esc_attr( $options['delete_button_class'] ); ?>" /><br>
	<label class="description" for="delete-button-class"><?php _e( 'Example: <code>btn btn-red</code>. Default: Button Class value.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_login() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[button_text_login]" id="button-text-login" value="<?php echo esc_attr( $options['button_text_login'] ); ?>" /><br>
	<label class="description" for="button-text-login"><?php _e( 'Default: <code>Login</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_signup() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[button_text_signup]" id="button-text-signup" value="<?php echo esc_attr( $options['button_text_signup'] ); ?>" /><br>
	<label class="description" for="button-text-signup"><?php _e( 'Default: <code>Signup</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_pw_change() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[button_text_pw_change]" id="button-text-pw-change" value="<?php echo esc_attr( $options['button_text_pw_change'] ); ?>" /><br>
	<label class="description" for="button-text-pw-change"><?php _e( 'Default: <code>Change Password</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_pw_forgot() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[button_text_pw_forgot]" id="button-text-pw-forgot" value="<?php echo esc_attr( $options['button_text_pw_forgot'] ); ?>" /><br>
	<label class="description" for="button-text-pw-forgot"><?php _e( 'Default: <code>Reset Password</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_pw_reset() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[button_text_pw_reset]" id="button-text-pw-reset" value="<?php echo esc_attr( $options['button_text_pw_reset'] ); ?>" /><br>
	<label class="description" for="button-text-pw-reset"><?php _e( 'Default: <code>Set New Password</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_forgot_pw_url() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[forgot_pw_url]" id="forgot-pw-url" value="<?php echo esc_url( $options['forgot_pw_url'] ); ?>" /><br>
	<label class="description" for="forgot-pw-url"><?php _e( 'Default: None', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_forgot_pw_url_text() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[forgot_pw_url_text]" id="forgot-pw-url-text" value="<?php echo esc_attr( $options['forgot_pw_url_text'] ); ?>" /><br>
	<label class="description" for="forgot-pw-url-text"><?php _e( 'Default: <code>forgot password</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_pw_requirement_text() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[pw_requirement_text]" id="pw-requirement-text" value="<?php echo esc_attr( $options['pw_requirement_text'] ); ?>" /><br>
	<label class="description" for="pw-requirement-text"><?php _e( 'Default: Varies based on your password requirements under "Security"<br />Use the variable <code>%n</code> to dynamically display the minimum character number from your settings.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_delete_account_text() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[delete_account_text]" id="delete-account-text" value="<?php echo esc_attr( $options['delete_account_text'] ); ?>" /><br>
	<label class="description" for="delete-account-text"><?php _e( 'Default: <code>Delete Account</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_delete_account_url() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[delete_account_url]" id="delete-account-text" value="<?php echo esc_attr( $options['delete_account_url'] ); ?>" /><br>
	<label class="description" for="delete-account-url"><?php _e( 'Default: Logged-Out Redirect', 'wpwebapp' ); ?></label>
	<?php
}





/* ======================================================================
	ALERTS
 * ====================================================================== */

function wpwebapp_settings_field_alert_empty_fields() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_empty_fields]" id="alert-empty-fields" value="<?php echo esc_html( $options['alert_empty_fields'] ); ?>" /><br>
	<label class="description" for="alert-empty-fields"><?php _e( 'Default: <code>&lt;p&gt;Please complete all fields.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_requirements() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_pw_requirements]" id="alert-pw-requirements" value="<?php echo esc_html( $options['alert_pw_requirements'] ); ?>" /><br>
	<label class="description" for="alert-pw-requirements"><?php _e( 'Default: <code>&lt;p&gt;Please use a password that\'s at least %n characters long.&lt;/p&gt;</code><br />Use the variable <code>%n</code> to dynamically display the minimum character number from your settings.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_no_match() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_pw_no_match]" id="alert-pw-no-match" value="<?php echo esc_html( $options['alert_pw_no_match'] ); ?>" /><br>
	<label class="description" for="alert-pw-no-match"><?php _e( 'Default: <code>&lt;p&gt;The new passwords your entered didn\'t match.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_incorrect_login() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_incorrect_login]" id="alert-incorrect-login" value="<?php echo esc_html( $options['alert_incorrect_login'] ); ?>" /><br>
	<label class="description" for="alert-incorrect-login"><?php _e( 'Default: <code>&lt;p&gt;Incorrect username or password.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_username_invalid() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_username_invalid]" id="alert-username-invalid" value="<?php echo esc_html( $options['alert_username_invalid'] ); ?>" /><br>
	<label class="description" for="alert-username-invalid"><?php _e( 'Default: <code>&lt;p&gt;Usernames can only contain letters, numbers, and these special characters: _, space, ., -, *, and @.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_username_taken() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_username_taken]" id="alert-username-taken" value="<?php echo esc_html( $options['alert_username_taken'] ); ?>" /><br>
	<label class="description" for="alert-username-taken"><?php _e( 'Default: <code>&lt;p&gt;Username already exists.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_email_invalid() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_email_invalid]" id="alert-email-invalid" value="<?php echo esc_html( $options['alert_email_invalid'] ); ?>" /><br>
	<label class="description" for="alert-email-invalid"><?php _e( 'Default: <code>&lt;p&gt;Please use a valid email address.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_email_taken() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_email_taken]" id="alert-email-taken" value="<?php echo esc_html( $options['alert_email_taken'] ); ?>" /><br>
	<label class="description" for="alert-email-taken"><?php _e( 'Default: <code>&lt;p&gt;An account with this email address already exists.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_incorrect() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_pw_incorrect]" id="alert-pw-incorrect" value="<?php echo esc_html( $options['alert_pw_incorrect'] ); ?>" /><br>
	<label class="description" for="alert-pw-incorrect"><?php _e( 'Default: <code>&lt;p&gt;The password you entered does not match your current password.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_change_success() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_pw_change_success]" id="alert-pw-change-success" value="<?php echo esc_html( $options['alert_pw_change_success'] ); ?>" /><br>
	<label class="description" for="alert-pw-change-success"><?php _e( 'Default: <code>&lt;p&gt;Your password has been updated.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_login_does_not_exist() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_login_does_not_exist]" id="alert-login-does-not-exist" value="<?php echo esc_html( $options['alert_login_does_not_exist'] ); ?>" /><br>
	<label class="description" for="alert-login-does-not-exist"><?php _e( 'Default: <code>&lt;p&gt;Username or email doesn\'t exist.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_reset_not_allowed() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_pw_reset_not_allowed]" id="alert-pw-reset-not-allowed" value="<?php echo esc_html( $options['alert_pw_reset_not_allowed'] ); ?>" /><br>
	<label class="description" for="alert-pw-reset-not-allowed"><?php _e( 'Default: <code>&lt;p&gt;Password resets are not allowed for this user.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_reset_email_sent() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_pw_reset_email_sent]" id="alert-pw-reset-email-sent" value="<?php echo esc_html( $options['alert_pw_reset_email_sent'] ); ?>" /><br>
	<label class="description" for="alert-pw-reset-email-sent"><?php _e( 'Default: <code>&lt;p&gt;We\'ve sent you an email with a temporary link that will allow you to reset your password for the next %t hours. Please check your spam folder if the email doesn’t appear within a few minutes.&lt;/p&gt;</code><br />Use the variable <code>%t</code> to dynamically display the number of hours from your settings.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_reset_email_failed() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_pw_reset_email_failed]" id="alert-pw-reset-email-failed" value="<?php echo esc_html( $options['alert_pw_reset_email_failed'] ); ?>" /><br>
	<label class="description" for="alert-pw-reset-email-failed"><?php _e( 'Default: <code>&lt;p&gt;Oops, something went wrong on our end. Please try again.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_alert_pw_reset_url_invalid() {
	$options = wpwebapp_get_plugin_options();
	?>
	<input type="text" name="wpwebapp_plugin_options[alert_pw_reset_url_invalid]" id="alert-pw-reset-url-invalid" value="<?php echo esc_html( $options['alert_pw_reset_url_invalid'] ); ?>" /><br>
	<label class="description" for="alert-pw-reset-url-invalid"><?php _e( 'Default: <code>&lt;p&gt;This password reset request is no longer valid.&lt;/p&gt;</code>', 'wpwebapp' ); ?></label>
	<?php
}





/* ======================================================================
	EMAILS
 * ====================================================================== */

function wpwebapp_settings_field_email_disable_new_user_default() {
	$options = wpwebapp_get_plugin_options();
	?>
	<label for="email-disable-new-user-default">
		<input type="checkbox" name="wpwebapp_plugin_options[email_disable_new_user_default]" id="email-disable-new-user-default" <?php checked( 'on', $options['email_disable_new_user_default'] ); ?> />
		<?php _e( 'Disable the default new user email that WordPress sends', 'wpwebapp' ); ?>
	</label>
	<?php
}

function wpwebapp_settings_field_email_disable_pw_reset() {
	$options = wpwebapp_get_plugin_options();
	?>
	<label for="email-disable-pw-reset">
		<input type="checkbox" name="wpwebapp_plugin_options[email_disable_pw_reset]" id="email-disable-pw-reset" <?php checked( 'on', $options['email_disable_pw_reset'] ); ?> />
		<?php _e( 'Disable the email WordPress sends whenever a user changes their password', 'wpwebapp' ); ?>
	</label>
	<?php
}

?>