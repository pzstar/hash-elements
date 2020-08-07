<?php

namespace HashElements\Modules\TotalModuleTen\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Repeater;
use HashElements\Group_Control_Query;
use HashElements\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class TotalModuleTen extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'het-total-module-ten';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Logo Carousel', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'het-total-module-ten';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'logo_section', [
            'label' => esc_html__('Logo Section', 'hash-elements'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Type your title here', 'hash-elements' ),
            ]
        );

        $repeater->add_control(
            'logo_image',
            [
                'label' => __( 'Choose Logo', 'hash-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'logo_block',
            [
                'label' => __( 'Logo', 'hash-elements' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Logo 1', 'hash-elements' ),
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'carousel_section', [
            'label' => esc_html__('Carousel Settings', 'viral-pro'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'autoplay', [
            'label' => esc_html__('Autoplay', 'viral-pro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'viral-pro'),
            'label_off' => esc_html__('No', 'viral-pro'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'pause_duration', [
            'label' => esc_html__('Pause Duration', 'viral-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['s'],
            'range' => [
                's' => [
                    'min' => 1,
                    'max' => 20,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 's',
                'size' => 5,
            ],
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_responsive_control(
                'no_of_slides', [
            'label' => esc_html__('No of Slides', 'viral-pro'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 3,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 2,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 1,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_responsive_control(
                'slides_margin', [
            'label' => esc_html__('Spacing Between Slides', 'viral-pro'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 30,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 30,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 30,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
                'nav', [
            'label' => esc_html__('Nav Arrow', 'viral-pro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'viral-pro'),
            'label_off' => esc_html__('Hide', 'viral-pro'),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'dots', [
            'label' => esc_html__('Nav Dots', 'viral-pro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'viral-pro'),
            'label_off' => esc_html__('Hide', 'viral-pro'),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'navigation_style', [
            'label' => esc_html__('Navigation', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'nav_style_tabs'
        );

        $this->start_controls_tab(
                'nav_normal_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'nav_normal_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_normal_nav_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_bg_color', [
            'label' => esc_html__('Dots Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel button.owl-dot' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'nav_hover_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'nav_hover_bg_color', [
            'label' => esc_html__('Background Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_hover_nav_color', [
            'label' => esc_html__('Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button:hover i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_bg_color_hover', [
            'label' => esc_html__('Dots Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel button.owl-dot:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        // echo '<pre>';print_r($settings);echo '</pre>';return false;
        $logo_images = $settings['logo_block'];
        $params = array(
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause' => (int) $settings['pause_duration']['size'] * 1000,
            'items' => (int) $settings['no_of_slides']['size'],
            'items_tablet' => (int) $settings['no_of_slides_tablet']['size'],
            'items_mobile' => (int) $settings['no_of_slides_mobile']['size'],
            'margin' => (int) $settings['slides_margin']['size'],
            'margin_tablet' => (int) $settings['slides_margin_tablet']['size'],
            'margin_mobile' => (int) $settings['slides_margin_mobile']['size'],
            'nav' => $settings['nav'] == 'yes' ? true : false,
            'dots' => $settings['dots'] == 'yes' ? true : false
        );
        $params = json_encode($params);
        ?>
        <div class="het_client_logo_slider owl-carousel" data-params='<?php echo $params ?>'>
            <?php
            foreach ($logo_images as $key => $logo) {
                $image = wp_get_attachment_image_src( attachment_url_to_postid($logo['logo_image']['url'] ), 'full');
                if ($image) {
                    echo '<img class="no-lazyload" src="'. esc_url($image[0]) .'" alt="' .$logo['title']. '">';
                } else {
                    ?>
                    <img src="<?php echo esc_url(Utils::get_placeholder_image_src()) ?>">
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
}
