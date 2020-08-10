<?php

namespace HashElements\Modules\AdvertisementModule;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-advertisement-module';
    }

    public function get_widgets() {
        $widgets = [
            'AdvertisementModule',
        ];
        return $widgets;
    }

}
