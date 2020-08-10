<?php

namespace HashElements\Modules\PersonalInfoModule;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-personal-info-module';
    }

    public function get_widgets() {
        $widgets = [
            'PersonalInfoModule',
        ];
        return $widgets;
    }

}
