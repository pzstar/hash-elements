<?php

/**
 * Helper Functions
 */
/** Get All Authors */
if (!function_exists('hash_elements_author_name')) {

    function hash_elements_author_name() {
        echo '<span class="he-post-author"><i class="mdi-account"></i>' . get_the_author() . '</span>';
    }

}

/** Get Comment Count */
if (!function_exists('hash_elements_comment_count')) {

    function hash_elements_comment_count() {
        echo '<span class="he-post-comment"><i class="mdi-comment-outline"></i>' . get_comments_number() . '</span>';
    }

}

if (!function_exists('hash_elements_post_date')) {

    function hash_elements_post_date($format = '') {

        if ($format) {
            echo '<span class="he-post-date"><i class="mdi-clock-time-four-outline"></i>' . get_the_date($format) . '</span>';
        } else {
            echo '<span class="he-post-date"><i class="mdi-clock-time-four-outline"></i>' . get_the_date() . '</span>';
        }
    }

}


if (!function_exists('hash_elements_time_ago')) {

    function hash_elements_time_ago() {
        echo '<span class="he-post-date"><i class="mdi-clock-time-four-outline"></i>' . human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('ago', 'hash-elements') . '</span>';
    }

}

// Custom Excerpt
if (!function_exists('hash_elements_custom_excerpt')) {

    function hash_elements_custom_excerpt($limit) {
        if ($limit) {
            $content = get_the_content();
            $content = strip_tags($content);
            $content = strip_shortcodes($content);
            $excerpt = mb_substr($content, 0, $limit);

            if (strlen($content) >= $limit) {
                $excerpt = $excerpt . '...';
            }

            echo $excerpt;
        }
    }

}

/** Get All Posts */
if (!function_exists('hash_elements_get_posts')) {

    function hash_elements_get_posts() {

        $post_list = get_posts(array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
        ));

        $posts = array();

        if (!empty($post_list) && !is_wp_error($post_list)) {
            foreach ($post_list as $post) {
                $posts[$post->ID] = $post->post_title;
            }
        }

        return $posts;
    }

}

if (!function_exists('he_get_the_primary_category')) {

    function he_get_the_primary_category($class = "he-post-categories") {
        $post_categories = hash_elements_get_post_primary_category(get_the_ID());

        if (!empty($post_categories)) {
            $category_obj = $post_categories['primary_category'];
            $category_link = get_category_link($category_obj->term_id);
            echo '<ul class="' . esc_attr($class) . '">';
            echo '<li><a class="he-primary-cat he-category-' . esc_attr($category_obj->term_id) . '" href="' . esc_url($category_link) . '">' . esc_html($category_obj->name) . '</a></li>';
            echo '</ul>';
        }
    }

}

if (!function_exists('hash_elements_get_the_category_list')) {

    function hash_elements_get_the_category_list() {
        $post_categories = hash_elements_get_post_primary_category(get_the_ID(), 'category', true);

        if (!empty($post_categories)) {
            echo '<ul class="he-post-categories">';
            $category_ids = $post_categories['all_categories'];
            foreach ($category_ids as $category_id) {
                echo '<li><a class="he-category he-category-' . esc_attr($category_id) . '" href="' . esc_url(get_category_link($category_id)) . '">' . esc_html(get_cat_name($category_id)) . '</a></li>';
            }
            echo '</ul>';
        }
    }

}

if (!function_exists('hash_elements_get_post_primary_category')) {

    function hash_elements_get_post_primary_category($post_id, $term = 'category', $return_all_categories = false) {
        $return = array();

        if (class_exists('WPSEO_Primary_Term')) {
            // Show Primary category by Yoast if it is enabled & set
            $wpseo_primary_term = new WPSEO_Primary_Term($term, $post_id);
            $primary_term = get_term($wpseo_primary_term->get_primary_term());

            if (!is_wp_error($primary_term)) {
                $return['primary_category'] = $primary_term;
            }
        }

        if (empty($return['primary_category']) || $return_all_categories) {
            $categories_list = get_the_terms($post_id, $term);

            if (empty($return['primary_category']) && !empty($categories_list)) {
                $return['primary_category'] = $categories_list[0];  //get the first category
            }

            if ($return_all_categories) {
                $return['all_categories'] = array();

                if (!empty($categories_list)) {
                    foreach ($categories_list as &$category) {
                        $return['all_categories'][] = $category->term_id;
                    }
                }
            }
        }

        return $return;
    }

}

/** Get All Categories */
if (!function_exists('hash_elements_get_categories')) {

    function hash_elements_get_categories() {
        $cats = array();

        $terms = get_categories(array(
            'hide_empty' => true
        ));

        foreach ($terms as $term) {
            $cats[$term->term_id] = $term->name;
        }

        return $cats;
    }

}

/** Get All Tags */
if (!function_exists('hash_elements_get_tags')) {

    function hash_elements_get_tags() {
        $tags = array();

        $terms = get_tags(array(
            'hide_empty' => true
        ));

        foreach ($terms as $term) {
            $tags[$term->term_id] = $term->name;
        }

        return $tags;
    }

}


if (!function_exists('he_elementor_get_posts_by_query')) {

    /**
     * Get post by search
     *
     */
    function he_elementor_get_posts_by_query() {
        $search_string = isset($_POST['q']) ? sanitize_text_field(wp_unslash($_POST['q'])) : ''; // phpcs:ignore
        $post_type = isset($_POST['post_type']) ? $_POST['post_type'] : 'post'; // phpcs:ignore
        $results = array();

        add_filter('posts_where', 'he_title_filter', 10, 2);

        $query = new WP_Query(array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'title_filter' => $search_string,
            'post_status' => 'publish',
        ));
        remove_filter('posts_where', 'he_title_filter', 10, 2);

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

    add_action('wp_ajax_he_elementor_get_posts_by_query', 'he_elementor_get_posts_by_query');
    add_action('wp_ajax_nopriv_he_elementor_get_posts_by_query', 'he_elementor_get_posts_by_query');
}

if (!function_exists('he_elementor_get_posts_title_by_id')) {

    /**
     * Get post title by ID
     *
     */
    function he_elementor_get_posts_title_by_id() {
        $ids = isset($_POST['id']) ? $_POST['id'] : array(); // phpcs:ignore
        $post_type = isset($_POST['post_type']) ? $_POST['post_type'] : 'post'; // phpcs:ignore
        $results = array();

        $query = new WP_Query(
                array(
            'post_type' => $post_type,
            'post__in' => $ids,
            'posts_per_page' => - 1,
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

    add_action('wp_ajax_he_elementor_get_posts_title_by_id', 'he_elementor_get_posts_title_by_id');
    add_action('wp_ajax_nopriv_he_elementor_get_posts_title_by_id', 'he_elementor_get_posts_title_by_id');
}

if (!function_exists('he_title_filter')) {

    function he_title_filter($where, &$wp_query) {
        global $wpdb;
        if ($search_term = $wp_query->get('title_filter')) {
            $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($search_term)) . '%\'';
        }
        return $where;
    }
}