<?php

namespace Sky_Addons\Modules\LogoCarousel;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();

    }

    public function get_name() {
        return 'logo-carousel';
    }

    public function get_widgets() {
        return [
                'Logo_Carousel',
        ];
    }

}
