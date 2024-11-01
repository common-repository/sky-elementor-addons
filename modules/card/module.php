<?php

namespace Sky_Addons\Modules\Card;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
    }

    public function get_name() {
        return 'card';
    }

    public function get_widgets() {
        return [
                'Card',
        ];
    }

}
