# WordPress for Web Apps
WordPress for Web Apps provides the essential components you need to power your web app with WordPress:

* Front-end login, sign-up, password reset, and password change forms.
* Separate navigation menus for logged-in and logged-out users.
* User access settings, so you can selectively hide content from logged-out (or logged-in) users.
* Security settings let you set password requirements, hide the admin bar, and block backend access.
* The web app settings panel lets you easily configure error messages, button text, and more.


## How It Works
To get started with WordPress for Web Apps, [view the online tutorial](http://cferdinandi.github.com/web-app-starter-kit/).


## Roadmap
* v3.x
  * Custom "password reset" and "welcome message" email settings.
  * Add "Delete Account" option to the front-end for users.
  * Add "Update Profile" options to the front-end for users.
  * Add a "restrict to these users" by email option (Beta testers, for example).
  * Add Gravatar shortcode (with size argument).
  * Add option to set default user access permission.


## Changelog
* v3.0 (September 28, 2013)
  * Converted from a collection of theme functions to a plugin.
  * Completely rebuilt forms for better consistency, security, and UX.
  * Changed signup process: user creates their own password and can login immediately.
  * Changed password reset process: user selects their new password (not WordPress).
  * Added password requirement check to signup and password change and reset processes.
  * Integration with `wp_nav_menu()` for separate logged-in and logged-out navigation with any theme.
  * Added Web App Settings page for easier adjustment of alerts, security settings, form styling, and more.
* v2.1 (June 7, 2013)
  * Switched to MIT license.
* v2.1 (June 6, 2013)
  * Split functions into individual files for easier inclusion and exclusion.
* v2.0 (May 17, 2013)
  * Completely rebuilt.
* v1.0 (January 23, 2013)
  * Initial GitHub Release (previously self-hosted).


## License
WordPress for Web Apps is free to use under the [MIT License](http://gomakethings.com/mit/).