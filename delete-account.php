<?php
/* Template Name: Delete Account */

/*
 * Made by Chris Ferdinandi, http://gomakethings.com
 * Licensed under the GNU Public License
 * http://www.gnu.org/copyleft/gpl.html
 */

// PROCESS FORM
// Wordpress will not allow users to delete their own accounts. This sends an email to the site admin requesting an account deletion.

// Get user info
global $current_user, $wp_roles;
get_currentuserinfo();

// Delete Form
// If the form is submitted
if(isset($_POST['submitted'])) {

	// Send the email
	// Don't forget to add your email address to $emailTo
	$emailTo = 'YOUR EMAIL ADDRESS HERE';
	$subject = 'Account Deletion Request:'. $current_user->user_login;
	$sendCopy = trim($_POST['sendCopy']);
	$body = "Username: $current_user->user_login \n\nEmail: $current_user->user_email";
	$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $current_user->user_email;

	// Contents of email
	mail($emailTo, $subject, $body, $headers);

	// Verify if email was sent or not
	$emailSent = true;

}

get_header(); ?>

	<?php if (is_user_logged_in()) : // Verify that the user is logged in before displaying account deletion request. ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); // If the page exists... ?>


			<!-- Add your content here: page titles, additional text, etc. -->


			<?php if($emailSent != 'TRUE') : // if the request has not been sent ?>

				<!-- Account Deletion Request Button -->
				<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
					<input type="hidden" name="submitted" id="submitted" value="true">
					<button type="submit" tabindex="100">Delete My Account</button>
				</form>

			<?php endif; // End request not sent if statement ?>


			<?php if($emailSent == 'TRUE') : // If request WAS sent ?>
				<!-- Add a success message here. -->
			<?php endif; ?>


		<?php endwhile; endif; // end if page exists statement ?>


	<?php else : ?>
		<!-- If the user isn't logged in, what they'll see instead -->
	<?php endif; ?>

<?php get_footer(); ?>
