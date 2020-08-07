<?php

namespace HashElements\Modules\TotalModuleSeven;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'het-total-module-seven';
    }

    public function get_widgets() {
        $widgets = [
            'TotalModuleSeven',
        ];
        return $widgets;
    }

}
