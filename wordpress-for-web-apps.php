<?php

/**
 * Plugin Name: GMT WordPress for Web Apps
 * Plugin URI: https://github.com/cferdinandi/gmt-wordpress-for-web-apps/
 * GitHub Plugin URI: https://github.com/cferdinandi/gmt-wordpress-for-web-apps/
 * Description: Transform WordPress into a web app engine. Adjust your settings under <a href="options-general.php?page=wpwebapp_plugin_options">Web App Options</a>.
 * Version: 8.0.7
 * Author: Chris Ferdinandi
 * Author URI: http://gomakethings.com
 * License: MIT
 */

// Includes
require_once( plugin_dir_path( __FILE__ ) . 'includes/wp-session-manager/wp-session-manager.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/helpers.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/migrate-options.php' );

// Options
require_once( plugin_dir_path( __FILE__ ) . 'options/options.php' );

// Shortcodes
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/signup.php' ); // Sign up for an account
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/login.php' ); // Login
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/password-reset.php' ); // Reset Password
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/password-change.php' ); // Change Password
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/email-change.php' ); // Change Email
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/delete-account.php' ); // Delete Account
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/navigation.php' ); // Nav menu shortcodes

// Security and Access
require_once( plugin_dir_path( __FILE__ ) . 'options/security.php' );
require_once( plugin_dir_path( __FILE__ ) . 'options/user-access.php' );