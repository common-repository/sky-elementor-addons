<?php

namespace Sky_Addons\Modules\SlinkyMenu;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
        
    }

    public function get_name() {
        return 'slinky-menu';
    }

    public function get_widgets() {
        return [
                'Slinky_Menu',
        ];
    }

}
