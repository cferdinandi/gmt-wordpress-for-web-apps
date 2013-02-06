# WordPress for Web Apps
A collection of templates and plugins to help you use WordPress to power web apps.

**Version: 2.3**

## What's Included?
* A front-end login form.
* A front-end registration form.
* A “Request an Invite” form.
* A “Members Only” page template.
* A “Change My Password” form.
* A front-end lost password form.
* A “Delete Account” request form.
* A “Favorite This Post” button and “Favorites” list.
* A plugin to disable the admin bar for all users.
* A plugin to change the default registration email text.
* A plugin to override the default failed login redirect back to frontend.
* A plugin to prevent users from accessing the WordPress admin panel.
* A plugin that replaces the WordPress version of jQuery with the lastest Google-hosted version.
* A list of other third-party plugins I’ve found useful for this kind of thing.

## What's Missing?
Styling. WordPress for Web Apps contains the PHP snippets and basic HTML to get a web app up and running on WordPress.

Tailor the look and feel to fit your design.

## How It Works
There are two types of files included: Template and Plugins.

Templates are PHP files you can include in your theme and assign to specific pages. The forms and buttons are all templates.

Plugins get uploaded to your plugin directory and add additional functionality to WordPress.

### Useful Third Party Plugins

1. [Next Page, Not Post](http://wordpress.org/extend/plugins/next-page-not-next-post/) for navigating between pages in a series.
2. [Simple User Password Generator](http://10up.com/plugins/simple-user-password-generator-wordpress/) creates long, complex passwords for new users in a single click. Great if you're setting up new accounts for private beta testing.
3. [Maintenance Mode.](http://sw-guide.de/wordpress/plugins/maintenance-mode/) If you need to make updates that require downtime, Maintenance Mode will display a splash screen while you do your thing.
4. [WordPress Database Backups](http://austinmatzko.com/wordpress-plugins/wp-db-backup/) will help protect you from data loss (your users will thank you). Download full backups of the database directly, or schedule them to be emailed to you hourly, daily, weekly or more.
5. [Export Users to CSV](http://wordpress.org/extend/plugins/export-users-to-csv/) let's you run reports on your users, including all user meta data. If you use the "Favorite Posts" functionality, you'll need to add that field into the report by modifying the plugin. At the end of the $data_keys array, add 'faveposts'.
6. [Bootstrap](http://getbootstrap.com) isn't a plugin, but it does feature a ton of useful add-ons for building web apps, including alerts, modals, drop-downs and more. Brought you by the fine folks at Twitter.

## Why did you make this?
Last year I started working on a project to create a mobile learning app. I didn't have any experience with backend development, so I decided to see if I could use WordPress to power the app (and save me from having to develop something).

After two weeks of experimenting, I had a simple but working web app.

There wasn’t a one-stop shop for all of the stuff I wanted to build in. I had a lot of help from various websites, most notably Stock Overflow, along the way. I put together this starter kit to help others get their projects off the ground more quickly.

## Changelog
* 01/23/2013
  * Initial GitHub Release (previously self-hosted)

## License
This starter kit, like WordPress, is licensed under the [GNU General Public License](http://www.gnu.org/copyleft/gpl.html) as published by the Free Software Foundation.
