<?php

namespace HashElements\Modules\ContactInfoModule\Widgets;

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

class ContactInfoModule extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'he-contact-info-module';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Contact Info', 'hash-elements');
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
            'title',
            [
                'label' => __( 'Title', 'hash-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Type your title here', 'hash-elements' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'phone',
            [
                'label' => __( 'Phone', 'hash-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Type your phone number here', 'hash-elements' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => __( 'Email', 'hash-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Type your email here', 'hash-elements' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'website',
            [
                'label' => __( 'Website', 'hash-elements' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'hash-elements' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true
            ]
        );

        $this->add_control(
            'contact_address',
            [
                'label' => __( 'Contact Address', 'hash-elements' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'placeholder' => __( 'Type your contact address here', 'hash-elements' ),
            ]
        );

        $this->add_control(
            'contact_time',
            [
                'label' => __( 'Contact Time', 'hash-elements' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'placeholder' => __( 'Type your contact time here', 'hash-elements' ),
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
                '.vl-contact-info ul li i' => 'color: {{VALUE}}'
            ],
                ]
        );

       $this->add_control(
                'icon_size', [
            'label' => __('Icon Size', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 80,
                    'step' => 1,
                ]
            ],
            // 'default' => [
            //     'unit' => 'px',
            //     'size' => 30,
            // ],
            'selectors' => [
                '{{WRAPPER}} .vl-contact-info ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
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
                'content_text_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '.vl-contact-info ul li span' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .vl-contact-info ul li span'
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="vl-contact-info">
            <?php
            $this->render_header();
            ?>

            <ul>
                <?php if (!empty($settings['phone'])): ?>
                    <li>
                        <i class="mdi mdi-cellphone-iphone"></i>
                        <span><?php echo esc_html($settings['phone']); ?></span>
                    </li>
                <?php endif; ?>

                <?php if (!empty($settings['email'])): ?>
                    <li>
                        <i class="mdi mdi-email"></i>
                        <span><?php echo esc_html($settings['email']); ?></span>
                    </li>
                <?php endif; ?>

                <?php if (!empty($settings['website']['url'])): ?>
                    <li>
                        <i class="mdi mdi-earth"></i>
                        <span><?php echo esc_html($settings['website']['url']); ?></span>
                    </li>
                <?php endif; ?>

                <?php if (!empty($settings['contact_address'])): ?>
                    <li>
                        <i class="mdi mdi-map-marker"></i>
                        <span><?php echo wpautop(esc_html($settings['contact_address'])); ?></span>
                    </li>
                <?php endif; ?>

                <?php if (!empty($settings['contact_time'])): ?>
                    <li>
                        <i class="mdi mdi-clock-time-three"></i>
                        <span><?php echo wpautop(esc_html($settings['contact_time'])); ?></span>
                    </li>
                    <?php endif; ?>
            </ul>
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
