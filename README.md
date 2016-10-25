# WordPress for Web Apps

A plugin that provides the essential components you need to power your web app with WordPress.

- Front-end forms:
	- Login
	- Sign-up
	- Password reset
	- Email change
	- Password change
	- Delete account
- User access settings, so you can selectively hide content from logged-out or logged-in users.
- Security settings let you set password requirements, hide the admin bar, and force password resets.
- The web app settings panel lets you easily configure error messages, button text, and more.

[Download WordPress for Web Apps](https://github.com/cferdinandi/wordpress-for-web-apps/archive/master.zip)



## Getting Started

Getting started with WordPress for Web Apps is as simple as installing a plugin:

1. Upload the `wordpress-for-web-apps` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the Plugins menu in WordPress.

To make sure you always get the latest updates, it’s recommended that you also install the [GitHub Updater plugin](https://github.com/afragen/github-updater).



## Using WordPress for Web Apps

Configure all of your settings under `Settings` > `Web Apps` in the WordPress Dashboard.

### Shortcodes

- `[wpwa_login]` - Login form
- `[wpwa_signup]` - Sign up form
- `[wpwa_change_email]` - Change email form
- `[wpwa_change_password]` - Change password form
- `[wpwa_forgot_password]` - Forgot password/password reset form
- `[wpwa_delete_account]` - Delete account form
- `[wpwa_logout]` - Logout URL (can be included as a `wp_nav_menu()` URL)
- `[wpwa_username]` - The current user's username (can be included as the text in a `wp_nav_menu()` link)
- `[wpwa_referrer]` - Adds `referrer={{current page URL}}`, handy for login/signup redirects (can be included in a `wp_nav_menu()` URL)

### User Access

All pages will now include a metabox labeled *User Access*. Select `Everyone`, `Only Logged In Users`, or `Only Logged Out Users` as desired and publish or update your page.

### Action Hooks

#### wpwebapp_after_login

Runs after a user has logged in. Passes in the user's `$username` as an argument.

```php
do_action( 'wpwebapp_after_login', $username );
```

#### wpwebapp_after_signup

Runs after a user has signed up. Passes in the new user's `$username` and `$email` as arguments.

```php
do_action( 'wpwebapp_after_signup', $username, $email );
```

#### wpwebapp_after_email_change

Runs after a user has changed their email address. Passes in the user's `$user_id` and `$old_email` as arguments.

```php
do_action( 'wpwebapp_after_email_change', $user_id, $old_email );
```

#### wpwebapp_after_password_change

Runs after a user's password has been changed. Passes in the user's `$user_id` as an argument.

```php
do_action( 'wpwebapp_after_password_change', $user_id );
```

#### wpwebapp_after_password_forgot_email_sent

Runs after a password reset email is sent to a user. Passes in the user's `$user_id` as an argument.

```php
do_action( 'wpwebapp_after_password_forgot_email_sent', $user_id );
```

#### wpwebapp_after_password_reset

Runs after a user's password has been reset. Passes in the user's `$user_id` as an argument.

```php
do_action( 'wpwebapp_after_password_reset', $user_id );
```

#### wpwebapp_after_delete_user

Runs after a user deletes their account. Passes in the former user's `$username` and `$email` as arguments.

```php
do_action( 'wpwebapp_after_delete_user',  $username, $email );
```

### Redirecting after login or signup

To redirect a user back to their current page after login or sign up, add the `referrer={{current URL}}` query string to the login or sign up page URL, where `{{current URL}}` is the URL of the page the user is currently on. You can also use the `[wpwa_referrer]` shortcode to handle this dynamically.



## CSS Hooks

Every form and input includes a unique `id` you can hook into for styling. Additionally, form element categories also include shared classes you can use to easily style like elements in a consistent way.

- `.wpwebapp-form-label` - Form labels
- `.wpwebapp-form-input` - Text inputs
- `.wpwebaspp-form-password` - Password inputs
- `.wpwebapp-form-button` - Form buttons and input[type="submit"]
- `.wpwebapp-form-label-checkbox` - Labels for checkboxes
- `.wpwebapp-form-checkbox` - Checkboxes



## What's new in version 5?

Version 5 has been rewritten from the ground up to provide a more lightweight, performant, customizable code base.

**Removed:**

These items should now be handled at the theme level rather than through this plugin.

- User Profile Form
- Built-In logged-out/logged-in navigation

**Added:**

- `?referrer` query string lets you redirect users dynamically after login or sign up.
- Custom action hooks to let you extend the plugin without touching the core.



## How to Contribute

To contribute to this project, please consult the [Contribution Guidelines](CONTRIBUTING.md).



## License

The code is available under the [MIT License](LICENSE.md).