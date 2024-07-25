<?php

namespace HashElements;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;
use HashElements\AjaxSelect_Control;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Group_Control_Query extends Group_Control_Base {

    protected static $fields;

    public static function get_type() {
        return 'hash-elements-query';
    }

    protected function init_fields() {
        $fields = [];

        $fields['post_type'] = [
            'label' => esc_html__('Source', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
        ];

        return $fields;
    }

    protected function prepare_fields($fields) {

        //$args = $this->get_args();

        $post_types = self::get_post_types();

        $fields['post_type']['options'] = $post_types;

        $fields['post_type']['default'] = 'post'; //key($post_types);

        $taxonomy_filter_args = [
            'show_in_nav_menus' => true,
        ];

        $taxonomies = get_taxonomies($taxonomy_filter_args, 'objects');

        foreach ($taxonomies as $taxonomy => $object) {
            $args = array(
                'taxonomy' => $taxonomy,
                'orderby' => 'name',
                'order' => 'ASC',
                'hierarchical' => 0,
                'hide_empty' => 0,
            );
            $all_categories = get_terms($args);
            $cat_ids = [];

            if (!empty($all_categories)) {
                foreach ($all_categories as $cat) {
                    $cat_ids[] = $cat->term_id;
                }
            }

            $fields[$taxonomy . '_ids'] = [
                'label' => $object->label,
                'type' => Selectize_Control::Selectize,
                'label_block' => true,
                'multiple' => true,
                'key_options' => hash_elements_get_dropdown_indent_array(0, $all_categories, $cat_ids),
                'condition' => [
                    'post_type' => $object->object_type,
                ],
            ];
        }

        $fields['exclude_posts'] = [
            'label' => esc_html__('Exclude Posts', 'hash-elements'),
            'type' => AjaxSelect_Control::AJAXSELECT,
            'search' => 'hash_elements_get_posts_by_query',
            'render' => 'hash_elements_get_posts_title_by_id',
            'post_type' => 'post',
            'label_block' => true,
            'multiple' => true,
            'condition' => [
                'post_type' => 'post'
            ]
        ];

        $fields['orderby'] = [
            'label' => esc_html__('Order By', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'date' => esc_html__('Date', 'hash-elements'),
                'modified' => esc_html__('Last Modified Date', 'hash-elements'),
                'rand' => esc_html__('Rand', 'hash-elements'),
                'comment_count' => esc_html__('Comment Count', 'hash-elements'),
                'title' => esc_html__('Title', 'hash-elements'),
                'ID' => esc_html__('Post ID', 'hash-elements'),
                'author' => esc_html__('Show Post Author', 'hash-elements'),
            ],
            'default' => 'date',
        ];

        $fields['order'] = [
            'label' => esc_html__('Order', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'DESC' => esc_html__('Descending', 'hash-elements'),
                'ASC' => esc_html__('Ascending', 'hash-elements'),
            ],
            'default' => 'DESC',
        ];

        $fields['offset'] = [
            'label' => esc_html__('Offset', 'hash-elements'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => '',
        ];

        return parent::prepare_fields($fields);
    }

    private static function get_post_types() {
        $post_type_args = [
            'show_in_nav_menus' => true,
        ];

        $_post_types = get_post_types($post_type_args, 'objects');

        $post_types = [];

        foreach ($_post_types as $post_type => $object) {
            $post_types[$post_type] = $object->label;
        }

        return $post_types;
    }

    protected function get_default_options() {
        return [
            'popover' => false,
        ];
    }

}
