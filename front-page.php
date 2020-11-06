<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dro_caterer
 */
get_header('front-page');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 content-area-wrapper">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <?php echo get_menu_card_nav(); ?>
                    <?php echo get_menu_card(); ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .col-lg-9 -->
        
    </div><!-- .row -->
</div><!-- ./ container-fluid -->
<?php
get_footer();

