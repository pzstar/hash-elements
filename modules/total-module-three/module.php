<?php

namespace HashElements\Modules\TotalModuleThree;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'het-total-module-three';
    }

    public function get_widgets() {
        $widgets = [
            'TotalModuleThree',
        ];
        return $widgets;
    }

}
