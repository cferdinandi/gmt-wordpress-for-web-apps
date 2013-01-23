<?php
/* Template Name: Join */

/*
 * Made by Chris Ferdinandi, http://gomakethings.com
 * Licensed under the GNU Public License
 * http://www.gnu.org/copyleft/gpl.html
 */

// PROCESS JOIN REQUEST

// Invite Form
// If the form is submitted
if(isset($_POST['submitted'])) {

	// Check to make sure that the name field is not empty
	if(trim($_POST['contactName']) === '') {
		$nameError = 'You forgot to enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
		
	// Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) === '')  {
		$emailError = 'You forgot to enter your email address.';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
	
	// If there is no error, send the email
	if(!isset($hasError)) {

		// Add your email address to the $emailTo field
		$emailTo = 'YOUR EMAIL ADDRESS HERE';
		$subject = 'Invitation Request from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nEmail: $email";
		$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		// What to include in the email
		mail($emailTo, $subject, $body, $headers);

		// Verify if email was sent or not
		$emailSent = true;

	}
}
 
get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); // If the page exists... ?>

		<!-- Add your content here: page titles, additional text, etc. -->

		<?php if($emailSent == 'TRUE') : // If the request was successfully submitted ?>

			<!-- Add your success message here. -->

		<?php else : // If request not yet submitted ?>

				<!-- The Request to Join Form -->
				<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
					<div>
						<?php if($nameError != '') { // If there's an error with the name field ?><?=$nameError; // error message (set in header) ?><?php } ?>
						<label for="contactName">Name</label>
						<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" tabindex="1" autofocus>
					</div>
					<div>
						<?php if($emailError != '') { // If there's an error with the email field ?><?=$emailError; // error message (set in header) ?><?php } ?>
						<label  for="email">Email</label>
						<input type="email" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" tabindex="2">
					</div>
					<div>
						<input type="hidden" name="submitted" id="submitted" value="true">
						<button type="submit" tabindex="100">Request an Invite</button>
					</div>
				</form>

		<?php endif; ?>

	<?php endwhile; endif; // end if page exists statement ?>

<?php get_footer(); ?>
