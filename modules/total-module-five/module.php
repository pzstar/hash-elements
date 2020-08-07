<?php

namespace HashElements\Modules\TotalModuleFive;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'het-total-module-five';
    }

    public function get_widgets() {
        $widgets = [
            'TotalModuleFive',
        ];
        return $widgets;
    }

}
