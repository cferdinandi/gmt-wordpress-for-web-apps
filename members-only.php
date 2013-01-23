<?php 
/* Template Name: Members Only */

/*
 * Made by Chris Ferdinandi, http://gomakethings.com
 * Licensed under the GNU Public License
 * http://www.gnu.org/copyleft/gpl.html
 */

// Require login/signup to view content

get_header(); ?>


	<?php if (is_user_logged_in()) : // If the user is logged in ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); // If the page exists... ?>
			<!-- Page content goes here -->
		<?php endwhile; endif; // end if page exists statement ?>

	<?php else : // If the user is NOT logged in ?>
		<!-- Content to show users who are not logged in -->

	<?php endif; // End "If user logged in" statement ?>


<?php get_footer(); ?>
