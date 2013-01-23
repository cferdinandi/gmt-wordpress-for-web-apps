<?php /*
Template Name: Register
*/

// Code WordPress uses to register a new user

// If user has submitted a registration form
if ( isset( $_GET['do'] ) && $_GET['do'] == 'register' ) :
	$errors = array();

	// If the username or email fields are empty, display an error
	if(empty($_POST['user']) || empty($_POST['email'])) $errors[] = 'Please enter a username and email address. ';

	$user_login = esc_attr($_POST['user']);
	$user_email = esc_attr($_POST['email']);
	$sanitized_user_login = sanitize_user($user_login);
	$user_email = apply_filters('user_registration_email', $user_email);

    // If the email field does not contain a valid email address, display an error
	if(!is_email($user_email)) $errors[] = 'Please use a valid email address.';
	// If the email already belongs to a registered user, display an error
	elseif(email_exists($user_email)) $errors[] = 'Sorry, but this email address is already registered. ';

    // If the username field contains special characters, display an error
	if(empty($sanitized_user_login) || !validate_username($user_login)) $errors[] = 'Sorry, but special characters are not allowed for a username.';
	// If username already belongs to a registered user, display an error
	elseif(username_exists($sanitized_user_login)) $errors[] = 'Sorry, but this username already exists. ';

    // If there are no errors...
	if(empty($errors)):
	    // Create a password
		$user_pass = wp_generate_password();
		// Register the username and email address provided
		$user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);

    // If WordPress messes something up, display an error
	if(!$user_id):
		$errors[] = 'Registration failed';
    // Otherwise, send user their login information
	else:
		update_user_option($user_id, 'default_password_nag', true, true);
		wp_new_user_notification($user_id, $user_pass);
	endif;
endif;

if(!empty($errors)) define('REGISTRATION_ERROR', serialize($errors));
else define('REGISTERED_A_USER', $user_email);
endif;

get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); // If the page exists... ?>

        		<!-- Add your content here: page titles, additional text, etc. -->

			<?php // If errors exist, display them here
				if(defined('REGISTRATION_ERROR')){
					foreach(unserialize(REGISTRATION_ERROR) as $error){
						echo '<div class="alert alert-red">' . $error . '</div>';
					}					    
				}
				elseif(defined('REGISTERED_A_USER')){ // If no errors exist and user is successfully registered, display success message here
					echo '<div class="alert alert-green">Successful registration, an email has been sent to ' . REGISTERED_A_USER . '</div>';
					}
			?>

            <!-- The Registration Form -->
			<form name="my-registration-form" id="my-registration-form" action="<?php echo add_query_arg('do', 'register', get_permalink( $post->ID )); ?>" method="post">
				<div>
					<label for="username">Username</label>
					<input type="text" id="username" name="user" value="" tabindex="1" autofocus>
				</div>
				<div>
					<label for="email">E-mail</label>
					<input type="email" id="email" name="email" value="" tabindex="2">
				</div>
				<div>
					<input type="submit" name="register-submit" id="register-submit" value="Register" tabindex="100">
				</div>
			</form>


			<?php edit_post_link('[Edit]', '<p>', '</p>'); ?>

		<?php endwhile; endif; // end if page exists statement ?>

<?php get_footer(); ?>
