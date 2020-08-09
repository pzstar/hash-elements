(function ($, elementor) {
    'use strict';
    var HashElements = {

        init: function () {

            var widgets = {
                'he-carousel-module-one.default': HashElements.carousel,
                'he-ticker-module.default': HashElements.ticker,
                'square-plus-slider.default': HashElements.squareSlider,
                'square-plus-elastic-gallery.default': HashElements.squareElasticGallery,
                'square-plus-tab-block.default': HashElements.squareTab,
                'square-plus-logo-carousel.default': HashElements.squareLogoCarousel,
                'total-slider.default': HashElements.totalSlider,
                'total-service-block.default': HashElements.totalServices,
                'total-portfolio-masonary.default': HashElements.totalPortfolio,
                'het-total-module-seven.default': HashElements.totalCounter,
                'het-total-module-eight.default': HashElements.totalTestimonialSlider,
                'het-total-module-ten.default': HashElements.totalLogoSlider
            };
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
        },
        ticker: function ($scope) {
            var $element = $scope.find('.he-ticker');
            if ($element.length > 0) {
                $element.each(function () {
                    var params = JSON.parse($(this).find('.owl-carousel').attr('data-params'));
                    $(this).find('.owl-carousel').owlCarousel({
                        items: 1,
                        margin: 10,
                        loop: true,
                        mouseDrag: false,
                        autoplay: params.autoplay,
                        autoplayTimeout: parseInt(params.pause) * 1000,
                        nav: true,
                        dots: false,
                        navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>']
                    });
                });
            }
        },
        carousel: function ($scope) {
            var $element = $scope.find('.he-carousel-block-wrap');
            if ($element.length > 0) {
                $element.each(function () {
                    var params = JSON.parse($(this).attr('data-params'));
                    $(this).owlCarousel({
                        loop: true,
                        autoplay: JSON.parse(params.autoplay),
                        autoplayTimeout: params.pause,
                        nav: JSON.parse(params.nav),
                        dots: JSON.parse(params.dots),
                        navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                        responsive: {
                            0: {
                                items: params.items_mobile,
                                margin: params.margin_mobile,
                                stagePadding: params.stagepadding_mobile
                            },
                            580: {
                                items: params.items_tablet,
                                margin: params.margin_tablet,
                                stagePadding: params.stagepadding_tablet
                            },
                            860: {
                                items: params.items,
                                margin: params.margin,
                                stagePadding: params.stagepadding
                            }
                        }
                    })
                });
            }
        },
        squareLogoCarousel: function ($scope) {
            var $element = $scope.find('.he-client-logo-slider');
            if ($element.length > 0) {
                $element.each(function () {
                    var params = JSON.parse($(this).attr('data-params'));
                    $element.owlCarousel({
                        autoplay: JSON.parse(params.autoplay),
                        loop: true,
                        nav: false,
                        dots: JSON.parse(params.dots),
                        autoplayTimeout: params.pause,
                        responsive: {
                            0: {
                                items: params.items_mobile,
                                margin: params.margin_mobile,
                            },
                            480: {
                                items: params.items_tablet,
                                margin: params.margin_tablet,
                            },
                            768: {
                                items: params.items,
                                margin: params.margin,
                            }
                        }
                    });
                });
            }
        },
        squareTab: function ($scope) {
            var $element = $scope.find('.he-tab-wrapper');
            if ($element.length > 0) {
                $element.each(function () {
                    $(this).find('.he-tab-pane:first').show();
                    $(this).find('.he-tab li:first').addClass('he-active');

                    $('.he-tab li a').on('click', function () {
                        var tab = $(this).attr('href');
                        $(this).closest('.he-tab-wrapper').find('.he-tab li').removeClass('he-active');
                        $(this).parent('li').addClass('he-active');
                        $(this).closest('.he-tab-wrapper').find('.he-tab-pane').hide();
                        $(this).closest('.he-tab-wrapper').find(tab).show();
                        return false;
                    });
                });
            }
        },
        squareElasticGallery: function ($scope) {
            var $element = $scope.find('#he-elasticstack');
            if ($element.length > 0) {
                new ElastiStack(document.getElementById('he-elasticstack'), {
                    // distDragBack: if the user stops dragging the image in a area that does not exceed [distDragBack]px 
                    // for either x or y then the image goes back to the stack 
                    distDragBack: 200,
                    // distDragMax: if the user drags the image in a area that exceeds [distDragMax]px 
                    // for either x or y then the image moves away from the stack 
                    distDragMax: 450,
                    // callback
                    onUpdateStack: function (current) {
                        return false;
                    }
                });
            }
        },
        squareSlider: function ($scope) {
            var $element = $scope.find('.he-bx-slider');
            if ($element.length > 0) {
                $element.each(function () {
                    var params = JSON.parse($(this).attr('data-params'));
                    $(this).owlCarousel({
                        autoplay: JSON.parse(params.autoplay),
                        items: 1,
                        loop: true,
                        nav: JSON.parse(params.nav),
                        dots: false,
                        autoplayTimeout: params.pause,
                        animateOut: 'fadeOut'
                    });
                });
            }
        },
        totalSlider: function ($scope) {
            var $el = $scope.find('.het-bx-slider');
            var params = JSON.parse($el.attr('data-params'));
            if ($el.find('.het-slide').length > 0) {
                $el.owlCarousel({
                    autoplay: JSON.parse(params.autoplay),
                    items: 1,
                    loop: true,
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    autoplayTimeout: params.pause,
                    animateOut: 'fadeOut',
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>']
                });
            }
        },
        totalPortfolio: function ($scope) {

            $('.het-portfolio-image').nivoLightbox();
            if ($('.het-portfolio-posts').length > 0) {

                var first_class = $('.het-portfolio-cat-name:first').data('filter');
                $('.het-portfolio-cat-name:first').addClass('active');

                var $container = $('.het-portfolio-posts').imagesLoaded(function () {

                    $container.isotope({
                        itemSelector: '.het-portfolio',
                        filter: first_class
                    });

                    var elems = $container.isotope('getFilteredItemElements');

                    elems.forEach(function (item, index) {
                        if (index == 0 || index == 4) {
                            $(item).addClass('wide');
                            var bg = $(item).find('.het-portfolio-image').attr('href');
                            $(item).find('.het-portfolio-wrap').css('background-image', 'url(' + bg + ')');
                        } else {
                            $(item).removeClass('wide');
                        }
                    });

                    GetMasonary();

                    setTimeout(function () {
                        $container.isotope({
                            itemSelector: '.het-portfolio',
                            filter: first_class,
                        });
                    }, 2000);

                    $(window).on('resize', function () {
                        GetMasonary();
                    });

                });

                $('.het-portfolio-cat-name-list').on('click', '.het-portfolio-cat-name', function () {
                    var filterValue = $(this).attr('data-filter');
                    $container.isotope({filter: filterValue});

                    var elems = $container.isotope('getFilteredItemElements');

                    elems.forEach(function (item, index) {
                        if (index == 0 || index == 4) {
                            $(item).addClass('wide');
                            var bg = $(item).find('.het-portfolio-image').attr('href');
                            $(item).find('.het-portfolio-wrap').css('background-image', 'url(' + bg + ')');
                        } else {
                            $(item).removeClass('wide');
                        }
                    });

                    GetMasonary();

                    var filterValue = $(this).attr('data-filter');
                    $container.isotope({filter: filterValue});

                    $('.het-portfolio-cat-name').removeClass('active');
                    $(this).addClass('active');
                });

                function GetMasonary() {
                    var winWidth = window.innerWidth;
                    if (winWidth > 580) {

                        $container.find('.het-portfolio').each(function () {
                            var image_width = $(this).find('img').width();
                            if ($(this).hasClass('wide')) {
                                $(this).find('.het-portfolio-wrap').css({
                                    height: (image_width * 2) + 15 + 'px'
                                });
                            } else {
                                $(this).find('.het-portfolio-wrap').css({
                                    height: image_width + 'px'
                                });
                            }
                        });

                    } else {
                        $container.find('.het-portfolio').each(function () {
                            var image_width = $(this).find('img').width();
                            if ($(this).hasClass('wide')) {
                                $(this).find('.het-portfolio-wrap').css({
                                    height: (image_width * 2) + 8 + 'px'
                                });
                            } else {
                                $(this).find('.het-portfolio-wrap').css({
                                    height: image_width + 'px'
                                });
                            }
                        });
                    }
                }

            }
        },

        totalLogoSlider: function ($scope) {
            var $el = $scope.find(".het_client_logo_slider");
            var params = JSON.parse($el.attr('data-params'));
            $el.owlCarousel({
                autoplay: JSON.parse(params.autoplay),
                loop: true,
                nav: JSON.parse(params.nav),
                dots: JSON.parse(params.dots),
                autoplayTimeout: params.pause,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                responsive: {
                    0: {
                        items: params.items_mobile,
                        margin: params.margin_mobile,
                    },
                    480: {
                        items: params.items_tablet,
                        margin: params.margin_tablet,
                    },
                    768: {
                        items: params.items,
                        margin: params.margin,
                    }
                }
            });
        },

        totalTestimonialSlider: function ($scope) {
            var $el = $scope.find('.het-testimonial-slider');
            var params = JSON.parse($el.attr('data-params'));
            $el.owlCarousel({
                autoplay: JSON.parse(params.autoplay),
                loop: true,
                nav: JSON.parse(params.nav),
                dots: JSON.parse(params.dots),
                autoplayTimeout: params.pause,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                responsive: {
                    0: {
                        items: params.items_mobile,
                    },
                    480: {
                        items: params.items_tablet,
                    },
                    768: {
                        items: params.items,
                    }
                }
            });
        },

        totalCounter: function ($scope) {
            var $el = $scope.find('.het-team-counter-wrap');

            $el.waypoint(function () {
                $el.find('.odometer').each(function () {

                    var $eachCounter = $(this);
                    var $count = $eachCounter.data('count');

                    setTimeout(function () {
                        $eachCounter.html($count);
                    }, 500);

                });
            }, {
                offset: 800,
                triggerOnce: true
            });
        },

        totalServices: function ($scope) {
            $('.het-service-excerpt h5').click(function () {
                $(this).next('.het-service-text').slideToggle();
                $(this).parents('.het-service-post').toggleClass('het-active');
            });

            $('.het-service-icon').click(function () {
                $(this).next('.het-service-excerpt').find('.het-service-text').slideToggle();
                $(this).parent('.het-service-post').toggleClass('het-active');
            });
        },
        
    };
    $(window).on('elementor/frontend/init', HashElements.init);
}(jQuery, window.elementorFrontend));
