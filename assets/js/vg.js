/*
 * 
 */
;
(function ($) {

    $(document).ready(function () {
// external js: isotope.pkgd.js

// init Isotope
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




        /* Stick navigation and scroll top on window scrolling  */

        var stickyNavTop = $('.button-group').offset().top;
        $(window).scroll(function () {
            var scrollToTop = $(window).scrollTop();

            if (scrollToTop > stickyNavTop) {
                $('.button-group').addClass('sticky-menu-nav');
            } else {
                $('.button-group').removeClass('sticky-menu-nav');
            }

        });
        $('div.button-group button').on('click', function () {

            if ($('div.button-group').hasClass('sticky-menu-nav')) {
//                console.log('ticky');
                $("body,html").animate(
                        {
                            scrollTop: $("div.menu-card-wrapper").offset().top
                        },
                500, function () {
//                    $('.button-group').addClass('sticky-menu-nav');
                }
                );
            }
        });
        /* Main Menu Scroll */
        $('ul.menu a').on('click', function (e) {
            e.preventDefault();
            $linkTo = $(this).attr('href');
//            console.log($linkTo);
            $("body,html").animate(
                    {
                        scrollTop: $($linkTo).offset().top - 150
                    },
            500
                    );
        });
    });

})(jQuery);