<?php

/**
 * Vg Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vg
 */
add_action('wp_enqueue_scripts', 'dro_caterer_parent_theme_enqueue_styles');

/**
 * Enqueue scripts and styles.
 */
function dro_caterer_parent_theme_enqueue_styles() {
    wp_enqueue_style('vg-style', get_stylesheet_directory_uri() . '/style.css'
    );
    wp_enqueue_style('dro-caterer-style', get_template_directory_uri() . '/style.css');

    wp_enqueue_script('vg-isotope-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js', array('jquery',), '', true);
    wp_enqueue_script('vg-js', get_stylesheet_directory_uri() . '/assets/js/vg.js', array('jquery', 'vg-isotope-js'), '', true);
    
    wp_enqueue_script('vg-tether', 'https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js', array(),  '', false);
}

require 'inc/template-functions.php';
