<?php

namespace HashElements\Modules\SquareModuleThree;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-square-module-three';
    }

    public function get_widgets() {
        $widgets = [
            'SquareModuleThree',
        ];
        return $widgets;
    }

}
