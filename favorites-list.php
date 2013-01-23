<?php 
/* Template Name: Favorites List */

/*
 * Made by Chris Ferdinandi, http://gomakethings.com
 * Licensed under the GNU Public License
 * http://www.gnu.org/copyleft/gpl.html
 */

// Displays a list of a logged in user's favorite posts. Use in conjunction with Favorite Button template.

get_header(); ?>

	<?php if (is_user_logged_in()) : // Verify that the user is logged in before displaying favorite posts. ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); // If the page exists... ?>


				<!-- Add your content here: page titles, additional text, etc. -->

				<!-- Display favorite posts as an unordered list. -->
				<ul>

					<?php //start favorites list
						// Get user info.
						global $current_user, $wp_roles;
						get_currentuserinfo();

						// Load the registration file.
						require_once( ABSPATH . WPINC . '/registration.php' );

						// Get user meta, convert to an array, and sort post ID's low to high
						// unset removes first value, which is blank and causes current page info to show instead
						$myFaves = get_user_meta($current_user->id, 'faveposts', true);
						$myFavesArray = explode(',',$myFaves);
						unset($myFavesArray[0]);
						sort($myFavesArray);

						// For each favorite post...
						foreach ($myFavesArray as $myFave) :
					?>

						<li>
							<a href="<?php echo get_permalink( $myFave ); // get the URL of the post ?>">
								<?php echo get_the_title($myFave); // get the title of the post ?>
							</a>
							<!-- Using the $myFave variable, you can get a lot of additional information on each favorite post. $myFave = the post ID. -->
						</li>

					<?php endforeach; //end favorites list ?>
				</ul>

		<?php endwhile; endif; // end if page exists statement ?>


	<?php else : ?>
		<!-- If the user isn't logged in, what they'll see instead -->
	<?php endif; ?>

<?php get_footer(); ?>
