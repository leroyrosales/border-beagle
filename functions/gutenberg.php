<?php
/**
 * Functions to enhance theme by hooking into WordPress
 *
 * @package Insight Gloabl Evergreen
 *
 **/

// Add branded colors to palette/color selectors
function ig_evergreen_editor_color_palette() {
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Deep Green', 'ig-evergreen' ),
			'slug'  => 'deep-green',
			'color' => '#00311e',
		),
		array(
			'name'  => __( 'Bright Pine', 'ig-evergreen' ),
			'slug'  => 'bright-pine',
			'color' => '#56e13b',
		),
		array(
			'name'  => __( 'Soft Yellow', 'ig-evergreen' ),
			'slug'  => 'soft-yellow',
			'color' => '#fffae1',
		),
		array(
			'name'  => __( 'Dusk', 'ig-evergreen' ),
			'slug'  => 'dusk',
			'color' => '#fdc6c2',
		),
		array(
			'name'  => __( 'Twilight', 'ig-evergreen' ),
			'slug'  => 'twilight',
			'color'	=> '#4527a0',
		),
		array(
			'name'  => __( 'Sky', 'ig-evergreen' ),
			'slug'  => 'sky',
			'color' => '#bff5fc',
		),
		array(
			'name'  => __( 'Sap', 'ig-evergreen' ),
			'slug'  => 'sap',
			'color' => '#ffd700',
		),
		array(
			'name'  => __( 'Pure White', 'ig-evergreen' ),
			'slug'  => 'pure-white',
			'color' => '#ffffff',
		),
		array(
			'name'  => __( 'Moonshadow', 'ig-evergreen' ),
			'slug'  => 'moonshadow',
			'color' => '#000000',
		),
	) );
}
add_action( 'after_setup_theme', 'ig_evergreen_editor_color_palette' );

// Disable custom color picker
add_theme_support( 'disable-custom-colors' );

// -- Disable Gradients
add_theme_support( 'disable-custom-gradients' );
add_theme_support('editor-gradient-presets', array(
	array(
		'name' => __('Twilight to dusk', 'ig-evergreen'),
		'gradient' => 'linear-gradient(65deg, rgb(221, 177, 193) 0%, rgb(246, 213, 214) 100%)',
		'slug' => 'twilight-to-dusk'
	),
	array(
		'name' => __('Dusk to off-white', 'ig-evergreen'),
		'gradient' => 'linear-gradient(to right, #CAA5BA 0%, 36%, #F5DFDD 72%, 86%, #F1D6D5 100%)',
		'slug' => 'dusk-to-off-white'
	),
));

add_theme_support( 'align-wide' );

// Allowed Gutenberg blocks
function ig_evergreen_allowed_block_types( $allowed_blocks, $editor_context ) {
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
		// Evergreen components
		'acf/video',
		'acf/button',
		'acf/card',
		'acf/title',
		'acf/hubspot',
		'acf/services-carousel',
		'acf/superscript-card',
	);
}
add_filter( 'allowed_block_types_all', 'ig_evergreen_allowed_block_types', 25, 2 );

// Custom Blocks category
function ig_evergreen_register_block_categories( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'evergreen',
				'title' => __( 'Evergreen', 'evergreen' ),
			),
		)
	);
}
add_action( 'block_categories_all', 'ig_evergreen_register_block_categories', 10, 2 );
