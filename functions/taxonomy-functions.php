<?php

/*
 *
 * Taxonomy Custom Functions
 *
 */

//Custom taxonomy
function border_beagle_custom_taxonomy() {

	$labels = array(
		'name' => _x( 'Categories', 'categories' ),
		'singular_name' => _x( 'Category', 'category' ),
		'search_items' =>  __( 'Search Categories' ),
		'all_items' => __( 'All Categories' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Edit Category' ),
		'update_item' => __( 'Update Category' ),
		'add_new_item' => __( 'Add New Category' ),
		'new_item_name' => __( 'New Category Name' ),
		'menu_name' => __( 'Categories' ),
	);

// Now register the taxonomy
	register_taxonomy('categories', array('videos'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'category' ),
	));

}

add_action( 'init', 'border_beagle_custom_taxonomy', 0 );

if ( !current_user_can( 'administrator' ) )  {
	add_action( 'create_term', 'undo_create_tag_term', 10, 3);
	add_action( 'admin_menu', 'rudr_post_tags_meta_box_remove');
	add_action( 'admin_menu', 'rudr_add_new_tags_metabox');
}

// If user somehow makes a new tag then remove it
function undo_create_tag_term( $term_id, $tt_id, $taxonomy ) {
	if( $taxonomy == 'post_tag' ) {
		wp_delete_term( $term_id,$taxonomy );
	}
}

/*
* Meta Box Removal
* Solution modified from: Misha Rudrastyh
* https://rudrastyh.com/wordpress/tag-metabox-like-categories.html
*/
function rudr_post_tags_meta_box_remove() {
	$id = 'tagsdiv-post_tag';
	$post_type = 'faq'; // remove only from faq edit screen
	$position = 'side';
	remove_meta_box( $id, $post_type, $position );
}


/*
 * Add new metabox
 */
function rudr_add_new_tags_metabox(){
	$id = 'rudrtagsdiv-post_tag'; // it should be unique
	$heading = 'Tags'; // meta box heading
	$callback = 'rudr_metabox_content'; // the name of the callback function
	$post_type = 'faq';
	$position = 'side';
	$pri = 'default'; // priority, 'default' is good for us
	add_meta_box( $id, $heading, $callback, $post_type, $position, $pri );
}

/*
 * Fill metabox with FAQ tags
 */
function rudr_metabox_content($post) {

	// get all blog post tags as an array of objects
	$all_tags = get_terms( array('taxonomy' => 'post_tag', 'hide_empty' => 0) );

	// get all tags assigned to a post
	$all_tags_of_post = get_the_terms( $post->ID, 'post_tag' );

	// create an array of post tags ids
	$ids = array();
	if ( $all_tags_of_post ) {
		foreach ($all_tags_of_post as $tag ) {
			$ids[] = $tag->term_id;
		}
	}

	// HTML
	echo '<div id="taxonomy-post_tag" class="categorydiv">';
	echo '<input type="hidden" name="tax_input[post_tag][]" value="0" />';
	echo '<ul>';
	foreach( $all_tags as $tag ){
		// unchecked by default
		$checked = "";
		// if an ID of a tag in the loop is in the array of assigned post tags - then check the checkbox
		if ( in_array( $tag->term_id, $ids ) ) {
			$checked = " checked='checked'";
		}
		$id = 'post_tag-' . $tag->term_id;
		echo "<li id='{$id}'>";
		echo "<label><input type='checkbox' name='tax_input[post_tag][]' id='in-$id'". $checked ." value='$tag->slug' /> $tag->name</label><br />";
		echo "</li>";
	}
	echo '</ul></div>'; // end HTML
}
