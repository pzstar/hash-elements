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
                'total-counter-block.default': HashElements.totalCounter,
                'total-testimonial-slider.default': HashElements.totalTestimonialSlider,
                'total-logo-carousel.default': HashElements.totalLogoSlider
            };
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

            elementor.hooks.addAction('frontend/element_ready/column', HashElements.elementorColumn);
            //elementorFrontend.hooks.addAction('frontend/element_ready/section', HashElements.setStickySection);
        },
        ticker: function ($scope) {
            var $element = $scope.find('.he-ticker');
            if ($element.length > 0) {
                var params = JSON.parse($element.find('.owl-carousel').attr('data-params'));
                $element.find('.owl-carousel').owlCarousel({
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
            }
        },
        carousel: function ($scope) {
            var $element = $scope.find('.he-carousel-block-wrap');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
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
            }
        },
        squareLogoCarousel: function ($scope) {
            var $element = $scope.find('.he-client-logo-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
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
            }
        },
        squareTab: function ($scope) {
            var $element = $scope.find('.he-tab-wrapper');
            if ($element.length > 0) {
                $element.find('.he-tab-pane:first').show();
                $element.find('.he-tab li:first').addClass('he-active');
                $element.find('.he-tab li a').on('click', function () {
                    var tab = $(this).attr('href');
                    $(this).closest('.he-tab-wrapper').find('.he-tab li').removeClass('he-active');
                    $(this).parent('li').addClass('he-active');
                    $(this).closest('.he-tab-wrapper').find('.he-tab-pane').hide();
                    $(this).closest('.he-tab-wrapper').find(tab).show();
                    return false;
                });
            }
        },
        squareElasticGallery: function ($scope) {
            var $id = $scope.data('id');
            var $element = $scope.find('#he-elasticstack-' + $id);
            if ($element.length > 0) {
                new ElastiStack(document.getElementById('he-elasticstack-' + $id), {
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
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    autoplay: JSON.parse(params.autoplay),
                    items: 1,
                    loop: true,
                    nav: JSON.parse(params.nav),
                    dots: false,
                    autoplayTimeout: params.pause,
                    animateOut: 'fadeOut',
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>']
                });
            }
        },
        totalSlider: function ($scope) {
            var $element = $scope.find('.het-bx-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
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
            var $element = $scope.find('.het-portfolio-container');
            var $id = $scope.data('id');

            if ($element.length > 0) {

                var active_tab = $element.find('.het-portfolio-cat-name-list').data('active');
                if ($element.find('.het-portfolio-cat-name[data-filter="' + active_tab + '"]').length == 0) {
                    var active_tab = $element.find('.het-portfolio-cat-name:first').data('filter');
                }

                $element.find('.het-portfolio-cat-name[data-filter="' + active_tab + '"]').addClass('active');

                var $container = $('.het-portfolio-posts-' + $id).imagesLoaded(function () {
                    $container.isotope({
                        itemSelector: '.het-portfolio',
                        filter: active_tab
                    });

                    HashSetMasonary($container);

                    $(window).on('resize', function () {
                        HashGetMasonary($element, $container);
                    }).resize();

                    $container.isotope({
                        itemSelector: '.het-portfolio',
                        filter: active_tab,
                    });
                });

                $element.find('.het-portfolio-cat-name-list').on('click', '.het-portfolio-cat-name', function () {
                    var filterValue = $(this).attr('data-filter');
                    $container.isotope({filter: filterValue});

                    HashSetMasonary($container);
                    HashGetMasonary($element, $container);

                    $container.isotope({filter: filterValue});

                    $element.find('.het-portfolio-cat-name').removeClass('active');
                    $(this).addClass('active');
                });
            }
        },
        totalLogoSlider: function ($scope) {
            var $element = $scope.find('.het-client-logo-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    autoplay: JSON.parse(params.autoplay),
                    loop: true,
                    nav: false,
                    dots: JSON.parse(params.dots),
                    autoplayTimeout: params.pause,
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
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
            }
        },
        totalTestimonialSlider: function ($scope) {
            var $element = $scope.find('.het-testimonial-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    items: 1,
                    autoplay: JSON.parse(params.autoplay),
                    loop: true,
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    autoplayTimeout: params.pause,
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>']
                });
            }
        },
        totalCounter: function ($scope) {
            var $element = $scope.find('.het-counter');
            if ($element.length > 0) {
                $element.waypoint(function () {
                    var $odometer = $element.find('.odometer');
                    $odometer.html($odometer.data('count'));
                    this.destroy();
                }, {
                    offset: '90%',
                });
            }
        },
        totalServices: function ($scope) {
            $scope.find('.het-service-excerpt h5').click(function () {
                $(this).next('.het-service-text').slideToggle();
                $(this).parents('.het-service-post').toggleClass('het-active');
            });
            $scope.find('.het-service-icon').click(function () {
                $(this).next('.het-service-excerpt').find('.het-service-text').slideToggle();
                $(this).parent('.het-service-post').toggleClass('het-active');
            });
        },
        elementorColumn: function ($scope) {
            var columnId = $scope.data('id');
            var editMode = Boolean(elementor.isEditMode());
            var stickyInstanceOptions = {
                topSpacing: 50,
                bottomSpacing: 50,
                innerWrapperSelector: '.elementor-widget-wrap'
            };
            if (!editMode) {
                if ($scope.hasClass('he-elementor-sticky-column')) {
                    var adminbarHeight = 0;
                    if ($('body').hasClass('admin-bar')) {
                        adminbarHeight = 32;
                    }
                    var $stickywrap = $scope.find('> .elementor-column-wrap');
                    $scope.find('> .elementor-column-wrap,> .elementor-widget-wrap').addClass('ht-clearfix');
                    if ($stickywrap.length > 0) {
                        stickyInstanceOptions.innerWrapperSelector = '.elementor-column-wrap';
                    } else {
                        stickyInstanceOptions.innerWrapperSelector = '.elementor-widget-wrap';
                    }
                    $scope.css({display: 'block'});
                    stickyInstanceOptions.topSpacing = parseInt($scope.attr('data-top-spacing')) + adminbarHeight;
                    stickyInstanceOptions.bottomSpacing = parseInt($scope.attr('data-bottom-spacing'));
                    stickyInstanceOptions.containerSelector = '.elementor-container';

                    var stickyInstance = new StickySidebar($scope[0], stickyInstanceOptions);
                    $scope.attr('data-sticky-column', 'true');

                    $(window).resize(function () {
                        var currentDeviceMode = elementorFrontend.getCurrentDeviceMode(),
                                availableDevices = ['desktop', 'tablet'],
                                isInit = $scope.attr('data-sticky-column');

                        if (-1 !== availableDevices.indexOf(currentDeviceMode)) {
                            if (isInit === 'false') {
                                $scope.attr('data-sticky-column', 'true');
                                stickyInstance = new StickySidebar($scope[0], stickyInstanceOptions);
                                stickyInstance.updateSticky();
                            }
                        } else {
                            $scope.attr('data-sticky-column', 'false');
                            stickyInstance.destroy();
                        }
                    }).resize();
                }
            } else {
                var settings = HashElements.columnEditorSettings(columnId);
                if ('true' === settings['sticky']) {
                    $scope.addClass('he-elementor-sticky-column');
                    var $stickywrap = $scope.find('> .elementor-column-wrap');
                    $scope.find('> .elementor-column-wrap,> .elementor-widget-wrap').addClass('ht-clearfix');
                    if ($stickywrap.length > 0) {
                        stickyInstanceOptions.innerWrapperSelector = '.elementor-column-wrap';
                    } else {
                        stickyInstanceOptions.innerWrapperSelector = '.elementor-widget-wrap';
                    }
                    $scope.css({display: 'block'});

                    stickyInstanceOptions.topSpacing = settings['topSpacing'];
                    stickyInstanceOptions.bottomSpacing = settings['bottomSpacing'];

                    var stickyInstance = new StickySidebar($scope[0], stickyInstanceOptions);
                    $scope.attr('data-sticky-column', 'true');
                    stickyInstance.updateSticky();

                    $(window).resize(function () {
                        var currentDeviceMode = elementorFrontend.getCurrentDeviceMode(),
                                availableDevices = ['desktop', 'tablet'],
                                isInit = $scope.attr('data-sticky-column');

                        if (-1 !== availableDevices.indexOf(currentDeviceMode)) {
                            if (isInit === 'false') {
                                $scope.attr('data-sticky-column', 'true');
                                stickyInstance = new StickySidebar($scope[0], stickyInstanceOptions);
                                stickyInstance.updateSticky();
                            }
                        } else {
                            $scope.attr('data-sticky-column', 'false');
                            stickyInstance.destroy();
                        }
                    }).resize();
                } else {
                    $scope.removeClass('he-elementor-sticky-column');
                }
            }



        },
        columnEditorSettings: function (columnId) {
            var editorElements = null,
                    columnData = {};

            if (!window.elementor.hasOwnProperty('elements')) {
                return false;
            }

            editorElements = window.elementor.elements;

            if (!editorElements.models) {
                return false;
            }

            $.each(editorElements.models, function (index, obj) {

                $.each(obj.attributes.elements.models, function (index, obj) {
                    if (columnId == obj.id) {
                        columnData = obj.attributes.settings.attributes;
                    }
                });

            });

            return {
                'sticky': columnData['hash_elements_sidebar_sticky'] || false,
                'topSpacing': columnData['hash_elements_sidebar_sticky_top_spacing'] || 50,
                'bottomSpacing': columnData['hash_elements_sidebar_sticky_bottom_spacing'] || 50,
            }
        },
        resizeSticky: function ($target) {
            var currentDeviceMode = elementorFrontend.getCurrentDeviceMode();

            if (-1 !== availableDevices.indexOf(currentDeviceMode)) {
                $target.data('stickyColumnInit', true);
                stickyInstance = new StickySidebar($target[0], stickyInstanceOptions);
                stickyInstance.updateSticky();
            } else {
                $target.data('stickyColumnInit', false);
                stickyInstance.destroy();
            }
        }
    };
    $(window).on('elementor/frontend/init', HashElements.init);

    var JetStickyTools = {
        debounce: function (threshold, callback) {
            var timeout;

            return function debounced($event) {
                function delayed() {
                    callback.call(this, $event);
                    timeout = null;
                }

                if (timeout) {
                    clearTimeout(timeout);
                }

                timeout = setTimeout(delayed, threshold);
            };
        }
    }
}(jQuery, window.elementorFrontend));

function HashGetMasonary($element, $container) {
    var winWidth = window.innerWidth;
    var containerWidth = $element.find('.het-portfolio-posts').width();
    var three_col_image = containerWidth / 3;

    if (winWidth > 580) {
        $container.find('.het-portfolio').each(function () {
            if (jQuery(this).hasClass('wide')) {
                jQuery(this).css({
                    height: three_col_image * 2 + 'px',
                    width: three_col_image + 'px'
                });
            } else {
                jQuery(this).css({
                    height: three_col_image + 'px',
                    width: three_col_image + 'px'
                });
            }
        });
    } else {
        $container.find('.het-portfolio').each(function () {
            jQuery(this).css({
                height: containerWidth + 'px'
            });
        });
    }
}

function HashSetMasonary($container) {
    var elems = $container.isotope('getFilteredItemElements');
    elems.forEach(function (item, index) {
        if (index == 0 || index == 4) {
            jQuery(item).addClass('wide');
        } else {
            jQuery(item).removeClass('wide');
        }
    });
}
