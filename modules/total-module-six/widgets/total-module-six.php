<?php

namespace HashElements\Modules\TotalModuleSix\Widgets;

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
class TotalModuleSix extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'het-total-module-six';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Team Section', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'het-total-module-six';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'team', [
            'label' => esc_html__('Team', 'hash-elements'),
                ]
        );

        $this->add_control(
            'member_name', [
                'label' => __( 'Name', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Name', 'hash-elements' ),
            ]
        );

        $this->add_control(
            'member_designation', [
                'label' => __( 'Designations', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'member_description',
            [
                'label' => __( 'Description', 'hash-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => __( 'Type your description here', 'hash-elements' ),
            ]
        );

        $this->add_control(
            'member_image',
            [
                'label' => __( 'Choose Photo', 'hash-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'button_text', [
                'label' => __( 'Button Text', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Detail'
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
        
        $repeater = new Repeater();

        $repeater->add_control(
            'social_icon_name', [
                'label' => __( 'Social Icon Name', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'icon',
            [
                'label' => __( 'Social Icon', 'hash-elements' ),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $repeater->add_control(
            'social_icon_link',
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
            'social_icons_block',
            [
                'label' => __( 'Social Icons', 'hash-elements' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'services_title' => __( 'Icon #1', 'hash-elements' ),
                    ]
                ],
                'title_field' => '{{{ social_icon_name }}}',
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
                'title_style', [
            'label' => esc_html__('Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'header_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-title-wrap' => 'background: {{VALUE}}',
            ],
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
                '{{WRAPPER}} .het-team-member h6' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-team-member h6',
                ]
        );

        $this->end_controls_section(); 

        $this->start_controls_section(
                'designation_style', [
            'label' => esc_html__('Designation', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'designation_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-team-member .het-team-designation' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'designation_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-team-member .het-team-designation',
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
                '{{WRAPPER}} .het-member-description-text' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-member-description-text',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'overlay_style', [
            'label' => esc_html__('Overlay', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'overlay_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-team-member-excerpt' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();  

        $this->start_controls_section(
                'button_style', [
            'label' => esc_html__('Button', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'button_style_tabs'
        );

        $this->start_controls_tab(
                'normal_button_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'normal_button_text_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-team-detail' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'normal_button_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-team-detail' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'hover_button_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'hover_button_text_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .het-team-detail:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'hover_button_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .het-team-detail:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();  

        $this->start_controls_section(
                'social_icon_style', [
            'label' => esc_html__('Social Icon', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'social_icon_main_bg_color', [
            'label' => esc_html__('Main Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-team-member' => 'background-color: {{VALUE}}',
            ],
            'default' => '#fff'
                ]
        );

        $this->start_controls_tabs(
                'social_icon_style_tabs'
        );

        $this->start_controls_tab(
                'normal_social_btn_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'normal_social_btn_icon_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-team-social-id a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'normal_social_btn_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-team-social-id a' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'hover_social_btn_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'hover_social_btn_icon_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .het-team-social-id a:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'hover_social_btn_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .het-team-social-id a:hover' => 'background-color: {{VALUE}}',
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
        $social_icons_block = $settings['social_icons_block'];
        ?>
        <div class="het-team-member">

            <div class="het-team-member-image">
                <?php
                if ($settings['member_image']['url']) {
                    $image_url = $settings['member_image']['url'];
                } else {
                    $image_url = HASHELE_URL . 'assets/img/team-thumb.png';
                }
                ?>

                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($settings['member_name']); ?>" />
                <div class="het-title-wrap">
                    <h6><?php echo esc_attr($settings['member_name']); ?></h6>
                </div>

                <a href="<?php echo esc_attr($settings['button_link']['url']); ?>" class="het-team-member-excerpt">
                    <div class="het-team-member-excerpt-wrap">
                        <div class="het-team-member-span">
                            <h6><?php echo esc_attr($settings['member_name']); ?></h6>

                            <?php 
                            if ($settings['member_designation']) { ?>
                                <div class="het-team-designation"><?php echo esc_html($settings['member_designation']); ?></div>
                            <?php } ?>

                            <?php
                            if (isset($settings['member_description']) && !empty($settings['member_description'])) {
                                echo '<div class="het-member-description-text">';
                                echo esc_html(hash_elements_total_excerpt($settings['member_description'], $settings['excerpt_length']));
                                echo '</div>';
                            }
                            ?>
                            <div class="het-team-detail"><?php esc_html_e('Detail', 'total') ?></div>
                        </div>
                    </div>
                </a>
            </div>  

            <?php 
            if(isset($settings['social_icons_block']) && !empty($settings['social_icons_block'])) { 
                ?>
                <div class="het-team-social-id">
                <?php foreach ($social_icons_block as $key => $icon_block) { ?>
                    <a target="_blank" href="<?php echo esc_url($icon_block['social_icon_link']['url']) ?>"><i class="<?php echo esc_attr($icon_block['icon']['value']); ?>"></i></a>
                <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}
