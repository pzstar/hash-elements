<?php

namespace HashElements;

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

class Ajax_Select {

    public function __construct() {
        add_action('wp_ajax_hash_elements_get_posts_by_query', array($this, 'get_posts_by_query'));
        //add_action('wp_ajax_nopriv_hash_elements_get_posts_by_query', array($this, 'get_posts_by_query'));
        add_action('wp_ajax_hash_elements_get_posts_title_by_id', array($this, 'get_posts_title_by_id'));
        //add_action('wp_ajax_nopriv_hash_elements_get_posts_title_by_id', array($this, 'get_posts_title_by_id'));
    }

    /**
     * Only editor users may query, and only for post types they could pick in the widget.
     */
    private function verify_request() {
        check_ajax_referer('hash-elements-ajax-select', 'nonce');

        if (!current_user_can('edit_posts')) {
            wp_send_json_error(null, 403);
        }
    }

    private function get_post_type() {
        $post_type = isset($_POST['post_type']) ? sanitize_key(wp_unslash($_POST['post_type'])) : 'post'; // phpcs:ignore
        $post_type_obj = get_post_type_object($post_type);

        if (!$post_type_obj || !$post_type_obj->public) {
            wp_send_json(array());
        }

        return $post_type;
    }

    public function get_posts_by_query() {
        $this->verify_request();

        $search_string = isset($_POST['q']) ? sanitize_text_field(wp_unslash($_POST['q'])) : ''; // phpcs:ignore
        $post_type = $this->get_post_type();
        $results = array();
        add_filter('posts_where', array($this, 'title_filter'), 10, 2);
        $query = new \WP_Query(array(
            'post_type' => $post_type,
            'posts_per_page' => 50,
            'title_filter' => $search_string,
            'post_status' => 'publish',
            'no_found_rows' => true,
            'ignore_sticky_posts' => true,
        ));
        remove_filter('posts_where', array($this, 'title_filter'), 10);

        foreach ($query->posts as $post) {
            $results[] = array(
                'id' => $post->ID,
                'text' => $post->post_title,
            );
        }
        wp_send_json($results);
    }

    public function get_posts_title_by_id() {
        $this->verify_request();

        $ids = isset($_POST['id']) ? array_filter(array_map('absint', (array) wp_unslash($_POST['id']))) : array(); // phpcs:ignore
        $post_type = $this->get_post_type();
        $results = array();

        // An empty post__in would return every post.
        if (empty($ids)) {
            wp_send_json($results);
        }

        $query = new \WP_Query(
            array(
                'post_type' => $post_type,
                'post__in' => $ids,
                'posts_per_page' => -1,
                'orderby' => 'post__in',
                'post_status' => 'publish',
                'no_found_rows' => true,
                'ignore_sticky_posts' => true,
            )
        );

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
