(function ($, elementor) {
    "use strict";
    var HashElements = {

        init: function () {

            var widgets = {
                'he-news-module-eleven.default': HashElements.viralNewsCarousel,
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

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
                        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
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
