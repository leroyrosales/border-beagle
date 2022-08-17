<?php

// Prevent frontend errors if ACF inactive
if ( ! is_admin() && ! function_exists( 'get_field' ) ) {

	function get_field( $key ) {
			return get_post_meta( get_the_ID(), $key, true );
	}

}

if ( current_user_can( 'activate_plugins' ) ) {

	// Adds Site Configuration options menu
	if ( function_exists( 'acf_set_options_page_menu' ) ) {
		acf_add_options_page(
			array(
				'page_title' =>  get_bloginfo( 'name' ) . __( ' Configuration' ),
				'menu_title' => __( 'Configuration' ),
				'menu_slug' => 'configuration',
				'capability' => 'edit_others_posts',
				'redirect' => false
			)
		);
	}

}

// if ( function_exists( 'acf_add_options_sub_page' ) ) {

// 	acf_add_options_sub_page(
// 		array(
// 			'page_title'      => __( 'Social Accounts' ),
// 			'menu_title'      => __( 'Social' ),
// 			'menu_slug'       => 'social-settings',
// 			'parent_slug'     => 'options-general.php',
// 			'updated_message' => __('Social Accounts updated', 'border-beagle'),
// 		)
// 	);

// }


