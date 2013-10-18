<?php

/* ======================================================================

    Plugin Name: WordPress for Web Apps
    Plugin URI: http://cferdinandi.github.io/web-app-starter-kit/
    Description: Transform WordPress into a web app engine.
    Version: 3.2
    Author: Chris Ferdinandi
    Author URI: http://gomakethings.com
    License: MIT

 * ====================================================================== */

// The files to run WordPress for Web Apps
require_once( dirname( __FILE__) . '/wpwebapp-options.php' );
require_once( dirname( __FILE__) . '/wpwebapp-option-defaults.php' );
require_once( dirname( __FILE__) . '/wpwebapp-helpers.php' );
require_once( dirname( __FILE__) . '/wpwebapp-security.php' );
require_once( dirname( __FILE__) . '/wpwebapp-user-access.php' );
require_once( dirname( __FILE__) . '/wpwebapp-navigation.php' );
require_once( dirname( __FILE__) . '/wpwebapp-emails.php' );
require_once( dirname( __FILE__) . '/wpwebapp-forms.php' );

?>