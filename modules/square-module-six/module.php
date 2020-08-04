<?php

namespace HashElements\Modules\SquareModuleSix;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-square-module-six';
    }

    public function get_widgets() {
        $widgets = [
            'SquareModuleSix',
        ];
        return $widgets;
    }

}
