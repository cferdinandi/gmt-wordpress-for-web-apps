<?php

/**
 * Control user access
 */


	/**
	 * Create a metabox
	 */
	function wpwebapp_user_access_metabox() {
		add_meta_box( 'wpwebapp_user_access_metabox_content', __( 'User Access', 'wpwebapp' ), 'wpwebapp_user_access_metabox_content', 'page', 'side', 'default');
	}
	add_action('add_meta_boxes', 'wpwebapp_user_access_metabox');


	/**
	 * Add content to the metabox
	 */
	function wpwebapp_user_access_metabox_content() {

		global $post;

		// Get checkedbox value
		$user_access = get_post_meta( $post->ID, 'wpwebapp_user_access', true );

		?>

			<fieldset id="wpwebapp_user_access_metabox">
				<div>
					<label>
						<input type="radio" name="wpwebapp_user_access" value="everyone" <?php checked( $user_access, '' ); checked( $user_access, 'everyone' ); ?>>
						Everyone
					</label>
					<br>
					<label>
						<input type="radio" name="wpwebapp_user_access" value="loggedin" <?php checked( $user_access, 'loggedin' ); ?>>
						Only Logged In Users
					</label>
					<br>
					<label>
						<input type="radio" name="wpwebapp_user_access" value="loggedout" <?php checked( $user_access, 'loggedout' ); ?>>
						Only Logged Out Users
					</label>
				</div>
			</fieldset>

		<?php

		// Security field
		wp_nonce_field( 'wpwebapp_user_access_nonce', 'wpwebapp_user_access_process' );

	}


	/**
	 * Save checkbox data
	 * @param  number $post_id The Post ID
	 * @param  array  $post    Post data
	 */
	function wpwebapp_user_access_metabox_process( $post_id, $post ) {

		// Verify data came from edit screen
		if ( !isset( $_POST['wpwebapp_user_access_process'] ) || !wp_verify_nonce( $_POST['wpwebapp_user_access_process'], 'wpwebapp_user_access_nonce' ) ) {
			return $post->ID;
		}

		// Verify user has permission to edit post
		if ( !current_user_can( 'edit_post', $post->ID )) {
			return $post->ID;
		}

		// Verify field exists
		if ( empty( $_POST['wpwebapp_user_access'] ) ) return;

		// Update metadata
		update_post_meta( $post->ID, 'wpwebapp_user_access', $_POST['wpwebapp_user_access'] );

	}
	add_action('save_post', 'wpwebapp_user_access_metabox_process', 1, 2);


	/**
	 * Save the data with revisions
	 * @param  number $post_id The post ID
	 */
	function wpwebapp_user_access_metabox_save_revisions( $post_id ) {

		// Check if it's a revision
		$parent_id = wp_is_post_revision( $post_id );

		// If not a revision, bail
		if ( !$parent_id ) return;

		// Get the data
		$parent = get_post( $parent_id );
		$user_access = get_post_meta( $parent->ID, 'wpwebapp_user_access', true );

		// If data exists, add to revision
		if ( empty( $user_access ) ) return;
		add_metadata( 'post', $post_id, 'wpwebapp_user_access', $user_access );

	}
	add_action( 'save_post', 'wpwebapp_user_access_metabox_save_revisions' );


	/**
	 * Restore the data with revisions
	 * @param  number $post_id     The post ID
	 * @param  number $revision_id The revision ID
	 */
	function wpwebapp_user_access_metabox_restore_revisions( $post_id, $revision_id ) {

		// Variables
		$post = get_post( $post_id );
		$revision = get_post( $revision_id );
		$user_access = get_metadata( 'post', $revision->ID, 'wpwebapp_user_access', true );

		if ( !empty( $width ) ) {
			update_post_meta( $post_id, 'wpwebapp_user_access', $user_access );
		} else {
			delete_post_meta( $post_id, 'wpwebapp_user_access' );
		}

	}
	add_action( 'wp_restore_post_revision', 'wpwebapp_user_access_metabox_restore_revisions', 10, 2 );


	/**
	 * Get the data to display the revisions page
	 * @param  array $fields The revision fields
	 */
	function wpwebapp_user_access_metabox_get_revisions_field( $fields ) {
		$fields['wpwebapp_user_access'] = 'User Access';
		return $fields;
	}
	add_filter( '_wp_post_revision_fields', 'wpwebapp_user_access_metabox_get_revisions_field' );


	/**
	 * Display the data on the revisions page
	 */
	function wpwebapp_user_access_metabox_set_revisions_field( $value, $field ) {
		global $revision;
		return get_metadata( 'post', $revision->ID, $field, true );
	}
	add_filter( '_wp_post_revision_field_my_meta', 'wpwebapp_user_access_metabox_set_revisions_field', 10, 2 );


	/**
	 * Redirect users that don't have access to the page
	 */
	function wpwebapp_control_access() {

		// Don't run on admin page
		if ( is_admin() ) return;

		// Variables
		global $post;
		if ( empty( $post ) ) return;
		$options = wpwebapp_get_theme_options_redirects();
		$user_access = get_post_meta( $post->ID, 'wpwebapp_user_access', true );

		// Bail if no access restrictions
		if ( empty( $user_access ) || $user_access === 'everyone' ) return;

		// If user is logged out and page is for logged in users only
		if ( $user_access === 'loggedin' && !is_user_logged_in() ) {
			wp_safe_redirect( wpwebapp_get_redirect_url( $options['logout_redirect'], $options['add_redirect_referrer'] ), 302 );
			exit;
		}

		// If user is logged in and page is for logged out users only
		if ( $user_access === 'loggedout' && is_user_logged_in() ) {
			wp_safe_redirect( wpwebapp_get_redirect_url( $options['login_redirect'] ), 302 );
			exit;
		}

	}
	add_action( 'wp', 'wpwebapp_control_access' );


	/**
	 * Redirect users away from wp-login.php after logout
	 */
	function wpwebapp_logout_redirect() {
		$options = wpwebapp_get_theme_options_redirects();
		wp_redirect( wpwebapp_get_redirect_url( $options['logout_redirect'] ) );
		exit();
	}
	add_action( 'wp_logout', 'wpwebapp_logout_redirect' );


	/**
	 * Disable the admin bar for all users
	 */
	function wpwebapp_disable_admin_bar() {
		if ( current_user_can( 'edit_themes' ) ) return;
		$options = wpwebapp_get_theme_options_security();
		if ( $options['show_admin_bar'] === 'on' ) return;
		show_admin_bar( false );
	}
	add_filter( 'init' , 'wpwebapp_disable_admin_bar');