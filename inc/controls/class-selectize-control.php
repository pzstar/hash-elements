<?php

namespace HashElements;

use \Elementor\Base_Data_Control;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Selectize_Control extends Base_Data_Control {

    const Selectize = 'hash-elements-selectize';

    /**
     * Set control type.
     */
    public function get_type() {
        return self::Selectize;
    }

    /**
     * Enqueue control scripts and styles.
     */
    public function enqueue() {
        wp_enqueue_script('selectize', HASHELE_URL . 'assets/js/selectize.js', array('jquery', 'jquery-ui-sortable'), HASHELE_VERSION, true);
        wp_enqueue_script('he-custom-selectize', HASHELE_URL . 'assets/js/custom-selectize.js', array('selectize'), HASHELE_VERSION, true);
        wp_enqueue_style('selectize', HASHELE_URL . 'assets/css/selectize.css', array(), HASHELE_VERSION);
    }

    /**
     * Set default settings
     */
    protected function get_default_settings() {
        return [
            'multiple' => true,
            'label_block' => true,
            'options' => [],
            'key_options' => null,
        ];
    }

    /**
     * Control field markup
     */
    public function content_template() {
        $control_uid = $this->get_control_uid();
        ?>
        <div class="elementor-control-field">
            <label for="<?php echo esc_attr($control_uid); ?>" class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <#
                var unstored = {};
                var multiple = ( data.multiple ) ? 'multiple' : '';
                var value = data.controlValue;
                var keyOptions = data.key_options;

                /* A saved term may be missing from the options (deleted, or from demo content): keep the value, show its id, and compare as strings. */
                var selected = _.isArray( value ) ? value : ( value ? [ value ] : [] );
                var selectedKeys = _.map( selected, String );

                var isSelected = function( key ) {
                    return -1 !== _.indexOf( selectedKeys, String( key ) );
                };

                if(keyOptions) {
                #>
                <select id="<?php echo esc_attr($control_uid); ?>" class="elementor-selectize" {{ multiple }} data-setting="{{ data.name }}">
                    <# _.each(selected, function(key) {
                        var getOption = _.find(keyOptions, function(element) {
                            return String( element.key ) === String( key );
                        });
                        #>
                        <option value="{{ key }}">{{{ getOption ? getOption.value : key }}}</option>
                    <# });

                    _.each(keyOptions, function(option) {
                        if ( ! isSelected( option.key ) ) {
                        #>
                            <option value="{{ option.key }}">{{{ option.value }}}</option>
                        <#
                        }
                    });
                    #>
                </select>
                <#
                } else {
                var options = data.options || {};

                _.each( options, function( option_title, option_value ) {
                    if ( ! isSelected( option_value ) ) {
                        unstored[option_value] = option_title;
                    }
                });
                #>

                <select id="<?php echo esc_attr($control_uid); ?>" class="elementor-selectize" {{ multiple }} data-setting="{{ data.name }}">
                    <# _.each( selected, function( key ) { #>
                            <option value="{{ key }}">{{{ options[key] ? options[key] : key }}}</option>
                    <# });

                    _.each( unstored, function( option_title, option_value ) { #>
                        <option value="{{ option_value }}">{{{ option_title }}}</option>
                    <# }); #>
                </select>
                <#
                }
                #>
            </div>
        </div>

        <# if ( data.description ) { #>
            <div class="elementor-control-field-description">{{{ data.description }}}</div>
        <# } #>
        <?php
    }

}
