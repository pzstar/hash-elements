<?php

namespace HashElements\Modules\TotalModuleNine;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'het-total-module-nine';
    }

    public function get_widgets() {
        $widgets = [
            'TotalModuleNine',
        ];
        return $widgets;
    }

}
