<?php
/**
	*
	* Scripts and actions to optimize WordPress
	*
	*/

// Remove block editor
//add_filter( 'use_block_editor_for_post', '__return_false' );

// Remove Unnecessary Code from wp_head
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link' );
remove_action( 'wp_head', 'feed_links', 2 );

//Remove JQuery migrate
add_action('wp_default_scripts', function($scripts) {
	if (!is_admin() && isset($scripts->registered['jquery'])) {
		$script = $scripts->registered['jquery'];

		if ( $script->deps ) { // Check whether the script has any dependencies
						$script->deps = array_diff($script->deps, array(
										'jquery-migrate'
						));
		}
	}
});

// Remove oEmbed
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

// Disable Trackbacks and Pings
add_action( 'pre_ping', 'c45_internal_pingbacks' );
add_filter( 'wp_headers', 'c45_x_pingback');
add_filter( 'bloginfo_url', 'c45_pingback_url') ;
add_filter( 'bloginfo', 'c45_pingback_url') ;
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'xmlrpc_methods', 'c45_xmlrpc_methods' );

// Disable internal pingbacks
function c45_internal_pingbacks( &$links ) {
	foreach ( $links as $l => $link ) {
		if ( 0 === strpos( $link, get_option( 'home' ) ) ) {
						unset( $links[$l] );
		}
	}
}

// Disable x-pingback
function c45_x_pingback( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
}

// Remove pingback URLs
function c45_pingback_url( $output, $show='') {
	if ( $show == 'pingback_url' ) $output = '';
	return $output;
}

// Disable XML-RPC methods
function c45_xmlrpc_methods( $methods ) {
	unset( $methods['pingback.ping'] );
	return $methods;
}

// Disable the emoji's
add_action( 'init', function() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
});

// Filter function used to remove the tinymce emoji plugin.
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// Remove emoji CDN hostname from DNS prefetching hints.
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

// Clean up output of stylesheet <link> tags
function clean_style_tag($input) {
	preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
	if (empty($matches[2])) {
					return $input;
	}
	// Only display media if it is meaningful
	$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}
add_filter( 'style_loader_tag', 'clean_style_tag' );
