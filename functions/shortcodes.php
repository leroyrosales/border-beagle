<?php

/**
 *
 * Shortcodes
 *
 */

// Row shortcode
add_shortcode( 'row', function( $atts, $content = null ) {
	//remove wrong nested <p>
	//$content = remove_invalid_tags( $content, array('p') );
	extract(shortcode_atts(array(
		'class'  => ''
	), $atts));
	// add divs to the content
	$return = '<div class="row ' . $class . '">';
	$return .= do_shortcode( $content );
	$return .= '</div>';
	return $return;
});

// Columns
add_shortcode( 'col', function( $atts, $content = null ) {
	//remove wrong nested <p>
	//$content = remove_invalid_tags( $content, array('p') );
	extract(shortcode_atts(array(
		'class'  => ''
	), $atts));
	// add divs to the content
	$return = '<div class="' . $class . '">';
	$return .= do_shortcode( $content );
	$return .= '</div>';
	return $return;
});
