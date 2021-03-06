<?php
/**
 * wp386 Theme Customizer
 *
 * @package wp386
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp386_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

  $options = wp386_blog_options();

  $wp_customize->add_setting( 'wp386_options[color_combination]',
    array(
      'default' => $options['color_combination'],
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control( 'theme_color_combinations', array(
    'label'      => __('Color Combinations', 'wp386'),
    'section'    => 'colors',
    'settings'   => 'wp386_options[color_combination]',
    'priority'   => 10,
    'type'       => 'radio',
    'choices'    => array(
      'default' => 'Default Color Scheme',
      'blackonwhite' => 'Dark Text / Light Background'
    ),
  ) );
}
add_action( 'customize_register', 'wp386_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp386_customize_preview_js() {
	wp_enqueue_script( 'wp386_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'wp386_customize_preview_js' );
