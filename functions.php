<?php

/* ======================================================================

    Functions.php
    For modifying and expanding core WordPress functionality.

    If your theme does not have a functions.php file, add this file to your theme.
    If functions.php already exists, copy-and-paste the text below into it.

    Remove the "#" before a function to activate it.
    Add a "#" before a function to deactivate it.
    
 * ====================================================================== */

require_once('functions/login-form-shortcode.php'); // A login form
require_once('functions/password-reset-form-shortcode.php'); // A password reset form
require_once('functions/signup-form-shortcode.php'); // A signup form
require_once('functions/password-change-form-shortcode.php'); // A password change form
require_once('functions/logout-link-shortcode.php'); // A logout link shortcode
require_once('functions/disable-admin-bar.php'); // Disable the admin bar for all users

?>
