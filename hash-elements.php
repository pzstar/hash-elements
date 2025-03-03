<?php

/**
 * Plugin Name: Hash Elements - Addons for Elementor
 * Description: Elementor addons for WordPress Themes developed by HashThemes https://hashthemes.com
 * Version: 1.5.2
 * Author: HashThemes
 * Author URI: https://hashthemes.com/
 * Text Domain: hash-elements
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 * Elementor tested up to: 3.27
 * Elementor Pro tested up to: 3.2.1
 */
/* If this file is called directly, abort */
if (!defined('WPINC')) {
    die();
}

define('HASHELE_VERSION', '1.5.2');

define('HASHELE_FILE', __FILE__);
define('HASHELE_PLUGIN_BASENAME', plugin_basename(HASHELE_FILE));
define('HASHELE_PATH', plugin_dir_path(HASHELE_FILE));
define('HASHELE_URL', plugins_url('/', HASHELE_FILE));

define('HASHELE_ASSETS_URL', HASHELE_URL . 'assets/');

if (!class_exists('Hash_Elements')) {

    class Hash_Elements {

        private static $instance = null;

        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if (self::$instance == null) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct() {

            // Load translation files
            add_action('init', array($this, 'load_plugin_textdomain'));

            // Load necessary files.
            add_action('plugins_loaded', array($this, 'init'));
        }

        public function load_plugin_textdomain() {
            load_plugin_textdomain('hash-elements', false, basename(dirname(__FILE__)) . '/languages');
        }

        public function init() {

            // Check if Elementor installed and activated
            if (!did_action('elementor/loaded')) {
                add_action('admin_notices', array($this, 'required_plugins_notice'));
                return;
            }
            add_action('wp_loaded', array($this, 'admin_notice'), 20);
            add_action('admin_enqueue_scripts', array($this, 'hash_elements_register_backend_assets'));

            require(HASHELE_PATH . 'inc/helper-functions.php');
            require(HASHELE_PATH . 'inc/widget-loader.php');
            require(HASHELE_PATH . 'inc/sticky-column.php');
            require(HASHELE_PATH . 'inc/sticky-container.php');
            require(HASHELE_PATH . 'inc/ajax-select.php');
        }

        public function required_plugins_notice() {
            $screen = get_current_screen();
            if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
                return;
            }

            $plugin = 'elementor/elementor.php';

            if ($this->is_elementor_installed()) {
                if (!current_user_can('activate_plugins')) {
                    return;
                }

                $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin);
                $admin_message = '<p>' . esc_html__('Ops! Hash Elements is not working because you need to activate the Elementor plugin first.', 'hash-elements') . '</p>';
                $admin_message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__('Activate Elementor Now', 'hash-elements')) . '</p>';
            } else {
                if (!current_user_can('install_plugins')) {
                    return;
                }

                $install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
                $admin_message = '<p>' . esc_html__('Ops! Hash Elements is not working because you need to install the Elementor plugin', 'hash-elements') . '</p>';
                $admin_message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__('Install Elementor Now', 'hash-elements')) . '</p>';
            }

            echo '<div class="error">' . $admin_message . '</div>';
        }

        /**
         * Check if theme has elementor installed
         *
         * @return boolean
         */
        public function is_elementor_installed() {
            $file_path = 'elementor/elementor.php';
            $installed_plugins = get_plugins();

            return isset($installed_plugins[$file_path]);
        }

        public function admin_notice() {
            add_action('admin_notices', array($this, 'admin_notice_content'));
        }

        public function admin_notice_content() {
            if (!$this->is_dismissed('review') && !empty(get_option('hash_elements_first_activation')) && time() > get_option('hash_elements_first_activation') + 15 * DAY_IN_SECONDS) {
                $this->review_notice();
            }
        }

        public static function is_dismissed($notice) {
            $dismissed = get_option('hash_elements_dismissed_notices', array());

            // Handle legacy user meta
            $dismissed_meta = get_user_meta(get_current_user_id(), 'hash_elements_dismissed_notices', true);
            if (is_array($dismissed_meta)) {
                if (array_diff($dismissed_meta, $dismissed)) {
                    $dismissed = array_merge($dismissed, $dismissed_meta);
                    update_option('hash_elements_dismissed_notices', $dismissed);
                }
                if (!is_multisite()) {
                    // Don't delete on multisite to avoid the notices to appear in other sites.
                    delete_user_meta(get_current_user_id(), 'hash_elements_dismissed_notices');
                }
            }

            return in_array($notice, $dismissed);
        }

        public function review_notice() {
            ?>
            <div class="he-notice notice notice-info">
                <?php $this->dismiss_button('review'); ?>
                <div class="he-notice-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 216.09 216.09">
                        <path d="M194.33 0H21.76A21.76 21.76 0 0 0 0 21.76v172.57a21.76 21.76 0 0 0 21.76 21.76h172.57a21.76 21.76 0 0 0 21.76-21.76V21.76A21.76 21.76 0 0 0 194.33 0m-73 96.87h53.8v19.41h-53.8Zm-16.68 59.88H85.21v-40.61H49.26v40.61H29.84V59.48h19.42v37.25h35.95V59.48h19.48Zm81.14 0h-64.42v-19.48h64.46Zm.41-77.93h-64.83V59.34h64.87Z" />
                    </svg>
                </div>

                <div class="he-notice-content">
                    <p>
                        <?php
                        printf(
                            /* translators: %1$s is link start tag, %2$s is link end tag. */
                            esc_html__('Great to see that you have been using Hash Elements for some time. We hope you love it, and we would really appreciate it if you would %1$sgive us a %3$s rating%2$s. Your valuable review will inspire us to make it more better.', 'hash-elements'), '<a style="text-decoration:none;font-weight:bold;" target="_blank" href="https://wordpress.org/support/plugin/hash-elements/reviews/?filter=5#new-post">', '</a>', '<span class="he-notice-star"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></span>'
                        );
                        ?>
                    </p>
                    <a target="_blank" class="button button-primary button-large" href="https://wordpress.org/support/plugin/hash-elements/reviews/?filter=5"><span class="dashicons dashicons-thumbs-up"></span><?php echo esc_html__('Yes, of course', 'hash-elements') ?></a> &nbsp;
                    <a class="button button-large" href="<?php echo esc_url(wp_nonce_url(add_query_arg('he-hide-notice', 'review'), 'review', 'hash_elements_notice_nonce')); ?>"><span class="dashicons dashicons-yes"></span><?php echo esc_html__('I have already rated', 'hash-elements') ?></a>
                </div>
            </div>
            <?php
        }

        public function dismiss_button($name) {
            printf('<a class="notice-dismiss" href="%s"><span class="screen-reader-text">%s</span></a>', esc_url(wp_nonce_url(add_query_arg('he-hide-notice', $name), $name, 'hash_elements_notice_nonce')), esc_html__('Dismiss this notice.', 'hash-elements'));
        }

        public function hash_elements_register_backend_assets() {
            wp_enqueue_style('he-admin-style', HASHELE_URL . '/assets/css/admin-styles.css', array(), HASHELE_VERSION);
        }

    }

}

/**
 * Returns instanse of the plugin class.
 *
 * @since  1.0.0
 * @return object
 */
if (!function_exists('hash_elements')) {

    function hash_elements() {
        return Hash_Elements::get_instance();
    }

}

hash_elements();
