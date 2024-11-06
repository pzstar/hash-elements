<?php

namespace HashElements;

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

class Ajax_Select {

    public function __construct() {
        add_action('wp_ajax_hash_elements_get_posts_by_query', array($this, 'get_posts_by_query'));
        add_action('wp_ajax_nopriv_hash_elements_get_posts_by_query', array($this, 'get_posts_by_query'));
        add_action('wp_ajax_hash_elements_get_posts_title_by_id', array($this, 'get_posts_title_by_id'));
        add_action('wp_ajax_nopriv_hash_elements_get_posts_title_by_id', array($this, 'get_posts_title_by_id'));
    }

    public function get_posts_by_query() {
        $search_string = isset($_POST['q']) ? sanitize_text_field(wp_unslash($_POST['q'])) : ''; // phpcs:ignore
        $post_type = isset($_POST['post_type']) ? wp_unslash($_POST['post_type']) : 'post'; // phpcs:ignore
        $results = array();
        add_filter('posts_where', array($this, 'title_filter'), 10, 2);
        $query = new \WP_Query(array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'title_filter' => $search_string,
            'post_status' => 'publish',
        ));
        remove_filter('posts_where', array($this, 'title_filter'), 10, 2);
        wp_reset_postdata();
        if (!isset($query->posts)) {
            return;
        }
        foreach ($query->posts as $post) {
            $results[] = array(
                'id' => $post->ID,
                'text' => $post->post_title,
            );
        }
        wp_send_json($results);
    }

    public function get_posts_title_by_id() {
        if (!current_user_can('manage_options')) {
            return;
        }
        $ids = isset($_POST['id']) ? wp_unslash($_POST['id']) : array(); // phpcs:ignore
        $post_type = isset($_POST['post_type']) ? wp_unslash($_POST['post_type']) : 'post'; // phpcs:ignore
        $results = array();
        $query = new \WP_Query(
            array(
                'post_type' => $post_type,
                'post__in' => $ids,
                'posts_per_page' => -1,
                'orderby' => 'post__in',
            )
        );
        wp_reset_postdata();
        if (!isset($query->posts)) {
            return;
        }
        foreach ($query->posts as $post) {
            $results[$post->ID] = $post->post_title;
        }
        wp_send_json($results);
    }

    public function title_filter($where, $query) {
        global $wpdb;
        if ($search_term = $query->get('title_filter')) {
            $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($search_term)) . '%\'';
        }
        return $where;
    }

}

new Ajax_Select();
