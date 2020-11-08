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
    
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.css');
    
    wp_enqueue_script('vg-imageloaded-js', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array('jquery',), '', true);
    wp_enqueue_script('vg-isotope-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js', array('jquery',), '', true);
    wp_enqueue_script('vg-js', get_stylesheet_directory_uri() . '/assets/js/vg.js', array('jquery', 'vg-isotope-js'), '', true);
    
    wp_enqueue_script('vg-tether', 'https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js', array(),  '', false);
}

/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'aliment'; // change to your post type
	$taxonomy  = 'category_aliment'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => sprintf( __( 'Show all %s', 'textdomain' ), $info_taxonomy->label ),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'aliment'; // change to your post type
	$taxonomy  = 'category_aliment'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}

require 'inc/template-functions.php';
