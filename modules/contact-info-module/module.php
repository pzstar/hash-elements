<?php

namespace HashElements\Modules\ContactInfoModule;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-contact-info-module';
    }

    public function get_widgets() {
        $widgets = [
            'ContactInfoModule',
        ];
        return $widgets;
    }

}
