<?php

namespace HashElements\Modules\TotalPortfolioMasonary\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Utils;
use HashElements\Group_Control_Query;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class TotalPortfolioMasonary extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-portfolio-masonary';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Portfolio Masonary', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'total-portfolio-masonary';
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
                '{{WRAPPER}} .het-portfolio-caption h5' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-portfolio-caption h5',
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
                '{{WRAPPER}} .het-portfolio-caption' => 'background-color: {{VALUE}}',
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
                'normal_button_icon_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-caption a' => 'color: {{VALUE}}',
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
                '{{WRAPPER}} .het-portfolio-caption a' => 'background-color: {{VALUE}}',
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
                'hover_button_icon_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-caption a:hover' => 'color: {{VALUE}}',
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
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-caption a:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();  


        $this->start_controls_section(
                'category_style', [
            'label' => esc_html__('Category', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'icon_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-cat-name-list i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->start_controls_tabs(
                'category_style_tabs'
        );

        $this->start_controls_tab(
                'category_button_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'category_color', [
            'label' => esc_html__('Category Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-cat-name' => 'color: {{VALUE}}',
            ],
                ]
        );

        

        $this->end_controls_tab();

        $this->start_controls_tab(
                'category_hover_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'category_hover_color', [
            'label' => esc_html__('Category Color(Active & Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-cat-name.active,
                {{WRAPPER}} .het-portfolio-cat-name:hover' => 'color: {{VALUE}}',
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
        <section id="het-portfolio-section" class="het-section">
            <div class="het-container">
                <?php                
                $total_portfolio_cat = $settings['posts_category_ids'];

                if ($total_portfolio_cat) {
                    ?>  
                    <div class="het-portfolio-cat-name-list">
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        <?php
                        foreach ($total_portfolio_cat as $total_portfolio_cat_single) {
                            $category_slug = "";
                            $category_slug = get_category($total_portfolio_cat_single);
                            if (is_object($category_slug)) {
                                $category_slug = 'total-portfolio-' . $category_slug->term_id;
                                ?>
                                <div class="het-portfolio-cat-name" data-filter=".<?php echo esc_attr($category_slug); ?>">
                                    <?php echo esc_html(get_cat_name($total_portfolio_cat_single)); ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                <?php } ?>

                <div class="het-portfolio-post-wrap">
                    <div class="het-portfolio-posts het-clearfix">
                        <?php
                        if ($total_portfolio_cat) {
                            $count = 1;
                            $args = $this->query_args();
                            $query = new \WP_Query($args);
                            if ($query->have_posts()):
                                while ($query->have_posts()): $query->the_post();
                                    $categories = get_the_category();
                                    $category_slug = "";
                                    $cat_slug = array();

                                    foreach ($categories as $category) {
                                        $cat_slug[] = 'total-portfolio-' . $category->term_id;
                                    }

                                    $category_slug = implode(" ", $cat_slug);

                                    if (has_post_thumbnail()) {
                                        $image_url = HASHELE_URL . 'assets/img/portfolio-small-blank.png';
                                        $total_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-portfolio-thumb');
                                        $total_image_large = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                    } else {
                                        $image_url = HASHELE_URL . 'assets/img/portfolio-small.png';
                                        $total_image = "";
                                    }
                                    ?>
                                    <div class="het-portfolio <?php echo esc_attr($category_slug); ?>">
                                        <div class="het-portfolio-outer-wrap">
                                            <div class="het-portfolio-wrap" style="background-image: url(<?php echo esc_url($total_image[0]) ?>);">

                                                <img  class="no-lazyload" src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr(get_the_title()); ?>">

                                                <div class="het-portfolio-caption">
                                                    <h5><?php the_title(); ?></h5>
                                                    <a class="het-portfolio-link" href="<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-link"></i></a>

                                                    <?php if (has_post_thumbnail()) { ?>
                                                        <a class="het-portfolio-image" data-lightbox-gallery="gallery1" href="<?php echo esc_url($total_image_large[0]) ?>"><i class="fa fa-search"></i></a>
                                                        <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                    <?php ?>
                </div>
            </div>
        </section>
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
        $args['posts_per_page'] = -1;
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
