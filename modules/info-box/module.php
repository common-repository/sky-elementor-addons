<?php

namespace Sky_Addons\Modules\InfoBox;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
    }

    public function get_name() {
        return 'info-box';
    }

    public function get_widgets() {
        return [
                'Info_Box',
        ];
    }

}
