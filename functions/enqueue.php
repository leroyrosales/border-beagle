<?php

// Theme enqueues and dequeues

// Dequeue core jquery
add_action( 'wp_enqueue_scripts', function(){
	if ( is_admin() ) return; // don't dequeue on the backend
	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );
});

// Swiper Enqueues
function ig_evergreen_enqueues() {

	wp_enqueue_style( 'ig-evergreen-styles', get_template_directory_uri() . '/assets/dist/main.css', array(), null, 'all' );
	wp_enqueue_script( 'ig-evergreen-scripts', get_template_directory_uri() . '/assets/dist/main.bundle.js', array(), false, true );

}
add_action( 'wp_enqueue_scripts', 'ig_evergreen_enqueues' );
