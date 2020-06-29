<?php

namespace HashElements;

if (!defined('ABSPATH'))
    exit();

class HASHELE_Widget_Loader {

    private static $instance = null;

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function __construct() {
        spl_autoload_register([$this, 'autoload']);

        $this->includes();
        // Elementor hooks
        $this->add_actions();
    }

    public function autoload($class) {
        if (0 !== strpos($class, __NAMESPACE__)) {
            return;
        }

        $has_class_alias = isset($this->classes_aliases[$class]);

        // Backward Compatibility: Save old class name for set an alias after the new class is loaded
        if ($has_class_alias) {
            $class_alias_name = $this->classes_aliases[$class];
            $class_to_load = $class_alias_name;
        } else {
            $class_to_load = $class;
        }

        if (!class_exists($class_to_load)) {

            $filename = strtolower(
                    preg_replace(
                            ['/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/'], ['', '$1-$2', '-', DIRECTORY_SEPARATOR], $class_to_load
                    )
            );

            $filename = HASHELE_PATH . $filename . '.php';

            if (is_readable($filename)) {
                include( $filename );
            }
        }

        if ($has_class_alias) {
            class_alias($class_alias_name, $class);
        }
    }

    private function includes() {
        require HASHELE_PATH . 'inc/module-manager.php';
    }

    public function add_actions() {
        add_action('elementor/init', [$this, 'add_elementor_widget_categories']);

        // Fires after Elementor controls are registered.
        add_action('elementor/controls/controls_registered', [$this, 'register_controls']);

        //FrontEnd Scripts
        add_action('elementor/frontend/before_register_scripts', [$this, 'register_frontend_scripts']);
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);

        //FrontEnd Styles
        add_action('elementor/frontend/before_register_styles', [$this, 'register_frontend_styles']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_frontend_styles']);

        //Editor Scripts
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);

        //Editor Style
        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_styles']);

        //Fires after Elementor preview styles are enqueued.
        add_action('elementor/preview/enqueue_styles', [$this, 'enqueue_preview_styles']);
    }

    function add_elementor_widget_categories() {

        $groups = array(
            'viral-news-elements' => esc_html__('Viral News Block', 'hash-elements'),
        );

        foreach ($groups as $key => $value) {
            \Elementor\Plugin::$instance->elements_manager->add_category($key, ['title' => $value], 1);
        }
    }

    function register_controls() {
        require_once HASHELE_PATH . 'inc/controls/groups/group-control-query.php';
        require_once HASHELE_PATH . 'inc/controls/groups/group-control-header.php';

        // Register Group
        \Elementor\Plugin::instance()->controls_manager->add_group_control('hash-elements-query', new Group_Control_Query());
        \Elementor\Plugin::instance()->controls_manager->add_group_control('hash-elements-header', new Group_Control_Header());
    }

    /**
     * Register Frontend Scripts
     */
    public function register_frontend_scripts() {
        
    }

    /**
     * Enqueue Frontend Scripts
     */
    public function enqueue_frontend_scripts() {
        wp_enqueue_script('hash-elements-owl-carousel-script', HASHELE_URL . 'assets/lib/owl-carousel/js/owl.carousel.min.js', array('jquery'), HASHELE_VERSION, true);
        wp_enqueue_script('hash-elements-slick-script', HASHELE_URL . 'assets/lib/slick/slick.min.js', array('jquery'), HASHELE_VERSION, true);
        wp_enqueue_script('hash-elements-frontend-script', HASHELE_URL . 'assets/js/frontend.js', array('jquery'), HASHELE_VERSION, true);
    }

    /**
     * Register Frontend Styles
     */
    public function register_frontend_styles() {
        
    }

    /**
     * Enqueue Frontend Styles
     */
    public function enqueue_frontend_styles() {
        wp_enqueue_style('hash-elements-style', HASHELE_URL . 'assets/lib/themify-icons/themify-icons.css', array(), HASHELE_VERSION);
        wp_enqueue_style('hash-elements-owl-carousel-style', HASHELE_URL . 'assets/lib/owl-carousel/css/owl.carousel.min.css', array(), HASHELE_VERSION);
        wp_enqueue_style('hash-elements-frontend-style', HASHELE_URL . 'assets/css/frontend.css', array(), HASHELE_VERSION);
    }

    /**
     * Enqueue Editor Scripts
     */
    public function enqueue_editor_scripts() {
        wp_enqueue_script('hash-elements-editor', HASHELE_URL . 'assets/js/editor.js', array('jquery'), HASHELE_VERSION, true);
        wp_localize_script('hash-elements-editor', 'is_elementor_pro_installed', $this->is_elementor_pro_installed());
    }

    /**
     * Enqueue Editor Styles
     */
    public function enqueue_editor_styles() {
        wp_enqueue_style('hash-elements-editor-style', HASHELE_ASSETS_URL . 'css/editor-styles.css', array(), HASHELE_VERSION);
    }

    /**
     * Preview Styles
     */
    public function enqueue_preview_styles() {
        
    }

    /**
     * Check if theme has elementor Pro installed
     *
     * @return boolean
     */
    public function is_elementor_pro_installed() {
        return function_exists('elementor_pro_load_plugin') ? 'yes' : 'no';
    }

}

if (!function_exists('hash_elements_widget_loader')) {

    /**
     * Returns an instance of the plugin class.
     * @since  1.0.0
     * @return object
     */
    function hash_elements_widget_loader() {
        return HASHELE_Widget_Loader::get_instance();
    }

}
hash_elements_widget_loader();
