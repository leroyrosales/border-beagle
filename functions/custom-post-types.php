<?php

/**
 * Register Post Types
 * - Projects
 * - Videos
 * WordPress documentation: https://developer.wordpress.org/plugins/post-types/
 */

// if ( ! function_exists( 'fix_no_editor_on_posts_page' ) ) {
// 	/**
// 	 * Add the wp-editor back into WordPress after it was removed in 4.2.2.
// 	 *
// 	 * @param $post
// 	 * @return void
// 	 */
// 	function fix_no_editor_on_posts_page( $post ) {
// 		if ( get_option( 'page_for_posts' ) !== $post->ID )
// 			return;

// 		remove_action( 'edit_form_after_title', '_wp_posts_page_notice' );
// 		add_post_type_support( 'page', 'editor' );
// 	}
// 	add_action( 'edit_form_after_title', 'fix_no_editor_on_posts_page', 0 );
// }

// add_action( 'init', function () {

// 	// CUSTOM POST TYPE
// 	register_post_type( 'custom-post-type',
// 		array(
// 			'labels' => array(
// 				'name' => 'CUSTOM POST TYPE',
// 				'singular_name' => 'CUSTOM POST TYPE',
// 				'add_new_item' => 'Add New CUSTOM POST TYPE',
// 				'all_items' => 'All CUSTOM POST TYPE',
// 				'edit_item' => 'Edit CUSTOM POST TYPE',
// 				'new_item' => 'New CUSTOM POST TYPE',
// 				'view_item' => 'View CUSTOM POST TYPE',
// 				'search_items' => 'Search CUSTOM POST TYPE',
// 				'not_found' => 'No CUSTOM POST TYPE found',
// 				'not_found_in_trash' => 'No CUSTOM POST TYPE found in Trash',
// 			),
// 			'rewrite' => false,
// 			'hierarchical' => false,
// 			'public' => false,
// 			'publicly_queryable' => true,
// 			'show_ui' => true,
// 			'menu_position' => 5,
// 			'menu_icon' => 'dashicons-format-chat',  // https://developer.wordpress.org/resource/dashicons
// 			'capability_type' => 'custom-post-type',
// 			'taxonomies' => ['post_tag'],
// 			'show_in_nav_menus' => false,
// 			'supports' => array(
// 				'title',
// 				'editor'
// 			)
// 		)
// 	);

// } );

