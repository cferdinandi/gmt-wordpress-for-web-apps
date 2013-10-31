# WordPress for Web Apps
WordPress for Web Apps provides the essential components you need to power your web app with WordPress:

* Front-end login, sign-up, password reset, and password change forms.
* Separate navigation menus for logged-in and logged-out users.
* User access settings, so you can selectively hide content from logged-out (or logged-in) users.
* Security settings let you set password requirements, hide the admin bar, and block backend access.
* The web app settings panel lets you easily configure error messages, button text, and more.


## How It Works
To get started with WordPress for Web Apps, [view the online tutorial](http://cferdinandi.github.com/web-app-starter-kit/).


## Changelog
* v3.3 (October 31, 2013)
  * [Added a link to settings from plugin menu](https://github.com/cferdinandi/web-app-starter-kit/issues/13)
* v3.2 (October 18, 2013)
  * Fixed [incorrect i18n](https://github.com/cferdinandi/web-app-starter-kit/issues/12).
  * Change `home_url()` to `site_url()`. [Fixed issue 5](https://github.com/cferdinandi/web-app-starter-kit/issues/5)
* v3.1 (October 4, 2013)
  * Updated `wpwebapp_disable_admin_bar()` to allow user preferences for users who have access.
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