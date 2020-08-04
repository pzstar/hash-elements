<?php

namespace HashElements\Modules\SquareModuleSix\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Utils;
use HashElements\Group_Control_Query;
use HashElements\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class SquareModuleSix extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'he-square-module-six';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Header', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'he-square-module-six';
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
            'title', [
                'label' => __( 'Title', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Heading'
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
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .he-section-title' => 'color: {{VALUE}}',
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
            'selector' => '{{WRAPPER}} .he-section-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'hash-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .he-section-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();  
        
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
            <h2 class="he-section-title"><?php echo esc_attr($settings['title']); ?></h4>
        <?php
    }
}
