<?php

namespace HashElements\Modules\TotalModuleFive\Widgets;

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
class TotalModuleFive extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'het-total-module-five';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Services Block', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'het-total-module-five';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'services', [
            'label' => esc_html__('Services', 'hash-elements'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'services_title', [
                'label' => __( 'Title', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'services_description',
            [
                'label' => __( 'Description', 'hash-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'Ad has pertinax salutandi definitiones, quo ex omnis paulo equidem, minim alterum urbanitas eam et. ...', 'hash-elements' ),
                'placeholder' => __( 'Type your description here', 'hash-elements' ),
            ]
        );

        $repeater->add_control(
            'button_text', [
                'label' => __( 'Button Text', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More'
            ]
        );

        $repeater->add_control(
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
        
        $repeater->add_control(
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

        $this->add_control(
            'services_block',
            [
                'label' => __( 'Services', 'hash-elements' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'services_title' => __( 'Services #1', 'hash-elements' ),
                    ]
                ],
                'title_field' => '{{{ services_title }}}',
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
            'selectors' => [
                '{{WRAPPER}} .het-service-icon i' => 'color: {{VALUE}}',
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
                '{{WRAPPER}} .het-service-icon' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'icon_border_color', [
            'label' => esc_html__('Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-active .het-service-icon' => 'box-shadow: 0px 0px 0px 2px #FFF, 0px 0px 0px 4px {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'line_color', [
            'label' => esc_html__('Line Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-service-post-wrap:after' => 'background: {{VALUE}}',
            ],
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
                '{{WRAPPER}} .het-service-excerpt h5' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-service-excerpt h5',
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
                '{{WRAPPER}} .het-service-excerpt-text' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-service-excerpt-text',
                ]
        );

        $this->end_controls_section();  

        $this->start_controls_section(
                'link_style', [
            'label' => esc_html__('Link', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'link_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-service-text a',
                ]
        );

        $this->start_controls_tabs(
                'link_style_tabs'
        );

        $this->start_controls_tab(
                'normal_link_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'normal_link_icon_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-service-text a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'hover_link_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'hover_link_icon_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-service-text a:hover' => 'color: {{VALUE}}',
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
        <div class="het-service-post-wrap">
            <?php
            foreach ($settings['services_block'] as $key => $service) {
            ?>
                <div class="het-service-post het-clearfix">
                    <div class="het-service-icon"><i class="<?php echo esc_attr($service['icon']['value']); ?>"></i></div>
                    <div class="het-service-excerpt">
                        <h5><?php echo esc_attr($service['services_title']); ?></h5>
                        <div class="het-service-text">
                            <div class="het-service-excerpt-text">
                                <?php
                                if (isset($service['services_description']) && !empty($service['services_description'])) {
                                    echo esc_html(hash_elements_total_excerpt($service['services_description'], $settings['excerpt_length']));
                                }
                                ?>
                                <br/>
                            </div>
                            <a href="<?php echo esc_url($service['button_link']['url']); ?>"><?php echo esc_html($service['button_text']); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            <?php
             }
            ?>
        </div>
        <?php
    }
}
