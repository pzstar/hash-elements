<?php

namespace HashElements;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Group_Control_Header extends Group_Control_Base {

    protected static $fields;

    public static function get_type() {
        return 'hash-elements-header';
    }

    protected function init_fields() {
        $fields = [];

        $fields['title'] = [
            'label' => esc_html__('Title', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true
        ];

        $fields['link'] = [
            'label' => esc_html__('Link', 'hash-elements'),
            'type' => Controls_Manager::URL,
            'show_external' => true,
            'default' => [
                'url' => '',
                'is_external' => false,
                'nofollow' => true,
            ],
        ];

        $fields['style'] = [
            'label' => esc_html__('Style', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'he-title-style1',
            'options' => [
                'he-title-style1' => esc_html__('Style 1', 'hash-elements'),
                'he-title-style2' => esc_html__('Style 2', 'hash-elements'),
                'he-title-style3' => esc_html__('Style 3', 'hash-elements'),
                'he-title-style4' => esc_html__('Style 4', 'hash-elements')
            ],
        ];

        return $fields;
    }

    protected function get_default_options() {
        return [
            'popover' => false,
        ];
    }

}
