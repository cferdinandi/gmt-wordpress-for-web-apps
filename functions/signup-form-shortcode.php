<?php

/* ======================================================================

    Signup Form Shortcode v1.0
    A PHP script and shortcode for the WordPress signup form.

    Add a signup form anywhere on your site by adding <?php echo wpwebapp_signupform(); ?> to a template file.
    You can also use the [signupform] shortcode in the WordPress content editor.
    
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

?>
