<?php

namespace HashElements\Modules\TotalModuleTen;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'het-total-module-ten';
    }

    public function get_widgets() {
        $widgets = [
            'TotalModuleTen',
        ];
        return $widgets;
    }

}
