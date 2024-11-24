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
        wp_enqueue_style('selectize', HASHELE_URL . 'assets/css/selectize.css', array(), '');
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
            <label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <#
                var unstored = {};
                var multiple = ( data.multiple ) ? 'multiple' : '';
                var value = data.controlValue;
                var keyOptions = data.key_options;

                if(keyOptions) {
                #>
                <select id="<?php echo $control_uid; ?>" class="elementor-selectize" {{ multiple }} data-setting="{{ data.name }}">
                    <# if(value){
                        _.each(value, function(key) {
                        const getOption = keyOptions.find(element => element.key == key);
                        #>
                        <option value="{{ key }}">{{{ getOption.value }}}</option>
                        <# }); 
                    }

                    _.each(keyOptions, function(option) {
                        if (-1 == value.indexOf(option.key)) {
                        #>
                            <option value="{{ option.key }}">{{{ option.value }}}</option>
                        <#
                        }
                    });
                    #>
                </select>
                <#
                } else {
                var options = data.options;

                if(options){
                    _.each( options, function( option_title, option_value ) {
                        if (-1 == value.indexOf( option_value ) ) {
                        unstored[option_value] = option_title;
                        }
                    });
                }
                #>

                <select id="<?php echo $control_uid; ?>" class="elementor-selectize" {{ multiple }} data-setting="{{ data.name }}">
                    <# if(value){
                        _.each( value, function( key ) { #>
                            <option value="{{ key }}">{{{ options[key] }}}</option>
                        <# }); 
                    }

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
