<?php

/**
 * Plugin Name: WordPress for Web Apps
 * Plugin URI: https://github.com/cferdinandi/wordpress-for-web-apps/
 * GitHub Plugin URI: https://github.com/cferdinandi/wordpress-for-web-apps/
 * Description: Transform WordPress into a web app engine. Adjust your settings under <a href="options-general.php?page=wpwebapp_plugin_options">Web App Options</a>.
 * Version: 5.4.2
 * Author: Chris Ferdinandi
 * Author URI: http://gomakethings.com
 * License: MIT
 */

// Includes
require_once( plugin_dir_path( __FILE__ ) . 'includes/wp-session-manager/wp-session-manager.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/wpwebapp-helpers.php' );

// Options
require_once( plugin_dir_path( __FILE__ ) . 'options/wpwebapp-options.php' );

// Shortcodes
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpwebapp-signup.php' ); // Sign up for an account
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpwebapp-login.php' ); // Login
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpwebapp-password-reset.php' ); // Reset Password
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpwebapp-password-change.php' ); // Change Password
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpwebapp-email-change.php' ); // Change Email
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpwebapp-delete-account.php' ); // Delete Account
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpwebapp-navigation.php' ); // Nav menu shortcodes

// Security and Access
require_once( plugin_dir_path( __FILE__ ) . 'options/wpwebapp-security.php' );
require_once( plugin_dir_path( __FILE__ ) . 'options/wpwebapp-user-access.php' );