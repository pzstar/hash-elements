<?php

namespace HashElements\Modules\TotalModuleEight;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'het-total-module-eight';
    }

    public function get_widgets() {
        $widgets = [
            'TotalModuleEight',
        ];
        return $widgets;
    }

}
