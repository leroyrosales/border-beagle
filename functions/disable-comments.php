<?php

/**
 *  
 * Disable Comments
 *
 */

// Remove comments links from admin bar
add_action( 'init', function() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
} );

// Remove comments page in menu
add_action( 'admin_menu', function() {
	remove_menu_page('edit-comments.php');
} );

// Close comments on the front-end
add_filter( 'comments_open', function() {
	return false;
} );

add_filter( 'pings_open', function() {
	return false;
} );

// Hide existing comments
add_filter( 'comments_array', function($comments) {
	$comments = array();
	return $comments;
} );

add_action( 'wp_before_admin_bar_render', 'remove_comments_toolbar_node', 999 );

// Adds numerous functions to disable trackbacks, metaboxes, and adds redirects
add_action( 'admin_init', 'disable_site_comments_admin' );

function disable_site_comments_admin() {
	disable_site_comments_post_types_support();
	disable_site_comments_admin_menu_redirect();
	disable_site_comments_dashboard();
}

// Disable support for comments and trackbacks in post types
function disable_site_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ( $post_types as $post_type ) {
		if( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}

// Redirect any user trying to access comments page
function disable_site_comments_admin_menu_redirect() {
	global $pagenow;
	if ( $pagenow === 'edit-comments.php' ) {
		wp_redirect( admin_url() ); 
		exit;
	}
}

// Remove comments metabox from dashboard
function disable_site_comments_dashboard() {
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
}

function remove_comments_toolbar_node( $wp_admin_bar ) {
	
	global $wp_admin_bar;
	
	$wp_admin_bar->remove_menu('comments');
	
}
