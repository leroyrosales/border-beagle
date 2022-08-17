<?php

/**
 * Register Custom Roles
 * - CUSTOM ROLE
 * WordPress documentation: https://wordpress.org/support/article/roles-and-capabilities/
 */



//  // Create CUSTOM ROLE role
//  add_action( 'init', function () {

// 	add_role(
// 		'custom_role',
// 		__( 'CUSTOM ROLE' ),
//     array(
// 			'read'  => true,
// 		)
// 	);

// 	$roles = array( 'custom_role', 'editor', 'administrator' );

// 	// Loop through each role and assign capabilities
// 	foreach($roles as $the_role) {

// 			$role = get_role($the_role);

// 			$role->add_cap( 'read_private_faqs' );
// 			$role->add_cap( 'edit_faq' );
// 			$role->add_cap( 'edit_faqs' );
// 			$role->add_cap( 'edit_others_faqs' );
// 			$role->add_cap( 'edit_published_faqs' );
// 			$role->add_cap( 'publish_faqs' );
// 			$role->add_cap( 'delete_others_faqs' );
// 			$role->add_cap( 'delete_private_faqs' );
// 			$role->add_cap( 'delete_published_faqs' );

// 	}

// });
