<?php

function get_parent_categories() {

    return get_terms(
            array(
                'taxonomy' => 'category_aliment',
                'parent' => 0,
                'orderby' => 'slug',
                'order' => 'ASC'));
}

function get_child_categories($parent) {

    return get_terms(
            array(
                'taxonomy' => 'category_aliment',
                'parent' => $parent,
                'orderby' => 'slug',
                'order' => 'ASC'));
}

function get_aliments($term_id) {

    $args = array(
        'post_type' => 'aliment',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'category_aliment',
                'field' => 'term_id',
                'terms' => $term_id
            )
        ),
    );

    return get_posts($args);
}

function has_child($term_id) {
    $has_child = get_term_children($term_id, 'category_aliment');

    return $has_child;
}

function get_menu_card_nav() {

    $html = '';
    $parent_cats = get_parent_categories();

    $html .= '<h1 class="page-title">Nos Menus</h1>';
    $html .= '<div class="button-group filters-button-group">';
    $html .= ' <button class="button is-checked " data-filter="*"><i class="fas fa-list"></i>' . __('Tout', 'vg') . '</button>';
    foreach ($parent_cats as $parent_cat) {
        $html .= ' <button class="button" data-filter=".' . $parent_cat->slug . '">' . $parent_cat->name . '</button>';
    }
    $html .= '</div>';

    return $html;
}

function get_subcats() {
    add_filter('terms_clauses', function ( $pieces, $taxonomies, $args ) {

        if (!isset($args['wpse_exclude_top']) || 1 !== $args['wpse_exclude_top']
        )
            return $pieces;

        $pieces['where'] .= ' AND tt.parent > 0';

        return $pieces;
    }, 10, 3);

    $terms = get_terms('category_aliment', ['wpse_exclude_top' => 1]);
    if ($terms && !is_wp_error($terms)
    ) {
        echo '<ul>';
        foreach ($terms as $term) {
            echo '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
        }
        echo '</ul>';
    }
}

function get_menu_card() {

    $html = '';
    $html .= '<div class="menu-card-wrapper">';
    $html .= '<div class="menu-card grid-menu">';
    $parent_cats = get_parent_categories();
    foreach ($parent_cats as $parent_cat) {
        $html .= '<div class="col-menu ' . $parent_cat->slug . '">';
        $html .= '<h2 class="parent-cat-title"><span>' . $parent_cat->name . '</span></h2>';
        // Has Child
        if (has_child($parent_cat->term_id)) {
            $child_cats = get_child_categories($parent_cat->term_id);
            foreach ($child_cats as $child_cat) {
                $html .= '<h4 class="child-cat-title"><span>' . $child_cat->name . '</span></h4>';
                $aliments = get_aliments($child_cat->term_id);
                $html .= '<div class="aliment-details-wrapper">';
                $html .= '<div class="aliment-details">';
                foreach ($aliments as $aliment) {
                    $html .= '<div>';
                    $featured_img_url = get_the_post_thumbnail_url($aliment->ID, 'post-thumbnail');
                    $price = get_field('prix', $aliment->ID);
                    $html .= '<img src ="' .$featured_img_url. '" />';
                    $html .= '<span class="aliment-title">' . $aliment->post_title . '</span>';
                    $html .= '<span class="aliment-price">'.$price.' dh</span>';
                    
                    $html .= '</div>';
                }
                $html .= '</div>';
                $html .= '</div>';
            }
        } else {

            $aliments = get_aliments($parent_cat->term_id);
            $html .= '<div class="aliment-details-wrapper">';
            $html .= '<div class="aliment-details">';
            foreach ($aliments as $aliment) {
                    $html .= '<div>';
                    $featured_img_url = get_the_post_thumbnail_url($aliment->ID , 'post-thumbnail');
                    $price = get_field('prix', $aliment->ID);
                    $html .= '<img src ="' .$featured_img_url. '" />';
                    $html .= '<span class="aliment-title">' . $aliment->post_title . '</span>';
                    $html .= '<span class="aliment-price">'.$price.' dh</span>';
                    
                    $html .= '</div>';
            }
            $html .= '</div>';
            $html .= '</div>';
        }


        $html .= '</div>'; //.col-menu
    }

    $html .= '</div>';
    $html .= '</div>';


    return $html;
}
