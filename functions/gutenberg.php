<?php
/**
 * Functions to enhance theme by hooking into WordPress
 *
 * @package Border Beagle
 *
 **/

// Add branded colors to palette/color selectors
function custom_gutenberg_color_palette() {
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Custom Green', 'border-beagle' ),
			'slug'  => 'custom-green',
			'color' => '#00311e',
		),
	) );
}
add_action( 'after_setup_theme', 'custom_gutenberg_color_palette' );

// Disable custom color picker
add_theme_support( 'disable-custom-colors' );

// -- Disable Gradients
add_theme_support( 'disable-custom-gradients' );
add_theme_support('editor-gradient-presets', array(
	array(
		'name' => __('Twilight to dusk', 'border-beagle'),
		'gradient' => 'linear-gradient(65deg, rgb(221, 177, 193) 0%, rgb(246, 213, 214) 100%)',
		'slug' => 'twilight-to-dusk'
	),
));

add_theme_support( 'align-wide' );

// Allowed Gutenberg blocks
function border_beagle_allowed_block_types( $allowed_blocks, $editor_context ) {
	return array(
		'core/image',
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/freeform',
		'core/heading',
		'core/html',
		'core/media-text',
		'core/preformatted',
		'core/pullquote',
		'core/quote',
		'core/table',
		'core/verse',
		'core/columns',
		'core/column',
		'core/group',
		'core/archives',
		'core/audio',
		'core/block',
		'core/button',
		'core/buttons',
		'core/code',
		'core/cover',
		'core/gallery',
		'core/latest-posts',
		'core/list-item',
		'core/missing',
		'core/page-list',
		'core/pattern',
		'core/separator',
		'core/shortcode',
		'core/social-link',
		'core/social-links',
		'core/spacer',
	);
}
// add_filter( 'allowed_block_types_all', 'border_beagle_allowed_block_types', 25, 2 );

// Custom Blocks category
function border_beagle_register_block_categories( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'border-beagle',
				'title' => __( 'Border Beagle', 'border-beagle' ),
			),
		)
	);
}
add_action( 'block_categories_all', 'border_beagle_register_block_categories', 10, 2 );
