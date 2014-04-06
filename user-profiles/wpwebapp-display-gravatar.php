<?php

/* ======================================================================

	WordPress for Web Apps Display Gravatar
	Shortcode to display the gravatar of the currently logged-in user.

 * ====================================================================== */

function wpwebapp_display_gravatar( $atts ) {
	extract(shortcode_atts(array(
	    'size' => '96',
	), $atts));
	global $current_user;
	$user_id = $current_user->ID;
	return get_avatar( $user_id, $size );
}
add_shortcode( 'wpwa_display_gravatar', 'wpwebapp_display_gravatar' );

?>