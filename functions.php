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

    wp_enqueue_style('tecnibo-slick-css', get_stylesheet_directory_uri() . '/assets/slick/slick.css');
    wp_enqueue_style('tecnibo-slick-theme-css', get_stylesheet_directory_uri() . '/assets/slick/slick-theme.css');
    wp_enqueue_style('tecnibo-slick-lightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css');

    wp_enqueue_script('tecnibo-slick-js', get_stylesheet_directory_uri() . '/assets/slick/slick.js', array('jquery',), '', true);
    wp_enqueue_script('tecnibo-slick-lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js', array('jquery',), '', true);

    wp_enqueue_script('vg-isotope-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js', array('jquery',), '', true);
    wp_enqueue_script('tecnibo-team-js', get_stylesheet_directory_uri() . '/assets/js/vg.js', array('jquery', 'vg-isotope-js'), '', true);
}

require 'inc/template-functions.php';
