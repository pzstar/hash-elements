<?php

namespace HashElements\Modules\SquareModuleThree\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Utils;
use HashElements\Group_Control_Query;
use HashElements\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class SquareModuleThree extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'he-square-module-three';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('About Block', 'hash-elements');
    }

    // public function get_script_depends() {
    //     return ['jquery', 'square-elastiStack', 'square-draggabilly'];
    // }

    /** Icon */
    public function get_icon() {
        return 'he-square-module-three';
    }

    /** Category */
    public function get_categories() {
        return ['he-square-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'content_section', [
            'label' => esc_html__('Content', 'hash-elements'),
                ]
        );

        $this->add_control(
            'title', [
                'label' => __( 'Title', 'hash-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'hash-elements' ),
                'default' => __( 'Title', 'hash-elements' ),
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label' => __( 'Add Images', 'hash-elements' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->end_controls_section();

           
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        // echo '<pre>';print_r($settings);echo '</pre>';
        // return false;
        $square_about_image_stack = $settings['gallery'];
        $square_about_sec_class = !$square_about_image_stack ? 'he-about-fullwidth' : "";
        ?>
        <section id="he-about-us-section" class="sq-section">
            <div class="he-container he-clearfix">
                <?php
                if ($square_about_image_stack) {
                    ?>
                    <div class="he-image-stack">
                        <ul id="he-elasticstack" class="he-elasticstack">
                            <?php
                            foreach ($square_about_image_stack as $square_about_image_stack_single) {
                                $image = wp_get_attachment_image_src($square_about_image_stack_single['id'], 'square-about-thumb');
                                $image_alt = get_post_meta($square_about_image_stack_single['id'], '_wp_attachment_image_alt', true);
                                $image_alt_text = $image_alt ? $image_alt : esc_html__('About Us Gallery', 'hash-elements');
                                ?>
                                <li><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_html($image_alt_text) ?>"></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </section>
        <?php
    }   
}
