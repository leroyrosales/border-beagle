<?php

/**
 *
 * Adds new dropdown for Projects post type to options area
 *
 */

/**
 * Register and define the settings
 */
add_action('admin_init', 'ig_evergreen_admin_init');
function ig_evergreen_admin_init(){

    // register our setting
    $args = array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => NULL,
    );
    register_setting(
        'reading', // option group "reading", default WP group
        'projects_post_page', // option name
        $args
    );

    // add our new setting
    add_settings_field(
        'projects_post_page', // ID
        __('Project Page', 'ig-evergreen'), // Title
        'ig_evergreen_setting_callback_function', // Callback
        'reading', // page
        'default', // section
        array( 'label_for' => 'projects_post_page' )
    );
}

/**
 * Custom field callback
 */
function ig_evergreen_setting_callback_function($args){
  // get saved project page ID
  $project_page_id = get_option('projects_post_page');

  // get all pages
  $args = array(
      'posts_per_page'   => -1,
      'orderby'          => 'name',
      'order'            => 'ASC',
      'post_type'        => 'page',
  );
  $items = get_posts( $args );

  echo '<select id="projects_post_page" name="projects_post_page">';
  // empty option as default
  echo '<option value="0">'.__('— Select —', 'wordpress').'</option>';

  // foreach page we create an option element, with the post-ID as value
  foreach($items as $item) {

      // add selected to the option if value is the same as $project_page_id
      $selected = ($project_page_id == $item->ID) ? 'selected="selected"' : '';

      echo '<option value="'.$item->ID.'" '.$selected.'>'.$item->post_title.'</option>';
  }

  echo '</select>';
}

/**
 * Add custom state to post/page list
 */
add_filter('display_post_states', 'ig_evergreen_add_custom_post_states');

function ig_evergreen_add_custom_post_states($states) {
    global $post;

    // get saved project page ID
    $project_page_id = get_option('projects_post_page');

    // add our custom state after the post title only,
    // if post-type is "page",
    // "$post->ID" matches the "$project_page_id",
    // and "$project_page_id" is not "0"
    if( 'page' == get_post_type($post->ID) && $post->ID == $project_page_id && $project_page_id != '0') {
        $states[] = __('AW Projects', 'ig-evergreen');
    }

    return $states;
}
