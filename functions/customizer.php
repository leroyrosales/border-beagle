<?php

/**
 *
 * Adds Customizer settings
 *
 */

function wpb_customize_register( $wp_customize ) {

  // Site logo
  $wp_customize->add_setting(
    'site_logo',
    array(
      'default' => '',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options'
    )
  );

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_logo', array(
    'label'   => __('Site Logo'),
    'section' => 'title_tagline',
    'settings' => 'site_logo',
    'priority'  => 1
  )));

  // Site footer logo
  $wp_customize->add_setting(
    'site_footer_logo',
    array(
      'default' => '',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options'
    )
  );

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_footer_logo', array(
    'label'   => __('Site Footer Logo'),
    'section' => 'title_tagline',
    'settings' => 'site_footer_logo',
    'priority'  => 1
  )));

  // Brand Options Section
  $wp_customize->add_section('site_brand_colors', array(
    'title'   => __( 'Brand Options' ),
    'description' => sprintf(__( 'Colors and images for site branding' )),
    'priority'    => 60
  ));

  // Header color
  $wp_customize->add_setting('site_brand_colors_header', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
    'type'      => 'theme_mod'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'header_area_color',
    array(
        'label'      => __( 'Header Color' ),
        'section'    => 'site_brand_colors',
        'settings'   => 'site_brand_colors_header',
        'priority'  => 1
    ) ) );

  // Primary Brand color
  $wp_customize->add_setting('site_brand_colors_primary', array(
    'default' => '#00ff00',
    'sanitize_callback' => 'sanitize_hex_color',
    'type'      => 'theme_mod'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'primary_brand_color',
    array(
        'label'      => __( 'Primary brand Color' ),
        'section'    => 'site_brand_colors',
        'settings'   => 'site_brand_colors_primary',
        'priority'  => 2
    ) ) );

  // Secondary Brand color
  $wp_customize->add_setting('site_brand_colors_secondary', array(
    'default' => '#ff00ff',
    'sanitize_callback' => 'sanitize_hex_color',
    'type'      => 'theme_mod'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'secondary_brand_color',
    array(
        'label'      => __( 'Secondary brand Color' ),
        'section'    => 'site_brand_colors',
        'settings'   => 'site_brand_colors_secondary',
        'priority'  => 3
    ) ) );

  // Tertiary Brand color
  $wp_customize->add_setting('site_brand_colors_tertiary', array(
    'default' => '#0000ff',
    'sanitize_callback' => 'sanitize_hex_color',
    'type'      => 'theme_mod'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'tertiary_brand_color',
    array(
        'label'      => __( 'Tertiary brand Color' ),
        'section'    => 'site_brand_colors',
        'settings'   => 'site_brand_colors_tertiary',
        'priority'  => 4
    ) ) );

  // Accent Brand color
  $wp_customize->add_setting('site_brand_colors_accent', array(
    'default' => '#ff0000',
    'sanitize_callback' => 'sanitize_hex_color',
    'type'      => 'theme_mod'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'accent_brand_color',
    array(
        'label'      => __( 'Accent brand Color' ),
        'section'    => 'site_brand_colors',
        'settings'   => 'site_brand_colors_accent',
        'priority'  => 5
    ) ) );

  // Slider timer
  $wp_customize->add_setting(
    'slider_timer_settings',
    array(
      'default' => '5000',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options'
    )
  );

  $wp_customize->add_control( 'slider_timer_settings', array(
    'label'   => __( 'Slider Timer' ),
    'description'     => __( 'Enter time in 1000s for seconds. Ex: for a 7 second timer, use 7000.' ),
    'section' => 'static_front_page',
    'settings' => 'slider_timer_settings',
    'priority'  => 10
  ));


}
add_action( 'customize_register', 'wpb_customize_register' );


/**
 *
 * Adds default customizer settings to Timber Context
 *
 */
function site_defaults_context_filter( $context ) {

  // Logo context
  $site_logo = get_theme_mod( 'site_logo' );

  $context['site_logo'] = $site_logo;

  // Footer logo context
  $site_footer_logo = get_theme_mod( 'site_footer_logo' );

  $context['site_footer_logo'] = $site_footer_logo;

  $site_brand_colors_header = get_theme_mod(
    'site_brand_colors_header',
    '#ffffff'
  );

  $context['site_brand_colors_header'] = $site_brand_colors_header;

  // Primary color context
  $site_brand_colors_primary = get_theme_mod( 'site_brand_colors_primary', '#00ff00' );

  $context['site_brand_colors_primary'] = $site_brand_colors_primary;

  // Secondary color context

  $site_brand_colors_secondary = get_theme_mod( 'site_brand_colors_secondary', '#ff00ff'  );

  $context['site_brand_colors_secondary'] = $site_brand_colors_secondary;

  // Tertiary color context
  $site_brand_colors_tertiary = get_theme_mod( 'site_brand_colors_tertiary', '#0000ff' );

  $context['site_brand_colors_tertiary'] = $site_brand_colors_tertiary;

  // Accent color context
  $site_brand_colors_accent = get_theme_mod( 'site_brand_colors_accent', '#ff0000' );

  $context['site_brand_colors_accent'] = $site_brand_colors_accent;

  return $context;

};
add_filter( 'timber/context', 'site_defaults_context_filter' );

