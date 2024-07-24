<?php

/**
 * Plugin Name: Hash Elements - Addons for Elementor
 * Description: Elementor addons for WordPress Themes developed by HashThemes https://hashthemes.com
 * Version: 1.4.5
 * Author: HashThemes
 * Author URI: https://hashthemes.com/
 * Text Domain: hash-elements
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 */
/* If this file is called directly, abort */
if (!defined('WPINC')) {
    die();
}

define('HASHELE_VERSION', '1.4.5');

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

            require (HASHELE_PATH . 'inc/helper-functions.php');
            require (HASHELE_PATH . 'inc/widget-loader.php');
            require (HASHELE_PATH . 'inc/sticky-column.php');
            require (HASHELE_PATH . 'inc/sticky-container.php');
            require (HASHELE_PATH . 'inc/ajax-select.php');
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
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="eHus1xw4gRQ1" viewBox="0 0 128 128" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"><image width="128" height="128" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAM2mlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDggNzkuMTY0MDM2LCAyMDE5LzA4LzEzLTAxOjA2OjU3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKE1hY2ludG9zaCkiIHhtcDpDcmVhdGVEYXRlPSIyMDIwLTAyLTI4VDE1OjAzOjQ5KzA1OjQ1IiB4bXA6TW9kaWZ5RGF0ZT0iMjAyNC0wNi0yMFQxMzowODo0MyswNTo0NSIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyNC0wNi0yMFQxMzowODo0MyswNTo0NSIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDoxMWI1OWZhNS02NjM0LTQxMzItYTZmMS00NWVmYzE4MmFmOTIiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDo2Nzc2MTI2NC1lODhmLTliNGYtYTRkMC0zMDc4ZTZhMmU5ZjkiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo1ZDc2ZjI3Yy05NDljLTRjNjYtODJiNC02ODkxNmJiMWM0Y2UiPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjVkNzZmMjdjLTk0OWMtNGM2Ni04MmI0LTY4OTE2YmIxYzRjZSIgc3RFdnQ6d2hlbj0iMjAyMC0wMi0yOFQxNTowMzo0OSswNTo0NSIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKE1hY2ludG9zaCkiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjU4YTFkMWE4LWQzMDYtNGYyMS1iOTk4LTU4ZDMxMzU0ZjE5ZCIgc3RFdnQ6d2hlbj0iMjAyMC0wMi0yOFQxNTozOToxMSswNTo0NSIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKE1hY2ludG9zaCkiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOmMzYmQ5N2IxLTRmMDYtNDhmOS04N2M2LTg2YjU4OTc5OThjYyIgc3RFdnQ6d2hlbj0iMjAyMC0wMy0zMVQwMTo0NTo0MiswNTo0NSIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKE1hY2ludG9zaCkiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNvbnZlcnRlZCIgc3RFdnQ6cGFyYW1ldGVycz0iZnJvbSBpbWFnZS9wbmcgdG8gYXBwbGljYXRpb24vdm5kLmFkb2JlLnBob3Rvc2hvcCIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iZGVyaXZlZCIgc3RFdnQ6cGFyYW1ldGVycz0iY29udmVydGVkIGZyb20gaW1hZ2UvcG5nIHRvIGFwcGxpY2F0aW9uL3ZuZC5hZG9iZS5waG90b3Nob3AiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjJkYWQ5MWY3LWQ4ZDUtNDU4OS1hZjVhLTA4NDEzZTVhNWZmYSIgc3RFdnQ6d2hlbj0iMjAyMC0wMy0zMVQwMTo0NTo0MiswNTo0NSIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKE1hY2ludG9zaCkiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjU4M2ZjZDg1LTYwMTEtNDdjMC1hYWVmLWE4MzNjNzg4NTgyZCIgc3RFdnQ6d2hlbj0iMjAyNC0wNi0yMFQxMzowODowMSswNTo0NSIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKE1hY2ludG9zaCkiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNvbnZlcnRlZCIgc3RFdnQ6cGFyYW1ldGVycz0iZnJvbSBhcHBsaWNhdGlvbi92bmQuYWRvYmUucGhvdG9zaG9wIHRvIGltYWdlL3BuZyIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iZGVyaXZlZCIgc3RFdnQ6cGFyYW1ldGVycz0iY29udmVydGVkIGZyb20gYXBwbGljYXRpb24vdm5kLmFkb2JlLnBob3Rvc2hvcCB0byBpbWFnZS9wbmciLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjU4YzUyMGE4LTFhY2EtNDMzNi1iMGU5LWJlMzE3ZmY5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" preserveAspectRatio="xMidYMid meet"/></svg>
                </div>

                <div class="he-notice-content">
                    <p>
                        <?php
                        printf(
                                /* translators: %1$s is link start tag, %2$s is link end tag. */
                                esc_html__('Great to see that you have been using Hash Elements for some time. We hope you love it, and we would really appreciate it if you would %1$sgive us a 5 stars rating%2$s and spread your words to the world.', 'hash-elements'), '<a target="_blank" href="https://wordpress.org/support/plugin/hash-elements/reviews/?filter=5">', '</a>'
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
