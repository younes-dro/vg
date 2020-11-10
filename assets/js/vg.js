/*
 * 
 */
;
(function ($) {

    $(document).ready(function () {
        var logo = $('.custom-logo-link img').clone(true, true);
        $('div.wp_mm_wrapper ul.menu').append(logo);
        var phones = $('div.commande-wrapper').clone();
        $(phones).insertAfter('div.wp_mm_wrapper ul.menu');

// external js: isotope.pkgd.js


        $('.grid-menu').imagesLoaded(function () {
            // init Isotope after all images have loaded
            var iso = new Isotope(' .grid-menu ', {
                itemSelector: '.col-menu',
                layoutMode: 'vertical'
            });
            // filter functions
            var filterFns = {
            };

// bind filter button click
            var filtersElem = document.querySelector('.filters-button-group');
            filtersElem.addEventListener('click', function (event) {
                // only work with buttons
                if (!matchesSelector(event.target, 'button')) {
                    return;
                }
                var filterValue = event.target.getAttribute('data-filter');
                // use matching filter function
                filterValue = filterFns[ filterValue ] || filterValue;
                iso.arrange({filter: filterValue});
            });

// change is-checked class on buttons
            var buttonGroups = document.querySelectorAll('.button-group');
            for (var i = 0, len = buttonGroups.length; i < len; i++) {
                var buttonGroup = buttonGroups[i];
                radioButtonGroup(buttonGroup);
            }

            function radioButtonGroup(buttonGroup) {
                buttonGroup.addEventListener('click', function (event) {
                    // only work with buttons
                    if (!matchesSelector(event.target, 'button')) {
                        return;
                    }
                    buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
                    event.target.classList.add('is-checked');
                });
            }
        });


        /* Stick navigation and scroll top on window scrolling  */

        var stickyNavTop = $('.button-group').offset().top;
        var collapse = $("<div/>",
                {
                    'class': 'collapse-container',
                    'html': '<span class="ionicon ion-android-more-vertical"></span>'}
        );
        $('.button-group').append(collapse);
        $(window).scroll(function () {
            var scrollToTop = $(window).scrollTop();

            if (scrollToTop > stickyNavTop) {
                $('.button-group').addClass('sticky-menu-nav');
                $('div.collapse-container').addClass('show');
//                $('div.collapse-container span').removeClass('ion-more');
            } else {
                $('.button-group').removeClass('sticky-menu-nav closed');
                $('div.collapse-container').removeClass('show');
//                $('div.collapse-container span').removeClass('ion-more');
            }
            // Scroll to the top
            if ($(this).scrollTop() > 200) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }

        });
        $('div.button-group button').on('click', function () {

            if ($('div.button-group').hasClass('sticky-menu-nav')) {
                $("body,html").animate(
                        {
                            scrollTop: $("div.menu-card-wrapper").offset().top
                        },
                500, function () {
                }
                );
            }
        });
        $('div.collapse-container span.ionicon').on('click',function(){
            $('.button-group').toggleClass('closed');
            
            
        });

        // Scroll to the top
        $('.scrollup').click(function () {
            $("html, body").animate({scrollTop: 0}, 200);
            return false;
        });


        /* Modal */
        $("body").on("click", "ul.menu a", function (e) {
            $("#toggle-menu").trigger("click");
            e.preventDefault();

            $linkTo = $(this).attr('href');
            console.log($linkTo);
            $($linkTo + 'Form').modal("show");
        });
    });

})(jQuery);