<?php 
/* Template Name: Login */

/*
 * Made by Chris Ferdinandi, http://gomakethings.com
 * Licensed under the GNU Public License
 * http://www.gnu.org/copyleft/gpl.html
 */


// If user is logged in already, redirect them to the homepage
if (is_user_logged_in()) {
	wp_redirect( home_url() );
	exit;
}


// Get header info
get_header(); ?>



	<?php if (have_posts()) : while (have_posts()) : the_post(); // If the page exists... ?>

		<!-- Add your content here: page titles, additional text, etc. -->


		<?php if (stripos($_SERVER['REQUEST_URI'], '/login/?password-reset') !== false) : // If password was reset successfully ?>
			<p>Your password was successfully reset. We just emailed you a new one. Sign-in below.</p>
		<?php endif; ?>

		<?php if (stripos($_SERVER['REQUEST_URI'], '/login/?login=failed') !== false) : // If login failed ?>
			<p>Invalid username or password. Please try again!</p>
		<?php endif; ?>


		<!-- The Login Form -->
		<form name="login" id="wp_login_form" action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
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
					<input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90">
					Remember Me
				</label>
			</div>
			<div>
				<input type="submit" name="wp-submit" id="wp-submit" value="Log In" tabindex="100">
				<input type="hidden" name="action" value="login">
				<input type="hidden" name="redirect_to" value="<?php echo get_option('home'); ?>/">
				<input type="hidden" name="testcookie" value="1">
			</div>
		</form>


		<!-- Links to request an invitation or reset a lost password. Add URLs. -->
		<p><a href="#">Request an Invite</a> | <a href="#">Lost Password?</a></p>


	<?php endwhile; endif; // end if page exists statement ?>


<?php get_footer(); // Get the footer ?>
