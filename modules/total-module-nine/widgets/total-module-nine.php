<?php

namespace HashElements\Modules\TotalModuleNine\Widgets;

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
class TotalModuleNine extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'het-total-module-nine';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Blog Section', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'het-total-module-nine';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'section_post_query', [
            'label' => esc_html__('Content Filter', 'hash-elements'),
                ]
        );

        $this->add_group_control(
                Group_Control_Query::get_type(), [
            'name' => 'posts',
            'label' => esc_html__('Posts', 'hash-elements'),
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'blogs', [
            'label' => esc_html__('Blogs', 'hash-elements'),
                ]
        );

        $this->add_control(
            'post_count',
            [
                'label' => __( 'Number of Blogs', 'plugin-domain' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 3,
                'max' => 50,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_control('excerpt_length', [
            'label' => esc_html__('Excerpt Length', 'hash-elements'),
            'description' => esc_html__('Enter 0 to hide excerpt', 'hash-elements'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 190
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
                'post_title_style', [
            'label' => esc_html__('Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Title Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-blog-excerpt h5 a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_hover_color', [
            'label' => esc_html__('Title Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-blog-excerpt h5 a:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'featured_title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-blog-excerpt h5 a',
                ]
        );

        $this->add_control(
                'featured_title_margin', [
            'label' => esc_html__('Margin', 'hash-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .het-blog-excerpt h5' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'post_style', [
            'label' => esc_html__('Post', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'post_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-blog-post' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'post_border_color', [
            'label' => esc_html__('Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-blog-post' => 'border-color: {{VALUE}}',
            ],
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
                '{{WRAPPER}} .het-blog-excerpt .het-blog-excerpt-text' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'excerpt_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-blog-excerpt .het-blog-excerpt-text',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'post_metas', [
            'label' => esc_html__('Metas', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'post_metas_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-blog-date' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'post_metas_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-blog-date'
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
            'selectors' => [
                '{{WRAPPER}} .het-blog-read-more a' => 'color: {{VALUE}}',
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
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-blog-read-more a' => 'background-color: {{VALUE}}',
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
                '{{WRAPPER}} .het-blog-read-more a:hover' => 'color: {{VALUE}}',
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
                '{{WRAPPER}} .het-blog-read-more a:hover' => 'background-color: {{VALUE}}',
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
        <div class="het-blog-wrap het-clearfix">
            <?php
            $args = $this->query_args();
            $query = new \WP_Query($args);
            if ($query->have_posts()):
                while ($query->have_posts()): $query->the_post();
                    $total_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-blog-thumb');
                    ?>
                    <div class="het-blog-post het-clearfix">
                        <?php
                        if (has_post_thumbnail()) {
                            ?> 
                            <div class="het-blog-thumbnail">
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($total_image[0]) ?>" alt="<?php the_title(); ?>"></a>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="het-blog-excerpt">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <div class="het-blog-date"><i class="fa fa-calendar-o" aria-hidden="true"></i><?php echo get_the_date(); ?></div>
                            <?php
                            if (has_excerpt() && '' != trim(get_the_excerpt())) {
                                echo '<div class="het-blog-excerpt-text">';
                                the_excerpt();
                                echo '</div>';
                            } else {
                                echo '<div class="het-blog-excerpt-text">';
                                echo esc_html(hash_elements_total_excerpt(get_the_content(), $settings['excerpt_length']));
                                echo '</div>';
                            }
                            ?>
                        </div>

                        <div class="het-blog-read-more">
                            <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'hash-elements'); ?></a>
                        </div>
                    </div>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <?php
    }

    /** Query Args */
    protected function query_args() {
        $settings = $this->get_settings();

        $post_type = $args['post_type'] = $settings['posts_post_type'];
        $args['orderby'] = $settings['posts_orderby'];
        $args['order'] = $settings['posts_order'];
        $args['ignore_sticky_posts'] = 1;
        $args['post_status'] = 'publish';
        $args['offset'] = $settings['posts_offset'];
        $args['posts_per_page'] = $settings['post_count'];
        $args['post__not_in'] = $post_type == 'post' ? $settings['posts_exclude_posts'] : [];

        $args['tax_query'] = [];

        $taxonomies = get_object_taxonomies($post_type, 'objects');

        foreach ($taxonomies as $object) {
            $setting_key = 'posts_' . $object->name . '_ids';

            if (!empty($settings[$setting_key])) {
                $args['tax_query'][] = [
                    'taxonomy' => $object->name,
                    'field' => 'term_id',
                    'terms' => $settings[$setting_key],
                ];
            }
        }

        return $args;
    }
}
