<?php

namespace HashElements\Modules\SquareModuleFour;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-square-module-four';
    }

    public function get_widgets() {
        $widgets = [
            'SquareModuleFour',
        ];
        return $widgets;
    }

}
