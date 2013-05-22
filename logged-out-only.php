<?php 

// If user is logged in, redirect them to the homepage
if (is_user_logged_in()) {
	wp_redirect( home_url() );
	exit;
}

get_header(); /*
Template Name: Logged Out Only
*/

/* ======================================================================
 * logged-out-only.php
 * Template for content only accessible to logged-out users.
 * (For example, a reset lost password page.)
 * ====================================================================== */
?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <header>
        <h1><?php the_title(); ?></h1>
    </header>

    <?php the_content(); ?>

<?php endwhile; endif; ?>


<?php get_footer(); ?>
