<?php

namespace HashElements\Modules\TotalModuleThree\Widgets;

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
class TotalModuleThree extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'het-total-module-three';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Featured Block', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'het-total-module-three';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'featured', [
            'label' => esc_html__('Featured Block', 'hash-elements'),
                ]
        );

        $this->add_control(
            'featured_title', [
                'label' => __( 'Title', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'featured_description',
            [
                'label' => __( 'Description', 'hash-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => __( 'Type your description here', 'hash-elements' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'button_text', [
                'label' => __( 'Button Text', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __( 'Button Link', 'hash-elements' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'Enter URL', 'hash-elements' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'hash-elements' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'icon_target',
                    'library' => 'solid',
                ],
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
            'default' => '#FFF',
            'selectors' => [
                '{{WRAPPER}} .het-featured-icon i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'icon_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-featured-icon' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'icon_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-featured-icon i',
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
                '{{WRAPPER}} .het-featured-post h5' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-featured-post h5',
                ]
        );

        $this->end_controls_section();  

        $this->start_controls_section(
                'content_style', [
            'label' => esc_html__('Content', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'content_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-featured-post' => 'background: {{VALUE}}',
            ],
                ]
        );  

        $this->add_control(
                'content_border_color', [
            'label' => esc_html__('Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-featured-post' => 'border: 2px solid {{VALUE}}',
            ],
                ]
        );   

        $this->end_controls_section();  

        $this->start_controls_section(
                'description_style', [
            'label' => esc_html__('Description', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'description_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-featured-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-featured-excerpt',
                ]
        );

        $this->end_controls_section();  

        $this->start_controls_section(
                'button_style', [
            'label' => esc_html__('Button', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'button_border_color', [
            'label' => esc_html__('Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-featured-link a' => 'border-left: 10px solid {{VALUE}};border-right: 10px solid {{VALUE}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'button_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-featured-link a',
                ]
        );

        $this->start_controls_tabs(
                'button_style_tabs'
        );

        $this->start_controls_tab(
                'button_normal_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'button_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#FFF',
            'selectors' => [
                '{{WRAPPER}} .het-featured-link a' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'button_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-featured-link a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'button_hover_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'button_hover_bg_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .het-featured-link a:hover' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'button_hover_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#FFF',
            'selectors' => [
                '{{WRAPPER}} .het-featured-link a:hover' => 'color: {{VALUE}}',
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
        ?>
        <div class="het-featured-post">
            <div class="het-featured-icon"><i class="<?php echo esc_attr($settings['icon']['value']); ?>"></i></div>
            <h5><?php echo $settings['featured_title']; ?></h5>
            <div class="het-featured-excerpt">
                <?php
                if (isset($settings['featured_description']) && !empty($settings['featured_description'])) {
                    echo esc_html(hash_elements_total_excerpt($settings['featured_description'], $settings['excerpt_length']));
                }
                ?>
            </div>
            <div class="het-featured-link">
                <a href="<?php echo esc_url($settings['button_link']['url']); ?>"><?php echo esc_html($settings['button_text']); ?></a>
            </div>
        </div>
        <?php
    }
}
