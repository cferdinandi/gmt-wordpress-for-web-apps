<?php

/* ======================================================================

    Password Change Form Shortcode v1.0
    A PHP script and shortcode for the WordPress password change form.

    Add a password change form anywhere on your site by adding <?php echo wpwebapp_pwform(); ?> to a template file.
    You can also use the [pwchangeform] shortcode in the WordPress content editor.
    
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

?>
