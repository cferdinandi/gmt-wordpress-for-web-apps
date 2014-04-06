<?php

/* ======================================================================

	WordPress for Web Apps Display Gravatar
	Shortcode to display the gravatar of the currently logged-in user.

 * ====================================================================== */

function wpwebapp_display_gravatar( $atts ) {
	global $current_user;
	$user_id = $current_user->ID;
	$size = wpwa_get_profile_gravatar_size();
	$gravatar = get_avatar( $user_id, $size );
	return $gravatar;
}
add_shortcode( 'wpwa_display_gravatar', 'wpwebapp_display_gravatar' );

?>