<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dro_caterer
 */
?>
<!--<div class="container-fluid commande-wrapper" id="commander">
    <div class="row">
        <div class="col-12 col-md-1"></div>
        <div class="col-12 col-md-4">
            <p>Restaurant ViziGan est un espace chaleureux, animé tout au long de la journée, on s'y retrouve pour déjeuner ou diner dans un cadre spacieux avec un JARDIN et air de jeux pour enfants profitant ainsi d'un repas a l'abri de l'agitation de Casablanca</p>
        </div>
        <div class="col-12 col-md-4">
            <h2>Pour Commander appelez nous sur : </h2>
<?php echo list_phones(); ?>
        </div>
        <div class="col-12 col-md-1"></div>
    </div>
</div>-->
<div class="container-fluid adresse-wrapper" id="adresse">
    <div class="row">
        <div class="col-12 col-md-1"></div>
        <div class="col-12 col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13304.421319050842!2d-7.7841147!3d33.524647!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9acaa03f481b576a!2sRestaurant-Caf%C3%A9%20VIZIGAN!5e0!3m2!1sfr!2sma!4v1604742544818!5m2!1sfr!2sma" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <div class="visible-col-12"></div>
        <div class="col-12 col-md-4">
            <h1>km 12 route d'Azemmour Dar Bouazza</h1>
            <h3>Casablanca, Maroc</h3>
            <h5>en face AQUAPARK (Station Afriquia)</h5>
        </div>
        <div class="col-12 col-md-1"></div>
    </div>
</div>
</div><!-- #content -->

<footer id="contact" class="site-footer">
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-12">
                <?php echo list_phones(); ?>
            </div>
            <div class="col-12 sharing">
                <?php echo do_shortcode('[Sassy_Social_Share]') ?>
            </div>

        </div><!-- ./row justify-content-center -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="copyright">
                    <span>&COPY; StarWebApps </span>
                </div>
            </div>
        </div>        

    </div><!-- ./container-fluid -->
</footer><!-- #colophon -->

<!-- Modal -->
<div class="modal fade" style="z-index: 123999942222" id="contactForm" tabindex="-1" role="dialog" aria-labelledby="contactForm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactForm">Laisser nous un message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo do_shortcode('[contact-form-7 id="127" title="Formulaire de contact 1"]'); ?>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

</div><!-- #page -->
<a href="#" class="scrollup"><i class="ionicon ion-ios-arrow-up"></i></a>
    <?php wp_footer(); ?>



</body>
</html>
