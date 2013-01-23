<?php
/* Template Name: Password Lost */

/*
 * Made by Chris Ferdinandi, http://gomakethings.com
 * Licensed under the GNU Public License
 * http://www.gnu.org/copyleft/gpl.html
 */

// If user is logged in, redirect them to the homepage
// (i.e. logged in users can't reset their password)
if (is_user_logged_in()) {
	wp_redirect( home_url() );
	exit;
}

// PROCESS PASSWORD RESET FORM

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
			// Redirect to sign-in page (the one included in this kit displays a success message)
			$redirect_to = get_bloginfo('url')."/login/?password-reset";
			wp_safe_redirect($redirect_to);
			exit();
		}
	} 
	// If reset key does not have a value
	// (Again, I'm not really sure what this means, but it works.)
	else exit('<p>Not a Valid Key.</p');
		
}

// If form submitted
if($_POST['action'] == "tg_pwd_reset"){
	// Nonce to protect from bots
	if ( !wp_verify_nonce( $_POST['tg_pwd_nonce'], "tg_pwd_nonce")) {
		// If nonce verification fails
		exit("<p>No funny business please.</p>");
   }
	// If the username/email field is left empty
	if(empty($_POST['user_input'])) {
		// Error message. You may want to add styling.
		echo "<p>Please enter your username or email address</p>";
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
			echo "<p>Sorry, but password resets are not allowed for this user. Please contact the app developer.</p>";
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
			echo "<p>Sorry, but password resets are not allowed for this user. Please contact the app developer.</p>";
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
		echo "<p>So sorry, but something went wrong. Please try again.</p>";
		exit();
	}
	// If a reset email was successfully sent
	else {
		// Success message. You may want to add styling.
		echo "<p>We just sent you an email with password reset instructions. Thanks!</p>";
		exit();
	}
		
}

get_header(); ?>


	<?php if (have_posts()) : while (have_posts()) : the_post(); // If the page exists... ?>

		<!-- Add your content here: page titles, additional text, etc. -->

		<!-- The Password Reset Form -->
		<form id="wp_pass_reset" action="" method="post">
			<div>
				<label for="user_input">Username or Email</label>
				<input type="text" name="user_input" id="user_input" value="" tabindex="1" autofocus>
			</div>
			<div>
				<input type="hidden" name="action" value="tg_pwd_reset">
				<input type="hidden" name="tg_pwd_nonce" value="<?php echo wp_create_nonce("tg_pwd_nonce"); ?>">
				<input type="submit" id="submitbtn" name="submit" value="Get a New Password">
			</div>
		</form>


	<?php endwhile; endif; // end if page exists statement ?>


<script>
// Process login with Ajax to prevent redirect to WordPress backend
// Requires jQuery
$(function () {
	// Find the form
	var passForm=$('#wp_pass_reset');
	// Add info panel after the form to provide feedback or errors
	passForm.prepend('<div id="result" ></div>');

	// When form is submitted
	passForm.submit(function() {
		// Display a "Validating..." message. You may want to add styling.
		$('#result').html('<p>Validating...</p');
		// Serialize the data
		var input_data = passForm.serialize();
		// Process the form with Ajax
		$.ajax({
			type: "POST",
			url:  "<?php echo get_permalink( $post->ID ); ?>",
			data: input_data,
			success: function(msg){
				// If password successfully reset, display success message
				$('#result').html(msg);
			}
		});
		return false;
			
	});
});
</script>

<?php get_footer(); ?>
