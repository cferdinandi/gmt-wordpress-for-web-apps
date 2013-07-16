<?php

/* ======================================================================

    Login Form Shortcode v1.0
    A PHP script and shortcode for the WordPress login form.

    Add a login form anywhere on your site by adding <?php echo wpwebapp_login(); ?> to a template file.
    You can also use the [loginform] shortcode in the WordPress content editor.
    
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

?>
