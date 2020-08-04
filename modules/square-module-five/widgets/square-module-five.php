<?php

namespace HashElements\Modules\SquareModuleFive\Widgets;

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
class SquareModuleFive extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'square-plus-logo-carousel';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Logo Carousel', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'he-square-module-five';
    }

    /** Category */
    public function get_categories() {
        return ['he-square-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'section_content', [
            'label' => esc_html__('Content', 'hash-elements'),
                ]
        );

        $this->add_control(
            'header', [
                'label' => __( 'Header', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'title', [
            'label' => __('Title', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Title'
                ]
        );

        $repeater->add_control(
                'image', [
            'label' => __('Choose Image', 'hash-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->add_control(
                'slides', [
            'label' => __('Slides', 'hash-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'hash-elements'),
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'carousel_settings', [
            'label' => esc_html__('Carousel Settings', 'viral-pro'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_responsive_control(
                'slides_to_show', [
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
                'size' => 5,
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
                'autoplay_speed', [
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
                'title_style', [
            'label' => esc_html__('Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} h2.he-section-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_border_color', [
            'label' => esc_html__('Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-section-title:after' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} h2.he-section-title',
                ]
        );

        $this->end_controls_section(); 

        $this->start_controls_section(
                'dot_style', [
            'label' => esc_html__('Naviagation Dot Style', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'dot_tabs'
        );

        $this->start_controls_tab(
                'dot_style_normal_tab', [
            'label' => esc_html__('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'dot_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'dot_style_active_tab', [
            'label' => esc_html__('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'dot_color_hover', [
            'label' => esc_html__('Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .owl-dots .owl-dot:hover' => 'background-color: {{VALUE}}',
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
        $logo_images = $settings['slides'];
        $params = array(
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause' => (int) $settings['autoplay_speed']['size'] * 1000,
            'items' => (int) $settings['slides_to_show']['size'],
            'items_tablet' => (int) $settings['slides_to_show_tablet']['size'],
            'items_mobile' => (int) $settings['slides_to_show_mobile']['size'],
            'margin' => (int) $settings['slides_margin']['size'],
            'margin_tablet' => (int) $settings['slides_margin_tablet']['size'],
            'margin_mobile' => (int) $settings['slides_margin_mobile']['size'],
            'dots' => $settings['dots'] == 'yes' ? true : false
        );
        $params = json_encode($params);
        ?>

        <section id="he-logo-section" class="he-section">
            <div class="he-container">

                <?php if(isset($settings['header']) && !empty($settings['header'])) { ?>
                    <h2 class="he-section-title"><?php echo esc_html($settings['header']); ?></h2>
                <?php } ?>

                <div class="he_client_logo_slider owl-carousel" data-params='<?php echo $params ?>'>
                    <?php
                    foreach ($logo_images as $key => $logo) {
                        $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($logo['image']['id'], 'thumb', $settings);
                        if (!$image_url) {
                            $image_url = \Elementor\Utils::get_placeholder_image_src();
                        }
                        
                        $image_alt = get_post_meta(attachment_url_to_postid($logo['image']['id'] ), '_wp_attachment_image_alt', true);
                        $image_alt_text = $image_alt ? $image_alt : esc_html__('Logo', 'hash-elements');
                        ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_html($image_alt_text) ?>">
                        <?php
                        
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
