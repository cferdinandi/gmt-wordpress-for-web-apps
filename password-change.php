<?php
/* Template Name: Password Change */

/*
 * Made by Chris Ferdinandi, http://gomakethings.com
 * Licensed under the GNU Public License
 * http://www.gnu.org/copyleft/gpl.html
 */

// FORM PROCESSING

// Get user info.
global $current_user, $wp_roles;
get_currentuserinfo();

// Load the registration file.
require_once( ABSPATH . WPINC . '/registration.php' );

// If profile was saved, update profile.
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

	// If current password correct
	if ( user_pass_ok( $current_user->user_login, $_POST['currentpass'] ) ) {

		// If new password at least 8 characters long (You can change this number to suit your needs )
		if ( strlen($_POST['pass1']) >= 8 ) {

			// If both fields completed
			if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {

				// If new and verify fields match
				if ( $_POST['pass1'] == $_POST['pass2'] ) {
					// Success!
					wp_update_user( array( 'ID' => $current_user->id, 'user_pass' => esc_attr( $_POST['pass1'] ) ) ) && $error = __('<p>Your password has been updated.</p>', 'profile');
				}
				// Error messages. You may want to add some styling to these and the success message.
				else {
					$error = __('<p>The passwords you entered do not match. Your password was not updated.</p>', 'profile');
				}

			}

			else {
				$error = __('<p>Please enter a password.</p>', 'profile');
			}

		}

		else {
			// Again, you can change the password length requirement.
			$error = __('<p>Your password is less than 8 characters long. Please choose a longer password.</p>', 'profile');
		}

	}

	else {
		$error = __('<p>The password you entered does not match your current password. Please try again.</p>', 'profile');
	}

    // Redirect so the page will show updated info.
    if ( !$error ) {
        wp_redirect( get_permalink() );
        exit;
    }
}

get_header(); ?>

	<?php if (is_user_logged_in()) : // Verify that the user is logged in before displaying password update form. ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); // If the page exists... ?>


				<!-- Add your content here: page titles, additional text, etc. -->


				<?php if ( $error ) echo $error; // Display error/success messages ?>

				<!-- The Password Change Form -->
				<form class="text-center" name="login" id="adduser" action="<?php the_permalink(); ?>" method="post">
					<div>
						<label for="currentpass">Current Password</label>
						<input type="password" name="currentpass" id="currentpass" class="input-large" value="" tabindex="1" autofocus>
					</div>
					<div>
						<labelfor="pass1">
							New Password<br>
							<em>Must be at least 8 characters long</em>
						</label>
						<input type="password" name="pass1" id="pass1" class="input-large" value="" tabindex="2">
					</div>
					<div>
						<label for="pass2">Verify Password</label>
						<input type="password" name="pass2" id="pass2" class="input-large" value="" tabindex="3">
					</div>
					<div>
						<?php echo $referer; ?>
						<input name="updateuser" type="submit" id="updateuser" class="btn btn-primary" value="<?php _e('Update', 'profile'); ?>" tabindex="100">
						<?php wp_nonce_field( 'update-user' ) ?>
						<input name="action" type="hidden" id="action" value="update-user">
					</div>
				</form>

		<?php endwhile; endif; // end if page exists statement ?>


	<?php else : ?>
		<!-- If the user isn't logged in, what they'll see instead -->
	<?php endif; ?>


<?php get_footer(); ?>
