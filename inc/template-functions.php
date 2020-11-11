<?php

function get_parent_categories() {

    return get_terms(
            array(
                'taxonomy' => 'category_aliment',
                'parent' => 0,
                'orderby' => 'term_order' ));
}

function get_child_categories($parent) {

    return get_terms(
            array(
                'taxonomy' => 'category_aliment',
                'parent' => $parent,
                'orderby' => 'term_order' ));
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

function loop_aliments( $aliments){
        $html  = '';
                foreach ($aliments as $aliment) {

                    $featured_img_url = get_the_post_thumbnail_url($aliment->ID, 'post-thumbnail');
                    $price = get_field('prix', $aliment->ID);
                    $ingredient = get_field('ingredient', $aliment->ID);
                    $html .= '<div class="desc col-12">';
                    $html .= '<div class="row">';
                    
                    $html .= '<div class="col-4">';
                    $html .= '<img src ="' .$featured_img_url. '" />';
                    $html .= '</div>';
                    
                    $html .= '<div class="col-8">';
                    $html .= '<div class="txt">';
                    $html .= '<span class="aliment-title">' . $aliment->post_title . '</span>';
                    $html .= '<p>'.$ingredient.'</p>';
                    $html .= '<span class="aliment-price"><span class="amount">'.$price.' DH</span></span>';
                    $html .= '</div>';
                    $html .= '</div>';
                    
                    $html .= '</div>';
                    $html .= '</div>';

                }    
                
                return $html;
}
function has_child($term_id) {
    $has_child = get_term_children($term_id, 'category_aliment');

    return $has_child;
}

function get_menu_card_nav() {

    $html = '';
    $parent_cats = get_parent_categories();
    $html .= '<div class="button-group filters-button-group">';
    $html .= '<h1 class="page-title">Nos Menus</h1>';    
    $html .= ' <button class="button is-checked " data-filter="*"><i class="fa fa-list"></i>' . __('Tout', 'vg') . '</button>';
    foreach ($parent_cats as $parent_cat) {
        $html .= ' <button class="button" data-filter=".' . $parent_cat->slug . '">' . $parent_cat->name . '</button>';
    }
    $html .= '</div>';

    return $html;
}

function get_menu_card() {

    $html = '';
    $html .= '<div id="menus" class="menu-card-wrapper">';
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

                
                if( has_child( $child_cat->term_id ) ){
                    
                    $child_cats_deep = get_child_categories($child_cat->term_id);
                    foreach ($child_cats_deep as $child_cat_deep ) {
                        $html .= '<h6 class="child-cat-deep-title">'.$child_cat_deep->name.'</h6>';
                        $aliments = get_aliments($child_cat_deep->term_id);
                        $html .= '<div class="aliment-details-wrapper container-fluid">';
                        $html .= '<div class="aliment-details row">';
                        $html .= loop_aliments($aliments);
                        $html .= '</div>';
                        $html .= '</div>';                        
                    }
                    
                }else{
                    $aliments = get_aliments($child_cat->term_id);
                    $html .= '<div class="aliment-details-wrapper container-fluid">';
                    $html .= '<div class="aliment-details row">';
                    $html .= loop_aliments($aliments);
                    $html .= '</div>';
                    $html .= '</div>';  
                }

            }
        } else {

            $aliments = get_aliments($parent_cat->term_id);
            $html .= '<div class="aliment-details-wrapper container-fluid">';
            $html .= '<div class="aliment-details row">';
            $html .= loop_aliments($aliments);
            $html .= '</div>';
            $html .= '</div>';
        }


        $html .= '<div class="grid-item grid-item--height2" style="height: 50px;width: 100%;background-color: #fff; color:#fff">spacer</div>';
        $html .= '</div>'; //.col-menu
    }
    $html .= '<div class="grid-item grid-item--height2" style="height: 50px;width: 100%;background-color: #fff;color:#fff">spacer</div>';
    $html .= '</div>';
    $html .= '</div>';


    return $html;
}
function list_phones(){
    
    $html = '';
    $html .= '<div class="commande-wrapper">';
    $html .= '<h5>Pour passer commande ou toutes informations</h5>';
    $html .='<ul class="phone-numbers">';
        
        $html .= '<li>';
        $html .= '<a class="vg-phone" href="tel:+212610410031"><span><i class="fa fa-phone-square"></i></span><span class="phone-number">0610410031</span></a>';
        $html .= '</li>';
        $html .= '<li>';
        $html .= '<a class="vg-phone" href="tel:+212653635200"><span><i class="fa fa-phone-square"></i></span><span class="phone-number">0653635200</span></a>';
        $html .= '</li>';
        $html .= '<li>';
        $html .= '<a class="vg-phone" href="tel:+212661517363"><span><i class="fa fa-phone-square"></i></span><span class="phone-number">0661517363</span></a>';
        $html .= '</li>';        
    $html .= '</ul>';
    
    $html .='</div>';
    return $html;
    
}
