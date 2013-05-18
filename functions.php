<?php // Don't delete this line or you'll break WordPress

/* ======================================================================
 * Functions.php
 * For modifying and expanding core WordPress functionality.
 *
 * If your theme does not have a functions.php file, add this file to your theme.
 * If functions.php already exists, copy-and-paste the text below into it.
 * ====================================================================== */



/* ======================================================================
 * Login-Form-Shortcode.php
 * A PHP script and shortcode for the WordPress login form.
 *
 * Add a login form anywhere on your site by adding <?php echo wpwebapp_login(); ?> to a template file.
 * You can also use the [loginform] shortcode in the WordPress content editor.
 * ====================================================================== */

// LOGIN FORM SHORTCODE

function wpwebapp_login() {

    // Get current page URL
    $url_current  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url_current .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url_current .= $_SERVER["REQUEST_URI"];
    $url_clean = array_shift( explode('?', $url_current) );
    $login_failed = $url_clean . '?login=failed';
    $signup_success = $url_clean . '?signup=success';
    $reset_success = $url_clean . '?password-reset=success';

    // Variables
    $login_status = '';

    // If login failed
    if ( $url_current == $login_failed ) {
        $login_status = '<div class="alert alert-red">Invalid username or password. Please try again.</div>';
    }

    // If password reset
    if ( $url_current == $signup_success ) {
        $login_status = '<div class="alert alert-green"><strong>Success!</strong> We just sent you an email with your password.</div>';
    }

    // If password reset
    if ( $url_current == $reset_success ) {
        $login_status = '<div class="alert alert-green">Your password was successfully reset. We just emailed you a new one.</div>';
    }

    // The login form
	$form = 
        $login_status .
        '<form name="login" id="wp_login_form" action="' . get_option('home') . '/wp-login.php" method="post">
            <div>
                <label for="username">Username</label>
                <input type="text" name="log" id="log" value="" tabindex="1" autofocus>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="pwd" id="pwd" value="" tabindex="2">
            </div>
            <div>
                <label>
                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" checked>
                    Remember Me
                </label>
            </div>
            <div>
                <button type="submit" name="wp-submit" id="wp-submit" tabindex="100" class="btn btn-blue">Log In</button><br>
                <a href="' . $url_clean . 'password-reset/">Forgot your password?</a>
                <input type="hidden" name="action" value="login">
                <input type="hidden" name="redirect_to" value="' . get_option('home') . '">
                <input type="hidden" name="testcookie" value="1">
            </div>
        </form>';

	// Display the form
	return $form;
}
add_shortcode( 'loginform', 'wpwebapp_login' );



// FAILED LOGIN REDIRECT

add_action('login_redirect', 'redirect_login', 10, 3);
function redirect_login($redirect_to, $url, $user) {

	// URL Variables
	$referrer = $_SERVER['HTTP_REFERER'];
    $url_clean = array_shift( explode('?', $referrer) );
    $login_failed = $url_clean . '?login=failed';

	// If the post submission is a valid page that's not the backend login screen
	if(!empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')) {
		// If the password is empty...
		if($user->errors['empty_password']){
			wp_redirect($login_failed);
		}
		// If the username is empty...
		else if($user->errors['empty_username']){
			wp_redirect($login_failed);
		}
		// If the username is invalid...
		else if($user->errors['invalid_username']){
			wp_redirect($login_failed);
		}
		// If the password is incorrect...
		else if($user->errors['incorrect_password']){
			wp_redirect($login_failed);
		}
		// Catch all for all other issues
		else {
            	wp_redirect(get_option('home'));
		}
		exit;
	}

    // Prevents page from hanging when redirected from backend
	if ( !empty($referrer) && ( strstr($referrer,'wp-login') || strstr($referrer,'wp-admin')) ) {
        	wp_redirect(get_option('home'));
        	exit;
	}
	
}



// BLOCK BACKEND ACCESS FOR NON-ADMINS

add_action( 'init', 'blockusers_init' );
function blockusers_init() {
	// If accessing the admin panel and not an admin
	if ( is_admin() && !current_user_can('level_10') ) {
		// Redirect to the homepage
		wp_redirect( home_url() );
		exit;
	}
}





/* ======================================================================
 * Password-Reset-Form-Shortcode.php
 * A PHP script and shortcode for password reset forms.
 *
 * Add a password reset form anywhere on your site by adding <?php echo wpwebapp_pwreset(); ?> to a template file.
 * You can also use the [pwreset] shortcode in the WordPress content editor.
 * ====================================================================== */

// PASSWORD RESET FORM

function wpwebapp_pwreset() {

    // Get current page URL
    $url_current  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url_current .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url_current .= $_SERVER["REQUEST_URI"];
    $url_clean = array_shift( explode('?', $url_current) );
    $reset_empty = $url_clean . '?password-reset=empty';
    $reset_failed = $url_clean . '?password-reset=failed';
    $reset_noallow = $url_clean . '?password-reset=not-allowed';

    // Variables
    $reset_status = '';

    // Errors
    if ( $url_current == $reset_empty ) {
        $reset_status = '<div class="alert alert-red">Please enter your username or email address.</div>';
    }
    if ( $url_current == $reset_failed ) {
        $reset_status = '<div class="alert alert-red">So sorry, but something went wrong. Please try again.</div>';
    }
    if ( $url_current == $reset_noallow ) {
        $reset_status = '<div class="alert alert-red">Sorry, but password resets are not allowed for this user.</div>';
    }

    // The login form
	$form = 
	    $reset_status .
        '<form id="wp_pass_reset" action="" method="post">
            <div>
                <label for="user_input">Username or Email</label>
                <input type="text" name="user_input" id="user_input" value="" tabindex="1" autofocus>
            </div>
            <div>
                <input type="hidden" name="action" value="tg_pwd_reset">
                <input type="hidden" name="tg_pwd_nonce" value="' . wp_create_nonce("tg_pwd_nonce") . '">
                <p><button type="submit" id="submitbtn" name="submit" class="btn btn-blue">Get a New Password</button></p>
            </div>
        </form>';

	// Display the form
	return $form;
}
add_shortcode( 'pwreset', 'wpwebapp_pwreset' );



// PROCESS PASSWORD RESET

// Get user IDs from the database
global $wpdb, $user_ID;

// Validates URL for form processing
// (In truth, I'm not sure why we need to do this, but the page works so I'm not touching it)
function tg_validate_url() {
	global $post;
	$page_url = esc_url(get_permalink( $post->ID ));
	$urlget = strpos($page_url, "?");
	if ($urlget === false) {
		$concate = "?";
	} 
	else {
		$concate = "&";
	}
	return $page_url.$concate;
}

// If password reset submitted, send and receive information from the database
if(isset($_GET['key']) && $_GET['action'] == "reset_pwd") {

    // Success Page
    $reset_success = get_option('home') . '?password-reset=success';

	// Define variables from form and database
	$reset_key = $_GET['key'];
	$user_login = $_GET['login'];
	$user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login));
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;

	// If the form variables are not empty
	if(!empty($reset_key) && !empty($user_data)) {
		// New password specs: 12 characters in length (You can change this number to anything you want)
		$new_password = wp_generate_password(12);
			// Generate a new password for the user
			wp_set_password( $new_password, $user_data->ID );

		// Send a password reset email with new details to user
		$message = __('Your new password for the account at:') . "\r\n\r\n";
		$message .= get_option('blogname') . "\r\n\r\n";
		$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
		$message .= sprintf(__('Password: %s'), $new_password) . "\r\n\r\n";
		$message .= __('You can now login with your new password at: ') . get_option('siteurl'). "\r\n\r\n";

		// If password reset fails
		if ( $message && !wp_mail($user_email, 'Password Reset Request', $message) ) {
			// Error message. You may want to add styling.
			echo "<p>So sorry, but something went wrong. Please try again.</p>";
			exit();
		}
		// If password reset successful
		else {
			// Redirect to homepage
			wp_safe_redirect($reset_success);
			exit();
		}
	} 
	// If reset key does not have a value
	// (Again, I'm not really sure what this means, but it works.)
	else exit('<p>Not a Valid Key.</p');
		
}

// If form submitted
if($_POST['action'] == "tg_pwd_reset"){

    // Get current page URL
    $url_current  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url_current .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url_current .= $_SERVER["REQUEST_URI"];
    $url_clean = array_shift( explode('?', $url_current) );
    $reset_empty = $url_clean . '?password-reset=empty';
    $reset_failed = $url_clean . '?password-reset=failed';
    $reset_noallow = $url_clean . '?password-reset=not-allowed';
    $reset_success = get_option('home') . '?password-reset=success';

	// Nonce to protect from bots
	if ( !wp_verify_nonce( $_POST['tg_pwd_nonce'], "tg_pwd_nonce")) {
		// If nonce verification fails
		exit("<p>No funny business please.</p>");
   }
	// If the username/email field is left empty
	if(empty($_POST['user_input'])) {
		// Error message. You may want to add styling.
		header('Location:' . $reset_empty);
		exit();
	}
	// Capture the value from the input field
	$user_input = $wpdb->escape(trim($_POST['user_input']));

	// If the value from the input field is an email (hence the @ symbol)
	if ( strpos($user_input, '@') ) {
		// Identify user by email
		$user_data = get_user_by_email($user_input);
		// Prevent admin passwords from being reset (for security)
		if(empty($user_data) || $user_data->caps[administrator] == 1) { //delete the condition $user_data->caps[administrator] == 1, if you want to allow password reset for admins also
			// Error message if user ID belongs to an admin. You may want to add styling.
            header('Location:' . $reset_noallow);
            exit();
		}
	}
	// If the value from the input field is a username
	else {
		// Identify user by username
		$user_data = get_userdatabylogin($user_input);
		// Prevent admin passwords from being reset (for security)
		if(empty($user_data) || $user_data->caps[administrator] == 1) { //delete the condition $user_data->caps[administrator] == 1, if you want to allow password reset for admins also
			// Error message if user ID belongs to an admin. You may want to add styling.
            header('Location:' . $reset_noallow);
            exit();
		}
	}

	// Define user variables
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;

	// Get data from the database
	$key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
	if(empty($key)) {
		// Generate a reset key
		$key = wp_generate_password(20, false);
		$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));	
	}
		
	// Mail the reset details to the user
	$message = __('A password reset was requested for the following account:') . "\r\n\r\n";
	$message .= get_option('siteurl') . "\r\n\r\n";
	$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
	$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
	$message .= __('To activate your new password, visit the following address:') . "\r\n\r\n";
	$message .= tg_validate_url() . "action=reset_pwd&key=$key&login=" . rawurlencode($user_login) . "\r\n";

	// If a reset email was not sent
	if ( $message && !wp_mail($user_email, 'Password Reset Request', $message) ) {
		// Error message. You may want to add styling.
        header('Location:' . $reset_failed);
        exit();
	}
	// If a reset email was successfully sent
	else {
		// Success message. You may want to add styling.
        header('Location:' . $reset_success);
        exit();
	}
		
}





/* ======================================================================
 * Signup-Form-Shortcode.php
 * A PHP script and shortcode for the WordPress signup form.
 *
 * Add a signup form anywhere on your site by adding <?php echo wpwebapp_signupform(); ?> to a template file.
 * You can also use the [signupform] shortcode in the WordPress content editor.
 * ====================================================================== */

// SIGNUP FORM

function wpwebapp_signupform() {

    // Get current page URL
    $url_current  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url_current .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url_current .= $_SERVER["REQUEST_URI"];
    $url_clean = array_shift( explode('?', $url_current) );
    $signup_empty = $url_clean . '?signup=empty';
    $signup_invalid_email = $url_clean . '?signup=invalid-email';
    $signup_email_exists = $url_clean . '?signup=email-exists';
    $signup_nochar = $url_clean . '?signup=special-characters';
    $signup_username_exists = $url_clean . '?signup=username-exists';
    $signup_failed = $url_clean . '?signup=failed';
    $signup_success = get_option('home') . '?signup=success';

    // Variables
    $signup_status = '';

    // Errors
    if ( $url_current == $signup_empty ) {
        $signup_status = '<div class="alert alert-red">Please enter a username and email address.</div>';
    }
    if ( $url_current == $signup_invalid_email ) {
        $signup_status = '<div class="alert alert-red">Please use a valid email address.</div>';
    }
    if ( $url_current == $signup_email_exists ) {
        $signup_status = '<div class="alert alert-red">This email address is already in use. <a href="' . get_option('home') . '/password-reset">Forgot your password?</a></div>';
    }
    if ( $url_current == $signup_nochar ) {
        $signup_status = '<div class="alert alert-red">Special characters are not allowed for usernames.</div>';
    }
    if ( $url_current == $signup_username_exists ) {
        $signup_status = '<div class="alert alert-red">This username is already in use. <a href="' . get_option('home') . '/password-reset">Forgot your password?</a></div>';
    }
    if ( $url_current == $signup_failed ) {
        $signup_status = '<div class="alert alert-red">Something went wrong. Please try again.</div>';
    }


    // The login form
	$form = 
	    $signup_status . 
        '<form name="my-registration-form" id="my-registration-form" action="' . add_query_arg('do', 'register', get_permalink( $post->ID )) . '" method="post">
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="user" value="" tabindex="1" autofocus>
            </div>
            <div>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="" tabindex="2">
            </div>
            <div>
                <input type="hidden" name="signup" value="signup">
                <p><button type="submit" name="register-submit" id="register-submit" class="btn btn-blue" tabindex="100">Register</button></p>
            </div>
        </form>';

	// Display the form
	return $form;
}
add_shortcode( 'signupform', 'wpwebapp_signupform' );



// PROCESS SIGNUP FORM

// If user has submitted a registration form
if ($_POST['signup'] ) {

    // Get current page URL
    $url_current  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url_current .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url_current .= $_SERVER["REQUEST_URI"];
    $url_clean = array_shift( explode('?', $url_current) );
    $signup_empty = $url_clean . '?signup=empty';
    $signup_invalid_email = $url_clean . '?signup=invalid-email';
    $signup_email_exists = $url_clean . '?signup=email-exists';
    $signup_nochar = $url_clean . '?signup=special-characters';
    $signup_username_exists = $url_clean . '?signup=username-exists';
    $signup_failed = $url_clean . '?signup=failed';
    $signup_success = get_option('home') . '?signup=success';


    // Define Variables
	$user_login = $_POST['user'];
	$user_email = $_POST['email'];
	$sanitized_user_login = sanitize_user($user_login);
	$user_email = apply_filters('user_registration_email', $user_email);


	// If the username or email fields are empty
	if(empty($_POST['user']) || empty($_POST['email'])) {
        header('Location:' . $signup_empty);
        exit();
	}
    // If the email field does not contain a valid email address
	else if (!is_email($user_email)) {
        header('Location:' . $signup_invalid_email);
        exit();
	}
	// If the email already belongs to a registered user
	else if (email_exists($user_email)) {
        header('Location:' . $signup_email_exists);
        exit();
	}

    // If the username field contains special characters
	else if (empty($sanitized_user_login) || !validate_username($user_login)) {
        header('Location:' . $signup_nochar);
        exit();
	}
	// If username already belongs to a registered user
	else if (username_exists($sanitized_user_login)) {
        header('Location:' . $signup_username_exists);
        exit();
	}
    // If there are no errors
    else {
	    // Create a password
		$user_pass = wp_generate_password();
		// Register the username and email address provided
		$user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);
	}

    // If WordPress messes something up
	if (!$user_id) {
        header('Location:' . $signup_failed);
        exit();
	}
    // Otherwise, send user their login information
	else {
		update_user_option($user_id, 'default_password_nag', true, true);
		wp_new_user_notification($user_id, $user_pass);
        header('Location:' . $signup_success);
        exit();
	}

}





/* ======================================================================
 * Password-Change-Form-Shortcode.php
 * A PHP script and shortcode for the WordPress password change form.
 *
 * Add a password change form anywhere on your site by adding <?php echo wpwebapp_pwform(); ?> to a template file.
 * You can also use the [pwchangeform] shortcode in the WordPress content editor.
 * ====================================================================== */

// CHANGE PASSWORD FORM

function wpwebapp_pwform() {

    // Get current page URL
    $url_current  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url_current .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url_current .= $_SERVER["REQUEST_URI"];
    $url_clean = array_shift( explode('?', $url_current) );
    $change_pw_mismatch = $url_clean . '?change=password-match';
    $change_no_pw = $url_clean . '?change=no-password';
    $change_pw_short = $url_clean . '?change=too-short';
    $change_current_pw_mismatch = $url_clean . '?change=wrong-password';
    $change_success = $url_clean . '?change=success';

    // Variables
    $change_status = '';

    // Errors
    if ( $url_current == $change_pw_mismatch ) {
        $change_status = '<div class="alert alert-red">The passwords your entered didn\'t match. Please try again.</div>';
    }
    if ( $url_current == $change_no_pw ) {
        $change_status = '<div class="alert alert-red">Please enter your current password.</div>';
    }
    if ( $url_current == $change_pw_short ) {
        $change_status = '<div class="alert alert-red">Your new password is too short. Please choose a password that\'s at least 8 characters long.</div>';
    }
    if ( $url_current == $change_current_pw_mismatch ) {
        $change_status = '<div class="alert alert-red">The password you entered does not match your current password.</div>';
    }
    if ( $url_current == $change_success ) {
        $change_status = '<div class="alert alert-green"><strong>Success!</strong> Your password has been updated.</div>';
    }


    // The login form
	$form = 
	    $change_status . 
        '<form name="login" action="' . get_permalink( $post->ID ) . '" method="post">
            <div>
                <label for="currentpass">Current Password</label>
                <input type="password" name="currentpass" id="currentpass" class="input-large" value="" tabindex="1" autofocus>
            </div>
            <div>
                <labelfor="pass1">
                    New Password<br>
                    <em class="text-muted text-small">Must be at least 8 characters long</em>
                </label>
                <input type="password" name="pass1" id="pass1" class="input-large" value="" tabindex="2">
            </div>
            <div>
                <label for="pass2">Verify Password</label>
                <input type="password" name="pass2" id="pass2" class="input-large" value="" tabindex="3">
            </div>
            <div>
                <?php echo $referer; ?>
                <button name="updateuser" type="submit" id="updateuser" class="btn btn-blue" tabindex="100">Update Password</button>
                ' . wp_nonce_field( 'update-user' ) . '
                <input name="action" type="hidden" id="action" value="update-user">
            </div>
        </form>';

	// Display the form
	return $form;
}
add_shortcode( 'pwchangeform', 'wpwebapp_pwform' );



// PROCESS CHANGE PASSWORD FORM

// Get user info.
global $current_user, $wp_roles;
get_currentuserinfo();

// Load the registration file.
require_once( ABSPATH . WPINC . '/registration.php' );

// If profile was saved, update profile.
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    // Get current page URL
    $url_current  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url_current .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url_current .= $_SERVER["REQUEST_URI"];
    $url_clean = array_shift( explode('?', $url_current) );
    $change_pw_mismatch = $url_clean . '?change=password-match';
    $change_no_pw = $url_clean . '?change=no-password';
    $change_pw_short = $url_clean . '?change=too-short';
    $change_current_pw_mismatch = $url_clean . '?change=wrong-password';
    $change_success = $url_clean . '?change=success';

	// If current password correct
	if ( user_pass_ok( $current_user->user_login, $_POST['currentpass'] ) ) {

		// If new password at least 8 characters long (You can change this number to suit your needs )
		if ( strlen($_POST['pass1']) >= 8 ) {

			// If both fields completed
			if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {

				// If new and verify fields match
				if ( $_POST['pass1'] == $_POST['pass2'] ) {
					// Success!
					wp_update_user( array( 'ID' => $current_user->id, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
                    header('Location:' . $change_success);
                    exit();
				}
				// Error messages. You may want to add some styling to these and the success message.
				else {
                    header('Location:' . $change_pw_mismatch);
                    exit();
				}

			}

			else {
                header('Location:' . $change_no_pw);
                exit();
			}

		}

		else {
            header('Location:' . $change_pw_short);
            exit();
		}

	}

	else {
        header('Location:' . $change_current_pw_mismatch);
        exit();
	}
}





/* ======================================================================
 * Disable-Admin-Bar.php
 * Disable admin bar for all users.
 * Script by Chris Ferdinandi - http://gomakethings.com
 * ====================================================================== */

function my_function_admin_bar(){
    return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');



// Don't delete this line or you'll break WordPress ?>
