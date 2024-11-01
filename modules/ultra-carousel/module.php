<?php

namespace Sky_Addons\Modules\UltraCarousel;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_name()
    {
        return 'ultra-carousel';
    }

    public function get_widgets()
    {
        return [
            'Ultra_Carousel',
        ];
    }
}
