<?php

namespace Sky_Addons\Modules\StellarSlider;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
    }

    public function get_name() {
        return 'stellar-slider';
    }

    public function get_widgets() {
        return [
            'Stellar_Slider',
        ];
    }
}
