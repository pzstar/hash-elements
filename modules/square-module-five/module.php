<?php

namespace HashElements\Modules\SquareModuleFive;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-square-module-five';
    }

    public function get_widgets() {
        $widgets = [
            'SquareModuleFive',
        ];
        return $widgets;
    }

}
