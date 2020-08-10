<?php

namespace HashElements\Modules\PersonalInfoModule\Widgets;

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

class PersonalInfoModule extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'he-personal-info-module';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Personal Info', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'he-carousel-module-one he-news-modules';
    }

    /** Category */
    public function get_categories() {
        return ['he-magazine-elements'];
    }

    /** Controls */
    protected function _register_controls() {


        $this->start_controls_section(
                'header', [
            'label' => esc_html__('Header', 'hash-elements'),
                ]
        );

        $this->add_group_control(
                Group_Control_Header::get_type(), [
            'name' => 'header',
            'label' => esc_html__('Header', 'hash-elements'),
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_section', [
            'label' => esc_html__('Content', 'hash-elements'),
                ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'short_intro',
            [
                'label' => __( 'Short Intro', 'hash-elements' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'placeholder' => __( 'Type your short intro here', 'hash-elements' ),
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => __( 'Name', 'hash-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Type your name here', 'hash-elements' ),
                'label_block' => true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'header_style', [
            'label' => esc_html__('Header Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'header_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-block-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'header_short_border_color', [
            'label' => esc_html__('Short Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '.he-viral {{WRAPPER}} .he-block-title' => 'border-color: {{VALUE}}',
                '.he-viral-news {{WRAPPER}} .he-block-title span:before' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'header_long_border_color', [
            'label' => esc_html__('Long Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '.he-viral {{WRAPPER}} .he-block-title:after' => 'background-color: {{VALUE}}',
                '.he-viral-news {{WRAPPER}} .he-block-title' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'header_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-block-title'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'intro_style', [
            'label' => esc_html__('Intro', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'intro_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .vl-pi-intro' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'intro_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .vl-pi-intro'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'name_style', [
            'label' => esc_html__('Name', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'name_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .vl-pi-name' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_control(
                'dash_color', [
            'label' => esc_html__('Dash Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .vl-personal-info .vl-pi-name span:before,
                {{WRAPPER}} .vl-personal-info .vl-pi-name span:after' => 'background: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'name_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .vl-pi-name'
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $title = $settings['title'];
        $image = $settings['image']['url'];
        $intro = $settings['short_intro'];
        $name = $settings['name'];

        ?>
        <div class="vl-personal-info">
            <?php
            $this->render_header();

            if (!empty($image)):
                $image_id = attachment_url_to_postid($image);
                if ($image_id) {
                    $image_array = wp_get_attachment_image_src($image_id, 'thumbnail');
                    echo '<div class="vl-pi-image"><img alt="' . esc_html($title) . '" src="' . esc_url($image_array[0]) . '"/></div>';
                }else{
                    echo '<div class="vl-pi-image"><img alt="' . esc_html($title) . '" src="' . esc_url($image) . '"/></div>';
                }
            endif;

            if (!empty($name)):
                echo '<div class="vl-pi-name"><span>' . esc_html($name) . '</span></div>';
            endif;

            if (!empty($intro)):
                echo '<div class="vl-pi-intro">' . esc_html($intro) . '</div>';
            endif;
            ?>
        </div>
        <?php
    }

    /** Render Header */
    protected function render_header() {
        $settings = $this->get_settings();

        $this->add_render_attribute('header_attr', 'class', [
            'he-block-title'
                ]
        );

        $link_open = $link_close = "";
        $target = $settings['header_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['header_link']['nofollow'] ? ' rel="nofollow"' : '';

        if ($settings['header_link']['url']) {
            $link_open = '<a href="' . $settings['header_link']['url'] . '"' . $target . $nofollow . '>';
            $link_close = '</a>';
        }

        if ($settings['header_title']) {
            ?>
            <h2 <?php echo $this->get_render_attribute_string('header_attr'); ?>>
                <?php
                echo $link_open;
                echo '<span>';
                echo $settings['header_title'];
                echo '</span>';
                echo $link_close;
                ?>
            </h2>
            <?php
        }
    }

}
