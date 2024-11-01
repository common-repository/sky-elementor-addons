<?php

namespace Sky_Addons\Modules\FellowSlider;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
        
    }

    public function get_name() {
        return 'fellow-slider';
    }

    public function get_widgets() {
        return [
            'Fellow_Slider',
        ];
    }

}
