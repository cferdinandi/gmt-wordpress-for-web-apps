<?php get_header(); /*
Template Name: Logged In Only
*/

/* ======================================================================
 * logged-in-only.php
 * Template for content only accessible to logged-in users.
 * ====================================================================== */
?>

<?php if (is_user_logged_in()) : // If the user is logged in ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php the_content(); ?>

    <?php endwhile; endif; ?>


<?php else : // If the user is NOT logged in ?>

    <!-- Content for logged-out users. -->


<?php endif; // End "If user logged in" statement ?>


<?php get_footer(); ?>
