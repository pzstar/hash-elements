(function ($, elementor) {
    "use strict";
    var HashElements = {

        init: function () {

            var widgets = {
                'he-carousel-module-one.default': HashElements.viralNewsCarousel,
                'he-ticker-module.default': HashElements.ticker,
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

        },

        ticker: function ($scope) {
            var $el = $scope.find('.he-ticker');
            var ticker_parameters = $el.find('.owl-carousel').attr('data-params');
            var ticker_params = JSON.parse(ticker_parameters);

            var ticker_obj = {
                items: 1,
                margin: 10,
                loop: true,
                mouseDrag: false,
                autoplay: ticker_params.autoplay,
                autoplayTimeout: parseInt(ticker_params.pause) * 1000,
                nav: true,
                dots: false,
                navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            }
            $el.find('.owl-carousel').owlCarousel(ticker_obj);
        },

        viralNewsCarousel: function ($scope) {
            var $element = $scope.find('.he-carousel-block-wrap');
            if ($element.length > 0) {
                $element.each(function () {
                    var $ele = $(this).find('.he-carousel-block-wrap');
                    var $slide = $(this).attr('data-count');
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
    };
    $(window).on('elementor/frontend/init', HashElements.init);
}(jQuery, window.elementorFrontend));
