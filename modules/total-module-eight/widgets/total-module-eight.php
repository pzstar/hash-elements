<?php

namespace HashElements\Modules\TotalModuleEight\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Repeater;
use Elementor\Utils;
use HashElements\Group_Control_Query;
use HashElements\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class TotalModuleEight extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'het-total-module-eight';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Testimonial Carousel', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'het-total-module-eight';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'testimonial', [
            'label' => esc_html__('Testimonial', 'hash-elements'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_name', [
                'label' => __( 'Name', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => __( 'Choose Photo', 'hash-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $repeater->add_control(
            'testimonial_text',
            [
                'label' => __( 'Testimonial Text', 'hash-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => __( 'Type your description here', 'hash-elements' ),
            ]
        );

        $this->add_control(
            'testimonial_block',
            [
                'label' => __( 'Testimonials', 'hash-elements' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_name' => __( 'Testimonial 1', 'hash-elements' ),
                    ]
                ],
                'title_field' => '{{{ testimonial_name }}}',
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
                'size' => 1,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 1,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 1,
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
                'additional_settings', [
            'label' => esc_html__('Additional Settings', 'hash-elements'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control('excerpt_length', [
            'label' => esc_html__('Excerpt Length', 'hash-elements'),
            'description' => esc_html__('Enter 0 to hide excerpt', 'hash-elements'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 100
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
                'member_name_style', [
            'label' => esc_html__('Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'member_name_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-testimonial h6' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'member_name_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-testimonial h6',
                ]
        );

        $this->end_controls_section();     

        $this->start_controls_section(
                'excerpt_style', [
            'label' => esc_html__('Excerpt', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'excerpt_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-testimonial-excerpt ' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'excerpt_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-testimonial-excerpt ',
                ]
        );

        $this->end_controls_section();  

        $this->start_controls_section(
                'photo_style', [
            'label' => esc_html__('Photo', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'photo_outline_color', [
            'label' => esc_html__('Outline Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-testimonial-wrap .owl-carousel .owl-item img' => 'border-color: {{VALUE}}',
            ],
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
                'nav_icon_normal_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-next' => 'color: {{VALUE}}',
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev' => 'color: {{VALUE}}',
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
                'nav_icon_hover_color', [
            'label' => esc_html__('Icon Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-next:hover' => 'color: {{VALUE}}',
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev:hover' => 'color: {{VALUE}}',
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
        $testimonials = $settings['testimonial_block'];
        $params = array(
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause' => (int) $settings['pause_duration']['size'] * 1000,
            'items' => (int) $settings['no_of_slides']['size'],
            'items_tablet' => (int) $settings['no_of_slides_tablet']['size'],
            'items_mobile' => (int) $settings['no_of_slides_mobile']['size'],
            'nav' => $settings['nav'] == 'yes' ? true : false,
            'dots' => $settings['dots'] == 'yes' ? true : false
        );
        $params = json_encode($params);
        ?>
        <div class="het-testimonial-wrap">
            <div class="het-testimonial-slider owl-carousel" data-params='<?php echo $params ?>'>
                <?php
                foreach($testimonials as $key => $testimonial) {
                    $total_image = wp_get_attachment_image_src(attachment_url_to_postid( $testimonial['testimonial_image']['url'] ), 'total-thumb');
                    ?>
                    <div class="het-testimonial">
                        <div class="het-testimonial-excerpt">
                            <i class="fa fa-quote-left"></i>
                            <?php
                            if (isset($testimonial['testimonial_text']) && !empty($testimonial['testimonial_text'])) {
                                echo esc_html(hash_elements_total_excerpt($testimonial['testimonial_text'], $settings['excerpt_length']));
                            }
                            ?>
                        </div>
                        <?php
                        if ($total_image) {
                            ?>
                            <img src="<?php echo esc_url($total_image[0]) ?>" alt="<?php echo esc_attr($testimonial['testimonial_name']); ?>">
                            <?php
                        } else {
                        ?>
                            <img src="<?php echo esc_url(Utils::get_placeholder_image_src()); ?>">
                        <?php    
                        }
                        ?>
                        <h6><?php echo esc_attr($testimonial['testimonial_name']); ?></h6>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}
