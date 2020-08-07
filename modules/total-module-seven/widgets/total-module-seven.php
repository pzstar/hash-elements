<?php

namespace HashElements\Modules\TotalModuleSeven\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use HashElements\Group_Control_Query;
use HashElements\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class TotalModuleSeven extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'het-total-module-seven';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Counter Block', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'het-total-module-seven';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'counter', [
            'label' => esc_html__('Counter', 'hash-elements'),
                ]
        );


        $this->add_control(
            'counter_title', [
                'label' => __( 'Title', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'counter_number',
            [
                'label' => __( 'Counter Number', 'hash-elements' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000000,
                'step' => 1,
                'default' => 10,
            ]
        );

        $this->add_control(
                'counter_icon', [
            'label' => __('Icon', 'hash-elements'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-star',
                'library' => 'solid',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'icon_style', [
            'label' => esc_html__('Icon', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'icon_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-counter-icon' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'icon_side_border_color', [
            'label' => esc_html__('Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-counter' => 'border-color: {{VALUE}}',
                '{{WRAPPER}} .het-counter:before, {{WRAPPER}} .het-counter:after' => 'background: {{background}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'icon_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-counter-icon',
                ]
        );

        $this->end_controls_section();     

        $this->start_controls_section(
                'number_count_style', [
            'label' => esc_html__('Number Count', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'number_count_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#FFF',
            'selectors' => [
                '{{WRAPPER}} .het-counter-count' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'number_count_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-counter-count',
                ]
        );

        $this->end_controls_section(); 

        $this->start_controls_section(
                'counter_title_style', [
            'label' => esc_html__('Counter Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'counter_title_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#FFF',
            'selectors' => [
                '{{WRAPPER}} .het-counter-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'counter_title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-counter-title',
                ]
        );

        $this->end_controls_section();  
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        // echo '<pre>';print_r($settings);echo '</pre>';return false;
        ?>
        <div class="het-team-counter-wrap het-clearfix">
                <div class="het-counter">
                    <div class="het-counter-icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['counter_icon'], ['aria-hidden' => 'true']); ?>
                    </div>

                    <div class="het-counter-count odometer" data-count="<?php echo absint($settings['counter_number']); ?>">
                        99
                    </div>

                    <h6 class="het-counter-title">
                        <?php echo esc_html($settings['counter_title']); ?>
                    </h6>
                </div>
        </div>
        <?php
    }
}
