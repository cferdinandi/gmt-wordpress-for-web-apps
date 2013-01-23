<?php 
/* Template Name: Favorites Button */

/*
 * Made by Chris Ferdinandi, http://gomakethings.com
 * Licensed under the GNU Public License
 * http://www.gnu.org/copyleft/gpl.html
 */

// PROCESS FAVORITES BUTTON

	// Get User Info
	global $current_user, $wp_roles;
	get_currentuserinfo();

	// Load the registration file
	require_once( ABSPATH . WPINC . '/registration.php' );

	// Get user meta, which is where the list of favorite posts are stored
	$faves = get_user_meta($current_user->id, 'faveposts', true);
	// Convert list into an array
	$favesArray = explode(',',$faves);

	// DEFINE VARIABLES AND ACTIONS
	// The current post ID
	$postID = $post->ID;
	// Adds current post ID to list of favorites
	$favesPlus = $faves . ',' . $postID;
	// Removes current post ID from list of favorites
	$favesScrub = array_diff($favesArray,array($postID));
	// Converts scrubbed favorites list from an array back into a comma-separated list
	$favesMinus = implode(',',$favesScrub);

	// If the current post is already a favorite
	if (in_array($postID, $favesArray)) {
		// Text to display for the button
		$btnTxt = 	'<button name="favebutton" type="submit" id="favebutton">Remove from Favorites</button>';
		// Action the button should take
		$btnInput = 'fave-button-remove';
	}
	// If the current post is NOT already a favorite
	else {
		// Text to display for the button
		$btnTxt = 	'<button name="favebutton" type="submit" id="favebutton">Add to Favorites</button>';
		// Action the button should take
		$btnInput = 'fave-button-add';
	}


	// If the Favorites Button is clicked and user is removing post from favorites
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'fave-button-remove' ) {
		// Update user meta and refresh the page to show updated info
		update_user_meta( $current_user->id, 'faveposts', $favesMinus );
		wp_redirect( get_permalink() );
		exit;
	}


	// If the Favorites Button is clicked and user is adding post from favorites
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'fave-button-add' ) {
		// Update user meta and refresh the page to show updated info
		update_user_meta( $current_user->id, 'faveposts', $favesPlus );
		wp_redirect( get_permalink() );
		exit;
	}

get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); // If the page exists... ?>

		<?php if (is_user_logged_in()) : // Verify that the user is logged in before displaying favorite posts button. ?>
			<!-- The Button -->
			<form method="post" class="save-favorites" id="save-favorites" action="<?php the_permalink(); ?>">
				<?php echo $referer; ?>
				<?php echo $btnTxt; // The actual button text gets pulled from the variable in the header ?>
				<?php wp_nonce_field( "fave-button" ) ?>
				<input name="action" type="hidden" id="action" value="<?php echo $btnInput; // action to be taken when button is clicked. controlled by variable in header. ?>">
			</form>
		<?php endif; ?>

		<!-- Add your content here: page titles, additional text, etc. -->

	<?php endwhile; endif; // end if page exists statement ?>


<script>
// Ajax to process button click without reloading the entire page
// Requires jQuery
jQuery('document').ready(function($){
	$("#favebutton").live('click',  function () {
		// Display "Saving..." text when button clicked so users know button is processing
		$("#favebutton").html('Saving...');
		// Serialize the form data
		var input_data = $('#save-favorites').serialize();
		// Send form data via Ajax
		$.ajax({
			type: "POST",
			url: "<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",
			data: input_data,
			success: function() {
				// If successfully sent, reload form button to display updated info
				$("#fave-nav").load(location.href + " #fave-nav");
			}
		});
		return false;
	});
});
</script>

<?php get_footer(); ?>
